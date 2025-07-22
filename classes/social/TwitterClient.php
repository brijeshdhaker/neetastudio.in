<?php
/**
 * Description of TwitterClient
 * @author brijeshdhaker
 */
class TwitterClient extends SocialMediaClient {
    
    static $TWITTER_KEYS = array(
        "DEV"=>array(
            "key"=>"m8dz0ap7Cy1I8LFj9deseS19o",
            "secret"=>"IV2CzwxbBXE4aOO6a1sKj8O4hBKCiz16QyOHBj0tqgE3z0oxMk"
        ),
        "UAT"=>array(
            "key"=>"m8dz0ap7Cy1I8LFj9deseS19o",
            "secret"=>"IV2CzwxbBXE4aOO6a1sKj8O4hBKCiz16QyOHBj0tqgE3z0oxMk"
        ),
        "PROD"=>array(
            "key"=>"q56J2EEblrHhE5NylLAWFnpxV",
            "secret"=>"dK5qVTtPJtWNv2RBRm8qAMoJ2ZjbQvyKyg6cxri3INdAkrBn5K"
        )
    );
    
    public function __construct() {
        
        $this->setupDefaults();
        $tw_keys = self::$TWITTER_KEYS[OnclickEnv::getEnvName()];
        $client->server = 'Twitter';
        $this->client->client_id = $tw_keys['key'];
        $this->client->client_secret = $tw_keys['secret'];
        
    }
    
    
    public function importProfile($request, &$response) {
        $success = $this->client->CallAPI(
            'https://api.twitter.com/1.1/users/show.json',
            'GET', 
            array(), 
            array('FailOnAccessError' => true), 
            $response
        );
        if($success){
            $success = $this->client->Finalize($success);
        }
        //
        if ($this->client->exit) {
            exit;
            return false;
        }else{
            return $success;
        }
    }
    
    public function shareJobPost($request, &$response) {
        
    }
}
