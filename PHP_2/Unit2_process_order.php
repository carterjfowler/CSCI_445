<!DOCTYPE html>
<html lang="en">
	<head>
		<meta charset="utf-8"/>
		<title>Wrymwood</title>
		<meta name="author" content="Carter Fowler">
		<meta name="viewport" content="width=device-width, initial-scale=1">
		<link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/4.7.0/css/font-awesome.min.css">
		<link rel="stylesheet" type="text/css" href="Unit2_store.css"/>
	</head>

	<body>
		<?php include 'Unit2_header.php';
			include 'Unit2_database.php';
			$conn = getConnection();
			if ($conn->connect_error) {
			    die("Connection failed: " . $conn->connect_error);
			}
		?>
		
		<main>
			<div id="receipt">
			<?php 
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
					$product_name = $product . "(s)";


					$databaseProduct = findProductById($conn, $product);
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
					
					if ($customerExists == 1)
						echo "Thank you for your order, $first_name $last_name - Welcome back!";
					else
						echo "Thank you for your order, $first_name $last_name.";
					echo "<br>";
					echo "You have selected $product_quantity $product_name";
					echo "<br>";
					echo "Subtotal: $$subtotal";
					echo "<br>";
					echo "Total including tax: $$total";
					echo "<br>";
					echo "Total with donation: $$donation";
					echo "<br>";
					echo "We'll send special offers to $email";
				}
			?>
			</div>
		</main>


		<footer>
			<?php include 'Unit2_footer.php';?>
		</footer>
	</body>
</html>