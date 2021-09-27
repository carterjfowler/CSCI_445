<!DOCTYPE html>
<html lang="en">
	<head>
		<meta charset="utf-8"/>
		<title>Wrymwood</title>
		<meta name="author" content="Carter Fowler">
		<meta name="viewport" content="width=device-width, initial-scale=1">
		<link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/4.7.0/css/font-awesome.min.css">
		<link rel="stylesheet" type="text/css" href="Unit5_store.css"/>
		<script src="https://ajax.googleapis.com/ajax/libs/jquery/3.5.1/jquery.min.js"></script>
	</head>

	<body>
		<?php
			error_reporting(E_ALL);
			ini_set('display_errors', True);
			include 'Unit5_header.php';
			include 'Unit5_database.php';
			$conn = getConnection();
			if ($conn->connect_error) {
			    die("Connection failed: " . $conn->connect_error);
			}
			$products = getAllProducts($conn);
		?>
		
			<main>
				<div id="formDiv">
					<form id="form">
						<fieldset id="personal_info">
		    				<legend id="personal_title">Personal Information:</legend>
		    				<label for="first_name">First Name: <font style="color: red;">*</font></label>
		    				<input type="text" id="first_name" name="first_name" pattern="[A-Za-z' ]+$" required onkeyup="checkName(this.value, 'first')"><br>
		    				<label for="last_name">Last Name: <font style="color: red;">*</font></label>
		    				<input type="text" id="last_name" name="last_name" pattern="[A-Za-z' ]+$" required onkeyup="checkName(this.value, 'last')"><br>
		    				<label for="email">Email: <font style="color: red;">*</font></label>
		    				<input type="text" type="email" id="email" name="email" required>
		    			</fieldset><br>
						<fieldset id="product_info">
		    				<legend id="product_title">Product Information:</legend>
							<label for="product_type">Choose a dice vault: <font style="color: red;">*</font></label>
							<select id="product_type" name="product_type" onChange="setAvail()" required>
								<option value="" disabled selected>--select a dice vault--</option>
								 <?php if ($products): ?>
								  <?php foreach($products as $row): ?>
								  	<?php if ($row['Inactive'] == ''): ?>
									   <option        
									    value="<?= $row['Id'] ?>"
									    data-image="<?= $row['Image'] ?>"
									    data-qty="<?= $row['Quantity'] ?>"
									   >
									    <?= $row['Name'] ?> - $<?= $row['Price'] ?>
									   </option>
								   <?php endif ?>
								  <?php endforeach ?>
								 <?php endif ?>
								
							</select><br>
							<label for="product_available">Available:</label>
							<input type="number" id="product_available" name="product_available" style="background-color: lightgray;" readonly><br>
							<label for="product_quantity">Quantity: <font style="color: red;">*</font></label>
							<input type="number" id="product_quantity" name="product_quantity" min="1" max="100" required>
						</fieldset><br>
						<label>Round up for charity?</label><br>
						<input type="radio" id="yes" name="round_up" value="yes" required>
					  	<label for="yes">Yes</label><br>
					  	<input type="radio" id="no" name="round_up" value="no">
					  	<label for="no">No</label><br>
					  	<input type="hidden" name="timestamp" value="<?php echo time(); ?>">
					  	<input type="submit" id="purchase" name="Purchase" value="Purchase" style="margin-right: 20px;">
					  	<input type="reset" name="Clear" value="Clear" style="background-color: red;">
					</form>
				</div>
				<div id="infoDiv">
					<p>Choose an existing customer:</p><br>
					<div id="customerTable">
						
					</div><br>
					<p id="orderMessage"></p>
				</div>
			</main>


			<footer>
				<?php include 'Unit5_footer.php';?>
			</footer>

			<script src="Unit5_script.js"></script>
			<script src="activeNav.js"></script>
			<script>
				setCurrentPage("orderProcessingPage");
			</script>
	</body>
</html>