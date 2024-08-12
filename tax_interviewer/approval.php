
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
include 'header.php'; // Include the header file

?>

<h1 class="mt-5">Welcome, <?php echo $username; ?></h1>
<h2>Pending Submissions</h2>
<table class="table">
    <thead>
        <tr>
            <th>ID</th>
            <th>Income Amount</th>
            <th>Income Source</th>
            <th>Actions</th>
        </tr>
    </thead>
    <tbody>
        <?php
        include '../connection/functions.php'; // Include your functions file
        $submissions = getIncome($conn, $user_id, true);
        while ($row = $submissions->fetch_assoc()): ?>
            <tr>
                <td><?php echo $row['id']; ?></td>
                <td><?php echo $row['income_amount']; ?></td>
                <td><?php echo $row['income_source']; ?></td>
                <td>
                    <form action="approve_income.php" method="post" style="display:inline;">
                        <input type="hidden" name="submission_id" value="<?php echo $row['id']; ?>">
                        <button type="submit" class="btn btn-success">Approve</button>
                    </form>
                    <form action="disapprove_income.php" method="post" style="display:inline;">
                        <input type="hidden" name="submission_id" value="<?php echo $row['id']; ?>">
                        <button type="submit" class="btn btn-danger">Disapprove</button>
                    </form>
                </td>
            </tr>
        <?php endwhile; ?>
    </tbody>
</table>



</div> 
<div><!-- Closing container div -->
<?php include '../connection/footer.php'; // Include the footer file ?>
</div>
</body>
</html>
