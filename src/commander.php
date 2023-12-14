<?php

$servername = "127.0.0.1";
$username = "root";
$password = "";
$dbname = "ecommerce";

$conn = new mysqli($servername, $username, $password, $dbname);
/*if(!$connected){
	header("Location: login.php");
  }*/
$id = @$_POST["id"];
$query = "SELECT * FROM products WHERE id = ? LIMIT 1";
$stmt = $conn->prepare($query);
$stmt->bind_param("i", $id);
$stmt->execute();
$result = $stmt->get_result();

$produit = $result->fetch_assoc();
$stmt->close();


if (isset($_POST["submit"])) {

    $username = $_POST["username"];
    $adress = $_POST["adress"];
    $code_postal = $_POST["code_postal"];
    $number_phone = $_POST["number_phone"];
    $quantity = intval($_POST["quantity"]);
    $total_amount = intval($_POST["total_amount"]);
    $liv = 1;
    $sql = "INSERT INTO `orders` ( command_id,product_id,user_id, adress, code_postal, number_phone, quantity, total_amount,date_of_delivering, status,username,image_path) VALUES (?, ?, ?, ?, ?, ?, ?, ?, ?)";
    $stmt = $conn->prepare($sql);
    $stmt->bind_param("ssssiiiii", $command_id, $product_id, $user_id, $address, $code_postal, $number_phone,$quantity,$total_amount, $_SESSION["user_id"], $_POST["produit_id"], $status);
    if ($stmt->execute()) {
        header("Location: mescommandes.php");
        exit;
    } else {
        echo "Error: " . $stmt->error;
    }
    $stmt->close();
    $db_con->close();
}

?>
<!DOCTYPE html>
<html>

<head>
    <title>Commander</title>
    <style>
        body {
            font-family: Arial, sans-serif;
            margin: 0;
            padding: 0;
            background-color: #f4f4f4;
        }

        .container {
            max-width: 800px;
            margin: 0 auto;
            padding: 20px;
            background-color: #fff;
            border-radius: 10px;
            box-shadow: 0 2px 4px rgba(0, 0, 0, 0.1);
        }

        h2 {
            text-align: center;
            margin-bottom: 20px;
        }

        form {
            display: flex;
            flex-direction: column;
        }

        label {
            font-weight: bold;
            margin-bottom: 5px;
        }

        input,
        textarea {
            padding: 10px;
            margin-bottom: 15px;
            border: 1px solid #ccc;
            border-radius: 5px;
            font-size: 16px;
        }

        input[type="submit"] {
            background-color: #45D62E;
            color: #fff;
            border: none;
            cursor: pointer;
        }

        input[type="submit"]:hover {
            background-color: #0056b3;
        }

        @media (max-width: 600px) {
            .container {
                padding: 10px;
            }
        }
    </style>
</head>

<body><br><br>
    <div class="container">
        <h2>Commander</h2>
        <form enctype="multipart/form-data" action="" method="post">
            <label for="username">Name :</label><br>
            <input required name="username" type="text"><br>
            <label for="adress">Adress :</label><br>
            <input required name="adress" type="text"><br>
            <label for="adress">Code Postal :</label><br>
            <input required name="code_postal" type="text"><br>
            <label for="adress">Phone_number :</label><br>
            <input required name="number_phone" type="text"><br>
            <label for="adress">Quantity :</label><br>
            <input value="<?php echo isset($_POST["quantity"]) ? $_POST["quantity"] : ''; ?>" name="quantity" type="number"><br>

            <label for="prix">Prix Total ($) :</label><br>
            <?php
            $total_amount=0;
            if (isset($products) && is_array($products)){
                $quantity = intval($_POST["quantity"]);
            $price = intval($products["price"]);
            $total_amount = $quantity * $price;
            }
            ?>

            <input value="<?php echo $total_amount ?>" name="total_amount" type="text"><br>
            <input type="hidden" name="produit_id" value="<?php echo $products["id"]; ?>">
            <input type="submit" name="submit" value="Commander">
        </form>
    </div>
</body>

</html>