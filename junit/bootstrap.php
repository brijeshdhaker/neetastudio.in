<?php
/*
 * To change this license header, choose License Headers in Project Properties.
 * To change this template file, choose Tools | Templates
 * and open the template in the editor.
 */
/**
 * @author brijeshdhaker
 */
//ini_set('include_path', ini_get('include_path').PATH_SEPARATOR.dirname(__FILE__).'/../../../apps/php5.6/includes');
ini_set('include_path', ini_get('include_path'));

//set_include_path ('D:/export/vhosts/DEV/onclickonline.com/includes');
date_default_timezone_set('Asia/Kolkata');

// Insert the path where you unpacked log4php
require('log4php/Logger.php');
//
require('excel/PHPExcel/IOFactory.php');
//
require('fastcache/v2/phpfastcache.php');
//
require('oauth/http.php');
require('oauth/oauth_client.php');
//
require('phpmail/PHPMailerAutoload.php');

/*
 * 
 */
require('../classes/CONSTANTS.php');
require('../classes/OnclickEnv.php');
require('../classes/userinfo.php');
require('../classes/onclickresponse.php');
//
require('../classes/dao/DBHelper.php');
require('../classes/dao/DataSourceInfo.php');
require('../classes/dao/PDOHelper.php');
require('../classes/dao/MappingHelper.php');

//
require('../classes/utils/CacheHelper.php');
require('../classes/utils/DocumentHelper.php');
require('../classes/utils/LogHelper.php');
require('../classes/utils/OnclickUtils.php');
require('../classes/utils/PagingHelper.php');
require('../classes/utils/PasswordHelper.php');
require('../classes/utils/ServiceAccessFilter.php');

//
require('../classes/models/Message.php');
require('../classes/models/OnclickUser.php');
require('../classes/models/RestResponse.php');

// 
require('../classes/email/MailHelper.php');
require('../classes/email/Notification.php');
require('../classes/email/NotificationConfig.php');
require('../classes/email/NotificationEngine.php');

//
require '../services/BaseService.php';
require '../services/CommonServices.php';
require '../services/RegistrationService.php';

//
LogHelper::init();
//
//$cache = phpFastCache();
phpFastCache::setup("storage","auto");

$script_tz = date_default_timezone_get();

if (strcmp($script_tz, ini_get('date.timezone'))){
    echo 'Script timezone differs from ini-set timezone.';
} else {
    echo 'Script timezone and ini-set timezone match.';
}

?>
