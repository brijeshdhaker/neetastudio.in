<?php
/**
 * Description of FTPProcessor
 * @author brijeshdhaker
 */
class FTPProcessor {
    /**
     * 
     * Performs file copy/move to and copy/move from remote / local servers, based on the copyDirection Param
     * @param hostName - Remote Hostname
     */
    private static function ftpFile($ftpinfo) {
        $ftp = FTPUtil::createFTPConnection($ftpinfo);
        // upload a file
        $rfile = $ftpinfo->getRemoteDir()."/". $ftpinfo->getRemoteFile();
        $lfile = $ftpinfo->getLocalDir()."/". $ftpinfo->getLocalFile();
        //
        if ($ftpinfo->getDirection() == FTPInfo::$LTR){
            $result = ftp_put($ftp, $rfile, $lfile, FTP_BINARY);
            if (!$result) {
                throw new Exception("Could not copied {$lfile} on FTP Server as {$rfile} .");
            }
            // Delete local file
            if ($ftpinfo->getIsdelete()) {
                $result =  unlink($lfile);
                if(!$result){
                    throw new Exception("Could not delete local file {$lfile} .");
                }
            }
        } else {
            //download a remote file 
            $result = ftp_get($ftp, $lfile, $rfile, FTP_BINARY);
            if (!$result) {
                throw new Exception("Could not retrived {$rfile} from FTP Server.");
            }
            
            // Delete remote file
            if ($ftpinfo->getIsdelete()) {
                $result = ftp_delete($ftp, $rfile);
                if(!$result){
                    throw new Exception("Could not delete {$rfile} on FTP Server.");
                }
            }
        }
        // close the connection
        ftp_close($ftp);
    }

    /**
     * 
     * Performs file copy to and copy from remote / local servers, based on the copyDirection Param
     * @param hostName - Remote Hostname
     */
    public static function copyFile($ftpinfo) {
        $ftpinfo->setIsdelete(FALSE);
        FTPProcessor::ftpFile($ftpinfo);
    }

    /**
     * 
     * Performs file move to and move from remote / local servers, based on the copyDirection Param
     * @param hostName - Remote Hostname
     */
    public static function moveFile($ftpinfo) {
        $ftpinfo->setIsdelete(TRUE);
        FTPProcessor::ftpFile($ftpinfo);
    }

}
?>