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
<h2>Assign Interviewer</h2>
            <form id="assignForm" action="assign_interviewer_process.php" method="post">
                <div class="form-group">
                    <label for="taxpayer_id">Taxpayer ID</label>
                    <input type="number" class="form-control" id="taxpayer_id" name="taxpayer_id" required>
                </div>
                <div class="form-group">
                    <label for="interviewer_id">Interviewer ID</label>
                    <input type="number" class="form-control" id="interviewer_id" name="interviewer_id" required>
                </div>
                <button type="submit" class="btn btn-primary">Assign</button>
            </form>
        </div>

 


        <?php include '../connection/footer.php'; ?>
    
