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
     $get_user_query = "SELECT id, password FROM users WHERE username = '$username' OR email = '$email'";
     $result = $conn->query($get_user_query);
     if ($result->num_rows > 0) {
        // Utilisateur trouvé dans la base de données
        $user = $result->fetch_assoc();
        // Vérifiez le mot de passe saisi avec le mot de passe haché stocké
        if (password_verify($password, $user["password"])){

            session_start();
            $_SESSION["user_name"] = $user["username"];
            header("Location:homeafter.php");
            exit();

        }else {
            // Mot de passe incorrect, affichez un message d'erreur
            echo "Wrong password, try again ";
       }
     }
    }        



  $conn->close();

 ?>
<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <title>Login</title>
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
   <link rel="stylesheet" href="login.css">
</head>
<body>
    <form action="login.php" method="post" class="form-wrapper" >
        <div class="form-side">
            <a href="#" title="Logo"><img src="logo.png" class="logo" alt="Kuro"></a>
                <div class="form-welcome-row">
                    <h1>Sign in with :</h1>
                </div>
                <div class="socials-row">
                    <a href="#" title="Use Google"><img src="google.svg" alt="Google"> </a>
                    <a href="#" title="Use Facebook"><img src="facebook (1).svg" alt="Facebook"></a>
                </div>
                <div class="divider">
                    <div class="divider-line"></div> or <div class="divider-line"></div>
                </div>
            <input type="text" name="username" placeholder="Username" required>
            <input type="password" name="password" placeholder="Password" required>
            <input type="submit" value="Login">

          <div class="footer-links">
             <a href="/password-reset" class="password">Forgotten password?</a>
             <a href="/register" class="login">sign up</a>
           </div>
         
        </div>
        
        
        
    </form>
</body>
</html>
















































