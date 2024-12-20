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
    $title = $_POST["title"];
    $content = $_POST["content"];
    $image = $_FILES["image"]["name"];

    if (!empty($image)) {
        // Upload image to server
        $target_dir = "uploads/";
        $target_file = $target_dir . basename($_FILES["image"]["name"]);
        move_uploaded_file($_FILES["image"]["tmp_name"], $target_file);

        $stmt = $conn->prepare("UPDATE posts SET title=?, content=?, image=? WHERE id=?");
        $stmt->bind_param("sssi", $title, $content, $image, $id);
    } else {
        $stmt = $conn->prepare("UPDATE posts SET title=?, content=? WHERE id=?");
        $stmt->bind_param("ssi", $title, $content, $id);
    }

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
    <title>Edit Post</title>
    <link rel="stylesheet" href="styles.css">
</head>
<body>
    <h1>Edit Post</h1>
    <form method="post" action="edit_post.php" enctype="multipart/form-data">
        <input type="hidden" name="id" value="<?php echo $post['id']; ?>">
        <label for="title">Title:</label><br>
        <input type="text" id="title" name="title" value="<?php echo $post['title']; ?>" required><br>

        <label for="image">Image:</label><br>
        <input type="file" id="image" name="image"><br>
        <img src="uploads/<?php echo $post['image']; ?>" alt="Current Image"><br>

        <label for="content">Content:</label><br>
        <textarea id="content" name="content" required><?php echo $post['content']; ?></textarea><br>
        <input type="submit" value="Update">
    </form>
    <a href="index.php">Back to Blog</a>
</body>
</html>
