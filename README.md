### Setup directories /var/www/neetastudio.in
```bash
sudo mkdir -p /var/www/neetastudio.in
sudo chown -R $USER:$USER /var/www/neetastudio.in
sudo chmod -R 755 /var/www/neetastudio.in

sudo mkdir -p /var/log/neetastudio.in
sudo touch /var/log/neetastudio.in/neetastudio-2025-07-21.log
sudo touch /var/log/neetastudio.in/neetastudio-default.log
sudo touch /var/log/neetastudio.in/neetastudio-err.log
sudo chown -R $USER:$USER /var/log/neetastudio.in
sudo chmod -R 777 /var/log/neetastudio.in
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
        SetEnv APP_NAME "ONLINE"
        
        #
        <Directory /var/www/neetastudio.in>
            Options Indexes FollowSymLinks
            AllowOverride All
            Require all granted
        </Directory>
        
        #
        ErrorLog ${APACHE_LOG_DIR}/neetastudio_error.log
        CustomLog ${APACHE_LOG_DIR}/neetastudio_access.log combined
</VirtualHost>
```


### Restart Apache Server 
```
sudo a2ensite neetastudio.in.conf
sudo systemctl reload apache2

#
sudo a2enmod rewrite
sudo a2enmod actions
sudo systemctl restart apache2
sudo systemctl status apache2
```

### /var/www/neetastudio.in/controllers/.htaccess
RewriteEngine On
RewriteBase /controllers
RewriteCond %{REQUEST_FILENAME} !-f
RewriteCond %{REQUEST_FILENAME} !-d
RewriteRule ^ index.php [QSA,L]

### /var/www/neetastudio.in/.htaccess (Optional)
RewriteEngine on
RewriteRule ^$ neetastudio.in/ [L]
RewriteRule (.*) neetastudio.in/$1 [L]

### setup php-debugger
sudo apt install php-xdebug


#### Install required packages
```
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
composer require phpoffice/phpspreadsheet
#
composer require php-di/php-di
```

###
http://neetastudio.in/phpinfo.php

###
http://neetastudio.in

###
http://neetastudio.in/controllers/hello/brijesh