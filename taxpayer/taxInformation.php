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
    header("Location: ../login.php"); // Redirect to login page if not logged in
    exit();
}
$user_id = $_SESSION['user_id'];
$username = $_SESSION['username'];
$role = $_SESSION['role'];
include '../connection/connection.php'; // Database connection
include 'connection/user_heder.php'; // User-specific navigation header
?>
<main>
    <div class="container my-5">
        <h1>Tax Information</h1>
        <p class="lead">View and manage your tax information, including property value and tax amount.</p>

        <div class="row">
            
            <div class="col-md-6">
                <div class="card mb-4 shadow-sm">
                    <div class="card-body">
                        <h2 class="card-title">Tax Details</h2>
                        <p class="card-text">Check your current tax amount, payment history, and any outstanding balances.</p>
                        <a href="view_tax_details.php" class="btn btn-primary">View Tax Details</a>
                    </div>
                </div>
            </div>
     

      
         
            <div class="col-md-6">
                <div class="card mb-4 shadow-sm">
                    <div class="card-body">
                        <h2 class="card-title">Tax Payment</h2>
                        <p class="card-text">Make tax payments securely and conveniently.</p>
                        <a href="pay_taxes.php" class="btn btn-primary">Pay Taxes</a>
                    </div>
                </div>
            </div>
        </div>
    </div>
</main>
<script src="../css/js/bootstrap.min.js"></script>
<?php include '../connection/footer.php'; ?>
