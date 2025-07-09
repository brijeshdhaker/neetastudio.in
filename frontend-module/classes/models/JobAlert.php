<?php
/**
 * Description of JobAlert
 * @author brijeshdhaker
 */
class JobAlert {
    
    var $href;
    var $userId;
    var $id;
    var $disabled;
    var $emailFrequency;
    var $createDate;
    var $lastModifiedDate;
    var $confirmDate;
    var $expirationDate;
    var $lastRenewDate;
    var $name;
    var $url;
    var $searchCriteria;
    var $email;
    var $hashCode;
    var $registered;
    var $formattedDate;
    
    function getHref() {
        return $this->href;
    }

    function getUserId() {
        return $this->userId;
    }

    function getId() {
        return $this->id;
    }

    function getDisabled() {
        return $this->disabled;
    }

    function getEmailFrequency() {
        return $this->emailFrequency;
    }

    function getCreateDate() {
        return $this->createDate;
    }

    function getLastModifiedDate() {
        return $this->lastModifiedDate;
    }

    function getConfirmDate() {
        return $this->confirmDate;
    }

    function getExpirationDate() {
        return $this->expirationDate;
    }

    function getLastRenewDate() {
        return $this->lastRenewDate;
    }

    function getName() {
        return $this->name;
    }

    function getUrl() {
        return $this->url;
    }

    function getSearchCriteria() {
        return $this->searchCriteria;
    }

    function getEmail() {
        return $this->email;
    }

    function getHashCode() {
        return $this->hashCode;
    }

    function getRegistered() {
        return $this->registered;
    }

    function getFormattedDate() {
        return $this->formattedDate;
    }

    function setHref($href) {
        $this->href = $href;
    }

    function setUserId($userId) {
        $this->userId = $userId;
    }

    function setId($id) {
        $this->id = $id;
    }

    function setDisabled($disabled) {
        $this->disabled = $disabled;
    }

    function setEmailFrequency($emailFrequency) {
        $this->emailFrequency = $emailFrequency;
    }

    function setCreateDate($createDate) {
        $this->createDate = $createDate;
    }

    function setLastModifiedDate($lastModifiedDate) {
        $this->lastModifiedDate = $lastModifiedDate;
    }

    function setConfirmDate($confirmDate) {
        $this->confirmDate = $confirmDate;
    }

    function setExpirationDate($expirationDate) {
        $this->expirationDate = $expirationDate;
    }

    function setLastRenewDate($lastRenewDate) {
        $this->lastRenewDate = $lastRenewDate;
    }

    function setName($name) {
        $this->name = $name;
    }

    function setUrl($url) {
        $this->url = $url;
    }

    function setSearchCriteria($searchCriteria) {
        $this->searchCriteria = $searchCriteria;
    }

    function setEmail($email) {
        $this->email = $email;
    }

    function setHashCode($hashCode) {
        $this->hashCode = $hashCode;
    }

    function setRegistered($registered) {
        $this->registered = $registered;
    }

    function setFormattedDate($formattedDate) {
        $this->formattedDate = $formattedDate;
    }

}
