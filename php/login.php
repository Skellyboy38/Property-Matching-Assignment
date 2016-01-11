<?php
	session_start();
	$servername = "localhost";
	$username = "root";
	$dbname = "rental_7195788";

	$login = $_POST['username'];
	$password = $_POST['password'];
	$sql = NULL;
	$can_login = FALSE;
	$_SESSION['username'] = $login;

	try {
		$conn = new PDO("mysql:host=$servername;dbname=$dbname", $username, NULL);
		$conn->setAttribute(PDO::ATTR_ERRMODE, PDO::ERRMODE_EXCEPTION);

		$stmt = $conn->prepare('SELECT login, password FROM members');
		$stmt->execute();

		while($row = $stmt->fetch(PDO::FETCH_NUM)) {
			if(strcmp($login, $row[0]) == 0 && strcmp($password, $row[1]) == 0) {
				$can_login = TRUE;
			}
		}
		if($can_login) {
			echo "You logged in!<br>";
			echo "redirecting...";
			$stmt = $conn->prepare("SELECT * FROM members M WHERE M.login = '$login'");
			$stmt->execute();
			$row = $stmt->fetch(PDO::FETCH_NUM);
			$_SESSION['login'] = $row[0];
			$_SESSION['password'] = $row[1];
			$_SESSION['first_name'] = $row[2];
			$_SESSION['last_name'] = $row[3];
			$_SESSION['phone_number'] = $row[4];
			$_SESSION['email'] = $row[5];
			$_SESSION['type'] = $row[6];
			$type = $row[6];

			if(strcmp($type, 'tenant') == 0) {
				header('Location: ' . "tenant.php", true, 303);
   				die();
			}
			else if(strcmp($type, 'owner') == 0){
				header('Location: ' . "owner.php", true, 303);
   				die();
			}
		}	
		else {
			echo "You did not enter the correct information.<br>";
			echo "<a href='../html/login.html'>Go back to login</a>";
		}
	}
	catch(PDOException $e) {
		echo $sql . "<br>" . $e->getMessage();
	}
	$conn = null;

?>