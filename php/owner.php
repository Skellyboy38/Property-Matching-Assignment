<?php
	session_start();
	$name = $_SESSION['first_name'] . " " . $_SESSION['last_name'];
?>
<!DOCTYPE html>
<html>
<head>
	<title>owner</title>
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
	<h1 id="delete_owner"><a href="delete_owner.php">Delete account</a></h1>


	<h1 id="copyright">Copyright 2015 &nbsp&copy</h1>
	<p id="website">HousingSoulmate.com</p>
	<p id="owner_intro">Welcome <em><?php echo $name;?></em>.<br><br>
	To the left are the options available to you:<br>
	1) Log out to go back to the home page<br>
	2) Search tenants to search the tenant database.<br>
	3) Place ad to place your own property to view.<br>
	4) View ads to view the ads you have placed.</p>
	<p id="page_name">HOME OWNER PAGE</p>
	<a id="home" href="owner.php"><img src="../images/home.jpg" height="100" width="100"></a>


	<div id="footer">
		<img src="../images/footer.jpg" height="200" width="1250">
	</div>
</body>
</html>