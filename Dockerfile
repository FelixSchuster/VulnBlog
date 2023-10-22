FROM ubuntu:latest

ENV DEBIAN_FRONTEND noninteractive

RUN apt-get update

RUN apt-get install -y apache2 php libapache2-mod-php php-ldap php-mysqli mariadb-server php-curl

COPY ./html /var/www/html/vulnblog

RUN chown www-data /var/www/html/vulnblog -R

COPY ./database/db.sql /tmp/

COPY ./docker/entrypoint.sh /usr/local/bin/

RUN chmod +x /usr/local/bin/entrypoint.sh

RUN service mariadb start && mariadb -v < /tmp/db.sql

EXPOSE 80

ENTRYPOINT ["entrypoint.sh"]
