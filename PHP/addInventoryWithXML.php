<?php
require("Helper/dbConnect.php");
if ($_SERVER["REQUEST_METHOD"] == "POST") {
    if ($_FILES["file"]["error"] === UPLOAD_ERR_OK) {
        $xmlDoc = new DOMDocument();
        $xmlDoc->load($_FILES["file"]["tmp_name"]);

        $xsdDoc = new DOMDocument();
        $xsdDoc->load('./../XSD/product.xsd');

        if ($xmlDoc->schemaValidate($xsdDoc->documentURI)) {
            $xmlDoc = new DOMDocument();
            $xmlDoc->load($_FILES["file"]["tmp_name"]); // Load the XML file

            // Get product id
            $query = "SELECT product_id FROM `products` WHERE product_name = '$productName' AND product_brand = '$brand'";
            $result = mysqli_query($con, $query);
            $row = mysqli_fetch_assoc($result);
            $id = $row['product_id'];

            // Extract values for inventories from xml file
            $inventories = $xmlDoc->getElementsByTagName('inventory');

            foreach ($inventories as $inventory) {
                $barcode = $inventory->getElementsByTagName('productBarcode')[0]->nodeValue;
                $productionDate = $inventory->getElementsByTagName('productionDate')[0]->nodeValue;
                $expiryDate = $inventory->getElementsByTagName('expiryDate')[0]->nodeValue;
                $costPrice = $inventory->getElementsByTagName('costPrice')[0]->nodeValue;
                $sellingPrice = $inventory->getElementsByTagName('sellingPrice')[0]->nodeValue;

                // Check if 'quantity' or 'weight' exists and extract accordingly
                $quantityNode = $inventory->getElementsByTagName('quantity')->item(0);
                $weightNode = $inventory->getElementsByTagName('weight')->item(0);

                if ($quantityNode !== null) {
                    $quantityValue = $quantityNode->nodeValue;
                    $quantityUnit = $quantityNode->getAttribute('unit');
                    
                } elseif ($weightNode !== null) {
                    $weightValue = $weightNode->nodeValue;
                    $weightUnit = $weightNode->getAttribute('unit');

                }

                if (isset($quantityValue)) {
                    $insertInventoryQuery = "INSERT INTO `inventories` (product_id, product_barcode, quantity, unit, production_date, expiry_date, cost_price, selling_price) 
                                            VALUES ('$id', '$barcode', '$quantityValue', '$quantityUnit', '$productionDate', '$expiryDate', '$costPrice', '$sellingPrice')";

                } elseif (isset($weightValue)) {
                    $insertInventoryQuery = "INSERT INTO `inventories` (product_id, product_barcode, weight, unit, production_date, expiry_date, cost_price, selling_price) 
                                            VALUES ('$id', '$barcode', '$weightValue', '$weightUnit', '$productionDate', '$expiryDate', '$costPrice', '$sellingPrice')";
                }

                mysqli_query($con, $insertInventoryQuery);
            }
            echo '<script>alert("Inventory added successfully");</script>';
            echo '<script>setTimeout(function() { window.location.href = "loadSingleProduct.php?product_id='.$product_id.'"; }, 1000);</script>';
            exit();
                
        } else {
            echo '<script>alert("XML is not valid against the XSD");</script>';
        }

    } else {
        echo "Error uploading file.";
    }
}
?>

<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8" />
    <link
            rel="stylesheet"
            href="https://cdn.jsdelivr.net/npm/@picocss/pico@1/css/pico.min.css"
    />
    <title>Add Inventory with XML</title>
</head>
<body>
<main class="container">
    <h2>Add Inventory with XML</h2>
    <form method="POST" enctype="multipart/form-data">
        <div class="grid">

            <label for="file">
                Attachment
                <input
                        type="file"
                        id="file"
                        name="file"
                        placeholder="file"
                        accept="application/xml, text/xml"
                        required
                />
            </label>

            <br />

            <input type="submit" value="Add Inventory with XML" name="button" id="submitBtn" />
        </div>
    </form>
</main>
</body>
</html>
