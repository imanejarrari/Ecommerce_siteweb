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

if ($_SERVER["REQUEST_METHOD"] == "POST") {
    $newStatus = $_POST["newStatus"];
    $orderId = $_POST["orderId"];

    // Sanitize and validate input as needed
    // ...

    // Update the status in the database
    $sqlUpdate = "UPDATE orders SET status = '$newStatus' WHERE command_id = $orderId";

    if ($conn->query($sqlUpdate) === TRUE) {
        header("location:order.php");
    } else {
        echo "Error updating status: " . $conn->error;
    }
}

$conn->close();
?>
