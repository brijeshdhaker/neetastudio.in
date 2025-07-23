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
//date_default_timezone_set('Asia/Kolkata');

//
require __DIR__ . '/../vendor/autoload.php';

/*
 * 
 */
require(__DIR__ . '/../classes/CONSTANTS.php');
require(__DIR__ . '/../classes/OnclickEnv.php');
require(__DIR__ . '/../classes/userinfo.php');
require(__DIR__ . '/../classes/onclickresponse.php');
//
require(__DIR__ . '/../classes/dao/DBHelper.php');
require(__DIR__ . '/../classes/dao/DataSourceInfo.php');
require(__DIR__ . '/../classes/dao/PDOHelper.php');
require(__DIR__ . '/../classes/dao/MappingHelper.php');

//
require(__DIR__ . '/../classes/utils/CacheHelper.php');
require(__DIR__ . '/../classes/utils/DocumentHelper.php');
require(__DIR__ . '/../classes/utils/LogHelper.php');
require(__DIR__ . '/../classes/utils/OnclickUtils.php');
require(__DIR__ . '/../classes/utils/PagingHelper.php');
require(__DIR__ . '/../classes/utils/PasswordHelper.php');
require(__DIR__ . '/../classes/utils/ServiceAccessFilter.php');

//
require(__DIR__ . '/../classes/models/Message.php');
require(__DIR__ . '/../classes/models/OnclickUser.php');
require(__DIR__ . '/../classes/models/RestResponse.php');

// 
require(__DIR__ . '/../classes/email/MailHelper.php');
require(__DIR__ . '/../classes/email/Notification.php');
require(__DIR__ . '/../classes/email/NotificationConfig.php');
require(__DIR__ . '/../classes/email/NotificationEngine.php');

//
require(__DIR__ . '/../services/BaseService.php');
require(__DIR__ . '/../services/BookingService.php');
require(__DIR__ . '/../services/ContactusService.php');
require(__DIR__ . '/../services/RegistrationService.php');
require(__DIR__ . '/../services/SubscribeService.php');

//
LogHelper::init();

//
//$cache = phpFastCache();
//phpFastCache::setup("storage","auto");

$script_tz = date_default_timezone_get();
/*
if (strcmp($script_tz, ini_get('date.timezone'))){
    echo 'Script timezone differs from ini-set timezone.';
} else {
    echo 'Script timezone and ini-set timezone match.';
}
*/
?>
