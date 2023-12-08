
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
    .nav{
        margin-left:200px;
        margin-top:0;
        border:0.5px solid whitesmoke ;
        background-color:whitesmoke;
        box-shadow:5px 5px 5px 5px whitesmoke;
        border-radius:0px 0px 30px 30px;
        height:50px;
    }    

    .search{
        position: absolute;
        top:10px;
        margin-top:5px;
        border:1px solid black;
        border-radius:20px;
        margin-left:400px;
        margin-top:0px;
        width:400px;
    
    }
    .form{
        margin-top:-20px;
    }
    .nav h3{
      
        margin-top:10px;
        margin-left:100px;
        font-family:'Dancing Script';
        font-size:30px;
 
 }
</style>
<style>
  @import url('https://fonts.googleapis.com/css2?family=Dancing+Script:wght@500&display=swap');
</style>
</head>
<body>
<div class="main-container">
        <div class="left-menu">
            <div class="logo">
                <span class="logoLink"><a href=""></a></span>
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

        <div class="nav">
            <h3>EVARA</h3>
            <form action="" method="GET" class="form">
       
       <label for="search_name"></label>
     <input type="text"name="search_name" class="search" placeholder="Search here:" value="<?php echo $searchTerm; ?>">
  </form>
        </div>
    
</body>
<script src="admin.js"></script>
</html>