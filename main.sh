 #!/bin/bash
apt-get install -y apache2
apt-get install -y libapache2-mod-php5
apt-get update --fix-missing
apt-get install -y php5
apt-get install -y php5-curl
cd /tmp/app/EnsimagOpenstackG7-application_structure/
rm /var/www/html/index.html
cp ./server_main/* /var/www/html/
