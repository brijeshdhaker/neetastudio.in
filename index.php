<?php

   date_default_timezone_set('UTC');
   
   /*
   //include autoloader
   require __DIR__ . '/vendor/autoload.php';
   
   //Set the configuration file
   Logger::configure(array(
      'rootLogger' => array(
         'appenders' => array('default'),
      ),
      'appenders' => array(
         'default' => array(
               'class' => 'LoggerAppenderFile',
               'layout' => array(
                  'class' => 'LoggerLayoutSimple'
               ),
               'params' => array(
                  'file' => '/var/log/neetastudio.log',
                  'append' => true
               )
         )
      )
   ));

   //Create logger basename(__FILE__)
   $logger = Logger::getLogger('default');

   //Log message
   $logger->info("Message to be logged");
   $logger->info('Testing');
   */

   header("location: /htmls/home.php?_dc=fdfs&page=home&sTgt=site");
   
?>