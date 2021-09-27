<?php
	include 'Unit4_database.php';
	$conn = getConnection();
	if ($conn->connect_error) {
		die("Connection failed: " . $conn->connect_error);
	}

	//Fetching Values from URL
	if ($_SERVER["REQUEST_METHOD"] == "POST") {
		// collect value of input field
		$first_name = $_POST['first_name'];
		$last_name = $_POST['last_name'];
		$email = $_POST['email'];
		$product = $_POST['product_type'];
		$product_quantity = $_POST['product_quantity'];
		$round_up = $_POST['round_up'];
		$time = $_POST['timestamp'];
		$tax = 1.08;


		$databaseProduct = findProductById($conn, $product);
		$product_name = $databaseProduct["Name"] . "(s)";
		$product_cost = $databaseProduct["Price"];
		$remainingQty = $databaseProduct["Quantity"];

		$customerExists = customerInDatabase($conn, $first_name, $last_name);
		if ($customerExists == 0) {
			createCustomer($conn, $first_name, $last_name, $email);
		}

		$subtotal = $product_cost * $product_quantity;
		$total = $subtotal * $tax;
		$donation = $total;
		if ($round_up == "yes") {
			$donation = ceil($total);
		}

		createOrder($conn, $time, $product, $product_cost, $first_name, $last_name, $product_quantity, $total - $subtotal, $donation - $total);

		$newQty = max($remainingQty - $product_quantity, 0);
		updateProduct($conn, $product, $newQty);

		echo "Order submitted for: $first_name $last_name, $product_quantity $product_name";
		echo "<br>";
		echo "Total: $$donation";
	}
?>