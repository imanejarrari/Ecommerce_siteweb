<?php
$servername = "127.0.0.1";
$username = "root";
$password = "";
$dbname = "ecommerce";

$conn = new mysqli($servername, $username, $password, $dbname);

// Check connection
if ($conn->connect_error) {
    die("Connection failed: " . $conn->connect_error);
}

// Process form data
$search_name = isset($_GET['search_name']) ? $_GET['search_name'] : '';
$filter_category = isset($_GET['filter_category']) ? $_GET['filter_category'] : '';

// Requête pour récupérer les produits
$select_products_query = "SELECT * FROM products WHERE 
                         (name LIKE '%$search_name%') AND
                         ('$filter_category' = '' OR category = '$filter_category')";
$resultFilteredProducts = $conn->query($select_products_query);

// Include your HTML and loop to display the results here
/*while ($product = $resultFilteredProducts->fetch_assoc()) {
    echo '<div class="product">';
    echo '<td><img width="150" src="' . $product["image_path"] . '"/></td>';
    echo '<h3 class="cat">' . $product['category'] . '</h3>';
    echo '<h3>' . $product['name'] . '</h3>';
    echo '<p>Price: $' . $product['price'] . '</p>';
    echo '<a href="produit.php?id=' . $product['id'] . '">Voir Produit</a>';
    echo '</div>';
    }*/
?>
<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Shop</title>

    <link rel="stylesheet" href="https://fonts.googleapis.com/css2?family=Handlee:wght@400&display=swap">

  <script defer src="https://use.fontawesome.com/releases/v5.15.4/js/all.js"></script>
</head>
</head>
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
    margin-left: -40px;
    margin-right: 100px;
   
  
  }

  #header{
    display: flex ;
    align-items: center;
    justify-content: space-between;
    padding: 20px 80px;
    background-color:#041e42;
    /*box-shadow: 0 5px 15px  rgba(0, 0, 0, 0.73);*/
    height: 90px;
    left: 0;
    flex-wrap: wrap;
    width: 100%;
    
    
    

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
  top: 0px;

}
.navbar li a:hover{
  
  font-size:17px;
  
}
 
ul li ul.dropdown li{
  display: block;
  color: black;
  margin-bottom: 15px;
  margin-top:15 px;
  
  

}



ul li:hover ul.dropdown{
  display: block;

}
/*.dropdown li:hover{
  background-color: #F3EEEA;
  padding:10px;
}*/
ul.dropdown a{
  color:black;
  
}

ul li ul.dropdown{
  width: 100%;
  background: white;
  position: absolute;
  z-index: 99;
  display: none;
  color: black;
  width: 100px;
  border-radius: 10px;
  border-left: none;
}




.search-container {
  display: flex;
  align-items: center;
}


 .form input{
  display: flex;

    width: 300px;
    flex: 1;
border-radius: 18px;
height: 40px;
width: 300px;
margin-right: 30px;
border: 0;
outline: 0;
font-size: 18px;
} 

.search-btn{

  padding: 10px;
  margin-left: -25px;
  border-radius: 30px;
  


}
/*li  input{
    background: transparent;
    border: 0;
    outline: 0;
    width: 30px; 
   color:#041e42;
   font-size:22px ;
   cursor: pointer;
   margin-left:55px ;
}*/

.dropdown{
  border: 1px solid #555;
}


#category {
  
  padding: 8px; /* Adjust padding as needed */
  font-size: 16px; /* Adjust font size as needed */
  border: 1px solid #ccc; /* Add border for better visibility */
  border-radius: 4px; /* Optional: Add border-radius for rounded corners */
}
.abc{
  display: flex;
  justify-content: space-between;
}
button {
  padding: 8px; /* Adjust padding as needed */
  font-size: 16px; /* Adjust font size as needed */
  background-color: #fff; /* Add your desired background color */
  color: black; /* Add your desired text color */
  border: none; /* Remove default button border */
  border-radius: 4px; /* Optional: Add border-radius for rounded corners */
  cursor: pointer; /* Add pointer cursor on hover */
  
}











    .container {
  display: flex;
  justify-content:center;
  flex-wrap:wrap;
  grid-gap:20px;
  padding: 20px;
  background-color: #fff;
  border-radius: 10px;
  box-shadow: 0 2px 4px rgba(0, 0, 0, 0.1);
  margin-top: 50px;
}
.container:hover{
  box-shadow: #555;
}

h2 {
  text-align: center;
  margin-bottom: 20px;
}

.product {
  background-color:#F9F9F9;
  width: 180px;
  padding: 10px;
  border: 1px solid #ccc;
  border-radius: 5px;
  margin-bottom: 15px;
}

.product h3 {
  font-size:16px;
  font-weight:700;
  margin: 0;
}

.product p {
  margin: 5px 0;
}

.product a {
  display: inline-block;
  padding: 5px 10px;
  background-color: #041e42;
  color: #fff;
  text-decoration: none;
  border-radius: 5px;
}
.cat{
  color: #45D62E;
}

@media (max-width: 600px) {
  .container {
      padding: 10px;
  }
}
</style>
<body>
<section id="header">

<div class="head">
  <ul class="navbar">
    <h2 id="logo"><a href="index.php">EVARA</a></h2>
    <li>
    <form action="chercher.php" method="GET" class="form">
<div class="search-container">
<label for="search_name"></label>
<input type="text" name="search_name" class="search" placeholder="Search by Name:" value="<?php echo $search_name; ?>">
<button type="submit" class="search-btn">
  <i class="fas fa-search"></i>
</button>
</div>
</form>

    <li id='catego'>
      <div class="abc">
        <select name="filter_category" id="category">
          <option value="all">All</option>
          <option value="Clothes" <?php echo ($filter_category == 'clothes') ? 'selected' : ''; ?>>Clothes</option>
          <option value="Shoes" <?php echo ($filter_category == 'shoes') ? 'selected' : ''; ?>>Shoes</option>
          <option value="Accessories"  <?php echo ($filter_category == 'accessories') ? 'selected' : ''; ?>>Accessories</option>
        </select>
        <button  type="submit">Filter</button>
      </div>
    </li>
  </li>
</form>
<li><a href="shop.php">Shop</a></li>

    <li><a href="about.html">About us</a></li>
    <li><a href="contact.html">contact us</a></li>
    <li><a href="addtocart.php"><i class="fas fa-shopping-bag" style="color: white;"></i></a></li>
    <li><a href="profile.html"><i class="fas fa-user" style="color: #ffffff;"></i></a>
      <ul class="dropdown">
        <li><a href="login.php">log in</a></li>
        <li><a href="UserRegister.php">sign up</a></li>
      </ul>
    </li>
  </ul>
</div>
</section>
<div class="container">
    <?php
while ($product = $resultFilteredProducts->fetch_assoc()) {
    
    echo '<div class="product">';
    echo '<td><img width="150" src="' . $product["image_path"] . '"/></td>';
    echo '<h3 class="cat">' . $product['category'] . '</h3>';
    echo '<h3>' . $product['name'] . '</h3>';
    echo '<p>Price: $' . $product['price'] . '</p>';
    echo '<a href="produit.php?id=' . $product['id'] . '">Voir Produit</a>';
    echo '</div>';
    }
?>
</div>

    
</body>
</html>
