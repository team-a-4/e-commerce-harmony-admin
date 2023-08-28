<?php
require("Helper/dbConnect.php");

if(isset($_POST['button'])){
    $productName = $_POST['productName'];
    $brandName = $_POST['brandName'];
    $category = $_POST['category'];
    $description = $_POST['description'];
    
    $image = $_FILES['thumbnail']['name'];
    $product = mysqli_query($con, "SELECT product_name FROM `products` WHERE product_name = '$productName' AND product_brand = '$brandName'");

    if(mysqli_num_rows($product) == 0){
        $addProduct = mysqli_query($con, "INSERT INTO `products` (category, product_name, product_desc, product_brand, product_image) VALUES('$category', '$productName', '$description', '$brandName', '$image')") or die('query failed');
        echo '<script>alert("Product added successfully");</script>';
        echo '<script>window.location.href = "./addProduct.html";</script>';
    }
    else{
        echo '<script>alert("Product already exists");</script>';
        echo '<script>window.location.href = "../addProduct.html";</script>';
    }
}
?>

