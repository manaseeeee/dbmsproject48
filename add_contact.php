<?php
session_start();
if(!isset($_SESSION['username'])) {
    header("Location: index.php");
    exit;
}
include 'db.php';

if(isset($_POST['submit'])) {
    $name = $_POST['name'];
    $email = $_POST['email'];
    $phone = $_POST['phone'];
    $address = $_POST['address'];
    
    $username = $_SESSION['username'];
    $UIDsql = "SELECT id FROM users WHERE username='$username'";
    $UIDres = $conn->query($UIDsql);
    $row = $UIDres->fetch_assoc();
    $user_id = $row['id'];
    
    $sql = "INSERT INTO contacts (user_id, name, email, phone, address) VALUES ('$user_id', '$name', '$email', '$phone', '$address')";
    if ($conn->query($sql) === TRUE) {
        header("Location: home.php");
        exit;
    } else {
        echo "Error: " . $sql . "<br>" . $conn->error;
    }
}
?>
<!DOCTYPE html>
<html>
<head>
    <title>Add Contact</title>
    <style>
        body {
            font-family: Arial, sans-serif;
            background-color: #f4f4f4;
            padding: 20px;
        }
        h2 {
            color: #333;
        }
        form {
            background-color: #fff;
            padding: 20px;
            border-radius: 5px;
            box-shadow: 0 2px 5px rgba(0, 0, 0, 0.1);
        }
        input[type="text"],
        input[type="email"],
        textarea {
            width: 100%;
            padding: 10px;
            margin-bottom: 15px;
            box-sizing: border-box;
            border: 1px solid #ccc;
            border-radius: 4px;
        }
        input[type="submit"] {
            background-color: #4CAF50;
            color: #fff;
            padding: 10px 20px;
            border: none;
            border-radius: 4px;
            cursor: pointer;
        }
        input[type="submit"]:hover {
            background-color: #45a049;
        }
    </style>
</head>
<body>
    <h2>Add Contact</h2>
    <form method="post">
        <label for="name">Name:</label>
        <input type="text" id="name" name="name" required><br>
        
        <label for="email">Email:</label>
        <input type="email" id="email" name="email"><br>
        
        <label for="phone">Phone:</label>
        <input type="text" id="phone" name="phone"><br>
        
        <label for="address">Address:</label><br>
        <textarea id="address" name="address" rows="4"></textarea><br>
        
        <input type="submit" name="submit" value="Add Contact">
    </form>
</body>
</html>

