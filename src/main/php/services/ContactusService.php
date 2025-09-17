<?php
/**
 * Description of CommonServices
 *
 * @author brijeshdhaker
 */
class ContactusService extends BaseService {
    
    //
    private $logger;
    
    /**
     * @return the environment
     */
    function __construct() {
        $this->logger = Logger::getLogger('ContactusServices');
    }
    
    /**
     * 
     * @param type $request
     * @param type $response
     */
    public function contactUs($request, &$response){
        
        //
        $this->logger->info('-- ContactusServices::contactUs -- ');
        
        //
        $status = TRUE;
        $booking_id = rand(1000,9999);
        
        try {
            
            if(OnclickUtils::isEmpty($request)){
               throw new Exception("Request can't be blank."); 
            }
            
            //
            $results = $this->processEnquiry($request);
            
            //
            $status = $this->sendEnquiryEmail($results);
            
        } catch (Exception $exc) {
            $status = FALSE;
            $response->addMessages($exc->getTraceAsString());
            $this->logger->error("Exception occurred - ". $exc->getTraceAsString());
        }
        
        //
        if ($status) {
            
            $this->logger->info("Enqiry request successfully processed.");
            $msg = Message::Warning("System error occurred while processing enqiry request.");
            $response->addMessages($msg);
            $response->setMessage("Enqiry request successfully processed.");
            $response->setStatus(TRUE);
            
        } else {
            
            $this->logger->error("Error occurred while processing enqiry request.");
            $msg = Message::Warning("System error occurred while processing enqiry request.");
            $response->addMessages($msg);
            $response->setMessage("System error occurred while processing enqiry request.");
            $response->setStatus(FALSE);
            
        }
        
    }
    
    private function processEnquiry($request){
        
        $results = null;
        
        if(!OnclickUtils::isEmpty($request)){
            
            $first_name = OnclickUtils::getProperty('first_name', $request);
            $last_name = OnclickUtils::getProperty('last_name', $request);
            $name = OnclickUtils::getProperty('name', $request);
            $email = OnclickUtils::getProperty('email', $request);
            $phone = OnclickUtils::getProperty('phone', $request);
            $enquiry_for = OnclickUtils::getProperty('interest', $request);
            $message = OnclickUtils::getProperty('message', $request);
            $rTyp = OnclickUtils::getProperty('rTyp', $request);
            $uTyp = OnclickUtils::getProperty('uTyp', $request);
        
            $mapping = array(
                "ID" => "ticket_id",
                "NAME" => "name",
                "EMAIL" => "email",
                "PHONE" => "phone",
                "ENQUIRY_FOR" => "enquiry_for",
                "MESSAGE" => "message",
                "ADD_TS" => "addTs"
            );
            $procedure = "call proc_add_customer_enquiry('".$name."', '".$email."', '".$phone."', '".$enquiry_for."', '".$message. "', @code, @message);";
            
            //
            $dbHelper = self::getDAOHelper();
            $results = $dbHelper->processQuery($procedure, $mapping);
            
        }else {
            
            $this->logger->error("Error occured while processing enquiry request.");
            throw new Exception("Exception occured while processing enquiry request.");
        }
        
        return $results;
        
    }
    
    
    private function sendEnquiryEmail($results) {
        
        $status = TRUE;
        
        $tpl = file_get_contents(__DIR__ .'/../../resources/email-tpls/PHOTO_SESSION_ENQUIRY_EMAIL.html');
        
        $ticket_id = $results['ticket_id'];
        
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
            $tpl = str_replace("{{enquiry_for}}", $results['enquiry_for'], $tpl);

            //
            $emailObj = new Notification();
            $emailObj->setTo($results['email']);
            $emailObj->setFrom("brijeshdhaker@gmail.com", "Neeta Studio Photography");
            $emailObj->setReplyTo("brijeshdhaker@gmail.com", "Neeta Studio Photography");
            $emailObj->setSubject("Photo shoot enquiry with neetastudio.in # TICKET - 00".$ticket_id);
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
