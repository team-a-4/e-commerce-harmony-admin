<?php
require("Helper/dbConnect.php");

$product_id = $_GET["product_id"];

if (isset($_POST['submit'])) {
    $barcode = $_POST["barcode"];
    $quantity = $_POST["quantity"];
    $weight = $_POST["weight"];
    $unit = $_POST["unit"];
    $productionDate = $_POST["productionDate"];
    $expiryDate = $_POST["expiryDate"];
    $costPrice = $_POST["costPrice"];
    $sellingPrice = $_POST["sellingPrice"];
    
    $sql = "INSERT INTO inventories (product_id, product_barcode, quantity, weight, unit, production_date, expiry_date, cost_price, selling_price)
            VALUES (?, ?, ?, ?, ?, ?, ?, ?, ?)";
    
    $stmt = mysqli_prepare($con, $sql);
    mysqli_stmt_bind_param($stmt, "issdssdds", $product_id, $barcode, $quantity, $weight, $unit, $productionDate, $expiryDate, $costPrice, $sellingPrice);

    if (empty($quantity)) {
        $quantity = NULL;
    }
    
    if (empty($weight)) {
        $weight = NULL;
    }
    
    if (mysqli_stmt_execute($stmt)) {
        mysqli_stmt_close($stmt);
        mysqli_close($con);
        echo '<script>alert("Product added successfully");</script>';
        echo '<script>setTimeout(function() { window.location.href = "loadSingleProduct.php?product_id='.$product_id.'"; }, 1000);</script>';
        exit();
    } else {
        echo "Error: " . mysqli_error($con);
        echo '<script>alert("Product added failed");</script>';
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
            minlength="13"
            maxlength="13"
            
          />
        </label>
        <div class="grid">
          
        <label for="quantity">
            Quantity
            <input
              type="number"
              id="quantity"
              name="quantity"
              placeholder="Quantity"
             
            />
          </label>
          <label for="weight">
            Weight
            <input
              type="number"
              id="weight"
              name="weight"
              placeholder="Weight"
             
            />
          </label>
          <label for="unit">
            Unit
            <select id="unit" name="unit">
                <option value="Pcs">Pcs</option>
                <option value="Kg">Kg</option>
                <option value="g">g</option>
            </select>
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
