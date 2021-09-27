<!DOCTYPE html>
<html lang="en">
	<head>
		<meta charset="utf-8"/>
		<title>Wrymwood</title>
		<meta name="author" content="Carter Fowler">
		<meta name="viewport" content="width=device-width, initial-scale=1">
		<link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/4.7.0/css/font-awesome.min.css">
		<link rel="stylesheet" type="text/css" href="admin.css"/>
	</head>

	<body>
		<?php include 'Unit4_header.php';
			include 'Unit4_database.php';
			$conn = getConnection();
			if ($conn->connect_error) {
			    die("Connection failed: " . $conn->connect_error);
			}
		?>
		
			<main>
			<?php
				$customersSQL = "SELECT * FROM customers";
				$ordersSQL = "SELECT * FROM orders";

				$customersResult = $conn->query($customersSQL);
				$productsResult = getAllProducts($conn);
				$ordersResult = $conn->query($ordersSQL);

				if ($customersResult->num_rows > 0) {
					echo "<p>Customers</p><br>";
				    echo "<table id='customers'><tr><th>First Name</th><th>Last Name</th><th>Email</th></tr>";
				    // output data of each row
				    while($row = $customersResult->fetch_assoc()) {
				        echo "<tr><td>" . $row["FirstName"]. "</td><td>" . $row["LastName"]. "</td><td>" . $row["Email"]. "</td></tr>";
				    }
				    echo "</table><br>";
				}

				if ($productsResult->num_rows > 0) {
					echo "<p>Products</p><br>";
				    echo "<table id='adminProducts'><tr><th>Id</th><th>Name</th><th>Price</th><th>Quantity</th><th>Image</th><th>Inactive</th></tr>";
				    // output data of each row
				    while($row = $productsResult->fetch_assoc()) {
				        echo "<tr><td>" . $row["Id"]. "</td><td>" . $row["Name"]. "</td><td>" . $row["Price"]. "</td><td>" . $row["Quantity"]. "</td><td>" . $row["Image"]. "</td><td>" . $row["Inactive"]. "</td></tr>";
				    }
				    echo "</table><br>";
				}

				if ($ordersResult->num_rows > 0) {
					echo "<p>Orders</p><br>";
				    echo "<table id='orders'><tr><th>Customer</th><th>Product</th><th>Date</th><th>Quantity</th><th>Price</th><th>Tax</th><th>Donation</th><th>Total</th></tr>";
				    // output data of each row
				    date_default_timezone_set("America/Denver");
				    while($row = $ordersResult->fetch_assoc()) {
				    	$total = $row["Quantity"] * $row["Price"] + $row["Tax"] + $row["Donation"];
				    	$date = date('m/d/y h:i A', $row["OrderTime"]);
				        echo "<tr><td>" . $row["CustomerFirstName"] . " " . $row["CustomerLastName"] . "</td><td>" . $row["Product"]. "</td><td>" . $date . "</td><td>" . $row["Quantity"] .  "</td><td>" . $row["Price"] . "</td><td>" . round($row["Tax"], 2) . "</td><td>" . round($row["Donation"], 2) . "</td><td>" . $total . "</td></tr>";
				    }
				    echo "</table><br>";
				}

				$conn->close();
			?>
			</main>


			<footer>
				<?php include 'Unit4_footer.php';?>
			</footer>

			<script src="activeNav.js"></script>
			<script>
				setCurrentPage("listsPage");
			</script>
	</body>
</html>