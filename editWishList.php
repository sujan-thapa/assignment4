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
    $item = $_POST['item'];

    if ($_POST['action'] == 'add') {
        $stmt = $conn->prepare("INSERT INTO wish_list (user_id, item) VALUES (?, ?)");
        $stmt->bind_param("is", $user_id, $item);
    } elseif ($_POST['action'] == 'update') {
        $item_id = $_POST['item_id'];
        $stmt = $conn->prepare("UPDATE wish_list SET item = ? WHERE id = ? AND user_id = ?");
        $stmt->bind_param("sii", $item, $item_id, $user_id);
    } elseif ($_POST['action'] == 'delete') {
        $item_id = $_POST['item_id'];
        $stmt = $conn->prepare("DELETE FROM wish_list WHERE id = ? AND user_id = ?");
        $stmt->bind_param("ii", $item_id, $user_id);
    }

    $stmt->execute();
    $stmt->close();
}

$items = $conn->query("SELECT id, item FROM wish_list WHERE user_id = $user_id");
$conn->close();
?>
<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <title>Edit Wish List</title>
</head>
<body>
<h1>Edit Wish List</h1>
<form method="post" action="editWishList.php">
    <input type="hidden" name="action" value="add">
    <input type="text" name="item" required>
    <button type="submit">Add Item</button>
</form>
<ul>
    <?php while ($row = $items->fetch_assoc()): ?>
        <li>
            <form method="post" action="editWishList.php" style="display:inline;">
                <input type="hidden" name="item_id" value="<?php echo $row['id']; ?>">
                <input type="text" name="item" value="<?php echo $row['item']; ?>">
                <input type="hidden" name="action" value="update">
                <button type="submit">Update</button>
            </form>
            <form method="post" action="editWishList.php" style="display:inline;">
                <input type="hidden" name="item_id" value="<?php echo $row['id']; ?>">
                <input type="hidden" name="action" value="delete">
                <button type="submit">Delete</button>
            </form>
        </li>
    <?php endwhile; ?>
</ul>
</body>
</html>
