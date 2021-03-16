<?php
	// define variables and set to empty values
	$datumErr = $plzErr = $emailErr = $preisErr = "";
	$datum = $plz = $email = $preis = "";

	if ($_SERVER["REQUEST_METHOD"] == "POST") {
		if (empty($_POST["datum"])) {
			$datumErr = "Date is required";
		} else {
			$datum = test_input($_POST["datum"]);
		}

		if (empty($_POST["plz"])) {
			$plzErr = "Postal code is required";
		} else {
			$plz = test_input($_POST["plz"]);
		}

		if (empty($_POST["preis"])) {
			$preisErr = "Price is required";
		} else {
			$preis = test_input($_POST["preis"]);
		}

		if (empty($_POST["email"])) {
			$emailErr = "Email is required";
		} else {
			$email = test_input($_POST["email"]);
		}
	}

	function test_input($data) {
	  $data = trim($data);
	  $data = stripslashes($data);
	  $data = htmlspecialchars($data);
	  return $data;
	}

	echo "<h2>Your Input:</h2>";
	echo $datum;
	echo "<br>";
	echo $plz;
	echo "<br>";
	echo $email;
	echo "<br>";
	echo $preis;
?>