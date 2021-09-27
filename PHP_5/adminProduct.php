<!DOCTYPE html>
<html lang="en">
	<head>
		<meta charset="utf-8"/>
		<title>Wrymwood</title>
		<meta name="author" content="Carter Fowler">
		<meta name="viewport" content="width=device-width, initial-scale=1">
		<link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/4.7.0/css/font-awesome.min.css">
		<link rel="stylesheet" type="text/css" href="adminProduct.css"/>
		<script src="https://ajax.googleapis.com/ajax/libs/jquery/3.5.1/jquery.min.js"></script>
	</head>

	<body>
			<?php include 'Unit5_header.php';
				include 'Unit5_database.php';
				$conn = getConnection();
				if ($conn->connect_error) {
					die("Connection failed: " . $conn->connect_error);
				}
			?>
			<div class="grid-container">
				<main class="grid-item">
					<div id="productTable">
						
					</div>
				</main>

				<aside class="grid-item">
					<p id="warning" style="color: red;"></p>
					<div id="formDiv">
						<form id="databaseForm">
							<fieldset id="dice_vault_info">
			    				<legend id="dice_vault_title">Dice Vault Information:</legend>
			    				<label for="id">Id: </label>
			    				<input type="number" id="id" name="id"><br>
			    				<label for="dice_vault_name">Dice Vault Name: <font style="color: red;">*</font></label>
			    				<input type="text" id="dice_vault_name" name="dice_vault_name" required><br>
			    				<label for="dice_vault_image">Dice Vault Image: <font style="color: red;">*</font></label>
			    				<input type="text" id="dice_vault_image" name="dice_vault_image" required><br>
			    				<label for="quantity">Quantity: </label>
			    				<input type="number" id="quantity" name="quantity"><br>
			    				<label for="price">Price: </label>
			    				<input type="number" id="price" name="price"><br>
			    				<label for="inactive">Inactive: </label>
			    				<input type="checkbox" id="inactive" name="inactive" value="inactive">
			    			</fieldset><br>
						  	<input type="submit" id="add" name="add" value="Add" style="margin-left: 10px; margin-right: 30px;">
						  	<input type="submit" id="update" name="update" value="Update" style="margin-right: 30px;">
						  	<input type="submit" id="delete" name="delete" value="Delete" style="background-color: red;">
						</form>
					</div>
					<p id="response"></p>
				</aside>
				</div>

				<footer>
					<?php include 'Unit5_footer.php';?>
				</footer>

			<script src="admin_database_script.js"></script>
			<script src="activeNav.js"></script>
			<script>
				setCurrentPage("productsPage");

				reloadProductTable();
			</script>
	</body>
</html>