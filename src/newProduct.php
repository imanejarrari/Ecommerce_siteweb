<?php
// Connexion à la base de données (à personnaliser avec vos propres informations)
$servername = "votre_serveur_mysql";
$username = "votre_nom_utilisateur_mysql";
$password = "votre_mot_de_passe_mysql";
$dbname = "votre_base_de_donnees";

$conn = new mysqli($servername, $username, $password, $dbname);

// Vérifiez la connexion à la base de données
if ($conn->connect_error) {
    die("La connexion à la base de données a échoué : " . $conn->connect_error);
}

if ($_SERVER["REQUEST_METHOD"] == "POST") {
    // Récupérez les données du formulaire, y compris la catégorie
    $name = $_POST["name"];
    $description = $_POST["description"];
    $price = $_POST["price"];
    $category = $_POST["category"];

    // Gestion de l'upload de l'image
    $target_dir = "uploads/";  // Dossier où vous stockez les images
    $target_file = $target_dir . basename($_FILES["image"]["name"]);
    $uploadOk = 1;
    $imageFileType = strtolower(pathinfo($target_file, PATHINFO_EXTENSION));

    // Vérifiez si le fichier image est une image réelle ou une fausse image
    $check = getimagesize($_FILES["image"]["tmp_name"]);
    if ($check === false) {
        echo "Le fichier n'est pas une image.";
        $uploadOk = 0;
    }

    // Autorisez certains formats de fichiers
    if ($imageFileType != "jpg" && $imageFileType != "png" && $imageFileType != "jpeg"
        && $imageFileType != "gif") {
        echo "Désolé, seuls les fichiers JPG, JPEG, PNG et GIF sont autorisés.";
        $uploadOk = 0;
    }

    // Vérifiez si $uploadOk est défini à 0 à cause d'une erreur
    if ($uploadOk == 1) {
        // Si tout est correct, essayez de télécharger le fichier
        if (move_uploaded_file($_FILES["image"]["tmp_name"], $target_file)) {
            // Insérez le produit dans la base de données avec l'image
            $insert_product_query = "INSERT INTO products (name, description, price, category, image_path) 
                                     VALUES ('$name', '$description', '$price', '$category', '$target_file')";

            if ($conn->query($insert_product_query) === TRUE) {
                echo "Le produit a été ajouté avec succès.";
            } else {
                echo "Erreur d'ajout de produit : " . $conn->error;
            }
        } else {
            echo "Désolé, une erreur s'est produite lors du téléchargement de votre fichier.";
        }
    }
}

// Fermez la connexion à la base de données
$conn->close();
?>
