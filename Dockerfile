# syntax=docker/dockerfile:1
#
# docker build --target development -t brijeshdhaker/php:8.4.13 -f Dockerfile .
# docker build --target production -t brijeshdhaker/php:8.4.13 -f Dockerfile .
#

## FROM composer:lts as prod-deps
## WORKDIR /app
## RUN --mount=type=bind,source=./composer.json,target=composer.json \
##     --mount=type=bind,source=./composer.lock,target=composer.lock \
##     --mount=type=cache,target=/tmp/cache \
##     composer install --no-dev --no-interaction

## FROM composer:lts as dev-deps
## WORKDIR /app
## RUN --mount=type=bind,source=./composer.json,target=composer.json \
##     --mount=type=bind,source=./composer.lock,target=composer.lock \
##     --mount=type=cache,target=/tmp/cache \
##     composer install --no-interaction

#
# BASE STAGE
#
FROM php:8.4.13-apache as base
# Install necessary packages
RUN apt-get update && \
    apt-get install -y \
    libzip-dev libssh2-1-dev libmemcached-dev libssl-dev wget git unzip \
    --no-install-recommends && \
    rm -rf /var/lib/apt/lists/*

# Install PHP Extensions
RUN docker-php-ext-install zip pdo pdo_mysql 

# Install the ssh2-1.4 extension using pecl and enable it
RUN pecl install -o -f ssh2-1.4 memcached \
    && docker-php-ext-enable ssh2 memcached

RUN a2enmod rewrite
RUN a2enmod actions



#
# DEVELOPMENT STAGE
#
FROM base as development
# Install the Xdebug extension using pecl and enable it
RUN pecl install -o -f xdebug  && docker-php-ext-enable xdebug
COPY conf/php/php.ini "$PHP_INI_DIR/php.ini" 
#RUN mv "$PHP_INI_DIR/php.ini-development" "$PHP_INI_DIR/php.ini"
#COPY --from=dev-deps app/vendor/ /var/www/html/vendor
USER www-data

#
# PRODUCTION STAGE
#
FROM base as production
RUN mv "$PHP_INI_DIR/php.ini-production" "$PHP_INI_DIR/php.ini"
#COPY --from=prod-deps app/vendor/ /var/www/html/vendor
USER www-data
