<?php
session_start();

// Vérifier si l'utilisateur est connecté
if (!isset($_SESSION['id'])) {
    echo "Erreur : La session 'id' n'est pas définie.";
    header('Location: login.php'); // Rediriger vers la page de connexion si l'utilisateur n'est pas connecté
    exit();
}

$user_id = $_SESSION['id'];

// Assurez-vous que la connexion à la base de données est correcte
require_once('config.php');

// Utilisation d'une déclaration préparée
$stmt = $conn->prepare("SELECT * FROM users WHERE id = ?");
$stmt->bind_param("i", $user_id);
$stmt->execute();
$result = $stmt->get_result();

// Vérifier les erreurs de requête SQL
if (!$result) {
    echo "Erreur SQL : " . $conn->error;
    exit();
}

if ($result->num_rows > 0) {
    $user = $result->fetch_assoc();
} else {
    echo "Utilisateur non trouvé.";
    exit();
}

// Fermer la déclaration préparée
$stmt->close();
?>

<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Profil</title>
</head>
<body>
    <h1>Profil  <?php echo htmlspecialchars($user['username']); ?></h1>
    <p>username : <?php echo htmlspecialchars($user['username']); ?></p>
    <p>E-mail : <?php echo htmlspecialchars($user['email']); ?></p>

    <?php
    // Afficher l'image du profil si elle existe
    if (!empty($user['profile_picture'])) {
        echo '<img src="' . htmlspecialchars($user['profile_picture']) . '" alt="Image de profil">';
    } else {
        echo 'No profile picture available';
    }
    ?>

    <a href="edit_profile.php">Edit profile</a>
</body>
</html>
