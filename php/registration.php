<?php
	$servername = "localhost";
	$username = "root";
	$dbname = "rental_7195788";
	$can_register = TRUE;
	//$password = NULL;

	$type = $_POST['type'];
	$login = $_POST['login'];
	$password = $_POST['password'];
	$first_name = $_POST['first_name'];
	$last_name = $_POST['last_name'];
	$email = $_POST['email'];
	$phone_number = $_POST['phone_number'];
	$sql = NULL;
	try {
		$conn = new PDO("mysql:host=$servername;dbname=$dbname", $username, NULL);
		$conn->setAttribute(PDO::ATTR_ERRMODE, PDO::ERRMODE_EXCEPTION);

		$stmt = $conn->prepare('SELECT login FROM members');
		$stmt->execute();

		while($row = $stmt->fetch(PDO::FETCH_NUM)) {
			if(strcmp($login, $row[0]) == 0) {
				$can_register = FALSE;
			}
		}
		if($can_register) {
			$sql = "INSERT INTO members (login, password, first_name, last_name, phone_number, email, type)
			VALUES('".$login."', '".$password."', '".$first_name."', '".$last_name."', '".$phone_number."', '".$email."','".$type."')";
			$conn->exec($sql);
			echo "New record created successfully";
			echo "<br>Please go back and log in.<br>";
			echo "<a href='../html/login.html'>Log in now</a>";
		}	
		else {
			echo "The username ".$login." already exists. Go back and input a new one.<br>";
			echo "<a href='../html/registration.html'>Go back to registration</a>";
		}
	}
	catch(PDOException $e) {
		echo $sql . "<br>" . $e->getMessage();
	}
	$conn = null;
?>