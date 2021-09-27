<!DOCTYPE html>
<html lang="en">
	<head>
		<meta charset="utf-8"/>
		<title>Wrymwood</title>
		<meta name="author" content="Carter Fowler">
		<meta name="viewport" content="width=device-width, initial-scale=1">
		<link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/4.7.0/css/font-awesome.min.css">
		<link rel="stylesheet" type="text/css" href="Unit2_store.css"/>
		<script src="https://ajax.googleapis.com/ajax/libs/jquery/3.5.1/jquery.min.js"></script>
	</head>

	<body>
		<?php include 'Unit2_header.php';
			include 'Unit2_database.php';
			$conn = getConnection();
			if ($conn->connect_error) {
			    die("Connection failed: " . $conn->connect_error);
			}
			$products = getAllProducts($conn);
		?>
		
			<main>
				<div id="formDiv">
					<form action="Unit2_process_order.php" method="post">
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
								<option hidden disabled selected value> -- select a puzzle -- </option>
								 <?php if ($products): ?>
								  <?php foreach($products as $row): ?>
								   <option        
								    value="<?= $row['Name'] ?>"
								    data-image="<?= $row['Image'] ?>"
								    data-qty="<?= $row['Quantity'] ?>"
								   >
								    <?= $row['Name'] ?> - $<?= $row['Price'] ?>
								   </option>
								  <?php endforeach ?>
								 <?php endif ?>
								
							</select><br>
							<label for="product_quantity">Quantity: <font style="color: red;">*</font></label>
							<input type="number" id="product_quantity" name="product_quantity" min="1" max="100" required>
						</fieldset><br>
						<label>Round up for charity?</label><br>
						<input type="radio" id="yes" name="round_up" value="yes" required>
					  	<label for="yes">Yes</label><br>
					  	<input type="radio" id="no" name="round_up" value="no">
					  	<label for="no">No</label><br>
					  	<input type="hidden" name="timestamp" value="<?php echo time(); ?>">
					  	<input type="submit" name="Purchase" value="Purchase">
					</form>
				</div>
				<div id="imageDiv">
					<p>Select a dice vault to see the image</p>
					<img src="" alt="Dice Vault" id="image" style="display: none;">
					<p id="qtyWarning" style="color: red; font-weight: bold;"></p>
				</div>
			</main>


			<footer>
				<?php include 'Unit2_footer.php';?>
			</footer>

			<script>
				function setImage() {
					var image = document.getElementById("image");
					image.style = "display: block;";
					var qtyText = document.getElementById("qtyWarning");

					var product = document.getElementById("product_type");
					image.src = $("#product_type option:selected").attr('data-image');
					var qty = $("#product_type option:selected").attr('data-qty');
					if (qty == 0) {
						qtyText.innerHTML = "SOLD OUT!";
					} else if (qty <= 5) {
						qtyText.innerHTML = "Only " + qty + " left!";
					}


					// <?php
					// 				if ($products->num_rows > 0) {
					// 				    // output data of each row
					// 				    while($row = $products->fetch_assoc()) {
					// 				        echo "<option value='" . $row["Name"]. "' data-qty='" . $row["Quantity"] . "' data-image='" . $row["Image"] . "'>" . $row["Name"] . " - $" . $row["Price"]. "</option>";
					// 				    }
					// 				}
					// 			?>

					// if (product.value == "cherry") {
					// 	image.src = "images/cherry_dice_vault.jpg";
					// }
					// else if (product.value == "black_walnut") {
					// 	image.src = "images/black_walnut_dice_vault.jpg";
					// }
					// else if (product.value == "paudauk") {
					// 	image.src = "images/paudauk_dice_vault.jpg";
					// }
				}
			</script>
	</body>
</html>