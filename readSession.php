<?php
ini_set("session.save_path", "/home/unn_w20044984/sessionData");
session_start();
$username = $_SESSION['firstname'];
echo "<p>Firstname: $username</p>\n";

?>

<!DOCTYPE html>
<html>

<head>
    <meta charset="utf-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <title></title>
    <meta name="description" content="">
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <link rel="stylesheet" href="">
</head>

<body>

    <?php
    if (isset($_SESSION['firstname'])) {
        echo $_SESSION['firstname'];
    } else {
        echo "<p>Session not set</p>\n";
    }
    ?>

</body>

</html>