<?php
session_start();

include '../connection/connection.php';
$user_id = $_SESSION['user_id'];
$income_amount = $_POST['income_amount'];
$income_source = $_POST['income_source'];

$sql = "INSERT INTO income (user_id, income_amount, income_source) VALUES (?, ?, ?)";
$stmt = $conn->prepare($sql);
$stmt->bind_param("ids", $user_id, $income_amount, $income_source);
$stmt->execute();
header("Location: dashboard.php");
?>
