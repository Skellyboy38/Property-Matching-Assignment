<?php
	session_start();
	$servername = "localhost";
	$username = "root";
	$dbname = "rental_7195788";
	$ads = array();
	$count = 0;
	$user = $_SESSION['username'];

	try {
		$conn = new PDO("mysql:host=$servername;dbname=$dbname", $username, NULL);
		$conn->setAttribute(PDO::ATTR_ERRMODE, PDO::ERRMODE_EXCEPTION);

		$stmt = $conn->prepare("SELECT * FROM ads WHERE username = '$user'");
		$stmt->execute();

		while($row = $stmt->fetch(PDO::FETCH_NUM)) {
			$ads[$count] = $row[1];
			$ads[$count+1] = $row[2];
			$ads[$count+2] = $row[3];
			$ads[$count+3] = $row[4];
			$ads[$count+4] = $row[5];
			$ads[$count+5] = $row[6];
			$count = $count + 6;
		}
	}
	catch(PDOException $e) {
		echo $e->getMessage();
	}
?>

<!DOCTYPE html>
<html>
<head>
	<title>Ads</title>
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
	<p id="page_name">MANAGE ADS</p>
	<a id="home" href="owner.php"><img src="../images/home.jpg" height="100" width="100"></a>

	<form id="ad" onsubmit="return deleteAd()" method="post" action="ads.php">
		<table>
			<?php 
				$count = 1;
				for($i = 0; $i < count($ads); $i++) {
					echo "<tr><td>Ad #$count:</td></tr>
					<tr><td>Title: $ads[$i]</td></tr>";
					$i++;
					echo "<tr><td>Location: $ads[$i]</td></tr>";
					$i++;
					echo "<tr><td>Price: $ads[$i]</td></tr>";
					$i++;
					echo "<tr><td>Availability: $ads[$i]</td></tr>";
					$i++;
					echo "<td>Message: $ads[$i]</td></tr>";
					$i++;
					echo "<tr><td>Image: <img src='$ads[$i]' alt='image' height='300px' border='1px solid black' width='450px'></td></tr>
					<tr><td><input type='submit' id=$count value='delete ad'></td></tr>
					<tr><td>-----------------</td></tr>";
					$count++;	
				} 
			?>
		</table>
		<input type="button" value="delete all" onclick="deleteAll()">
	</form>

	<div id="footer">
		<img src="../images/footer.jpg" height="200" width="1250">
	</div>
</body>
</html>