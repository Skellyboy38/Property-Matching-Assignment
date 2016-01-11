<?php
	session_start();
	$login = $_SESSION['username'];
	$username = "root";
	$servername = "localhost";
	$dbname = "rental_7195788";

	try {
		$conn = new PDO("mysql:host=$servername;dbname=$dbname", $username, NULL);
		$conn->setAttribute(PDO::ATTR_ERRMODE, PDO::ERRMODE_EXCEPTION);

		$stmt = $conn->prepare("DELETE FROM members WHERE login = '".$login."'");
		$stmt->execute();

		$stmt = $conn->prepare("DELETE FROM tenant_profile WHERE user = '".$login."'");
		$stmt->execute();
	} 
	catch (PDOException $e) {
		echo $e->getMessage();
	}
?>
<!DOCTYPE html>
<html>
<head>
	<title>Delete account</title>
</head>
<body>
	<p>Your account has been deleted.</p>
	<a href="../html/index.html">Return to the home screen</a>
</body>
</html>