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
    <h2>Post News</h2>
    <form action="post_news_process.php" method="post" enctype="multipart/form-data">
        <div class="form-group">
            <label for="title">Title</label>
            <input type="text" class="form-control" id="title" name="title">
        </div>
        <div class="form-group">
            <label for="image">Image</label>
            <input type="file" class="form-control-file" id="image" name="image">
        </div>
        <div class="form-group">
            <label for="content">Content</label>
            <textarea class="form-control" id="content" name="content" rows="5"></textarea>
        </div>
        <button type="submit" class="btn btn-primary">Post News</button>
    </form>
</div>


<?php include '../connection/footer.php'; ?>

</body>
</html>
