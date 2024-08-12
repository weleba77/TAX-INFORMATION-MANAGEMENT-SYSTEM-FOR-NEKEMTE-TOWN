<?php include 'connection/header.php'; ?>

<div class="container mt-4">
    <h2>Latest News</h2>
    <div class="row">
        <?php
        // Include the database connection file
        include 'connection/connection.php';

        // Fetch news items from the database
        $query = "SELECT * FROM news ORDER BY id DESC";
        $result = $conn->query($query);

        // Display news items
        if ($result->num_rows > 0) {
            while ($row = $result->fetch_assoc()) {
                echo '<div class="col-md-4 mb-4">';
                echo '<div class="card">';
                echo '<div class="card-body">';
                echo '<h5 class="card-title">' . $row['title'] . '</h5>';
                if (!empty($row['image'])) {
                    echo '<img src="admin/' . $row['image'] . '" class="card-img-top" alt="News Image"><br>';
                }
                echo '<p class="card-text">' . $row['content'] . '</p>';
               
                echo '</div>';
                echo '</div>';
                echo '</div>';
            }
        } else {
            echo 'No news found.';
        }

        // Close the database connection
        $conn->close();
        ?>
    </div>
</div>
<?php include 'connection/footer_index.php'; ?>
</body>
</html>

