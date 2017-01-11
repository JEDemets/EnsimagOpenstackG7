 #!/bin/bash
apt-get install -y apache2
apt-get install -y libapache2-mod-php5
apt-get update --fix-missing
apt-get install -y php5
apt-get install -y php5-curl
echo $1 "	server_worker" >> /etc/hosts
echo $2 "	server_picture" >> /etc/hosts
echo $3 "	dbserver" >> /etc/hosts
cd /tmp/app/EnsimagOpenstackG7-application_structure/
cp ./server_button/* /var/www/html/
