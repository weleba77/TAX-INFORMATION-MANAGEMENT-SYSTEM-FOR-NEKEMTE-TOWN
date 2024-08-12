<?php
session_start();
if (!isset($_SESSION['user_id'])) {
    header("Location: ../login.php");
    exit();
}
$user_id = $_SESSION['user_id'];
$username = $_SESSION['username'];
$role = 'admin';

include 'connection/header.php'; // Include your header file
include '../connection/connection.php'; // Include your database connection file

// Query to fetch interviewers
$interviewersQuery = "SELECT * FROM interviewers";
$interviewersResult = $conn->query($interviewersQuery);

?>

<div class="container mt-4">
    <h1 class="mt-5">Interviewers</h1>
    <div class="row mt-3">
        <div class="col-md-12">
            <table class="table">
                <thead>
                    <tr>
                        <th>ID</th>
                        <th>Name</th>
                        <th>Last Name</th>
                        <th>Email</th>
                        <th>Action</th>
                    </tr>
                </thead>
                <tbody>
                    <?php
                    if ($interviewersResult->num_rows > 0) {
                        while ($row = $interviewersResult->fetch_assoc()) {
                            ?>
                            <tr>
                                <td><?php echo $row['id']; ?></td>
                                <td><?php echo $row['first_name']; ?></td>
                                <td><?php echo $row['last_name']; ?></td>
                                <td><?php echo $row['email']; ?></td>
                                <td>
                                    <!-- Delete Button -->
                                    <a href="delete_interviewer.php?action=delete&id=<?php echo $row['id']; ?>" class="btn btn-danger" onclick="return confirm('Are you sure you want to delete this interviewer?')">Delete</a>

                                    <!-- Disable Button -->
                                    
                                </td>
                            </tr>
                            <?php
                        }
                    } else {
                        ?>
                        <tr>
                            <td colspan="4">No interviewers found.</td>
                        </tr>
                        <?php
                    }
                    ?>
                </tbody>
            </table>
        </div>
    </div>
</div>
<div>
<!-- Form for exporting to CSV -->
<form method="post" action="export_interviewers.php">
        <input type="hidden" name="income_source" value="<?php echo isset($_POST['income_source']) ? $_POST['income_source'] : ''; ?>">
        <button type="submit" class="btn btn-primary">Export to CSV</button>
    </form>
    </div> 
<?php include '../connection/footer.php'; // Include your footer file ?>

</body>
</html>
