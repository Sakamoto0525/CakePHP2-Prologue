FROM php:5.6-apache
ADD ./httpd.conf /etc/apache2/apache2.conf

RUN a2enmod rewrite

RUN apt-get update && docker-php-ext-install pdo_mysql mysqli mbstring

RUN mkdir -p /var/log/logdir
RUN chmod 777 /var/log/logdir

COPY php.ini /usr/local/etc/php/