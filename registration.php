<?php
include 'connection/connection.php';
// Check the connection
if ($conn->connect_error) {
    die("Connection failed: " . $conn->connect_error);
}

// Retrieve user information from the form
$firstName = $_POST['first_name'];
$lastName = $_POST['last_name'];
$phoneNumber = $_POST['phone_number'];
$tin = $_POST['tin'];
$sex = $_POST['sex'];
$incomeSource = $_POST['income_source'];
$email = $_POST['email'];
$placeOfWork = $_POST['place_of_work'];
$username = $_POST['username'];
$password = $_POST['password'];

// Hash the password
$hashedPassword = password_hash($password, PASSWORD_DEFAULT);

// File upload handling
$targetDir = "uploads/";
$targetFile = $targetDir . basename($_FILES["photo"]["name"]);
$uploadOk = 1;
$imageFileType = strtolower(pathinfo($targetFile, PATHINFO_EXTENSION));

// Check if image file is a actual image or fake image
if (isset($_POST["submit"])) {
    $check = getimagesize($_FILES["photo"]["tmp_name"]);
    if ($check !== false) {
        $uploadOk = 1;
    } else {
        echo "<script>alert('File is not an image.')</script>";
        $uploadOk = 0;
    }
}

// Check if file already exists
if (file_exists($targetFile)) {
    echo "<script>alert('Sorry, file already exists.')</script>";
    $uploadOk = 0;
}

// Check file size
if ($_FILES["photo"]["size"] > 50000000) {
    echo "<script>alert('Sorry, your file is too large.')</script>";
    $uploadOk = 0;
}

// Allow certain file formats
if (
    $imageFileType != "jpg" && $imageFileType != "png" && $imageFileType != "jpeg"
    && $imageFileType != "gif"
) {
    echo "<script>alert('Sorry, only JPG, JPEG, PNG & GIF files are allowed.')</script>";
    $uploadOk = 0;
}

// Check if $uploadOk is set to 0 by an error
if ($uploadOk == 0) {
    echo "<script>alert('Sorry, your file was not uploaded.')</script>";
} else {
    // if everything is ok, try to upload file
    if (move_uploaded_file($_FILES["photo"]["tmp_name"], $targetFile)) {
        // Prepare and execute the SQL query to insert user information into the "users" table
        $sql = "INSERT INTO users (first_name, last_name, phone_number, tin, sex, income_source, email, place_of_work, username, password, photo_path) VALUES (?, ?, ?, ?, ?, ?, ?, ?, ?, ?, ?)";
        $stmt = $conn->prepare($sql);
        $stmt->bind_param("sssssssssss", $firstName, $lastName, $phoneNumber, $tin, $sex, $incomeSource, $email, $placeOfWork, $username, $hashedPassword, $targetFile);
        $stmt->execute();

        // Check if the insertion was successful
        if ($stmt->affected_rows > 0) {
            
            echo  "<script>alert('User registration successful!')</script>";
           
        } else {
            echo "<script>alert('User registration failed. Please try again.')</script>";
            
        }

        // Close the prepared statement
        $stmt->close();
    } else {
        echo "<script>alert('Sorry, there was an error uploading your file.')</script>";
    }
}

// Close the database connection
$conn->close();
?>
