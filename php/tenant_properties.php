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

	<h1 id="copyright">Copyright 2015 &nbsp&copy</h1>
	<p id="website">HousingSoulmate.com</p>
	<p id="page_name">SEARCH FOR PROPERTIES</p>
	<a id="home" href="tenant.php"><img src="../images/home.jpg" height="100" width="100"></a>

	<form id="search_properties" method="post" action="properties.php">
		<h1>Narrow your search here</h1><br>
		<table>
			<tr>
				<td>Title keywords:</td>
				<td><input type="text" name="keywords"></td>
				<td>(Separate words with spaces)</td>
			</tr>
			<tr>
				<td>Location keywords:</td>
				<td><input type="text" name="location"></td>
			</tr>
			<tr>
				<td>Maximum price:</td>
				<td><input type="text" name="price"></td>
			</tr>
		</table>
		<input type="submit" value="search">&nbsp;&nbsp;<input type="reset" value="reset">
	</form>

	<div id="footer">
		<img src="../images/footer.jpg" height="200" width="1250">
	</div>
</body>
</html>