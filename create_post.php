

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
    $title = $_POST["title"];
    $content = $_POST["content"];
    $image = $_FILES["image"]["name"]; // Get the file name

    // Upload image to server
    $target_dir = "uploads/";
    $target_file = $target_dir . basename($_FILES["image"]["name"]);
    move_uploaded_file($_FILES["image"]["tmp_name"], $target_file);

    $stmt = $conn->prepare("INSERT INTO posts (title, content, user_id,image) VALUES (?, ?, 1,?)");
    $stmt->bind_param("sss", $title, $content, $image);
    
    if ($stmt->execute()) {
        header("Location: index.php");
    } else {
        echo "Error: " . $stmt->error;
    }

    $stmt->close();
}


$conn->close();
?>

<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <title>Create Post</title>
    <link rel="stylesheet" href="styles.css">
</head>
<body>
<h1>Create New Post</h1>
    <form method="post" action="create_post.php" enctype="multipart/form-data">
        <label for="title">Title:</label><br>
        <input type="text" id="title" name="title" required><br>

        <label for="image">Image:</label><br>
        <input type="file" id="image" name="image"><br>

        <label for="content">Content:</label><br>
        <textarea id="content" name="content" required></textarea><br>
        <input type="submit" value="Submit">
    </form>
    <a href="blogs.php">Back to Blog</a>
</body>
</body>
</html>
