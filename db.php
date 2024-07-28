<?php
function get_db_connection() {
    $host = 'localhost';
    $user = 'root';
    $password = '';
    $database = 'wish_list';

    $conn = new mysqli($host, $user, $password, $database);

    if ($conn->connect_error) {
        die("Connection failed: " . $conn->connect_error);
    }else{
        // echo "ss";
    }

    return $conn;
}
?>
