<?php
session_start();
?>

<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <title>Home page</title>
    <style>
        body {
            font-family: Arial, sans-serif;
            margin: 0;
            padding: 0;
            background-color: #f1f1f1;
        }

        .header {
            background-color: #333;
            color: #fff;
            padding: 10px 20px;
            display: flex;
            justify-content: space-between;
            align-items: center;
        }

        .user-info {
            display: flex;
            align-items: center;
        }

        .user-info a {
            color: #fff;
            margin-left: 10px;
            text-decoration: none;
        }

        .content {
            padding: 20px;
            display: grid;
            grid-template-columns: repeat(3, 1fr);
            gap: 20px;
        }

        .post {
            background-color: #fff;
            padding: 20px;
            border-radius: 5px;
            box-shadow: 0 0 10px rgba(0,0,0,0.1);
        }

        .post img {
            max-width: 100%;
            height: auto;
            border-radius: 5px;
        }

        .button {
            background-color: #4CAF50;
            color: white;
            padding: 10px 20px;
            border: none;
            border-radius: 3px;
            cursor: pointer;
            text-decoration: none;
        }

        .button:hover {
            background-color: #45a049;
        }
        
    </style>
</head>
<body>
    <div class="header">
        <h1>Welcome to My Blogs</h1>
        <div class="user-info">
            <?php
            
           
                echo "<a href='login.php' class='button'>Login</a>";
                echo "<a href='register.php' class='button'>Register</a>";
            
            ?>
        </div>
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

        
            $sql = "SELECT * FROM comments";
            $result = $conn->query($sql);
        
            if ($result->num_rows > 0) {
                while($row = $result->fetch_assoc()) {
                    echo "<div class='comment'>";
                    echo "<p>" . $row["comment"] . "</p>";
                    echo "<p>Comment by: " . htmlspecialchars($row["username"]) . "</p>";
                    echo "</div>";
                }
            } else {
                echo "No comments yet.";
            }
           


        $conn->close();
        
       

    ?>


    </div>
</body>
</html>
