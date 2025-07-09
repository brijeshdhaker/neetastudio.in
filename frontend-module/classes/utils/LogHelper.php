<?php
/**
 * Description of LogHelper
 *
 * @author brijeshdhaker
 */
class LogHelper {
    
    private static $issetup = FALSE;
    public static $isenable = TRUE;
    /**
     * @return the environment
     */
    public static function  init($logger='root') {
        
        $env = OnclickEnv::getEnvName();
        $logdir ="/logs/";
        $logfile="creativelights";
                
        $logconfig = array(
            'threshold' => 'ALL',
            'rootLogger' => array(
                'level'=>'INFO',
                'appenders' => array('file-appender')
            ),
            'logger'=>array(
                'name'=>'err-logger',
                'level'=>'ERROR',
                'appenders'=>array('err-appender')
            ),
            'appenders' => array(
                'default' => array(
                    'class' => 'LoggerAppenderFile',
                    'layout' => array(
                        'class' => 'LoggerLayoutSimple'
                    ),
                    'params' => array(
                        'file' => $logdir.$logfile.'-default.log',
                        'append' => FALSE
                    )
                ),
                'file-appender' => array(
                    'class' => 'LoggerAppenderDailyFile',
                    'layout' => array(
                        'class' => 'LoggerLayoutPattern',
                        'params' => array(
                            'conversionPattern'=>'%date [%logger] %message%newline'
                        )
                    ),
                    'params' => array(
                        'file' => $logdir.$logfile.'-%s.log',
                        'append' => FALSE,
                        'datePattern'=>'Y-m-d'
                    )
                ),
                'err-appender' => array(
                    'class' => 'LoggerAppenderDailyFile',
                    'layout' => array(
                        'class' => 'LoggerLayoutPattern',
                        'params' => array(
                            'conversionPattern'=>'%date [%logger] %message%newline'
                        )
                    ),
                    'params' => array(
                        'file' => $logdir.$logfile.'-err-%s.log',
                        'append' => FALSE,
                        'datePattern'=>'Y-m-d'
                    )
                )
            )
        );
        
        if(!self::$issetup){
            Logger::configure($logconfig);
            self::$issetup = TRUE;
        }
    }
    /* 
     * 
     */
    public static function disableLog(){
        self::$isenable = FALSE;
    }
    /* 
     * 
     */
    public static function enableLog(){
        self::$isenable = TRUE;
    }
}
