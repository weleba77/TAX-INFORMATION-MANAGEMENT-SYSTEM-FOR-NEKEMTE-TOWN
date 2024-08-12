<head>
<style>
    footer{

        position: fixed;
    }
    </style>

</head>
<?php
session_start();
if (!isset($_SESSION['user_id'])) {
    header("Location: ../login.php");
    exit();
}

include '../connection/connection.php';
include 'connection/user_heder.php';

$user_id = $_SESSION['user_id'];

if (isset($_SESSION['message'])) {
    echo '<div class="alert alert-danger">' . $_SESSION['message'] . '</div>';
    unset($_SESSION['message']);
}


// Check if the tax amount is calculated
$query = "SELECT tax_amount FROM income WHERE user_id = ? AND tax_amount IS NOT NULL";
$stmt = $conn->prepare($query);
$stmt->bind_param("i", $user_id);
$stmt->execute();
$result = $stmt->get_result();

if ($result->num_rows == 0) {
    echo "Tax amount is not calculated yet.";
    exit();
}
?>
<div class="container">
    <h2>Upload Receipt</h2>
    <form action="upload_receipt.php" method="post" enctype="multipart/form-data">
        <div class="form-group">
            <label for="receipt_image">Upload Receipt Image:</label>
            <input type="file" name="receipt_image" id="receipt_image" class="form-control" required>
        </div>
        <button type="submit" class="btn btn-primary">Upload</button>
    </form>
</div>
<div>
<?php include '../connection/footer.php'; ?>
</div>
</body>
</html>
