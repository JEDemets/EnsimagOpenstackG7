#!/bin/bash

#Install MySQL
sudo apt-get update

echo "mysql-server mysql-server/root_password password " | sudo debconf-set-selections
echo "mysql-server mysql-server/root_password_again password " | sudo debconf-set-selections
export DEBIAN_FRONTEND=noninteractive
sudo -E apt-get -q -y install mysql-server

sudo /etc/init.d/mysql stop

sudo su
#sudo cd /var/lib/mysql

sudo mkdir /srv/storage
sudo mkdir /srv/storage/mysqldata
sudo chown -R mysql.mysql /srv/storage/mysqldata


sudo cp -r /var/lib/mysql/mysql /srv/storage/mysqldata/
sudo chown -R mysql:mysql /srv/storage/mysqldata/*

sudo sed -i "s/\/var\/lib\/mysql/\/srv\/storage\/mysqldata/g"  /etc/mysql/my.cnf 
sudo sed -i "s/bind-address/#bind-address/g"  /etc/mysql/my.cnf


#restart database daemon
sudo /etc/init.d/mysql start

sudo mysql --user=root --password=  < ./create_db.sh
sudo mysql db < ./prestashop_fullcustomer.dump.sql


apt-get install -y apache2
apt-get install -y libapache2-mod-php5
apt-get update --fix-missing
apt-get install -y php5
apt-get install -y php5-curl
service apache2 restart
rm /var/www/html/index.html
cp ./server_id/* /var/www/html/

exit
