<?php
// Connexion à la base de données (à personnaliser avec vos propres informations)
$servername = "127.0.0.1";
$username = "root";
$password = "";
$dbname = "ecommerce";
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
<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title> Sidebar Menu </title>
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.2.1/css/all.min.css" integrity="sha512-MV7K8+y+gLIBoVD59lQIYicR65iaqukzvf/nwasF0nqhPay5w/9lJmVM2hMDcnK1OnMGCdVK+iQrJ7lzPJQd1w==" crossorigin="anonymous" referrerpolicy="no-referrer" />
        <link rel="stylesheet" href="admin.css">
</head>
<body>
    
    <div class="main-container">
        <div class="left-menu">
            <div class="logo">
                <span class="logoLink"><a href="">EVARA</a></span>
            </div>
            <li class="menu"><i class="fa-sharp fa-solid fa-circle-chevron-down"></i></li>
            <ul>
                <li class="sidebar-item"><a class="sidebar-link" href="#"><i class="fa-solid fa-house"></i> Dashbord </a>
                </li>
                <li class="sidebar-item"><a class="sidebar-link" href="#"><i class="fa-solid fa-user"></i> Users </a>
                </li>
                <li class="sidebar-item"><a class="sidebar-link" href="#"><i class="fa-brands fa-product-hunt" style="color: #ffffff;"></i> All Products</a>
                </li>
                <li class="sidebar-item"><a class="sidebar-link" href="newProduct.php"><i class="fa-solid fa-shirt" style="color: #fcfcfc;"></i>New product</a>
                </li>
                <li class="sidebar-item"><a class="sidebar-link" href="#"><i class="fa-solid fa-bag-shopping" style="color: #ffffff;"></i>Orders </a>
                </li>
                <li class="sidebar-item"><a class="sidebar-link" href="#"><i class="fa-solid fa-chart-simple" style="color: #ffffff;"></i>
                     Sales Statistics </a></li>
                     <li class="sidebar-item" id="setting"><a href="#" id="setting" class="sidebar-link"><i class="fa-regular fa-circle-user" style="color: #ffffff;"></i></a></li>
                <li class="sidebar-item" id="settings"><a id="settings" class="sidebar-link" href="#"><i class="fa-solid fa-gear"></i></a>
                <li>
            </ul>
        </div>
         
        

<form action="newProduct.php" method="POST" class="form-wrapper">
    <label for="name">Product Name:</label>
    <input type="text" name="name" placeholder="Please enter the title of this product" required ><br>

    <label for="description">Description:</label>
    <textarea name="description" placeholder="Please enter the description of this product " required></textarea><br>

    <label for="price">Price:</label>
    <input type="number" name="price" step="0.01"placeholder="please enter the price of this product" required><br>

    <label for="category">Category:</label>
    <input type="text" name="category" placeholder="please enter the category of this product" required><br>

    <label for="image_path">Image Product:</label>
    <input type="file" name="image" accept="image/*" required><br>

    <input type="submit" value="Add Product">
</form>

</body>
<script src="admin.js"></script>

</html>