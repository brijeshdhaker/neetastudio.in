<?php
/**
 * Description of SocialClientFactory
 * @author brijeshdhaker
 */
class SocialMediaClientFactory {
    
    static $LINKEDIN_KEYS = array(
        "RESUME"=>array(
            "key"=>"75lttkm22wqze1",
            "secret"=>"3ByE9SpWrluo1wVM"
        ),
        "ONLINE"=>array(
            "key"=>"78d0clkmj7u0s8",
            "secret"=>"4tUsqoGJbdAOjbEJ"
        ),
        "EMPLOYER"=>array(
            "key"=>"75pqyjccremze9",
            "secret"=>"eOz8RFAeEmDrmxic"
        )
    );
    
    static $FACEBOOK_KEYS = array(
        "RESUME"=>array(
            "key"=>"1412870355616385",
            "version"=>2.0,
            "secret"=>"8ba7ce1c492507df3bb98342ecda97db"
        ),
        "ONLINE"=>array(
            "key"=>"1547331085512289",
            "version"=>2.2,
            "secret"=>"775d31339dd19c93082b12995658862d"
        ),
        "EMPLOYER"=>array(
            "key"=>"1745530409004262",
            "client_token"=>"9076bf92a59c37765effb912d8b590d1",
            "version"=>2.5,
            "secret"=>"b62492b89c15c569d93553460bbe20bf"
        )
    );
    
    static $GOOGLE_KEYS = array(
        "RESUME"=>array(
            "key"=>"24639975402-u3o843k6rcppqeaidpte2f3jm55v5dfc.apps.googleusercontent.com",
            "secret"=>"XeQ0-OWTrLBPGk0IoyBuIpEK"
        ),
        "ONLINE"=>array(
            "key"=>"678770308800-q3121ogi4aan5nqnrslac7dusid08mf4.apps.googleusercontent.com",
            "secret"=>"QmkX7uttKMlcgeiStGjGEi45"
        ),
        "EMPLOYER"=>array(
            "key"=>"382109146264-b3bgmfd0rdpqpcdl29e21ln6ku9q3kfn.apps.googleusercontent.com",
            "secret"=>"mrwanhgMn0PzQu1amYRKdxH3"
        )
    );
    
    static function getSocialMediaClient($type) {
        $client = null;
        switch ($type) {
            case 'ln':
                $client = new LinkedInClient();
                break;
            case 'fb':    
                $client = new FacebookClient();
                break;
            case 'go':    
                $client = new GoogleClient();
                break;
            case 'tw':    
                $client = new TwitterClient();
                break;
        }
        return $client;
    }
    
    static function getOAuthClient($type) {
        $oAuthClient = new oauth_client_class;
        $oAuthClient->debug = false;
        $oAuthClient->debug_http = true;
        if (defined('OAUTH_PIN')) {
            $oAuthClient->pin = OAUTH_PIN;
        }
        switch ($type) {
            case 'ln':
                $keys = self::$LINKEDIN_KEYS[OnclickEnv::getAppName()];
                $oAuthClient->server = 'LinkedIn2';
                //r_fullprofile r_emailaddress r_contactinfo rw_nus
                $oAuthClient->scope = 'r_basicprofile r_emailaddress w_share';
                $oAuthClient->client_id = $keys['key'];
                $oAuthClient->client_secret = $keys['secret'];
                break;
            case 'fb':
                
                $keys = self::$FACEBOOK_KEYS[OnclickEnv::getAppName()];
                $oAuthClient->server = 'Facebook';
                $oAuthClient->scope = 'email publish_actions';
                $oAuthClient->client_id = $keys['key'];
                $oAuthClient->client_secret = $keys['secret'];
                
                break;
            case 'go': 
                
                $keys = self::$GOOGLE_KEYS[OnclickEnv::getAppName()];
                $oAuthClient->server = 'Google';
                $oAuthClient->offline = false;
                $oAuthClient->scope = 'https://www.googleapis.com/auth/userinfo.email '.
                'https://www.googleapis.com/auth/userinfo.profile '.
                'https://www.google.com/m8/feeds '.
                'https://www.googleapis.com/auth/contacts.readonly';
                $oAuthClient->client_id = $keys['key'];
                $oAuthClient->client_secret = $keys['secret'];
                
                break;
            case 'tw':    
                
                break;
        }
        
        return $oAuthClient;
    }
}
