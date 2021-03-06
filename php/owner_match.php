<?php
	session_start();
	$login = $_SESSION['username'];
	$username = "root";
	$servername = "localhost";
	$dbname = "rental_7195788";

	try {
		$conn = new PDO("mysql:host=$servername;dbname=$dbname", $username, NULL);
		$conn->setAttribute(PDO::ATTR_ERRMODE, PDO::ERRMODE_EXCEPTION);

		$stmt = $conn->prepare("SELECT login FROM owner_preferences WHERE login = '".$login."'");
		$stmt->execute();
		$row = $stmt->fetch(PDO::FETCH_NUM);
		if($row[0] == FALSE) {
			$result = "You didn't update your preferences.<br>Go to the preferences tab first.";
			$canProceed = FALSE;
		}
		else {
			$result = "";
			$canProceed = TRUE;
		}

		if($canProceed) {
			$stmt = $conn->prepare("SELECT * FROM owner_preferences WHERE login = '".$login."'");
			$stmt->execute();
			$row = $stmt->fetch(PDO::FETCH_NUM);
			$gender = $row[1]; $age = $row[2]; $occupation = $row[3]; $income = $row[4];

			$count = 0;
			$rankings = array();
			$stmt2 = $conn->prepare("SELECT * FROM tenant_profile");
			$stmt2->execute();
			while($row = $stmt2->fetch(PDO::FETCH_NUM)) {
				if(strcmp($gender, $row[1]) == 0) {
					$count++;
				}
				if($age < $row[2]) {
					$count++;
				}
				if(strcmp($occupation, $row[3]) == 0) {
					$count++;
				}
				if($income > $row[4]) {
					$count++;
				}
				$rankings[$row[0]] = $count;
			}
			for($i = 1; $i < 6; $i++) {
				$max = 0;
				$user = "";
				$column = "match".$i;
				foreach($rankings as $key => $value) {
					if($max <= $value) {
						$max = $value;
						$user = $key;
					}
				}
				$stmt3 = $conn->prepare("UPDATE members SET $column = '".$user."' WHERE login = '".$login."'");
				$stmt3->execute();
				unset($rankings[$user]);
			}

			//Begin matching here-----------------------------------------------------------------

			$stmt4 = $conn->prepare("SELECT * from members WHERE login = '".$login."'");
			$stmt4->execute();
			$row = $stmt4->fetch(PDO::FETCH_NUM);
			//Get the top 5 of the tenant.
			$match1 = $row[7]; $match2 = $row[8]; $match3 = $row[9]; $match4 = $row[10]; $match5 = $row[11];
			$winner = "";
			//-----------------------------------------------------------------------------------
			$stmt1 = $conn->prepare("SELECT * FROM members WHERE login = '".$match1."'");
			$stmt1->execute();
			$row1 = $stmt1->fetch(PDO::FETCH_NUM);
			$array1 = [$row1[7]=>0, $row1[8]=>1, $row1[9]=>2, $row1[10]=>3, $row1[11]=>4];

			$stmt2 = $conn->prepare("SELECT * FROM members WHERE login = '".$match2."'");
			$stmt2->execute();
			$row2 = $stmt2->fetch(PDO::FETCH_NUM);
			$array2 = [$row2[7]=>0, $row2[8]=>1, $row2[9]=>2, $row2[10]=>3, $row2[11]=>4];

			$stmt3 = $conn->prepare("SELECT * FROM members WHERE login = '".$match3."'");
			$stmt3->execute();
			$row3 = $stmt3->fetch(PDO::FETCH_NUM);
			$array3 = [$row3[7]=>0, $row3[8]=>1, $row3[9]=>2, $row3[10]=>3, $row3[11]=>4];

			$stmt4 = $conn->prepare("SELECT * FROM members WHERE login = '".$match4."'");
			$stmt4->execute();
			$row4 = $stmt4->fetch(PDO::FETCH_NUM);
			$array4 = [$row4[7]=>0, $row4[8]=>1, $row4[9]=>2, $row4[10]=>3, $row4[11]=>4];

			$stmt5 = $conn->prepare("SELECT * FROM members WHERE login = '".$match5."'");
			$stmt5->execute();
			$row5 = $stmt5->fetch(PDO::FETCH_NUM);
			$array5 = [$row5[7]=>0, $row5[8]=>1, $row5[9]=>2, $row5[10]=>3, $row5[11]=>4];
			//-----------------------------------------------------------------------------------
			$array = [$match1=>$array1, $match2=>$array2, $match3=>$array3, $match4=>$array4, $match5=>$array5];
			$isDone = FALSE;

			$tenants = array();
			$tenants[0] =  $row5[7]; $tenants[1] = $row5[8]; $tenants[2] = $row5[9]; $tenants[3] = $row5[10]; $tenants[4] = $row5[11];

			$links = [$match1=>null, $match2=>null, $match3=>null, $match4=>null, $match5=>null];
			$links2 = [$row5[7]=>null, $row5[8]=>null, $row5[9]=>null, $row5[10]=>null, $row5[11]=>null];

			while(!$isDone) {
				$count = 0;
				foreach($tenants as $key1=>$value1) {
					$stmt = $conn->prepare("SELECT * FROM members WHERE login = '$value1'");
					$stmt->execute();
					$row = $stmt->fetch(PDO::FETCH_NUM);
					$tenantsFav = [0=>$row[7], 1=>$row[8], 2=>$row[9], 3=>$row[10], 4=>$row[11]];

					foreach($tenantsFav as $key2=>$value2) {
						if($links[$value2] == null) {
							$links[$value2] = $value1;
							$links2[$value1] = $value2;
							$count++;
							break;
						}
						else {
							if($array[$value2][$value1] <= $array[$value2][$links[$value2]]) {
								$links2[$links[$value2]] = null;
								$links1[$links2[$value1]] = null;
								$links[$value2] = $value1;
								$links2[$value1] = $value2;
								break;
							}
						}
					}
				}
				$toCheck = [0=>$links[$match1], 1=>$links[$match2], 2=>$links[$match3], 3=>$links[$match4], 4=>$links[$match5]];
				for($i = 0; $i < count($toCheck); $i++) {
					for($j = $i+1; $j < count($toCheck); $j++) {
						if($toCheck[$i] == $toCheck[$j]) {
							$count++;
						}
					}
				}

				if($count == 0) {
					$winner = $links2[$login];
					$isDone = true;
				}
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
	<title>owner match</title>
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

	<p id="tenant_winner"> 
	<?php 
		echo "Your perfect match is: ". $winner ."<br><br>";

		echo "The other matches are: <br>";
		foreach($links as $key=>$value) {
			echo $key . " => " . $value . "<br>";
		}
		echo "<br>";
		foreach($links2 as $key=>$value) {
			echo $key . " => " . $value . "<br>";
		}
	?>
	</p>

	<h1 id="copyright">Copyright 2015 &nbsp&copy</h1>
	<p id="website">HousingSoulmate.com</p>
	<p id="page_name">MATCH</p>
	<a id="home" href="owner.php"><img src="../images/home.jpg" height="100" width="100"></a>


	<div id="footer">
		<img src="../images/footer.jpg" height="200" width="1250">
	</div>
</body>
</html>