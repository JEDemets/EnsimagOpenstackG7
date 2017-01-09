 #!/bin/bash
apt-get install -y apache2
apt-get install -y libapache2-mod-php5
apt-get update --fix-missing
apt-get install -y php5
#missing : copu to /var/www/html
