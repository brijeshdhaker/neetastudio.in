<?php
/**
 * Description of CommonServices
 *
 * @author brijeshdhaker
 */
class SubscribeService extends BaseService {
    /**
     * 
     * @param type $request
     * @param type $response
     */
    public function forNewletter($request, &$response){
        //
        $logger = Logger::getLogger('SubscribeServices');
        
        $logger->info('-- SubscribeServices::forNewletter -- ');
        
        $firstName = OnclickUtils::getProperty('firstName', $request);
        $name = OnclickUtils::getProperty('name', $request);
        $email = OnclickUtils::getProperty('email', $request);
        $phone = OnclickUtils::getProperty('phone', $request);
        $service_type = OnclickUtils::getProperty('service_type', $request);
        $message = OnclickUtils::getProperty('message', $request);
        $rTyp = OnclickUtils::getProperty('rTyp', $request);
        $uTyp = OnclickUtils::getProperty('uTyp', $request);
        $tpl = file_get_contents('../email-tpl/T_USER_CONTACTUS.html');
        
        $dbHelper = self::getDAOHelper();
        if(!OnclickUtils::isEmpty($request)){
            
            $procedure = "call P_GET_USER_ENTITLEMENTS(".$this->userid.", @code, @message);";
            $entitlements = $dbHelper->processQuery($procedure, $mapping, 10);
            
        }
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

    public function forCollaboration($request, &$response){
        //
        $logger = Logger::getLogger('SubscribeServices');
        //$dbHelper = self::getDAOHelper();
        $logger->info('-- SubscribeServices::forCollaboration -- ');
        
        $firstName = OnclickUtils::getProperty('firstName', $request);
        $name = OnclickUtils::getProperty('name', $request);
        $email = OnclickUtils::getProperty('email', $request);
        $phone = OnclickUtils::getProperty('phone', $request);
        $message = OnclickUtils::getProperty('message', $request);
        $rTyp = OnclickUtils::getProperty('rTyp', $request);
        $uTyp = OnclickUtils::getProperty('uTyp', $request);
        $tpl = file_get_contents('../email-tpl/T_USER_CONTACTUS.html');
        
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
    
    public function forWorkWithUs($request, &$response){
        //
        $logger = Logger::getLogger('ContactusServices');
        //$dbHelper = self::getDAOHelper();
        $logger->info('-- ContactusServices::forWorkWithUs -- ');
        
        $firstName = OnclickUtils::getProperty('firstName', $request);
        $name = OnclickUtils::getProperty('name', $request);
        $email = OnclickUtils::getProperty('email', $request);
        $phone = OnclickUtils::getProperty('phone', $request);
        $message = OnclickUtils::getProperty('message', $request);
        $rTyp = OnclickUtils::getProperty('rTyp', $request);
        $uTyp = OnclickUtils::getProperty('uTyp', $request);
        $tpl = file_get_contents('../email-tpl/T_USER_CONTACTUS.html');
        
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
