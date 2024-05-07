<?php
session_start();
if(!isset($_SESSION['username'])) {
    header("Location: index.php");
    exit;
}
include 'db.php';

$username = $_SESSION['username'];

if(isset($_POST['update'])) {
    $newUsername = $_POST['new_username'];
    $newPassword = $_POST['new_password'];
    
    $sql = "UPDATE users SET username='$newUsername', password='$newPassword' WHERE username='$username'";
    if ($conn->query($sql) === TRUE) {
        $_SESSION['username'] = $newUsername;
        header("Location: home.php");
        exit;
    } else {
        echo "Error updating record: " . $conn->error;
    }
}
?>
<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Update Account</title>
    <style>
        body {
            font-family: Arial, sans-serif;
            background-color: #f4f4f4;
            margin: 0;
            padding: 20px;
            box-sizing: border-box;
        }
        h2 {
            color: #333;
        }
        form {
            max-width: 400px;
            background-color: #fff;
            padding: 20px;
            border-radius: 8px;
            box-shadow: 0 2px 5px rgba(0, 0, 0, 0.1);
        }
        input[type="text"],
        input[type="password"] {
            width: 100%;
            padding: 10px;
            margin-bottom: 15px;
            border: 1px solid #ccc;
            border-radius: 4px;
            box-sizing: border-box;
        }
        input[type="submit"] {
            background-color: #007bff;
            color: #fff;
            padding: 12px 20px;
            border: none;
            border-radius: 4px;
            cursor: pointer;
            font-size: 16px;
        }
        input[type="submit"]:hover {
            background-color: #0056b3;
        }
    </style>
</head>
<body>
    <h2>Update Account</h2>
    <form method="post">
        <label for="new_username">New Username:</label>
        <input type="text" id="new_username" name="new_username" required><br>
        <label for="new_password">New Password:</label>
        <input type="password" id="new_password" name="new_password" required><br>
        <input type="submit" name="update" value="Update">
    </form>
</body>
</html>
