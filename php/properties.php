<?php
	session_start();
	$trim_title = trim($_POST['keywords']);
	$trim_location = trim($_POST['location']);
	$title_keywords = preg_split("/[\s]+/", $trim_title);
	$location_keywords = preg_split("/[\s]+/", $trim_location);
	$maximum_price = $_POST['price'];
	$ads = array();
	$owners = array();
	$count = 0;
	$foundAd = FALSE;

	$servername = "localhost";
	$username = "root";
	$dbname = "rental_7195788";

	try {
		$conn = new PDO("mysql:host=$servername;dbname=$dbname", $username, NULL);
		$conn->setAttribute(PDO::ATTR_ERRMODE, PDO::ERRMODE_EXCEPTION);

		$stmt = $conn->prepare('SELECT * FROM ads');
		$stmt->execute();

		while($row = $stmt->fetch(PDO::FETCH_NUM)) {
			$foundAd = FALSE;
			if($trim_title == TRUE) {
			for($i = 0; $i < count($title_keywords); $i++) {
				if(stripos($row[1], $title_keywords[$i]) !== FALSE && !$foundAd) {
					$stmt2 = $conn->prepare("SELECT * FROM members O WHERE O.login = '$row[0]'");
					$stmt2->execute();
					$row2 = $stmt2->fetch(PDO::FETCH_NUM);
					$ads[$count] = $row[1]; 		$owners[$count] = "owner:";
					$ads[$count+1] = $row[2];		$owners[$count+1] = $row2[0];
					$ads[$count+2] = $row[3];		$owners[$count+2] = $row2[2];
					$ads[$count+3] = $row[4];		$owners[$count+3] = $row2[3];
					$ads[$count+4] = $row[5];		$owners[$count+4] = $row2[4];
					$ads[$count+5] = $row[6];		$owners[$count+5] = $row2[5];
					$count = $count+6;
					$foundAd = TRUE;
				}
				else if(stripos($row[5], $title_keywords[$i]) !== FALSE && !$foundAd) {
					$stmt2 = $conn->prepare("SELECT * FROM members O WHERE O.login = '$row[0]'");
					$stmt2->execute();
					$row2 = $stmt2->fetch(PDO::FETCH_NUM);
					$ads[$count] = $row[1]; 		$owners[$count] = "owner:";
					$ads[$count+1] = $row[2];		$owners[$count+1] = $row2[0];
					$ads[$count+2] = $row[3];		$owners[$count+2] = $row2[2];
					$ads[$count+3] = $row[4];		$owners[$count+3] = $row2[3];
					$ads[$count+4] = $row[5];		$owners[$count+4] = $row2[4];
					$ads[$count+5] = $row[6];		$owners[$count+5] = $row2[5];
					$count = $count+6;
					$foundAd = TRUE;
				}
			}
			}
			if($trim_location == TRUE) {
			for($i = 0; $i < count($location_keywords); $i++) {
				if(stripos($row[2], $location_keywords[$i]) !== FALSE && !$foundAd) {
					$stmt2 = $conn->prepare("SELECT * FROM members O WHERE O.login = '$row[0]'");
					$stmt2->execute();
					$row2 = $stmt2->fetch(PDO::FETCH_NUM);
					$ads[$count] = $row[1]; 		$owners[$count] = "owner:";
					$ads[$count+1] = $row[2];		$owners[$count+1] = $row2[0];
					$ads[$count+2] = $row[3];		$owners[$count+2] = $row2[2];
					$ads[$count+3] = $row[4];		$owners[$count+3] = $row2[3];
					$ads[$count+4] = $row[5];		$owners[$count+4] = $row2[4];
					$ads[$count+5] = $row[6];		$owners[$count+5] = $row2[5];
					$count = $count+6;
					$foundAd = TRUE;
				}
				else if(stripos($row[5], $location_keywords[$i]) > 0 && !$foundAd) {
					$stmt2 = $conn->prepare("SELECT * FROM members O WHERE O.login = '$row[0]'");
					$stmt2->execute();
					$row2 = $stmt2->fetch(PDO::FETCH_NUM);
					$ads[$count] = $row[1]; 		$owners[$count] = "owner:";
					$ads[$count+1] = $row[2];		$owners[$count+1] = $row2[0];
					$ads[$count+2] = $row[3];		$owners[$count+2] = $row2[2];
					$ads[$count+3] = $row[4];		$owners[$count+3] = $row2[3];
					$ads[$count+4] = $row[5];		$owners[$count+4] = $row2[4];
					$ads[$count+5] = $row[6];		$owners[$count+5] = $row2[5];
					$count = $count+6;
					$foundAd = TRUE;
				}
			}
			}
			if($maximum_price >= 0 && $maximum_price >= $row[3] && !$foundAd) {
				$stmt2 = $conn->prepare("SELECT * FROM members O WHERE O.login = '$row[0]'");
				$stmt2->execute();
				$row2 = $stmt2->fetch(PDO::FETCH_NUM);
				$ads[$count] = $row[1]; 		$owners[$count] = "owner:";
				$ads[$count+1] = $row[2];		$owners[$count+1] = $row2[0];
				$ads[$count+2] = $row[3];		$owners[$count+2] = $row2[2];
				$ads[$count+3] = $row[4];		$owners[$count+3] = $row2[3];
				$ads[$count+4] = $row[5];		$owners[$count+4] = $row2[4];
				$ads[$count+5] = $row[6];		$owners[$count+5] = $row2[5];
				$count = $count+6;
				$foundAd = TRUE;
			}
		}
	}
	catch(PDOException $e) {
		echo $stmt . "<br>" . $e->getMessage();
	}
	$conn = null;

?>
<!DOCTYPE html>
<html>
<head>
	<title>list of properties</title>
	<link rel="stylesheet" type="text/css" href="../css/style_properties.css">
</head>
<body>
	<form id="search_results">
	<h1 id="title">Search results:</h1>
	<table>
		<?php
			echo "<tr><td><h2>Your search criteria were:</h2></td></tr>";
			echo "<tr><td>Title keywords:</td><td>".$_POST['keywords']."</td></tr>";
			echo "<tr><td>Location keywords:</td><td>".$_POST['location']."</td></tr>";
			echo "<tr><td>Maximum price:</td><td>".$_POST['price']."</td></tr>";
			echo "<tr><td>=========================================================</td></tr>";
			$number = 1;
			for($i = 0; $i < count($ads); $i++) {
				echo "<tr><td>Property $number)</td><tr>";
				echo "<tr><td>Title: $ads[$i]</td><td>$owners[$i]</td><tr>";
				$i++;
				echo "<tr><td>Location: $ads[$i]</td><td>Username: $owners[$i]</td><tr>";
				$i++;
				echo "<tr><td>Price: $ads[$i]</td><td>First name: $owners[$i]</td><tr>";
				$i++;
				echo "<tr><td>Availability: $ads[$i]</td><td>Last name: $owners[$i]</td><tr>";
				$i++;
				echo "<tr><td>Message: $ads[$i]</td><td>Phone number: $owners[$i]</td><tr>";
				$i++;
				echo "<tr><td>Image: <img src='$ads[$i]' border='1px solid black' alt='no image' height='300px' width='450px'></td><td>Email: $owners[$i]</td></tr>
				<tr><td>-----------------------------------------------------------</td></tr>
				";
				$number++;
			}
		?>
	</table>
	<br>
	<a href="tenant_properties.php">Go back to the search page</a>
	</form>
</body>
</html>






