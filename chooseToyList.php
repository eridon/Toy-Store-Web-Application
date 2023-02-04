<!doctype html>
<html lang="en">

<head>
	<meta charset="UTF-8">
	<title>Edit Toy List</title>
</head>

<body>
	<h1>All Toys</h1>
	<nav>
		<ul>
			<li><a href="userHomePage.html">Home</a></li>
			<li><a href="chooseToyList.php">View/Edit Toy List</a></li>
			<li><a href="userCreditsPage.html">Credits</a></li>
			<li><a href="loginForm.html">Logout</a></li>
		</ul>
	</nav>

	<?php try {
		// establishing connection
		require_once "functions.php";
		$dbConn = getConnection();

		// SQL query to retreive table details
		$sqlQuery = "SELECT toyName, catDesc, manName, toyPrice, description, toyID
				 FROM NTL_toys
				 INNER JOIN NTL_category ON NTL_category.catID = NTL_toys.catID
				 INNER JOIN NTL_manufacturer ON NTL_manufacturer.manID = NTL_toys.manID
				 ORDER BY toyName";

		$queryResult = $dbConn->query($sqlQuery);

		// outputting retreived table details
		while ($rowObj = $queryResult->fetchObject()) {
			echo "<div class='toy'>\n
				   <span class='toyName'><a href='editToyForm.php?toyID={$rowObj->toyID}'>{$rowObj->toyName}</a></span>\n
				   <span class='catDesc'>{$rowObj->catDesc}</span>\n
				   <span class='manName'>{$rowObj->manName}</span>\n
				   <span class='toyPrice'>{$rowObj->toyPrice}</span>\n
				   <span class='description'>{$rowObj->description}</span>\n
			  </div>\n";
		}
	} catch (Exception $e) {
		echo "<p>Query failed: " . $e->getMessage() . "</p>\n";
	} ?>

</body>

</html>