<?php

use PHPMailer\PHPMailer\PHPMailer;
use PHPMailer\PHPMailer\SMTP;
use PHPMailer\PHPMailer\Exception;

//
#require('phpmail/PHPMailerAutoload.php');
require __DIR__ . '/../../vendor/autoload.php';

smtpmailer('neetadhk@gmail.com','brijeshdhaker@gmail.com','Neeta Studio', 'Test Neeta Studio Email Service', 'Thanks for reaching out to us !!!');


define('GUSER', 'brijeshdhaker@gmail.com'); // GMail username
define('GPWD', 'kypa ftth zhgc xhxk'); // GMail password
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

	$mail->Host = 'smtp.gmail.com';
	$mail->SMTPAuth = true;
	$mail->SMTPSecure = PHPMailer::ENCRYPTION_STARTTLS;
	$mail->Port = 587;
	$mail->Username = 'brijeshdhaker@gmail.com';
	$mail->Password = 'kypa ftth zhgc xhxk';

    
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