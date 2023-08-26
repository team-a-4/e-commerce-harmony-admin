<?php

require("dbConnect.php");

// $sql = "SELECT * FROM products where product_id = 3";
$sql = "SELECT * FROM products where product_id = " . $_GET["product_id"];
$result = mysqli_query($con, $sql);

header("Content-type: text/xml");
$xml = '<?xml version="1.0" encoding="UTF-8"?>';
$xml .= '<?xml-stylesheet type="text/xsl" href="product.xsl"?>';

if ($result->num_rows > 0) {
    $row = mysqli_fetch_assoc($result); // Fetch product data

    $xml .= '<product productId="' . $row["product_id"] . '" category="' . $row["category"] . '">' . PHP_EOL;
    $xml .= '    <brand>' . $row["product_brand"] . '</brand>' . PHP_EOL;
    $xml .= '    <name>' . $row["product_name"] . '</name>' . PHP_EOL;
    $xml .= '    <description>' . $row["product_desc"] . '</description>' . PHP_EOL;
    $xml .= '    <image type="local">' . $row["product_image"] . '</image>' . PHP_EOL;
    $xml .= '    <stock>' . PHP_EOL;

    $sql2 = "SELECT * FROM inventories WHERE product_id = " . $row["product_id"];
    $result2 = mysqli_query($con, $sql2);
    if ($result2->num_rows > 0) {
        while ($row2 = $result2 -> fetch_assoc()) {
            $xml .= '        <inventory inventoryId="' . $row2["inventory_id"] . '">' . PHP_EOL;
            $xml .= '            <productBarcode>' . $row2["product_barcode"] . '</productBarcode>' . PHP_EOL;
            if($row2["quantity"])
            {
                $xml .= '            <quantity unit="' . ($row2["quantity"] ? "pcs" : "single") . '">' . $row2["quantity"] . '</quantity>' . PHP_EOL;
            }
            else
            {
                $xml .= '            <weight unit="' . ($row2["weight"] ? "kg" : "single") . '">' . $row2["weight"] . '</weight>' . PHP_EOL;
            }
            $xml .= '            <productionDate>' . $row2["production_date"] . '</productionDate>' . PHP_EOL;
            $xml .= '            <expiryDate>' . $row2["expiry_date"] . '</expiryDate>' . PHP_EOL;
            $xml .= '            <pricing>' . PHP_EOL;
            $xml .= '                <costPrice>' . $row2["cost_price"] . '</costPrice>' . PHP_EOL;
            $xml .= '                <sellingPrice>' . $row2["selling_price"] . '</sellingPrice>' . PHP_EOL;
            $xml .= '            </pricing>' . PHP_EOL;
            $xml .= '        </inventory>' . PHP_EOL;
        }
    }

    $xml .= '    </stock>' . PHP_EOL;
    $xml .= '</product>' . PHP_EOL;
}

echo $xml;

mysqli_close($con);
?>
