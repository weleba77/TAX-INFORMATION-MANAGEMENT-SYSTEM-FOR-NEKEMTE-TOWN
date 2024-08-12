<?php
session_start();
if (!isset($_SESSION['user_id']) ) {
    header("Location: ../login.php");
    exit();
}
$user_id = $_SESSION['user_id'];
$username = $_SESSION['username'];
$role = 'admin';
// Include the connection file
include '../connection/connection.php';

// Check if the form is submitted
if ($_SERVER["REQUEST_METHOD"] == "POST") {
    // Get the submitted values
    $id = $_POST["id"];
    $title = $_POST["title"];
    $content = $_POST["content"];

    // Prepare the SQL query to update the news item
    $query = "UPDATE news SET title = ?, content = ? WHERE id = ?";
    $stmt = $conn->prepare($query);
    $stmt->bind_param("ssi", $title, $content, $id);

    // Execute the statement
    if ($stmt->execute()) {
        // Redirect to the admin dashboard or news page
        header("Location: news.php");
        exit();
    } else {
        echo "Error updating news item.";
    }

    // Close the statement
    $stmt->close();
} else {
    // Display the form for editing news
    if (isset($_GET['id']) && is_numeric($_GET['id'])) {
        $id = $_GET['id'];
        
        // Retrieve the news item from the database
        $query = "SELECT * FROM news WHERE id = ?";
        $stmt = $conn->prepare($query);
        $stmt->bind_param("i", $id);
        $stmt->execute();
        $result = $stmt->get_result();
        $news = $result->fetch_assoc();
?>
<?php include 'connection/header.php'; ?>
<div class="container mt-4">
    <h2>Edit News</h2>
    <form action="edit_news.php" method="post">
        <input type="hidden" name="id" value="<?php echo $news['id']; ?>">
        <div class="form-group">
            <label for="title">Title</label>
            <input type="text" class="form-control" id="title" name="title" value="<?php echo $news['title']; ?>">
        </div>
        <div class="form-group">
            <label for="content">Content</label>
            <textarea class="form-control" id="content" name="content" rows="5"><?php echo $news['content']; ?></textarea>
        </div>
        <button type="submit" class="btn btn-primary">Update News</button>
    </form>
</div>

</body>
</html>
<?php
    } else {
        echo "Invalid news ID.";
    }
}
?>
<?php include '../connection/footer.php'; ?>
