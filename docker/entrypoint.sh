#!/bin/bash

service mariadb start
service apache2 start

tail -f /var/log/apache2/access.log -f /var/log/apache2/error.log -f /var/log/mysql/error.log
