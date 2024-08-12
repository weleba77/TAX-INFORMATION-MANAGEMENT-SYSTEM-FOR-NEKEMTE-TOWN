<?php
include '../connection/connection.php';

// Retrieve receipts from the database
$receipts = mysqli_query($conn, "SELECT * FROM receipts");

// Close the connection
mysqli_close($conn);
?>