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


<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <title>Login 03</title>
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
   <link rel="stylesheet" href="login.css">
</head>
<body>
    <form action="login.php" method="post" class="form-wrapper" >
        <div class="form-side">
            <a href="#" title="Logo"><img src="logo.png" class="logo" alt="Kuro"></a>
                <div class="form-welcome-row">
                    <h1>Sign up with :</h1>
                </div>
                <div class="socials-row">
                    <a href="#" title="Use Google"><img src="google.svg" alt="Google"> </a>
                    <a href="#" title="Use Facebook"><img src="facebook (1).svg" alt="Facebook"></a>
                </div>
                <div class="divider">
                    <div class="divider-line"></div> or <div class="divider-line"></div>
                </div>
            <input type="text" name="username" placeholder="username" required>
            <input type="text" name="email" placeholder="E-mail" required>
            <input type="password" name="password" placeholder="Password" required>
            <input type="submit" value="Sign Up">

          <div class="footer-links">
          <a href="login.php" class="have">Already have an account</a>
           </div>
         
        </div>
        
        
        
    </form>
</body>
</html>
