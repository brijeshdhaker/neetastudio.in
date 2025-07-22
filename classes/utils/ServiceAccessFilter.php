<?php
/**
 * Description of SessionHelper
 * @author brijeshdhaker
 */
class ServiceAccessFilter {
    
    private static $dbHelper;
    
    private static function getDBHelper(){
        if(is_null(ServiceAccessFilter::$dbHelper)){
            ServiceAccessFilter::$dbHelper = new PDOHelper();
        }
        return ServiceAccessFilter::$dbHelper;
    }
    
    /**
     * 
     * @param type $value
     * @param type $password
     * @param type $remember
     * @param type $logintype
     * @return boolean
     */
    public static function validate($context,$iscore=FALSE) {
        $sysapikey = null;
        $sysapisecret = null;
        
        if(isset($context)) {
            $clientid    = $context['clientid'];
            $salt        = $context['salt'];
            $clienthash  = $context['hash'];
            // Checking for Core Data Access Autorization
            if($iscore && ($clientid == null || $clientid == '' || ($clientid == CONSTANTS::DEFAULT_CLIENT_ID))){
                return FALSE;
            }
            
            // Checking for Core Data Access Autorization
            if(($clientid != null) || ($clientid != '')){
                // Start Login & Validation Process
                $query = "SELECT USERID, API_KEY, API_SECRET FROM USERS WHERE USERID = ".$clientid.";";
                $dbHelper = self::getDBHelper();
                $result = $dbHelper->execute($query,PDO::FETCH_OBJ,FALSE);
                if($result){
                    $sysapikey    = $result->API_KEY;
                    $sysapisecret = $result->API_SECRET;
                }
            }else{
                $sysapikey    = CONSTANTS::DEFAULT_API_KEY;
                $sysapisecret = CONSTANTS::DEFAULT_API_SECRET;
            }
            //
            if(!isset($clientid) || $clientid == ''){
                $clientid = CONSTANTS::DEFAULT_CLIENT_ID;
            }
            //
            $token = $clientid.'@'.$salt.'$'.$sysapikey.'#'.hash('sha256',$sysapisecret,false);
            $serverhash  = hash('sha256', $token, false);
            //
            if(strcmp($serverhash, $clienthash) != 0){
                return FALSE;
            }else{
                return TRUE;
            }
                
        }else{
            return FALSE;
        }
    }
    /*

    */
    public static function validateGetRequest($iscore=FALSE) {
        $context = null;
        $context["clientid"] = $_GET["clientid"] ? $_GET["clientid"] : NULL;
        $context["salt"] = $_GET["salt"] ? $_GET["salt"] : NULL;
        $context["hash"] = $_GET["hash"] ? $_GET["hash"] : NULL;
        return ServiceAccessFilter::validate($context, $iscore);
    }
    
    /*

    */
    public static function validatePostRequest($iscore=FALSE) {
        $context = null;
        $context["clientid"] = $_POST["clientid"] ? $_POST["clientid"] : NULL;
        $context["salt"]     = $_POST["salt"] ? $_POST["salt"] : NULL;
        $context["hash"]     = $_POST["hash"] ? $_POST["hash"] : NULL;
        return ServiceAccessFilter::validate($context, $iscore);
    }
    
    /*

    */
    public static function validateJsonRequest($json, $iscore=FALSE) {
        $context = null;
        if(isset($json) && !is_null($json)){
            $context["clientid"] = $json->{"clientid"} ? $json->{"clientid"} : NULL;
            $context["salt"]     = $json->{"salt"} ? $json->{"salt"} : NULL;
            $context["hash"]     = $json->{"hash"} ? $json->{"hash"} : NULL;
        }
        return ServiceAccessFilter::validate($context, $iscore);
    }
    
    /*

    */
    public static function validateHeader($iscore=FALSE) {
        $context = null;
        //getallheaders()
        //apache_request_headers()
        //nsapi_request_headers()
        $url = 'http://jobseekers.onclickonline.com';
        foreach (get_headers($url, 1) as $name => $value) {
            if((strcmp($name, 'hash') == 0) 
                    || (strcmp($name, 'salt') == 0) 
                    || (strcmp($name, 'clientid') == 0)){
                $context[$name] = $value;
            }
        }
        return ServiceAccessFilter::validate($context, $iscore);
    }
    
}
