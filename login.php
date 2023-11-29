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
     // Récupérez le mot de passe haché   
     $get_user_query = "SELECT id, password FROM users WHERE username = '$username' OR email = '$username'";
     $result = $conn->query($get_user_query);
     if ($result->num_rows > 0) {
        // Utilisateur trouvé dans la base de données
        $user = $result->fetch_assoc();
        // Vérifiez le mot de passe saisi avec le mot de passe haché stocké
        if (password_verify($password, $user["password"])){

            session_start();
            $_SESSION["user_name"] = $user["username"];
            header("Location: home.php");
            exit();

        }else {
            // Mot de passe incorrect, affichez un message d'erreur
            echo "Mot de passe incorrect. Veuillez réessayer.";
       }
     }
    }        



  $conn->close();







 ?>
























