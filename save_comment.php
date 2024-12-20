<?php
session_start();

if ($_SERVER["REQUEST_METHOD"] == "POST") {
    // Get form data
    $name = $_POST["name"];
    $email = $_POST["email"];
    $comment = $_POST["comment"];
     // Assuming you have a hidden input field in the form for post_id

    // Save comment to the database (you'll need to adjust this based on your database structure)
    $servername = "127.0.0.1";
    $username = "root";
    $password = "";
    $dbname = "blog_db";

    $conn = new mysqli($servername, $username, $password, $dbname);

    if ($conn->connect_error) {
        die("Connection failed: " . $conn->connect_error);
    }

    $stmt = $conn->prepare("INSERT INTO comments (name,  comment) VALUES (?, ?)");
    $stmt->bind_param("sssi", $name, $comment);

    if ($stmt->execute()) {
        // Display the comments for this post
        $sql_comments = "SELECT * FROM comments WHERE post_id = 1" ;
        $result_comments = $conn->query($sql_comments);

        echo "<h2>Comments</h2>";
        if ($result_comments->num_rows > 0) {
            while($row_comment = $result_comments->fetch_assoc()) {
                echo "<p><strong>" . $row_comment["name"] . ":</strong> " . $row_comment["comment"] . "</p>";
            }
        } else {
            echo "<p>No comments yet.</p>";
        }

        echo "<a href='index.php'>Go back to blog post</a>";
    } else {
        echo "Error: " . $stmt->error;
    }

    $stmt->close();
    $conn->close();
} else {
    // Handle invalid request method
    echo "Invalid request method.";
}
?>
