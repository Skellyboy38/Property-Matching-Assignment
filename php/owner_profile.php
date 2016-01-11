<!DOCTYPE html>
<html>
<head>
	<title>Profile</title>
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

	<h1 id="copyright">Copyright 2015 &nbsp&copy</h1>
	<p id="website">HousingSoulmate.com</p>
	<p id="page_name">SEARCH FOR TENANTS</p>
	<a id="home" href="owner.php"><img src="../images/home.jpg" height="100" width="100"></a>

	<form id="owner_preferences" method="post" action="owner_search.php">
		<table>
			<tr id="box_header">
				<td>Select your persionalized tenant!</td>
			</tr>
			<tr>
				<td>--------------</td>
			</tr>
			<tr>
				<td>Gender:</td>
				<td><input type="radio" name="gender" value="Male">&nbsp&nbspMale</td>
				<td><input type="radio" name="gender" value="Female">&nbsp&nbspFemale</td>
			</tr>
			<tr>
				<td>Age Range:</td>
				<td>Min:&nbsp<input type="text" name="age_min"></td>
				<td>Max:&nbsp<input type="text" name="age_max"></td>
			</tr>
			<tr>
				<td>Occupation:</td>
				<td><input type="text" name="occupation"></td>
			</tr>
			<tr>
				<td>Level of income:</td>
				<td>$<input type="text" name="income"></td>
			</tr>
			<tr>
				<td><input type="submit" value="Submit" name="submit"></td>
				<td><input type="reset" value="Reset" name="reset"></td>
			</tr>
		</table>
	</form>
	<div id="footer">
		<img src="../images/footer.jpg" height="200" width="1250">
	</div>
</body>
</html>