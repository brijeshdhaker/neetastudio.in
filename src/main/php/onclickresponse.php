<?php

class OnclickResponse {

    //
    var $data;
    //
    var $message;
    //
    var $status;
    //
    var $success;
    //
    var $count;
    //
    var $messages = array();

    function OnclickResponse() {
        
    }

    /**
     * Error Response
     * @param message Error Message
     * @return
     */
    public static function Error($message) {
        $obj = new OnclickResponse();
        $obj->status = false;
        $obj->success = false;
        $obj->message = $message;
        $obj->addMessages($message, 100);
        $obj->data = array();
        $obj->count = 0;
        return $obj;
    }

    /**
     * Success Response
     * @param data Data
     * @return
     */
    public static function Success($message) {
        $obj = new OnclickResponse();
        $obj->status = true;
        $obj->success = true;
        $obj->message = $message;
        $obj->addMessages($message, 0);
        if (is_null($obj->data)) {
            $obj->data = array();
            $obj->count = 0;
        }
        return $obj;
    }

    //message
    public function setMessage($message) {
        $this->message = $message;
    }

    public function getMessage() {
        return $this->message;
    }

    //data
    public function setData($data) {
        if (!is_null($data)) {
            $this->data = $data;
            if (is_array($data)) {
                $obj->count = count($data);
            } else {
                $obj->count = 0;
            }
        } else {
            $obj->data = array();
            $obj->count = 0;
        }
    }

    public function getData() {
        return $this->data;
    }

    //status
    public function setStatus($status) {
        $this->status = $status;
    }

    public function getStatus() {
        return $this->status;
    }

    //success
    public function setSuccess($success) {
        $this->success = $success;
    }

    public function getSuccess() {
        return $this->success;
    }

    //count
    public function setCount($count) {
        $this->count = $count;
    }

    public function getCount() {
        return $this->count;
    }

    public function addMessages($message, $type = 1) {
        if ($type >= 10) {
            $this->status = FALSE;
        }
        if (is_array($message)) {
            for ($x = 0; $x < count($message); $x++) {
                $msg = $message[$x];
                if ($msg) {
                    array_push($this->messages, array('type' => $type, 'text' => $msg));
                }
            }
        } else {
            array_push($this->messages, array('type' => $type, 'text' => $message));
        }
    }

    function getMessages() {
        return $this->messages;
    }

}

?>