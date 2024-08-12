<?php
session_start();
if (!isset($_SESSION['user_id']) ) {
    header("Location: ../login.php");
    exit();
}
$user_id = $_SESSION['user_id'];
$username = $_SESSION['username'];
$role ='taxpayer';

include 'connection/user_heder.php';
?>

    <div class="container mt-4">
    <h1 class="mt-5">Welcome, <?php echo $username; ?></h1>
    </div>
    
  <main>
    <section class="jumbotron text-center">
      <div class="container">
        
        <p class="lead text-muted">Manage your tax information and file complaints with ease.</p>
        <a href="taxInformation.php" class="btn btn-primary my-2">Get Started</a>
      </div>
    </section>

    <div class="container">
      <div class="row">
        <div class="col-md-6">
          <div class="card mb-4 shadow-sm">
            <div class="card-body">
              <h2 class="card-title">Tax Information</h2>
              <p class="card-text">View and manage your tax information, including property value and tax amount.</p>
              <a href="taxInformation.php" class="btn btn-primary">Learn More</a>
            </div>
          </div>
          </div>
          <div class="col-md-6">
          <div class="card mb-4 shadow-sm">
            <div class="card-body">
              <h2 class="card-title">Insert The Income</h2>
              <p class="card-text">you need to report your income here.</p>
              <a href="insert_income.php" class="btn btn-primary">Learn More</a>
            </div>
          </div>
          </div>
         <div class="col-md-6">
          <div class="card mb-4 shadow-sm">
            <div class="card-body">
              <h2 class="card-title">Complaints</h2>
              <p class="card-text">File and track complaints regarding tax-related issues.</p>
              <a href="complaints.php" class="btn btn-primary">Learn More</a>
            </div>
          </div>
        </div>
        
      </div>
    </div>
  </main>

  <?php include '../connection/footer.php'; ?>

  <script src="https://code.jquery.com/jquery-3.5.1.slim.min.js"></script>
  <script src="https://cdn.jsdelivr.net/npm/popper.js@1.16.1/dist/umd/popper.min.js"></script>
  <script src="https://stackpath.bootstrapcdn.com/bootstrap/4.5.2/js/bootstrap.min.js"></script>
</body>
</html>
</body>
</html>
