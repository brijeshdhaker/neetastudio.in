<?php
/**
 * Description of LinkedInClient
 * @author brijeshdhaker
 */
class LinkedInClient extends SocialMediaClient {
    
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
    
    public function __construct() {
        
        $this->setupDefaults();
        $ln_keys = self::$LINKEDIN_KEYS[OnclickEnv::getAppName()];
        $this->client->server = 'LinkedIn2';
        //r_fullprofile r_emailaddress r_contactinfo rw_nus
        $this->client->scope = 'r_basicprofile r_emailaddress w_share';
        $this->client->client_id = $ln_keys['key'];
        $this->client->client_secret = $ln_keys['secret'];
        
    }
    
    
    
    public function importProfile($request, &$response) {
        if (strlen($this->client->access_token)) {
            $success = $this->client->CallAPI(
                'https://api.linkedin.com/v1/people/~:(first-name,last-name,picture-urls::(original),positions,email-address,phone-numbers)', 
                'GET', 
                array(), 
                array(
                    'RequestHeaders' => array(
                        'x-li-format' => 'json'
                    ), 
                    'RequestContentType' => 'application/json',
                    'FailOnAccessError' => true, 
                    'ConvertObjects' => false
                ), 
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
        
    }

    public function shareJobPost($request, &$response) {
        
        if (strlen($this->client->access_token)) {
            
            $jobdt = OnclickUtils::getProperty('jobdetail', $request);
            if(!OnclickUtils::isEmpty($jobdt)){
                $comment = "{$jobdt['emp_name']} looking for great telent If you are interested..see details on below link";
                $description = "Skills {$jobdt['skills']} with mini exp {$jobdt['experience']} Yr for {$jobdt['role_name']} .";
                $data = array(
                    "comment" => $comment,
                    "content" => array(
                        "title" => $jobdt['title'],
                        "description" => $description,
                        "submitted-url" =>"http://{$_SERVER['HTTP_HOST']}/onclickresume/html/jobseeker/show-postdetail.php?postid={$jobdt['postid']}&ispreview=n&rTyp=20&uTyp=s&page=detail&sTgt=site",
                        "submitted-image-url" => "http://{$_SERVER['HTTP_HOST']}/static/resume/onclick-resumes.png",
                    ),
                    "visibility" => array('code' => 'anyone')
                );
                //
                $success = $this->client->CallAPI(
                    'https://api.linkedin.com/v1/people/~/shares?format=json', 
                    'POST', 
                    array(), 
                    array(
                        'RequestHeaders' => array(
                            'Content-Type' => 'application/json',
                            'x-li-format' => 'json'
                        ),
                        'RequestContentType' => 'application/json',
                        'RequestBody' =>json_encode($data),
                        'FailOnAccessError' => true,
                        'ConvertObjects' => false
                    ), 
                    $response
                );
                
                if($success){
                    $response->message = 'Job Succefully published.';
                    $success = $this->client->Finalize($success);
                }else{
                    //$response  = $this->client->error;
                    $success = FALSE;
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
                $response->message = 'Job Succefully published.';
                $response->setStatus(FALSE);
            }
        }
    }
    
    public function publishJobPost($request, &$response) {
        
        if (strlen($this->client->access_token)) {
            
            $jobdt = OnclickUtils::getProperty('jobdetail', $request);
            if(!OnclickUtils::isEmpty($jobdt)){
                $comment = "{$jobdt['emp_name']} looking for great telent If you are interested..see details on below link";
                $description = "Skills {$jobdt['skills']} with mini exp {$jobdt['experience']} Yr for {$jobdt['role_name']} .";
                $data = array(
                    "comment" => $comment,
                    "content" => array(
                        "title" => $jobdt['title'],
                        "description" => $description,
                        "submitted-url" =>"http://{$_SERVER['HTTP_HOST']}/onclickresume/html/jobseeker/show-postdetail.php?postid={$jobdt['postid']}&ispreview=n&rTyp=20&uTyp=s&page=detail&sTgt=site",
                        "submitted-image-url" => "http://{$_SERVER['HTTP_HOST']}/static/resume/onclick-resumes.png",
                    ),
                    "visibility" => array('code' => 'anyone')
                );
                //
                $success = $this->client->CallAPI(
                    'https://api.linkedin.com/v1/people/~/shares?format=json', 
                    'POST', 
                    array(), 
                    array(
                        'RequestHeaders' => array(
                            'Content-Type' => 'application/json',
                            'x-li-format' => 'json'
                        ),
                        'RequestContentType' => 'application/json',
                        'RequestBody' =>json_encode($data),
                        'FailOnAccessError' => true,
                        'ConvertObjects' => false
                    ), 
                    $response
                );
                
                if($success){
                    $response->message = 'Your job succefully published on LinkedIn.';
                    $success = $this->client->Finalize($success);
                }else{
                    //$response  = $this->client->error;
                    $success = FALSE;
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
                $response->message = 'System Error while share Job Details on LinkedIn.';
                $response->setStatus(TRUE);
            }
        }
    }
}
