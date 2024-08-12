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
    // Check if all required fields are provided
    if (!empty($_POST["title"]) && !empty($_POST["content"]) && isset($_FILES["image"])) {
        // Get the submitted values
        $title = $_POST["title"];
        $content = $_POST["content"];

        // Check if image file is uploaded successfully
        if ($_FILES["image"]["error"] == UPLOAD_ERR_OK) {
            // Get information about the uploaded file
            $image_name = $_FILES["image"]["name"];
            $image_tmp = $_FILES["image"]["tmp_name"];
            $image_size = $_FILES["image"]["size"];

            // Check file size (max 5MB)
            if ($image_size > 5 * 1024 * 1024) {
                echo "Sorry, your file is too large.";
                exit();
            }

            // Allow certain file formats
            $allowed_types = array('jpg', 'jpeg', 'png');
            $image_extension = strtolower(pathinfo($image_name, PATHINFO_EXTENSION));
            if (!in_array($image_extension, $allowed_types)) {
                echo "Sorry, only JPG, JPEG, and PNG files are allowed.";
                exit();
            }

            // Upload image
            $image_path = "uploads/" . uniqid() . "_" . $image_name;
            if (!move_uploaded_file($image_tmp, $image_path)) {
                echo "Error uploading image.";
                exit();
            }
        } else {
            echo "Error uploading image: " . $_FILES["image"]["error"];
            exit();
        }

        // Insert news into database
        $query = "INSERT INTO news (title, content, image) VALUES (?, ?, ?)";
        $stmt = $conn->prepare($query);
        $stmt->bind_param("sss", $title, $content, $image_path);

        if ($stmt->execute()) {
            // Redirect to admin dashboard or news page
            header("Location: post_news.php");
            exit();
        } else {
            echo "Error inserting news into database.";
        }

        $stmt->close();
    } else {
        echo "Please provide all required fields.";
    }
} else {
    echo "Form submission method is not POST.";
}
?>
