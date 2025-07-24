<?php
/**
 * Description of LinkedInClient
 * @author brijeshdhaker
 */
class FacebookClient extends SocialMediaClient {
    
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
    
    public function __construct() {
        $this->setupDefaults();
        $fb_keys = self::$FACEBOOK_KEYS[OnclickEnv::getAppName()];
        $this->client->server = 'Facebook';
        $this->client->scope = 'email publish_actions';
        $this->client->client_id = $fb_keys['key'];
        $this->client->client_secret = $fb_keys['secret'];
        
    }
    
    public function importProfile($request, &$response) {
        
        $success = $this->client->CallAPI(
            'https://graph.facebook.com/me', 
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
        
        $jobdt = OnclickUtils::getProperty('jobdetail', $request);
        if(!OnclickUtils::isEmpty($jobdt)){
            $comment = "{$jobdt['emp_name']} looking for great telent If you are interested..see details on below link";
            $description = "Skills {$jobdt['skills']} with mini exp {$jobdt['experience']} Yr for {$jobdt['role_name']} .";
            $host = OnclickEnv::getDomain();
            $data = array(
                "message" => $comment,
                "description"=>$description,
                "link"=>"http://onclickonline.com/onclickresume/html/jobseeker/show-postdetail.php?postid={$jobdt['postid']}&ispreview=n&rTyp=20&uTyp=s&page=detail&sTgt=site",
                "picture"=>$host."/static/resume/onclick-resumes.png",
                "name"=> $jobdt['title'],
                "caption"=>"Post By : {$jobdt['hr_name']}"
            );
                
            $success = $this->client->CallAPI(
                'https://graph.facebook.com/me/feed', 
                'POST', 
                $data, 
                array('FailOnAccessError' => true), 
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
        $jobdt = OnclickUtils::getProperty('jobdetail', $request);
        if(!OnclickUtils::isEmpty($jobdt)){
            $comment = "{$jobdt['emp_name']} looking for great telent If you are interested..see details on below link";
            $description = "Skills {$jobdt['skills']} with mini exp {$jobdt['experience']} Yr for {$jobdt['role_name']} .";
            $host = OnclickEnv::getDomain();
            $data = array(
                "message" => $comment,
                "description"=>$description,
                "link"=>"http://onclickonline.com/onclickresume/html/jobseeker/show-postdetail.php?postid={$jobdt['postid']}&ispreview=n&rTyp=20&uTyp=s&page=detail&sTgt=site",
                "picture"=>$host."/static/resume/onclick-resumes.png",
                "name"=> $jobdt['title'],
                "caption"=>"Post By : {$jobdt['hr_name']}"
            );
                
            $success = $this->client->CallAPI(
                'https://graph.facebook.com/me/feed', 
                'POST', 
                $data, 
                array('FailOnAccessError' => true), 
                $response
            );
            
            if($success){
                $response->message = 'Job details succefully shared on facebook.';
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
            $response->message = 'System Error while share Job Details on facebook.';
            $response->setStatus(FALSE);
            return false;
        }
    }
}
