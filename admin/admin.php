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
<div class="container mt-4">
    <h1 class="mt-5">Welcome, <?php echo $username; ?></h1>
    <div class="row mt-3">
        <div class="col-md-6">
            <div class="card">
                <div class="card-body">
                    <h5 class="card-title">Number of Tax Payers</h5>
                    <p class="card-text">
                        <?php 
                        include '../connection/connection.php'; 
                        $taxPayersByIncomeQuery = "SELECT income_source, COUNT(*) AS count FROM users GROUP BY income_source";
                        $taxPayersByIncomeResult = $conn->query($taxPayersByIncomeQuery);
                        $totalTaxPayers = 0;
                        while($row = $taxPayersByIncomeResult->fetch_assoc()) {
                            $totalTaxPayers += $row["count"];
                        }
                        echo $totalTaxPayers;
                        ?>
                        <br>
                        <a href="display_taxpyers.php"class="btn btn-primary">view</a>
                    </p>
                </div>
            </div>
        </div>
        <div class="col-md-6">
            <div class="card">
                <div class="card-body">
                    <h5 class="card-title">Number of Interviewers</h5>
                    <p class="card-text">
                        <?php 
                        $interviewersQuery = "SELECT COUNT(*) AS count FROM interviewers";
                        $interviewersResult = $conn->query($interviewersQuery);
                        $interviewersCount = $interviewersResult->fetch_assoc()["count"];
                        echo $interviewersCount;
                        ?>
                        <br>
                        <a href="display_interviews.php"class="btn btn-primary">view</a>
                    </p>
                </div>
            </div>
        </div>
    </div>
</div>

</body>
</html>
<?php include '../connection/footer.php'; ?>