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
    <h2>Add Interviewer</h2>
    <form action="add_interviewer_process.php" method="post">
        <div class="form-group">
            <label for="firstName">First Name</label>
            <input type="text" class="form-control" id="firstName" name="firstName">
        </div>
        <div class="form-group">
            <label for="lastName">Last Name</label>
            <input type="text" class="form-control" id="lastName" name="lastName">
        </div>
        <div class="form-group">
            <label for="username">Username</label>
            <input type="text" class="form-control" id="username" name="username">
        </div>
        <div class="form-group">
            <label for="interviewerEmail">Interviewer Email</label>
            <input type="email" class="form-control" id="interviewerEmail" name="interviewerEmail">
        </div>
        <div class="form-group">
            <label for="interviewerPassword">Interviewer Password</label>
            <input type="password" class="form-control" id="interviewerPassword" name="interviewerPassword">
        </div>
        <button type="submit" class="btn btn-primary">Add Interviewer</button>
    </form>
</div>
<?php include '../connection/footer.php'; ?>
</body>
</html>

