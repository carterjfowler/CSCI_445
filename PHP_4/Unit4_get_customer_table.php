<?php
	include 'Unit4_database.php';
	$conn = getConnection();
	if ($conn->connect_error) {
		die("Connection failed: " . $conn->connect_error);
	}

	//Fetching Values from URL
	if ($_SERVER["REQUEST_METHOD"] == "GET") {
		// collect value of input field
		$name = $_REQUEST['name'];
		$type = $_REQUEST['type'];
		$customers = "";
		$new = 0;

		if ($name !== "") {
			if ($type == "first") {
				$customers = checkCustFirstName($conn, $name);
				$new = checkNewFirstName($conn, $name);
			}
			else if ($type == "last") {
				$customers = checkCustLastName($conn, $name);
				$new = checkNewLastName($conn, $name);
			}
		}

		$hintTable = "";

		if ($new == 1)
			echo "No suggestions";
		else if ($customers !== "") {
			echo "<table id='custHint'><tr><th>First Name</th><th>Last Name</th><th>Email</th></tr>";
		
			while($row = $customers->fetch_assoc()) {
				echo "<tr><td>" . $row["FirstName"]. "</td><td>" . $row["LastName"]. "</td><td>" . $row["Email"]. "</td></tr>";
			}
			
			echo "</table><br>";
			$customers->close();
		} else 
			echo "No suggestions";
	}
?>