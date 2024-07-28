<?php
session_start();
require 'db.php';

if ($_SERVER['REQUEST_METHOD'] == 'POST') {
    if (isset($_POST['login'])) {
        $email = $_POST['email'];
        $password = $_POST['password'];
        echo $password;
        echo "vg\n";

        $conn = get_db_connection();

        // Prepare the statement
        $stmt = $conn->prepare("SELECT id, password FROM wishers WHERE email = ?");
        if ($stmt === false) {
            die("Prepare failed: (" . $conn->errno . ") " . $conn->error);
        }

        // Bind the email parameter
        $stmt->bind_param("s", $email);
        if (!$stmt->execute()) {
            die("Execute failed: (" . $stmt->errno . ") " . $stmt->error);
        }

        // Get the result
        $result = $stmt->get_result();
        if ($result->num_rows === 1) {
            $row = $result->fetch_assoc();
            $id = $row['id'];
            $pass = $row['password'];
            echo $pass;
            echo "sijj";
            echo $row['password'];
            // $hashed_password = $row['password'];
            if ($password == $pass) {
                header("Location: editWishList.php");
                // header("Location: login.php");

                // header("Location: http://www.google.com/");
                exit();


                # code...
            }

            

        $stmt->close();
        $conn->close();
    }
}}
?>

<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <title>Login</title>
</head>
<body>
<h1>Login</h1>
<form method="post" action="">
    <input type="hidden" name="login" value="1">
    <label for="email">Email:</label>
    <input type="email" id="email" name="email" required>
    <br>
    <label for="password">Password:</label>
    <input type="password" id="password" name="password" required>
    <br>
    <button type="submit">Login</button>
</form>
</body>
</html>