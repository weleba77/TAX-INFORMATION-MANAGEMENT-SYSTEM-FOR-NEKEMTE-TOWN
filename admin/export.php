<?php
session_start();
if (!isset($_SESSION['user_id']) ) {
    header("Location: ../login.php");
    exit();
}
$user_id = $_SESSION['user_id'];
$username = $_SESSION['username'];
$role = 'admin';
// Include database connection file
include '../connection/connection.php';

if ($conn->connect_error) {
    die("Connection failed: " . $conn->connect_error);
}

if ($_SERVER["REQUEST_METHOD"] == "POST" && isset($_POST['income_source'])) {
    $incomeSource = $_POST['income_source'];
    $sql = "SELECT * FROM users WHERE income_source = '$incomeSource'";
    $result = $conn->query($sql);

    if ($result->num_rows > 0) {
        // Define CSV file name and header
        $filename = "users.csv";
        $header = array("ID NO.","First Name", "Last Name", "Phone Number", "TIN", "Sex", "Income Source", "Email", "Place of Work", "User Name", "Photo Path");

        // Open file handle for writing
        $file = fopen('php://output', 'w');

        // Write CSV file header
        fputcsv($file, $header);

        // Write CSV file rows
        while ($row = $result->fetch_assoc()) {
            fputcsv($file, array($row['id'],$row['first_name'], $row['last_name'], $row['phone_number'], $row['tin'], $row['sex'], $row['income_source'], $row['email'], $row['place_of_work'], $row['username'], $row['photo_path']));
        }

        // Close file handle
        fclose($file);

        // Set headers to force download
        header('Content-Type: text/csv');
        header('Content-Disposition: attachment; filename="' . $filename . '"');
        exit();
    } else {
        // No records found for the selected income source
        echo "No users found for $incomeSource";
    }
} else {
    // Income source not set or form not submitted
    echo "Error: Income source not set or form not submitted.";
}

// Close database connection
$conn->close();
?>
