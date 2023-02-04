<!doctype html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <title>Toy Update</title>
</head>

<body>

    <?php
    // Retrieving variables
    $toyID = filter_has_var(INPUT_GET, "toyID") ? $_GET["toyID"] : null;
    $catID = filter_has_var(INPUT_GET, 'catID') ? $_GET['catID'] : null;
    $manID = filter_has_var(INPUT_GET, 'manID') ? $_GET['manID'] : null;
    $catDesc = filter_has_var(INPUT_GET, 'catDesc') ? $_GET['catDesc'] : null;
    $manName = filter_has_var(INPUT_GET, 'manName') ? $_GET['manName'] : null;
    $toyName = filter_has_var(INPUT_GET, 'toyName') ? $_GET['toyName'] : null;
    $toyPrice = filter_has_var(INPUT_GET, 'toyPrice') ? $_GET['toyPrice'] : null;
    $description = filter_has_var(INPUT_GET, 'description') ? $_GET['description'] : null;

    $errors = false;

    if (empty($toyID)) {
        echo "<p>You need to have selected a toy.</p>\n";
        $errors = true;
    }
    if (empty($catDesc)) {
        echo "<p>You need to choose a category.</p>\n";
        $errors = true;
    }
    if (empty($manName)) {
        echo "<p>You need to choose a manufacturer.</p>\n";
        $errors = true;
    }
    if (empty($toyName)) {
        echo "<p>You need to have selected a toy name.</p>\n";
        $errors = true;
    }
    if (empty($toyPrice)) {
        echo "<p>You need to enter a price.</p>\n";
        $errors = true;
    }
    // if (!filter_var($toyPrice, FILTER_VALIDATE_INT)) {
    //    echo "<p>The price should be a number</p>\n";
    //   $errors = true;
    // }

    if ($errors === true) {
        echo "<p>Please try <a href='chooseToyList.php'>again</a>.</p>\n";
    } else {
        try {
            // establishing connection
            require_once("functions.php");
            $dbConn = getConnection();
            $description = $dbConn->quote($description);

            // updating current records
            $updateSQL = "UPDATE NTL_toys
                          SET toyName = $toyName, catDesc = $catDesc, manName = $manName, toyPrice = $toyPrice, description = $description 
                          WHERE toyID = ':toyID'";
            // prepared statement declaration
            $stmt = $dbConn->prepare($updateSQL);
            // execution of prepared statement
            $stmt->execute(array(
                ':toyID' => $toyID
            ));

            echo "<p>Toy updated</p>\n";
        } catch (Exception $e) {
            echo "<p>Toy not updated: " . $e->getMessage() . "</p>\n";
        }
    }
    ?>
</body>

</html>