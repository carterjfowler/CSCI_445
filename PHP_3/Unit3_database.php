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
		$sql = "SELECT * FROM products ORDER BY Price";
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

	function updateProduct($conn, $name, $quantity) {
		$sql = "UPDATE products SET Quantity = ? WHERE Name = ?";
		$stmt = $conn->prepare( $sql );
		$stmt->bind_param( "is", $quantity, $name);
		$stmt->execute();
	}

	function findProductById($conn, $name) {
		$sql = "SELECT * FROM products WHERE Name = ?";
		$stmt = $conn->prepare( $sql );
		$stmt->bind_param( "s", $name);
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

?>