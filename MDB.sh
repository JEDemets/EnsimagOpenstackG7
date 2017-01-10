#!/bin/bash

#Add the MariaDB Repository
sudo apt-get install software-properties-common
sudo apt-key adv --recv-keys --keyserver hkp://keyserver.ubuntu.com:80 0xcbcb082a1bb943db
sudo add-apt-repository 'deb http://mirror.jmu.edu/pub/mariadb/repo/5.5/ubuntu trusty main'
sudo apt-get update

#Install MariaDB
sudo apt-get install mariadb-server
sudo service mysql stop

#Configure and Secure MariaDB for Use
sudo mysql_install_db
sudo service mysql start
sudo mysql_secure_installation

#Verify MariaDB Installation
mysql -V
mysql -p
exit
