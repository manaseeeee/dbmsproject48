<?php
session_start();
if(!isset($_SESSION['username'])) {
    header("Location: index.php");
    exit;
}
include 'db.php';

$username = $_SESSION['username'];

if(isset($_POST['delete'])) {
    $sql = "DELETE FROM users WHERE username='$username'";
    if ($conn->query($sql) === TRUE) {
        session_destroy();
        header("Location: index.php");
        exit;
    } else {
        echo "Error deleting record: " . $conn->error;
    }
}
?>
<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Delete Account</title>
    <style>
        body {
            font-family: Arial, sans-serif;
            background-color: #f5f5f5;
            margin: 0;
            padding: 0;
            display: flex;
            justify-content: center;
            align-items: center;
            height: 100vh;
        }
        .container {
            text-align: center;
            background-color: #ffffff;
            padding: 30px;
            border-radius: 8px;
            box-shadow: 0 2px 4px rgba(0, 0, 0, 0.1);
            width: 300px;
        }
        h2 {
            color: #333333;
        }
        p {
            color: #666666;
        }
        form {
            margin-top: 20px;
        }
        input[type="submit"] {
            background-color: #ff4d4f;
            color: #ffffff;
            border: none;
            padding: 10px 20px;
            font-size: 16px;
            border-radius: 4px;
            cursor: pointer;
            transition: background-color 0.3s ease;
        }
        input[type="submit"]:hover {
            background-color: #f5222d;
        }
    </style>
</head>
<body>
    <div class="container">
        <h2>Delete Account</h2>
        <p>Are you sure you want to delete your account?</p>
        <form method="post">
            <input type="submit" name="delete" value="Delete">
        </form>
    </div>
</body>
</html>
