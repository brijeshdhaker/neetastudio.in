# syntax=docker/dockerfile:1
#
# docker build --target development -t brijeshdhaker/php:8.4.13 .
# docker build -t brijeshdhaker/php:8.4.13 .
#
# docker run -d -p 8080:80 --name neetastudio.in -v /var/www/neetastudio.in:/var/www/html php:8.4-apache
# docker exec -it neetastudio.in /bin/bash
#
# docker run -d -p 8080:80 --name neetastudio.in -v /home/brijeshdhaker/IdeaProjects/neetastudio.in:/var/www/html php:8.4-apache
#

FROM php:8.4-apache

# Install necessary packages
RUN apt-get update && \
    apt-get install \
    libzip-dev \
    wget \
    git \
    unzip \
    -y --no-install-recommends

# Install PHP Extensions
RUN docker-php-ext-install zip pdo pdo_mysql

#RUN apt-get install -y php-json php-mbstring php-xml php-pcov php-xdebug
RUN pecl install -o -f xdebug \
    && docker-php-ext-enable xdebug

RUN a2enmod rewrite
RUN a2enmod actions

COPY conf/php/php-apache.ini "$PHP_INI_DIR/php.ini"

USER www-data
