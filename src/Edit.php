<?php
$servername = "127.0.0.1";
$username = "root";
$password = "";
$dbname = "ecommerce";

$conn = new mysqli($servername, $username, $password, $dbname);

// Handle product update
if ($_SERVER['REQUEST_METHOD'] == 'POST') {
    $id = $_POST['id'];
    $name = $_POST['name'];
    $description = $_POST['description'];
    $price = $_POST['price'];
    $category = $_POST['category'];
    $stock = $_POST['stock'];

    $stmt = $conn->prepare("UPDATE products SET name=?, description=?, price=?, category=?, stock=? WHERE id=?");
    $stmt->bind_param("ssdsii", $name, $description, $price, $category, $stock, $id);
    $stmt->execute();
    $stmt->close();
}

// Fetch product details for display
if (isset($_GET['id'])) {
    $stmt = $conn->prepare("SELECT * FROM products WHERE id = ?");
    $stmt->bind_param("i", $_GET['id']);
    $stmt->execute();
    $result = $stmt->get_result();
    $product = $result->fetch_assoc();
    $stmt->close();
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

<form method="POST" action="AffichageProduct.php">
    <input type="hidden" name="id" value="<?php echo $product['id']; ?>">
    
    <label for="name">Name:</label>
    <input type="text" name="name" value="<?php echo $product['name']; ?>" required>
    
    <label for="description">Description:</label>
    <textarea name="description" required><?php echo $product['description']; ?></textarea>
    
    <label for="price">Price:</label>
    <input type="number" name="price" value="<?php echo $product['price']; ?>" required>
    
    <label for="category">Category:</label>
    <input type="text" name="category" value="<?php echo $product['category']; ?>" required>
    
    <label for="stock">Stock:</label>
    <input type="number" name="stock" value="<?php echo $product['stock']; ?>" required>
    
    <button type="submit">Update Product</button>
</form>

</body>
</html>

<?php
// Close the database connection
$conn->close();
?>
