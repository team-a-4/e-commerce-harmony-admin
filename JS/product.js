function loadProduct(productID) {
  window.location.href = "../PHP/loadSingleProduct.php?product_id=" + productID;
}

function loadInventory(productID) {
  window.location.href = "../PHP/addInventory.php?product_id=" + productID;
}

function inventoryXMLSelection(productID) {
  window.location.href = "../PHP/addInventoryWithXML.php?product_id=" + productID;
}
