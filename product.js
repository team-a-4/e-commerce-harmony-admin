function loadProduct(productID) {
	window.location.href = "./product.php?product_id=" + productID;
}

function loadInventory(productID) {
	window.location.href = "./addInventory.php?product_id=" + productID;
}

