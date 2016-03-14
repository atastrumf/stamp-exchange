<?php

$servername = "localhost";
$username = "user";
$password = "password";

try {
    $conn = new PDO("mysql:host=$servername;dbname=stamp-exchange", $username, $password);
    // set the PDO error mode to exception
    $conn->setAttribute(PDO::ATTR_ERRMODE, PDO::ERRMODE_EXCEPTION);
    echo "Connected successfully";

    $statement = $conn->prepare("SELECT
first_name,
(GLength(
LineStringFromWKB(
  LineString(
    location, 
    GeomFromText('POINT(51.5177 -0.0968)')
  )
 )
))
AS distance
FROM `users`
ORDER BY distance ASC");
$statement->execute();
$statement->debugDumpParams();
//$row = $statement->fetch(); // Use fetchAll() if you want all results, or just iterate over the statement, since it implements Iterator
foreach ($statement->fetch() as $row) {
	echo $row;
}
    }
catch(PDOException $e)
    {
    echo "Connection failed: " . $e->getMessage();
    }

?>