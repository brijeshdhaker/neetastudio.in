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
        $logdir ="/var/log/neetastudio.in/";
        $logfile="neetastudio";
                
        $logconfig = array(
            'threshold' => 'ALL',
            'rootLogger' => array(
                'level'=>'INFO',
                'appenders' => array('file-appender')
            ),
            'loggers' => array(
                'default-logger' => array(
                    'level' => 'INFO',
                    'appenders' => array('file-appender'),
                ),
                'dev-logger' => array(
                    'level' => 'INFO',
                    'appenders' => array('file-appender'),
                ),
                'test-logger' => array(
                    'level' => 'WARN',
                    'appenders' => array('file-appender'),
                ),
                'prod-logger' => array(
                    'level' => 'ERROR',
                    'appenders' => array('err-file-appender'),
                ),
            ),
            'appenders' => array(
                'default' => array(
                    'class' => 'LoggerAppenderEcho',
                    'layout' => array(
                        'class' => 'LoggerLayoutPattern',
                        'conversionPattern' => "%d{Y-m-d H:i:s} %-5p %c %X{username}: %m in %F at %L%n",
                    )
                ),
                'console-appender' => array(
                    'class' => 'LoggerAppenderConsole',
                    'layout' => array(
                        'class' => 'LoggerLayoutPattern',
                        'params' => array(
                            'conversionPattern'=>'%date [%logger] [%level] %message%newline'
                        )
                    ),
                    'params' => array(
                        'target' => 'STDOUT',
                        'append' => true,
                        'datePattern'=>'Y-m-d'
                    )
                ),
                'file-appender' => array(
                    'class' => 'LoggerAppenderDailyFile',
                    'layout' => array(
                        'class' => 'LoggerLayoutPattern',
                        'params' => array(
                            'conversionPattern'=>'%date [%logger] [%level] %message%newline'
                        )
                    ),
                    'params' => array(
                        'file' => $logdir.$logfile.'-%s.log',
                        'append' => true,
                        'datePattern'=>'Y-m-d'
                    )
                ),
                'err-file-appender' => array(
                    'class' => 'LoggerAppenderDailyFile',
                    'layout' => array(
                        'class' => 'LoggerLayoutPattern',
                        'params' => array(
                            'conversionPattern'=>'%date [%logger] [%level] %message%newline'
                        )
                    ),
                    'params' => array(
                        'file' => $logdir.$logfile.'-err-%s.log',
                        'append' => true,
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
