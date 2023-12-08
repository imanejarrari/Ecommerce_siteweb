    <?php
    if ($_SERVER["REQUEST_METHOD"] == "POST") {
        // Get the new status and order ID from the form submission
        $newStatus = $_POST["newStatus"];
        $orderId = $_POST["orderId"];

        // Your database connection and update logic here...

        // Example: Update the order status in the database
        $servername = "127.0.0.1";
        $username = "root";
        $password = "";
        $dbname = "ecommerce";

        $conn = new mysqli($servername, $username, $password, $dbname);

        if ($conn->connect_error) {
            die("Connection failed: " . $conn->connect_error);
        }

        // Assuming your orders table has a column named 'status'
        $sqlUpdate = "UPDATE orders SET status='$newStatus' WHERE command_id='$orderId'";

        if ($conn->query($sqlUpdate) === TRUE) {
            echo "Status updated successfully";
        } else {
            echo "Error updating status: " . $conn->error;
        }

        $conn->close();
    }
    ?>
