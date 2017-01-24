#!/bin/bash

apt-get install -y python3 python3-flask
apt-get install -y Imagemagick
apt-get update
apt-get install -y imagemagick
cd /tmp/app/EnsimagOpenstackG7-application_structure/w
./w.py &
