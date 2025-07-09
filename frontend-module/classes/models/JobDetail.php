<?php
/**
 * Description of JobDetail
 * @author brijeshdhaker
 */
class JobDetail {
    
    var $href;
    var $userId;
    var $jobId;
    var $jobTitle;
    var $createdDate;
    var $webUrl;
    var $status;
    var $company;
    var $position;
    var $employer;
    
    function getHref() {
        return $this->href;
    }

    function getUserId() {
        return $this->userId;
    }

    function getJobId() {
        return $this->jobId;
    }

    function getJobTitle() {
        return $this->jobTitle;
    }

    function getCreatedDate() {
        return $this->createdDate;
    }

    function getWebUrl() {
        return $this->webUrl;
    }

    function getStatus() {
        return $this->status;
    }

    function getCompany() {
        return $this->company;
    }

    function getPosition() {
        return $this->position;
    }

    function getEmployer() {
        return $this->employer;
    }

    function setHref($href) {
        $this->href = $href;
    }

    function setUserId($userId) {
        $this->userId = $userId;
    }

    function setJobId($jobId) {
        $this->jobId = $jobId;
    }

    function setJobTitle($jobTitle) {
        $this->jobTitle = $jobTitle;
    }

    function setCreatedDate($createdDate) {
        $this->createdDate = $createdDate;
    }

    function setWebUrl($webUrl) {
        $this->webUrl = $webUrl;
    }

    function setStatus($status) {
        $this->status = $status;
    }

    function setCompany($company) {
        $this->company = $company;
    }

    function setPosition($position) {
        $this->position = $position;
    }

    function setEmployer($employer) {
        $this->employer = $employer;
    }
    
}
