<?php
function getConnection()
{
    try {
        $connection = new PDO(
            "mysql:host=localhost;dbname=unn_w20044984",
            "unn_w20044984",
            "Newcastle1020@"
        );
        $connection->setAttribute(PDO::ATTR_ERRMODE, PDO::ERRMODE_EXCEPTION);
        return $connection;
    } catch (Exception $e) {
        throw new Exception("Connection error " . $e->getMessage(), 0, $e);
    }
}
