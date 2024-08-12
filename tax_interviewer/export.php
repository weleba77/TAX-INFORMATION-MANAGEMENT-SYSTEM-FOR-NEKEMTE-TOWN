<?php
session_start();
if (!isset($_SESSION['user_id'])) {
    header("Location: ../login.php");
    exit();
}

$interviewer_id = $_SESSION['user_id'];

include '../connection/connection.php'; // Adjust the path as necessary

// Fetch details of taxpayers assigned to the interviewer
$query = "SELECT user_id, income_source, tax_amount, interviewer_approved FROM income WHERE interviewer_id = ?";
$stmt = $conn->prepare($query);
$stmt->bind_param('i', $interviewer_id);
$stmt->execute();
$result = $stmt->get_result();

header('Content-Type: text/csv');
header('Content-Disposition: attachment;filename="taxpayer_details.csv"');

$output = fopen('php://output', 'w');
fputcsv($output, array('Taxpayer ID', 'Income Source', 'Tax Amount', 'Approval'));

while ($row = $result->fetch_assoc()) {
    fputcsv($output, $row);
}

fclose($output);
exit();
?>
