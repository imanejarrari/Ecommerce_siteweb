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

$searchTerm = isset($_GET['search_name']) ? $_GET['search_name'] : null;
$allOrders = getAllOrders($conn, $searchTerm);


// Fetch all orders

function getAllOrders($conn, $searchTerm = null) {
    $sql = "SELECT * FROM orders";

    // Add a WHERE clause for searching if a search term is provided
    if ($searchTerm !== null) {
        $searchTerm = $conn->real_escape_string($searchTerm);
        $sql .= " WHERE username LIKE '%$searchTerm%' OR command_id = '$searchTerm'";
    }

    $result = $conn->query($sql);
    $orders = array();

    if ($result !== false) {
        while ($row = $result->fetch_assoc()) {
            $orders[] = $row;
        }
    }

    return $orders;
}

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
    <script>
    function confirmLogout() {
        var confirmLogout = confirm("Are you sure you want to log out?");
        if (confirmLogout) {
            window.location.href = "logout.php"; // Replace with the actual URL for the logout script
        }
    }
</script>
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
.form{
    margin-top:5px;
    margin-left:200px;

}
.search{
      width:500px;
      height:40px;
      padding-left:200px;
     margin-right:60px;
     margin-left:320px;
     display: inline-block;
     font-size:small;
     border:1px solid #041e42;
     border-radius:10px;
     box-shadow: #f5f5f5;
    
    }
    .modal {
            display: none;
            position: fixed;
            z-index: 1;
            left: 0;
            top: 0;
            width: 100%;
            height: 100%;
            overflow: auto;
            background-color: rgba(0, 0, 0, 0.5);
        }

        .modal-content {
            background-color:#f5f5f5;
            margin: 15% auto;
            padding: 20px;
            border: 1px solid #888;
            width: 30%;
            height:130px;
        }


        .close {
            color: #aaa;
            float: right;
            font-size: 28px;
            font-weight: bold;
        }

        .close:hover,
        .close:focus {
            color: black;
            text-decoration: none;
            cursor: pointer;
        }
        .edit-status {
    background: none;
    border: none;
    color: #041e42;
    cursor: pointer;
}
#btn{
    background-color: #041e42;
    color: white;
    border:0.5px solid #041e42;
    border-radius:5px;
    width:120px;
    height:30px;
    margin-left:130px;
    margin-top:30px;
}
#newStatus{
    width:230px;
    height:30px;
    border:1px solid #041e42;
    border-radius:5px;
    padding-left:50px;

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
                <li class="sidebar-item"><a class="sidebar-link" href="Admin.php"><i class="fa-solid fa-house"></i> Dashbord </a>
                </li>
                <li class="sidebar-item"><a class="sidebar-link" href="user.php"><i class="fa-solid fa-user"></i>All Users </a>
                </li>
                <li class="sidebar-item"><a class="sidebar-link" href="AffichageProduct.php"><i class="fa-brands fa-product-hunt" style="color: #ffffff;"></i> All Products</a>
                </li>
                <li class="sidebar-item"><a class="sidebar-link" href="newProduct.php"><i class="fa-solid fa-shirt" style="color: #fcfcfc;"></i>New product</a>
                </li>
                <li class="sidebar-item"><a class="sidebar-link" href="order.php"><i class="fa-solid fa-bag-shopping" style="color: #ffffff;"></i>All Orders </a>
                </li>
                <li class="sidebar-item" id="settings">
    <a id="settings" class="sidebar-link" href="#" onclick="confirmLogout()">
        <i class="fa-solid fa-gear"></i> Logout
    </a>
</li>

            </ul>
        </div>
    
<form action="" method="GET" class="form">
       
       <label for="search_name"></label>
      <input type="text" name="search_name" class="search" placeholder="Search here:" value="<?php echo $searchTerm; ?>">
  </form>

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
                    <th>Product image</th>
                    <th>User ID</th>
                    <th>User Name</th>
                    <th>Address</th>
                    <th>Postal Code</th>
                    <th>Phone Number</th>
                    <th>Quantity</th>
                    <th>Price</th>
                    <th>Date of Delivering</th>
                    <th>Status</th>
                </tr>
            </thead>
            <tbody>
                <?php foreach ($allOrders as $order) : ?>
                    <tr>
                        <td><?php echo $order['command_id']; ?></td>
                        <td><?php echo $order['product_id']; ?></td>
                        <td><img src="<?php echo $order['image_path']; ?>" alt="Product Image" style="width: 50px; height: 50px;"></td>
                        <td><?php echo $order['user_id']; ?></td>
                        <td><?php echo $order['username']; ?></td>
                        <td><?php echo $order['adresse']; ?></td>
                        <td><?php echo $order['code_postal']; ?></td>
                        <td><?php echo $order['number_phone']; ?></td>
                        <td><?php echo $order['quantity'] ;  ?></td>
                        <td><?php echo $order['total_amount']; '$ ' ?></td>
                        <td><?php echo $order['date_of_delivering']; ?></td>
                        <td>
    <button class="edit-status" data-order-id="<?php echo $order['command_id']; ?>">
        <span><?php echo $order['status']; ?></span>
        <br>
        <i class='fa-solid fa-pen-to-square'></i>
    </button>
</td>

                    </tr>
                <?php endforeach; ?>
            </tbody>
        </table>

        <div id="editStatusModal" class="modal">
            <div class="modal-content">
                <span class="close" onclick="closeModal()">&times;</span>
                <form action="update_status.php" method="POST">
                    <label for="newStatus">New Status:</label>
                    <input type="text" name="newStatus" id="newStatus" placeholder="Enter the new Status" required>
                    <input type="hidden" name="orderId" id="orderId">
                    <button type="submit" id="btn">Update Status</button>
                </form>
            </div>
        </div>
        
        <script>
            var modal = document.getElementById("editStatusModal");
            var editButtons = document.getElementsByClassName("edit-status");

            Array.from(editButtons).forEach(function (button) {
                button.addEventListener("click", function () {
                    var orderId = button.getAttribute("data-order-id");
                    document.getElementById("orderId").value = orderId;
                    modal.style.display = "block";
                });
            });

            function closeModal() {
                modal.style.display = "none";
            }

            window.onclick = function (event) {
                if (event.target == modal) {
                    closeModal();
                }
            };
        </script>
    </div>
   

</body>
<script src="admin.js"></script>

</html>