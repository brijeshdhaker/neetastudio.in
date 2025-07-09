<?php

class UserInfo {

    var $userid;
    var $name;
    var $email;
    var $fname;
    var $lname;
    var $displayName;
    var $title;
    var $mobile;
    var $isactive;
    var $isregister;
    var $lastlogin;
    var $type;
    var $roleType;
    var $functions = array();
    var $roles = array();
    //
    var $employerName;
    var $employerId;
    var $profile;
    var $contactPerson;
    var $phone;
    var $logoUrl;
    //
    var $apikey;
    var $apisecrate;
    
    public static function setUserInfo($data) {
        $userinfo = new UserInfo();
        if ($data != null) {
            $userinfo->userid = $data['USERID'];
            $userinfo->name = $data['USERNAME'];
            $userinfo->email = $data['EMAILID'];
            $userinfo->isactive = $data['ISACTIVE'];
            $userinfo->isregister = $data['ISREGISTER'];
            $userinfo->apikey = $data['API_KEY'];
            $userinfo->apisecrate = $data['API_SECRET'];
            $userinfo->roleType = $data['ROLEID'];
            if ($data['ROLEID'] == 20) {
                $userinfo->fname = $data['FNAME'];
                $userinfo->lname = $data['LNAME'];
                $userinfo->title = $data['GENDER'];
                $userinfo->mobile = $data['MOBILE'];
                $userinfo->phone = $data['MOBILE'];
                $userinfo->type = 's';
            } else {
                $userinfo->employerName = $data['EMPLOYER_NAME'];
                $userinfo->employerId = $data['RECRUTERID'];
                $userinfo->contactPerson = $data['PRIMARY_CONTACT'];
                $userinfo->phone = $data['PHONE'];
                $userinfo->mobile = $data['PHONE'];
                $userinfo->profile = (isset($data['PROFILE']) && !empty($data['PROFILE'])) ? $data['PROFILE'] : "";
                $userinfo->logoUrl = (isset($data['LOGO']) && !empty($data['LOGO'])) ? $data['LOGO'] : "/repository/logos/BLANK_LOGO.gif"; 
                $userinfo->type = 'e';
            }
            $userinfo->lastlogin = $data['LAST_LOGIN'];
            $userinfo->getEmtitlements();
            $userinfo->getDisplay();
        }
        return $userinfo;
    }

    public function getUserId() {
        return $this->userid;
    }

    public function getUserName() {
        return $this->name;
    }

    public function getEmailAddr() {
        return $this->email;
    }

    public function getFname() {
        return $this->fname;
    }

    public function getLname() {
        return $this->lname;
    }
    
    public function getDisplay() {
        if($this->getRoleType() == 20){
            $prefix = "";
            if ($this->title != null) {
                $prefix = ($this->title == 'M' ) ? 'Mr.' : 'Mrs.';
            }
            $this->displayName = $prefix ." ". $this->getFname(). " " .$this->getLname();
        }else{
            $this->displayName = $this->getEmployerName();
        }
        return $this->displayName;
    }
    
    public function getTitle() {
        if ($this->title != null) {
            $prefix = ($this->title == 'M' ) ? 'Mr.' : 'Mrs.';
        } else {
            $prefix = "";
        }
        return $prefix;
    }

    public function getMobile() {
        return $this->mobile;
    }

    public function getLastLogin() {
        return $this->lastlogin;
    }

    public function getFullName() {
        $fullname;
        $prefix;
        if ($this->title != null) {
            $prefix = ($this->title == 'M' ) ? 'Mr.' : 'Mrs.';
        } else {
            $prefix = "";
        }

        if ($this->lname != null && $this->fname != null) {
            $fullname = $this->lname . ", " . $this->fname;
        }
        return $fullname;
    }

    public function getUserType() {
        return $this->type;
    }

    public function getFunctions() {
        return $this->functions;
    }
    
    public function getEmtitlements() {
        $dbHelper = new PDOHelper();
        //$dbHelper->execute($procedure, PDO::FETCH_ASSOC, TRUE);
        $mapping = array(
            "ROLEID" => "role",
            "ROLENAME" => "roleName"
        );
        $procedure = "call P_GET_USER_ENTITLEMENTS(".$this->userid.", @code, @message);";
        $entitlements = $dbHelper->processQuery($procedure, $mapping, 10);
        if (!is_null($entitlements)) {
            $datalength = count($entitlements);
            for ($x = 0; $x < $datalength; $x++) {
                $record = $entitlements[$x];
                if ($record) {
                    array_push($this->roles,$record['role']);
                    array_push($this->functions,$record['roleName']);
                }
            }
        }
    }

    public function getEmployerName() {
        return $this->employerName;
    }

    public function getEmployerId() {
        return $this->employerId;
    }

    public function getPrimary() {
        return $this->contactPerson;
    }

    public function getPhone() {
        return $this->phone;
    }
    
    function getApikey() {
        return $this->apikey;
    }

    function getApisecrate() {
        return $this->apisecrate;
    }

    function setApikey($apikey) {
        $this->apikey = $apikey;
    }

    function setApisecrate($apisecrate) {
        $this->apisecrate = $apisecrate;
    }

    function getRoles() {
        return $this->roles;
    }

    function setRoles($roles) {
        $this->roles = $roles;
    }

    
    function getRoleType() {
        return $this->roleType;
    }

    function setRoleType($roleType) {
        $this->roleType = $roleType;
    }

    function getProfileDt() {
        return $this->profile;
    }

    function getLogoUrl() {
        return $this->logoUrl;
    }
    
    function getIsactive() {
        return $this->isactive;
    }

    function setIsactive($isactive) {
        $this->isactive = $isactive;
    }



}

?>