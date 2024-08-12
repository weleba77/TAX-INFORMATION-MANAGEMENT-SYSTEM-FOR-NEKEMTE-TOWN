<?php
session_start();
if (!isset($_SESSION['user_id']) || $_SESSION['role'] !== 'interviewer') {
    header("Location: ../login.php");
    exit();
}

$interviewer_id = $_SESSION['user_id'];
include '../connection/connection.php';

$query = "SELECT income.*, receipt_approval.id as approval_id, receipt_approval.interviewer_approved
          FROM income 
          JOIN receipt_approval ON income.id = receipt_approval.income_id
          WHERE receipt_image IS NOT NULL AND receipt_approval.interviewer_approved = 0 AND receipt_approval.interviewer_id = ?";
$stmt = $conn->prepare($query);
$stmt->bind_param("i", $interviewer_id);
$stmt->execute();
$result = $stmt->get_result();
?>

<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <title>Approve Receipts</title>
    <link rel="stylesheet" href="https://maxcdn.bootstrapcdn.com/bootstrap/4.5.2/css/bootstrap.min.css">
</head>
<body>
<div class="container">
    <h2>Approve Receipts</h2>
    <?php while ($row = $result->fetch_assoc()) { ?>
        <div class="card mb-3">
            <div class="card-body">
                <h5 class="card-title">Receipt ID: <?php echo $row['id']; ?></h5>
                <p class="card-text">Income Amount: <?php echo $row['income_amount']; ?></p>
                <p class="card-text">Tax Amount: <?php echo $row['tax_amount']; ?></p>
                <p class="card-text">
                    <img src="../taxpayer<?php echo $row['receipt_image']; ?>" alt="Receipt Image" style="max-width: 300px;">
                </p>
                <form action="approve_receipt.php" method="post" style="display:inline;">
                    <input type="hidden" name="approval_id" value="<?php echo $row['approval_id']; ?>">
                    <button type="submit" name="approve" class="btn btn-success">Approve</button>
                    <button type="submit" name="disapprove" class="btn btn-danger">Disapprove</button>
                </form>
            </div>
        </div>
    <?php } ?>
</div>
</body>
</html>
