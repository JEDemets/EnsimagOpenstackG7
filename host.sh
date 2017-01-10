#!/bin/bash
echo "server_id        " $1 >> /etc/hosts
echo "serveur_worker   " $2 >> /etc/hosts
echo "serveur_status   " $3 >> /etc/hosts
echo "serveur_picture  " $4 >> /etc/hosts

