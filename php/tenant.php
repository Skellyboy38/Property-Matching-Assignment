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
	<h1 id="search_properties"><a href="tenant_properties.php">Search properties</a></h1>
	<h1 id="update_profile"><a href="tenant_profile.php">Update profile</a></h1>
	<h1 id="match"><a href="tenant_match.php">Find match</a></h1>
	<h1 id="delete_tenant"><a href="delete_tenant.php">Delete account</a></h1>

	<h1 id="copyright">Copyright 2015 &nbsp&copy</h1>
	<p id="website">HousingSoulmate.com</p>
	<p id="owner_intro">Welcome <em><?php echo $name;?></em>.<br><br>
	To the left are the options available to you:<br>
	1) Log out to go back to the home page<br>
	2) Search for properties based on some criteria.<br>
	3) Look and update your personal profile.<br></p>
	<p id="page_name">TENANT PAGE</p>
	<a id="home" href="tenant.php"><img src="../images/home.jpg" height="100" width="100"></a>


	<div id="footer">
		<img src="../images/footer.jpg" height="200" width="1250">
	</div>
</body>
</html>