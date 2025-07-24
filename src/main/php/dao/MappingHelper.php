<?php

/**
 * Description of MappingHelper
 * @author brijeshdhaker
 */
class MappingHelper {

    static $DAO_MAPPINGS = array(
        // core-data
        "core-data" => array(
            "ID" => "id",
            "CODE" => "code",
            "NAME" => "name",
            "GROUPS" => "group",
            "GNAME" => "groupName"
        ),
        //profile-detail
        "profile-detail" => array(
            "PROFILE_ID" => 'id',
            "PROFILE_NM" => 'profileName',
            "SEEKERID" => 'seekerid',
            "STATUS" => 'status',
            "THIRD_PARTY" => 'thirdParty',
            "DESIRE_POSITION" => 'desiredPosition',
            "PROFILE_LINK" => 'href',
            "UPD_BY" => 'updBy',
            "UPD_TS" => 'announceDate',
            "ADD_BY" => 'addBy',
            "ADD_TS" => 'datePosted'
        ),
        // personal-detail
        "personal-detail" => array(
            "SEEKERID" => "seekerid",
            "TITLE" => "title",
            "FNAME" => "fname",
            "LNAME" => "lname",
            "GENDER"=> "gender",
            "EMAILID"=>"emailid",
            "DOB" => "dob",
            "CATEGORY" => "category",
            "MARITAL" => "marital",
            "PHYSICAL" => "physical",
            "EMAILID" => "emailid",
            "ADDRESS" => "address",
            "CITY" => "city",
            "PINCODE" => "pincode",
            "STATE" => "state",
            "COUNTRY" => "country",
            "MOBILE" => "mobile",
            "PHONE" => "phone",
            "PROFILE_IMG"=> "pimage"
        ),
        //
        "resume-details" => array(
            "DOC_ID" => "docid",
            "SEEKERID" => "userid",
            "PROFILEID"=> "profileId",
            "DOC_TYPE_ID" => "doctypeid",
            "DOC_TYPE" => "doctype",
            "DOC_TITLE" => "doctitle",
            "DOC_NAME" => "docname",
            "ACTIVE_STATUS" => "activestatus",
            "DOC_LINK" => "doclink",
            "CREATED_DATE" => "createddate",
            "UPDATE_DATE" => "updatedate",
            "VIEW_COUNT" => "viewcount"
        ),
        //
        "cover-details" => array(
            "DOC_ID" => "docid",
            "SEEKERID" => "userid",
            "PROFILEID"=> "profileId",    
            "DOC_TYPE_ID" => "doctypeid",
            "DOC_TYPE" => "doctype",
            "DOC_TITLE" => "doctitle",
            "DOC_NAME" => "docname",
            "ACTIVE_STATUS" => "activestatus",
            "DOC_LINK" => "doclink",
            "CREATED_DATE" => "createddate",
            "UPDATE_DATE" => "updatedate",
            "VIEW_COUNT" => "viewcount"
        ),
        //
        "document-details" => array(
            "DOC_ID" => "docid",
            "SEEKERID" => "userid",
            "PROFILEID"=> "profileId",
            "DOC_TYPE_ID" => "doctypeid",
            "DOC_TYPE" => "doctype",
            "DOC_TITLE" => "doctitle",
            "DOC_NAME" => "docname",
            "ACTIVE_STATUS" => "activestatus",
            "DOC_LINK" => "doclink",
            "CREATED_DATE" => "createddate",
            "UPDATE_DATE" => "updatedate",
            "VIEW_COUNT" => "viewcount"
        ),
        //education-details
        "education-details" => array(
            "ID" => "id",
            "SEEKERID" => "seekerid",
            "DEGREE" => "degree",
            "EDU_LEVEL" => "eduLevel",
            "EDU_TYPE" => "eduType",
            "INSTITUTE" => "institute",
            "STREAM" => "stream",
            "START_DATE" => "startYear",
            "END_DATE" => "passYear"
        ),
        //profile-education
        "profile-education" => array(
            "ID" => "id",
            "SEEKERID" => "seekerid",
            "EDU_TYPE" => "eduType",
            "EDU_TYPE_NM" => "eduTypeNm",
            "INSTITUTE" => "institute",
            "LOCATION" => "location",
            "UPD_BY" => "updBy",
            "UPD_TS" => "updTs",
            "ADD_BY" => "addBy",
            "ADD_TS" => "addTs"
        ),
        //employment-details
        "employment-details" => array(
            "ID" => "id",
            "SEEKERID" => "seekerid",
            "EMPLOYERE_NAME" => "employereName",
            "EMPLOYERE_TYPE" => "employereType",
            "EMPTYPE_NM" => "employereType",
            "DESGINATION" => "desgination",
            "START_DATE" => "startDateStr",
            "START_MONTH" => "startMonth",
            "START_YEAR" => "startYear",
            "END_DATE" => "endDateStr",
            "END_MONTH" => "endMonth",
            "END_YEAR" => "endYear",
        ),
        //skill-details
        "skill-details" => array(
            "ID" => "id",
            "SEEKERID" => "seekerid",
            "SKILL" => "skill",
            "EXPERIENCE" => "experience",
            "LAST_USE" => "lastuse",
            "SKILL_LEVEL" => "level",
            "UPD_TS" => "updDate",
            "ADD_TS" => "addDate"
        ),
        //language-details
        "language-details" => array(
            "ID" => "id",
            "SEEKERID" => "seekerid",
            "LANGUAGE" => "language",
            "ISREAD" => "isread",
            "ISWRITE" => "iswrite",
            "ISSPEAK" => "isspeak",
            "UPD_TS" => "updDate",
            "ADD_TS" => "addDate"
        ),
        //workauth-details
        "workauth-details" => array(
            "ID" => "id",
            "SEEKERID" => "seekerid",
            "COUNTRY" => "country",
            "VISA_TYPE" => "visatype",
            "UPD_TS" => "updDate",
            "ADD_TS" => "addDate"
        ),
        //preference-details
        "preference-details" => array(
            "SEEKERID" => "seekerid",
            "SALARY" => "salary",
            "EXPERIENCE" => "totalexp",
            "ISRELOCAT" => "relocation",
            "WORKAUTH" => "workAuth",
            "TRAVEL" => "travel",
            "TRAVEL_NAME" => "travelDesc"
        ),
        //preference-details
        "user-preference" => array(
            "SEEKERID" => "seekerid",
            "PROFILEID" => "profileid",
            "TYPE" => "type",
            "KEY" => "key",
            "VALUE" => "value",
            "UPD_BY" => "updateBy",
            "UPD_TS" => "updDt",
            "ADD_BY" => "addBy",
            "ADD_TS" => "addDt"
        ),
        //recommended-jobs
        "recommended-jobs" => array(
            "POSTID" => "jobPostId",
            "TITLE" => "title",
            "HIRING_ORGANIZATION"=> "hiringby",
            "SKILLS" => "resumeId",
            "REFERENCE_ID" => "referenceId",
            "OPEN_POSITIONS" => "openPositions",
            "LOCATION" => "location",
            "LOCATION_DESC" => "locationDesc",
            "ROLE" => "role",
            "ROLE_DESC" => "roleDesc",
            "INDUSTRY" => "industry",
            "INDUSTRY_DESC" => "industryDesc",
            "FUNCTION" => "function",
            "FUNCTION_DESC" => "functionDesc",
            "WORK_AUTH" => "workauth",
            "WORK_AUTH_NAME" => "workauthname",
            "MIN_EXP" => "minExp",
            "MAX_EXP" => "maxExp",
            "MIN_SAL" => "minSal",
            "MAX_SAL" => "maxSal",
            "OPEN_DATE" => "openDate",
            "END_DATE" => "endDate",
            "ISACTIVE" => "isactive",
            "ISLIVE" => "islive",
            "JOB_TYPE" => "jobType",
            "JOB_TYPE_DESC" => "jobTypeDesc",
            "EMP_TYPE" => "emptype",
            "EMP_TYPE_DESC" => "emptypeDesc",
            "PREFRENCE" => "prefrence",
            "PREFRENCE_DESC" => "prefrenceDesc",
            "TRAVEL" => "travel",
            "TRAVEL_DESC" => "travelDesc",
            "EMPLOYERID" => "employerid",
            "EMPLOYER_NAME" => "employerName",
            "PRIMARY_CONTACT" => "primaryContact",
            "COMPANY_TYPE" => "companyType",
            "MOBILE" => "mobile",
            "PHONE" => "phone",
            "EMAILID" => "emailid",
            "ADDRESS" => "address",
            "COMPANY_URL" => "url",
            "COMPANY_LOGO" => "logo",
            "CITY" => "city",
            "PINCODE" => "pincode",
            "RY" => "doctype",
            "COMPANY_NAME" => "companyName",
            "CONTACT_PERSON" => "contactPerson",
            "CONTACT_EMAIL" => "contactEmail",
            "CONTACT_PHONE" => "contactPhone",
            "DETAILS" => "details"
        ),
        //save-jobs
        "save-jobs" => array(
            "ID" => "id",
            "POSTID" => "postid",
            "JOB_TITLE" => "jobTitle",
            "HIRING_ORGANIZATION"=> "hiringby",
            "EMPLOYERID" => "employerId",
            "EMPLOYER_NAME" => "employerName",
            "SEEKERID" => "seekerid",
            "ACTION" => "action",
            "SELECT_STATUS" => "selectStatus",
            "APPLY_DATE" => "applyDate",
            "JOB_STATUS"=>"status"
        ),
        //resume-history
        "resume-history" => array(
            "ID" => "id",
            "SEEKERID" => "seekerid",
            "RESUME_ID" => "resumeId",
            "EMPLOYERID" => "doctype",
            "EMPLOYER_NAME" => "employer",
            "EMPLOYER_ACTION" => "employerAction",
            "EMPLOYER_ACTION_DESC" => "employerActionDesc",
            "EMPLOYER_COMMENT" => "employerComment",
            "ACTION_TIME" => "actionTime"
        ),
        //email-service
        "email-service" => array(
            "ID" => "id",
            "FNAME" => "fname",
            "LNAME" => "lname",
            "EMAIL_ADDR" => "emailAddr",
            "KEYWORDS" => "skills",
            "FUNCTION" => "functionId",
            "FUNCTION_NM" => "functionDesc",
            "EXPERIENCE" => "experience",
            "INDUSTRY" => "industryId",
            "INDUSTRY_NM" => "industryDesc",
            "JOB_TYPE" => "jobType",
            "JOB_TYPE_NM" => "jobTypeDesc",
            "EMP_TYPE" => "employmentType",
            "EMP_TYPE_NM" => "empTypeDesc"
        ),
        
        //post-detail
        'post-detail' => array(
            "POSTID" => "postid",
			"REFEID" => "refeid",
			//
	        "TITLE" => "title",
            "HIRING_ORGANIZATION"=> "hiringby",
	        "SKILLS" => "skills",
	        "POSITIONS" => "positions",
	        //
	    	"ROLE" => "role",
			"ROLE_DESC" => "role_name",
			"INDUSTRY" => "industry",
			"INDUSTRY_DESC" => "industry_name",
			"FUNCTION" => "function",
			"FUNCTION_DESC" => "function_name",
            //
	    	"EXPERIENCE" => "experience",
	        "SALARY" => "salary",
			"EMPTYPE" => "emptype",
			"EMPTYPE_DESC" => "emptype_name",
			"TRAVEL" => "travel",
	    	"TRAVEL_DESC" => "travel_name",
			//
	        "OPEN_DATE" => "openDate",
	        "END_DATE" => "endDate",
	        "ISPREMIUM" => "ispremium",
	        "ISPSU" => "ispsu",
	        "ISINTER" => "isinter",
	        "ISLIVE" => "islive",
	        "ISACTIVE" => "isactive",
            "ISSAVED" => "issaved",
            "ISAPPLIED" => "isapplied",
            "JOB_AGE" => "jobage",
	    	"SOURCE" => "source",
	    	"POSTURL" => "applyurl",
	    	//
			"COUNTRY" => "country",
			"COUNTRY_NAME" => "country_name",
			"STATE" => "state",
			"STATE_NAME" => "state_name",
			"LOCATION" => "location",
			"LOCATION_DESC" => "location_name",
			"POSTCODE" => "postcode",
			//
			"EMPLOYERID" => "emp_id",
			"EMP_NAME" => "emp_name",
			"REC_TYPE" => "emp_type",
			"EMP_URL" => "emp_url",
			"EMP_LOGO" => "emp_logo",
			"EMP_CITY" => "emp_city",
			"EMP_PIN" => "emp_pincode",
			"EMP_ADDRESS" => "emp_address",
			//
            "HR_ID" => "hr_id",
	        "HR_NAME" => "hr_name",
            "HR_IMG" => "hr_image",    
	        "HR_EMAIL" => "hr_email",
	        "HR_PHONE" => "hr_phone",
	    	"HR_MOBILE" => "hr_mobile",
	        "HR_ADDRESS" => "hr_address",
			//
	    	"UPD_BY" => "updBy",
	        "UPD_TS" => "updDt",
	        "ADD_BY" => "addBy",
	        "ADD_TS" => "addDt"
    	),
        
        //employer-details
        "employer-details" => array(
            "EMPLOYERID" => "recruterid",
            "EMPLOYER_NAME" => "employerName",
            "PRIMARY_CONTACT" => "primaryContact",
            "COMPANY_TYPE" => "companyType",
            "PHONE" => "phone",
            "EMAILID" => "emailAddr",
            "URL" => "url",
            "LOGO" => "logo",
            "FACEBOOK" => "facebook",
            "LINKEDIN" => "linkedin",
            "TWITTER" => "twitter",
            "ADDRESS" => "address",
            "CITY" => "city",
            "PINCODE" => "pincode",
            "STATE" => "state",
            "COUNTRY" => "country",
            "PROFILE" => "profile"
        ),
        
        //email-msgs
        "email-msgs" => array(
            "ID" => "id",
            "FROM" => "from",
            "FROM_NM" => "fromNm",
            "REPLYTO" => "replyTo",
            "REPLYTO_NM" => "replyToNm",
            "TO" => "to",
            "CC" => "cc",
            "SUBJ" => "subject",
            "BODY" => "body",
            "ATTACH" => "attachment",
            "PATH" => "path"
        ),
        
        //email-tpl
        "email-tpl" => array(
            "ID" => "id",
            "NAME"=> "name",
            "SUBJ" => "subject",
            "HEADER"=> "header",
            "BODY" => "body",
            "FOOTER" => "footer",
            "FROM" => "from",
            "FROM_NM" => "fromNm",
            "TO" => "to",
            "CC" => "cc",
            "ISACTIVE" => "isactive", 
            "UPD_BY" => "updBy", 
            "UPD_TS" => "updTs", 
            "ADD_BY" => "addBy", 
            "ADD_TS" => "addTs"
        ),
        
        //search-drives
        "search-drives" => array(
            "ID" => "driveId",
            "EMPLOYERID" => "empId",
            "EMPLOYER_NAME" => "empNm",
            "LOGO" => "logo",
            "TITLE" => "title",
            "SKILLS" => "skills",
            "COMPANY" => "company",
            "FUNCTION" => "function",
            "FUN_NAME" => "functionNm",
            "LOCATION" => "location",
            "LOC_NAME" => "locationNm",
            "MIN_EXP" => "minExp",
            "MAX_EXP" => "maxExp",
            "START_DT" => "startDt",
            "END_DT" => "endDt",
            "IN_TIME" => "intime",
            "OUT_TIME" => "outtime",
            "HRPERSON" => "hrperson",
            "HREMAIL" => "hremail",
            "HRPHONE" => "hrphone",
            "VENUE" => "venue",
            "DETAILS" => "detail"
        ),
        //audit-logs
        "audit-logs" => array(
            "LOG_ID" => "logId",
            "MESSAGEG" => "message",
            "ACTION_CD" => "action",
            "CATEGORY" => "category",
            "ADD_BY" => "addBy",
            "ADD_BY_NM" => "addByName",    
            "ADD_TS" => "addTs"
        ),
        
        //recruiter-details
        "recruiter-details" => array(
            "EMPLOYERID" => "recruterid",
            "EMPLOYER_NAME" => "employerName",
            "PRIMARY_CONTACT" => "primaryContact",
            "COMPANY_TYPE" => "companyType",
            "PHONE" => "phone",
            "EMAILID" => "emailAddr",
            "URL" => "url",
            "LOGO" => "logo",
            "PROFILE_IMG" => "profileImg",
            "FACEBOOK" => "facebook",
            "LINKEDIN" => "linkedin",
            "TWITTER" => "twitter",
            "ADDRESS" => "address",
            "CITY" => "city",
            "PINCODE" => "pincode",
            "STATE" => "state",
            "COUNTRY" => "country",
            "PROFILE" => "profile",
            "LAST_LOGIN" => "lastlogin",
            "VIEW_COUNT" => "views"
        ),
        
        // hr-associates
        'hr-associates'  => array(
            "EMPLOYERID" => "hr_employerid",
            "HR_USERID"  => "hr_userid",
            "HR_TITLE"   => "hr_title",    
            "HR_NAME"    => "hr_name",
            "HR_LNAME"   => "hr_lname",
            "HR_EMAIL"   => "hr_emailid",
            "HR_PHONE"   => "hr_phone",
            "HR_MOBILE"  => "hr_mobile",
            "HR_FUNCTIONS" => "hr_functions",
            "ISACTIVE"   => "isactive",
            "HR_IMG"     => "hr_imageurl"
        ),
        // get-associates
        'get-associates' => array(
            "RECRUTERID" => "userid",
            "USERID" => "assoUserid",
            "USERNAME" => "username",
            "EMAILID" => "emailid",
            "PASSWORD" => "hash",
            "ISACTIVE" => "isactive",
            "RESET_TOKEN" => "resetToken",
            "LAST_LOGIN" => "lastLogin",
            "CREAT_DATE" => "creatDate",
            "EXPIRE_DATE" => "expireDate"
        ),
        
        // 'profile-search'
        'profile-search' => array(
            
            "SEEKERID" => "seekerid",
            "FNAME" => "fname",
            "LNAME" => "lname",
            "GENDER" => "gender",
            "PHONE" => "phone",
            "EMAILID" => "emailid",
            //    
            "SKILLS" => "coreSkills",
            "FUNCTIONS" => "functions",
            "INDUSTRIES" => "industries",
            "LOCATIONS" => "locations",
            "SALARY" => "annualSalary",
            "EXPERIENCE" => "totalExp",
            //
            "ROLE" => "roleId",
            "ROLE_DESC" => "roleId",
            "JOBTYPE" => "jobType",
            "JOBTYPE_DESC" => "jobTypeDesc",
            "EMPTYPE" => "employmentType",
            "EMPTYPE_DESC" => "employmentTypeDesc",
            "TRAVEL" => "travel",
            "TRAVEL_DESC" => "travelDesc",
            //
            "RESUME_ID" => "resumeId",
            "RESUME_NAME" => "resumeName",
            "RESUME_TITEL" => "resumeTitel",
            "RESUME_LINK" => "resumelink",
            "RESUME_STATUS" => "activeStatus",
            "RESUME_CREATE_DT" => "createdDateStr",
            "RESUME_UPDATE_DT" => "updateDateStr",
            //
            "LETTER_ID" => "letterId",
            "LETTER_NAME" => "letterName",
            "LETTER_TITEL" => "letterTitel",
            "LETTER_LINK" => "letterlink",
            "LETTER_STATUS" => "letterStatus",
            "LETTER_CREATE_DT" => "letterCreDt",
            "LETTER_UPDATE_DT" => "letterUpdDt",
            //
            "EMPLOYERE_NAME" => "employereName",
            "EMPLOYERE_TYPE" => "employereType",
            "DESGINATION" => "desgination",
            "EMP_START_DATE" => "empStartDate",
            "EMP_END_DATE" => "empEndDate",
            //
            "EDU_LEVEL" => "eduLevel",
            "EDU_TYPE" => "eduType",
            "EDU_TYPE_DESC" => "eduTypeDesc",
            "INSTITUTE" => "institute",
            "INST_LOC" => "eduLocation",
            //
            "LAST_LOGIN" => "lastLogin",
            "REPO_TYPE" => "repoType"
        ),
        
        // 'candidate-search'
        'candidate-search' => array(
            "SEEKERID" => "seekerid",
            "FNAME" => "fname",
            "LNAME" => "lname",
            "GENDER" => "gender",
            "PHONE" => "phone",
            "EMAILID" => "emailid",
            "SKILLS" => "coreSkills",
            "FUNCTION" => "functionalCode",
            "FUNCTION_DESC" => "functionalCodeDesc",
            "INDUSTRY" => "industryCode",
            "INDUSTRY_DESC" => "industryCodeDesc",
            "LOCATION" => "location",
            "LOCATION_DESC" => "locationDesc",
            "ROLE" => "roleId",
            "ROLE_DESC" => "roleId",
            "SALARY" => "annualSalary",
            "EXPERIENCE" => "totalExp",
            "JOBTYPE" => "jobType",
            "JOBTYPE_DESC" => "jobTypeDesc",
            "EMPTYPE" => "employmentType",
            "EMPTYPE_DESC" => "employmentTypeDesc",
            "TRAVEL" => "travel",
            "TRAVEL_DESC" => "travelDesc",
            "RESUME_ID" => "resumeId",
            "RESUME_NAME" => "resumeName",
            "RESUME_TITEL" => "resumeTitel",
            "RESUME_LINK" => "resumelink",
            "RESUME_STATUS" => "activeStatus",
            "RESUME_CREATE_DT" => "createdDateStr",
            "RESUME_UPDATE_DT" => "updateDateStr",
            "LETTER_ID" => "letterId",
            "LETTER_NAME" => "letterName",
            "LETTER_TITEL" => "letterTitel",
            "LETTER_LINK" => "letterlink",
            "LETTER_STATUS" => "letterStatus",
            "LETTER_CREATE_DT" => "letterCreDt",
            "LETTER_UPDATE_DT" => "letterUpdDt",
            "EMPLOYERE_NAME" => "employereName",
            "EMPLOYERE_TYPE" => "employereType",
            "EMPLOYERE_TYPE_DESC" => "employereTypeDesc",
            "DESGINATION" => "desgination",
            "DESGINATION_DESC" => "desginationDesc",
            "EMP_START_DATE" => "startDateStr",
            "EMP_END_DATE" => "endDateStr",
            "DEGREE" => "degree",
            "DEGREE_DESC" => "degreeDesc",
            "EDU_LEVEL" => "eduLevel",
            "EDU_LEVEL_DESC" => "eduLevelDesc",
            "EDU_TYPE" => "eduType",
            "EDU_TYPE_DESC" => "eduTypeDesc",
            "INSTITUTE" => "institute",
            "INSTITUTE_DESC" => "instituteDesc",
            "STREAM" => "stream",
            "STREAM_DESC" => "streamDesc",
            "EDU_START_YEAR" => "startYear",
            "EDU_PASS_YEAR" => "passYear",
            "LAST_LOGIN" => "lastLogin",
            "REPO_TYPE" => "repoType"
        ),
        //published-jobs
        'published-jobs' => array(
        		
	        "POSTID" => "postid",
        	"REFERENCEID" => "referenceid",
	        "EMPLOYERID" => "employerid",
	        "TITLE" => "title",
            "HIRING_ORGANIZATION"=> "hiringby",
	        "SKILLS" => "skills",
	        
	        "POSITIONS" => "positions",
	        "DETAILS" => "details",
	        "COUNTRY" => "country",
	        "STATE" => "state",
	    	"CITY" => "city",
	    	"POSTCODE" => "postcode",
	    	"ROLE" => "role",
	        "INDUSTRY" => "industry",
	        "FUNCTION" => "function",
	        
	    	"EXPERIENCE" => "experience",
	        "SALARY" => "salary",
	    	"EMPTYPE" => "emptype",
	    	"TRAVEL" => "travel",
	    	
	        "OPEN_DATE" => "openDate",
	        "END_DATE" => "endDate",
	        "ISPREMIUM" => "ispremium",
	        "ISPSU" => "ispsu",
	        "ISINTER" => "isinter",
	        "ISLIVE" => "islive",
	        "ISACTIVE" => "isactive",
	    	"SOURCE" => "source",
	    	"POSTURL" => "applyurl",
	    		
	        "COM_NAME" => "comname",
	        "COM_PROFILE" => "comdetail",
	    	"COM_URL" => "comurl",
	    	"COM_LOGO" => "comlogo",
	    		
	        "HR_PERSON" => "hr_person",
	        "HR_EMAIL" => "hr_email",
	        "HR_PHONE" => "hr_phone",
	    	"HR_MOBILE" => "hr_mobile",
	        "HR_ADDRESS" => "hr_address",
	        
	    	"UPD_BY" => "updBy",
	        "UPD_TS" => "updDt",
	        "ADD_BY" => "addBy",
	        "ADD_TS" => "addDt"
    	),
        
        //post-descs
        'post-descs' => array(
            'POSTID' => 'postid' ,
            'POSITION' => 'index' ,
            'LABEL' => 'label' ,
            'NAME' => 'name' ,
            'DETAIL' => 'text'  
        ),
        
        //draft-jobs
        'draft-jobs' => array(
        		
            "TRANSID" => "transid",
            "LOADID" => "loadid",
            "EMPLOYERID" => "employerId",
        		
            "TITLE" => "title",
            "HIRING_ORGANIZATION"=> "hiringby",
            "SKILLS" => "skills",
            "POSITIONS" => "positions",
            
            "ROLE_ID" => "role",
            "INDUSTRY_ID" => "industry",
            "FUNCTION_ID" => "function",
        	"EXPERIENCE" => "experience",
            "SALARY" => "salary",
        	"EMPTYPE_ID" => "emptype",
        	"TRAVEL_ID" => "travel",
			
        	"COUNTRY_ID" => "country",
        	"STATE_ID" => "state",
        	"LOCATION_ID" => "city",
        	"POSTCODE" => "postcode",
        		
            "DESC_1" => "detail_1",
            "DESC_2" => "detail_2",
        	
            "HR_PERSON" => "hr_person",
	        "HR_EMAIL" => "hr_email",
	        "HR_PHONE" => "hr_phone",
	    	"HR_MOBILE" => "hr_mobile",
	        "HR_ADDRESS" => "hr_address",
            
            "UPD_BY" => "updateBy",
            "UPD_TS" => "updDt",
            "ADD_BY" => "addBy",
            "ADD_TS" => "addDt"
        		
        ),
        
        //'job-applications'
        'job-applications' => array(
            "APPLICATION_ID" => "applicationId",
            "POSTID" => "postId",
            "JOB_TITLE"=>"jobTitle",
            "SEEKERID" => "seekerid",
            "FNAME" => "fname",
            "PHONE" => "phone",
            "EMAILID" => "emailid",
            "STATUS" => "status",
            "ISSHORTLIST" => "isShortList",
            "UPD_TS" => "updateDt",
            "APPLY_DATE" => "applyDt",
            "AGE" => "age"
        ),
        
        //'publis-job-report'
        'publis-job-report' => array(
            "POST_COUNT" => "postCount",
            "ADD_TS" => "date",
            "ADD_DAY" => "day",
            "ADD_MNTH" => "month",
            "ADD_YEAR" => "year"
        ),
        //search-resume-report
        'search-resume-report' => array(
            "SEARCH_COUNT" => "searchCount",
            "SEARCH_DATE" => "date",
            "SEARCH_DAY" => "day",
            "SEARCH_MNTH" => "month",
            "SEARCH_MNTH_NM" => "monthname",
            "SEARCH_YEAR" => "year"
        ),
        //'login-user-report'
        'login-user-report' => array(
            "LOGIN_COUNT" => "loginCount",
            "LOGIN_DATE" => "date",
            "LOGIN_DAY" => "day",
            "LOGIN_MNTH" => "month",
            "LOGIN_MNTH_NM" => "monthname",
            "LOGIN_YEAR" => "year"
        ),
        //pie chart
        'current-status-report' => array(
            "ID" => "id",
            "CATEGORY" => "label",
            "TOTAL" => "value",
            "MONTH_NM" => "month",
            "YEAR_NM" => "year"
        ),
        //'current-status-report'
        'current-status-report' => array(
            "ID" => "id",
            "CATEGORY" => "category",
            "TOTAL" => "total",
            "MONTH_NM" => "month",
            "YEAR_NM" => "year"
        ),
        
        //'repository-usage'
        'repository-usage' => array(
            "TOTAL" => "total",
            "USED" => "used",
            "FREE" => "free",
            "ACCESSDT" => "accessdt"
        ),
        
        //'contactus'
        'contactus' => array(
            "POST_COUNT" => "postCount",
            "ADD_TS" => "date",
            "ADD_DAY" => "day",
            "ADD_MNTH" => "month",
            "ADD_YEAR" => "year"
        ),
        
        //'reset-passwd'
        'reset-passwd' => array(
            "EMAILID" => "emailId",
            "USERNAME" => "userName"
        ),
        
        //'unlock-account'
        'unlock-account' => array(
        ),
        
        //'job-uploads' 
        'job-uploads' => array(
            "LOADID" => "loadLogId",
            "ADD_BY" => "employerid",
            "DATA_TYPE" => "dataCode",
            "DOC_NMAE" => "docName",
            "DOC_TYPE" => "docFmtType",
            "STATUS" => "status",
            "MESSAGE" => "message"
        ),
        
        //'upload-docs' 
        'upload-docs' => array(
            "LOADID" => "loadLogId",
            "ADD_BY" => "employerid",
            "DATA_TYPE" => "dataCode",
            "DOC_NMAE" => "docName",
            "DOC_TYPE" => "docFmtType",
            "PROCESS_DT" => "runDate",
            "STATUS" => "status",
            "ERR_CNT" => "errcnt",
            "MESSAGE" => "message",
            "ADD_BY" => "addBy",
            "ADD_TS" => "addDt",
            "UPD_BY" => "updBy",
            "UPD_TS" => "updDt"
        ),
        //'upload-errors' 
        'upload-errors' => array(
            "LOADID" => "loadlogid",
            "ERROR_ID" => "errorid",
            "ROW_NUM" => "rownum",
            "COLUMN_NM" => "colname",
            "CELL_VAL" => "value",
            "ERR_DES" => "description",
            "ERR_CAT" => "category",
            "ERR_CLR" => "color",
            "ADD_BY" => "addBy",
            "ADD_TS" => "addDt",
            "UPD_BY" => "updBy",
            "UPD_TS" => "updDt"
        ),
        //published-drives
        "published-drives" => array(
            "ID" => "i_walkinid",
            "EMPID" => "i_userid",
            "START_DT" => "i_startdt",
            "END_DT" => "i_enddt",
            "IN_TIME" => "i_intime",
            "OUT_TIME" => "i_outtime",
            "COMPANY" => "i_company",
            "HRPERSON" => "i_hrperson",
            "HREMAIL" => "i_hremail",
            "HRPHONE" => "i_hrphone",
            "VENUE" => "i_venue",
            "TITLE" => "i_title",
            "SKILLS" => "i_skills",
            "MIN_EXP" => "i_minexp",
            "MAX_EXP" => "i_maxexp",
            "FUNCTION" => "i_function",
            "FUN_NAME" => "i_functionnm",
            "LOCID" => "i_location",
            "LOCNM" => "i_locationnm",
            "DETAILS" => "i_description",
            "ISACTIVE" => "i_isactive",
            "UPD_BY" => "i_updby",
            "UPD_TS" => "i_upddt",
            "ADD_BY" => "i_addby",
            "ADD_TS" => "i_adddt"
        ),
        //draft-drives
        "draft-drives" => array(
            "ID" => "transid",
            "LOADID" => "loadid",
            "EMPLOYERID" => "i_userid",
            "COMPANY" => "i_company",
            "VENUE" => "i_venue",
            "HRPERSON" => "i_hrperson",
            "HREMAIL" => "i_hremail",
            "HRPHONE" => "i_hrphone",
            "TITLE" => "i_title",
            "SKILLS" => "i_skills",
            "FUNCTION_ID" => "i_function",
            "FUNCTION" => "i_functionnm",
            "LOCATION_ID" => "i_location",
            "LOCATION_NM" => "i_locationnm",
            "MIN_EXP" => "i_minexp",
            "MAX_EXP" => "i_maxexp",
            "OPEN_DATE" => "i_startdt",
            "END_DATE" => "i_enddt",
            "IN_TIME" => "i_intime",
            "OUT_TIME" => "i_outtime",
            "DETAILS" => "i_description",
            "UPD_BY" => "i_updby",
            "UPD_TS" => "i_upddt",
            "ADD_BY" => "i_addby",
            "ADD_TS" => "i_adddt"
        ),
        
        //draft-drives
        "pi-chart" => array(
            "ID" => "id",
            "COLOR" => "color",
            "HIGHLIGHT" => "highlight",
            "LABEL" => "label",
            "VALUE" => "value",
        ),
        
        //access-plan
        "plan-detail" => array(
            "PLAN_CD" => "planid",
            "PLAN_NM" => "plannm",
            "PLAN_DESC" => "description",
            "PRICE" => "price",
            "ISACTIVE" => "isactive",
            "START_DATE" => "startdt",
            "END_DATE" => "enddt",
            "UPD_BY" => "i_updby",
            "UPD_TS" => "i_upddt",
            "ADD_BY" => "i_addby",
            "ADD_TS" => "i_adddt"
        ),
        
        //access-plan
        "access-plan" => array(
            "PLAN_CD" => "planid",
            "ITEM_CD" => "itemid",
            "ITEM" => "itemdt",
            "USE_LIMIT" => "limit",
            "USED" => "usages",
        )
    );

    public static function getMapping($key) {
        return MappingHelper::$DAO_MAPPINGS[$key];
    }

}
