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
				$products = getAllProducts($conn);
				$customers = getAllCustomers($conn);
			?>
			<div class="grid-container">
				<main class="grid-item">
					<div id="ordersTable">
						
					</div>
				</main>

				<aside class="grid-item">
					<div id="formDiv">
						<form id="adminOrdersForm">
							<fieldset id="table_sort">
			    				<legend id="table_sort_title">Table Sorting Options:</legend>
			    				<label for="sort" style="font-weight: bold;">Sort by:</label><br>
			    				<input type="radio" id="customer" name="sort" value="customer" onChange="clearFilters()">
							  	<label for="customer">Customer</label><br>
							  	<input type="radio" id="product" name="sort" value="product" onChange="clearFilters()">
							  	<label for="product">Product</label><br>
							  	<label style="font-weight: bold;">Display option:</label><br>
			    				<input type="checkbox" id="totals" name="totals" value="totals" onChange="clearFilters()">
			    				<label for="totals">Just show Totals</label>
			    				<br><br>
			    				<label style="font-weight: bold;">OR Filter by either:</label><br>
			    				<select id="product_type" name="product_type" onChange="clearAllButProduct()">
									<option value="default" disabled selected>--select a dice vault--</option>
									 <?php if ($products): ?>
									  <?php foreach($products as $row): ?>
										<option        
										  value="<?= $row['Id'] ?>"
										  data-image="<?= $row['Image'] ?>"
										  data-qty="<?= $row['Quantity'] ?>"
										>
											<?= $row['Name'] ?> - $<?= $row['Price'] ?>
										</option>
									   
									  <?php endforeach ?>
									 <?php endif ?>
								
								</select><br>
								<label>OR</label><br>
								<select id="customer_list" name="customer_list" onChange="clearAllButCustomer()">
									<option value="default" disabled selected>--select a customer--</option>
									 <?php if ($customers): ?>
									  <?php foreach($customers as $row): ?>
										<option value="<?= $row['FirstName']?>,<?= $row['LastName'] ?>" >
											<?= $row['FirstName'] ?> <?= $row['LastName'] ?>
										</option>
									   
									  <?php endforeach ?>
									 <?php endif ?>
									
								</select><br><br>
								<input type="submit" id="run" name="run" value="Run" style="margin-right: 20px;">
								<input type="reset" name="Clear" value="Clear" style="background-color: red;">
			    			</fieldset>
						</form>
					</div>
				</aside>
				</div>

				<footer>
					<?php include 'Unit5_footer.php';?>
				</footer>

			<script src="admin_orders_script.js"></script>
			<script src="activeNav.js"></script>
			<script>
				setCurrentPage("ordersPage");
			</script>
	</body>
</html>