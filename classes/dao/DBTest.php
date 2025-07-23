<?php

try {

    $dbhost = 'mysqlserver.sandbox.net';

    $dbname='NEETASTUDIO';

    $dbuser = 'root';

    $dbpass = 'p@SSW0rd';

    $conn = new PDO("mysql:host=$dbhost;dbname=$dbname", $dbuser, $dbpass);

}catch (PDOException $e) {
    echo "Error : " . $e->getMessage() . "<br/>";
    die();
}

$query = "select * from `NEETASTUDIO`.`PARTNER_COLLABORATION`";

$stmt = $conn->prepare($query);

$stmt->execute();

$stmt->bindColumn('emailid', $email);

while ( $row = $stmt->fetch( PDO::FETCH_BOUND ) )

{

echo "$email"."<br>";

}

?>

