<!doctype html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <title>Edit Toy Form</title>
</head>

<body>
    <h1>Edit Toy Form</h1>
    <nav>
        <ul>
            <li><a href="userHomePage.html">Home</a></li>
            <li><a href="chooseToyList.php">View/Edit Toy List</a></li>
            <li><a href="userCreditsPage.html">Credits</a></li>
            <li><a href="loginForm.html">Logout</a></li>
        </ul>
    </nav>
    <?php
    $toyID = filter_has_var(INPUT_GET, "toyID") ? $_GET["toyID"] : null;
    $catDesc = filter_has_var(INPUT_GET, 'catDesc') ? $_GET['catDesc'] : null;
    $manName = filter_has_var(INPUT_GET, 'manName') ? $_GET['manName'] : null;
    $toyName = filter_has_var(INPUT_GET, 'toyName') ? $_GET['toyName'] : null;
    $toyPrice = filter_has_var(INPUT_GET, 'toyPrice') ? $_GET['toyPrice'] : null;
    $description = filter_has_var(INPUT_GET, 'description') ? $_GET['description'] : null;

    $toyID = trim($toyID);
    $catDesc = trim($catDesc);
    $manName = trim($manName);
    $toyName = trim($toyName);
    $toyPrice = trim($toyPrice);
    $description = trim($description);

    if (empty($toyID)) {
        echo "<p>Please <a href='chooseToyList.php'>choose</a> a toy.</p>\n";
    } else {
        try {
            // establishing connection
            require_once "functions.php";
            $dbConn = getConnection();

            // querying the database
            $sqlQuery = "SELECT toyID, toyName, NTL_toys.catID, catDesc, manName, NTL_toys.manID, toyPrice, description
				       FROM NTL_toys
                       INNER JOIN NTL_category ON NTL_toys.catID = NTL_toys.catID
                       INNER JOIN NTL_manufacturer ON NTL_toys.manID = NTL_toys.manID
                       WHERE toyID = :toyID";

            //   $userRecord = 'catDesc';
            //   $catRecord = 'catDesc';

            //   echo "<select name='catDesc'>";
            //   while ($stmt = $queryResult->fetchObject()) {
            //     if ($userRecord->catDesc == $catRecord->catDesc) {
            //       echo "<option value='{$catRecord->catDesc}' selected> {$catRecord->catDesc}</option>";
            // } else {
            //   echo "<option value='{$catRecord->catDesc}'>{$catRecord->catDesc}</option>";
            // }
            // echo "</select>";

            // Preparing SQL statement
            $stmt = $dbConn->prepare($sqlQuery);

            // Executing SQL statement
            $stmt->execute(array(':toyID' => $toyID));

            // $queryResult = $dbConn->query($sqlQuery);

            $rowObj = $stmt->fetchObject();

            // displaying query results in form method
            echo "
		<h1>Update '{$rowObj->toyName}'</h1>
		<form id='updateToy' action='updateToy.php' method='get'>
            <p>Toy ID <input type='text' name='toyID' value='$toyID' readonly /></p>
			<p>Toy Name <input type='text' name='toyName' size='50' value='{$rowObj->toyName}' /></p>
			<p>Category <input type='text' name='catDesc' value='{$rowObj->catDesc}' /></p>
            <p>Manufacturer <input type='text' name='manName' value='{$rowObj->manName}' /></p>
            <p>Toy Price <input type='number' step='0.01' min='0' name='toyPrice' value='{$rowObj->toyPrice}' /></p>
			Description <br />
			<textarea name='description'>{$rowObj->description}</textarea>
			<p><input type='submit' name='submit' value='Update Toy'></p>
		</form>
		";
        } catch (Exception $e) {
            echo "<p>Toy details not found: " . $e->getMessage() . "</p>\n";
        }
    }
    ?>
</body>

</html>