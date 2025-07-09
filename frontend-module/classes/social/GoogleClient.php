<?php
/**
 * Description of GoogleClient
 * @author brijeshdhaker
 */
class GoogleClient extends SocialMediaClient {
    
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
    
    public function __construct() {
        
        $this->setupDefaults();
        $google_keys = self::$GOOGLE_KEYS[OnclickEnv::getAppName()];
        
        $this->client->server = 'Google';
        //$this->client->offline = false;
        
        $this->client->scope = 'https://www.googleapis.com/auth/plus.login '.
        'https://www.googleapis.com/auth/plus.me '.
        'https://www.googleapis.com/auth/plus.stream.write ';
        //'https://www.googleapis.com/auth/plus.media.upload '.
        //'https://www.googleapis.com/auth/userinfo.profile '
        //'https://www.googleapis.com/auth/contacts.readonly '.        
        //'https://www.googleapis.com/auth/userinfo.email '.;
        
        $this->client->client_id = $google_keys['key'];
        $this->client->client_secret = $google_keys['secret'];
        
    }
    
    
    public function importProfile($request, &$response) {
        
        $success = $this->client->CallAPI(
            'https://www.googleapis.com/userinfo/v2/me',
            'GET', 
            array(), 
            array(), 
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
        
        $jobdt = OnclickUtils::getProperty('jobdetail', $request);
        if(!OnclickUtils::isEmpty($jobdt)){
            //$comment = "{$jobdt['emp_name']} looking for great telent If you are interested..see details on below link";
            //$description = "Skills {$jobdt['skills']} with mini exp {$jobdt['experience']} Yr for {$jobdt['role_name']} .";
            $dataJson = '{"object": {"attachments": [{"url": "http://onclickonline.com", "objectType": "article"}], "originalContent": "Happy Monday! #caseofthemondays" }, "access": {"items": [{ "type": "domain" },{ "type": "extendedCircles" },{"type": "myCircles"}], "domainRestricted": true}}';
            $success = $this->client->CallAPI(
                'https://www.googleapis.com/plusDomains/v1/people/me/activities', 
                'POST', 
                array(), 
                array(
                    'RequestHeaders' => array(
                        'Content-Type' => 'application/json',
                        'x-li-format' => 'json'
                    ),
                    'RequestContentType' => 'application/json',
                    'RequestBody' =>$dataJson,
                    'FailOnAccessError' => true,
                    'ConvertObjects' => false
                ),  
                $response
            );
            if($success){
                $response->message = 'Job Details Succefully shared.';
                $success = $this->client->Finalize($success);
            }else{
                $response->message = 'Error while share Job Details..';
            }
            //
            if ($this->client->exit) {
                exit;
                return false;
            }else{
                return $success;
            }
        }else{
            $response = new RestResponse();
            $response->message = 'System Error while share Job Details.';
            $response->setStatus(FALSE);
            return false;
        }
    }
    
    public function publishJobPost($request, &$response) {
        $response = new RestResponse();
        $response->message = 'System Error while share Job Details on Google.';
        $response->setStatus(FALSE);
    }
}
