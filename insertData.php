<?php
include 'connect.php';

$count = 0;

function load($params) {
    global $conn, $count;
    
    $command = "CREATE TABLE IF NOT EXISTS book (
            ISBN INT(10) UNSIGNED AUTO_INCREMENT PRIMARY KEY,
            Name VARCHAR(50) NOT NULL,
            Author VARCHAR(40) NOT NULL,
            Price FLOAT(10),
            Quantity INT(10)            
            )";
    //use exec() cause no results returned
    $stmt = $conn->prepare($command);
    $stmt->execute();

    $command = "INSERT INTO book(ISBN,Name,Author,Price,Quantity) "
            . "VALUES(?,?,?,?,?)";
    $stmt = $conn->prepare($command);
    $success = $stmt->execute($params);
    if($success){
        $count++;
    }else{
        echo "failed insert data";
    }
}

$params = Array();
$params[0] = Array(rand(10000, 90000), "Pride and Prejudice", "Jane Austen", 30.4, rand(1, 100));
$params[1] = Array(rand(10000, 90000), "Harry Potter", "J. K. Rowling", 3.65, rand(1, 100));
$params[2] = Array(rand(10000, 90000), "Don Quixote", "Miguel de Cervantes", 3.94, rand(1, 100));
$params[3] = Array(rand(10000, 90000), "A Tale of Two Cities", "Charles Dickens", 9.44, rand(1, 100));
$params[4] = Array(rand(10000, 90000), "The Lord of the Rings", "J.R.R. Tolkien", 7.40, rand(1, 100));
$params[5] = Array(rand(10000, 90000), "The Little Prince", "Antoine de Saint-Exupery", 12.21, rand(1, 100));
$params[6] = Array(rand(10000, 90000), "And Then There Were None", "Agatha Christie", 20.94, rand(1, 100));
$params[7] = Array(rand(10000, 90000), "The Dream of the Red Chamber", "Cao Xueqin", 63.44, rand(1, 100));
$params[8] = Array(rand(10000, 90000), "The Lion, the Witch and the Wardrobe", "C.S. Lewis", 73.94, rand(1, 100));
$params[9] = Array(rand(10000, 90000), "The Da Vinci Code", "Dan Brown", 7.72, rand(1, 100));

foreach ($params as $value) {
    load($value);
}

echo $count . " New records created successfully";
?>


<!DOCTYPE html>
<html>
    <head>
        <meta charset="UTF-8">
        <title>data</title>
    </head>
    <body>

    </body>
</html>