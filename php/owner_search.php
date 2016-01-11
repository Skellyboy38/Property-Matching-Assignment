<?php
	session_start();
	$gender = "";
	$age_min = 0;
	$age_max = 0;
	$min_income = 0;
	if(isset($_POST['gender'])) {
		$gender = $_POST['gender'];
	}
	if(isset($_POST['age_min'])) {
		$age_min = $_POST['age_min'];
	}
	if(isset($_POST['age_max'])) {
		$age_max = $_POST['age_max'];
	}
	if(isset($_POST['occupation'])) {
		$trim_occ = trim($_POST['occupation']);
		$trim_occupation = preg_split("/[\s]+/", $trim_occ);
	}
	if(isset($_POST['income'])) {
		$min_income = $_POST['income'];
	}
	$tenants = array();
	$count = 0;

	$servername = "localhost";
	$username = "root";
	$dbname = "rental_7195788";

	try {
		$conn = new PDO("mysql:host=$servername;dbname=$dbname", $username, NULL);
		$conn->setAttribute(PDO::ATTR_ERRMODE, PDO::ERRMODE_EXCEPTION);

		$stmt = $conn->prepare('SELECT * FROM tenant_profile');
		$stmt->execute();

		while($row = $stmt->fetch(PDO::FETCH_NUM)) {
			$foundTenant = FALSE;
			if($trim_occupation == TRUE) {
				for($i = 0; $i < count($trim_occupation); $i++) {
					if(stripos($row[3], $trim_occupation[$i]) !== FALSE && !$foundTenant) {
						$stmt2 = $conn->prepare("SELECT * FROM members O WHERE O.login = '$row[0]'");
						$stmt2->execute();
						$row2 = $stmt2->fetch(PDO::FETCH_NUM);
						$tenants[$count] = $row2[2];
						$tenants[$count+1] = $row2[3];
						$tenants[$count+2] = $row2[4];
						$tenants[$count+3] = $row2[5];
						$tenants[$count+4] = $row[1];
						$tenants[$count+5] = $row[2];
						$tenants[$count+6] = $row[3];
						$tenants[$count+7] = $row[4];
						$count = $count+8;
						$foundTenant = TRUE;
					}
				}
			}
			if(isset($_POST['gender']) && strcmp($row[1], $gender) == 0 && !$foundTenant) {
				$stmt2 = $conn->prepare("SELECT * FROM members O WHERE O.login = '$row[0]'");
				$stmt2->execute();
				$row2 = $stmt2->fetch(PDO::FETCH_NUM);
				$tenants[$count] = $row2[2];
				$tenants[$count+1] = $row2[3];
				$tenants[$count+2] = $row2[4];
				$tenants[$count+3] = $row2[5];
				$tenants[$count+4] = $row[1];
				$tenants[$count+5] = $row[2];
				$tenants[$count+6] = $row[3];
				$tenants[$count+7] = $row[4];
				$count = $count+8;
				$foundTenant = TRUE;
					
			}
			if(($age_min != 0 &&$age_min <= $row[2]) || ($age_max != 0 && $age_max >= $row[2]) && !$foundTenant) {
				$stmt2 = $conn->prepare("SELECT * FROM members O WHERE O.login = '$row[0]'");
				$stmt2->execute();
				$row2 = $stmt2->fetch(PDO::FETCH_NUM);
				$tenants[$count] = $row2[2];
				$tenants[$count+1] = $row2[3];
				$tenants[$count+2] = $row2[4];
				$tenants[$count+3] = $row2[5];
				$tenants[$count+4] = $row[1];
				$tenants[$count+5] = $row[2];
				$tenants[$count+6] = $row[3];
				$tenants[$count+7] = $row[4];
				$count = $count+8;
				$foundTenant = TRUE;
			}
			if($min_income > 0 && $min_income <= $row[4] && !$foundTenant) {
				$stmt2 = $conn->prepare("SELECT * FROM members O WHERE O.login = '$row[0]'");
				$stmt2->execute();
				$row2 = $stmt2->fetch(PDO::FETCH_NUM);
				$tenants[$count] = $row2[2];
				$tenants[$count+1] = $row2[3];
				$tenants[$count+2] = $row2[4];
				$tenants[$count+3] = $row2[5];
				$tenants[$count+4] = $row[1];
				$tenants[$count+5] = $row[2];
				$tenants[$count+6] = $row[3];
				$tenants[$count+7] = $row[4];
				$count = $count+8;
				$foundTenant = TRUE;
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
	<title>Profile</title>
	<link rel="stylesheet" type="text/css" href="../css/style_properties.css">
</head>
<body>
	<form id="search_results" action="owner_profile.php">
		<table>
			<?php
				$number = 1;
				echo "<tr><td><h2>Your search criteria were:</h2></td></tr>";
				echo "<tr><td>Gender:</td><td>".$gender."</td></tr>";
				echo "<tr><td>Minimum age:</td><td>".$age_min."</td></tr>";
				echo "<tr><td>Maximum age:</td><td>".$age_max."</td></tr>";
				echo "<tr><td>Occupation keywords:</td><td>".$_POST['occupation']."</td></tr>";
				echo "<tr><td>Minimum income:</td><td>".$min_income."</td></tr>";
				echo "<tr><td>=========================================================</td></tr>";
				for($i = 0; $i < count($tenants); $i++) {
					echo "<tr><td>Tenant $number)</td></tr>";
					echo "<tr><td>First name: $tenants[$i]</td></tr>";
					$i++;
					echo "<tr><td>Last name: $tenants[$i]</td></tr>";
					$i++;
					echo "<tr><td>Phone number: $tenants[$i]</td></tr>";
					$i++;
					echo "<tr><td>Email: $tenants[$i]</td></tr>";
					$i++;
					echo "<tr><td>Gender: $tenants[$i]</td></tr>";
					$i++;
					echo "<tr><td>Age: $tenants[$i]</td></tr>";
					$i++;
					echo "<tr><td>Occupation: $tenants[$i]</td></tr>";
					$i++;
					echo "<tr><td>Income: $tenants[$i]</td></tr>";
					echo "<tr><td>---------------------------------</td></tr>";
					$number++;
				}
				echo "<tr><td><input type='submit' value='Go back'></td></tr>"; 
			?>
		</table>
	</form>
</body>
</html>