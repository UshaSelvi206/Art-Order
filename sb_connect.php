<?php
$servername = "localhost";
$username = "root";
$password = "Lous@2006";
$dbname = "art_orders";

// Create connection
$conn = new mysqli($servername, $username, $password, $dbname);

// Check connection
if ($conn->connect_error) {
    die("Connection failed: " . $conn->connect_error);
}
?>
