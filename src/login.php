<?php
$servername = "127.0.0.1";
$username = "root";
$password = "";
$dbname = "ecommerce";

$conn = new mysqli($servername, $username, $password, $dbname);

if ($_SERVER["REQUEST_METHOD"] == "POST") {
    $username = $_POST["username"];
    $password = $_POST["password"];

    // Retrieve the hashed password and isAdmin value
    $get_user_query = "SELECT id, username, password, isAdmin FROM users WHERE username = '$username'";
    $result = $conn->query($get_user_query);

    if ($result->num_rows > 0) {
        // User found in the database
        $user = $result->fetch_assoc();

        // Verify the entered password with the stored hashed password
        if (password_verify($password, $user["password"])) {
            session_start();
            $_SESSION["user_name"] = $user["username"];

            // Redirige vers le tableau de bord approprié en fonction du rôle
            if ($user["isAdmin"]) {
                header("Location: Admin.php");
            } else {
                header("Location: index.php");
            }
            exit();
        } else {
            // Incorrect password, display an error message
            echo "Wrong password, try again";
        }
    } else {
        // User not found, display an error message or redirect to registration
        echo "User not found";
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
   <link rel="stylesheet" href="https://fonts.googleapis.com/css2?family=Handlee:wght@400&display=swap">
</head>
<body>
    <form action="login.php" method="post" class="form-wrapper" >
        <div class="form-side">
            <h2>EVARA</h2>
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
             <a href="UserRegister.php" class="login">sign up</a>
           </div>
         
        </div>
        
        
        
    </form>
</body>
</html>
















































