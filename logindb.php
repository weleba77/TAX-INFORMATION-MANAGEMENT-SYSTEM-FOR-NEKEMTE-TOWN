<?php
session_start();
// Include the connection file
include 'connection/connection.php';

// Include the functions file
include 'connection/functions.php';

// Check if the form is submitted
if ($_SERVER["REQUEST_METHOD"] == "POST") {
    // Get the submitted values
    $loginType = $_POST["login_type"];
    $username = $_POST["username"];
    $password = $_POST["password"];

    // Check the connection
    if ($conn->connect_error) {
        die("Connection failed: " . $conn->connect_error);
    }

    // Switch statement for different login types
    switch ($loginType) {
        case "admin":
            $query = "SELECT * FROM admin WHERE username = ?";
            $user = prepareAndExecute($conn, $query, $username, $password);
            if ($user) {
                $_SESSION['user_id'] = $user['id'];
                $_SESSION['username'] = $user['username'];
                $_SESSION['role'] = 'admin';
                header("Location: admin/admin.php");
                exit;
            } else {
                echo "<script>alert('Invalid credentials!');</script>";
                header("Location: login.php");
            }
            break;
        case "taxpayer":
            $query = "SELECT * FROM users WHERE username = ?";
            $user = prepareAndExecute($conn, $query, $username, $password);
            if ($user) {
                $_SESSION['user_id'] = $user['id'];
                $_SESSION['username'] = $user['username'];
                $_SESSION['role'] = $user['role'];
                header("Location: taxpayer/dashboard.php");
                exit;
            } else {
                echo "<script>alert('Invalid credentials!');</script>";
                header("Location: login.php");
            }
            break;
        case "interviewer":
            $query = "SELECT * FROM interviewers WHERE username = ?";
            $user = prepareAndExecute($conn, $query, $username, $password);
            if ($user) {
                $_SESSION['user_id'] = $user['id'];
                $_SESSION['username'] = $user['username'];
                $_SESSION['role'] = 'interviewer';
                header("Location: tax_interviewer/Dashboard.php");
                exit;
            } else {
                echo "<script>alert('Invalid credentials!');</script>";
               

            }
            break;
        default:
            echo "<script>alert('Invalid login type!');</script>";
            header("Location: login.php");
            break;
    }
}
?>
