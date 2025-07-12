<?php

/**
 * Description of Notification
 * @author brijeshdhaker
 */
class Notification {

    private $to = null;
    private $cc = null;
    private $bcc = null;
    private $subject = null;
    private $message = null;
    private $body = null;
    private $footer = null;
    private $attachments = array();
    private $data = null;
    private $from = null;
    private $replyTo = null;

    /**
     * @return the environment
     */
    function __construct() {
        
    }
    
    /**
	 * Set Configuration
	 * @param config
	 */
    public static function getNotifyObject($to, $subject, $body){
        $notifyObj = new Notification();
        $notifyObj->setTo($to);
        $notifyObj->setSubject($subject);
        $notifyObj->setBody($body);
        return $notifyObj;
    }

    /**
     * 
     * @return null
     */
    public function getToRecipients() {
        if ($this->to == null) {
            return null;
        } else {
            return explode(",", $this->to);
        }
    }

    /**
     * get Cc recipients
     * @return
     */
    public function getCcRecipients() {
        if ($this->cc == null) {
            return null;
        } else {
            return explode(",", $this->cc);
        }
    }

    /**
     * get BCC recipients
     * @return
     */
    public function getBCCRecipients() {
        if ($this->bcc == null) {
            return null;
        } else {
            return explode(",", $this->bcc);
        }
    }

    /**
     * 
     * @return type
     */
    public function getTo() {
        return $this->to;
    }

    /**
     * 
     * @param type $to
     */
    public function setTo($to) {
        $this->to = $to;
    }

    /**
     * 
     * @return type
     */
    public function getCc() {
        return $this->cc;
    }

    /**
     * 
     * @param type $cc
     */
    public function setCc($cc) {
        $this->cc = $cc;
    }

    /**
     * 
     * @return type
     */
    public function getBcc() {
        return $this->bcc;
    }

    /**
     * 
     * @param type $bcc
     */
    public function setBcc($bcc) {
        $this->bcc = $bcc;
    }

    /**
     * 
     * @return type
     */
    public function getSubject() {
        return $this->subject;
    }

    /**
     * 
     * @param type $subject
     */
    public function setSubject($subject) {
        $this->subject = $subject;
    }

    /**
     * 
     * @return type
     */
    public function getEmailMessage() {
        if (!is_null($this->body)) {
            $this->message = $this->body;    
        }
        if (!is_null($this->footer)) {
            $this->message = $this->message . '<br/>' . $this->footer;
        }
        return $this->message;
    }

    /**
     * 
     * @param type $message
     */
    public function setMessage($message) {
        $this->message = $message;
    }

    /**
     * 
     * @return type
     */
    public function getBody() {
        return $this->body;
    }

    /**
     * 
     * @param type $body
     */
    public function setBody($body) {
        $this->body = $body;
    }

    /**
     * 
     * @return type
     */
    public function getFooter() {
        return $this->footer;
    }

    /**
     * 
     * @param type $footer
     */
    public function setFooter($footer) {
        $this->footer = $footer;
    }

    /**
     * 
     * @return type
     */
    public function getAttachments() {
        return $this->attachments;
    }

    /**
     * 
     * @param type $path
     */
    public function addAttachment($path, $name = '') {
        $attachment['path'] = $path;
        $attachment['name'] = $name;
        if (!is_null($path)) {
            $this->attachment($attachment);
        }
    }
    
    /**
     * 
     * @param type $path
     */
    public function setAttachment($attachment) {
        if (!is_null($attachment)) {
            array_push($this->attachments, $attachment);
        }
    }

    /**
     * 
     * @return type
     */
    public function getData() {
        return $this->data;
    }

    /**
     * 
     * @param type $data
     */
    public function setData($data) {
        $this->data = $data;
    }

    /**
     * 
     * @return type
     */
    public function getFrom() {
        return $this->from;
    }

    /**
     * 
     * @return type
     */
    public function setFrom($email, $name = '') {
        $from['email'] = $email;
        if(is_null($name)){
            $name = '';
        }
        $from['name'] = $name;
        $this->from = $from;
    }

    /**
     * 
     * @return type
     */
    public function getReplyTo() {
        return $this->replyTo;
    }

    /**
     * 
     * @return type
     */
    public function setReplyTo($email, $name = '') {
        $replyTo['email'] = $email;
        if(is_null($name)){
            $name = '';
        }
        $replyTo['name'] = $name;
        $this->replyTo = $replyTo;
    }

}

?>
