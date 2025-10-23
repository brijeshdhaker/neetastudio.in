<?php
/*
 * To change this license header, choose License Headers in Project Properties.
 * To change this template file, choose Tools | Templates
 * and open the template in the editor.
 */
/**
 * @author brijeshdhaker
 */
//ini_set('include_path', ini_get('include_path').PATH_SEPARATOR.dirname(__FILE__).'/apps/php5.6/includes');
ini_set('include_path', ini_get('include_path'));

// Default Time Zone
date_default_timezone_set('Asia/Kolkata');
//date_default_timezone_set('UTC');

//
require __DIR__ . '/vendor/autoload.php';

/*
 * 
 */
require(__DIR__ . '/src/main/php/CONSTANTS.php');
require(__DIR__ . '/src/main/php/OnclickEnv.php');
require(__DIR__ . '/src/main/php/userinfo.php');
require(__DIR__ . '/src/main/php/onclickresponse.php');

// File Transfer Processor
require(__DIR__ . '/src/main/php/ftp/FTPInfo.php');
require(__DIR__ . '/src/main/php/ftp/FTPUtil.php');
require(__DIR__ . '/src/main/php/ftp/FTPProcessor.php');
require(__DIR__ . '/src/main/php/ftp/SFTPConnection.php');
require(__DIR__ . '/src/main/php/ftp/SFTPProcessor.php');

//
require(__DIR__ . '/src/main/php/dao/DBHelper.php');
require(__DIR__ . '/src/main/php/dao/DataSourceInfo.php');
require(__DIR__ . '/src/main/php/dao/PDOHelper.php');
require(__DIR__ . '/src/main/php/dao/MappingHelper.php');

//
require(__DIR__ . '/src/main/php/utils/CacheHelper.php');
require(__DIR__ . '/src/main/php/utils/DocumentHelper.php');
require(__DIR__ . '/src/main/php/utils/LogHelper.php');
require(__DIR__ . '/src/main/php/utils/OnclickUtils.php');
require(__DIR__ . '/src/main/php/utils/PagingHelper.php');
require(__DIR__ . '/src/main/php/utils/PasswordHelper.php');
require(__DIR__ . '/src/main/php/utils/ServiceAccessFilter.php');

//
require(__DIR__ . '/src/main/php/models/Message.php');
require(__DIR__ . '/src/main/php/models/OnclickUser.php');
require(__DIR__ . '/src/main/php/models/RestResponse.php');

// 
require(__DIR__ . '/src/main/php/email/MailHelper.php');
require(__DIR__ . '/src/main/php/email/Notification.php');
require(__DIR__ . '/src/main/php/email/NotificationConfig.php');
require(__DIR__ . '/src/main/php/email/NotificationEngine.php');

//
require(__DIR__ . '/src/main/php/services/BaseService.php');
require(__DIR__ . '/src/main/php/services/BookingService.php');
require(__DIR__ . '/src/main/php/services/ContactusService.php');
require(__DIR__ . '/src/main/php/services/RegistrationService.php');
require(__DIR__ . '/src/main/php/services/SubscribeService.php');
require(__DIR__ . '/src/main/php/services/CollaborationService.php');

// // Configure log4php 
LogHelper::init();

// Get a logger instance
$logger = Logger::getLogger('default-logger'); // Or Logger::getLogger('root') for the root logger

//
//$cache = phpFastCache();
//phpFastCache::setup("storage","auto");

$script_tz = date_default_timezone_get();
$logger->info("default timezone ". $script_tz);
/*
if (strcmp($script_tz, ini_get('date.timezone'))){
    echo 'Script timezone differs from ini-set timezone.';
} else {
    echo 'Script timezone and ini-set timezone match.';
}
*/
?>
