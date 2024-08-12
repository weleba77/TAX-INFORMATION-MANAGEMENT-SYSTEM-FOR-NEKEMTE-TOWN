<head>
<style>
    footer{

        position: fixed;
    }
    </style>

</head>
<?php 
session_start();
if (!isset($_SESSION['user_id']) ) {
    header("Location: ../login.php");
    exit();
}
$user_id = $_SESSION['user_id'];
$username = $_SESSION['username'];
$role = 'admin';
include 'connection/header.php'; ?>
<div class="container">
    <h2 class="text-center mb-4">Users by Income Source</h2>

    <div class="row">
        <?php
    include '../connection/connection.php';

        // Check the connection
        if ($conn->connect_error) {
            die("Connection failed: " . $conn->connect_error);
        }

        // Query the database to get the counts of users for each income source
        $sql = "SELECT income_source, COUNT(*) AS count FROM users GROUP BY income_source";
        $result = $conn->query($sql);

        if ($result->num_rows > 0) {
            // Display the numbers of users for each income source
            while($row = $result->fetch_assoc()) {
                $incomeSource = $row['income_source'];
                $count = $row['count'];
        ?>

   

     
        <div class="col-md-6">
          <div class="card mb-4 shadow-sm">
            <div class="card-body">
                    <h5 class="card-title">Number of Tax Payers</h5>
                    <p class="card-text">
                        <h4><?php echo "$incomeSource: $count users"; ?></h4>
                        <form action="view_users.php" method="post">
                            <input type="hidden" name="income_source" value="<?php echo $incomeSource; ?>">
                            <button type="submit" class="btn btn-primary btn-view-users">View Users</button>
                        </form>
                    </div>
                    
                    
                    </div></div>
        <?php
            }
        } else {
            echo "<p>No data found</p>";
        }

        // Close the database connection
        $conn->close();
        ?>
    </div>
</div>
<?php include '../connection/footer.php'; ?>
</html>
