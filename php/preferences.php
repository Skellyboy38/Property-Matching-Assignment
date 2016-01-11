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
	$result = "";

	try {
		$conn = new PDO("mysql:host=$servername;dbname=$dbname", $username, NULL);
		$conn->setAttribute(PDO::ATTR_ERRMODE, PDO::ERRMODE_EXCEPTION);

		if(isset($_POST['gender'])) {
			$remove = "DELETE FROM owner_preferences WHERE login = '$login'";
			$conn->exec($remove);
			//-------------------------------------------
			$username = $_SESSION['username'];
			$genderToSet = $_POST['gender'];
			$ageToSet = $_POST['age'];
			$occupationToSet = $_POST['occupation'];
			$incomeToSet = $_POST['income'];

			$sql = "INSERT INTO owner_preferences VALUES(
				'".$username."', '".$genderToSet."', '".$ageToSet."', '".$occupationToSet."', '".$incomeToSet."')";
			$conn->exec($sql);
			$result = "The profile was successfully updated!";
		}
		$stmt = $conn->prepare('SELECT * FROM owner_preferences');
		$stmt->execute();

		while($row = $stmt->fetch(PDO::FETCH_NUM)) {
			if(strcmp($login, $row[0]) == 0) {
				$gender = $row[1];
				$age = $row[2];
				$occupation = $row[3];
				$income = $row[4];
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
	<title>owner preferences</title>
	<link rel="stylesheet" type="text/css" href="../css/style.css">
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

	<form id="tenant_profile" method="post" action="preferences.php">
		<h1>Update your tenant preferences here!</h1>
		<h3>(This will help us pair you with your ideal tenant)</h3>
		<table>
			<tr>
				<td>Gender: </td>
				<td>Male <input type="radio" name="gender" value="Male" checked=></td>
				<td>Female <input type="radio" name="gender" value="Female"></td>
			</tr>
			<tr>
				<td>Age:</td>
				<td><input type="text" name="age" value=<?php echo $age?>></td>
			</tr>
			<tr>
				<td>Occupation:</td>
				<td><input type="text" name="occupation" value=<?php echo $occupation?>></td>
			</tr>
			<tr>
				<td>Income:</td>
				<td><input type="text" name="income" value=<?php echo $income?>></td>
			</tr>
			<tr>
				<td><?php echo $result ?></td>
			</tr>
		</table>
		<input type="submit" value="update">&nbsp&nbsp&nbsp<input type="reset" value="reset">
	</form>


	<h1 id="copyright">Copyright 2015 &nbsp&copy</h1>
	<p id="website">HousingSoulmate.com</p>
	<p id="page_name">PREFERENCES</p>
	<a id="home" href="owner.php"><img src="../images/home.jpg" height="100" width="100"></a>


	<div id="footer">
		<img src="../images/footer.jpg" height="200" width="1250">
	</div>
</body>
</html>