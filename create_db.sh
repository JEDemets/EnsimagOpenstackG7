#!/bin/bash

CREATE DATABASE db ;
CREATE TABLE `db`.`ps_played` ( `id_customer` INT(10) NOT NULL , `status` BOOLEAN NOT NULL , PRIMARY KEY (`id_customer`)) ENGINE = InnoDB;
CREATE USER 'root'@'%' IDENTIFIED BY '';
GRANT ALL PRIVILEGES ON *.* TO 'root'@'%' WITH GRANT OPTION;
FLUSH PRIVILEGES;
exit

