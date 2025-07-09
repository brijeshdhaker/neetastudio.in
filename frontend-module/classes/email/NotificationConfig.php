<?php

/**
 * Description of NotificationConfig
 *
 * @author brijeshdhaker
 */
class NotificationConfig {

    private $environment;
    private $enabled;
    private $testGroup;
    private $from;
    private $replyTo;

    /**
     * @return the environment
     */
    function __construct($type = '') {
        
        $this->environment = OnclickEnv::getEnvName();
        $this->enabled = TRUE;
        $this->testGroup = 'photoes@creativelights.in';
        $this->from = array('email' => 'photoes@creativelights.in', 'name' => 'Creative Lights');
        $this->replyTo = array('email' => 'photoes@creativelights.in', 'name' => 'Creative Lights');
        
    }

    /**
     * @return the environment
     */
    public function getEnvironment() {
        return $this->environment;
    }

    /**
     * @param environment the environment to set
     */
    public function setEnvironment($environment) {
        $this->environment = $environment;
    }

    /**
     * @return the enabled
     */
    public function isEnabled() {
        return $this->enabled;
    }

    /**
     * @param enabled the enabled to set
     */
    public function setEnabled($enabled) {
        $this->enabled = $enabled;
    }

    public function getTestGroup() {
        return $this->testGroup;
    }

    public function setTestGroup($testGroup) {
        $this->testGroup = $testGroup;
    }

    public function getFrom() {
        return $this->from;
    }

    public function setFrom($from) {
        $this->from = $from;
    }

    /**
     * 
     * @param type $replyTo
     */
    public function setReplyTo($replyTo) {
        $this->replyTo = $replyTo;
    }

    /**
     * 
     * @return type
     */
    public function getReplyTo() {
        return $this->replyTo;
    }

}

?>
