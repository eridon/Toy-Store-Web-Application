<?php
ini_set("session.save_path", "/home/unn_w20044984/sessionData");
session_start();
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
    if (isset($_SESSION['firstname']) && $_SESSION['firstname']) {
        echo "p>Welcome! This page could now display information / provide functionality that you want to restrict access to.</p>\n";
    } else {
        echo "<p>STOP RIGHT NOW</p>\n";
    }
    ?>

</body>

</html>