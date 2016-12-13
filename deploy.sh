#!/bin/bash

# Setting the language prerequisites
ENVIRON=/etc/environment
LANG="LANG=en_US.utf-8"
LC_ALL="LC_ALL=en_US.utf-8"

if ! grep -Fxq "$LANG" "$ENVIRON" ; then  
	echo "$LANG" >> "$ENVIRON" 
fi

if ! grep -Fxq "$LC_ALL" "$ENVIRON" ; then
	echo "$LC_ALL" >> "$ENVIRON"
fi

# Configuring the network settings
systemctl disable firewalld
systemctl stop firewalld
systemctl disable NetworkManager
systemctl stop NetworkManager
systemctl enable network
systemctl start network

# Updating the software repositories & installing
yum install -y https://rdoproject.org/repos/rdo-release.rpm
yum install -y centos-release-openstack-mitaka
yum update -y

# Installing Packstack Installer
yum install -y openstack-packstack

# Run Packstack to install OpenStack (ALL IN ONE)
packstack --allinone
