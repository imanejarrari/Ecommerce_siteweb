<?php
session_start();
require("config.php");

$user_id = isset($_SESSION["user_name"]) ? $_SESSION["user_name"] : null;

$sql = "SELECT image_path FROM products WHERE id IN (44, 51,50,53,14,13,19,22)";
$result = $conn->query($sql);


if ($result->num_rows > 0) {

  $row = $result->fetch_assoc();
  $image_path = $row["image_path"];
} else {
  echo "No results found";
}




// Close the database connection
//$conn->close();

?>


















<!DOCTYPE html>
<html lang="en">

<head>


  <meta charset="UTF-8">
  <meta name="viewport" content="width=device-width, initial-scale=1.0">
  <title>EVARA</title>
  <script src="script.js"></script>
  <link rel="stylesheet" href="https://fonts.googleapis.com/css2?family=Handlee:wght@400&display=swap">

  <script defer src="https://use.fontawesome.com/releases/v5.15.4/js/all.js"></script>
  <link rel="stylesheet" href="home.css">

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
  </section>

  <section id="hero">
    <div id="lktba">
      <h4>Trade-in-offer</h4>
      <h2>Super value deals</h2>
      <h1>On all products</h1>
      <p>Save more with coupons & up 70% off</p>
      <button id="shop"><a href="shop.php"> Shop Now</a></button>
    </div>

    <!--<div class="img">
      <img class="g" src="lovepik-fashion-model-shopping-picture_501399540-removebg-preview.png">
    </div>-->
  </section>

  <section id="feauture" class="section-p1">
    <div class="fe-box">
      <img src="f1.png" width="500px">
      <h6 id="c0">free shipement </h6>
    </div>
    <div class="fe-box">
      <img src="f2.png" width="500px">
      <h6 id="c1">Online Order </h6>
    </div>
    <div class="fe-box">
      <img src="f3.png" width="500px">
      <h6 id="c2">Save Money </h6>
    </div>
    <div class="fe-box">
      <img src="f4.png" width="500px">
      <h6 id="c3">Promotions </h6>
    </div>
    <div class="fe-box">
      <img src="f5.png" width="500px">
      <h6 id="c4">Happy Sell </h6>
    </div>
    <div class="fe-box">
      <img src="f6.png" width="500px">
      <h6 id="c5">F24/7 Support </h6>
    </div>

  </section>
  <section id="product1" class="section-p1">
    <div id='up'>
      <h2>feauture Products</h2>
      <p>winter Collection New Modern Design</p>
    </div>
    <div id="rows">
      <div class="item-container">
        <div class="main-item">
          <img src="getImage.php?id=44" alt="Product Image 1">
          <h2 class="item-heading">
            CABLE TRIM CHUNKY<br> HAND KNIT CARDIGAN
          </h2>
          <p class="item-description">
            Lorem ipsum dolor sit amet consectetur adipisicing elit. Reprehenderit labore quae quaerat eaque.
          </p>
          <ul class="rating">
            <i class="fas fa-star" style="color: #fff70f;"></i>
            <i class="fas fa-star" style="color: #fff70f;"></i>
            <i class="fas fa-star" style="color: #fff70f;"></i>
            <i class="fas fa-star" style="color: #fff70f;"></i>
            <i class="fas fa-star" style="color: #fff70f;"></i>

          </ul>
          <p class="item-price"><sup>$</sup>40.00/-</p>
          <button class="item-cart-btn">Add To Cart</button>
        </div>



        <div class="item-container">
          <div class="main-item">
            <img src="getImage.php?id=51" alt="Product Image 1">
            <h2 class="item-heading">
              WANZ Denim Pants women Hip hop
            </h2>
            <p class="item-description">
              Lorem ipsum dolor sit amet consectetur adipisicing elit. Reprehenderit labore quae quaerat eaque.
            </p>
            <ul class="rating">
              <i class="fas fa-star" style="color: #fff70f;"></i>
              <i class="fas fa-star" style="color: #fff70f;"></i>
              <i class="fas fa-star" style="color: #fff70f;"></i>
              <i class="fas fa-star" style="color: #fff70f;"></i>
              <i class="fas fa-star" style="color: #fff70f;"></i>

            </ul>
            <p class="item-price"><sup>$</sup>11.00/-</p>
            <button class="item-cart-btn">Add To Cart</button>
          </div>

          <div class="item-container">
            <div class="main-item">
              <img src="getImage.php?id=50" alt="Product Image 1">
              <h2 class="item-heading">
                CABLE TRIM CHUNKY<br> HAND KNIT CARDIGAN
              </h2>
              <p class="item-description">
                Lorem ipsum dolor sit amet consectetur adipisicing elit. Reprehenderit labore quae quaerat eaque.
              </p>
              <ul class="rating">
                <i class="fas fa-star" style="color: #fff70f;"></i>
                <i class="fas fa-star" style="color: #fff70f;"></i>
                <i class="fas fa-star" style="color: #fff70f;"></i>
                <i class="fas fa-star" style="color: #fff70f;"></i>
                <i class="fas fa-star" style="color: #fff70f;"></i>

              </ul>
              <p class="item-price"><sup>$</sup>40.00/-</p>
              <button class="item-cart-btn">Add To Cart</button>
            </div>

            <div class="item-container">
              <div class="main-item">
                <img src="getImage.php?id=53" alt="Product Image 1">
                <h2 class="item-heading">
                  CABLE TRIM CHUNKY<br> HAND KNIT CARDIGAN
                </h2>
                <p class="item-description">
                  Lorem ipsum dolor sit amet consectetur adipisicing elit. Reprehenderit labore quae quaerat eaque.
                </p>
                <ul class="rating">
                  <i class="fas fa-star" style="color: #fff70f;"></i>
                  <i class="fas fa-star" style="color: #fff70f;"></i>
                  <i class="fas fa-star" style="color: #fff70f;"></i>
                  <i class="fas fa-star" style="color: #fff70f;"></i>
                  <i class="fas fa-star" style="color: #fff70f;"></i>

                </ul>
                <p class="item-price"><sup>$</sup>40.00/-</p>
                <button class="item-cart-btn">Add To Cart</button>
              </div>

            </div>



  </section>
  <section id="banner" class="section-m1">
    <h4>Repair Services</h4>
    <h2>Up to<span>70% off</span> - All Clothes & Accessories</h2>
    <button class="normal">Explore More</button>

  </section>

  <section id="product2" class="section-p1">
    <div class="item-container">















      <div class="main-item">
        <img src="getImage.php?id=14" alt="Product Image 1">
        <h2 class="item-heading">
          CABLE TRIM CHUNKY<br> HAND KNIT CARDIGAN
        </h2>
        <p class="item-description">
          Lorem ipsum dolor sit amet consectetur adipisicing elit. Reprehenderit labore quae quaerat eaque.
        </p>
        <ul class="rating">
          <i class="fas fa-star" style="color: #fff70f;"></i>
          <i class="fas fa-star" style="color: #fff70f;"></i>
          <i class="fas fa-star" style="color: #fff70f;"></i>
          <i class="fas fa-star" style="color: #fff70f;"></i>
          <i class="fas fa-star" style="color: #fff70f;"></i>

        </ul>
        <p class="item-price"><sup>$</sup>40.00/-</p>
        <button class="item-cart-btn">Add To Cart</button>
      </div>

      <div class="item-container">
        <div class="main-item">
          <img src="getImage.php?id=19" alt="Product Image 1">
          <h2 class="item-heading">
            CABLE TRIM CHUNKY<br> HAND KNIT CARDIGAN
          </h2>
          <p class="item-description">
            Lorem ipsum dolor sit amet consectetur adipisicing elit. Reprehenderit labore quae quaerat eaque.
          </p>
          <ul class="rating">
            <i class="fas fa-star" style="color: #fff70f;"></i>
            <i class="fas fa-star" style="color: #fff70f;"></i>
            <i class="fas fa-star" style="color: #fff70f;"></i>
            <i class="fas fa-star" style="color: #fff70f;"></i>
            <i class="fas fa-star" style="color: #fff70f;"></i>

          </ul>
          <p class="item-price"><sup>$</sup>40.00/-</p>
          <button class="item-cart-btn">Add To Cart</button>
        </div>

        <div class="item-container">
          <div class="main-item">
            <img src="getImage.php?id=13" alt="Product Image 1">
            <h2 class="item-heading">
              CABLE TRIM CHUNKY<br> HAND KNIT CARDIGAN
            </h2>
            <p class="item-description">
              Lorem ipsum dolor sit amet consectetur adipisicing elit. Reprehenderit labore quae quaerat eaque.
            </p>
            <ul class="rating">
              <i class="fas fa-star" style="color: #fff70f;"></i>
              <i class="fas fa-star" style="color: #fff70f;"></i>
              <i class="fas fa-star" style="color: #fff70f;"></i>
              <i class="fas fa-star" style="color: #fff70f;"></i>
              <i class="fas fa-star" style="color: #fff70f;"></i>

            </ul>
            <p class="item-price"><sup>$</sup>40.00/-</p>
            <button class="item-cart-btn">Add To Cart</button>
          </div>

          <div class="item-container">
            <div class="main-item">
              <img src="getImage.php?id=22" alt="Product Image 1">
              <h2 class="item-heading">
                CABLE TRIM CHUNKY<br> HAND KNIT CARDIGAN
              </h2>
              <p class="item-description">
                Lorem ipsum dolor sit amet consectetur adipisicing elit. Reprehenderit labore quae quaerat eaque.
              </p>
              <ul class="rating">
                <i class="fas fa-star" style="color: #fff70f;"></i>
                <i class="fas fa-star" style="color: #fff70f;"></i>
                <i class="fas fa-star" style="color: #fff70f;"></i>
                <i class="fas fa-star" style="color: #fff70f;"></i>
                <i class="fas fa-star" style="color: #fff70f;"></i>

              </ul>
              <p class="item-price"><sup>$</sup>40.00/-</p>
              <button class="item-cart-btn">Add To Cart</button>
            </div>




  </section>

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