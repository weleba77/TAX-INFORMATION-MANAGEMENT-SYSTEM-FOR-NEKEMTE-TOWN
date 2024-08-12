<?php
include '../connection/connection.php';
session_start();
if (!isset($_SESSION['interviewer_username'])) {
    header("Location: login_interviewer.php");
    exit();
}

$income_id = $_GET['id'];
$query = "UPDATE incomes SET status = 'rejected' WHERE id = ?";
$stmt = $conn->prepare($query);
$stmt->bind_param("i", $income_id);
$stmt->execute();

header("Location: interviewer_dashboard.php");
?>
