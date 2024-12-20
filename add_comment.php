<?php
if ($_SERVER["REQUEST_METHOD"] == "POST") {
    $post_id = $_POST["post_id"];
    $username = $_POST["username"];
    $comment = $_POST["comment"];

    // Connect to the database
    $servername = "127.0.0.1";
    $username_db = "root";
    $password_db = "";
    $dbname = "blog_db";

    $conn = new mysqli($servername, $username_db, $password_db, $dbname);

    if ($conn->connect_error) {
        die("Connection failed: " . $conn->connect_error);
    }

    // Insert the comment into the database
    $stmt = $conn->prepare("INSERT INTO comments (post_id, username, comment) VALUES (?, ?, ?)");
    $stmt->bind_param("iss", $post_id, $username, $comment);

    if ($stmt->execute()) {
        header("Location: blogs.php"); // Redirect back to the post page
    } else {
        echo "Error: " . $stmt->error;
    }

    $stmt->close();
    $conn->close();
}
?>
