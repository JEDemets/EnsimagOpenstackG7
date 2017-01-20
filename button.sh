 #!/bin/bash
apt-get install -y apache2
apt-get install -y libapache2-mod-php5
apt-get update --fix-missing
apt-get install -y php5
apt-get install -y php5-curl
apt-get install -y curl
service apache2 restart
rm /var/www/html/index.html
echo $1 "	server_worker" >> /etc/hosts
echo $2 "	server_picture" >> /etc/hosts
echo $3 "	dbserver" >> /etc/hosts
cd /tmp/app/EnsimagOpenstackG7-application_structure/
echo "$4" > ./server_button/address.swift
cp ./server_button/* /var/www/html/
curl -s https://getcomposer.org/installer | php
mv composer.phar /usr/local/bin/composer
composer --version
composer require rackspace/php-opencloud
mkdir /var/www/html/vendor/
cp -r ./vendor/* /var/www/html/vendor/

