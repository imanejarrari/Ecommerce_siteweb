<?php
$servername = "127.0.0.1";
$username = "root";
$password = "";
$dbname = "ecommerce";

$conn = new mysqli($servername, $username, $password, $dbname);

// Vérifie si l'ID du produit à supprimer est passé en paramètre dans l'URL
if (isset($_GET['id'])) {
    $product_id = $_GET['id'];

    // Requête de suppression du produit avec déclaration préparée
    $delete_product_query = "DELETE FROM products WHERE id = ?";
    $stmt = $conn->prepare($delete_product_query);
    $stmt->bind_param("i", $product_id);

    // Exécution de la requête
    $stmt->execute();

    // Fermeture de la déclaration préparée
    $stmt->close();

    header("Location: AffichageProduct.php");
    exit();
} else {
    // Si l'ID du produit n'est pas spécifié, affichez un message d'erreur
    echo "Product ID not specified..";
}

$conn->close();
?>
