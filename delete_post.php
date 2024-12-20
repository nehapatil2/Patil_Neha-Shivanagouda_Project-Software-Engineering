<?php
$servername = "127.0.0.1";
$username = "root";
$password = "";
$dbname = "blog_db";

$conn = new mysqli($servername, $username, $password, $dbname);

if ($conn->connect_error) {
    die("Connection failed: " . $conn->connect_error);
}

if ($_SERVER["REQUEST_METHOD"] == "POST") {
    $id = $_POST["id"];

    $stmt = $conn->prepare("DELETE FROM posts WHERE id=?");
    $stmt->bind_param("i", $id);

    if ($stmt->execute()) {
        header("Location: index.php");
    } else {
        echo "Error: " . $stmt->error;
    }

    $stmt->close();
} else {
    $id = $_GET["id"];
    $result = $conn->query("SELECT * FROM posts WHERE id=$id");
    $post = $result->fetch_assoc();
}

$conn->close();
?>

<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <title>Delete Post</title>
    <link rel="stylesheet" href="styles.css">
</head>
<body>
    <h1>Delete Post</h1>
    <p>Are you sure you want to delete this post?</p>
    <form method="post" action="delete_post.php">
        <input type="hidden" name="id" value="<?php echo $post['id']; ?>">
        <p><?php echo $post['title']; ?></p>
        <p><?php echo $post['content']; ?></p>
        <input type="submit" value="Delete">
        <a href="index.php">Cancel</a>
    </form>
</body>
</html>
