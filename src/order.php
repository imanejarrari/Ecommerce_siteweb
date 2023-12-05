<?php 

$servername = "127.0.0.1";
$username = "root";
$password = "";
$dbname = "ecommerce";

$conn = new mysqli($servername, $username, $password, $dbname);

function executeSingleValueQuery($sql) {
    global $conn; // Assuming $conn is your database connection object

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

// Fetching statistics for different order statuses
$pendingOrdersCount = executeSingleValueQuery("SELECT COUNT(*) FROM orders WHERE status='Pending'");
$pendingOrdersPercentage = executeSingleValueQuery("SELECT (COUNT(CASE WHEN status = 'Pending' THEN 1 END) / COUNT(*)) * 100 AS percentage FROM orders");

$deliveringOrdersCount = executeSingleValueQuery("SELECT COUNT(*) FROM orders WHERE status='Delivering'");
$deliveringOrdersPercentage = executeSingleValueQuery("SELECT (COUNT(CASE WHEN status = 'Delivering' THEN 1 END) / COUNT(*)) * 100 AS percentage FROM orders");

$completedOrdersCount = executeSingleValueQuery("SELECT COUNT(*) FROM orders WHERE status='Completed'");
$completedOrdersPercentage = executeSingleValueQuery("SELECT (COUNT(CASE WHEN status = 'Completed' THEN 1 END) / COUNT(*)) * 100 AS percentage FROM orders");

$cancelledOrdersCount = executeSingleValueQuery("SELECT COUNT(*) FROM orders WHERE status='Cancelled'");
$cancelledOrdersPercentage = executeSingleValueQuery("SELECT (COUNT(CASE WHEN status = 'Cancelled' THEN 1 END) / COUNT(*)) * 100 AS percentage FROM orders");
?>




<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>All orders</title>
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.2.1/css/all.min.css" integrity="sha512-MV7K8+y+gLIBoVD59lQIYicR65iaqukzvf/nwasF0nqhPay5w/9lJmVM2hMDcnK1OnMGCdVK+iQrJ7lzPJQd1w==" crossorigin="anonymous" referrerpolicy="no-referrer" />
    <link rel="stylesheet" href="admin.css">
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
                <h3>Pending Orders</h3>
                <p><?php echo $pendingOrdersCount; ?> orders : <?php echo $pendingOrdersPercentage; ?>%</p>
         </div>
         <div class="card">
                <h3>Completed Orders</h3>
                <p><?php echo $completedOrdersCount; ?> orders : <?php echo $completedOrdersPercentage; ?>%</p>
         </div>
         <div class="card">
                <h3>Delivering Orders</h3>
                <p><?php echo $deliveringOrdersCount; ?> orders : <?php echo $deliveringOrdersPercentage; ?>%</p>
         </div>
         <div class="card">
                <h3>Cancelled Orders</h3>
                <p><?php echo $cancelledOrdersCount ; ?> orders : <?php echo $cancelledOrdersPercentage; ?>%</p>
         </div>


        </section>
        <br>
        <table>
             <th>Command Number</th>
             <th>User's name</th>
             <th>Total amont</th>
             <th>Order date</th>
             <th>Date of the delivery</th>
             <th>Status</th>
       - </table>
  <?php 
function getAllCommandes() {
    // Assuming you have a database connection
    $servername = "127.0.0.1";
$username = "root";
$password = "";
$dbname = "ecommerce";

$conn = new mysqli($servername, $username, $password, $dbname);

    // Assuming you have a table named 'commands' in your database
    $sql = "SELECT * FROM commands";
    $result = $conn->query($sql);

    if ($result->num_rows > 0) {
        // Fetching the data into an associative array
        $commands = $result->fetch_all(MYSQLI_ASSOC);
        return $commands;
    } else {
        return 0; // If no commands are found
    }
}
 $cmd=getAllCommandes();
 if ($Commands!=0){
    $todaysDate = date("Y-m-d");
     foreach ($Commands as $command) {

    }}

 ?> 
   <tr  <?php if(($command['dilivry_date']<$todaysDate ) AND ($command['status']!="Completed")){
		echo "class=red_row";
	}?>>

   </tr>
 
    

        

         
</body>
<script  src="admin.js"></script>
</html>