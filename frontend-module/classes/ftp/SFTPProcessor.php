<?php

/**
 * Description of SFTPProcessor
 * @author brijeshdhaker
 */
class SFTPProcessor {
    
    /**
     * Performs file copy/move to and copy/move from remote / local servers, based on the copyDirection Param
     * @param hostName - Remote Hostname
     * @param sftpUser - Remote User for SFTP
     * @param remoteFolder - Remote Folder Name
     * @param localFolder - Local Folder Name
     * @param fileName - Actual File to be copied (Copies as is, no rain checks....)
     * @param copyDirection - FTPUtil.CopyDirection.RTL => Remote to Local (FTP GET) & FTPUtil.CopyDirection.LTR => Local to Remote (FTP PUT)
     * @param moveFile - FTPUtil.RemoveSourceAfterCopy.YES => Move/transfer of file & FTPUtil.RemoveSourceAfterCopy.No => Copy of file
     */
    public static function sftpStream($ftpinfo) {
    	//
    	$sftp = FTPUtil::createSFTPConnection($ftpinfo);
        
        // upload a file
        $rfile = $ftpinfo->getRemoteDir()."/". $ftpinfo->getRemoteFile();
        $lfile = $ftpinfo->getLocalDir()."/". $ftpinfo->getLocalFile();
        
        if ($ftpinfo->getDirection() == FTPInfo::$LTR) {
            
        //Write a remote file
            $stream = fopen("ssh2.sftp://{$sftp}{$rfile}", 'w');
            if (!$stream) {
                throw new Exception("Could not open file: $rfile");
            }
            
            $contents = file_get_contents($lfile);
            if (!$contents) {
                throw new Exception("Could not open local file : $lfile.");
            }
            
            if (!fwrite($stream,$contents)) {
                throw new Exception("Could not send data from file : $lfile.");
            }
            fclose($stream);
            
            // try to delete local file
            if ($ftpinfo->getIsdelete()) {
                unlink($lfile);
            }
            
        } else {
            //download a file
            $stream = fopen("ssh2.sftp://{$sftp}{$rfile}", 'r');
            if (!$stream) {
                throw new Exception("Could not open file: $rfile");
            }
            return $stream;
        }
    }
    /**
     * Performs file copy/move to and copy/move from remote / local servers, based on the copyDirection Param
     * @param hostName - Remote Hostname
     * @param sftpUser - Remote User for SFTP
     * @param remoteFolder - Remote Folder Name
     * @param localFolder - Local Folder Name
     * @param fileName - Actual File to be copied (Copies as is, no rain checks....)
     * @param copyDirection - FTPUtil.CopyDirection.RTL => Remote to Local (FTP GET) & FTPUtil.CopyDirection.LTR => Local to Remote (FTP PUT)
     * @param moveFile - FTPUtil.RemoveSourceAfterCopy.YES => Move/transfer of file & FTPUtil.RemoveSourceAfterCopy.No => Copy of file
     */
    private static function sftpFile($ftpinfo) {
    	//
    	$sftp = FTPUtil::createSFTPConnection($ftpinfo);
        
        // upload a file
        $rfile = $ftpinfo->getRemoteDir()."/". $ftpinfo->getRemoteFile();
        $lfile = $ftpinfo->getLocalDir()."/". $ftpinfo->getLocalFile();
        
        if ($ftpinfo->getDirection() == FTPInfo::$LTR) {
            
        //Write a remote file
            $stream = fopen("ssh2.sftp://{$sftp}{$rfile}", 'w');
            if (!$stream) {
                throw new Exception("Could not open file: $rfile");
            }
            
            $contents = file_get_contents($lfile);
            if (!$contents) {
                throw new Exception("Could not open local file : $lfile.");
            }
            
            if (!fwrite($stream,$contents)) {
                throw new Exception("Could not send data from file : $lfile.");
            }
            fclose($stream);
            
            // try to delete local file
            if ($ftpinfo->getIsdelete()) {
                unlink($lfile);
            }
            
        } else {
            
            //download a file
            $stream = fopen("ssh2.sftp://{$sftp}{$rfile}", 'r');
            if (!$stream) {
                throw new Exception("Could not open file: $rfile");
            }
            
            //$contents = fread($stream, filesize("ssh2.sftp://{$sftp}{$rfile}"));
            $contents = file_get_contents("ssh2.sftp://{$sftp}{$rfile}");
            file_put_contents($lfile, $contents);
            fclose($stream);
            
            // try to delete remote file
            if ($ftpinfo->getIsdelete()) {
            	unlink("ssh2.sftp://{$sftp}{$rfile}");
            }
        }
    }

    /**
     * Performs file copy to and copy from remote / local servers, based on the copyDirection Param
     * @param ftpinfo - Remote Hostname
     */
    public static function copyFile($ftpinfo) {
        $ftpinfo->setIsdelete(FALSE);
        SFTPProcessor::sftpFile($ftpinfo);
    }

    /**
     * Performs file move to and move from remote / local servers, based on the copyDirection Param
     * @param ftpinfo - Remote Hostname
     */
    public static function moveFile($ftpinfo) {
        $ftpinfo->setIsdelete(TRUE);
        SFTPProcessor::sftpFile($ftpinfo);
    }

}

?>