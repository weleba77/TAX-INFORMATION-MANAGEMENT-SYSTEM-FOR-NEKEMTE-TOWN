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
<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>View Users</title>
    <!-- Bootstrap CSS -->
    <link href="https://stackpath.bootstrapcdn.com/bootstrap/4.5.2/css/bootstrap.min.css" rel="stylesheet">
    <style>
    /* CSS for full-width footer */
    footer {
        width: 100%;
        position: fixed;
        bottom: 0;
        left: 0;
        background-color: #343a40; /* Change the background color as needed */
        color: #ffffff; /* Change the text color as needed */
    }

    footer .container-fluid {
        padding: 20px; /* Adjust padding as needed */
    }

    footer h5 {
        color: #ffffff; /* Change heading text color as needed */
    }

    footer p {
        color: #ffffff; /* Change paragraph text color as needed */
    }

    footer a {
        color: #ffffff; /* Change link text color as needed */
    }

    footer a:hover {
        color: #cccccc; /* Change link hover color as needed */
    }
</style>

</head>
<body>

<div class="container mt-4">
    <h2 class="text-center mb-4">Users Information</h2>

    <div class="table-responsive">
        <table class="table table-bordered">
            <thead>
                <tr>
                <th>ID NO.</th>
                    <th>First Name</th>
                    <th>Last Name</th>
                    <th>Phone Number</th>
                    <th>TIN</th>
                    <th>Sex</th>
                    <th>Income Source</th>
                    <th>Email</th>
                    <th>Place of Work</th>
                    <th>User Name</th>
                    <th>Photo</th>
                </tr>
            </thead>
            <tbody>
                <?php
                include '../connection/connection.php';

                if ($conn->connect_error) {
                    die("Connection failed: " . $conn->connect_error);
                }

                if ($_SERVER["REQUEST_METHOD"] == "POST" && isset($_POST['income_source'])) {
                    $incomeSource = $_POST['income_source'];
                    $sql = "SELECT * FROM users WHERE income_source = '$incomeSource'";
                    $result = $conn->query($sql);

                    if ($result->num_rows > 0) {
                        while($row = $result->fetch_assoc()) {
                            echo "<tr>";
                            echo "<td>" . $row['id'] . "</td>";
                            echo "<td>" . $row['first_name'] . "</td>";
                            echo "<td>" . $row['last_name'] . "</td>";
                            echo "<td>" . $row['phone_number'] . "</td>";
                            echo "<td>" . $row['tin'] . "</td>";
                            echo "<td>" . $row['sex'] . "</td>";
                            echo "<td>" . $row['income_source'] . "</td>";
                            echo "<td>" . $row['email'] . "</td>";
                            echo "<td>" . $row['place_of_work'] . "</td>";
                            echo "<td>" . $row['username'] . "</td>";
                            echo "<td><img src='../" . $row['photo_path'] . "' height='50'></td>";

                            echo "</tr>";
                        }
                    } else {
                        echo "<tr><td colspan='10'>No users found for $incomeSource</td></tr>";
                    }
                }

                $conn->close();
                ?>
           
     
  

   
    </div>
  
    
</div>
<div>
<!-- Form for exporting to CSV -->
<form method="post" action="export.php">
        <input type="hidden" name="income_source" value="<?php echo isset($_POST['income_source']) ? $_POST['income_source'] : ''; ?>">
        <button type="submit" class="btn btn-primary">Export to CSV</button>
    </form>
    </div>   
    <?php include '../connection/footer.php'; ?>
</body>
</html>
