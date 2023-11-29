<?php

$servername = "127.0.0.1";
$username = "root";
$password = "";
$dbname = "ecommerce";
 $conn=new mysqli($servername,$username,$password,$dbname);
        if ($conn->connect_error) {
          die("La connexion a échoué : " . $conn->connect_error);
        }

    if($_SERVER["REQUEST_METHOD"] == "POST"){
            $username=$_post["username"];
            $email=$_post["email"];
            $password=password_hash($_post["password"],PASSWORD_BCRYPT);

            // Vérifiez si l'utilisateur existe déjà
         $check_user_query = "SELECT id FROM users WHERE username = '$username' OR email = '$email'";
        $result = $conn->query($check_user_query);

        if ($result->num_rows > 0) {
        
            echo "L'utilisateur existe déjà. Veuillez choisir un autre nom d'utilisateur ou utiliser la fonction de récupération de mot de passe.";
        }else{
            //insérer les données dans bdd
             $sql = "INSERT INTO users (username, email,pasword) VALUES ('$username','$email', '$password')";
             if ($conn->query($insert_user_query) === TRUE) {
                // validation
                header("Location: login.php");
                exit();
             }else {
                // erreur d'inscription
                echo "Erreur d'inscription : " . $conn->error;
            }    
        }

    }
    $conn->close();        
?>


