<!DOCTYPE html>
<html>
<head>
	<title>Tenants</title>
	<link rel="stylesheet" type="text/css" href="../css/style.css">
</head>
<body>
	<div id="header">
		<img src="../images/header.jpg" height="200" width="1250">
	</div>
	<h1 id="welcome">Welcome!</h1>
	<h1 id="Tenant"><a href="tennent.html">Tenant Menu</a></h1>
	<h1 id="Owner"><a href="owner.html">Owner Menu</a></h1>
	<h1 id="Register"><a href="registration.html">Register</a></h1>
	<h1 id="copyright">Copyright 2015 &nbsp&copy</h1>
	<p id="website">HousingSoulmate.com</p>
	<a id="home" href="index.html"><img src="../images/home.jpg" height="100" width="100"></a>
	<p id="tenant_intro">Search for properties to rent out based<br>
	on a set of criteria (including renting date, location and price).</p>
	<p id="page_name">TENANT PAGE</p>
	<form id="tenant_search">
		<table>
			<tr id="box_header">
				<td>Search for properties!</td>
			</tr>
			<tr>
				<td>Renting period:</td>
				<td>Sep-Dec&nbsp<input type="checkbox" name="fall"></td>
				<td>Jan-Apr&nbsp<input type="checkbox" name="winter"></td>
				<td>May-Aug&nbsp<input type="checkbox" name="summer"></td>
			</tr>
			<tr>
				<td>Price:</td>
				<td>< 300 <input type="checkbox" name="300"></td>
				<td>< 500 <input type="checkbox" name="500"></td>
				<td>< 700 <input type="checkbox" name="700"></td>
				<td>< 1000 <input type="checkbox" name="1000"></td>
				<td>&nbsp&nbsp1000+ <input type="checkbox" name="1000+"></td>
			</tr>
			<tr>
				<td>Location:</td>
				<td><input type="text" id="rent_location"></td>
			</tr>
			<tr>
				<td><input type="submit" value="Search"></td>
				<td><input type="reset" value="reset fields"></td>
			</tr>
		</table>
	</form>
	<div id="footer">
		<img src="../images/footer.jpg" height="200" width="1250">
	</div>
</body>
</html>