<?php
// Database Connection
$servername = "127.0.0.1";
$username = "root";
$password = "";
$dbname = "ecommerce";

$conn = new mysqli($servername, $username, $password, $dbname);
if ($conn->connect_error) {
    die("Connection failed: " . $conn->connect_error);
}

// Function to execute single value query
function executeSingleValueQuery($conn, $sql) {
    $result = $conn->query($sql);

    if ($result) {
        $row = $result->fetch_assoc();

        if ($row !== null && isset($row[0])) {
            return $row[0];
        } else {
            return 0; // Return 0 if no result or an error occurred
        }
    } else {
        return 0; // Return 0 if an error occurred during the query execution
    }
}

// Function to get all orders
function getAllCommandes($conn) {
    $sql = "SELECT * FROM orders";
    $result = $conn->query($sql);

    if ($result->num_rows > 0) {
        $cmd = $result->fetch_all(MYSQLI_ASSOC);
        return $cmd;
    } else {
        return [];
    }
}

// Function to count the total number of orders
function countTotalOrders($conn) {
    $sql = "SELECT COUNT(*) FROM orders";
    return executeSingleValueQuery($conn, $sql);
}

// Function to count the number of delivered orders
function countDeliveredOrders($conn) {
    $sql = "SELECT COUNT(*)  FROM orders WHERE status = 'Delivering'";
    return executeSingleValueQuery($conn, $sql);
}

// Function to count the number of cancelled orders
function countCancelledOrders($conn) {
    $sql = "SELECT COUNT(*)  FROM orders WHERE status = 'Cancelled'";
    return executeSingleValueQuery($conn, $sql);
}

// Function to count the number of completed orders
function countCompletedOrders($conn) {
    $sql = "SELECT COUNT(*) FROM orders WHERE status = 'Completed'";
    return executeSingleValueQuery($conn, $sql);
}

// Fetching statistics for different order statuses
$deliveringOrdersCount = countDeliveredOrders($conn);
$completedOrdersCount = countCompletedOrders($conn);
$cancelledOrdersCount = countCancelledOrders($conn);
$totalOrdersCount = countTotalOrders($conn);

// Get all orders
$cmd = getAllCommandes($conn);
$todaysDate = date("Y-m-d");
?>



<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>All orders</title>
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.2.1/css/all.min.css" integrity="sha512-MV7K8+y+gLIBoVD59lQIYicR65iaqukzvf/nwasF0nqhPay5w/9lJmVM2hMDcnK1OnMGCdVK+iQrJ7lzPJQd1w==" crossorigin="anonymous" referrerpolicy="no-referrer" />
    <link rel="stylesheet" href="affichage.css">
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

.delivering-status {
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
    </style>


</head>
<body>
<div class="main-container">
        <div class="left-menu">
            <div class="logo">
                <span class="logoLink"><a href="">EVARA</a></span>
            </div>
            <li class="menu"><i class="fa-sharp fa-solid fa-circle-chevron-down"></i> </li>
            <ul>
                <li class="sidebar-item"><a class="sidebar-link" href="#"><i class="fa-solid fa-house"></i> Dashbord </a>
                </li>
                <li class="sidebar-item"><a class="sidebar-link" href="user.php"><i class="fa-solid fa-user"></i>All Users </a>
                </li>
                <li class="sidebar-item"><a class="sidebar-link" href="AffichageProduct.php"><i class="fa-brands fa-product-hunt" style="color: #ffffff;"></i> All Products</a>
                </li>
                <li class="sidebar-item"><a class="sidebar-link" href="newProduct.php"><i class="fa-solid fa-shirt" style="color: #fcfcfc;"></i>New product</a>
                </li>
                <li class="sidebar-item"><a class="sidebar-link" href="order.php"><i class="fa-solid fa-bag-shopping" style="color: #ffffff;"></i> All Orders </a>
                </li>
                <li class="sidebar-item"><a class="sidebar-link" href="#"><i class="fa-solid fa-chart-simple" style="color: #ffffff;"></i>
                     Sales Statistics </a></li>
                <li class="sidebar-item" id="settings"><a id="settings" class="sidebar-link" href="#"><i class="fa-solid fa-gear"></i></a>
                <li>
            </ul>
        </div>
        <section>
    <div class="card">
        <h3>All Orders</h3>
        <p><?php echo $totalOrdersCount; ?> orders</p>
    </div>
    <div class="completed-status">
        <h3>Completed Orders</h3>
        <p><?php echo $completedOrdersCount; ?> orders</p>
    </div>
    <div class="delivering-status">
        <h3>Delivering Orders</h3>
        <p><?php echo $deliveringOrdersCount; ?> orders</p>
    </div>
    <div class="cancelled-status">
        <h3>Cancelled Orders</h3>
        <p><?php echo $cancelledOrdersCount; ?> orders</p>
    </div>
</section>

        <br>
        <table border="1" class="tab">
             <th>Command Number</th>
             <th>User's Id</th>
             <th>User's name</th>
             <th>Total amont</th>
             <th>Order date</th>
             <th>Date of the delivery</th>
             <th>Status</th>
             <th>Edit</th>
       -
       <?php
       
                 foreach ($cmd as $command) {
                    $rowClass = '';
                    switch ($command['status']) {
                        case 'Completed':
                            $rowClass = 'completed-status';
                            break;
                        case 'Delivering':
                            $rowClass = 'delivering-status';
                            break;
                        case 'Cancelled':
                            $rowClass = 'cancelled-status';
                            break;
                        default:
                            $rowClass = 'incomplete-status';
                            break;
                    }

                    echo '<tr ' . $rowClass . '>';
                    echo '<td>' . $command['id'] . '</td>';
                    echo '<td>' . $command['user_id'] . '</td>';
                    echo '<td>' . $command['username'] . '</td>';
                    echo '<td>' . $command['total_amount'] . '</td>';
                    echo '<td>' . $command['order_date'] . '</td>';
                    echo '<td>' . $command['delivery_date'] . '</td>';
                    echo '<td>' . $command['status'] . '</td>';
                    echo "<td><a href='editStatus.php'  " . $command["id"] . "><i class='fa-solid fa-pen-to-square'></i></a> </td>";
                    echo '</tr>';
                }
                ?>

        

        </table>  
</body>
<script  src="admin.js"></script>
</html>