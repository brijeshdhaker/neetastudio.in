### PHP Installation
```bash
# Option : 1
# install php
sudo apt update && sudo apt install php
sudo apt install -y libapache2-mod-php php php-cli php-common php-cgi php-mysql php-json php-mbstring php-xml php-pcov php-ssh2 php-xdebug 

# Option : 2
# apache setup
sudo apt install -y apache2

# enable site
sudo a2ensite neetastudio.in
sudo systemctl restart apache2.service

# disable site
sudo a2dissite neetastudio.in
sudo systemctl restart apache2.service



```

### Setup directories /var/www/neetastudio.in
```bash
sudo mkdir -p /var/www/neetastudio.in
sudo chown -R $USER:$USER /var/www/neetastudio.in
sudo chmod -R 755 /var/www/neetastudio.in

sudo mkdir -p /var/log/neetastudio.in
sudo chown -R $USER:$USER /var/log/neetastudio.in
sudo chmod -R 777 /var/log/neetastudio.in
sudo touch /var/log/neetastudio.in/neetastudio-2025-07-21.log
sudo touch /var/log/neetastudio.in/neetastudio-default.log
sudo touch /var/log/neetastudio.in/neetastudio-err.log

```

#### Install Composer
```bash

sudo apt -y install composer

# Install required packages
composer outdated --minor-only
composer update

#
composer require slim/slim:"4.*"
composer require slim/psr7
composer require nyholm/psr7 nyholm/psr7-server
composer require guzzlehttp/psr7 "^2"
composer require laminas/laminas-diactoros
#
composer require apache/log4php "2.3.0"
#
composer require phpmailer/phpmailer "~6.0"
#
composer require phpfastcache/phpfastcache
#
composer require phpoffice/phpspreadsheet
#
composer require php-di/php-di
#
composer require --dev phpunit/phpunit "^10.5.64"
composer require --dev vitexsoftware/phpunit-skeleton-generator --with-all-dependencies

```

### Setup Virtualhost
```bash
sudo vi /etc/apache2/sites-available/neetastudio.in.conf

<VirtualHost _default_:80>
        #
        ServerAdmin admin@neetastudio.in
        ServerName neetastudio.in
        ServerAlias www.neetastudio.in
        DocumentRoot /var/www/neetastudio.in
        
        #
        SetEnv APP_ENV "DEV"
        SetEnv APP_NAME "neetastudio.in"
        SetEnv DB_HOST "mysqlserver.sandbox.net"
        SetEnv DB_USER "neetastudio"
        SetEnv DB_NAME "NEETASTUDIO"
        SetEnv DB_PASSWORD_FILE_PATH "/run/secrets/mysql-root-password"

        #
        <Directory /var/www/neetastudio.in>
            Options Indexes FollowSymLinks MultiViews
            AllowOverride All
            Require all granted
        </Directory>
        
        #
        ErrorLog ${APACHE_LOG_DIR}/neetastudio_error.log
        CustomLog ${APACHE_LOG_DIR}/neetastudio_access.log combined

</VirtualHost>
```


### Restart Apache Server 
```bash
sudo a2ensite neetastudio.in.conf
sudo systemctl reload apache2

#
sudo a2enmod rewrite
sudo a2enmod actions

#
sudo systemctl start apache2
sudo systemctl stop apache2

#
sudo systemctl restart apache2
sudo systemctl status apache2

sudo systemctl enable apache2
sudo systemctl disable apache2
```

### /var/www/neetastudio.in/controllers/.htaccess
```
RewriteEngine On
RewriteBase /controllers
RewriteCond %{REQUEST_FILENAME} !-f
RewriteCond %{REQUEST_FILENAME} !-d
RewriteRule ^ index.php [QSA,L]
```

### /var/www/neetastudio.in/.htaccess (Optional)
```
RewriteEngine on
RewriteRule ^$ neetastudio.in/ [L]
RewriteRule (.*) neetastudio.in/$1 [L]
```

### setup php-debugger
```bash
sudo apt -y install php-xdebug
```

### PHPUnit Test Setup
```bash

docker-php-ext-install php-json pdo pdo_mysql
```

