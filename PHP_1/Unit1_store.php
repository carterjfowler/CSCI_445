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
				<div id="formDiv">
					<form action="Unit1_process_order.php" method="post">
						<fieldset id="personal_info">
		    				<legend id="personal_title">Personal Information:</legend>
		    				<label for="first_name">First Name: <font style="color: red;">*</font></label>
		    				<input type="text" id="first_name" name="first_name" pattern="[A-Za-z' ]+$" required><br>
		    				<label for="last_name">Last Name: <font style="color: red;">*</font></label>
		    				<input type="text" id="last_name" name="last_name" pattern="[A-Za-z' ]+$" required><br>
		    				<label for="email">Email: <font style="color: red;">*</font></label>
		    				<input type="text" type="email" id="email" name="email" required>
		    			</fieldset><br>
						<fieldset id="product_info">
		    				<legend id="product_title">Product Information:</legend>
							<label for="product_type">Choose a dice vault: <font style="color: red;">*</font></label>
							<select id="product_type" name="product_type" onChange="setImage()" required>
								<option value="" disabled selected>--select a dice vault--</option>
							  	<option value="cherry">Cherry Dice Vault - $33.00</option>
							  	<option value="black_walnut">Black Walnut Dice Vault - $40.00</option>
							  	<option value="paudauk">Paudauk Dice Vault - $43.00</option>
							</select><br>
							<label for="product_quantity">Quantity: <font style="color: red;">*</font></label>
							<input type="number" id="product_quantity" name="product_quantity" min="1" max="100" required>
						</fieldset><br>
						<label>Round up for charity?</label><br>
						<input type="radio" id="yes" name="round_up" value="yes" required>
					  	<label for="yes">Yes</label><br>
					  	<input type="radio" id="no" name="round_up" value="no">
					  	<label for="no">No</label><br>
					  	<input type="submit" name="Purchase" value="Purchase">
					</form>
				</div>
				<div id="imageDiv">
					<p>Select a dice vault to see the image</p>
					<img src="images/cherry_dice_vault.jpg" alt="Cherry Dice Vault" id="cherry_image" style="display: none;">
					<img src="images/black_walnut_dice_vault.jpg" alt="Black Walnut Dice Vault" id="black_walnut_image" style="display: none;">
					<img src="images/paudauk_dice_vault.jpg" alt="Paudauk Dice Vault" id="paudauk_image" style="display: none;">
				</div>
			</main>


			<footer>
				<?php include 'Unit1_footer.php';?>
			</footer>

			<script>
				function setImage() {
					var cherry_image = document.getElementById("cherry_image");
					var black_walnut_image = document.getElementById("black_walnut_image");
					var paudauk_image = document.getElementById("paudauk_image");

					var product = document.getElementById("product_type");
					
					if (product.value == "cherry") {
						cherry_image.style = "display: block;";
						black_walnut_image.style = "display: none;";
						paudauk_image.style = "display: none;";
					}
					else if (product.value == "black_walnut") {
						cherry_image.style = "display: none;";
						black_walnut_image.style = "display: block;";
						paudauk_image.style = "display: none;";
					}
					else if (product.value == "paudauk") {
						cherry_image.style = "display: none;";
						black_walnut_image.style = "display: none;";
						paudauk_image.style = "display: block;";
					}
				}
			</script>
	</body>
</html>