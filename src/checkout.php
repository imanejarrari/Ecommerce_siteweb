<?php

session_start();

$servername = "127.0.0.1";
$username = "root";
$password = "";
$dbname = "ecommerce";

$conn = new mysqli($servername, $username, $password, $dbname);

require_once('TCPDF/tcpdf.php');
require_once('TCPDF/include/tcpdf_font_data.php');



if (isset($_SESSION['user_name']) && !empty($_SESSION['user_name'])) {
    $username = $_SESSION['user_name'];

    // Fetch the user ID using the username
    $selectUserIdQuery = "SELECT id FROM users WHERE username = ?";
    $stmtUserId = mysqli_prepare($conn, $selectUserIdQuery);

    if ($stmtUserId) {
        mysqli_stmt_bind_param($stmtUserId, "s", $username);
        mysqli_stmt_execute($stmtUserId);

        $resultUserId = mysqli_stmt_get_result($stmtUserId);
        $rowUserId = mysqli_fetch_assoc($resultUserId);

        if ($rowUserId) {
            $user_id = $rowUserId["id"];
            
            $totalQuantityQuery = "SELECT SUM(quantity) AS total_quantity
                                FROM cart
                                WHERE id_user = ?";
            $stmtTotalQuantity = mysqli_prepare($conn, $totalQuantityQuery);

            if ($stmtTotalQuantity) {
                mysqli_stmt_bind_param($stmtTotalQuantity, "i", $user_id);
                mysqli_stmt_execute($stmtTotalQuantity);

                $resultTotalQuantity = mysqli_stmt_get_result($stmtTotalQuantity);
                $rowTotalQuantity = mysqli_fetch_assoc($resultTotalQuantity);

                $total_quantity = $rowTotalQuantity["total_quantity"];

                mysqli_stmt_close($stmtTotalQuantity);
            } else {
                echo 'Error in the prepared statement for total quantity';
            }

            // Calculate total price with SQL
            $totalPriceQuery = "SELECT SUM(c.quantity * p.price) AS total_price
            FROM cart c
            JOIN products p ON c.id_product = p.id
            WHERE c.id_user = ?";
            $stmtTotalPrice = mysqli_prepare($conn, $totalPriceQuery);

            if ($stmtTotalPrice) {
                mysqli_stmt_bind_param($stmtTotalPrice, "i", $user_id);
                mysqli_stmt_execute($stmtTotalPrice);

                $resultTotalPrice = mysqli_stmt_get_result($stmtTotalPrice);
                $rowTotalPrice = mysqli_fetch_assoc($resultTotalPrice);

                $totalCartPrice = $rowTotalPrice["total_price"];

                mysqli_stmt_close($stmtTotalPrice);
            } else {
                echo 'Error in the prepared statement for total price';
            }

            if ($_SERVER["REQUEST_METHOD"] == "POST" && isset($_POST["validate"])) {
                // Collect form data
                $user_name = $_POST["user_name"];
                $code_postal = $_POST["code_postal"];
                $address = $_POST["address"];
                $number_phone = $_POST["number_phone"];

                $sql = "INSERT INTO orders (user_id, username, code_postal, adresse, number_phone, quantity, total_amount) 
                VALUES ('$user_id', '$user_name', '$code_postal', '$address', '$number_phone', '$total_quantity', '$totalCartPrice')";
                // Generate PDF with order information
                $pdf = new TCPDF(PDF_PAGE_ORIENTATION, PDF_UNIT, PDF_PAGE_FORMAT, true, 'UTF-8', false);


                // Set document information
                $pdf->SetCreator(PDF_CREATOR);
                $pdf->SetAuthor('Your Name');
                $pdf->SetTitle('Order Invoice');
                $pdf->SetSubject('Order Invoice');
                $pdf->SetKeywords('Order, TCPDF, PHP');

                // Remove default header/footer
                $pdf->setPrintHeader(false);
                $pdf->setPrintFooter(false);

                // Add a page
                $pdf->AddPage();

                // Set font
                $pdf->SetFont('times', 'N', 12);

                // Add order information to the PDF
            

                $pdf->writeHTML(" <h1> Welcomme to EVARA </h1> <br> ");
                $pdf->writeHTML("<h2> your order Information</h2> <br>");
                $pdf->writeHTML("<p> <br> User Name </br>: $user_name</p> <br>");
                $pdf->writeHTML("<p> <br> Code Postal </br> : $code_postal</p> <br>");
                $pdf->writeHTML("<p> <br> Address </br> : $address</p> <br>");
                $pdf->writeHTML("<p> <br> Phone Number </br>: $number_phone</p> <br>");
                $pdf->writeHTML("<p> <br> Total Quantity </br>: $total_quantity</p> <br>");
                $pdf->writeHTML("<p><br> Total Amount </br> : $totalCartPrice $</p> <br>");
                $pdf->writeHTML("");
                $pdf->writeHTML(" <h3> Thank you for your order! Please make the payment by the due date.</h3>");
                // Save PDF to a file (optional)
                $pdf->Output('invoice.pdf', 'D'); // 'D' means force download

                // Note: You can also use $pdf->Output('filename.pdf', 'I') to open the PDF in the browser instead of downloading.

                header("location:homeafter.php");
            }
        } else {
            echo 'User not found.';
        }

        mysqli_stmt_close($stmtUserId);
    } else {
        echo 'Error in the prepared statement';
    }
} else {
    // Redirect to the login page or perform other actions as needed
    header("Location: login.php");
    exit();
}
?>

