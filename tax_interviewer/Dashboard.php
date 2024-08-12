<?php
session_start();
if (!isset($_SESSION['user_id'])) {
    header("Location: ../login.php");
    exit();
}

$user_id = $_SESSION['user_id'];
$username = $_SESSION['username'];
$role = 'interviewer';

include '../connection/connection.php'; // Adjust the path as necessary
include 'header.php';



$interviewer_id = $_SESSION['user_id'];

// Fetch the number of taxpayers assigned to the interviewer
$query = "SELECT COUNT(*) AS taxpayer_count FROM income WHERE interviewer_id = ?";
$stmt = $conn->prepare($query);
$stmt->bind_param('i', $interviewer_id);
$stmt->execute();
$result = $stmt->get_result();
$row = $result->fetch_assoc();
$taxpayer_count = $row['taxpayer_count'];

// Fetch details of taxpayers assigned to the interviewer
$query = "SELECT user_id,income_source, tax_amount,interviewer_approved FROM income WHERE interviewer_id = ?";
$stmt = $conn->prepare($query);
$stmt->bind_param('i', $interviewer_id);
$stmt->execute();
$taxpayer_result = $stmt->get_result();

?>

<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Interviewer Dashboard</title>
    <link rel="stylesheet" href="../css/bootstrap.min.css">
    <style>
        footer {
            margin: 25px 0 0;
            bottom: 0;
            width: 100%;
            background-color: #343a40;
            color: #fff;
            padding: 20px 0;
            text-align: center;
        }
    </style>
</head>
<body>
 
    <div class="container my-5">
        <h1>Welcome, <?php echo htmlspecialchars($_SESSION['username']); ?></h1>
        <div class="card mb-4">
            <div class="card-body">
                <h5 class="card-title">Number of Taxpayers Assigned: <?php echo $taxpayer_count; ?></h5>
            </div>
        </div>
        <h2>Taxpayer Details</h2>
        <table class="table table-bordered">
            <thead>
                <tr>
                    <th>Taxpayer ID</th>
                    <th>Income Source</th>
                    <th>Tax Amount</th>
                    <th>approval</th>
                </tr>
            </thead>
            <tbody>
                <?php while ($taxpayer = $taxpayer_result->fetch_assoc()): ?>
                    <tr>
                        <td><?php echo htmlspecialchars($taxpayer['user_id']); ?></td>

                        <td><?php echo htmlspecialchars($taxpayer['income_source']); ?></td>
                        <td><?php echo htmlspecialchars($taxpayer['tax_amount']); ?></td>
                        <td><?php echo htmlspecialchars($taxpayer['interviewer_approved']); ?></td>
                    </tr>
                <?php endwhile; ?>
            </tbody>
        </table>
        <form method="post" action="export.php">
            <button type="submit" class="btn btn-success">Export to CSV</button>
        </form>
    </div>



    <script src="../css/js/bootstrap.min.js"></script>
    <div class="footer">
    <?php include '../connection/footer.php'; ?>
    </div>

</body>
</html>


