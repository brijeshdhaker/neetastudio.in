<?php
/**
 * Description of CommonServices
 *
 * @author brijeshdhaker
 */
class BookingService extends BaseService {
    
    /**
     * 
     * @param type $request
     * @param type $response
     */
    public function photoSession($request, &$response){
        
        //
        $logger = Logger::getLogger('BookingService');
        $logger->info('-- BookingService::photoSession -- ');
        
        $firstName = OnclickUtils::getProperty('firstName', $request);
        $name = OnclickUtils::getProperty('name', $request);
        $email = OnclickUtils::getProperty('email', $request);
        $phone = OnclickUtils::getProperty('phone', $request);
        $session_type = OnclickUtils::getProperty('session_type', $request);
        $package_type = OnclickUtils::getProperty('package_type', $request);
        $session_date  = OnclickUtils::getProperty('session_date', $request);
        $session_time  = OnclickUtils::getProperty('session_date', $request);
        $message = OnclickUtils::getProperty('message', $request);
        $rTyp = OnclickUtils::getProperty('rTyp', $request);
        $uTyp = OnclickUtils::getProperty('uTyp', $request);
        
        //
        $dbHelper = self::getDAOHelper();
        
        $booking_id = rand(1000,9999);
        
        if(!OnclickUtils::isEmpty($request)){
            $mapping = array(
                "ID" => "id",
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
            
            $results = $dbHelper->processQuery($procedure, $mapping);
            $booking_id = $results['id'];
        }
        
        $tpl = file_get_contents('../email-tpl/PHOTO_SESSION_BOOKING_EMAIL.html');
        if (!OnclickUtils::isEmpty($tpl)) {
            
            $ticketno = rand(1000,9999);
            $tpl = str_replace("{{fname}}", $firstName, $tpl);
            $tpl = str_replace("{{email}}", $email, $tpl);
            $tpl = str_replace("{{booking_id}}", $booking_id, $tpl);
            $tpl = str_replace("{{session_type}}", $session_type, $tpl);
            $tpl = str_replace("{{package_type}}", $package_type, $tpl);
            $tpl = str_replace("{{session_date}}", $session_date, $tpl);
            $tpl = str_replace("{{session_time}}", $session_time, $tpl);
            
            
            
            //
            $emailObj = new Notification();
            $emailObj->setTo($email);
            $emailObj->setFrom("brijeshdhaker@gmail.com", "Neeta Studio Photography");
            $emailObj->setReplyTo("brijeshdhaker@gmail.com", "Neeta Studio Photography");
            $emailObj->setSubject("Your photo shoot with neetastudio.in");
            $emailObj->setBody($tpl);
            //$emailObj->setFooter("This is Test Footer Message");
            //$emailObj->setCc("brijeshdhaker@gmail.com");
            $status = NotificationEngine::send($emailObj);
            if ($status) {
                $logger->info("Email Notification successfully send.");
                $msg = Message::Success("Email Notification successfully send.");
                $response->addMessages($msg);
                $response->setMessage("You have successfully registered.");
                $response->setStatus(TRUE);
            } else {
                $logger->error("Error occurred while sending Email Notification.");
                $msg = Message::Warning("System error occurred while processing your request.");
                $response->addMessages($msg);
                $response->setMessage("System error occurred while processing your request.");
                $response->setStatus(FALSE);
            }
        } else {
            throw new Exception("Email Template can not be blank.");
        }
    }
}
