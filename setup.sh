#!/bin/bash

greenplus='\e[1;33m[+]\e[0m'
yellowstar='\e[1;93m[*]\e[0m'
redexclaim='\e[1;31m[!]\e[0m'

check_for_root() {
    if [ "$EUID" -ne 0 ]
        then echo -e "\n  $redexclaim Script must be run with 'sudo ./${0##*/}' or as root\n"
        exit
    fi
}

install_dependencies() {
    echo -e "\n  $yellowstar Installing dependencies\n"
    sudo apt-get update -y
    sudo apt-get install apache2 php libapache2-mod-php php-ldap php-mysqli -y
	sudo systemctl enable apache2
	sudo systemctl start apache2
	sudo apt-get install mariadb-server -y
	sudo systemctl enable mariadb.service
	sudo systemctl start mariadb.service
    echo -e "\n  $yellowstar Done installing dependencies.."
}

setup_database() {
    echo -e "\n\n  $yellowstar Setting up the database\n"
    sudo mariadb -v < ./database/db.sql
    echo -e "\n  $yellowstar Done setting up the database.."
}

setup_webpage() {
    echo -e "\n\n  $yellowstar Setting up the webpage\n"
    sudo rm /var/www/html/vulnblog/ -v -r
    sudo mkdir /var/www/html/vulnblog -v
    sudo cp ./html/* /var/www/html/vulnblog/ -v -r
    sudo chown www-data /var/www/html/vulnblog/ -v -R
    #   ^ fix permission denied errors for shared folders with hostmachine if run in virtualbox
    #   could also run 'sudo adduser www-data vboxsf' - for further information see:
    #   https://stackoverflow.com/questions/26740113/virtualbox-shared-folder-permissions
    echo -e "\n  $yellowstar Done setting up the webpage.."
}

check_for_root
# install_dependencies
setup_database
setup_webpage

echo -e "\n\n  $greenplus Webpage is available at http://127.0.0.1/vulnblog"
echo -e "\n  $greenplus All Done! Happy Hacking!\n"
