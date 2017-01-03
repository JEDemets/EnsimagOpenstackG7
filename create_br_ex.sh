#!/bin/bash

# Script for creating the external bridge 
# ENO1 gets static, instead of DHCP

DIR=/etc/sysconfig/network-scripts
CFGFILE=ifcfg-eno1

# Backup the eno1 config file
cp "$DIR"/"$CFGFILE" "$DIR"/"$CFGFILE".backup

echo "DEVICE=\"eno1\"" > "$DIR"/"$CFGFILE"
echo "NM_CONTROLLED=\"yes\"" >> "$DIR"/"$CFGFILE"
echo "ONBOOT=\"yes\"" >> "$DIR"/"$CFGFILE"
echo "IPV6INIT=no" >> "$DIR"/"$CFGFILE"

# Remove the BOOTPROTO line
LINE="$(grep -nr ONBOOT "$DIR"/"$CFGFILE" | cut -c 1)"
# sed ${LINE}d "$DIR"/"$CFGFILE" > "$DIR"/"$CFGFILE"

# Remove lines linked to BOOTPROTO
LINE="$(grep -nr DEFROUTE "$DIR"/"$CFGFILE" | cut -c 1)"
# sed ${LINE}d "$DIR"/"$CFGFILE" > "$DIR"/"$CFGFILE"

LINE="$(grep -nr PEERDNS "$DIR"/"$CFGFILE" | cut -c 1)"
# sed ${LINE}d "$DIR"/"$CFGFILE" > "$DIR"/"$CFGFILE"

LINE="$(grep -nr PEERROUTES "$DIR"/"$CFGFILE" | cut -c 1)"
# sed ${LINE}d "$DIR"/"$CFGFILE" > "$DIR"/"$CFGFILE"

# Linking the ENO1 config to the bridge
echo "TYPE=\"OVSPort\"" >> "$DIR"/"$CFGFILE"
echo "DEVICETYPE=\"ovs\"" >> "$DIR"/"$CFGFILE"
echo "OVS_BRIDGE=br-ex" >> "$DIR"/"$CFGFILE"

# Creating the br-ex network config file
BREXFILE=ifcfg-br-ex
touch "$DIR"/"$BREXFILE"

# Filling the new file
echo "DEVICE=\"br-ex\"" > "$DIR"/"$BREXFILE"
echo "DEVICETYPE=\"ovs\"" >> "$DIR"/"$BREXFILE"
echo "TYPE=\"OVSBridge\"" >> "$DIR"/"$BREXFILE"
echo "BOOTPROTO=\"none\"" >> "$DIR"/"$BREXFILE"

# Getting the IP address and writing it in the new config file
IPADDRESS="$(ifconfig eno1 | grep -w "inet" | awk '{print $2}')"

echo "IPADDR=\"$IPADDRESS\"" >> "$DIR"/"$BREXFILE"
echo "NETMASK=\"255.255.255.192\"" >> "$DIR"/"$BREXFILE"
echo "GATEWAY=\"10.11.51.129\"" >> "$DIR"/"$BREXFILE"
echo "DNS1=\"10.3.252.26\"" >> "$DIR"/"$BREXFILE"
echo "BROADCAST=\"255.255.255.255\"" >> "$DIR"/"$BREXFILE"

echo "NM_CONTROLLED=\"yes\"" >> "$DIR"/"$BREXFILE"
echo "DEFROUTE=\"yes\"" >> "$DIR"/"$BREXFILE"
echo "IPV4_FAILURE_FATAL=\"yes\"" >> "$DIR"/"$BREXFILE"
echo "IPV6INIT=no" >> "$DIR"/"$BREXFILE"

echo "ONBOOT=\"yes\"" >> "$DIR"/"$BREXFILE"

# Creating the BOND0 config file
BONDFILE=ifcfg-bond0
touch "$DIR"/"$BONDFILE"

echo "DEVICE=bond0" > "$DIR"/"$BONDFILE"
echo "DEVICETYPE=ovs" >> "$DIR"/"$BONDFILE"
echo "TYPE=OVSPort" >> "$DIR"/"$BONDFILE"
echo "OVS_BRIDGE=br-ex" >> "$DIR"/"$BONDFILE"
echo "ONBOOT=yes" >> "$DIR"/"$BONDFILE"
echo "BONDING_MASTER=yes" >> "$DIR"/"$BONDFILE"
echo "BONDING_OPTS=\"mode=802.3ad\"" >> "$DIR"/"$BONDFILE"

# Restarting the network service
# in order to apply all the changes done above
# service network restart
