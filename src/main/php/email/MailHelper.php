<?php

use PHPMailer\PHPMailer\PHPMailer;
use PHPMailer\PHPMailer\SMTP;
use PHPMailer\PHPMailer\Exception;

//
#require('phpmail/PHPMailerAutoload.php');
#require __DIR__ . '/../../vendor/autoload.php';

class MailHelper {

    /**
     * 
     * @param type $notification
     * @param type $config
     * @return boolean
     * @throws Exception
     */
    public static function send($notification, $config) {
        //
        global $error;
        $logger = Logger::getLogger('MailHelper');
        try {
            
            // create a new object
            $mail = new PHPMailer();  
            // enable SMTP
            $mail->IsSMTP(); 
            // debugging: 1 = errors and messages, 2 = messages only
            $mail->Debugoutput = 'html';
            //$mail->SMTPDebug = TRUE;
            //$mail->do_debug = 0;
            
            switch (OnclickEnv::getEnvName()) {
                case CONSTANTS::ONCLICK_DEV:
                    //$mail->Host = 'relay-hosting.secureserver.net';
                    //$mail->Host = 'smtpout.secureserver.net';
                    $mail->Host = 'smtp.gmail.com';
                    // Set the SMTP port number - 587 for authenticated TLS, a.k.a. RFC4409 SMTP submission
                    //$mail->Port = 3535;
                    //$mail->SMTPSecure = 'ssl';
                    $mail->SMTPSecure = PHPMailer::ENCRYPTION_STARTTLS;
                    //$mail->Port = 465;
                    $mail->Port = 587;
                    $mail->SMTPAuth = true;
                    $mail->Username = 'brijeshdhaker@gmail.com';
                    $mail->Password = 'kypa ftth zhgc xhxk';

                    break;
                case CONSTANTS::ONCLICK_PROD:

                    $mail->SMTPAuth = true;
                    $mail->Host = 'smtp.gmail.com';
                    $mail->SMTPSecure = PHPMailer::ENCRYPTION_STARTTLS;
                    $mail->Port = 587;
                    $mail->Username = 'brijeshdhaker@gmail.com';
                    $mail->Password = 'kypa ftth zhgc xhxk';
                    
                    break;
                default:
                    $mail->SMTPAuth = true;
                    $mail->Host = 'smtp.gmail.com';
                    $mail->SMTPSecure = PHPMailer::ENCRYPTION_STARTTLS;
                    $mail->Port = 587;
                    $mail->Username = 'brijeshdhaker@gmail.com';
                    $mail->Password = 'kypa ftth zhgc xhxk';
                    break;
            }
            
            //
            $from = $notification->getFrom();
            $mail->SetFrom($from['email'], $from['name']);

            //Set reply-to address
            $replyto = $notification->getReplyTo();
            $mail->addReplyTo($replyto['email'], $replyto['name']);

            $mail->Subject = $notification->getSubject();
            $mail->AltBody = 'This is message in plain text for non-HTML mail clients';
            $mail->Body = $notification->getEmailMessage();

            //
            if (!is_null($notification->getToRecipients()) && count($notification->getToRecipients()) > 0) {
                foreach ($notification->getToRecipients() as $recipient) {
                    $mail->AddAddress($recipient);
                }
            }

            //
            if (!is_null($notification->getCcRecipients()) && count($notification->getCcRecipients()) > 0) {
                foreach ($notification->getCcRecipients() as $recipient) {
                    $mail->addCC($recipient);
                }
            }

            //
            if (!is_null($notification->getBCCRecipients()) && count($notification->getBCCRecipients()) > 0) {
                foreach ($notification->getBCCRecipients() as $recipient) {
                    $mail->AddBCC($recipient);
                }
            }

            //
            if (!is_null($notification->getAttachments()) && count($notification->getAttachments()) > 0) {
                foreach ($notification->getAttachments() as $attachment) {
                    $mail->addAttachment($attachment['path'], $attachment['name']);
                }
            }
            if (!$mail->Send()) {
                $logger->error("Error out while sending email notification ".$mail->ErrorInfo);
                throw new Exception('Mail error: ' . $mail->ErrorInfo, 100);
            }
            //$logger->info("Email notification successfully sent.");
            return TRUE;
        } catch (Exception $e) {
            $logger->error($e->getMessage());
            return FALSE;
        }
    }

}

?>
