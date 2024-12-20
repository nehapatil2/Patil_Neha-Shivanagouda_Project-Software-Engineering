<?php
session_start();
if (!isset($_SESSION["user_id"])) {
    
    
}
?>


<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <title>Blog</title>
    <link rel="stylesheet" href="styles.css">
    <style>
        body {
            font-family: Arial, sans-serif;
        }
        .header {
            text-align: center;
            display: flex;
            justify-content: space-between;
            align-items: center;
            padding: 10px 20px;
            background-color: #333;
            color: white;
        }
        .user-info {
            display: flex;
            align-items: center;
        }
        .button {
            background-color: #007bff;
            color: white;
            padding: 10px 15px;
            text-decoration: none;
            border-radius: 5px;
        }
        .logout-button {
            background-color: #dc3545;
            margin-left: 10px;
        }
        .content {
            display: flex;
            flex-wrap: wrap;
            gap: 20px;
            padding: 20px;
        }
        .post {
            flex: 1 1 calc(33.333% - 40px);
            box-sizing: border-box;
            padding: 20px;
            background-color: #fff;
            box-shadow: 0 0 10px rgba(0,0,0,0.1);
            border-radius: 5px;
        }
        .post img {
            max-width: 100%;
            height: auto;
        }
        .post h2 {
            margin-top: 0;
        }
        .action-buttons {
            margin-top: 10px;
        }
        .action-buttons a {
            margin-right: 10px;
            text-decoration: none;
            color: white;
            padding: 5px 10px;
            border-radius: 3px;
        }
        .edit-button {
            background-color: #ffc107;
        }
        .delete-button {
            background-color: #dc3545;
        }
        .comments-button {
            background-color: #17a2b8;
        }
        h1 {
            text-align: center;
            margin: 0;
        }
    </style>
</head>
<body>
    <div class="header">
        <h1>Blog Posts</h1>
        <div class="">
            <?php
            if (isset($_SESSION["username"])) {
                echo "<h2>Logged in as</h2> " . $_SESSION["username"];
                echo "<a href='logout.php' class='button logout-button'>Logout</a>";
            }
            ?>
        </div>
        <a href="create_post.php" class="button">Add Blog</a>
    </div>
    <div class="content">
        <?php
        $servername = "127.0.0.1";
        $username = "root";
        $password = "";
        $dbname = "blog_db";

        $conn = new mysqli($servername, $username, $password, $dbname);

        if ($conn->connect_error) {
            die("Connection failed: " . $conn->connect_error);
        }

        $sql = "SELECT posts.id, posts.title, posts.content, posts.image, users.username 
                FROM posts 
                JOIN users ON posts.user_id = users.id 
                ORDER BY posts.created_at DESC";
        $result = $conn->query($sql);

        if ($result->num_rows > 0) {
            while($row = $result->fetch_assoc()) {
                echo "<div class='post'>";
                echo "<h2>" . $row["title"] . "</h2>";
                if (!empty($row["image"])) {
                    echo "<img src='uploads/" . $row["image"] . "' alt='Post Image'>";
                }
                echo "<p>" . $row["content"] . "</p>";
                echo "<p>Posted by: " . $row["username"] . "</p>";
                echo "<div class='action-buttons'>";
                echo "<a href='edit_post.php?id=" . $row["id"] . "' class='edit-button'>Edit</a>";
                echo "<a href='delete_post.php?id=" . $row["id"] . "' class='delete-button' onclick='return confirm(\"Are you sure?\")'>Delete</a>";
               
                echo "</div>";
                echo "</div>";
            }
        } else {
            echo "<p>No posts available.</p>";
        }

        $conn->close();
        ?>
        <!-- Display blog post here -->


<h3>Add Comment:</h3>
<form method="post" action="add_comment.php">
    <input type="hidden" name="post_id" value="<?php echo $post_id; ?>">
    <label for="username">Name:</label><br>
    <input type="text" id="username" name="username" required><br>
    <label for="comment">Comment:</label><br>
    <textarea name="comment" id="comment" rows="4" required></textarea><br>
    <input type="submit" value="Submit">
</form>
</body>
</html>
