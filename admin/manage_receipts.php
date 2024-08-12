<?php
session_start();
if (!isset($_SESSION['user_id'])) {
    header("Location: ../login.php");
    exit();
}

$user_id = $_SESSION['user_id'];
$username = $_SESSION['username'];
$role = $_SESSION['role'];

if ($role !== 'admin') {
    echo "You do not have permission to view this page.";
    exit();
}

include '../connection/connection.php';
include 'connection/header.php';

// Fetch receipts that need approval
$query = "SELECT income.id, income.income_amount, income.income_source, income.receipt_image 
          FROM income 
          WHERE income.receipt_image IS NOT NULL 
          AND income.id NOT IN (SELECT income_id FROM receipt_approval WHERE interviewer_approved = 1 AND admin_approved = 1)";
$stmt = $conn->prepare($query);
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
    <style>
        /* Style for the modal */
        .modal-dialog {
            max-width: 800px;
        }
        .modal-body img {
            width: 100%;
            height: auto;
        }
    </style>
</head>
<body>
<main>
    <div class="container my-5">
        <h1>Manage Receipts</h1>
        <?php if ($result->num_rows > 0): ?>
            <div class="row">
                <?php while ($row = $result->fetch_assoc()): ?>
                    <div class="col-md-4">
                        <div class="card mb-4">
                            <div class="card-body">
                                <h5 class="card-title">Receipt ID: <?php echo $row['id']; ?></h5>
                                <p class="card-text">Income Amount: <?php echo htmlspecialchars($row['income_amount']); ?></p>
                                <p class="card-text">Income Source: <?php echo htmlspecialchars($row['income_source']); ?></p>
                                <div class="text-center">
                                    <a href="#" data-toggle="modal" data-target="#imageModal<?php echo $row['id']; ?>">
                                        <img src="../taxpayer/<?php echo htmlspecialchars($row['receipt_image']); ?>" alt="Receipt Image" class="img-fluid">
                                    </a>
                                </div>
                                <form action="approve_receipt.php" method="post" class="mt-3">
                                    <input type="hidden" name="income_id" value="<?php echo $row['id']; ?>">
                                    <button type="submit" name="action" value="approve" class="btn btn-success">Approve</button>
                                    <button type="submit" name="action" value="disapprove" class="btn btn-danger">Disapprove</button>
                                </form>
                            </div>
                        </div>
                    </div>

                    <!-- Modal -->
                    <div class="modal fade" id="imageModal<?php echo $row['id']; ?>" tabindex="-1" role="dialog" aria-labelledby="imageModalLabel<?php echo $row['id']; ?>" aria-hidden="true">
                        <div class="modal-dialog" role="document">
                            <div class="modal-content">
                                <div class="modal-body">
                                    <img src="../taxpayer/<?php echo htmlspecialchars($row['receipt_image']); ?>" class="img-fluid" alt="Receipt Image">
                                </div>
                                <div class="modal-footer">
                                    <button type="button" class="btn btn-secondary" data-dismiss="modal">Close</button>
                                </div>
                            </div>
                        </div>
                    </div>
                    <!-- End Modal -->
                <?php endwhile; ?>
            </div>
        <?php else: ?>
            <p>No receipts found that need approval.</p>
        <?php endif; ?>
    </div>
</main>
<script src="../css/js/bootstrap.min.js"></script>
</body>
</html>

<?php include '../connection/footer.php'; ?>
