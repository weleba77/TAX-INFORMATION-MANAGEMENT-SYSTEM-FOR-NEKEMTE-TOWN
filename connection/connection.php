<?php
// Establish a database connection
$servername = "localhost";
$usernamedb = "root";
$password = "";
$dbname = "tax_nekemte";

$conn = new mysqli($servername, $usernamedb, $password, $dbname);

if ($conn->connect_error) {
    die("Connection failed: " . $conn->connect_error);
}
?>