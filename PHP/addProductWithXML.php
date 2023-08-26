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

        // Extract values
        $category = $xmlDoc->documentElement->getAttribute('category');
        $brand = $xmlDoc->getElementsByTagName('brand')[0]->nodeValue;
        $productName = $xmlDoc->getElementsByTagName('name')[0]->nodeValue;
        $description = $xmlDoc->getElementsByTagName('description')[0]->nodeValue;
        $image = $xmlDoc->getElementsByTagName('image')[0]->nodeValue;
        $product = mysqli_query($con, "SELECT product_name FROM `products` WHERE product_name = '$productName'") or die('query failed');

        if(mysqli_num_rows($product) == 0){
            echo "added successfully!!";
            $addProduct = mysqli_query($con, "INSERT INTO `products` (product_id,category, product_name, product_desc, product_brand, product_image) VALUES (6,'$category', '$productName', '$description', '$brand', '$image')") or die('query failed');

            // move_uploaded_file($imageTemp, $imageFolder);  //file is stored in uploadedimages folder.
        }
        else{
            echo '<b style="color: red;">Product already exists</b>';
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
