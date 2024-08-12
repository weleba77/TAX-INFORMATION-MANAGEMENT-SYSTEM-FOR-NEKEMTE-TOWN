<!DOCTYPE html>
<html lang="en">
<head>
    <style>
/* Style for the news image */
.card img {
    width: 50%; /* Set the width of the image to 50% of the page */
    height: auto; /* Maintain the aspect ratio of the image */
    display: block; /* Ensure proper alignment */
    margin: 0 auto; /* Center the image horizontally */
    border-radius: 5px; /* Add rounded corners */
    box-shadow: 0 0 5px rgba(0, 0, 0, 0.3); /* Add a subtle shadow */
}

/* Style for the card containing the news item */
.card {
    margin-bottom: 20px; /* Add some spacing between news items */
    text-align: center; /* Align the contents of the card to the center */
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
include 'connection/header.php'; 
// Include the connection file
include '../connection/connection.php';

// Fetch news items from the database
$query = "SELECT * FROM news";
$result = $conn->query($query);

// Display news items
if ($result->num_rows > 0) {
    while ($row = $result->fetch_assoc()) {
        echo '<div class="card">';
        echo '<div class="card-body">';
        echo '<h5 class="card-title">' . $row['title'] . '</h5>';

        if (!empty($row['image'])) {
            echo '<img src="' . $row['image'] . '" class="img-fluid mb-2" alt="News Image">';
        }

        echo '<p class="card-text">' . $row['content'] . '</p>';
        // Edit and delete buttons for admin
    
        echo '<a href="edit_news.php?id=' . $row['id'] . '" class="btn btn-primary">Edit </a>  ';
        echo '<a href="delete_news.php?id=' . $row['id'] . '" class="btn btn-danger">Delete</a>';
        echo '</div>';
        echo '</div>';
    }
} else {
    echo 'No news found.';
}

$conn->close();
?>
<?php include '../connection/footer.php'; ?>