<?php

try {

    // Read the database connection parameters from environment variables
    $db_host = getenv('DB_HOST');
    $db_name = getenv('DB_NAME');
    $db_user = getenv('DB_USER');
    $db_pass = getenv('DB_PASSWORD');
    
    // Read the password file path from an environment variable
    $password_file_path = getenv('DB_PASSWORD_FILE_PATH');

    // Read the password from the file
    $root_passwd = trim(file_get_contents($password_file_path));

    //$dbhost = 'mysqlserver.sandbox.net';
    //$dbname='NEETASTUDIO';
    //$dbuser = 'root';
    //$dbpass = 'p@SSW0rd';

    $db_handle = new PDO("mysql:host=$db_host;dbname=$db_name", $db_user, $db_pass);

    $query = "select * from `NEETASTUDIO`.`PARTNER_COLLABORATION`";

    // Retrieve all records from the "messages" table
    $stmt = $db_handle->query($query);

    // Print all records
    while ($row = $stmt->fetch(PDO::FETCH_ASSOC)) {
        echo $row['ID'] . " " . $row['NAME'] . "<br>";
    }

    // Close the database connection
    $db_handle = null;

}catch (PDOException $e) {
    echo "Error : " . $e->getMessage() . "<br/>";
    die();
}



/*
$stmt = $db_handle->prepare($query);
$stmt->execute();
$stmt->bindColumn('emailid', $email);
while ( $row = $stmt->fetch( PDO::FETCH_BOUND ) ){
    echo "$email"."<br>";
}
*/

?>

