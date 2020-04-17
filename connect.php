<?php

$servername = "localhost";
$username = "sam";
$password = "sam";
$dbname ="wanshuwe_book";

try {
    $conn = new PDO("mysql:host=$servername;dbname=$dbname", $username, $password);
    //set PDO error mode
    $conn->setAttribute(PDO::ATTR_ERRMODE, PDO::ERRMODE_EXCEPTION);
//    echo "Connected successfully";
   
} catch (PDOException $e) {
//    echo "Connection failed: " . $e->getMessage();
    die("Connection failed: " . $e->getMessage());
}

//$conn = null;
?>