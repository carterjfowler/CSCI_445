<?php
	include 'Unit4_database.php';
	$conn = getConnection();
	if ($conn->connect_error) {
		die("Connection failed: " . $conn->connect_error);
	}

	//Fetching Values from URL
	if ($_SERVER["REQUEST_METHOD"] == "GET") {
		// collect value of input field
		$productsResult = getAllProducts($conn);

		if ($productsResult->num_rows > 0) {
			echo "<p>Products</p><br>";
			echo "<div class='adminProductsDiv'>";
			echo "<table id='adminProducts'><tr><th>Id</th><th>Name</th><th>Price</th><th>Quantity</th><th>Image</th><th>Inactive</th></tr>";
			// output data of each row
			while($row = $productsResult->fetch_assoc()) {
				echo "<tr><td>" . $row["Id"]. "</td><td>" . $row["Name"]. "</td><td>" . $row["Price"]. "</td><td>" . $row["Quantity"]. "</td><td>" . $row["Image"]. "</td><td>" . $row["Inactive"]. "</td></tr>";
			}
				echo "</table></div><br>";
			}
	}
?>