<?php
/**
 * Description of CommonServices
 *
 * @author brijeshdhaker
 */
class SubscribeService extends BaseService {
    
    //
    private $logger;
    
    /**
     * @return the environment
     */
    function __construct() {
        $this->logger = Logger::getLogger('SubscribeService');
    }
    
    /**
     * 
     * @param type $request
     * @param type $response
     */
    public function forNewletter($request, &$response) {
        //
        $this->logger->info('-- SubscribeServices::forNewletter -- ');
        //
        $status = TRUE;
        try {
            
            if(OnclickUtils::isEmpty($request)){
               throw new Exception("Request can't be blank."); 
            }
            
            //
            $results = $this->processSubscriptionRequest($request, "news-letter");
            
            //
            $status = $this->sendSubscriptionEmail($results, "news-letter");
            
        } catch (Exception $exc) {
            $status = FALSE;
            $this->message = $exc->getTraceAsString();
            $this->logger->info("Error occurred - ". $exc->getTraceAsString());
        }
        
        //
        if ($status) {
            $this->logger->info("Booking request successfully processed.");
            $msg = Message::Success("Booking request successfully processed.");
            $response->addMessages($msg);
            $response->setMessage("Booking request successfully processed.");
            $response->setStatus(TRUE);
        } else {
            $this->logger->error("Error occurred while sending Email Notification.");
            $msg = Message::Warning("System error occurred while processing your request.");
            $response->addMessages($msg);
            $response->setMessage("System error occurred while processing your request.");
            $response->setStatus(FALSE);
        }
        
    }

    public function forCollaboration($request, &$response){
        //
        $this->logger->info('-- SubscribeServices::forCollaboration -- ');
        //
        $status = TRUE;
        try {
            
            if(OnclickUtils::isEmpty($request)){
               throw new Exception("Request can't be blank."); 
            }
            
            //
            $results = $this->processSubscriptionRequest($request, "collaboration");
            
            //
            $status = $this->sendSubscriptionEmail($results, "collaboration");
            
        } catch (Exception $exc) {
            $status = FALSE;
            $this->message = $exc->getTraceAsString();
            $this->logger->info("Error occurred - ". $exc->getTraceAsString());
        }
        
        //
        if ($status) {
            $this->logger->info("Collaboration request successfully processed.");
            $msg = Message::Success("Collaboration request successfully processed.");
            $response->addMessages($msg);
            $response->setMessage("Collaboration request successfully processed.");
            $response->setStatus(TRUE);
        } else {
            $this->logger->error("Error occurred while sending email Notification.");
            $msg = Message::Warning("System error occurred while processing your request.");
            $response->addMessages($msg);
            $response->setMessage("System error occurred while processing your request.");
            $response->setStatus(FALSE);
        }
        
    }
    
    
    private function processSubscriptionRequest($request, $type){
        
        $results = null;
        
        if(!OnclickUtils::isEmpty($request)){
            
            $first_name = OnclickUtils::getProperty('first_name', $request);
            $last_name = OnclickUtils::getProperty('last_name', $request);
            $name = OnclickUtils::getProperty('name', $request);
            $email = OnclickUtils::getProperty('email', $request);
            $phone = OnclickUtils::getProperty('phone', $request);
            $message = OnclickUtils::getProperty('message', $request);
            $rTyp = OnclickUtils::getProperty('rTyp', $request);
            $uTyp = OnclickUtils::getProperty('uTyp', $request);
            
            $mapping = array(
                "ID" => "id",
                "NAME" => "name",
                "EMAIL" => "email",
                "PHONE" => "phone",
                "MESSAGE" => "message",
                "ADD_TS" => "addTs"
            );
                    
            if($type == "news-letter"){
                $interest_type = OnclickUtils::getProperty('interest_type', $request);
                $mapping["INTERSET_TYPE"] = "interest_type";
                $procedure = "call proc_add_customer_subscription('".$name."', '".$email."', '".$phone."', '".$interest_type."', '".$message. "', @code, @message);";
            }
            
            if($type == "collaboration"){
                $service_type = OnclickUtils::getProperty('service_type', $request);
                $mapping["SERVICE"] = "service_type";
                $procedure = "call proc_add_partner_collaboration('".$name."', '".$email."', '".$phone."', '".$service_type."', '".$message. "', @code, @message);";
            }
                        
            //
            $dbHelper = self::getDAOHelper();
            $results = $dbHelper->processQuery($procedure, $mapping);
            
        }else {
            
            $this->logger->error("Error occured while processing enquiry request.");
            throw new Exception("Exception occured while processing enquiry request.");
        }
        
        return $results;
        
    }
    
    
    private function sendSubscriptionEmail($results, $type) {
        
        $status = TRUE;
        $tpl = "";
        
        if($type == "news-letter"){
            $tpl = file_get_contents(__DIR__ .'/../../resources/email-tpls/NEWS_LETTER_SUBSCRIPTION_EMAIL.html');
        }
        
        if($type == "collaboration"){
            $tpl = file_get_contents(__DIR__ .'/../../resources/email-tpls/PARTNER_COLLABORATION_EMAIL.html');
        }
        
        $ticket_id = $results['id'];
        if (!OnclickUtils::isEmpty($ticket_id) && !OnclickUtils::isEmpty($tpl)) {
            
            $first_name = $results['name'];
            $last_name = " ";
            $parts = explode(" ", $results['name']);
            if(count($parts) > 1) {
                $last_name = array_pop($parts);
                $first_name = implode(" ", $parts);
            }
            
            $tpl = str_replace("{{first_name}}", $first_name, $tpl);
            $tpl = str_replace("{{last_name}}", $last_name, $tpl);
            $tpl = str_replace("{{name}}", $results['name'], $tpl);
            $tpl = str_replace("{{email}}", $results['email'], $tpl);
            $tpl = str_replace("{{ticket_id}}", $ticket_id, $tpl);
            
            //
            $emailObj = new Notification();
            $emailObj->setTo($results['email']);
            $emailObj->setFrom("brijeshdhaker@gmail.com", "Neeta Studio Photography");
            $emailObj->setReplyTo("brijeshdhaker@gmail.com", "Neeta Studio Photography");
            
            if($type == "news-letter"){
                $tpl = str_replace("{{interest_type}}", $results['interest_type'], $tpl);
                $emailObj->setSubject("Newletter Subscription Request # 00".$ticket_id);
            }

            if($type == "collaboration"){
                $tpl = str_replace("{{service_type}}", $results['service_type'], $tpl);
                $emailObj->setSubject("Partner Collaboration Request # 00".$ticket_id);
            }
            
            $emailObj->setBody($tpl);
            //$emailObj->setFooter("This is Test Footer Message");
            //$emailObj->setCc("brijeshdhaker@gmail.com");
            $status = NotificationEngine::send($emailObj);

        } else {
            $status = FALSE;
            throw new Exception("Error occurred while sending booking confirmation email.");
        }
        
        return $status;
    }
}
