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
RUN docker-php-ext-install pdo pdo_mysql
RUN a2enmod rewrite
RUN a2enmod actions
RUN mv "$PHP_INI_DIR/php.ini-production" "$PHP_INI_DIR/php.ini"
USER www-data
