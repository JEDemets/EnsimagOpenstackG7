 #!/bin/bash
apt-get install -y apache2
apt-get install -y libapache2-mod-php5
apt-get update --fix-missing
apt-get install -y php5
apt-get install -y php5-curl
apt-get install -y curl
service apache2 restart
rm /var/www/html/index.html
cd /tmp/app/EnsimagOpenstackG7-application_structure/
echo "$1" > ./server_picture/address.swift
echo "$2" > ./server_picture/container.name
echo "$3" > ./server_picture/user.name
echo "$4" > ./server_picture/pwd
echo "$5" > ./server_picture/tenant
echo "$6" > ./server_picture/auth.url
cp ./server_picture/* /var/www/html/
cd /tmp
curl -s https://getcomposer.org/installer | php -- --install-dir=/tmp
mv composer.phar /usr/local/bin/composer
composer --version
composer require rackspace/php-opencloud
mkdir /var/www/html/vendor/
cp -r ./vendor/* /var/www/html/vendor/
