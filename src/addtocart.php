<?php
session_start();

require("config.php");

$totalCartPrice = 0;
if ($_SERVER["REQUEST_METHOD"] == "POST" && isset($_POST["add_to_cart"])) {
    $product_id = $_POST["product_id"];
    $quantity = $_POST["quantity"];

    // Fetch the user ID using the username from the session
    $username = isset($_SESSION["user_name"]) ? $_SESSION["user_name"] : null;

    $selectUserIdQuery = "SELECT id FROM users WHERE username = ?";
    $stmtUserId = mysqli_prepare($conn, $selectUserIdQuery);

    if ($stmtUserId) {
        mysqli_stmt_bind_param($stmtUserId, "s", $username);
        mysqli_stmt_execute($stmtUserId);
        
        $resultUserId = mysqli_stmt_get_result($stmtUserId);
        $rowUserId = mysqli_fetch_assoc($resultUserId);

        if ($rowUserId) {
            $user_id = $rowUserId["id"];

            // Fetch the price from the "products" table
            $selectQuery = "SELECT price FROM products WHERE id = ?";
            $stmtSelect = mysqli_prepare($conn, $selectQuery);

            if ($stmtSelect) {
                mysqli_stmt_bind_param($stmtSelect, "i", $product_id);
                mysqli_stmt_execute($stmtSelect);

                $result = mysqli_stmt_get_result($stmtSelect);
                $row = mysqli_fetch_assoc($result);

                if ($row) {
                    $product_price = $row["price"];
                    $total_price = $product_price * $quantity;

                    // Insert the data into the "cart" table
                    $insertQuery = "INSERT INTO cart (id_user, id_product, quantity, price) VALUES (?, ?, ?, ?) 
                                    ON DUPLICATE KEY UPDATE quantity = quantity + VALUES(quantity)";

                    $stmtInsert = mysqli_prepare($conn, $insertQuery);

                    if ($stmtInsert) {
                        mysqli_stmt_bind_param($stmtInsert, "iiid", $user_id, $product_id, $quantity, $total_price);
                        $insertResult = mysqli_stmt_execute($stmtInsert);
                        mysqli_stmt_close($stmtInsert);

                        if ($insertResult) {
                            
                        } else {
                            echo 'error: ' . mysqli_error($conn);
                        }
                    } else {
                        echo 'error in the prepared statement';
                    }
                } else {
                    echo 'Product not found.';
                }

                mysqli_stmt_close($stmtSelect);
            } else {
                echo 'error in the prepared statement';
            }
        } else {
            echo 'User not found.';
        }

        mysqli_stmt_close($stmtUserId);
    } else {
        echo 'error in the prepared statement';
   }
 header("location:shop.php");
  }


?>
<!DOCTYPE html>
<html lang="en">

<head>
  <meta charset="UTF-8">
  <meta name="viewport" content="width=device-width, initial-scale=1.0">
  <title>Shopping Cart</title>
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
  <link rel="stylesheet" href="addtocart.css">
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
            <li><a href="profile.php">log in</a></li>
            <li><a href="logout.php">sign up</a></li>
          </ul>
        </li>
      </ul>
    </div>
  </section>

  <section id="cart" class="section-p1">
    <form action="" method="post">
    
    <table width=100%>
      <thead>
        <tr id="hed">
          <td>Products</td>
          <td>Name</td>
          <td>Price</td>
          <td>Quantity</td>
          <td>Subtotal</td>
          <td>Remove</td>
        </tr>
      </thead>
      <tbody>
        
      <?php
// ...

$user_id = null; // Initialize user ID

// Check if the user is logged in
if (isset($_SESSION["user_name"])) {
    // Fetch the user ID using the username from the session
    $username = $_SESSION["user_name"];

    $selectUserIdQuery = "SELECT id FROM users WHERE username = ?";
    $stmtUserId = mysqli_prepare($conn, $selectUserIdQuery);

    if ($stmtUserId) {
        mysqli_stmt_bind_param($stmtUserId, "s", $username);
        mysqli_stmt_execute($stmtUserId);

        $resultUserId = mysqli_stmt_get_result($stmtUserId);
        $rowUserId = mysqli_fetch_assoc($resultUserId);

        if ($rowUserId) {
            $user_id = $rowUserId["id"];
        }

        mysqli_stmt_close($stmtUserId);
    }
}

// Fetch data from the "cart" table, including the product's image path and calculate the total price
$query = "SELECT c.*, p.image_path, (c.quantity * p.price) AS total_price, p.name
          FROM cart c
          JOIN products p ON c.id_product = p.id
          WHERE c.id_user = ?";

$stmt = mysqli_prepare($conn, $query);

if ($stmt) {
    mysqli_stmt_bind_param($stmt, "i", $user_id);
    mysqli_stmt_execute($stmt);

    $result = mysqli_stmt_get_result($stmt);

    // Check if the cart is not empty
    if ($result && mysqli_num_rows($result) > 0) {
        $totalCartPrice = 0;

        while ($row = mysqli_fetch_assoc($result)) {
            // Display cart items
            ?>
            <tr>
                <td><img src='<?php echo $row['image_path']; ?>' alt='<?php echo $row['name']; ?>' id='imag'></td>
                <td><h3><?php echo $row['name']; ?></h3></td>
                <td><?php echo $row['price'] ; ?>$</td>
                <td><?php echo $row['quantity'] ; ?></td>
                <td><?php echo $row['total_price']; ?>$</td>
                <td><a href='removecart.php?id=<?php echo $row['id_product']; ?>'>Remove</a></td>
            </tr>
            <?php

            // Accumulate the total price for each product
            $totalCartPrice += $row['total_price'];
        }
    }

    mysqli_stmt_close($stmt);
}

       
?>
    
    

</tbody>
</table>


<p class='total-amount' id='total'>Total amount: <?php echo "$totalCartPrice $"; ?></p>

<button  type="submit" class="check" name="checkout">Chechout</button>
</form>

</body>

</html>