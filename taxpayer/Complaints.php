<?php 
session_start();
if (!isset($_SESSION['user_id'])) {
  header("Location: ../login.php"); // Redirect to login page if not logged in
  exit();
}
$user_id = $_SESSION['user_id'];
$username = $_SESSION['username'];
$role = $_SESSION['role'];
include 'connection/user_heder.php';
?>

<main>
  <div class="container my-5">
    <h1>File a Complaint</h1>
    <p class="lead">Use the form below to submit a complaint about your tax-related issue.</p>

    <form action="submit_complaint.php" method="post">
      <div class="form-group">
        <label for="inputName">Name</label>
        <input type="text" class="form-control" id="inputName" name="name" placeholder="Enter your name" required>
      </div>
      <div class="form-group">
        <label for="inputEmail">Email</label>
        <input type="email" class="form-control" id="inputEmail" name="email" placeholder="Enter your email" required>
      </div>
      <div class="form-group">
        <label for="inputSubject">Subject</label>
        <input type="text" class="form-control" id="inputSubject" name="subject" placeholder="Enter the subject of your complaint" required>
      </div>
      <div class="form-group">
        <label for="inputMessage">Message</label>
        <textarea class="form-control" id="inputMessage" name="message" rows="3" placeholder="Enter your complaint details" required></textarea>
      </div>
      <button type="submit" class="btn btn-primary">Submit Complaint</button>
    </form>
  </div>
</main>
<script src="../css/js/bootstrap.min.js"></script>

</body>
</html>
<?php include '../connection/footer.php'; ?>
