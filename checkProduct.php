<?php
$productName=$_GET["productName"];

require("dbConnect.php");
$sql = "SELECT * FROM Products WHERE ProductName = ''' . $productName . '''";

$result = mysqli_query($con, $sql);

if (mysqli_num_rows($result) > 0) {
    echo "Product already exists";
} else {
    echo "Product does not exist";
}
mysqli_close($con);

?>