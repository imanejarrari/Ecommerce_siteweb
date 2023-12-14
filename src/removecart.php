<?php
session_start();
require("config.php");

if (isset($_GET["id"])) {
    $product_id = $_GET["id"];

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

            // Remove the product from the cart
            $deleteQuery = "DELETE FROM cart WHERE id_user = ? AND id_product = ?";
            $stmtDelete = mysqli_prepare($conn, $deleteQuery);

            if ($stmtDelete) {
                mysqli_stmt_bind_param($stmtDelete, "ii", $user_id, $product_id);
                mysqli_stmt_execute($stmtDelete);

                mysqli_stmt_close($stmtDelete);
            }
        }

        mysqli_stmt_close($stmtUserId);
    }
}

header("Location: addtocart.php");
exit();
?>
