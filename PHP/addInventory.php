<?php
require("Helper/dbConnect.php");

$product_id = $_GET["product_id"];

if (isset($_POST['submit'])) {
    $barcode = $_POST["barcode"];
    $quantity = $_POST["quantity"];
    $weight = $_POST["weight"];
    $productionDate = $_POST["productionDate"];
    $expiryDate = $_POST["expiryDate"];
    $costPrice = $_POST["costPrice"];
    $sellingPrice = $_POST["sellingPrice"];
    
    $sql = "INSERT INTO inventories (product_id, product_barcode, quantity, weight, production_date, expiry_date, cost_price, selling_price)
            VALUES (?, ?, ?, ?, ?, ?, ?, ?)";
    
    $stmt = mysqli_prepare($con, $sql);
    mysqli_stmt_bind_param($stmt, "issdssdd", $product_id, $barcode, $quantity, $weight, $productionDate, $expiryDate, $costPrice, $sellingPrice);

    if (empty($quantity)) {
        $quantity = NULL;
    }
    
    if (empty($weight)) {
        $weight = NULL;
    }
    
    if (mysqli_stmt_execute($stmt)) {
        mysqli_stmt_close($stmt);
        mysqli_close($con);
        header("Location: loadSingleProduct.php?product_id=".$product_id);
        exit();
    } else {
        echo "Error: " . mysqli_error($con);
    }
}

mysqli_close($con);
?>



<!DOCTYPE html>
<html lang="en">
  <head>
    <title>Inventory</title>
    <link
      rel="stylesheet"
      href="https://cdn.jsdelivr.net/npm/@picocss/pico@1/css/pico.min.css"
    />
  </head>
  <body>
    <main class="container">
      <h2>Add Inventory</h2>
      <?php
      echo "<form action='addInventory.php?product_id=" . $product_id."' method='post'>"
      ?>
        <label for="barcode">
          Barcode Product
          <input
            type="text"
            id="barcode"
            name="barcode"
            placeholder="Barcode Product"
            required
            
          />
        </label>
        <div class="grid">
          

          <label for="quantity">
            Quantity
            <input
              type="text"
              id="quantity"
              name="quantity"
              placeholder="Quantity (pcs)"
             
            />
          </label>
          <label for="weight">
            Weight
            <input
              type="text"
              id="weight"
              name="weight"
              placeholder="Weight (g)"
             
            />
          </label>
        </div>

        <div class="grid">
          

          <label for="productionDate">
            Production Date
            <input
              type="date"
              id="productionDate"
              name="productionDate"
              placeholder="Production Date (yyyy-mm-dd)"
              required
             
            />
          </label>

          <label for="productName">
            Expiry Date
            <input
              type="date"
              id="expiryDate"
              name="expiryDate"
              placeholder="Expiry Date (yyyy-mm-dd)"
              required
             
            />
          </label>
        </div>

        <div class="grid">
          

          <label for="costPrice">
            Cost Price
            <input
              type="text"
              id="costPrice"
              name="costPrice"
              placeholder="Cost Price"
              required
              
            />
          </label>

          
          <label for="sellingPrice">
            Selling Price
            <input
              type="text"
              id="sellingPrice"
              name="sellingPrice"
              placeholder="Selling Price"
              required
             
            />
          </label>
        </div>

        <input type="submit" name="submit" value="Add Inventory" id="submitBtn"/>
        
      </form>
    </main>
  </body>
</html>
