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
$sqlCount = "SELECT 
    COUNT(*) AS total_orders,
    SUM(CASE WHEN status = 'Completed' THEN 1 ELSE 0 END) AS completed_orders,
    SUM(CASE WHEN status = 'cancelled' THEN 1 ELSE 0 END) AS cancelled_orders,
    SUM(CASE WHEN status = 'Pending' THEN 1 ELSE 0 END) AS pending_orders
FROM orders";

$result = $conn->query($sqlCount);

if ($result !== false) {
    $row = $result->fetch_assoc();
    $totalOrders = $row['total_orders'];
    $completedOrders = $row['completed_orders'];
    $cancelledOrders = $row['cancelled_orders'];
    $pendingOrders = $row['pending_orders'];
} else {
    echo "Error: " . $sqlCount . "<br>" . $conn->error;
}


// Fetch all orders

function getAllOrders($conn) {
    $sql = "SELECT * FROM orders";
    $result = $conn->query($sql);
    $orders = array();

    if ($result !== false) {
        while ($row = $result->fetch_assoc()) {
            $orders[] = $row;
        }
    }

    return $orders;
}

$allOrders = getAllOrders($conn);

// Close the database connection
$conn->close();
?>


<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title> Sidebar Menu </title>
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.2.1/css/all.min.css" integrity="sha512-MV7K8+y+gLIBoVD59lQIYicR65iaqukzvf/nwasF0nqhPay5w/9lJmVM2hMDcnK1OnMGCdVK+iQrJ7lzPJQd1w==" crossorigin="anonymous" referrerpolicy="no-referrer" />
    <link rel="stylesheet" href="Affichage.css">
    <style>
    section {
            display: flex;
           margin-left:220px;
           margin-right:20px;
           margin-top:30px;
            align-items: center;
            flex-wrap: wrap;
            gap:10px;
            padding: 10px;
            justify-content: space-between;
        }
        .card {
           
            background-color: #f5f5f5;
            padding: 20px;
            border-radius: 5px;
            width: 200px;
            box-shadow: 0 4px 6px rgba(0, 0, 0, 0.1);
        }
        h3 {
            margin-bottom: 10px;
        }
       .card  p {
            margin:10px;
        }
        .tab td{
            border: 1px solid #041e42;
            padding: 10px;
            text-align: center;
            color: #041e42;
        }
        .completed-status {
    background-color:greenyellow; /* Light red background for Completed status */
    color: #000000; /* Black text for better visibility */
            padding: 20px;
            border-radius: 5px;
            width: 200px;
            box-shadow: 0 4px 6px rgba(0, 0, 0, 0.1);
}

.pending-status {
    background-color: #FFFFCC; /* Light yellow background for Delivering status */
    color: #000000; /* Black text for better visibility */
            padding: 20px;
            border-radius: 5px;
            width: 200px;
            box-shadow: 0 4px 6px rgba(0, 0, 0, 0.1);
}

.cancelled-status {
    background-color: #FF9999; /* Light red background for Cancelled status */
    color: #000000; /* Black text for better visibility */

            padding: 20px;
            border-radius: 5px;
            width: 200px;
            box-shadow: 0 4px 6px rgba(0, 0, 0, 0.1);
}
section{
   margin-left:300px;


}
a{
    text-decoration: none;
    color: #041e42;

}
    </style>

</head>

<body>

    <div class="main-container">
        <div class="left-menu">
            <div class="logo">
                <span class="logoLink"><a href="">EVARA</a></span>
            </div>
            <li class="menu"><i class="fa-sharp fa-solid fa-circle-chevron-down"></i></li>
            <ul>
                <li class="sidebar-item"><a class="sidebar-link" href="#"><i class="fa-solid fa-house"></i> Dashbord </a>
                </li>
                <li class="sidebar-item"><a class="sidebar-link" href="user.php"><i class="fa-solid fa-user"></i>All Users </a>
                </li>
                <li class="sidebar-item"><a class="sidebar-link" href="AffichageProduct.php"><i class="fa-brands fa-product-hunt" style="color: #ffffff;"></i> All Products</a>
                </li>
                <li class="sidebar-item"><a class="sidebar-link" href="newProduct.php"><i class="fa-solid fa-shirt" style="color: #fcfcfc;"></i>New product</a>
                </li>
                <li class="sidebar-item"><a class="sidebar-link" href="order.php"><i class="fa-solid fa-bag-shopping" style="color: #ffffff;"></i>All Orders </a>
                </li>
                <li class="sidebar-item"><a class="sidebar-link" href="#"><i class="fa-solid fa-chart-simple" style="color: #ffffff;"></i>
                        Sales Statistics </a></li>
                <li class="sidebar-item" id="setting"><a href="#" id="setting" class="sidebar-link"><i class="fa-regular fa-circle-user" style="color: #ffffff;"></i></a></li>
                <li class="sidebar-item" id="settings"><a id="settings" class="sidebar-link" href="#"><i class="fa-solid fa-gear"></i></a>
                <li>
            </ul>
        </div>

        <section>
            <div class="card">
                <h3>All Orders</h3>
                <?php echo "Total Orders: " . $totalOrders . ""; ?>
            </div>
            <div class="completed-status">
                <h3>Completed Orders</h3>
                <?php echo "Completed Orders: " . $completedOrders . ""; ?>
            </div>
            <div class="cancelled-status">
                <h3>Cancelled Orders</h3>
                <?php echo "Cancelled Orders: " . $cancelledOrders . ""; ?>
            </div>
            <div class="pending-status">
                <h3>Pending Orders</h3>
                <?php echo "Pending Orders: " . $pendingOrders . ""; ?>
            </div>
        </section>

        <table border="1" class="tab">
            <thead>
                <tr>
                    <th>Order ID</th>
                    <th>Product ID</th>
                    <th>User ID</th>
                    <th>User Name</th>
                    <th>Address</th>
                    <th>Postal Code</th>
                    <th>Phone Number</th>
                    <th>Quantity</th>
                    <th>Total Amount</th>
                    <th>Date of Delivering</th>
                    <th>Status</th>
                </tr>
            </thead>
            <tbody>
                <?php foreach ($allOrders as $order) : ?>
                    <tr>
                        <td><?php echo $order['command_id']; ?></td>
                        <td><?php echo $order['product_id']; ?></td>
                        <td><?php echo $order['user_id']; ?></td>
                        <td><?php echo $order['username']; ?></td>
                        <td><?php echo $order['adresse']; ?></td>
                        <td><?php echo $order['code_postal']; ?></td>
                        <td><?php echo $order['number_phone']; ?></td>
                        <td><?php echo $order['quantity']; ?></td>
                        <td><?php echo $order['total_amount']; ?></td>
                        <td><?php echo $order['date_of_delivering']; ?></td>
                        <td><a href='EditStatus.php?id=" . $order["command_id"] . "'><?php echo $order['status']; ?> <br><i class='fa-solid fa-pen-to-square'></i></a></td>
                    </tr>
                <?php endforeach; ?>
            </tbody>
        </table>
    </div>




</body>
<script src="admin.js"></script>

</html>
