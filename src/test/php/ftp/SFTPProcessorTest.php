<?php declare(strict_types=1);

use PHPUnit\Framework\TestCase;

if (!class_exists('FTPInfo')) {
    class FTPInfo {
        public static $LTR = 'LTR';
        public static $RTL = 'RTL';

        private $direction;
        private $remoteDir;
        private $remoteFile;
        private $localDir;
        private $localFile;
        private $isdelete = null;

        public function __construct($direction, $remoteDir = '/remote', $remoteFile = 'file.txt', $localDir = '/tmp', $localFile = 'file.txt') {
            $this->direction = $direction;
            $this->remoteDir = $remoteDir;
            $this->remoteFile = $remoteFile;
            $this->localDir = $localDir;
            $this->localFile = $localFile;
        }

        public function getDirection() { return $this->direction; }
        public function getRemoteDir() { return $this->remoteDir; }
        public function getRemoteFile() { return $this->remoteFile; }
        public function getLocalDir() { return $this->localDir; }
        public function getLocalFile() { return $this->localFile; }
        public function setIsdelete($v) { $this->isdelete = $v; }
        public function getIsdelete() { return $this->isdelete; }
    }
}

if (!class_exists('FTPUtil')) {
    class FTPUtil {
        // Return a dummy value used by SFTPProcessor when building stream URIs.
        public static function createSFTPConnection($ftpinfo) {
            return 'dummy_sftp_resource';
        }
    }
}

// Ensure the class under test is available
//require(__DIR__ . '/src/main/php/ftp/SFTPProcessor.php');

class SFTPProcessorTest extends TestCase {

    /**
     * Sets up the fixture, for example, opens a network connection.
     * This method is called before a test is executed.
     */
    #[\Override]
    protected function setUp(): void {
        
    }

    /**
     * Tears down the fixture, for example, closes a network connection.
     * This method is called after a test is executed.
     */
    #[\Override]
    protected function tearDown(): void {
        
    }

    public function test_sftpStream_put_throws_when_cannot_open_remote() {
        
        $info = new FTPInfo(FTPInfo::$LTR, '/remoteDir', 'remote.txt', sys_get_temp_dir(), 'local.txt');
        // Ensure local file exists so file_get_contents would succeed if remote fopen succeeded.
        $localPath = $info->getLocalDir() . DIRECTORY_SEPARATOR . $info->getLocalFile();
        file_put_contents($localPath, "test");

        $rfile = $info->getRemoteDir() . "/" . $info->getRemoteFile();

        $this->expectException(Exception::class);
        $this->expectExceptionMessage("Could not open file: $rfile");

        // Since ssh2.sftp stream wrapper won't be available for the dummy resource,
        // fopen will fail and an exception should be thrown from sftpStream().
        SFTPProcessor::sftpStream($info);

        // cleanup
        @unlink($localPath);
    }

    public function test_sftpStream_get_throws_when_cannot_open_remote() {
        
        $info = new FTPInfo(FTPInfo::$RTL, '/remoteDir', 'remote_read.txt', sys_get_temp_dir(), 'local_read.txt');

        $rfile = $info->getRemoteDir() . "/" . $info->getRemoteFile();

        $this->expectException(Exception::class);
        $this->expectExceptionMessage("Could not open file: $rfile");

        SFTPProcessor::sftpStream($info);
    }

    public function test_copyFile_sets_isdelete_false_before_operation() {
        
        $info = new FTPInfo(FTPInfo::$LTR, '/remoteDir', 'r.txt', sys_get_temp_dir(), 'l.txt');

        // call and catch exception to allow assertions after
        try {
            SFTPProcessor::copyFile($info);
            $this->fail("Expected exception was not thrown.");
        } catch (Exception $e) {
            // setIsdelete should have been called with FALSE by copyFile before attempting transfer
            $this->assertFalse($info->getIsdelete(), "copyFile should set isdelete to FALSE");
        }
    }

    public function test_moveFile_sets_isdelete_true_before_operation() {

        $info = new FTPInfo(FTPInfo::$LTR, '/remoteDir', 'r2.txt', sys_get_temp_dir(), 'l2.txt');

        try {
            SFTPProcessor::moveFile($info);
            $this->fail("Expected exception was not thrown.");
        } catch (Exception $e) {
            // setIsdelete should have been called with TRUE by moveFile before attempting transfer
            $this->assertTrue($info->getIsdelete(), "moveFile should set isdelete to TRUE");
        }
    }
}