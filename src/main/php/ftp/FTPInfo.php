<?php
/**
 * Description of FTPInfo
 * @author brijeshdhaker
 */
class FTPInfo {
    
    public static $LTR = "LTR";
    public static $RTL = "RTL";
    
    private $port;
	private $localHost;
	private $localDir;
	private $localFile;
	private $localUser;
	private $tempDir;

	private $remoteHost;
	private $remoteDir;
	private $remoteFile;
	private $remoteUser;
	private $remotePasswd;
	
	private $privateKey;
	private $keypasswd;
	private $knownHost;
	
	private $passwdless;
	private $direction;
	private $isdelete;
	
	function getPort() {
        return $this->port;
    }

    function getLocalHost() {
        return $this->localHost;
    }

    function getLocalDir() {
        return $this->localDir;
    }

    function getLocalFile() {
        return $this->localFile;
    }

    function getLocalUser() {
        return $this->localUser;
    }

    function getTempDir() {
        return $this->tempDir;
    }

    function getRemoteHost() {
        return $this->remoteHost;
    }

    function getRemoteDir() {
        return $this->remoteDir;
    }

    function getRemoteFile() {
        return $this->remoteFile;
    }

    function getRemoteUser() {
        return $this->remoteUser;
    }

    function getRemotePasswd() {
        return $this->remotePasswd;
    }

    function getPrivateKey() {
        return $this->privateKey;
    }

    function getKeypasswd() {
        return $this->keypasswd;
    }

    function getKnownHost() {
        return $this->knownHost;
    }

    function getPasswdless() {
        return $this->passwdless;
    }

    function getDirection() {
        return $this->direction;
    }

    function setPort($port) {
        $this->port = $port;
    }

    function setLocalHost($localHost) {
        $this->localHost = $localHost;
    }

    function setLocalDir($localDir) {
        $this->localDir = $localDir;
    }

    function setLocalFile($localFile) {
        $this->localFile = $localFile;
    }

    function setLocalUser($localUser) {
        $this->localUser = $localUser;
    }

    function setTempDir($tempDir) {
        $this->tempDir = $tempDir;
    }

    function setRemoteHost($remoteHost) {
        $this->remoteHost = $remoteHost;
    }

    function setRemoteDir($remoteDir) {
        $this->remoteDir = $remoteDir;
    }

    function setRemoteFile($remoteFile) {
        $this->remoteFile = $remoteFile;
    }

    function setRemoteUser($remoteUser) {
        $this->remoteUser = $remoteUser;
    }

    function setRemotePasswd($remotePasswd) {
        $this->remotePasswd = $remotePasswd;
    }

    function setPrivateKey($privateKey) {
        $this->privateKey = $privateKey;
    }

    function setKeypasswd($keypasswd) {
        $this->keypasswd = $keypasswd;
    }

    function setKnownHost($knownHost) {
        $this->knownHost = $knownHost;
    }

    function setPasswdless($passwdless) {
        $this->passwdless = $passwdless;
    }

    function setDirection($direction) {
        $this->direction = $direction;
    }
    
    
    function getIsdelete() {
        return $this->isdelete;
    }

    function setIsdelete($isdelete) {
        $this->isdelete = $isdelete;
    }
    
}
