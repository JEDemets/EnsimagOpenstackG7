 #!/bin/bash
apt-get install -y apache2
apt-get install -y libapache2-mod-php5
apt-get update --fix-missing
apt-get install -y php5
apt-get install -y php5-curl
apt-get install -y php5-mysql
service apache2 restart
rm /var/www/html/index.html
echo $1 "	dbserver" >> /etc/hosts
cd /tmp/app/EnsimagOpenstackG7-application_structure/
cp ./server_status/* /var/www/html/

