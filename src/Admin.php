<?php 

$servername = "127.0.0.1";
$username = "root";
$password = "";
$dbname = "ecommerce";

$conn = new mysqli($servername, $username, $password, $dbname);
if ($conn->connect_error) {
    die("Connection failed: " . $conn->connect_error);
}


// Count orders
$sqlOrders = "SELECT COUNT(*) AS order_count FROM orders";
$resultOrders = $conn->query($sqlOrders);
$orderCount = $resultOrders->fetch_assoc()["order_count"];


// Count users
$sqlUsers = "SELECT COUNT(*) AS user_count FROM users";
$resultUsers = $conn->query($sqlUsers);
$userCount = $resultUsers->fetch_assoc()["user_count"];

// Count completed orders
$sqlCompletedOrders = "SELECT COUNT(*) AS completed_order_count FROM orders WHERE status = 'completed'";
$resultCompletedOrders = $conn->query($sqlCompletedOrders);
$completedOrderCount = $resultCompletedOrders->fetch_assoc()["completed_order_count"];
//total price
$sqlTotalPrice = "SELECT SUM(total_amount * quantity) AS total_price FROM orders";
$resultTotalPrice = $conn->query($sqlTotalPrice);
$totalPrice = $resultTotalPrice->fetch_assoc()["total_price"];


//latest users
$sqlLatestUsers = "SELECT * FROM users where IsAdmin!=1 ORDER BY registration_date DESC LIMIT 10";
$resultLatestUsers = $conn->query($sqlLatestUsers);

//info about the latest orders
$sqlLatestOrders = "SELECT * FROM orders ORDER BY date_of_delivering DESC LIMIT 10";
$resultLatestOrders = $conn->query($sqlLatestOrders);





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
    
        <link rel="stylesheet" href="admin.css">
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
           margin-top:40px;
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
            box-shadow: 0 4px 6px rgba(0, 0, 0, 1);
        }
        h3{
            margin-bottom: 10px;
            color: #041e42;
        }
        h4{
            color: #041e42;
        }
       
       .card  p {
            margin:10px;
        }
        .big{
            margin-left:200px;
            margin-top:100px;
        }
        .big2{
            margin-left:20px;
            position: absolute;
            bottom:40px;
            box-shadow: 0 4px 6px rgba(1, 1, 0, 1);

            
        }
        .big1{ 
            position: absolute;
            top:210px;
            margin-left:880px;
            box-shadow: 0 4px 6px rgba(1, 1, 0, 1);
            width:250px;
            
        }
.tab{    
    border-collapse: collapse;
    width: 800px;
    margin-left:20px;
    height: auto;
}
.tab th{
border-bottom:1px solid #E8E2E2;
  padding-left:10px;
  text-align: center;
  height:50px;
  color: #041e42;
  
}
.tab td{
    border-bottom:0.5px solid #E8E2E2;
    padding-left:10px;
    text-align: center;
    color: #041e42;
    height:50px;

  } 
  #icon1{
   margin-left:60px ;
  }
  #icon2{
    margin-left:120px;
  }
  #icon3{
    margin-left:120px;
  }
  #icon4{
    margin-left:120px;
  }
  .Lo{
    padding-left:10px;
  }
  .status {
      padding: 4px 8px;
      font-size: 12px;
      text-align: center;
      color: #041e42;
      border-radius: 10px;

   }
   .pending {
      background-color: #FFFFCC;
      
   }

   .completed {
      background-color: greenyellow;
   }

   .cancelled {
      background-color: #FF9999;
   }
   .divtab{
    margin-bottom:60px;
   }
   .divtab>h3{
    margin-top:20px;
    margin-left:30px;
    color: #041e42;
    font-family: 'Lucida Sans';
   }
   .divtab>a{
    text-decoration: none;
    margin-left:700px;
    position: absolute;
    top:20px;
    border:1px solid  #f5f5f5;
    border-radius:25px;
    color:white;
    background-color:#041e42; 
    padding:5px ;
   }
   .tab2{
       margin-bottom:95px;
       border-collapse: collapse;
   }
   .tab2 td{
    padding-left:10px ;
    padding-right:10px;
   }
   .divtab2{
    margin-bottom:-30px;
   }
   .divtab2>h3{
    margin-top:20px;
    margin-left:20px;
    color: #041e42;
    font-family: 'Lucida Sans';
   }
</style>
<style>
  @import url('https://fonts.googleapis.com/css2?family=Handlee:wght@400&display=swap');
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
    <i class="fa-solid fa-right-from-bracket"></i>Logout
    </a>
</li>
                
            </ul>
        </div>

       


        <section>
            <div class="card">
               <h3><?php echo "" . $totalPrice . "        $" ; ?> <i id="icon1" class="fa-solid fa-coins"></i></h3>
                <h4>Earning</h4>
            </div>
            <div class="card">
               <h3><?php echo "" . $orderCount. ""; ?>  <i id="icon2" class="fa-solid fa-sort"></i> </h3> 
                <h4>Orders</h4>
            </div>
            <div class="card">
              <h3><?php echo " " . $userCount . ""; ?> <i id="icon3" class="fa-solid fa-user"></i></h3>  
                <h4>Customers</h4>
            </div>
            <div class="card">
                
               <h3><?php echo " " . $completedOrderCount . ""; ?> <i id="icon4" class="fa-solid fa-cart-arrow-down"></i></h3> 
                <h4>Sales</h4>
            </div>
        </section>
        <div class="big">
        <div class="big1">
            <table class="tab2">
            <div class="divtab2">
            <h3>Latest Customers</h3>
            </div>
                <tr>
                 <th></th>
                 <th></th>
                </tr>
                <?php 

        if ($resultLatestUsers->num_rows > 0) {

            while ($row = $resultLatestUsers->fetch_assoc()){
                echo "<tr>";
                echo "<td><img src='" . $row["profile_picture"] . "' alt='" . $row["username"] . "' width='40' height='40' border-radius='50%'></td>";

                echo "<td>" . $row["username"] . "</td> <br>"; 
                
                echo "</tr>";
            
        }
        }
         else {
            echo "No users found.";
        }
        ?>
            </table>
        
    </div>
  

    <div class="big2">

    <table class="tab">
     <div class="divtab">
        <h3>Latest Orders</h3>
        <a href="order.php">View All</a>
     </div>
    <tr>
        <th>Product Image</th>
        <th>Client's name</th>
        <th>Price</th>
        <th>Status</th>
    </tr>
    <?php
    // Affichez chaque produit dans le tableau
    if ($resultLatestOrders->num_rows > 0) {
        while ( $row = $resultLatestOrders->fetch_assoc()) {
            echo "<tr>";
            echo "<td><img src='" . $row["image_path"] . "' alt='" . $row["command_id"] . "' width='50' height='50'></td>";
            echo "<td>" . $row["username"] . "</td>";
            echo "<td>" . $row["total_amount"] . "</td>";
            
            // Ajoutez la classe CSS correspondante en fonction du statut
            $statusClass = strtolower($row["status"]);
           echo "<td >" .
     "<a class='status $statusClass'>" . $row["status"] . "</a>" .
     "</td>";
 

            echo "</tr>";
        }
    }
    ?>
</table>


   

    </div>
</div>

    


            </div>

        </div>


    
</body>
<script src="admin.js"></script>
</html> 