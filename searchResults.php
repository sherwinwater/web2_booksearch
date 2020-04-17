<?php
include 'connect.php';
session_start();
// find number of rows of book table
$numOfRows = $numOfRecords = $output = $bookfields = $params = "";
$count = 0;

$command = "SELECT count(*) FROM book";
$stmt = $conn->prepare($command);
$success = $stmt->execute();
if ($success) {
    $rows = $stmt->fetch(PDO::FETCH_NUM);
    if ($rows > 0) {
        $numOfRows = $rows[0];
        $numOfRecords = $numOfRows;
    }
}

if (isset($_POST["bookfields"])) {

    if (isset($_POST["price"]) && isset($_POST["quantity"])) {
        $command = "SELECT * FROM book WHERE Price < ? AND Quantity < ? ORDER BY Price, Quantity";
        $stmt = $conn->prepare($command);
        $params = Array($_POST["price"], $_POST["quantity"]);
        $success = $stmt->execute($params);
    } 
    elseif (isset($_POST["price"])) {
        $command = "SELECT * FROM book WHERE Price < ? ORDER BY Price, Name";
        $stmt = $conn->prepare($command);
        $params = Array($_POST["price"]);
        $success = $stmt->execute($params);
    } 
    elseif (isset($_POST["quantity"]) ) {
        $command = "SELECT * FROM book WHERE Quantity < ? ORDER BY Quantity, Name";
        $stmt = $conn->prepare($command);
        $params = Array($_POST["quantity"]);
        $success = $stmt->execute($params);
    } 
    elseif (in_array("ISBN",$_POST["bookfields"])) {
        $command = "SELECT * FROM book ORDER BY ISBN, Price,Quantity,Name,Author";
        $stmt = $conn->prepare($command);
        $success = $stmt->execute();
    } 
    elseif(in_array("Price",$_POST["bookfields"])){
        $command = "SELECT * FROM book ORDER BY Price, Name";
        $stmt = $conn->prepare($command);
        $success = $stmt->execute();
    } 
    elseif (in_array("Quantity",$_POST["bookfields"])) {
        $command = "SELECT * FROM book ORDER BY Quantity, Name";
        $stmt = $conn->prepare($command);
        $success = $stmt->execute();
    } 
    elseif (in_array("Name",$_POST["bookfields"])) {
        $command = "SELECT * FROM book ORDER BY Name, Author";
        $stmt = $conn->prepare($command);
        $success = $stmt->execute();
    } 
    elseif (in_array("Author",$_POST["bookfields"])) {
        $command = "SELECT * FROM book ORDER BY Author, Name";
        $stmt = $conn->prepare($command);
        $success = $stmt->execute();
    } 
    else{
        $command = "SELECT * FROM book ORDER BY ISBN,Name,Price,Quantity,Author";
        $stmt = $conn->prepare($command);
        $success = $stmt->execute();
    }
    
    $bookfields = $_POST["bookfields"];

} else {
    $command = "SELECT * FROM book ORDER BY ISBN";
    $stmt = $conn->prepare($command);
    $success = $stmt->execute();
    $bookfields = $_SESSION["tableTitle"];

}

$rows = $stmt->fetchAll(PDO::FETCH_ASSOC);

if ($_POST["numOfRecords"] > 0) {
    $numOfRecords = $_POST["numOfRecords"];
}

//$bookfields = $_POST["bookfields"];
$output = "<table><tr>";
$output .= "<th>id</th>";
foreach ($bookfields as $value) {
    $output .= "<th>" . $value . "</th>";
}
$output .= "</tr>";

if ($rows) {
    foreach ($rows as $row) {
        if ($count < $numOfRecords) {
            $output .= "<tr>";
            $output .= "<td>" . ($count + 1) . "</td>";
            foreach ($bookfields as $value) {
                $output .= "<td>" . $row[$value] . "</td>";
            }
            $output .= "</tr>";
        }
        $count++;
    }
    $output .= "</table>";
} else {
    $errMsg = "no results found " . "<br>";
}

?>

<!DOCTYPE html>
<html>
    <head>
        <meta charset="UTF-8">
        <title></title>
        <link rel="stylesheet" type="text/css" href="stylePHP.css">

    </head>
    <body>
        <br>
        <a href="index.php">Go Back</a><br>
<?php
if ($rows) {
    echo '<p>Book search results</p>';
    echo $output;
} else {
    echo $errMsg;
}
?>
    </body>
</html>
