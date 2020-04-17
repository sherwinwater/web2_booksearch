<?php
include 'connect.php';
session_start();

$tableTitle = Array();

function getTableTitle() {
    global $conn, $tableTitle;

    $stmt = $conn->prepare("DESCRIBE book");
    $success = $stmt->execute();
    if ($success) {

        while ($row = $stmt->fetch()) {
            array_push($tableTitle, $row[0]);
        }
    } else {
        echo "failed";
    }
}

getTableTitle();
$_SESSION["tableTitle"] = $tableTitle;
?>

<!DOCTYPE html>
<html>
    <head>
        <meta charset="UTF-8">
        <title></title>
        <link rel="stylesheet" type="text/css" href="stylePHP.css">

    </head>
    <body>
        <br><br>
        <div id="formdata">
            <form method="POST" action="searchResults.php">
                <p>Search your books</p>

                <?php foreach ($tableTitle as $value) { ?>
                    <input type="checkbox" value=<?= $value ?> name="bookfields[]" id=<?= $value ?> ></option>
                    <label for=<?= $value ?>><?= $value ?></label>
                    <div id=<?= $value . "list" ?>></div>
                <?php } ?>
<!--                    <label id="num">Number of Records</label><br>-->
                    <input type="number" name="numOfRecords" placeholder="number of records" min="1" id="numinput"><br>
                    <input type="submit" value="Search"><br>
            </form>
        </div>

        <script>

            var price = document.getElementById("Price");
            var pricelist = document.getElementById("Pricelist");
            var radioPrice = document.getElementById("radioPrice");
            var quantity = document.getElementById("Quantity");
            var quantitylist = document.getElementById("Quantitylist");
            var radioQuantity = document.getElementById("radioQuantity");

            price.addEventListener('click', function () {
                if (price.checked) {
                    pricelist.innerHTML =
                            `<input type="radio" id="price1" name="price" value="10">
                <label for="price1">< 10</label><br>
                <input type="radio" id="price2" name="price" value="30">
                <label for="price2">< 30</label><br>  
                <input type="radio" id="price3" name="price" value="70">
                <label for="price3">< 70</label><br>
                <input type="radio" id="price4" name="price" value="200">
                <label for="price4">< 200</label><br>`;
                } else {
                    pricelist.innerHTML = "";
                }
            });

            quantity.addEventListener('click', function () {
                if (quantity.checked) {
                    quantitylist.innerHTML =
                            `<input type="radio" id="quantity1" name="quantity" value="30">
                <label for="quantity1">< 30</label><br>
                <input type="radio" id="quantity2" name="quantity" value="50">
                <label for="quantity2">< 50</label><br>  
                <input type="radio" id="quantity3" name="quantity" value="120">
                <label for="quantity3">< 120</label><br>
                <input type="radio" id="quantity4" name="quantity" value="200">
                <label for="quantity4">< 200</label><br>`;
                } else {
                    quantitylist.innerHTML = "";
                }
            });

        </script>
    </body>
</html>
