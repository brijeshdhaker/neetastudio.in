<?php
/**
 * Description of SFTPUtil
 * @author brijeshdhaker
 */
class FTPUtil {
    
    public static function createSFTPConnection($ftpinfo) {
        // setup ssh connection
        $hostname = $ftpinfo->getRemoteHost();
        $port = $ftpinfo->getPort();
        if(is_null($port)){
            $port = 22;
        }
        $ssh = ssh2_connect($hostname, $port);
        if (!$ssh) {
            throw new Exception("Could not connect to $hostname on port $port.");
        }
        // login with username and password
        $sftpuser = $ftpinfo->getRemoteUser();
        $sftppasswd = $ftpinfo->getRemotePasswd();
        $result = ssh2_auth_password($ssh, $sftpuser, $sftppasswd);
        if (!$result) {
            throw new Exception("Could not authenticate with username $sftpuser " ." and password $sftppasswd.");
        }
        //Initialize SFTP subsystem
        $sftp = ssh2_sftp($ssh);
        return $sftp;
    }
    
    public static function createFTPConnection($ftpinfo) {
        // set up basic connection
        $hostname = $ftpinfo->getRemoteHost();
        $ftp = ftp_connect($hostname);
        if (!$ftp) {
            throw new Exception("Could not connect to {$hostname} .");
        }
        // login with username and password
        $ftpuser = $ftpinfo->getRemoteUser();
        $ftppasswd = $ftpinfo->getRemotePasswd();
        $result = ftp_login($ftp, $ftpuser, $ftppasswd);
        if (!$result) {
            throw new Exception("Could not authenticate with username {$ftpuser} .");
        }
        return $ftp;
    }
    
}

?>
