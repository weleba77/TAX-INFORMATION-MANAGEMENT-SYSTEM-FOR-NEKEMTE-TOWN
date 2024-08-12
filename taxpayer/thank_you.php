<?php
session_start();
if (!isset($_SESSION['user_id'])) {
    header("Location: ../login.php");
    exit();
}

$username = $_SESSION['username'];

include 'connection/user_heder.php';
?>

<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Thank You</title>
    <link rel="stylesheet" href="../css/bootstrap.min.css">
    <head>
<style>
    footer{

        position: fixed;
    }
    </style>

</head>
</head>
<body>
<main>
    <div class="container my-5">
        <h1>Thank You, <?php echo htmlspecialchars($username); ?>!</h1>
        <p class="lead">Your complaint has been submitted successfully. We will review it and get back to you if needed.</p>
        <a href="dashboard.php" class="btn btn-primary">Go to Dashboard</a>
    </div>
</main>
<script src="../css/js/bootstrap.min.js"></script>
</body>
</html>

<?php include '../connection/footer.php'; ?>
