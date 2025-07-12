<?php
//
require('phpmail/PHPMailerAutoload.php');

smtpmailer('brijeshdhaker@gmail.com','photoes@creativelights.in','Creative Lights', 'Seperate Email Service', 'Seperate Email Service!');


define('GUSER', 'services@onclickresumes.com'); // GMail username
define('GPWD', 'accoo7ak47'); // GMail password
function smtpmailer($to, $from, $from_name, $subject, $body) { 
	global $error;
	// create a new object
	$mail = new PHPMailer();  
	// enable SMTP
	$mail->IsSMTP(); 
	// debugging: 1 = errors and messages, 2 = messages only
        $mail->Debugoutput = 'html';
        $mail->SMTPDebug = TRUE;
        //$mail->do_debug = 0;
	
        $mail->Host = 'localhost';
        $mail->Port = 25; 
        
        // authentication enabled
        // secure transfer enabled REQUIRED for GMail
	//$mail->SMTPSecure = 'ssl'; 
	//$mail->Host = 'smtpout.secureserver.net';
        //$mail->SMTPAuth = true;  
        //$mail->Host = 'hostmaster.onclickresumes.com';
	//$mail->Port = 25; 
	//$mail->Username = 'services@onclickresumes.com';  
	//$mail->Password = 'accoo7ak47';
    
	$mail->SetFrom($from, $from_name);
	$mail->Subject = $subject;
	//$mail->MsgHTML(file_get_contents('../email-templates/js-welcome-tpl.html'), dirname(__FILE__));
	$mail->AltBody = 'This is the body in plain text for non-HTML mail clients';
	$mail->Body = $body;
	$mail->AddAddress($to);
	if(!$mail->Send()) {
		$error = 'Mail error: '.$mail->ErrorInfo; 
		echo 'Mail error: '.$mail->ErrorInfo;
		return false;
	} else {
		$error = 'Message has been sent';
		echo 'Message has been sent';
		return true;
	}
}
?>