<?php
include 'dbConnect.php';

if(isset($_POST['button'])){

    $productName = $_POST['productName'];
    $brandName = $_POST['brandName'];
    $category = $_POST['category'];
    $description = $_POST['description'];
    

    $image = $_FILES['thumbnail']['name'];  //name of the image 
    $imageTemp = $_FILES['thumbnail']['tmp_name'];  // name of file uploaded on server.
    $imageFolder = 'uploadedimages/'.$image;


    $product = mysqli_query($con, "SELECT product_name FROM `products` WHERE product_name = '$productName'") or die('query failed');

    if(mysqli_num_rows($product) == 0){
        echo "added successfully!!";
        $addProduct = mysqli_query($con, "INSERT INTO `products` (category, product_name, product_desc, product_brand, product_image) VALUES('$category', '$productName', '$description', '$brandName', '$image')") or die('query failed');
        move_uploaded_file($imageTemp, $imageFolder);  //file is stored in uploadedimages folder.
        
       
        
    }
    else{
        echo '<b style="color: red;">Product already exists</b>';
}
}

//Changes to do:

// change length of image column
// auto-increment
// add method, action, enctype attributes in form tag
//accept attribute in thumbnail
//

?>

