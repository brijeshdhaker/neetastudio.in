<?php
/**
 * Description of PasswordHelper
 * @author brijeshdhaker
 */
class PasswordHelper {
    
    /**
     * 
     * @param type $password
     * @return string
     */
    public static function validate($passwd,$rpasswd) {
        $vmessages = array();
        if (is_null($passwd) && $passwd == "") {
            array_push($vmessages,"Please check current password can not be blank.");  
        }
        
        if (is_null($rpasswd) && $rpasswd == "") {
           array_push($vmessages,"Please check repeat password can not be blank.");  
        }
        
        if (strcasecmp($passwd, $rpasswd) != 0) {
           array_push($vmessages,"Please check your passwords are not matching.");  
        }
        return $vmessages;
    }
    
    /**
     * 
     * @param type $password
     * @return string
     */
    public static function getPasswdHash($password) {
        if (!is_null($password) && $password != "") {
            // A higher "cost" is more secure but consumes more processing power
            $cost = 10;
            // Create a random salt
            //$salt = strtr(base64_encode(mcrypt_create_iv(16, MCRYPT_DEV_URANDOM)), '+', '.');
            $salt = OnclickUtils::alphaNumericRandom(22);
            // Prefix information about the hash so PHP knows how to verify it later.
            // "$2a$" Means we're using the Blowfish algorithm. 
            // The following two digits are the cost parameter.
            $salt = sprintf("$2a$%02d$", $cost) . $salt;
            $hash = crypt($password, $salt);
            return $hash;
        } else {
            return "";
        }
    }
    
    /**
     * 
     * @param type $passwd
     * @param type $hash
     * @return boolean
     */
    public static function validatePasswd($passwd,$hash){
        if (crypt($passwd, $hash) == $hash) {
            return TRUE;  
        }else{
            return FALSE;
        }
    }
}
