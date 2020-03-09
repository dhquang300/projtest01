#!/bin/bash
E_BADARGS=65
MYSQL=`which mysql`
 
SQL="CREATE DATABASE IF NOT EXISTS 'dbtest' GRANT ALL PRIVILEGES ON 'dbtest'.* TO 'user01@localhost' IDENTIFIED BY '123';"
 
$MYSQL -uroot -p -e "$SQL"

$MYSQL -u root -p dbtest < "./script.sql"
