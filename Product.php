<?php 
      $servername = "127.0.0.1";
      $username = "root";
      $password = "";
      $dbname = "ecommerce";
        $conn=new mysqli($servername,$username,$password,$dbname);
           if ($conn->connect_error) {
                die("La connexion a échoué : " . $conn->connect_error);
            }
            if ($_SERVER["REQUEST_METHOD"] == "POST") {
                
                $name = $_POST["name"];
                $description = $_POST["description"];
                $price = $_POST["price"];
                $category = $_POST["category"];

                $target_dir = "pictures/";  // Dossier où vous stockez les images
                $target_file = $target_dir . basename($_FILES["image"]["name"]);
                $uploadOk = 1;
                $imageFileType = strtolower(pathinfo($target_file, PATHINFO_EXTENSION));
            
                
                $check = getimagesize($_FILES["image"]["tmp_name"]);
                if ($check === false) {
                    echo "Le fichier n'est pas une image.";
                    $uploadOk = 0;
                }
                   // Autorisez les formats de fichiers
                 if ($imageFileType != "jpg" && $imageFileType != "png" && $imageFileType != "jpeg"
                  && $imageFileType != "gif") {
                   echo "Désolé, seuls les fichiers JPG, JPEG, PNG et GIF sont autorisés.";
                  $uploadOk = 0;
                }
                if ($uploadOk == 1) {
                    // Si tout est correct, essayez de télécharger le fichier
                    if (move_uploaded_file($_FILES["image"]["tmp_name"], $target_file)) {
                        // Insérez les données
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
 $conn->close();
?>