<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Checkout</title>

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

#logo  a{
text-decoration: none;
color: #ffff;
font-family: "Handlee",sans-serif;
margin-left: 50px;
margin-right: 100px;
position: relative;
bottom:30px;

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
/*position: fixed;*/
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
/*margin-right: -550px;*/
margin-left: -500;
padding-top: 10px;
  


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
/*width: 100%;*/
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
margin-bottom: 20px;
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
height: 30px;
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
padding-top: 10px;
}
h2{
    margin-top: 50px;
    text-align: center;
}

        form {
            margin-top: 30px;
            display: flex;
            flex-direction: column;
            margin-left: 100px;
        }

        label {
            font-weight: bold;
            margin-bottom: 5px;
        }

        input,
        textarea {
            width: 500px;
            padding: 10px;
            margin-bottom: 15px;
            border: 1px solid #ccc;
            border-radius: 5px;
            font-size: 16px;
        }

        input[type="submit"] {
            background-color: #45D62E;
            width: 200px;
            color: #fff;
            border: none;
            cursor: pointer;
            justify-content: center;
        }

        input[type="submit"]:hover {
            background-color: #45D62E;
        }

        @media (max-width: 600px) {
            .container {
                padding: 10px;
            }
        }
        #des{
            margin-top: 10px;
            margin-bottom: 20px;
        }

       
    </style>
</head>

<body>

<section id="header">

    <div class="head">
      <ul class="navbar">
        <h2 id="logo"><a href="index.php" id="evara">EVARA</a></h2>
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
        <li><a href="cart.php"><i class="fas fa-shopping-bag" style="color: white;"></i></a></li>
        <li><a href="profile.php"><i class="fas fa-user" style="color: #ffffff;"></i></a>
          <ul class="dropdown">
            <li><a href="login.php">log in</a></li>
            <li><a href="UserRegister.php">sign up</a></li>
          </ul> 
        </li>
    </ul>
    </div>
    
    </section>
    <div>
        <h2>Checkout</h2>
        <form method="post" action="">
            <label for="user_name">Name:</label>
            <input type="text" name="user_name" required>

            <label for="code_postal">Code Postal:</label>
            <input type="text" name="code_postal" required>

            <label for="address">Address:</label>
            <textarea name="address" required></textarea>

            <label for="number_phone">Phone Number:</label>
            <input type="text" name="number_phone" required>

            <div>
                <strong>Total Quantity:</strong> <?php echo $total_quantity; ?><br>
                <strong>Total Amount:</strong> <?php echo $totalCartPrice; ?>$
            </div>

            <input type="submit" name="validate" value="Validate">
        </form>
    </div>
</body>

</html>