<?php
/**
 * Description of DatabaseInfo
 * @author brijeshdhaker
 */
class DataSourceInfo {
    
    private $dbhostname;
    private $dbusername;
    private $dbpassword;
    private $dbname;
    private $driver = 'pdo';
    /**
     * @return the environment
     */
    function __construct($driver) {
        if(!is_null($driver)){
            $this->driver = $driver;    
        }
        
        switch (OnclickEnv::getEnvName()) {
            
            case CONSTANTS::ONCLICK_DEV:
                
                $this->dbhostname = "mysqlserver.sandbox.net";
                $this->dbusername = "neetastudio";
                $this->dbpassword = "Accoo7@k47";
                $this->dbname = "NEETASTUDIO";
                
                break;
            case CONSTANTS::ONCLICK_SIT:
                
                $this->dbhostname = "mysqlserver.sandbox.net";
                $this->dbusername = "neetastudio";
                $this->dbpassword = "Accoo7@k47";
                $this->dbname = "NEETASTUDIO";
                
                break;
            case CONSTANTS::ONCLICK_UAT:

                $this->dbhostname = "mysqlserver.sandbox.net";
                $this->dbusername = "mysqladmin";
                $this->dbpassword = "mysqladmin";
                $this->dbname = "NEETASTUDIO";
                
                break;
            case CONSTANTS::ONCLICK_PROD:
                
                $this->dbhostname = "mysqlserver.sandbox.net";
                $this->dbusername = "neetastudio";
                $this->dbpassword = "Accoo7@k47";
                $this->dbname = "NEETASTUDIO";
                
                break;
            default:
                throw new Exception("provide correct environment.",100);
        }
    }
    
    public function getDBConnection(){
        switch ($this->driver) {
            case CONSTANTS::DRIVER_MYSQL:
                $connection = mysql_connect($this->dbhostname, $this->dbusername, $this->dbpassword) or die("Opps some thing went wrong");
                mysql_select_db($this->dbname, $connection) or die("Opps some thing went wrong");

                break;
            case CONSTANTS::DRIVER_MYSQLI:
                $connection = new mysqli($this->dbhostname, $this->dbusername, $this->dbpassword, $this->dbname);
                if (mysqli_connect_errno()) {
                    printf("Connect failed: %s\n", mysqli_connect_error());
                    exit();
                }

                break;
            case CONSTANTS::DRIVER_PDO:
                try {
                    $connection = new PDO(
                        "mysql:host={$this->dbhostname};dbname={$this->dbname}",
                        $this->dbusername, 
                        $this->dbpassword, 
                        array(
                            PDO::ATTR_PERSISTENT => true
                        )
                    );
                    //$connection->setAttribute(PDO::ATTR_ERRMODE, PDO::ERRMODE_EXCEPTION);
                } catch (PDOException $pe) {
                    die('Connection error, because: ' . $pe->getMessage());
                }
                break;
            default:
                throw new Exception("Could not established database connection.",100);
        }
        return $connection;
    }
    
}
