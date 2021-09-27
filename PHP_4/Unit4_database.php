<?php
	function getConnection() {
		$servername = "localhost";
		$username = "carterjfowler";
		$password = "KSGOKQKK";
		$dbname = "f20_carterjfowler";

		// Create connection
		return new mysqli($servername, $username, $password, $dbname);
	}

	function getAllProducts($conn) {
		$sql = "SELECT Id, Name, Price, Quantity, Image, IF(Inactive, 'Yes', '') Inactive FROM products ORDER BY Price";
		return $conn->query($sql);
	}

	function customerInDatabase($conn, $firstName, $lastName) {
		$sql = "SELECT * FROM customers WHERE FirstName = ? AND LastName = ?";
		$stmt = $conn->prepare( $sql );
		$stmt->bind_param( "ss", $firstName, $lastName);
		$stmt->execute();
		$result = $stmt->get_result();
		if ($result->num_rows == 0) {
			$result->close();
			return 0;
		} else {
			$result->close();
			return 1;
		}
	}

	function checkCustFirstName($conn, $firstName) {
		$sql = "SELECT * FROM customers WHERE FirstName LIKE ?";
		$stmt = $conn->prepare( $sql );
		$allFirstNames = $firstName . "%";
		$stmt->bind_param("s", $allFirstNames);
		$stmt->execute();
		return $stmt->get_result();
	}

	function checkCustLastName($conn, $lastName) {
		$sql = "SELECT * FROM customers WHERE LastName LIKE ?";
		$stmt = $conn->prepare( $sql );
		$allLastNames = $lastName . "%";
		$stmt->bind_param("s", $allLastNames);
		$stmt->execute();
		return $stmt->get_result();
	}

	function checkNewFirstName($conn, $firstName) {
		$sql = "SELECT * FROM customers WHERE FirstName LIKE ?";
		$stmt = $conn->prepare( $sql );
		$allFirstNames = $firstName . "%";
		$stmt->bind_param("s", $allFirstNames);
		$stmt->execute();
		$result = $stmt->get_result();
		if ($result->num_rows == 0) {
			$result->close();
			return 1;
		} else {
			$result->close();
			return 0;
		}
	}

	function checkNewLastName($conn, $lastName) {
		$sql = "SELECT * FROM customers WHERE LastName LIKE ?";
		$stmt = $conn->prepare( $sql );
		$allLastNames = $lastName . "%";
		$stmt->bind_param("s", $allLastNames);
		$stmt->execute();
		$result = $stmt->get_result();
		if ($result->num_rows == 0) {
			$result->close();
			return 1;
		} else {
			$result->close();
			return 0;
		}
	}

	function createCustomer($conn, $firstName, $lastName, $email) {
		$sql = "INSERT INTO customers (FirstName, LastName, Email) VALUES (?, ?, ?)";
		$stmt = $conn->prepare( $sql );
		$stmt->bind_param( "sss", $firstName, $lastName, $email);
		$stmt->execute();
	}

	function createOrder($conn, $time, $product, $price, $first_name, $last_name, $quantity, $tax, $donation) {
		$sql = "INSERT INTO orders (OrderTime, Product, Price, CustomerFirstName, CustomerLastName, Quantity, Tax, Donation) VALUES (?, ?, ?, ?, ?, ?, ?, ?)";
		$stmt = $conn->prepare( $sql );
		$stmt->bind_param( "isdssidd", $time, $product, $price, $first_name, $last_name, $quantity, $tax, $donation);
		$stmt->execute();
	}

	function updateProduct($conn, $id, $quantity) {
		$sql = "UPDATE products SET Quantity = ? WHERE Id = ?";
		$stmt = $conn->prepare( $sql );
		$stmt->bind_param( "ii", $quantity, $id);
		$stmt->execute();
	}

	function findProductById($conn, $id) {
		$sql = "SELECT * FROM products WHERE Id = ?";
		$stmt = $conn->prepare( $sql );
		$stmt->bind_param( "i", $id);
		$stmt->execute();
		$result = $stmt->get_result(); // get the mysqli result - same as you
        if ($result->num_rows > 0) { // ensure it got a return
                $row =  $result->fetch_assoc();
				// this turns the result into array
                return $row;
        }
        else {
                return 0;
        }
	}

	function createNewProduct($conn, $name, $price, $quantity, $image, $inactive) {
		$sql = "INSERT INTO products (Name, Price, Quantity, Image, Inactive) VALUES (?, ?, ?, ?, ?)";
		$stmt = $conn->prepare( $sql );
		$stmt->bind_param( "siisi", $name, $price, $quantity, $image, $inactive);
		$stmt->execute();
	}

	function updateFullProduct($conn, $id, $name, $price, $quantity, $image, $inactive) {
		$sql = "UPDATE products SET Name = ?, Price = ?, Quantity = ?, Image = ?, Inactive = ? WHERE Id = ?";
		$stmt = $conn->prepare( $sql );
		$stmt->bind_param( "siisii", $name, $price, $quantity, $image, $inactive, $id);
		$stmt->execute();
	}

	function deleteProductById($conn, $id) {
		$sql = "DELETE FROM products WHERE Id = ?";
		$stmt = $conn->prepare( $sql );
		$stmt->bind_param( "i", $id);
		$stmt->execute();
	}

	function existingOrder($conn, $productId) {
		$sql = "SELECT * FROM orders WHERE Product = ?";
		$stmt = $conn->prepare( $sql );
		$stmt->bind_param( "i", $productId);
		$stmt->execute();
		$result = $stmt->get_result();
		if ($result->num_rows == 0) {
			$result->close();
			return 0;
		} else {
			$result->close();
			return 1;
		}
	}

?>