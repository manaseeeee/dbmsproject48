<?php
session_start();
if(isset($_SESSION['username'])) {
    header("Location: home.php");
    exit;
}
include 'db.php';

if(isset($_POST['login'])) {
    $username = $_POST['username'];
    $password = $_POST['password'];
    
    $sql = "SELECT * FROM users WHERE username='$username' AND password='$password'";
    $result = $conn->query($sql);
    
    if($result->num_rows > 0) {
        $_SESSION['username'] = $username;
        header("Location: home.php");
        exit;
    } else {
        echo "Invalid username or password";
    }
}

if(isset($_POST['signup'])) {
    $username = $_POST['username'];
    $password = $_POST['password'];
    
    $sql = "INSERT INTO users (username, password) VALUES ('$username', '$password')";
    if ($conn->query($sql) === TRUE) {
        echo "Signup successful!";
    } else {
        echo "Something went wrong";
    }
}
?>
<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Contact Management System</title>
    <style>
        body {
            font-family: Arial, sans-serif;
            margin: 0;
            padding: 0;
            background-color: #f5f5f5;
            color: #333;
        }

        .navbar {
            background-color: #333;
            overflow: hidden;
        }

        .navbar a {
            float: left;
            display: block;
            color: #f2f2f2;
            text-align: center;
            padding: 14px 20px;
            text-decoration: none;
        }

        .navbar a:hover {
            background-color: #ddd;
            color: black;
        }

        .container {
            max-width: 800px;
            margin: 0 auto;
            padding: 20px;
            background-color: #fff;
            box-shadow: 0 4px 8px rgba(0,0,0,0.1);
            border-radius: 8px;
            margin-top: 40px;
        }

        h1, h2 {
            text-align: center;
        }
        p{
            text-align: center;
        }
    </style>
</head>
<body>

    <div class="navbar">
        <a href="index.php">Home</a>
        <a href="login.php">Login</a>
        <a href="signup.php">Sign Up</a>
    </div>

    <div class="container">
        <h1>Welcome to the Contact Management System</h1>
        <p>This system helps you to add, delete, and update your contacts .</p>
    
    </div>
</body>
</html>
