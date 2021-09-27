<?php
	include 'Unit5_database.php';
	$conn = getConnection();
	if ($conn->connect_error) {
		die("Connection failed: " . $conn->connect_error);
	}

	//Fetching Values from URL
	if ($_SERVER["REQUEST_METHOD"] == "POST") {
		// collect value of input field
		$sort = $_POST['sort'];
		$totals = $_POST['totals'];
		$product_type = $_POST['product_type'];
		$customer_list = $_POST['customer_list'];
		$ordersResult = getAllOrders($conn);

		
		if ($sort == "customer") {
			if ($totals == "totals") {
				$ordersResult = getOrdersTotals($conn, $sort);
				if ($ordersResult->num_rows > 0) {
					$overallTotal = 0;
					$totalQty = 0;
					echo "<p>Orders</p><br>";
					echo "<table id='orders'><tr><th>Customer</th><th>Quantity</th><th>Total</th></tr>";
					// output data of each row
					date_default_timezone_set("America/Denver");
					while($row = $ordersResult->fetch_assoc()) {
						$total = $row["Quantity"] * $row["Price"] + $row["Tax"] + $row["Donation"];
						$overallTotal += $total;
						$totalQty += $row["Quantity"];
						echo "<tr><td>" . $row["CustomerFirstName"] . " " . $row["CustomerLastName"] . "</td><td>" . $row["Quantity"] .  "</td><td>" . $total . "</td></tr>";
					}
					echo "<tr><td><font style='font-weight: bold;'>Total all orders</font></td><td>" . $totalQty . "</td><td>" . $overallTotal . "</td></tr>";
					echo "</table><br>";
				}
			} else {
				$ordersResult = getOrdersSorted($conn, $sort);
			}
		} else if ($sort == "product") {
			if ($totals == "totals") {
				$ordersResult = getOrdersTotals($conn, $sort);
				if ($ordersResult->num_rows > 0) {
					$overallTotal = 0;
					$totalQty = 0;
					echo "<p>Orders</p><br>";
					echo "<table id='orders'><tr><th>Product</th><th>Quantity</th><th>Total</th></tr>";
					// output data of each row
					date_default_timezone_set("America/Denver");
					while($row = $ordersResult->fetch_assoc()) {
						$total = $row["SUM(orders.Quantity)"] * ( $row["SUM(orders.Price)"] / $row["COUNT(orders.Price)"] ) + $row["SUM(orders.Tax)"] + $row["SUM(orders.Donation)"];
						$overallTotal += $total;
						$totalQty += $row["SUM(orders.Quantity)"];
						echo "<tr><td>" . $row["Vault"] . "</td><td>" . $row["SUM(orders.Quantity)"] .  "</td><td>" . $total . "</td></tr>";
					}
					echo "<tr><td><font style='font-weight: bold;'>Total all orders</font></td><td>" . $totalQty . "</td><td>" . $overallTotal . "</td></tr>";
					echo "</table><br>";
				}
			} else {
				$ordersResult = getOrdersSorted($conn, $sort);
			}
		}else if ($product_type != "") {
			$ordersResult = getAllOrdersFiltered($conn, $product_type, "", "");
		} else if ($customer_list != "") {
			$names = preg_split("/[,]+/", $customer_list);
			$ordersResult = getAllOrdersFiltered($conn, "", $names[0], $names[1]);
		}
		
		if ($ordersResult->num_rows > 0 && $totals != "totals") {
				$overallTotal = 0;
				$totalQty = 0;
				echo "<p>Orders</p><br>";
				echo "<table id='orders'><tr><th>Customer</th><th>Product</th><th>Date</th><th>Quantity</th><th>Price</th><th>Tax</th><th>Donation</th><th>Total</th></tr>";
				// output data of each row
				date_default_timezone_set("America/Denver");
				while($row = $ordersResult->fetch_assoc()) {
					$total = $row["Quantity"] * $row["Price"] + $row["Tax"] + $row["Donation"];
					$overallTotal += $total;
					$totalQty += $row["Quantity"];
					$date = date('m/d/y h:i A', $row["OrderTime"]);
					echo "<tr><td>" . $row["CustomerFirstName"] . " " . $row["CustomerLastName"] . "</td><td>" . $row["Vault"]. "</td><td>" . $date . "</td><td>" . $row["Quantity"] .  "</td><td>" . $row["Price"] . "</td><td>" . round($row["Tax"], 2) . "</td><td>" . round($row["Donation"], 2) . "</td><td>" . $total . "</td></tr>";
				}
				echo "<tr><td><font style='font-weight: bold;'>Total all orders</font></td><td> </td><td> </td><td>" . $totalQty . "</td><td> </td><td> </td><td> </td><td>" . $overallTotal . "</td></tr>";
				echo "</table><br>";
		}

	}
?>