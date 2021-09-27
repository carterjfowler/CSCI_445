<?php
	include 'Unit5_database.php';
	$conn = getConnection();
	if ($conn->connect_error) {
		die("Connection failed: " . $conn->connect_error);
	}

	//Fetching Values from URL
	if ($_SERVER["REQUEST_METHOD"] == "GET") {
		// collect value of input field
		$name = $_REQUEST['name'];

		$databaseProduct = findProductById($conn, $name);
		
		$remainingQty = $databaseProduct["Quantity"];

		echo "$remainingQty";
	}
?>