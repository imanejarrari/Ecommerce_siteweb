<?php

session_start();
include ("config.php");
$connected = @$_SESSION["admin_connected"] ; 

if(!$connected){
	header("Location: index.php");
  }

if ($_SERVER["REQUEST_METHOD"] == "POST") {
    $username = $_POST["username"];
    $email = $_POST["email"];
    $password = password_hash($_POST["password"], PASSWORD_BCRYPT);

    // Vérifiez si l'utilisateur existe déjà
    $check_user_query = "SELECT id FROM users WHERE username = '$username' OR email = '$email'";
    $result = $conn->query($check_user_query);

    if ($result->num_rows > 0) {
        echo '<div class="erreur">Already you have an account</div>';

    } else {
        // insérer les données dans la base de données
        $sql = "INSERT INTO users (username, email, password) VALUES ('$username', '$email', '$password')";
        if ($conn->query($sql) === TRUE) {
            // validation
            header("Location: homeafter.php");
            exit();
        } else {
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
    <title>Sign Up</title>
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
   <link rel="stylesheet" href="login.css">
   <link rel="stylesheet" href="https://fonts.googleapis.com/css2?family=Handlee:wght@400&display=swap">
   <style>
    .erreur {
        position: absolute;
        top:560px;
        left:730px;
        color: red;
        font-weight: bold;
        text-align: center; /* Pour centrer le message */
    }
</style>
</head>
<body>
    <form action="UserRegister.php" method="post" class="form-wrapper" >
        <div class="form-side">
           <h2>EVARA</h2>
            
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
