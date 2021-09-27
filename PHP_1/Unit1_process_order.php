<!DOCTYPE html>
<html lang="en">
	<head>
		<meta charset="utf-8"/>
		<title>Wrymwood</title>
		<meta name="author" content="Carter Fowler">
		<meta name="viewport" content="width=device-width, initial-scale=1">
		<link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/4.7.0/css/font-awesome.min.css">
		<link rel="stylesheet" type="text/css" href="Unit1_store.css"/>
	</head>

	<body>
		<?php include 'Unit1_header.php';?>
		
		<main>
			<?php 
				if ($_SERVER["REQUEST_METHOD"] == "POST") {
					// collect value of input field
					$first_name = $_POST['first_name'];
					$last_name = $_POST['last_name'];
					$email = $_POST['email'];
					$product = $_POST['product_type'];
					$product_quantity = $_POST['product_quantity'];
					$round_up = $_POST['round_up'];
					$product_cost = 0.0;
					$tax = 1.08;
					$product_name = "";

					if ($product == "cherry") {
						$product_cost = 33.0;
						$product_name = "Cherry Dice Vault(s)";
					} else if ($product == "black_walnut") {
						$product_cost = 40.0;
						$product_name = "Black Walnut Dice Vault(s)";
					} else if ($product == "paudauk") {
						$product_cost = 43.0;
						$product_name = "Paudauk Dice Vault(s)";
					}

					$subtotal = $product_cost * $product_quantity;
					$total = $subtotal * $tax;
					$donation = $total;
					if ($round_up == "yes") {
						$donation = ceil($total);
					}
					
					echo "Thank you for your order, $first_name $last_name ($email).";
					echo "<br>";
					echo "You have selected $product_quantity $product_name";
					echo "<br>";
					echo "Subtotal: $$subtotal";
					echo "<br>";
					echo "Total including tax: $$total";
					echo "<br>";
					echo "Total with donation: $$donation \n";
				}
			?>
		</main>


		<footer>
			<?php include 'Unit1_footer.php';?>
		</footer>
	</body>
</html>