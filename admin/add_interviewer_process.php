<?php
session_start();
if (!isset($_SESSION['user_id']) ) {
    header("Location: ../login.php");
    exit();
}
$user_id = $_SESSION['user_id'];
$username = $_SESSION['username'];
$role = 'admin';
// Include the connection file
include '../connection/connection.php';

// Check if the form is submitted
if ($_SERVER["REQUEST_METHOD"] == "POST") {
    // Get the submitted values
    $firstName = $_POST["firstName"];
    $lastName = $_POST["lastName"];
    $username = $_POST["username"];
    $interviewerEmail = $_POST["interviewerEmail"];
    $interviewerPassword = $_POST["interviewerPassword"];

    // Check the connection
    if ($conn->connect_error) {
        die("Connection failed: " . $conn->connect_error);
    }

    // Hash the password
    $hashedPassword = password_hash($interviewerPassword, PASSWORD_DEFAULT);

    // Prepare the SQL query to insert the interviewer data into the database
    $query = "INSERT INTO interviewers (first_name, last_name, username, email, password) VALUES (?, ?, ?, ?, ?)";

    // Prepare the statement
    $stmt = $conn->prepare($query);

    if ($stmt) {
        // Bind the parameters
        $stmt->bind_param("sssss", $firstName, $lastName, $username, $interviewerEmail, $hashedPassword);

        // Execute the statement
        if ($stmt->execute()) {
            // Interviewer added successfully
            header("Location: Add_Interviewer.php");
            echo "<script>alert('Interviewer added successfully!');</script>";
        } else {
            // Error in executing the statement
            header("Location: Add_Interviewer.php");
            echo "<script>alert('Error adding interviewer!');</script>";
        }

        // Close the statement
        $stmt->close();
    } else {
        // Error in preparing the statement
        header("Location: Add_Interviewer.php");
        echo "<script>alert('Error in preparing statement!');</script>";
    }

    // Close the database connection
    $conn->close();
}
?>
