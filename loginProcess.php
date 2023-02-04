<?php
ini_set("session.save_path", "/home/unn_w20044984/sessionData");
session_start();
?>
<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="utf-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <title>Login Screen</title>
    <meta name="description" content="">
    <meta name="viewport" content="width=device-width, initial-scale=1">
</head>

<body>
    <h1>Account Home</h1>
    <nav>
        <ul>
            <li><a href="userHomePage.html">Home</a></li>
            <li><a href="chooseToyList.php">View/Edit Toy List</a></li>
            <li><a href="userCreditsPage.html">Credits</a></li>
            <li><a href="loginForm.html">Logout</a></li>
        </ul>
    </nav>
    <?php
    // retrieving the username and password from input details
    $username = filter_has_var(INPUT_POST, 'username') ? $_POST['username'] : null;
    $password = filter_has_var(INPUT_POST, 'password') ? $_POST['password'] : null;
    $username = trim($username);
    $password = trim($password);

    if (empty($username) || empty($password)) {
        echo "<p>You need to provide a username and password. Please try <a href='loginForm.html'>again</a>.</p>\n";
    }

    try {
        // clearing previous session
        unset($_SESSION['username']);
        unset($_SESSION['logged-in']);

        // establishing connection
        require_once("functions.php");
        $dbConn = getConnection();

        /* Query the users database table to get the password hash for the username entered by the user */
        $querySQL = "SELECT passwordHash FROM NTL_users 
                          WHERE username = :username";

        // Preparing SQL statement
        $stmt = $dbConn->prepare($querySQL);

        // Executing SQL statement
        $stmt->execute(array(':username' => $username));

        /* Check if a record was returned by the query. If yes, then there was a username matching what was entered in the logon form.*/
        $user = $stmt->fetchObject();

        // If record is returned
        if ($user) {
            if (password_verify($password, $user->passwordHash)) {
                echo "<h2>You have successfully logged in</h2>\n";

                // Variable that indicates successful login
                $_SESSION['logged-in'] = true;

                $_SESSION['username'] = $username;
            } else {
                echo "<p>Username or Password is incorrect. Please try <a href='loginForm.html'>again</a>.</p>\n";
            }
        } else {
            /* Code that outputs an error message if incorrect details are entered */
            echo "<p>Username or Password is incorrect. Please try <a href='loginForm.html'>again</a>.</p>\n";
        }
    } catch (Exception $e) {
        echo "There was a problem: " . $e->getMessage();
    }
    ?>
</body>

</html>