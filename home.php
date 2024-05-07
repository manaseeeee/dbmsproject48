<?php
session_start();
if (!isset($_SESSION['username'])) {
    header("Location: index.php");
    exit;
}
include 'db.php';

$username = $_SESSION['username'];

$UID = "SELECT id FROM users WHERE username='$username'";
$resUID = $conn->query($UID);

if ($resUID->num_rows > 0) {
    $rowUID = $resUID->fetch_assoc();
    $user_id = $rowUID['id'];

    $cnt = "SELECT COUNT(*) AS total_contacts FROM contacts WHERE user_id='$user_id'";
    $resultCnt = $conn->query($cnt);
    $totCon = $resultCnt->fetch_assoc()['total_contacts'];

    if (isset($_GET['search'])) {
        $item = $_GET['search'];
        $sql = "SELECT * FROM contacts WHERE user_id='$user_id' AND (name LIKE '%$item%' OR email LIKE '%$item%' OR phone LIKE '%$item%' OR address LIKE '%$item%')";
    } else {
        $sql = "SELECT * FROM contacts WHERE user_id='$user_id'";
    }

    $result = $conn->query($sql);
}
?>

<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Contact Manager</title>
    <style>
        body {
            font-family: Arial, sans-serif;
            padding: 20px;
        }
        h2 {
            color: #333;
        }
        table {
            width: 100%;
            border-collapse: collapse;
            margin-top: 20px;
        }
        th, td {
            padding: 10px;
            text-align: left;
            border-bottom: 1px solid #ddd;
        }
        th {
            background-color: #f2f2f2;
            color: #333;
        }
        tr:hover {
            background-color: #f9f9f9;
        }
        .action-links a {
            text-decoration: none;
            margin-right: 10px;
            padding: 5px 10px;
            border: 1px solid #ccc;
            border-radius: 3px;
            color: #333;
            background-color: #f2f2f2;
        }
        .action-links a:hover {
            background-color: #e0e0e0;
        }
        .add-btn {
            display: inline-block;
            padding: 8px 16px;
            background-color: #007bff;
            color: #fff;
            border: none;
            border-radius: 4px;
            cursor: pointer;
            text-decoration: none;
        }
        .add-btn:hover {
            background-color: #0056b3;
        }
    </style>
</head>
<body>
    <h2>Welcome, <?php echo htmlspecialchars($username); ?>!</h2>
    <a href="add_contact.php" class="add-btn">Add Contact</a><br><br>

    <form action="" method="GET">
        <label for="search">Search:</label>
        <input type="text" id="search" name="search" placeholder="Enter desired data">
        <button type="submit" class="add-btn">Search</button>
    </form>

    <h3>Your Contacts (Total: <?php echo $totCon; ?>)</h3>
    <table>
        <thead>
            <tr>
                <th>Name</th>
                <th>Email</th>
                <th>Phone</th>
                <th>Address</th>
                <th>Action</th>
            </tr>
        </thead>
        <tbody>
            <?php
            if ($result->num_rows > 0) {
                while ($row = $result->fetch_assoc()) {
                    echo "<tr>";
                    echo "<td>".$row['name']."</td>";
                    echo "<td>".$row['email']."</td>";
                    echo "<td>".$row['phone']."</td>";
                    echo "<td>".$row['address']."</td>";
                    echo "<td class='action-links'>
                            <a href='edit_contact.php?id=".$row['id']."'>Edit</a>
                            <a href='delete_contact.php?id=".$row['id']."' onclick='return confirm(\"Are you sure you want to delete this contact?\");'>Delete</a>
                          </td>";
                    echo "</tr>";
                }
            } else {
                echo "<tr><td colspan='5'>No contacts found</td></tr>";
            }
            ?>
        </tbody>
    </table>
    <br>
    <a href="update_account.php" class="add-btn">Update Your Account</a><br>
    <br> </br>
    <a href="delete_account.php" class="add-btn" onclick="return confirm('Are you sure you want to delete your account?')">Delete Your Account</a><br>
    <br> </br>
    <a href="logout.php" class="add-btn">Logout</a>
</body>
</html>
