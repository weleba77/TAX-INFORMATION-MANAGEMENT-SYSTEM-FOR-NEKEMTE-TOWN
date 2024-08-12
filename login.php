<head>
<style>
    footer{

        position: fixed;
    }
    </style>

</head>
<?php include "connection/header.php"?>

    <!-- Login Form -->
    <div class="container mt-4">
        <div class="row justify-content-center">
            <div class="col-md-6">
                <div class="card">
                    <div class="card-header">Login</div>
                    <div class="card-body">
                        <form action="logindb.php" method="POST">
                            <div class="form-group">
                                <label for="login_type">Login Type</label>
                                <select class="form-control" id="login_type" name="login_type" required>
                                <option value="">Login Type</option>
                                <option value="admin">Admin</option>
                                    <option value="taxpayer">Taxpayer</option>
                                    <option value="interviewer">Interviewer</option>
                                </select>
                            </div>
                            <div class="form-group">
                                <label for="username">Username</label>
                                <input type="text" class="form-control" id="username" name="username" required>
                            </div>
                            <div class="form-group">
                                <label for="password">Password</label>
                                <input type="password" class="form-control" id="password" name="password" required>
                            </div>
                            <button type="submit" class="btn btn-primary">Login</button>
                        </form>
                    </div>
                </div>
            </div>
        </div>
    </div>

    <!-- Registration Link -->
    <div class="container mt-4">
        <div class="row justify-content-center">
            <div class="col-md-6">
                <div class="text-center">
                    <p>Don't have an account? <a href="registrater.php">Register here</a>.</p>
                </div>
            </div>
        </div>
    </div>
    <?php include "connection/footer_index.php" ?>
    <!-- Content of your web-based tax payment system goes here -->

    <!-- Bootstrap JS and jQuery -->
 
    <script src="css/js/bootstrap.min.js"></script>
</body>
</html>
