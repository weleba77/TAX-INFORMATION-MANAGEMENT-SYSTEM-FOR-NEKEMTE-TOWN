<?php
session_start();
include 'connection/header.php';
include '../connection/connection.php';


$taxpayer_id = $_POST['taxpayer_id'];
$interviewer_id = $_POST['interviewer_id'];

$sql = "UPDATE income SET interviewer_id = ? WHERE user_id = ? AND interviewer_approved = 0 AND admin_approved = 0";
$stmt = $conn->prepare($sql);
$stmt->bind_param("ii", $interviewer_id, $taxpayer_id);
$stmt->execute();
header("Location: assign_interviewer.php");
echo "<script>alert('TInterviewer assigned successfully!');</script>";

?>
