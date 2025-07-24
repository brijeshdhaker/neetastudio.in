<?php
/**
 * Description of CommonServices
 *
 * @author brijeshdhaker
 */
class ContactusService extends BaseService {
    /**
     * 
     * @param type $request
     * @param type $response
     */
    public function contactUs($request, &$response){
        //
        $logger = Logger::getLogger('ContactusServices');
        $logger->info('-- ContactusServices -- ');
        
        $firstName = OnclickUtils::getProperty('firstName', $request);
        $name = OnclickUtils::getProperty('name', $request);
        $email = OnclickUtils::getProperty('email', $request);
        $phone = OnclickUtils::getProperty('phone', $request);
        $session = OnclickUtils::getProperty('session_type', $request);
        $message = OnclickUtils::getProperty('message', $request);
        $rTyp = OnclickUtils::getProperty('rTyp', $request);
        $uTyp = OnclickUtils::getProperty('uTyp', $request);
        
        $dbHelper = self::getDAOHelper();
        if(!OnclickUtils::isEmpty($request)){
            $mapping = array(
                "ID" => "id",
                "NAME" => "name",
                "EMAIL" => "email",
                "PHONE" => "phone",
                "INTERSET_TYPE" => "interest",
                "MESSAGE" => "message",
                "ADD_TS" => "addTs"
            );
            $procedure = "call proc_add_customer_enquiry('".$name."', '".$email."', '".$phone."', '".$session."', '".$message. "', @code, @message);";
            $results = $dbHelper->processQuery($procedure, $mapping);
        }
        
        $tpl = file_get_contents(__DIR__ .'/../../resources/email-tpls/T_USER_CONTACTUS.html');
        if (!OnclickUtils::isEmpty($tpl)) {

            $tpl = str_replace("{{fname}}", $firstName, $tpl);
            $tpl = str_replace("{{email}}", $email, $tpl);
            $ticketno = rand(1000,9999);
            
            //
            $emailObj = new Notification();
            $emailObj->setTo($email);
            $emailObj->setFrom("brijeshdhaker@gmail.com", "Neeta Studio");
            $emailObj->setReplyTo("brijeshdhaker@gmail.com", "Neeta Studio");
            $emailObj->setSubject("Thanks for writing to neetastudio.in");
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
