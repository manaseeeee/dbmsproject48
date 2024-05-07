<?php
$servername = "localhost";
$username = "root";
$password = "";
$dbname = "contact_manager_db";

$conn = new mysqli($servername, $username, $password, $dbname);

if ($conn->connect_error) {
    die("Connection nahi: " . $conn->connect_error);
}
?>
