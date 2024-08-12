<?php
session_start();
if (!isset($_SESSION['user_id'])) {
    header("Location: ../login.php"); 
    // Redirect to login page if not logged in
    exit();
}
$user_id = $_SESSION['user_id'];
$username = $_SESSION['username'];
$role = $_SESSION['role'];

include '../connection/connection.php'; // Adjust the path as necessary
include 'connection/user_heder.php';

include '../connection/functions.php'; 
    ?>
    <main>
         <table class="table">
                <thead>
                    <tr>
                        <th>ID</th>
                        <th>Income Amount</th>
                        <th>Income Source</th>
                        <th>Interviewer Approved</th>
                        <th>Admin Approved</th>
                        <th>Tax Amount</th>
                        <th>Receipt</th>
                    </tr>
                </thead>
                <tbody>
                    <?php
                    $submissions = getIncome($conn, $user_id);
                    
                    while ($row = $submissions->fetch_assoc()): ?>
                        <tr>
                            <td><?php echo $row['id']; ?></td>
                            <td><?php echo $row['income_amount']; ?></td>
                            <td><?php echo $row['income_source']; ?></td>
                            <td><?php echo $row['interviewer_approved'] ? 'Yes' : 'No'; ?></td>
                            <td><?php echo $row['admin_approved'] ? 'Yes' : 'No'; ?></td>
                            <td><?php echo $row['tax_amount'] ? $row['tax_amount'] : 'Pending'; ?></td>
                            <td><?php echo $row['receipt_image'] ? '<a href="'.$row['receipt_image'].'" target="_blank">View</a>' : 'Not uploaded'; ?></td>
                            <td>
                        <?php if ($row['interviewer_approved'] && $row['admin_approved'] && is_null($row['tax_amount'])): ?>
                            <form method="POST" action="calculate_tax.php">
                                <input type="hidden" name="submission_id" value="<?php echo $row['id']; ?>">
                                <button type="submit">Calculate Tax</button>
                            </form>
                        <?php endif; ?>
                    </td>
                        </tr>

                    <?php endwhile; ?>
                </tbody>
                <div>
                     <?    include '../connection/footer.php';?>
                </div>

    </main>
    <?php


  ?>