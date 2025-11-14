<?php

class OnclickEnv {

    public static function getEnvName() {
        if (self::isWebRequest()) {
            return $_SERVER['APP_ENV'];
        } else {
            return $_ENV['APP_ENV'];
        }
    }

    public static function isWebRequest() {
        return isset($_SERVER['HTTP_USER_AGENT']);
    }

    public static function getAppName() {
        if (self::isWebRequest()) {
            return $_SERVER['APP_NAME'];
        } else {
            return $_ENV['APP_NAME'];;
        }
        
    }

    public static function getRepositoryPath() {
        $env = OnclickEnv::getEnvName();
        $repopath = "/apps/sandbox/sftp/{$env}/";
        return strtolower($repopath);
    }

    public static function getDomain() {

        $domain = CONSTANTS::ONCLICK_APP_NAME;
        return $domain;
    
    }

    public static function getRepoDomain() {
        $domain = "";
        switch (self::getEnvName()) {
            case CONSTANTS::ONCLICK_PROD:
                $domain = 'http://neetastudio.in';
                break;
            case CONSTANTS::ONCLICK_UAT:
                $domain = 'http://neetastudio.in';
                break;
            case CONSTANTS::ONCLICK_SIT:
                $domain = 'http://neetastudio.in';
                break;
            case CONSTANTS::ONCLICK_TEST:
                $domain = 'http://neetastudio.in';
                break;
            case CONSTANTS::ONCLICK_DEV:
                $domain = 'http://neetastudio.in';
                break;
            default:
                $domain = 'http://neetastudio.in';
                break;
        }
        return $domain;
    }
    
    public static function getFtpHotInfo() {
        $ftpinfo = new FTPInfo();
        switch (self::getEnvName()) {
            case CONSTANTS::ONCLICK_PROD:
                $ftpinfo->setRemoteHost("docker.sandbox.net");
                $ftpinfo->setRemoteUser("brijeshdhaker");
                $ftpinfo->setRemotePasswd("Accoo7@k47");
                break;
            case CONSTANTS::ONCLICK_UAT:
                $ftpinfo->setRemoteHost("docker.sandbox.net");
                $ftpinfo->setRemoteUser("brijeshdhaker");
                $ftpinfo->setRemotePasswd("Accoo7@k47");
                break;
            case CONSTANTS::ONCLICK_SIT:
                $ftpinfo->setRemoteHost("docker.sandbox.net");
                $ftpinfo->setRemoteUser("brijeshdhaker");
                $ftpinfo->setRemotePasswd("Accoo7@k47");
                break;
            case CONSTANTS::ONCLICK_DEV:
                $ftpinfo->setRemoteHost("docker.sandbox.net");
                $ftpinfo->setRemoteUser("brijeshdhaker");
                $ftpinfo->setRemotePasswd("Accoo7@k47");
                break;
            default:
                $ftpinfo->setRemoteHost("docker.sandbox.net");
                $ftpinfo->setRemoteUser("brijeshdhaker");
                $ftpinfo->setRemotePasswd("Accoo7@k47");
                break;
        }
        return $ftpinfo;
    }
    
    public function serverProperties() {
        $indicesServer = array(
            'PHP_SELF',
            'argv',
            'argc',
            'GATEWAY_INTERFACE',
            'SERVER_ADDR',
            'SERVER_NAME',
            'SERVER_SOFTWARE',
            'SERVER_PROTOCOL',
            'REQUEST_METHOD',
            'REQUEST_TIME',
            'REQUEST_TIME_FLOAT',
            'QUERY_STRING',
            'DOCUMENT_ROOT',
            'HTTP_ACCEPT',
            'HTTP_ACCEPT_CHARSET',
            'HTTP_ACCEPT_ENCODING',
            'HTTP_ACCEPT_LANGUAGE',
            'HTTP_CONNECTION',
            'HTTP_HOST',
            'HTTP_REFERER',
            'HTTP_USER_AGENT',
            'HTTPS',
            'REMOTE_ADDR',
            'REMOTE_HOST',
            'REMOTE_PORT',
            'REMOTE_USER',
            'REDIRECT_REMOTE_USER',
            'SCRIPT_FILENAME',
            'SERVER_ADMIN',
            'SERVER_PORT',
            'SERVER_SIGNATURE',
            'PATH_TRANSLATED',
            'SCRIPT_NAME',
            'REQUEST_URI',
            'PHP_AUTH_DIGEST',
            'PHP_AUTH_USER',
            'PHP_AUTH_PW',
            'AUTH_TYPE',
            'PATH_INFO',
            'ORIG_PATH_INFO'
        );

        echo '<table cellpadding="10">';
        foreach ($indicesServer as $arg) {
            if (isset($_SERVER[$arg])) {
                echo '<tr><td>' . $arg . '</td><td>' . $_SERVER[$arg] . '</td></tr>';
            } else {
                echo '<tr><td>' . $arg . '</td><td>-</td></tr>';
            }
        }
        echo '</table>';
    }

}

?>