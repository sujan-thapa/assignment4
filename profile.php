<?php
session_start();
require 'db.php';

if (!isset($_SESSION['user_id'])) {
    header("Location: login.php");
    exit();
}

$user_id = $_SESSION['user_id'];
$conn = get_db_connection();

if ($_SERVER['REQUEST_METHOD'] == 'POST') {
    if ($_POST['action'] == 'update_profile') {
        $name = $_POST['name'];
        $email = $_POST['email'];
        $stmt = $conn->prepare("UPDATE wishers SET name = ?, email = ? WHERE id = ?");
        $stmt->bind_param("ssi", $name, $email, $user_id);
    } elseif ($_POST['action'] == 'change_password') {
        $password = password_hash($_POST['password'], PASSWORD_BCRYPT);
        $stmt = $conn->prepare("UPDATE wishers SET password = ? WHERE id = ?");
        $stmt->bind_param("si", $password, $user_id);
    }
    $stmt->execute();
    $stmt->close();
}

$stmt = $conn->prepare("SELECT name, email FROM wishers WHERE id = ?");
$stmt->bind_param("i", $user_id);
$stmt->execute();
$stmt->bind_result($name, $email);
$stmt->fetch();
$stmt->close();
$conn->close();
?>
<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <title>Profile</title>
</head>
<body>
<h1>Profile</h1>
<form method="post" action="profile.php">
    <label for="name">Name:</label>
    <input type="text" id="name" name="name" value="<?php echo $name; ?>" required>
    <br>
    <label for="email">Email:</label>
    <input type="email" id="email" name="email" value="<?php echo $email; ?>" required>
    <br>
    <input type="hidden" name="action" value="update_profile">
    <button type="submit">Update Profile</button>
</form>
<h2>Change Password</h2>
<form method="post" action="profile.php">
    <label for="password">New Password:</label>
    <input type="password" id="password" name="password" required>
    <br>
    <input type="hidden" name="action" value="change_password">
    <button type="submit">Change Password</button>
</form>
</body>
</html>
