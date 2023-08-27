<?php
require("Helper/dbConnect.php");
if ($_SERVER["REQUEST_METHOD"] == "POST") {
    if ($_FILES["file"]["error"] === UPLOAD_ERR_OK) {
        $xmlDoc = new DOMDocument();
        $xmlDoc->load($_FILES["file"]["tmp_name"]);

        $xsdDoc = new DOMDocument();
        $xsdDoc->load('./../XSD/product.xsd');

        if ($xmlDoc->schemaValidate($xsdDoc->documentURI)) {
            echo "XML is valid.";
            $xmlDoc = new DOMDocument();
            $xmlDoc->load($_FILES["file"]["tmp_name"]); // Load the XML file

            // Extract values for product details from xml file
            $category = $xmlDoc->documentElement->getAttribute('category');
            $brand = $xmlDoc->getElementsByTagName('brand')[0]->nodeValue;
            $productName = $xmlDoc->getElementsByTagName('name')[0]->nodeValue;
            $description = $xmlDoc->getElementsByTagName('description')[0]->nodeValue;
            $image = $xmlDoc->getElementsByTagName('image')[0]->nodeValue;
            $product = mysqli_query($con, "SELECT product_name FROM `products` WHERE product_name = '$productName' AND product_brand = '$brand'");

            if(mysqli_num_rows($product) == 0){
                $addProduct = mysqli_query($con, "INSERT INTO `products` (category, product_name, product_desc, product_brand, product_image) VALUES ('$category', '$productName', '$description', '$brand', '$image')") or die('query failed');
            }
            else{
                echo '<b style="color: red;">Product already exists</b>';
            }

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

            header("Location: /e-commerce-harmony-admin/PHP/loadProducts.php");
            exit();
                
        } else {
            echo "XML is not valid against the XSD.";
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
    <title>Add Product with XML</title>
</head>
<body>
<main class="container">
    <h2>Add Product with XML</h2>
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

            <input type="submit" value="Add Product with XML" name="button" id="submitBtn" />
        </div>
    </form>
</main>
</body>
</html>
