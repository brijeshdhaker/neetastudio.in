<?php

class OnclickEnv {

    public static function getEnvName() {
        if (self::isWebRequest()) {
            return $_SERVER['APP_ENV'];
        } else {
            return CONSTANTS::ONCLICK_DEV;
        }
    }

    public static function isWebRequest() {
        return isset($_SERVER['HTTP_USER_AGENT']);
    }

    public static function getAppName() {
        if (self::isWebRequest()) {
            return $_SERVER['APP_NAME'];
        } else {
            return CONSTANTS::ONCLICK_APP_ONLINE;
        }
    }

    public static function getRepositoryPath() {
        $env = OnclickEnv::getEnvName();
        $repopath = "/export/repository/{$env}/";
        return $repopath;
    }

    public static function getDomain() {
        $domain = "http://neetastudio.in";
        if (self::isWebRequest()) {
            $domain = "http://".$_SERVER['SERVER_NAME'];
        }
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
                $ftpinfo->setRemoteHost("olprdsrv.neetastudio.in");
                $ftpinfo->setRemoteUser("batchuser");
                $ftpinfo->setRemotePasswd("accoo7ak47");
                break;
            case CONSTANTS::ONCLICK_UAT:
                $ftpinfo->setRemoteHost("oluatsrv.neetastudio.in");
                $ftpinfo->setRemoteUser("batchuser");
                $ftpinfo->setRemotePasswd("accoo7ak47");
                break;
            case CONSTANTS::ONCLICK_SIT:
                $ftpinfo->setRemoteHost("oluatsrv.neetastudio.in");
                $ftpinfo->setRemoteUser("batchuser");
                $ftpinfo->setRemotePasswd("accoo7ak47");
                break;
            case CONSTANTS::ONCLICK_DEV:
                $ftpinfo->setRemoteHost("oluatsrv.neetastudio.in");
                $ftpinfo->setRemoteUser("batchuser");
                $ftpinfo->setRemotePasswd("accoo7ak47");
                break;
            default:
                $ftpinfo->setRemoteHost("olprdsrv.neetastudio.in");
                $ftpinfo->setRemoteUser("batchuser");
                $ftpinfo->setRemotePasswd("accoo7ak47");
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