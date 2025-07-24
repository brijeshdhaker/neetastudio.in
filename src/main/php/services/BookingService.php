<?php
/**
 * Description of CommonServices
 *
 * @author brijeshdhaker
 */
class BookingService extends BaseService {
    //
    private $logger;
    /**
     * @return the environment
     */
    function __construct() {
        $this->logger = Logger::getLogger('BookingService');
    }
    
    /**
     * 
     * @param type $request
     * @param type $response
     */
    public function photoSession($request, &$response){
        
        //
        $this->logger->info('-- BookingService::photoSession -- ');
        
        //
        $status = TRUE;
        $booking_id = rand(1000,9999);
        
        try {
            
            if(OnclickUtils::isEmpty($request)){
               throw new Exception("Request can't be blank."); 
            }
            
            //
            $results = $this->processBooking($request);
            
            //
            $status = $this->sendBookingEmail($results);
            
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
    
    private function processBooking($request){
        
        $results = null;
        
        if(!OnclickUtils::isEmpty($request)){
            
            $firstName = OnclickUtils::getProperty('firstName', $request);
            $name = OnclickUtils::getProperty('name', $request);
            $email = OnclickUtils::getProperty('email', $request);
            $phone = OnclickUtils::getProperty('phone', $request);
            $session_type = OnclickUtils::getProperty('session_type', $request);
            $package_type = OnclickUtils::getProperty('package_type', $request);
            $session_date  = OnclickUtils::getProperty('session_date', $request);
            $session_time  = OnclickUtils::getProperty('session_time', $request);
            $message = OnclickUtils::getProperty('message', $request);
            $rTyp = OnclickUtils::getProperty('rTyp', $request);
            $uTyp = OnclickUtils::getProperty('uTyp', $request);
        
            $mapping = array(
                "ID" => "booking_id",
                "NAME" => "name",
                "EMAIL" => "email",
                "PHONE" => "phone",
                "SESSION_TYPE" => "session_type",
                "PACKAGE_TYPE" => "package_type",
                "SESSION_DATE" => "session_date",
                "SESSION_TIME" => "session_time",
                "MESSAGE" => "message",
                "ADD_TS" => "addTs"
            );
            
            $procedure = "call proc_add_customer_booking(
                '".$name."', 
                '".$email."', 
                '".$phone."', 
                '".$session_type."',
                '".$package_type."', 
                '".$session_date."', 
                '".$session_time."', 
                '".$message."', 
                @code,  
                @message
            );";
            
            $dbHelper = self::getDAOHelper();
            
            $results = $dbHelper->processQuery($procedure, $mapping);
            
        }else {
            
            $this->logger->error("Error occured while processing booking request.");
            throw new Exception("Exception occured while processing booking request.");
        }
        
        return $results;
        
    }
    
    
    private function sendBookingEmail($results) {
        
        $status = TRUE;
        
        $tpl = file_get_contents(__DIR__ .'/../../resources/email-tpls/PHOTO_SESSION_BOOKING_EMAIL.html');
        
        $booking_id = $results['booking_id'];
        
        if (!OnclickUtils::isEmpty($booking_id) && !OnclickUtils::isEmpty($tpl)) {
    
            $tpl = str_replace("{{fname}}", $results['name'], $tpl);
            $tpl = str_replace("{{email}}", $results['email'], $tpl);
            $tpl = str_replace("{{booking_id}}", $booking_id, $tpl);
            $tpl = str_replace("{{session_type}}", $results['session_type'], $tpl);
            $tpl = str_replace("{{package_type}}", $results['package_type'], $tpl);
            $tpl = str_replace("{{session_date}}", $results['session_date'], $tpl);
            $tpl = str_replace("{{session_time}}", $results['session_time'], $tpl);

            //
            $emailObj = new Notification();
            $emailObj->setTo($results['email']);
            $emailObj->setFrom("brijeshdhaker@gmail.com", "Neeta Studio Photography");
            $emailObj->setReplyTo("brijeshdhaker@gmail.com", "Neeta Studio Photography");
            $emailObj->setSubject("Your photo shoot with neetastudio.in");
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
