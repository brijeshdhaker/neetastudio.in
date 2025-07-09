<?php
/**
 * Description of Message
 * @author brijeshdhaker
 */
class Message {
    
    var $type;
    //
    var $code;
    //
    var $userMessage;
    //
    var $properties = array();
    
    public static function Success($msg=null, $code=200000){
        $message = new Message();
        $message->setCode($code);
        $message->setType('success');
        $message->setProperties("");
        $message->setUserMessage(is_null($msg) ? "Success" : $msg);
        return $message;
    }
    
    public static function Info($msg, $code=000){
        $message = new Message();
        $message->setCode(200000+$code);
        $message->setType('info');
        $message->setProperties("");
        $message->setUserMessage(is_null($msg) ? "Information" : $msg);
        return $message;
    }
    
    public static function Warning($msg, $code=000){
        $message = new Message();
        $message->setCode(300000+$code);
        $message->setType("warning");
        $message->setProperties("");
        $message->setUserMessage(is_null($msg) ? "Warning" : $msg);
        return $message;
    }
    
    public static function Error($msg, $code=000){
        $message = new Message();
        $message->setCode(400000+$code);
        $message->setType("danger");
        $message->setProperties("");
        $message->setUserMessage(is_null($msg) ? "Error" : $msg);
        return $message;
    }
    
    function getType() {
        return $this->type;
    }

    function setType($type) {
        $this->type = $type;
    }

    function getCode() {
        return $this->code;
    }

    function getUserMessage() {
        return $this->userMessage;
    }

    function getProperties() {
        return $this->properties;
    }

    function setCode($code) {
        $this->code = $code;
    }

    function setUserMessage($userMessage) {
        $this->userMessage = $userMessage;
    }

    function setProperties($properties) {
        $this->properties = $properties;
    }
}

?>
