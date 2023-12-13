<?php
session_start();
require("config.php");

$user_id = isset($_SESSION["user_name"]) ? $_SESSION["user_name"] : null;

if ($_SERVER["REQUEST_METHOD"] == "GET" && isset($_GET["id"])) {
    $product_id = $_GET["id"];

    // Utiliser une requête DELETE correcte sans la liste d'éléments
    $deleteQuery = "DELETE FROM cart WHERE id_user = ? AND id_product = ?";
    $stmtDelete = mysqli_prepare($conn, $deleteQuery);

    if ($stmtDelete) {
        mysqli_stmt_bind_param($stmtDelete, "ii", $user_id, $product_id);
        mysqli_stmt_execute($stmtDelete);

        if (mysqli_stmt_affected_rows($stmtDelete) > 0) {
            echo "Product successfully removed from the cart.";
        } else {
            echo "Product not found in the cart or removal failed.";
        }

        mysqli_stmt_close($stmtDelete);
    } else {
        echo "Error in the prepared statement: " . mysqli_error($conn);
    }
} else {
    echo "Product ID not provided.";
}

// Redirect back to the cart page, or any other page you want
header("Location: addtocart.php");
exit();
?>
