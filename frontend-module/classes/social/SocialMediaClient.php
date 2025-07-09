<?php
/**
 * Description of SocialMediaClient
 * @author brijeshdhaker
 */
class SocialMediaClient {
    
    public $client;
    
    
    protected function setupDefaults(){
        
        $oAuthClient = new oauth_client_class;
        $oAuthClient->debug = false;
        $oAuthClient->debug_http = true;
        if (defined('OAUTH_PIN')) {
            $oAuthClient->pin = OAUTH_PIN;
        }
        //
        $this->client = $oAuthClient;
        
    }
    
    function setupCallbackURL($url){
        $this->client->redirect_uri = $url;
    }
    
    public function Initialize(){
        return $this->client->Initialize();
    }
    
    public function Finalize($success){
        return $this->client->Finalize($success);
    }
    
    function Process(){
        return $this->client->Process();
    }
    
    function Errors(){
        return $this->client->error;
    }
    
    function ShowOutput(){
        $this->client->Output();
    }
    
}
