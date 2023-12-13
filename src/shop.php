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

$category = @$_GET["category"];
if ($category) {
    $query = "SELECT * FROM `products` WHERE category = ?";
    $stmt = $conn->prepare($query);
    $stmt->bind_param("s", $category);
} else {
    $query = "SELECT * FROM `products`";
    $stmt = $conn->prepare($query);
}

$stmt->execute();
$resultProducts = $stmt->get_result();
$row = $resultProducts->num_rows;
$products = [];
while ($row = $resultProducts->fetch_assoc()) {
    $products[] = $row;
}

$search_name = isset($_GET['search_name']) ? $_GET['search_name'] : '';
$search_category = isset($_GET['search_category']) ? $_GET['search_category'] : '';

// Filtrage par catégorie
$filter_category = isset($_GET['filter_category']) ? $_GET['filter_category'] : '';

// Requête pour récupérer les produits
$select_products_query = "SELECT * FROM products WHERE 
                         (name LIKE '%$search_name%') AND
                         ('$filter_category' = '' OR category = '$filter_category')";
$resultFilteredProducts = $conn->query($select_products_query);

$conn->close();
?>

<!-- Your HTML remains the same -->

























<!DOCTYPE html>
<html lang="en">

<head>
  <link rel="stylesheet" href="">
  <meta charset="UTF-8">
  <meta name="viewport" content="width=device-width, initial-scale=1.0">
  <title>SHOP</title>

  <script>
  




    document.addEventListener("DOMContentLoaded", function() {
      const searchInput = document.querySelector(".search");

      

      // Clear the search input after page load
      window.onload = function() {
        searchInput.value = '';
      };
    });

  
  
  document.addEventListener("DOMContentLoaded", function() {
    const searchInput = document.querySelector(".search");

    const filterForm = document.querySelector('.form');
    filterForm.addEventListener('submit', function(event) {
      // Optionally, you can clear the search input on form submission
      // searchInput.value = '';
    });
  });
</script>

  <!--<link rel="stylesheet" href="https://fonts.googleapis.com/css?family=Hedvig Letters Serif">-->

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


#category{
  
  padding: 8px; 
  font-size: 16px; 
  border: 1px solid #ccc;
  border-radius: 10px; 
  margin-left: 50px;
  margin-top: 40px;
}


.abc{
  display: flex;
  justify-content: space-between;
  

}
#fil{
  
  color: #fff;
  border: 2px solid #041e42;
  background-color: #041e42;
  padding:15px 30px;
  
    border-radius: 20px;
    margin-left: 200px;
    margin-bottom: 0px;
    outline: none;
    font-weight: 500;
    font-size: 15px;
    margin-top: -100px;
    cursor: pointer;
  
  
  
}
select[name="filter_category"]{
  padding: 8px; /* Adjust padding as needed */
  font-size: 16px; /* Adjust font size as needed */
  border: 1px solid #ccc; /* Add border for better visibility */
  border-radius: 4px; /* Optional: Add border-radius for rounded corners */

}
#hero{
  display: flex;
  justify-content: center;
  align-items: center;
  height: 500px;
  margin-top: 60px;
}

#hero img{
  /*margin: 0;
  padding: 0;
  display: flex;
  justify-content: center;
  align-items: center;
  width: 950px;
  height: 500px;;
  align-content: center;*/
  max-width: 100%;
  max-height: 100%;
  
  
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
footer{
  display: flex;
  flex-wrap: wrap;
  justify-content:space-between;
  margin-right: 50px;

  margin-top: 50px;
}
footer col{
  display: flex;
  flex-direction: column;
  align-items: flex-start;
  margin-bottom: 20px;
  justify-content: space-around;

}
footer #lol{
 
  margin-bottom: 30px;
  font-size:20px ;
  font-family: "Spartan", sans-serif;
  color: #041e42;


}
footer h4{
  font-size: 14px;
  padding-bottom: 20px;
  
}
footer p{
  font-size: 13px;
  margin: 0 0 8px 0;
}
footer a{
  font-size: 13px;
  text-decoration: none;
  color:#222 ;
  margin-bottom: 10px;
  display: block;
}
footer .follow{
  margin-top: 50px;
}
footer .follow a{
  display: inline;
  justify-content: space-around;
  font-size: 15px;
  margin-right: 10px;
}

footer .follow i{
  margin-top: 70px;
  padding-right: 4px;
  cursor: pointer;
  font-size: 24px;
  margin-right: 15px;

}
footer .follow i:hover{
  color:#088178
}

/*#up h2,p{
 text-align: center;
 
}*/
  </style>
</head>

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

  <form action="filter.php" method="GET" class="form">
  <div id='catego'></div>
    <div class="abc">
      <select name="filter_category" id="category">
        <option value="all">All</option>
        <option value="Clothes" <?php echo ($filter_category == 'clothes') ? 'selected' : ''; ?>>Clothes</option>
        <option value="Shoes" <?php echo ($filter_category == 'shoes') ? 'selected' : ''; ?>>Shoes</option>
        <option value="Accessories"  <?php echo ($filter_category == 'accessories') ? 'selected' : ''; ?>>Accessories</option>
      </select>
      </div>
    </div>
      <button type="submit" id="fil">filter</button>
  
</form>
  <div id="hero">
    <img src="hero2.jpg" alt="">
  </div>


  <div class="container">
    <?php
    foreach ($products as $products) {
      echo '<div class="product">';
      echo '<td><img width="150" src="' . $products["image_path"] . '"/></td>';
      echo '<h3 class="cat">' . $products['category'] . '</h3>';
      echo '<h3>' . $products['name'] . '</h3>';
      
      echo '<p>Price: $' . $products['price'] . '</p>';
      echo '<a href="produit.php?id=' . $products['id'] . '">Voir Produit</a>';
      echo '</div>';
    }
    ?>
  </div>
    
    

    <footer class="section-p1">
      <div class="col">
        <h4 id="lol">EVARA</h4>
        <h4>contact</h4>
        <p><strong>Address:</strong>586 california,street 88,Morocco</p>
        <p><strong>Phone:</strong>+212 689 541 25</p>
        <p><strong>Hours</strong>10:00 -18:00,Mon -Sat </p>
        <div class="follow">
          <h4>Follow us</h4>
          <div class="icon">
            <div class="icon">
              <a href="#"><i class="fab fa-facebook fa-2x" style="color: #000000;"></i></a>
              <a href="#"><i class="fab fa-instagram fa-2x" style="color: #000000;"></i></a>
              <a href="#"><i class="fab fa-twitter fa-2x" style="color: #000000;"></i></a>
            </div>

          </div>
        </div>
      </div>
      <div class="col">
        <h4>About</h4>
        <a href="#">About us</a>
        <a href="#">Delivery information</a>
        <a href="#">privacy Policy</a>
        <a href="#">Tems & Conditions</a>
        <a href="#">contact us</a>

      </div>
      <div class="col">
        <h4></h4>
        <a href="#">Sign In</a>
        <a href="#">View Cart</a>
        <a href="#"> My Wishlist</a>
        <a href="#">Track My Order</a>
        <a href="#"> Helps</a>
      </div>
      <div class="pay">
        <p>Secured Payment Gateway</p>
        <img src="pay.png" alt="">
      </div>

  </div>
  </footer>
</body>

</html>


