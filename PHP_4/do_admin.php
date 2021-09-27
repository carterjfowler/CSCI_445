<?php
	include 'Unit4_database.php';
	$conn = getConnection();
	if ($conn->connect_error) {
		die("Connection failed: " . $conn->connect_error);
	}

	//Fetching Values from URL
	if ($_SERVER["REQUEST_METHOD"] == "POST") {
		// collect value of input field
		$id = $_POST['id'];
		$name = $_POST['dice_vault_name'];
		$image = $_POST['dice_vault_image'];
		$quantity = $_POST['quantity'];
		$price = $_POST['price'];
		$inactive = $_POST['inactive'];
		$type = $_POST['type'];
		$inactiveValue = true;
		if ($inactive == "") {
			$inactiveValue = false;
		}
		$newPrice = (double)$price;


		if ($type == "add") {
			if (!findProductById($conn, $id)) {
				createNewProduct($conn, $name, $price, $quantity, $image, $inactiveValue);
				echo "Add completed";
			} else
				echo "Product already exists, could not add";
		} else if ($type == "update") {
			if (findProductById($conn, $id)) {
				updateFullProduct($conn, $id, $name, $price, $quantity, $image, $inactiveValue);
				echo "Update completed";
			} else
				echo "Product does not exist";
		} else if ($type == "delete") {
			if (findProductById($conn, $id)) {
				if (!existingOrder($conn, $id)) {
					deleteProductById($conn, $id);
					echo "Product deleted";
				} else
					$conn->error;
			} else
				echo "Product does not exist";
		}
	}
?>