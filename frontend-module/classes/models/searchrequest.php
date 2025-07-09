<?php

class SearchRequest {

    var $action;
    var $newSearch;
    var $searchType;
    var $jobID;
    var $keyword;
    var $title;
    var $refrenceID;
    var $minExp;
    var $maxExp;
    var $minSalary;
    var $maxSalary;
    var $currentExp;
    var $currentSalary;
    var $memployers;
    var $mlocations;
    var $mroles;
    var $mindustries;
    var $mfunctions;
    var $mworkauths;
    var $meducations;
    var $mjobtypes;
    var $memptypes;
    var $travel;
    var $prefrenceID;
    var $postedJobAge;
    var $message;
    var $pageNumber;
    var $start;
    var $limit;
    var $sortBy;

    public function getAction() {
        return $this->action;
    }

    public function setAction($action) {
        $this->action = $action;
    }

    public function getSearchType() {
        return $this->searchType;
    }

    public function setSearchType($searchType) {
        $this->searchType = $searchType;
    }

    public function getRefrenceID() {
        return $this->refrenceID;
    }

    public function setRefrenceID($refrenceID) {
        $this->refrenceID = $refrenceID;
    }

    public function getMessage() {
        return $this->message;
    }

    public function setMessage($message) {
        $this->message = $message;
    }

    public function getKeyword() {
        return $this->keyword;
    }

    public function setKeyword($keyword) {
        $this->keyword = $keyword;
    }

    public function getTitle() {
        return $this->title;
    }

    public function setTitle($title) {
        $this->title = $title;
    }

    public function getSortBy() {
        return $this->sortBy;
    }

    public function setSortBy($sortBy) {
        $this->sortBy = $sortBy;
    }

    public function getJobID() {
        return $this->jobID;
    }

    public function setJobID($jobID) {
        $this->jobID = $jobID;
    }

    public function getMinSalary() {
        return $this->minSalary;
    }

    public function setMinSalary($minSalary) {
        $this->minSalary = $minSalary;
    }

    public function getMaxSalary() {
        return $this->maxSalary;
    }

    public function setMaxSalary($maxSalary) {
        $this->maxSalary = $maxSalary;
    }

    public function getMinExp() {
        return $this->minExp;
    }

    public function setMinExp($minExp) {
        $this->minExp = $minExp;
    }

    public function getMaxExp() {
        return $this->maxExp;
    }

    public function setMaxExp($maxExp) {
        $this->maxExp = $maxExp;
    }

    public function getTravel() {
        return $this->travel;
    }

    public function setTravel($travel) {
        $this->travel = $travel;
    }

    public function getPrefrenceID() {
        return $this->prefrenceID;
    }

    public function setPrefrenceID($prefrenceID) {
        $this->prefrenceID = prefrenceID;
    }

    public function getPostedJobAge() {
        return $this->postedJobAge;
    }

    public function setPostedJobAge($postedJobAge) {
        $this->postedJobAge = $postedJobAge;
    }

    public function getPageNumber() {
        return $this->pageNumber;
    }

    public function setPageNumber($pageNumber) {
        $this->pageNumber = $pageNumber;
    }

    public function getMemployers() {
        return $this->memployers;
    }

    public function setMemployers($memployers) {
        $this->memployers = $memployers;
    }

    public function getMlocations() {
        return $this->mlocations;
    }

    public function setMlocations($mlocations) {
        $this->mlocations = $mlocations;
    }

    public function getMroles() {
        return $this->mroles;
    }

    public function setMroles($mroles) {
        $this->mroles = $mroles;
    }

    public function getMindustries() {
        return $this->mindustries;
    }

    public function setMindustries($mindustries) {
        $this->mindustries = $mindustries;
    }

    public function getMfunctions() {
        return $this->mfunctions;
    }

    public function setMfunctions($mfunctions) {
        $this->mfunctions = $mfunctions;
    }

    public function getMeducations() {
        return $this->meducations;
    }

    public function setMeducations($meducations) {
        $this->meducations = $meducations;
    }

    public function getMjobtypes() {
        return $this->mjobtypes;
    }

    public function setMjobtypes($mjobtypes) {
        $this->mjobtypes = $mjobtypes;
    }

    public function getMemptypes() {
        return $this->memptypes;
    }

    public function setMemptypes($memptypes) {
        $this->memptypes = $memptypes;
    }

    public function getMworkauths() {
        return $this->mworkauths;
    }

    public function setMworkauths($mworkauths) {
        $this->mworkauths = $mworkauths;
    }

    public function getEmployers() {
        return $this->employers;
    }

    public function setEmployers($employers) {
        $this->employers = $employers;
    }

    public function getRoles() {
        return $this->roles;
    }

    public function setRoles($roles) {
        $this->roles = $roles;
    }

    public function getJobtypes() {
        return $this->jobtypes;
    }

    public function setJobtypes($jobtypes) {
        $this->jobtypes = $jobtypes;
    }

    public function getEmptypes() {
        return $this->emptypes;
    }

    public function setEmptypes($emptypes) {
        $this->emptypes = $emptypes;
    }

    public function getLocations() {
        return $this->locations;
    }

    public function setLocations($locations) {
        $this->locations = $locations;
    }

    public function getIndustries() {
        return $this->industries;
    }

    public function setIndustries($industries) {
        $this->industries = $industries;
    }

    public function getFunctions() {
        return $this->functions;
    }

    public function setFunctions($functions) {
        $this->functions = $functions;
    }

    public function getWorkauths() {
        return $this->workauths;
    }

    public function setWorkauths($workauths) {
        $this->workauths = $workauths;
    }

    public function getEdulevels() {
        return $this->edulevels;
    }

    public function setEdulevels($edulevels) {
        $this->edulevels = $edulevels;
    }

    public function getNewSearch() {
        return $this->newSearch;
    }

    public function setNewSearch($newSearch) {
        $this->newSearch = $newSearch;
    }

}

?>