<?php
session_start();
if (!isset($_SESSION['user_id'])) {
    header("Location: ../login.php");
    exit();
}
$user_id = $_SESSION['user_id'];
$username = $_SESSION['username'];
$role = 'admin';

include '../connection/connection.php';
include '../connection/functions.php';
include 'connection/header.php';
?>
    <div class="container">
        <h2>Pending Submissions</h2>
        <table class="table">
            <thead>
                <tr>
                    <th>ID</th>
                    <th>Income Amount</th>
                    <th>Income Source</th>
                    <th>Interviewer Approved</th>
                    <th>Actions</th>
                </tr>
            </thead>
            <tbody>
                <?php
                $submissions = getIncomes($conn, $user_id, true);
                if ($submissions->num_rows > 0) {
                    while ($row = $submissions->fetch_assoc()): ?>
                        <tr>
                            <td><?php echo $row['id']; ?></td>
                            <td><?php echo $row['income_amount']; ?></td>
                            <td><?php echo $row['income_source']; ?></td>
                            <td><?php echo $row['interviewer_approved'] ? 'Yes' : 'No'; ?></td>
                            <td>
                                <form action="approve _income_process.php" method="post" style="display:inline;">
                                    <input type="hidden" name="submission_id" value="<?php echo $row['id']; ?>">
                                    <button type="submit" class="btn btn-success" name="action" value="approve">Approve</button>
                                </form>
                                <form action="approve _income_process.php" method="post" style="display:inline;">
                                    <input type="hidden" name="submission_id" value="<?php echo $row['id']; ?>">
                                    <button type="submit" class="btn btn-danger" name="action" value="disapprove">Disapprove</button>
                                </form>
                            </td>
                        </tr>
                    <?php endwhile;
                } else {
                    echo "<tr><td colspan='5'>No pending submissions found.</td></tr>";
                }
                ?>
            </tbody>
        </table>
    </div>
</body>
</html>

<?php
$conn->close();
?>
