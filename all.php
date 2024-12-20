<?php
session_start();
?>

<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <title>Blog</title>
    <style>
        body {
            font-family: Arial, sans-serif;
            margin: 0;
            padding: 0;
            background-color: #f4f4f4;
        }
        .header {
            background-color: #333;
            color: #fff;
            padding: 10px 20px;
            display: flex;
            justify-content: space-between;
            align-items: center;
        }
        .header h1 {
            margin: 0;
        }
        .user-info {
            display: flex;
            align-items: center;
        }
        .user-info a {
            color: #fff;
            text-decoration: none;
            margin-left: 10px;
        }
        .content {
            padding: 20px;
        }
        .post {
            background-color: #fff;
            margin-bottom: 20px;
            padding: 20px;
            border-radius: 5px;
            box-shadow: 0 0 10px rgba(0, 0, 0, 0.1);
        }
        .post img {
            max-width: 100%;
            height: auto;
            display: block;
            margin: 0 auto 20px;
        }
        .post h2 {
            margin-top: 0;
        }
        .button {
            background-color: #007BFF;
            color: #fff;
            padding: 10px 20px;
            text-decoration: none;
            border-radius: 5px;
            display: inline-block;
        }
        .button:hover {
            background-color: #0056b3;
        }
        .logout-button {
            background-color: #FF5733;
        }
    </style>
</head>
<body>
    <div class="header">
        <h1>Blog Posts</h1>
        <div class="user-info">
            <?php
            if (isset($_SESSION["username"])) {
                echo "Logged in as " . $_SESSION["username"];
                echo "<a href='logout.php' class='button logout-button'>Logout</a>";
            } else {
                echo "<a href='login.php' class='button'>Login</a>";
                echo "<a href='register.php' class='button'>Register</a>";
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
                echo "</div>";
            }
        } else {
            echo "<p>No posts available.</p>";
        }

        $conn->close();
        ?>
    </div>
</body>
</html>
