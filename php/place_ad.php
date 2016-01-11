<?php
	session_start();
	$result = "";
	$imageURL = "";
	$user = $_SESSION['username'];
	$servername = "localhost";
	$username = "root";
	$dbname = "rental_7195788";
	if(isset($_POST['imageURL'])) {
		$imageURL = $_POST['imageURL'];
	}

	if(isset($_POST['title'])) {
		$title = $_POST['title'];
		$location = $_POST['location'];
		$price = $_POST['price'];
		$availability = $_POST['availability'];
		$message = $_POST['message'];

		try {
			$conn = new PDO("mysql:host=$servername;dbname=$dbname", $username, NULL);
			$conn->setAttribute(PDO::ATTR_ERRMODE, PDO::ERRMODE_EXCEPTION);

			$stmt = $conn->prepare('SELECT login, password FROM members');
			$stmt->execute();

			$sql = "INSERT INTO ads VALUES('".$user."','".$title."', '".$location."', '".$price."', '".$availability."', '".$message."', '".$imageURL."')";
			$conn->exec($sql);
			$result = "The ad was placed successfully";
		}
		catch(PDOException $e) {
			echo $e->getMessage();
		}
	}
?>
<!DOCTYPE html>
<html>
<head>
	<title>place_ad</title>
	<link rel="stylesheet" type="text/css" href="../css/style.css">
	<script type="text/javascript" src="../js/script.js"></script>
</head>
<body>
	<div id="header">
		<img src="../images/header.jpg" height="200" width="1250">
	</div>

	<h1 id="log_out"><a href="../html/index.html">Log out</a></h1>
	<h1 id="owner_profile"><a href="owner_profile.php">Search tenants</a></h1>
	<h1 id="place_ad"><a href="place_ad.php">Place ad</a></h1>
	<h1 id="ads"><a href="ads.php">View ads</a></h1>
	<h1 id="preferences"><a href="preferences.php">Preferences</a></h1>
	<h1 id="owner_match"><a href="owner_match.php">Match</a></h1>

	<h1 id="copyright">Copyright 2015 &nbsp&copy</h1>
	<p id="website">HousingSoulmate.com</p>
	<p id="page_name">PLACE AD</p>
	<a id="home" href="owner.php"><img src="../images/home.jpg" height="100" width="100"></a>

	<div id="footer">
		<img src="../images/footer.jpg" height="200" width="1250">
	</div>

	<form id="ad" onsubmit="return validateAd()" method="post" action="place_ad.php">
		<table>
			<tr id="box_header">
				<td>Place your own personalized ad now!</td>
			</tr>
			<tr>
				<td>--------------</td>
			</tr>
			<tr>
				<td>Title:</td>
				<td><input type="text" name="title" length="50"></td>
			</tr>
			<tr>
				<td>Location of property:</td>
				<td><input type="text" name="location" length="50"></td>
			</tr>
			<tr>
				<td>Price:</td>
				<td>$<input type="text" name="price"></td>
				<td>(Numbers only, or else it will be set to $0)</td>
			</tr>
			<tr>
				<td>Availability:</td>
				<td><input type="text" name="availability"></td>
			</tr>
			<tr>
				<td>Enter a personal message:</td>
				<td><textarea rows="4" cols="30" name="message">Enter your message here</textarea></td>
			</tr>
			<tr>
				<td>Image URL (optional):</td>
				<td><input type="text" name="imageURL"></td>
			</tr>
		</table>
		<input type="submit" value="Submit">&nbsp;&nbsp;<input type="reset" value="Reset">
		<span><?php echo $result ?></span>
	</form>
</body>
</html>
