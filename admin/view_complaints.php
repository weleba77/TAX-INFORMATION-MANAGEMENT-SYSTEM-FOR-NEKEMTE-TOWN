<?php
session_start();
if (!isset($_SESSION['user_id'])) {
    header("Location: ../login.php");
    exit();
}

$user_id = $_SESSION['user_id'];
$username = $_SESSION['username'];
$role = 'admin';

include '../connection/connection.php'; // Include your database connection file
include 'connection/header.php'; // Include header file

// Fetch complaints from the database
$query = "SELECT * FROM complaints ORDER BY created_at DESC";
$result = $conn->query($query);

?>

<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>View Complaints</title>
    <link rel="stylesheet" href="../css/bootstrap.min.css">
</head>
<body>
<main>
    <div class="container my-5">
        <h1>View Complaints</h1>
        <?php if ($result->num_rows > 0): ?>
            <?php while ($row = $result->fetch_assoc()): ?>
                <div class="card mb-3">
                    <div class="card-header">
                        <strong>ID: </strong><?php echo $row['id']; ?>
                    </div>
                    <div class="card-body">
                        <h5 class="card-title"><strong>Subject: </strong><?php echo htmlspecialchars($row['subject']); ?></h5>
                        <h6 class="card-subtitle mb-2 text-muted">
                            <strong>Name: </strong><?php echo htmlspecialchars($row['name']); ?> |
                            <strong>Email: </strong><?php echo htmlspecialchars($row['email']); ?>
                        </h6>
                        <p class="card-text"><strong>Message: </strong><?php echo htmlspecialchars($row['message']); ?></p>
                        <p class="card-text"><small class="text-muted">Submitted At: <?php echo htmlspecialchars($row['created_at']); ?></small></p>
                    </div>
                </div>
            <?php endwhile; ?>
        <?php else: ?>
            <p>No complaints found.</p>
        <?php endif; ?>
    </div>
</main>
<script src="../css/js/bootstrap.min.js"></script>
</body>
</html>

<?php include '../connection/footer.php'; ?>
