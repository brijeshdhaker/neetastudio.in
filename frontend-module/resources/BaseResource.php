<?php
/*
 *  Put all include in the file.
 */
#set_include_path ($_SERVER["DOCUMENT_ROOT"].'/includes');

date_default_timezone_set('UTC');

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
require('../classes/social/SocialMediaClient.php');
require('../classes/social/FacebookClient.php');
require('../classes/social/GoogleClient.php');
require('../classes/social/LinkedInClient.php');
require('../classes/social/TwitterClient.php');
require('../classes/social/SocialMediaClientFactory.php');

//
require('../classes/ftp/FTPInfo.php');
require('../classes/ftp/FTPUtil.php');
require('../classes/ftp/FTPProcessor.php');
require('../classes/ftp/SFTPProcessor.php');

//
require('../services/BaseService.php');
require('../services/CommonServices.php');
require('../services/RegistrationService.php');

//
LogHelper::init();
//
//CacheHelper::init();
//$cache = phpFastCache();
phpFastCache::setup("storage","auto");
//
?>