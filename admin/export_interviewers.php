<?php
session_start();
if (!isset($_SESSION['user_id'])) {
    header("Location: ../login.php");
    exit();
}

include '../connection/connection.php'; // Adjust the path as necessary

header('Content-Type: text/csv; charset=utf-8');
header('Content-Disposition: attachment; filename=interviewers.csv');

$output = fopen('php://output', 'w');
fputcsv($output, array('ID', 'first name','last Name', 'Email'));

$query = "SELECT id, first_name,last_name, email, enabled FROM interviewers";
$result = $conn->query($query);

while ($row = $result->fetch_assoc()) {
    fputcsv($output, $row);
}

fclose($output);
$conn->close();
exit();
?>
