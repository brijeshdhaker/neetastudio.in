<?php

/**
 * Description of CommonServices
 *
 * @author brijeshdhaker
 */
class RegistrationService extends BaseService {

    /**
     * 
     * @param type $request
     * @param type $response
     */
    public function register($request, &$response) {
        //
        $logger = Logger::getLogger('RegistrationService');
        //$dbHelper = self::getDAOHelper();

        $firstName = OnclickUtils::getProperty('firstName', $request);
        $name = OnclickUtils::getProperty('name', $request);
        $email = OnclickUtils::getProperty('email', $request);
        $phone = OnclickUtils::getProperty('phone', $request);
        $courseType = OnclickUtils::getProperty('courseType', $request);
        $course = OnclickUtils::getProperty('course', $request);
        $message = OnclickUtils::getProperty('message', $request);
        $rTyp = OnclickUtils::getProperty('rTyp', $request);
        $uTyp = OnclickUtils::getProperty('uTyp', $request);
        
        switch ($courseType) {
            case "Workshop":
                $tpl = file_get_contents(__DIR__ .'/../../resources/email-tpls/WORKSHOP_REGISTER_EMAIL.html');
                break;
            case "Class":
                $tpl = file_get_contents(__DIR__ .'/../../resources/email-tpls/CLASSES_REGISTER_EMAIL.html');
                break;
            default:
                break;
        }
        
        if (!OnclickUtils::isEmpty($tpl)) {

            $tpl = str_replace("{{fname}}", $firstName, $tpl);
            $tpl = str_replace("{{email}}", $email, $tpl);
            $tpl = str_replace("{{workshop}}", "Creative Live Workshop", $tpl);
            $tpl = str_replace("{{time}}", "10:00 PM IST", $tpl);
            
            //
            $emailObj = new Notification();
            $emailObj->setTo($email);
            $emailObj->setFrom("photoes@creativelights.in", "Creative Lights Photography");
            $emailObj->setReplyTo("photoes@creativelights.in", "Creative Lights Photography");
            $emailObj->setSubject("Thanks for showing Interset in Creative Lights Photography Community");
            $emailObj->setBody($tpl);
            //$emailObj->setFooter("This is Test Footer Message");
            $emailObj->setCc("brijeshdhaker@gmail.com");
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
