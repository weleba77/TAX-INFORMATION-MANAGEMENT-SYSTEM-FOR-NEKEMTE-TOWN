<?php
session_start();
if (!isset($_SESSION['user_id'])) {
    header("Location: ../login.php");
    exit();
}

include '../connection/connection.php';

$income_id = isset($_GET['income_id']) ? $_GET['income_id'] : null;

if (!$income_id) {
    echo "Invalid request.";
    exit();
}

// Check if the receipt has been approved by both interviewer and admin
$check_approval_query = "SELECT interviewer_approved, admin_approved FROM receipt_approval WHERE income_id = ?";
$check_stmt = $conn->prepare($check_approval_query);
$check_stmt->bind_param("i", $income_id);
$check_stmt->execute();
$check_stmt->bind_result($interviewer_approved, $admin_approved);
$check_stmt->fetch();
$check_stmt->close();

if ($interviewer_approved !== 1 || $admin_approved !== 1) {
    echo "Receipt has not been fully approved.";
    exit();
}

// Fetch income details
$query = "SELECT income.id, income.income_amount, income.income_source, users.first_name, users.last_name 
          FROM income 
          JOIN users ON income.user_id = users.id 
          WHERE income.id = ?";
$stmt = $conn->prepare($query);
$stmt->bind_param("i", $income_id);
$stmt->execute();
$result = $stmt->get_result();

if ($result->num_rows === 0) {
    echo "No income details found.";
    exit();
}

$row = $result->fetch_assoc();
?>

<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Generate Receipt</title>
    <link rel="stylesheet" href="../css/bootstrap.min.css">
    <style>
        .receipt {
            border: 1px solid #ccc;
            padding: 20px;
            margin: 20px 0;
        }
    </style>
</head>
<body>
<main>
    <div class="container my-5">
        <div class="receipt">
            <h2>Receipt</h2>
            <p><strong>Name:</strong> <?php echo htmlspecialchars($row['first_name'] . ' ' . $row['last_name']); ?></p>
            <p><strong>Income Source:</strong> <?php echo htmlspecialchars($row['income_source']); ?></p>
            <p><strong>Income Amount:</strong> <?php echo htmlspecialchars($row['income_amount']); ?></p>
            <p><strong>Tax Amount:</strong> <?php echo htmlspecialchars(calculateTax($row['income_amount'])); ?></p>
            <p><strong>Receipt ID:</strong> <?php echo htmlspecialchars($row['id']); ?></p>
            <button onclick="window.print()" class="btn btn-primary">Print Receipt</button>
        </div>
    </div>
</main>
<script src="../js/bootstrap.bundle.min.js"></script>
</body>
</html>

<?php
function calculateTax($income_amount) {
    // Add your tax calculation logic here
    // For demonstration, let's assume a flat 10% tax rate
    return $income_amount * 0.1;
}
?>
