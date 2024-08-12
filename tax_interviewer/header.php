<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Interviewer Dashboard</title>
    <!-- Bootstrap CSS -->
    <link rel="stylesheet" href="../css/css/bootstrap.min.css">
    <!-- Custom styles -->
    <style>
        
            footer {
            margin: 25px 0 0;
            bottom: 0;
            width: 100%;
            background-color: #343a40;
            color: #fff;
            padding: 20px 0;
            text-align: center;
        }
        
        .navbar-brand img {
            margin-right: 10px;
        }
    </style>
</head>
<body>
<nav class="navbar navbar-expand-lg navbar-dark bg-primary">

        <a class="navbar-brand" href="admin.php">
            <img src="../icon/logo1.png" alt="" height="30">TAX INFORMATION MANAGEMENT SYSTEM FOR NEKEMTE TOWN
        </a>
        <button class="navbar-toggler" type="button" data-toggle="collapse" data-target="#navbarNav" aria-controls="navbarNav" aria-expanded="false" aria-label="Toggle navigation">
            <span class="navbar-toggler-icon"></span>
        </button>
        <div class="collapse navbar-collapse" id="navbarNav">
            <ul class="navbar-nav mr-auto">
                <li class="nav-item">
                    <a class="nav-link" href="Dashboard.php">Home</a>
                </li>
                <li class="nav-item">
                    <a class="nav-link" href="approval.php">Approval Of Income</a>
                </li>
                <li class="nav-item">
                    <a class="nav-link" href="view_complaints.php">Comment</a>
                </li>
                <li class="nav-item">
                    <a class="nav-link" href="view_approved_receipts.php">View Approved Receipts</a>
                </li>
                <li class="nav-item">
                    <a class="nav-link" href="manage_receipts.php">manage receiptss</a>
                </li>
            </ul>
            <ul class="navbar-nav ml-auto">
                <li class="nav-item">
                    <a class="nav-link" href="../login.php">Logout</a>
                </li>
            </ul>
        </div>
    </nav>

    <div class="container">
        <!-- Content starts here -->
        <!-- You can include this header file in your other PHP files to maintain consistency -->
        <br>
