<?php

$servername = "127.0.0.1";
$username = "root";
$password = "";
 $dbname = "ecommerce";

$conn = new mysqli($servername, $username, $password, $dbname);

if ($conn->connect_error) {
    die("La connexion à la base de données a échoué : " . $conn->connect_error);
}

// Récupérez la catégorie à afficher 
$category = isset($_GET['category']) ? $_GET['category'] : '';

// sélectionner les produits d'une catégorie spécifique
$select_products_query = "SELECT * FROM products WHERE category = '$category'";
$result = $conn->query($select_products_query);
?>

<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Produits - <?php echo $category; ?></title>
</head>
<body>
    <h2>Produits - <?php echo $category; ?></h2>

    <?php
    // Affichez chaque produit avec une image et un bouton d'achat
    while($row = $result->fetch_assoc()) {
        echo "<div>";
        echo "<h3>" . $row["name"] . "</h3>";
        echo "<p>" . $row["description"] . "</p>";
        echo "<p>Prix: $" . $row["price"] . "</p>";
        echo '<img src="' . $row["image_path"] . '" alt="' . $row["name"] . '">';
        echo '<form method="post" action="process_purchase.php">';
        echo '<input type="hidden" name="product_id" value="' . $row["id"] . '">';
        echo '<input type="submit" value="Acheter">';
        echo '</form>';
        echo "</div>";
    }
    ?>

    <?php
    // Fermez la connexion à la base de données
    $conn->close();
    ?>
</body>
</html>
