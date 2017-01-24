 #!/bin/bash
apt-get install -y apache2
apt-get install -y libapache2-mod-php5
apt-get update --fix-missing
apt-get install -y php5
apt-get install -y php5-curl
apt-get install -y curl
apt-get install -y php5-mysql
service apache2 restart
rm /var/www/html/index.html
echo $1 "	server_worker" >> /etc/hosts
echo $2 "	server_picture" >> /etc/hosts
echo $3 "	dbserver" >> /etc/hosts
cd /tmp/app/EnsimagOpenstackG7-application_structure/
echo "$4" > ./server_button/address.swift
echo "$5" > ./server_button/container.name
echo "$6" > ./server_button/user.name
echo "$7" > ./server_button/pwd
echo "$8" > ./server_button/tenant
echo "$9" > ./server_button/auth.url
cp ./server_button/* /var/www/html/
cd /tmp
export COMPOSER_HOME=/tmp
curl -s https://getcomposer.org/installer | php -- --install-dir=/tmp
mv composer.phar /usr/local/bin/composer
composer --version
composer require rackspace/php-opencloud
mkdir /var/www/html/vendor/
cp -r ./vendor/* /var/www/html/vendor/

