<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="utf-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <title>View Toy List</title>
    <meta name="description" content="">
    <meta name="viewport" content="width=device-width, initial-scale=1">
</head>

<body>
    <h1>All Toys</h1>
    <nav>
        <ul>
            <li><a href="index.html">Home</a></li>
            <li><a href="toyQuery.php">View Toy List</a></li>
            <li><a href="orderToysForm.php">Order Toy(s)</a></li>
            <li><a href="credits.html">Credits</a></li>
            <li><a href="loginForm.html">Login</a></li>
        </ul>
    </nav>

    <?php try {
        // establishing connection
        require_once "functions.php";
        $dbConn = getConnection();

        // querying the database
        $sqlQuery = "SELECT toyName, description, toyPrice, catDesc
                       FROM NTL_toys
                       INNER JOIN NTL_category ON NTL_category.catID = NTL_toys.catID
                       ORDER BY toyName";
        $queryResult = $dbConn->query($sqlQuery);

        // outputting the query results
        while ($rowObj = $queryResult->fetchObject()) {
            echo "<div class='toy'>\n
	<span class='toyName'>{$rowObj->toyName}</span>\n
	<span class='description'>{$rowObj->description}</span>\n
	<span class='toyPrice'>{$rowObj->toyPrice}</span>\n
    <span class='catDesc'>{$rowObj->catDesc}</span>\n
	</div>\n";
        }
    } catch (Exception $e) {
        echo "<p>Query failed: " . $e->getMessage() . "</p>\n";
    } ?>


</body>

</html>