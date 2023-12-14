<?php

session_start();
require("config.php");

if ($_SERVER["REQUEST_METHOD"] == "GET" && isset($_GET["id"])) {
    $id = $_GET["id"];
    
    $query = "SELECT * FROM products WHERE id = ?";
    $stmt = $conn->prepare($query);

    if ($stmt) {
        $stmt->bind_param("i", $id);
        $stmt->execute();

        $result = $stmt->get_result();
        $products = $result->fetch_assoc();

        $stmt->close();

        if (!$products) {
            die("Product not found.");
        }
    } else {
        die("Error in the prepared statement.");
    }
    

  }else {
    die("Product ID not provided.");
  
  
       }






?>



<!DOCTYPE html>
<html lang="en">

<head>
  <meta charset="UTF-8">
  <meta name="viewport" content="width=device-width, initial-scale=1.0">
  <title>product</title>
  <link rel="stylesheet" href="https://fonts.googleapis.com/css2?family=Handlee:wght@400&display=swap">
  <style>
    @import url("https://fonts.googleapis.com/css2?family=Spartan:wght@100;200;300;400;500;600;700;800;900&display=swap");

    * {

      margin: 0;
      padding: 0;
      box-sizing: border-box;
      font-family: "Spartan", sans-serif;
    }





    #logo a {
      text-decoration: none;
      color: #ffff;
      font-family: "Handlee", sans-serif;
      margin-left: -40px;
      margin-right: 100px;


    }

    #header {
      display: flex;
      align-items: center;
      justify-content: space-between;
      padding: 20px 80px;
      background-color: #041e42;
      /*box-shadow: 0 5px 15px  rgba(0, 0, 0, 0.73);*/
      height: 90px;
      left: 0;
      flex-wrap: wrap;
      width: 100%;




    }


    .navbar {
      display: flex;
      align-items: center;
      justify-content: center;
      justify-content: space-around;



    }

    .navbar li {
      list-style: none;
      padding: 0 20px;

    }

    .navbar li a {
      text-decoration: none;
      font-size: 16px;
      font-weight: 600;
      color: white;

    }

    .navbar li a:hover {

      font-size: 18px;

    }

    ul li:hover {
      background-color: #041e42;

    }

    ul li ul.dropdown li {
      display: block;
      color: black;
      margin-bottom: 15px;
      /* margin-top:15 px;*/



    }

    ul.dropdown li a:last-child {
      border: none;
    }

    ul.navbar {
      position: relative;

    }

    ul.navbar li {
      position: relative;
    }

    ul.dropdown {
      width: 100%;
      background: white;
      position: absolute;
      z-index: 99;
      display: none;
      color: black;
      top: 100%;
      width: 150px;
      border-right: 1px solid;



    }

    ul.dropdown li {
      width: 200px;

    }

    /*ul li:hover{
  background-color:#041e42;
  
}*/

    ul li:hover ul.dropdown {
      display: block;

    }

    .dropdown li:hover {
      background-color: #F3EEEA;
      padding: 10px;
    }

    ul.dropdown a {
      color: black;

    }




    .search-box {
      width: 400px;
      background: #fff;
      /*margin: 200px auto 0;*/
      border-radius: 20px;
    }

    .form input {
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

    .dropdown {
      border: 1px solid #555;
    }


    #category {

      padding: 8px;
      /* Adjust padding as needed */
      font-size: 16px;
      /* Adjust font size as needed */
      border: 1px solid #ccc;
      /* Add border for better visibility */
      border-radius: 4px;
      /* Optional: Add border-radius for rounded corners */
    }

    .abc {
      display: flex;
      justify-content: space-between;
    }

    button {
      padding: 8px;
      /* Adjust padding as needed */
      font-size: 16px;
      /* Adjust font size as needed */
      background-color: #fff;
      /* Add your desired background color */
      color: black;
      /* Add your desired text color */
      border: none;
      /* Remove default button border */
      border-radius: 4px;
      /* Optional: Add border-radius for rounded corners */
      cursor: pointer;
      /* Add pointer cursor on hover */

    }

    .product-container {
      display: inline;

    }

    .product-container .imag {
      background-color: #fff;
      border-radius: 8px;
      box-shadow: 0 2px 4px rgba(0, 0, 0, 0.1);
      padding: 20px;
      max-width: 500px;
      width: 50%;
      /* Adjust the width as needed */
    }

    .des {
      padding: 20px;
      max-width: 500px;
      width: 50%;
      /* Adjust the width as needed */
      position: absolute;
      right: -0px;
      top: 0;
      margin-top: 150px;
      padding-left: -1px;
      left: 600px;

    }

    .des .product-image {
      max-width: 100%;
      height: auto;
    }

    .des .product-title {
      font-size: 24px;
      margin: 10px 0;
    }

    .des .product-description {
      font-size: 16px;
      color: #666;
      margin: 10px 0;
    }

    .des .product-price {
      font-size: 20px;
      color: #45D62E;
      margin-bottom: 50px;
    }

    .des .quantity-input {
      width: 50px;
      padding: 5px;
      text-align: center;
      margin-left: 20px;
    }

    .des .order-button {
      display: block;
      width: 100%;
      background-color: #041e42;
      color: #fff;
      border: none;
      border-radius: 4px;
      padding: 10px;
      font-size: 18px;
      cursor: pointer;
      margin-top: 50px;
    }


    #icon {
      font-size: 24px;
      color: #00ff1e;
      margin-left: 10px;
      margin-bottom: 0;
      top: 10px;
    }
  </style>
  <script defer src="https://use.fontawesome.com/releases/v5.15.4/js/all.js"></script>

