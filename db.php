<?php
function get_db_connection() {
    $host = 'db';
    $user = 'root';
    $password = 'root';
    $database = 'wishlist';

    $conn = new mysqli($host, $user, $password, $database);

    if ($conn->connect_error) {
        die("Connection failed: " . $conn->connect_error);
    }

    return $conn;
}
?>
