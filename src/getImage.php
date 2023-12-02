<?php
$servername = "127.0.0.1";
$username = "root";
$password = "";
$dbname = "ecommerce";

// Create connection
$conn = new mysqli($servername, $username, $password, $dbname);

// Check connection
if ($conn->connect_error) {
    die("Connection failed: " . $conn->connect_error);
}

// Get the product ID from the query parameters
$id = isset($_GET['id']) ? $_GET['id'] : null;

// Fetch image data from the database based on the product ID
$sql = "SELECT image_path FROM products WHERE id = $id";
$result = $conn->query($sql);

if ($result->num_rows > 0) {
    $row = $result->fetch_assoc();
    $imagePath = $row['image_path'];

    // Output image
    header("Content-type: image/jpg"); // Assuming images are in JPEG format
    readfile($imagePath);
} else {
    // Image not found
    echo "Image not found";
}

// Close the database connection
$conn->close();
