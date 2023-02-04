<?php
ini_set("session.save_path", "/home/unn_w20044984/sessionData");
session_start();

// Session destroy script
$_SESSION = array();

// Set cookie expiration to one hour ago
$params = session_get_cookie_params();
setcookie(
    session_name(),
    "",
    time() - 3600,
    $params["path"],
    $params["domain"],
    $params["secure"],
    $params["httponly"]
);

session_destroy();
