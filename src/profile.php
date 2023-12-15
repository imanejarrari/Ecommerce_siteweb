<?php
session_start();

// Check if the user is logged in
if (!isset($_SESSION['user_name']) || empty($_SESSION['user_name'])) {
    header("Location: login.php");
    exit();
}

$servername = "127.0.0.1";
$username = "root";
$password = "";
$dbname = "ecommerce";

$conn = new mysqli($servername, $username, $password, $dbname);

if ($conn->connect_error) {
    die("Connection failed: " . $conn->connect_error);
}

// Fetch user information from the database
$userName = $_SESSION['user_name'];
$selectUserQuery = "SELECT * FROM users WHERE username = ?";
$stmtUser = mysqli_prepare($conn, $selectUserQuery);

if ($stmtUser) {
    mysqli_stmt_bind_param($stmtUser, "s", $userName);
    mysqli_stmt_execute($stmtUser);

    $resultUser = mysqli_stmt_get_result($stmtUser);
    $userData = mysqli_fetch_assoc($resultUser);

    mysqli_stmt_close($stmtUser);
} else {
    echo 'Error in the prepared statement for fetching user information.';
}

$conn->close();
?>

<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>User Profile</title>
    <link rel="stylesheet" href="https://fonts.googleapis.com/css2?family=Handlee:wght@400&display=swap">

  <script defer src="https://use.fontawesome.com/releases/v5.15.4/js/all.js"></script>
    <style>
        @import url("https://fonts.googleapis.com/css2?family=Spartan:wght@100;200;300;400;500;600;700;800;900&display=swap");


* {
    margin: 0;
    padding: 0;
    box-sizing: border-box;
    font-family: "Spartan", sans-serif;
  }




  
    #logo a{
    text-decoration: none;
    color: #ffff;
    font-family: "Handlee",sans-serif;
    margin-left: 50px;
    margin-right: 100px;
  
  }

  #header{
    display: flex ;
    align-items: center;
    justify-content: space-between;
    padding: 20px 80px;
    background-color: #041e42;
    /*box-shadow: 0 5px 15px  rgba(0, 0, 0, 0.73);*/
    height: 90px;
    left: 0;
    flex-wrap: wrap;
    margin-bottom: -20px;
    position: fixed;
    top: 0;
    width: 100%;
    z-index: 1000;

    
    

    }

  
  .navbar{
    display: flex;
    align-items:center ;
    justify-content: center;
    justify-content: space-around;
    
    

  }
.navbar li{
  list-style: none;
  padding: 0 20px;

}
.navbar li a{
  text-decoration: none;
  font-size: 16px;
  font-weight: 600;
  color: white;

}
.navbar li a:hover{
  
  font-size:18px;
  
}



ul li ul.dropdown li{
  display: block;
  color: black;
  margin-bottom: none;
  margin-top:15 px;
  
  

}
ul li ul.dropdown li:last-child{
  border: none;
}
ul li ul.dropdown{
  width: 100%;
  background: white;
  position: absolute;
  z-index: 999;
  display: none;
  color: black;
  width: 150px;
  border-radius: 10px;
}
ul li:hover{
  background-color:#041e42;
  
}

ul li:hover ul.dropdown{
  display: block;

}
.dropdown li:hover{
  background-color: #F3EEEA;
  padding:10px;
}
ul.dropdown a{
  color:black;
  
}
ul li:hover ul.dropdown:first-child{
  padding:100px;
}

.search-box{
  width: 400px;
  background: #fff;
  /*margin: 200px auto 0;*/
  border-radius: 20px;
}
.row{
  display: flex;
  align-items: center;
  padding: 10px 20px;
  height: 50px;
  width: 300px;
}
.row input{
  width: 300px;
  flex: 1;
border-radius: 20px;
height: 40px;
width: 300px;
margin-right: 30px;
border: 0;
outline: 0;
font-size: 18px;



}
.search-box button{
  background: transparent;
  border: 0;
  outline: 0;
  width: 30px; 
 color:#041e42;
 font-size:22px ;
 cursor: pointer;
 margin-left:55px ;
}
::placeholder{
  color:#555;
}

.profile{

    width:1000px;
    height:500px;
    margin-top:100px;
    margin-left:100px;
    position:relative;
}

.container {
        
            width:400px;
            height:500px;
            position: absolute;
            top:200px;
            left:50px;
            overflow: auto;
        
}

        .container p {
            margin: 10px 0;
        }

        .container img {
            width: 100px;
            height: auto;
        }

        .form{
            position: absolute;
            top:300px;
            left:400px;
            
        }
        input{
            display:block;
        }
    </style>
</head>

<body>
<section id="header">

<div class="head">
  <ul class="navbar">
    <h2 id="logo"><a href="homeafter.php">EVARA</a></h2>



    <li>
      <div class="search-box">
        <div class="row">
          <input type="text" id="input-box" placeholder="search anything" autocomplete="off">
          <button><i class="fas fa-search"></i></button>
        </div>
        <div class="result-box">

        </div>
      </div>
    </li>


    <li><a href="shop.php">Shop</a></li>
    <li><a href="about.html">About us</a></li>
    <li><a href="contact.html">contact us</a></li>
    <li><a href="addtocart.php"><i class="fas fa-shopping-bag" style="color: white;"></i></a></li>
    <li><a href="profile.html"><i class="fas fa-user" style="color: #ffffff;"></i></a>
      <ul class="dropdown">
        <li><a href="profile.php">My Profil</a></li>
        <li><a href="orders.php">My Orders</a></li>
        <li><a href="logout.php">Log out</a></li>
      </ul>
    </li>




  </ul>
</div>
<div class="profile">
</section>


    <div class="container">
    
  <?php if (!empty($userData['profile_picture'])) : ?>
            
                <img src="<?php echo $userData['profile_picture']; ?>" alt="Profile Image">
            <?php else : ?>
                <p>No profile image available.</p>
            <?php endif; ?>
        <?php if ($userData) : ?>
            <p><strong>Username:</strong> <?php echo $userData['username']; ?></p>
            <p><strong>Email:</strong> <?php echo $userData['email']; ?></p>

          

        <?php else : ?>
            <p>Error fetching user information.</p>
        <?php endif; ?>
    </div>

    <form method="post" action="" enctype="multipart/form-data" class="form">
        <!-- Add input fields for editing user information -->
        <!-- For example: -->
        <label for="new_username">New Username:</label>
        <input type="text" class="new_username" value="<?php echo $userData['username']; ?>" required>

        <label for="new_email">New Email:</label>
        <input type="email" class="new-email" name="new_email" value="<?php echo $userData['email']; ?>" required>

        <!-- Add a file input for profile image -->
        <label for="new_profile_image">New Profile Image:</label>
        <input type="file" name="new_profile_image">

        <!-- Add other input fields as needed -->

        <button type="submit" name="update_profile">Update Profile</button>
    </form>   
</div>
</body>

</html>
