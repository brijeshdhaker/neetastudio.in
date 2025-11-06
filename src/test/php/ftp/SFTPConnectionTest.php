<?php declare(strict_types=1);

use PHPUnit\Framework\TestCase;


/*
 * Mock ssh2 functions so the SFTPConnection class can be tested without a real SSH/SFTP server.
 * The mocks consult global variables to decide their return values so each test can configure behavior.
 */

if (!function_exists('ssh2_connect')) {
    function ssh2_connect($host, $port = 22) {
        $args = func_get_args();
        $GLOBALS['__mock_ssh2_connect_args'] = $args;
        return $GLOBALS['__mock_ssh2_connect_result'] ?? false;
    }
}

if (!function_exists('ssh2_auth_password')) {
    function ssh2_auth_password($connection, $username, $password) {
        $args = func_get_args();
        $GLOBALS['__mock_ssh2_auth_args'] = $args;
        return $GLOBALS['__mock_ssh2_auth_result'] ?? false;
    }
}

if (!function_exists('ssh2_sftp')) {
    function ssh2_sftp($connection) {
        $args = func_get_args();
        $GLOBALS['__mock_ssh2_sftp_args'] = $args;
        return $GLOBALS['__mock_ssh2_sftp_result'] ?? false;
    }
}

final class SFTPConnectionTest extends TestCase
{
    private $sutFile;

    protected function setUp(): void
    {
        // ensure the SFTPConnection class is (re)loaded for each test
        $this->sutFile = __DIR__ . '/SFTPConnection.php';

        // reset mock control globals
        $GLOBALS['__mock_ssh2_connect_result'] = null;
        $GLOBALS['__mock_ssh2_auth_result'] = null;
        $GLOBALS['__mock_ssh2_sftp_result'] = null;
        unset($GLOBALS['__mock_ssh2_connect_args'], $GLOBALS['__mock_ssh2_auth_args'], $GLOBALS['__mock_ssh2_sftp_args']);

        // If the class was already declared in this PHP process, remove it by using runkit isn't available.
        // To ensure a fresh include, use require_once only if not loaded. Tests below rely on mocks set before first include.
        if (!class_exists('SFTPConnection', false)) {
            require_once $this->sutFile;
        }
    }

    public function testConstructorThrowsWhenConnectionFails()
    {
        $GLOBALS['__mock_ssh2_connect_result'] = false;
        $this->expectException(Exception::class);
        $this->expectExceptionMessageMatches('/Could not connect/');
        new SFTPConnection('example.com', 22);
    }

    public function testLoginThrowsWhenAuthFails()
    {
        $GLOBALS['__mock_ssh2_connect_result'] = (object) ['dummy' => true];
        $GLOBALS['__mock_ssh2_auth_result'] = false;
        $sftp = new SFTPConnection('example.com', 22);
        $this->expectException(Exception::class);
        $this->expectExceptionMessageMatches('/Could not authenticate/');
        $sftp->login('user', 'badpass');
    }

    public function testLoginThrowsWhenSftpInitFails()
    {
        $GLOBALS['__mock_ssh2_connect_result'] = (object) ['dummy' => true];
        $GLOBALS['__mock_ssh2_auth_result'] = true;
        $GLOBALS['__mock_ssh2_sftp_result'] = false;
        $sftp = new SFTPConnection('example.com', 22);
        $this->expectException(Exception::class);
        $this->expectExceptionMessageMatches('/Could not initialize SFTP subsystem/');
        $sftp->login('user', 'pass');
    }

    public function testUploadFileThrowsWhenRemoteOpenFails()
    {
        // successful connect/auth/sftp init
        $GLOBALS['__mock_ssh2_connect_result'] = (object) ['dummy' => true];
        $GLOBALS['__mock_ssh2_auth_result'] = true;
        // return a string so the ssh2.sftp:// wrapper path is syntactically valid but not available, causing fopen to fail
        $GLOBALS['__mock_ssh2_sftp_result'] = 'mocked_sftp_resource';

        $sftp = new SFTPConnection('example.com', 22);
        $sftp->login('user', 'pass');

        // create a temp local file to ensure file_get_contents succeeds
        $tmp = tempnam(sys_get_temp_dir(), 'sftp_test_');
        file_put_contents($tmp, "hello content");

        $this->expectException(Exception::class);
        $this->expectExceptionMessageMatches('/Could not open file:/');
        try {
            $sftp->uploadFile($tmp, '/remote/path/file.txt');
        } finally {
            @unlink($tmp);
        }
    }

    public function testReceiveFileThrowsWhenRemoteOpenFails()
    {
        $GLOBALS['__mock_ssh2_connect_result'] = (object) ['dummy' => true];
        $GLOBALS['__mock_ssh2_auth_result'] = true;
        $GLOBALS['__mock_ssh2_sftp_result'] = 'mocked_sftp_resource';

        $sftp = new SFTPConnection('example.com', 22);
        $sftp->login('user', 'pass');

        $tmpLocal = sys_get_temp_dir() . '/should_not_be_created_' . uniqid();
        @unlink($tmpLocal);

        $this->expectException(Exception::class);
        $this->expectExceptionMessageMatches('/Could not open file:/');
        $sftp->receiveFile('/remote/path/file.txt', $tmpLocal);

        // ensure no file created
        $this->assertFileDoesNotExist($tmpLocal);
    }

    public function testGetFileSizeReturnsFalseWhenFilesizeFails()
    {
        $GLOBALS['__mock_ssh2_connect_result'] = (object) ['dummy' => true];
        $GLOBALS['__mock_ssh2_auth_result'] = true;
        $GLOBALS['__mock_ssh2_sftp_result'] = 'mocked_sftp_resource';

        $sftp = new SFTPConnection('example.com', 22);
        $sftp->login('user', 'pass');

        // Since the ssh2.sftp wrapper is not registered, filesize will fail and return false.
        $result = $sftp->getFileSize('/remote/nonexistent.file');
        $this->assertFalse($result);
    }
}