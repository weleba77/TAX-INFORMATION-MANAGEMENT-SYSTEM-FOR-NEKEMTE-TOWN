<?php
session_start();
if (!isset($_SESSION['user_id']) ) {
    header("Location: ../login.php");
    exit();
}
$user_id = $_SESSION['user_id'];
$username = $_SESSION['username'];
$role = 'admin';
include '../connection/connection.php';

 if ($_SESSION['role'] == 'interviewer' || $_SESSION['role'] == 'admin') {
    $submission_id = $_POST['submission_id'];

    if ($_SESSION['role'] == 'interviewer') {
        $sql = "UPDATE income SET interviewer_approved = 1 WHERE id = ?";
    } else {
        $sql = "UPDATE income SET admin_approved = 1 WHERE id = ?";
    }

    $stmt = $conn->prepare($sql);
    $stmt->bind_param("i", $submission_id);
    $stmt->execute();

    header("Location: approve _income.php");
} else {
    die("Unauthorized access");
}
?>
