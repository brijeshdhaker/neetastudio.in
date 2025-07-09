<?php

/*
 * To change this license header, choose License Headers in Project Properties.
 * To change this template file, choose Tools | Templates
 * and open the template in the editor.
 */

/**
 * Description of OnclickUser
 *
 * @author brijeshdhaker
 */
class OnclickUser {
    
    var $email;
    var $passwd;
    var $isactive;
    var $isregister;
    var $lastlogin;
    var $type;
    var $roleType;
    var $functions = array();
    var $roles = array();
    
    function getPasswd() {
        return $this->passwd;
    }

    function getEmail() {
        return $this->email;
    }

    function getIsactive() {
        return $this->isactive;
    }

    function getIsregister() {
        return $this->isregister;
    }

    function getLastlogin() {
        return $this->lastlogin;
    }

    function getType() {
        return $this->type;
    }

    function getRoleType() {
        return $this->roleType;
    }

    function getFunctions() {
        return $this->functions;
    }

    function getRoles() {
        return $this->roles;
    }

    function setPasswd($passwd) {
        $this->passwd = $passwd;
    }

    function setEmail($email) {
        $this->email = $email;
    }

    function setIsactive($isactive) {
        $this->isactive = $isactive;
    }

    function setIsregister($isregister) {
        $this->isregister = $isregister;
    }

    function setLastlogin($lastlogin) {
        $this->lastlogin = $lastlogin;
    }

    function setType($type) {
        $this->type = $type;
    }

    function setRoleType($roleType) {
        $this->roleType = $roleType;
    }

    function setFunctions($functions) {
        $this->functions = $functions;
    }

    function setRoles($roles) {
        $this->roles = $roles;
    }


}
