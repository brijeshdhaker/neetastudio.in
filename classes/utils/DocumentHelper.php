<?php

/**
 * Description of DocumentHelper
 * @author brijeshdhaker
 */
class DocumentHelper {
    
    const RESUME_UPLOAD_DIR  = 'resumes/';
    //
    const LETTER_UPLOAD_DIR  = 'letters/';
    //
    const LOGO_UPLOAD_DIR  = 'logos/';
    //
    const PROFILE_UPLOAD_DIR  = 'profiles/';
    //
    const DEFAULT_UPLOAD_DIR = 'uploads/';
    //
    const EMP_UPLOAD_DIR = 'emp-docs/';
    //
    const JOBS_UPLOAD_DIR = 'emp-docs/';
    //
    const DRIVE_UPLOAD_DIR = 'emp-docs/';
    //
    const TEMP_ZIP_DIR = 'archives/';
    //
    const TEMP_DIR     = 'temp/';
    //
    /* Figure out the MIME type | Check in array */
    static $KNOWN_MIME_TYPES = array(
        "pdf" => "application/pdf",
        "txt" => "text/plain",
        "html" => "text/html",
        "htm" => "text/html",
        "exe" => "application/octet-stream",
        "zip" => "application/zip",
        "doc" => "application/msword",
        "xls" => "application/vnd.ms-excel",
        "ppt" => "application/vnd.ms-powerpoint",
        "gif" => "image/gif",
        "png" => "image/png",
        "jpeg" => "image/jpg",
        "jpg" => "image/jpg",
        "php" => "text/plain"
    );
    
    //
    static $ACCEPTABLE_EXTENSIONS = array(
        "pdf", 
        "doc", 
        "docx", 
        "txt", 
        "rtf"
    );
    
    //
    static $LOGO_FILE_EXTENSIONS = array(
        "jpg", 
        "jpeg", 
        "png", 
        "gif"
    );
    
    //
    static $DATA_FILE_EXTENSIONS = array(
        "xls", 
        "xlsx", 
        "csv"
    );
    
    var $baseDir;
    var $subDir;
    private $pathinfo;
    
    /**
     * @return the environment
     */
    function __construct($baseDir, $subDir) {
        //$_SERVER ['DOCUMENT_ROOT']
        $this->baseDir = is_null($baseDir) ? OnclickEnv::getRepositoryPath() : $baseDir ;
        $this->subDir  = is_null($subDir)  ? DocumentHelper::DEFAULT_UPLOAD_DIR : $subDir;
    }

    /**
     * 
     * @param type $pathinfo
     * @return boolean
     */
    private function validateUpload($pathinfo) {
        $isValid = FALSE;
        $ext = strtolower($pathinfo["extension"]);
        //
        switch($this->subDir){
            case  DocumentHelper::RESUME_UPLOAD_DIR :
            case  DocumentHelper::LETTER_UPLOAD_DIR :
                $exts = self::$ACCEPTABLE_EXTENSIONS;
                break;
            case  DocumentHelper::LOGO_UPLOAD_DIR :
            case  DocumentHelper::PROFILE_UPLOAD_DIR :
                $exts = self::$LOGO_FILE_EXTENSIONS;
                break;
            case  DocumentHelper::JOBS_UPLOAD_DIR :
                $exts = self::$DATA_FILE_EXTENSIONS;
                break;
            default :
                $exts = self::$ACCEPTABLE_EXTENSIONS;
        }
        //
        for ($x = 0; $x < count($exts); $x++) {
            if ($ext == $exts[$x]) {
                $isValid = TRUE;
                break;
            }
        }
        return $isValid;
    }
    
    private function getDocumentName($fileObject,$docid){
        //
        $docname = null;
        if ($fileObject) {
            $fileName = $fileObject['name'];
            $pathinfo = pathinfo($fileName);
            switch($this->subDir){
                case  DocumentHelper::RESUME_UPLOAD_DIR :
                    $docname = is_null($docid) ? $fileName : ("RESUME-".$docid.".".$pathinfo['extension']);
                    break;
                case  DocumentHelper::LETTER_UPLOAD_DIR :
                    $docname = is_null($docid) ? $fileName : ("RESUME-".$docid.".".$pathinfo['extension']);
                    break;
                case  DocumentHelper::LOGO_UPLOAD_DIR :
                    $docname = is_null($docid) ? $fileName : ("LOGO-".$docid.".".$pathinfo['extension']);
                    break;
                case  DocumentHelper::JOBS_UPLOAD_DIR :
                    $docname = is_null($docid) ? $fileName : ("UPLOAD_11_".$docid.".".$pathinfo['extension']);
                    break;
                case  DocumentHelper::DRIVE_UPLOAD_DIR :
                    $docname = is_null($docid) ? $fileName : ("UPLOAD_12_".$docid.".".$pathinfo['extension']);
                    break;
                case  DocumentHelper::PROFILE_UPLOAD_DIR :
                    $docname = is_null($docid) ? $fileName : ("PROFILE-".$docid.".".$pathinfo['extension']);
                    break;
                default :
                    $docname = $fileName;
            }
        }
        
        return $docname;
    }
    
