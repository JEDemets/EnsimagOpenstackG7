 #!/bin/bash
apt-get install -y apache2
apt-get install -y libapache2-mod-php5
apt-get update --fix-missing
apt-get install -y php5
apt-get install -y php5-curl
cd /tmp/app/EnsimagOpenstackG7-application_structure/
echo "$1" > ./server-picture/address.swift
cp ./server-picture/* /var/www/html/
