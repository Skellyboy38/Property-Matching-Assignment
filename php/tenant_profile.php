<?php
	session_start();
	$login = $_SESSION['username'];

	$username = "root";
	$servername = "localhost";
	$dbname = "rental_7195788";
	$has_profile = FALSE;

	$gender = "";
	$age = "";
	$occupation = "";
	$income = "";
	$location = "";
	$price = "";
	$availability = "";

	try {
		$conn = new PDO("mysql:host=$servername;dbname=$dbname", $username, NULL);
		$conn->setAttribute(PDO::ATTR_ERRMODE, PDO::ERRMODE_EXCEPTION);

		if(isset($_POST['gender'])) {
			$remove = "DELETE FROM tenant_profile WHERE user = '$login'";
			$conn->exec($remove);
			//-------------------------------------------
			$username = $_SESSION['username'];
			$genderToSet = $_POST['gender'];
			$ageToSet = $_POST['age'];
			$occupationToSet = $_POST['occupation'];
			$incomeToSet = $_POST['income'];
			$location = $_POST['location'];
			$price = $_POST['price'];
			$availability = $_POST['availability'];

			$sql = "INSERT INTO tenant_profile VALUES(
				'".$username."', '".$genderToSet."', '".$ageToSet."', '".$occupationToSet."', '".$incomeToSet."', '".$location."', '".$price."', '".$availability."')";
			$conn->exec($sql);
			$result = "The profile was successfully updated!";
		}
		$stmt = $conn->prepare('SELECT * FROM tenant_profile');
		$stmt->execute();

		while($row = $stmt->fetch(PDO::FETCH_NUM)) {
			if(strcmp($login, $row[0]) == 0) {
				$gender = $row[1];
				$age = $row[2];
				$occupation = $row[3];
				$income = $row[4];
				$location = $row[5];
				$price = $row[6];
				$availability = $row[7];
				$has_profile = TRUE;
			}
		}
	}
	catch(PDOException $e) {
		echo $e->getMessage();
	}
	
?>
<!DOCTYPE html>
<html>
<head>
	<title>owner</title>
	<link rel="stylesheet" type="text/css" href="../css/style.css">
	<script type="text/javascript" src="../js/script.js"></script>
</head>
<body>
	<div id="header">
		<img src="../images/header.jpg" height="200" width="1250">
	</div>

	<h1 id="log_out"><a href="../html/index.html">Log out</a></h1>
	<h1 id="search_properties"><a href="tenant_properties.php">Search properties</a></h1>
	<h1 id="update_profile"><a href="tenant_profile.php">Update profile</a></h1>
	<h1 id="match"><a href="tenant_match.php">Find match</a></h1>

	<h1 id="copyright">Copyright 2015 &nbsp&copy</h1>
	<p id="website">HousingSoulmate.com</p>
	<p id="page_name">UPDATE PROFILE</p>
	<a id="home" href="tenant.php"><img src="../images/home.jpg" height="100" width="100"></a>

	<form id="tenant_profile">
		<?php 
			if($has_profile) {
				echo "<p><h1>Your current profile</h1></p>
				<p>Gender: " . $gender . "</p>
				<p>Age: " . $age . "</p>
				<p>Occupation: " . $occupation . "</p>
				<p>Income: " . $income . "</p>
				<p>Location: " . $location . "</p>
				<p>Rent price: " . $price . "</p>
				<p>Availability: " . $availability . "</p>";
			}
			else {
				echo "<p>You currently do not have a profile. Create one below.</p>";
			}
		?>
	</form>
	<form id="new_tenant_profile" method="post" action="tenant_profile.php">
		<h1>Update your profile here!</h1><br>
		<table>
			<tr>
				<td>Gender: </td>
				<td>Male <input type="radio" name="gender" value="Male" checked=></td>
				<td>Female <input type="radio" name="gender" value="Female"></td>
			</tr>
			<tr>
				<td>Age:</td>
				<td><input type="text" name="age" value=<?php echo $age ?>></td>
			</tr>
			<tr>
				<td>Occupation:</td>
				<td><input type="text" name="occupation" value=<?php echo $occupation ?>></td>
			</tr>
			<tr>
				<td>Income:</td>
				<td><input type="text" name="income" value=<?php echo $income ?>></td>
			</tr>
			<tr>
				<td>Ideal home location:</td>
				<td><input type="text" name="location" value=<?php echo $location ?>></td>
			</tr>
			<tr>
				<td>Maximum monthly rent:</td>
				<td><input type="text" name="price" value=<?php echo $price ?>></td>
			</tr>
			<tr>
				<td>Renting availability:</td>
				<td><input type="text" name="availability" value=<?php echo $availability ?>></td>
			</tr>
		</table>
		<input type="submit" value="update">&nbsp&nbsp&nbsp<input type="reset" value="reset">
	</form>

	<div id="footer">
		<img src="../images/footer.jpg" height="200" width="1250">
	</div>
</body>
</html>