    /**
     * 
     * @param type $fileObject
     * @param type $docid
     * @return string
     * @throws Exception
     */
    public function uploadDocument($fileObject, $docid = null, $name = null) {
        $doclink = null;
        if ($fileObject) {
            $fileName = $fileObject['name'];
            $pathinfo = pathinfo($fileName);
            if ($this->validateUpload($pathinfo)) {
                // Get important information about the file and put it into variables
                $tmpName  = $fileObject['tmp_name'];
                $fileSize = $fileObject['size'];
                $fileType = $fileObject['type'];

                // Slurp the content of the file into a variable
                $fp = fopen($tmpName, 'r');
                $content = fread($fp, filesize($tmpName));
                $content = addslashes($content);
                fclose($fp);
                if (!get_magic_quotes_gpc()) {
                    $fileName = addslashes($fileName);
                }
                //
                if($name != null){
                    $docname = $name;
                }else{
                    $docname = $this->getDocumentName($fileObject, $docid);
                }
                //
                $doclink = $this->subDir . $docname;
                // if exists deleting file.
                $rAbsolutePath = $this->baseDir .$doclink;
                if (file_exists($rAbsolutePath)) {
                    unlink($rAbsolutePath);
                }
                //copy file conetent
                move_uploaded_file($fileObject["tmp_name"], $rAbsolutePath);
                
            }else{
                throw  new Exception("Uploaded document type is not acceptable.", 100);
            }
        }
        return $doclink;
    }
    /**
     * 
     * @param type $path
     * @param type $docid
     * @param type $iszip
     */
    public function saveDocument($filedata, $filenm) {
        //
        $doclink="";
        if(!is_null($filenm) && $filedata){
            //
            $doclink = $this->subDir . $filenm;
            // if exists deleting file.
            $rAbsolutePath = $this->baseDir .$doclink;
            if (file_exists($rAbsolutePath)) {
                unlink($rAbsolutePath);
            }
            //
            $bin = base64_decode($filedata);
            file_put_contents($rAbsolutePath, $bin);
            //
        }
        return $doclink;
    }
    /**
     * 
     * @param type $path
     * @param type $docid
     * @param type $iszip
     */
    public function downloadDocument($filepath, $delete = FALSE) {
        $path = $this->baseDir.$filepath;
        if (!is_null($path)) {
            $fd = fopen($path, "r");
            if ($fd) {
                $fsize = filesize($path);
                $pathinfo = pathinfo($path);
                $fname = $pathinfo["basename"];
                $ext = strtolower($pathinfo["extension"]);
                $types = self::$KNOWN_MIME_TYPES;
                if (array_key_exists($ext, $types)) {
                    $mime_type = $types[$ext];
                } else {
                    $mime_type = "application/force-download";
                }
                $timestamp = date('d-m-y_H-i');
                header('Content-Type: ' . $mime_type);
                header("Content-Disposition: attachment; filename=$fname");
                header("Content-length: $fsize");
                header("Cache-control: private");
                header('Pragma: private');
                header("Expires: 0");
                header("Content-Transfer-Encoding: binary");
                header('Accept-Ranges: bytes');
                while (!feof($fd)) {
                    $buffer = fread($fd, 2048);
                    echo $buffer;
                }
                fclose($fd);
                // deleting temp zip file.
                if($delete){
                    $this->deleteDocument($filepath);
                }
                exit;
            }
        }
    }

    /**
     * 
     * @param type $docid
     * @param type $filepath
     */
    public function downloadAsZip($path, $docid = null) {
        if (!is_null($path)) {
            $pathinfo = pathinfo($path);
            $fname = $pathinfo["basename"];
            $dwname = is_null($docid) ? $fname.".zip" : "RESUME-" . $docid . ".zip";
            $destination = DocumentHelper::TEMP_ZIP_DIR . $dwname;
            $isexist = $this->createZipFile(array($path), $destination, true);
            if ($isexist) {
                $this->downloadDocument($destination, TRUE);
            }
        }
    }

    /**
     * 
     * @param type $files
     * @param type $destination
     * @param type $overwrite
     * @return boolean
     */
    public function createZipFile($files = array(), $destination = '', $overwrite = true) {
        //if the zip file already exists and overwrite is false, return false
        if (file_exists($this->baseDir . $destination) && !$overwrite) {
            return false;
        }
        //vars
        $valid_files = array();
        //if files were passed in...
        if (is_array($files)) {
            //cycle through each file
            foreach ($files as $file) {
                //make sure the file exists
                if (file_exists($this->baseDir . $file)) {
                    $valid_files[] = $this->baseDir . $file;
                }
            }
        }
        if (count($valid_files)) {
            //create the archive
            $zip = new ZipArchive();
            if ($zip->open($this->baseDir . $destination, $overwrite ? ZIPARCHIVE::OVERWRITE : ZIPARCHIVE::CREATE) !== true) {
                return false;
            }
            //add the files
            foreach ($valid_files as $file) {
                $zip->addFile($file, $file);
            }
            //echo 'The zip archive contains ',$zip->numFiles,' files with a status of ',$zip->status;
            //close the zip -- done!
            $zip->close();
            //check to make sure the file exists
            return file_exists($this->baseDir . $destination);
        } else {
            return false;
        }
    }

    /**
     * 
     * @param type $absolutePath
     */
    public function deleteDocument($path) {
        $absolutePath = $this->baseDir . $path;
        if (file_exists($absolutePath)) {
            unlink($absolutePath);
        }
        //fclose($ftd);
    }

}
