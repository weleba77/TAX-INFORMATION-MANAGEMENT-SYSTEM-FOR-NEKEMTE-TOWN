<?php
session_start();
if (!isset($_SESSION['user_id'])) {
    header("Location: ../login.php");
    exit();
}

$user_id = $_SESSION['user_id'];
$username = $_SESSION['username'];
$role = $_SESSION['role'];

include '../connection/connection.php';
include 'header.php';

// Fetch all receipts with their approval status
$query = "SELECT income.id, income.income_amount, income.income_source, income.receipt_image, 
                 receipt_approval.interviewer_approved, receipt_approval.admin_approved
          FROM income 
          LEFT JOIN receipt_approval ON income.id = receipt_approval.income_id 
          WHERE income.user_id = ?";
$stmt = $conn->prepare($query);
$stmt->bind_param('i', $user_id);
$stmt->execute();
$result = $stmt->get_result();
?>

<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Manage Receipts</title>
    <link rel="stylesheet" href="../css/bootstrap.min.css">
</head>
<body>
<main>
    <div class="container my-5">
        <h1>Manage Receipts</h1>
        <?php if ($result->num_rows > 0): ?>
            <div class="row">
                <?php while ($row = $result->fetch_assoc()): ?>
                    <div class="col-md-4 mb-4">
                        <div class="card">
                            <img src="../taxpayer/<?php echo htmlspecialchars($row['receipt_image']); ?>" class="card-img-top" alt="Receipt Image">
                            <div class="card-body">
                                <h5 class="card-title">Receipt ID: <?php echo $row['id']; ?></h5>
                                <p class="card-text">Income Amount: <?php echo htmlspecialchars($row['income_amount']); ?></p>
                                <p class="card-text">Income Source: <?php echo htmlspecialchars($row['income_source']); ?></p>
                                <?php if ($row['interviewer_approved'] == 1 && $row['admin_approved'] == 1): ?>
                                    <span class="badge badge-success">Approved</span>
                                    <a href="generate_receipt.php?id=<?php echo $row['id']; ?>" class="btn btn-primary">Generate Receipt</a>
                                <?php elseif ($row['interviewer_approved'] == 0 || $row['admin_approved'] == 0): ?>
                                    <span class="badge badge-warning">Pending Approval</span>
                                <?php endif; ?>
                            </div>
                            <div class="card-footer">
                                <?php if ($role == 'admin' && $row['interviewer_approved'] == 1 && $row['admin_approved'] == 0): ?>
                                    <form action="approve_receipt.php" method="post" style="display:inline;">
                                        <input type="hidden" name="income_id" value="<?php echo $row['id']; ?>">
                                        <input type="hidden" name="action" value="approve">
                                        <button type="submit" class="btn btn-success">Approve</button>
                                    </form>
                                    <form action="approve_receipt.php" method="post" style="display:inline;">
                                        <input type="hidden" name="income_id" value="<?php echo $row['id']; ?>">
                                        <input type="hidden" name="action" value="disapprove">
                                        <button type="submit" class="btn btn-danger">Disapprove</button>
                                    </form>
                                <?php elseif ($role == 'interviewer' && $row['interviewer_approved'] == 0): ?>
                                    <form action="approve_receipt.php" method="post" style="display:inline;">
                                        <input type="hidden" name="income_id" value="<?php echo $row['id']; ?>">
                                        <input type="hidden" name="action" value="approve">
                                        <button type="submit" class="btn btn-success">Approve</button>
                                    </form>
                                    <form action="approve_receipt.php" method="post" style="display:inline;">
                                        <input type="hidden" name="income_id" value="<?php echo $row['id']; ?>">
                                        <input type="hidden" name="action" value="disapprove">
                                        <button type="submit" class="btn btn-danger">Disapprove</button>
                                    </form>
                                <?php endif; ?>
                            </div>
                        </div>
                    </div>
                <?php endwhile; ?>
            </div>
        <?php else: ?>
            <p>No receipts found.</p>
        <?php endif; ?>
    </div>
</main>
<script src="../css/js/bootstrap.min.js"></script>
</body>
</html>

<?php include '../connection/footer.php'; ?>
