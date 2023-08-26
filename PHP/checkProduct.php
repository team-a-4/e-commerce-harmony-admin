<?php
header("Content-type: text/xml");
$productName = $_GET["productName"];
$brandName = $_GET["brandName"];

require("Helper/dbConnect.php");

$sql = "SELECT * FROM products WHERE product_name = '" . $productName . "' AND product_brand = '" . $brandName . "'";

$result = mysqli_query($con, $sql);

if (mysqli_num_rows($result) > 0) {
    echo '<?xml version="1.0" encoding="UTF-8"?><status exists = "true" />';
} else {
    echo '<?xml version="1.0" encoding="UTF-8"?><status exists = "false" />';
}

mysqli_close($con);
?>