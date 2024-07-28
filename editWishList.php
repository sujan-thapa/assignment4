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
    <link href="https://maxcdn.bootstrapcdn.com/bootstrap/4.5.2/css/bootstrap.min.css" rel="stylesheet">
</head>
<body>
<div class="container mt-5">
    <h1 class="mb-4">Edit Wish List</h1>
    <form method="post" action="editWishList.php" class="form-inline mb-3">
        <input type="hidden" name="action" value="add">
        <div class="form-group mr-2">
            <input type="text" class="form-control" name="item" placeholder="Add new item" required>
        </div>
        <button type="submit" class="btn btn-primary">Add Item</button>
    </form>
    <ul class="list-group">
        <?php while ($row = $items->fetch_assoc()): ?>
            <li class="list-group-item d-flex align-items-center">
                <form method="post" action="editWishList.php" class="form-inline flex-grow-1 mr-2">
                    <input type="hidden" name="item_id" value="<?php echo $row['id']; ?>">
                    <div class="form-group mr-2 flex-grow-1">
                        <input type="text" class="form-control w-100" name="item" value="<?php echo $row['item']; ?>" required>
                    </div>
                    <input type="hidden" name="action" value="update">
                    <button type="submit" class="btn btn-success mr-2">Update</button>
                </form>
                <form method="post" action="editWishList.php">
                    <input type="hidden" name="item_id" value="<?php echo $row['id']; ?>">
                    <input type="hidden" name="action" value="delete">
                    <button type="submit" class="btn btn-danger">Delete</button>
                </form>
            </li>
        <?php endwhile; ?>
    </ul>
</div>

<script src="https://code.jquery.com/jquery-3.5.1.slim.min.js"></script>
<script src="https://cdn.jsdelivr.net/npm/@popperjs/core@2.5.4/dist/umd/popper.min.js"></script>
<script src="https://maxcdn.bootstrapcdn.com/bootstrap/4.5.2/js/bootstrap.min.js"></script>
</body>
</html>
