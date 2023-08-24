<?php
require("dbConnect.php");

if ($_SERVER["REQUEST_METHOD"] == "POST") {
   
    $barcode = $_POST["barcode"];
    $quantity = $_POST["quantity"];
    $weight = $_POST["weight"];
    $productionDate = $_POST["productionDate"];
    $expiryDate = $_POST["expiryDate"];
    $costPrice = $_POST["costPrice"];
    $sellingPrice = $_POST["sellingPrice"];

   
    $sql = "INSERT INTO inventories (inventory_id,product_id,product_barcode, quantity, weight, production_date, expiry_date, cost_price, selling_price)
            VALUES ('1004','001','$barcode', '$quantity', '$weight', '$productionDate', '$expiryDate', '$costPrice', '$sellingPrice')";

    if (mysqli_query($con, $sql)) {
        echo "Data inserted successfully";
    } else {
        echo "Error: " . mysqli_error($con);
    }
}

mysqli_close($con);
?>