### PHPUnit Setup ; /etc/php/8.3/apache2/php.ini /etc/php/8.3/cli/php.ini
```conf
[PHPUnit]
error_reporting=-1
zend.assertions=1
assert.exception=1
memory_limit=-1
;extension=mbstring

[xdebug-3.0]
xdebug.mode=develop,debug,coverage,profile,trace
;xdebug.client_host=docker.sandbox.net
;xdebug.client_port=9000
;xdebug.idekey=vscode
xdebug.start_with_request=yes
;xdebug.start_with_request=trigger
;xdebug.trigger_value=vscode

```
###
http://neetastudio.in/index.php?_dc=fdfs&page=home&sTgt=site&XDEBUG_TRIGGER=vscode

### dbgpProxy
```bash

./dbgpProxy -i 127.0.0.1:9001 -s 127.0.0.1:9009 

./dbgpProxy -f

```
### Run PhpUnit Test
```bash

vendor/bin/phpunit "--bootstrap" "./bootstrap.php" "--filter" "%\btestgetRepositoryPath\b%" "./src/test/php/OnclickEnvTest.php"

/usr/bin/php -d xdebug.mode="develop,debug,coverage" "./vendor/bin/phpunit" "--colors" "--log-junit" "/tmp/nb-phpunit-log.xml" "--bootstrap" "./bootstrap.php" "--filter" "%\btestgetRepositoryPath\b%" "./src/test/php/OnclickEnvTest.php"

/usr/bin/php -d xdebug.mode=develop,debug,coverage "./conf/phpunit-12.3.11.phar" "--colors" "--log-junit" "/tmp/nb-phpunit-log.xml" "--bootstrap" "./bootstrap.php" "--configuration" "./phpunit.xml" "--filter" "%\btestGetMapping\b%" "./src/test/php/dao/MappingHelperTest.php"

```

###
```conf
ENV APACHE_DOCUMENT_ROOT /var/www/neetastudio.in
RUN sed -ri -e 's!/var/www/html!${APACHE_DOCUMENT_ROOT}!g' /etc/apache2/sites-available/*.conf
RUN sed -ri -e 's!/var/www/!${APACHE_DOCUMENT_ROOT}!g' /etc/apache2/apache2.conf /etc/apache2/conf-available/*.conf
```

###
http://neetastudio.in/phpinfo.php

###
http://neetastudio.in

### Rest End Points
```bash

http://neetastudio.in/controllers/hello/brijesh
http://neetastudio.in/controllers/contactus
http://neetastudio.in/controllers/subcribe-services
http://neetastudio.in/controllers/collaboration
http://neetastudio.in/controllers/book-session

```

### Run App Using Docker
```bash

docker run -d -p 80:80 \
    -v /apps/var/logs/neetastudio.in:/var/log/neetastudio.in:rw \
    -v ${PWD}:/var/www/html \
    -v ${PWD}/conf/apache/apache2.conf:/etc/apache2/apache2.conf \
    -v ${PWD}/conf/apache/envvars:/etc/apache2/envvars \
    -v ${PWD}/conf/mysql/password.txt:/run/secrets/mysql-root-password:ro \
    -v ${PWD}/conf/php/php.ini:/usr/local/etc/php/php.ini \
    -w /var/www/html \
    --env-file ${PWD}/envvars \
    --add-host docker.sandbox.net:172.18.0.1 \
    --name neetastudio.in \
    brijeshdhaker/php:8.4.13


docker exec -it neetastudio.in /bin/bash

docker run --rm -it \
-e 'XDEBUG_TRIGGER=vscode' \
-v ${PWD}:/var/www/html \
-v ${PWD}/conf/mysql/password.txt:/run/secrets/mysql-root-password:ro \
-v ${PWD}/conf/php/php.ini:/usr/local/etc/php/php.ini \
-w /var/www/html \
--env-file ${PWD}/envvars \
--add-host docker.sandbox.net:172.18.0.1 \
--name phpunit-test \
brijeshdhaker/php:8.4.13 /bin/bash ${php} ${phpargs} ${phpunit} ${phpunitargs}

```