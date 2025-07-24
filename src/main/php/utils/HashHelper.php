<?php
class HashHelper {
    
    //displayAll('ripemd160', 'The quick brown fox jumped over the lazy dog.');
    //ec457d0a974c48d5685a7efa03d137dc8bbde7e3
    public static function displayAll($data) {
        foreach (hash_algos() as $v) {
            $r = hash($v, $data, false);
            printf("%-12s %3d %s\n", $v, strlen($r), $r);
        } 
    }
    
    /**
     * 
     * @param type $value
     * @param type $password
     * @param type $remember
     * @param type $logintype
     * @return boolean
     */
    public static function generate($saltvalue) {
        $user = unserialize($_SESSION['user_info']);
        $clientid = (isset($user) && !empty($user)) ? $user->getUserID() : "";
        $apikey = (isset($user) && !empty($user)) ? $user->getApikey() : CONSTANTS::DEFAULT_API_KEY;
        $apisecret = (isset($user) && !empty($user)) ? hash('sha256',$user->getApisecrate(),false) : hash('sha256',CONSTANTS::DEFAULT_API_SECRET,false);
        //$apikeypart = substr($apikey,0,$saltvalue);
        //$apisecretpart = substr($apisecret,0,$saltvalue);
        if(isset($clientid) && $clientid != ''){
            $token = $clientid.'@'.$saltvalue.'$'.$apikey.'#'.$apisecret;
        }else{
            $token = CONSTANTS::DEFAULT_CLIENT_ID.'@'.$saltvalue.'$'.$apikey.'#'.$apisecret;
        }
        $hash  = hash('sha256', $token, false);
        return $hash;    
    }
    
}