</head>

<body>
  <section id="header">
    <div class="head">
      <ul class="navbar">
        <h2 id="logo"><a href="homeafter.php">EVARA</a></h2>
        <li>
          <form action="" method="GET" class="form">
            <label for="search_name"></label>
            <input type="text" name="search_name" class="search" placeholder="Search by Name">
        </li>
        <li id='catego'>
          <div class="abc">
            <select name="category" id="category">
              <option value="all">All</option>
              <option value="Clothes">Clothes</option>
              <option value="Shoes">Shoes</option>
              <option value="Accessories">Accessories</option>
            </select>
            <button type="submit">Filter</button>
          </div>
        </li>
        </form>
        <li><a href="shop.php">Shop</a></li>
        <li><a href="about.html">About us</a></li>
        <li><a href="contact.html">contact us</a></li>
        <li><a href="addtocart.php"><i class="fas fa-shopping-bag" style="color: white;"></i>
          </a></li>
        <li><a href="profile.php"><i class="fas fa-user" style="color: #ffffff;"></i></a>
          <ul class="dropdown">
            <li><a href="login.php">log in</a></li>
            <li><a href="UserRegister.php">sign up</a></li>
          </ul>
        </li>
      </ul>
    </div>
  </section>

  <div class="center-body">

    <?php if (isset($products) && is_array($products) && count($products) > 0) : ?>

      <div class="product-container">
        <div class="imag"> <img class="product-image" src="<?php echo $products["image_path"]; ?>" alt="Product Image"></div>
      </div>

      <div class="des">
        <h2 class="product-title"><?php echo $products["name"]; ?></h2>
        <p class="product-price">Catégorie :<?php echo $products["category"]; ?></p>
        <p class="product-description"><?php echo $products["description"]; ?></p>
        <p class="product-price"><?php echo $products["price"]; ?>$</p>
    


        <form action="addtocart.php" method="POST">
          <input type="hidden" name="product_id" value="<?php echo $products["id"]; ?>">
          <input type="hidden" name="product_name" value="<?php echo $products["name"]; ?>">
          <input type="hidden" name="product_price" value="<?php echo $products["price"]; ?>">
          <input type="hidden" name="product_image" value="<?php echo $products["image_path"]; ?>">
          <label for="quantity" id="quantite">Quantité:</label>
          <input class="quantity-input" type="number" id="quantity" name="quantity" value="1" min="1">
          <button type="submit" class="add-to-cart-button" name="add_to_cart">
        <i class="fas fa-cart-plus" style="color: #00ff1e;" id="icon"></i> Add to Cart
    </button>
</form>

      


        <form action="commander.php" method="post">
          <input type="hidden" name="id_products" value="<?php echo $products["id"]; ?>">



          <button class="order-button">Commander</button>
        </form>
      </div>
  </div>
<?php endif; ?>

</body>

</html>