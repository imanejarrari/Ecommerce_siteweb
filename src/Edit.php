<?php
$servername = "127.0.0.1";
$username = "root";
$password = "";
$dbname = "ecommerce";

$conn = new mysqli($servername, $username, $password, $dbname);

$id = $_GET["id"];
$query = "SELECT * FROM products WHERE id = ? LIMIT 1";
$stmt = $conn->prepare($query);
$stmt->bind_param("i", $id);
$stmt->execute();
$result = $stmt->get_result();
$article = $result->fetch_assoc();
  $stmt->close();

if(! $article){
 header("Location:mesproduits.php");
}
        if (isset($_POST["submit"])) {
            $nom = $_POST["name"];
            $desc = $_POST["description"];
            $price = $_POST['price'];
            $category = $_POST['category'];
            $stock = $_POST['stock'];
            $id = $_GET["id"];
            $sql = "UPDATE products SET name=?, description=?, price=?, category=?, stock=? WHERE id=?";
            $stmt = $db_con->prepare($sql);
            $stmt->bind_param("ssdsii", $nom, $desc, $price, $category, $stock, $id);
            if ($stmt->execute()) {
                echo "<script>alert('Article a été bien modifié !');</script>";
                header("Location:AffichageProduct.php");
        
            } else {
                echo "Error: " . $db_con->error;
            }
            $stmt->close();
            $db_con->close();

        }
            
            

?>

<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Modify Product</title>
</head>
<body>

<?php if (isset($article)) : ?>

    <form method="POST" enctype="multipart/form-data" action="">
        <input type="hidden" name="id" value="<?php echo $article['id']; ?>">
        <label for="name">Name:</label>
        <input type="text" name="name" value="<?php echo $article['name']; ?>" required>
        
        <label for="description">Description:</label>
        <textarea name="description" required><?php echo $article['description']; ?></textarea>
        
        <label for="price">Price:</label>
        <input type="number" name="price" value="<?php echo $article['price']; ?>" required>
        
        <label for="category">Category:</label>
        <input type="text" name="category" value="<?php echo $article['category']; ?>" required>
        
        <label for="stock">Stock:</label>
        <input type="number" name="stock" value="<?php echo $article['stock']; ?>" required>
        
        <button type="submit" name="submit">Update Product</button>
    </form>

<?php endif; ?>

</body>
</html>

<?php
// Close the database connection
$conn->close();
?>
