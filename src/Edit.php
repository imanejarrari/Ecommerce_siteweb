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
 header("Location:AffichageProduct.php");
}
        if (isset($_POST["submit"])) {
            $nom = $_POST["name"];
            $desc = $_POST["description"];
            $price = $_POST['price'];
            $category = $_POST['category'];
            $stock = $_POST['stock'];
            $id = $_GET["id"];
            $sql = "UPDATE products SET name=?, description=?, price=?, category=?, stock=? WHERE id=?";
            $stmt = $conn->prepare($sql);
            $stmt->bind_param("ssdsii", $nom, $desc, $price, $category, $stock, $id);
            if ($stmt->execute()) {
                echo "<script>alert('success!');</script>";
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
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.2.1/css/all.min.css" integrity="sha512-MV7K8+y+gLIBoVD59lQIYicR65iaqukzvf/nwasF0nqhPay5w/9lJmVM2hMDcnK1OnMGCdVK+iQrJ7lzPJQd1w==" crossorigin="anonymous" referrerpolicy="no-referrer" />
    <title>Modify Product</title>
    <style>
        @import url('https://fonts.googleapis.com/css2?family=Poppins:wght@300&display=swap');

* {
    margin: 0;
    padding: 0;
    box-sizing: border-box;
}

.main-container {
    overflow: auto;
    position: fixed;
    width: 100%;
    height:100vh;
    z-index: 3000;
    background-color: white;
}

.left-menu {
    position: fixed;
    width: 13rem;
    height:100vh;
    display: flex;
    background: #041e42;
    flex-direction: column;
    transition: all .4s ease;
}

.menu {
    position: absolute;
    list-style: none;
    color: #041e42;
    z-index: 1200;
    top: 4%;
    right: -20px;
    cursor: pointer;
    font-size: 25px;
    transition: all 0.7s;
    transform: rotate(-90deg);
}

.active {
    transform: rotate(90deg);
}

.left-menu ul li a {
    display: flex;
}

.logo {
    position: relative;
    width: 60px;
    top: 1rem;
    left: 0.5rem;
    display: flex;
    align-items: center;
    margin: 10px 0 0 0px;
    justify-content: center;
}

.logo img {
    width: 100%;
    z-index: 100;
    position: absolute;
    width:30px;
    height:30px;
}

.logo span {
    padding: 10px;
    font-size: 18px;
    font-weight: bold;
    text-transform: uppercase;
}

.logo a {
    position: relative;
    color:white;
    text-align: left;
    font-size: 18px;
    display: table;
    left: 180px;
    width: 300px;
    padding: 10px;
    text-decoration: none;
    font-family: 'Poppins', 'sans-serif';
}

.left-menu ul {
    display: flex;
    margin-top: 2rem;
    overflow: hidden;
    margin-left: 1.5rem;
    flex-direction: column;
    align-items: flex-start;

}

ul li {
    list-style: none;
    align-items: center;
    margin-bottom: 1rem;
    transition: all .3s linear;
    font-family: 'Poppins', sans-serif;
}

ul li a {
    padding: 0.5rem;
    color:white;
    text-decoration: none;
}

ul li a i {
    cursor: pointer;
    color:white;
    font-size: 1.4rem;
    margin-right: 1.2rem;
    text-decoration: none;
    transition: all .3s linear;
}

.sidebar-item i {
    width: 20px;
    height: 20px;
    text-align: center;
}

#settings {
    position: absolute;
    bottom: 1rem;
}
#setting{
    position: absolute;
    bottom:2.5rem;
}
.left-menu ul li:hover {
    transform: translateX(.4rem);
    transition: all .4s linear;
}

.left-menu ul li:hover .fa-solid,
.left-menu ul li:hover a {
    font-weight: bold;
    color: purple;
}  
.form-wrapper {
    display:inline-block;
    justify-content: center;
    align-items: center;
    height:550px;
    position: absolute;
    left:500px;
    top:30px;
   border:1px solid #e9ebee ;
   border-radius:30px;
   background-color:whitesmoke;
} 
.form-wrapper h2{
        margin-left:160px;
        margin-top:20px;
        margin-bottom:20px;
        font-family: 'Lucida Sans';
        color: #041e42;
 }
 input{
        display:flex;
        margin-bottom:30px;
        margin-left:100px;
        margin-right:100px;
        width:300px;
        height:40px;
        padding-left:100px;
        border:0.5px solid black;
        border-radius:20px;
        
 }
textarea{
        display:flex;
        margin-bottom:30px;
        margin-left:100px;
        margin-right:100px;
        width:300px;
        height:40px;
        padding-top:10px;
        padding-right:50px;
        padding-left:50px;
        border-radius:20px;
        overflow: hidden;
 }
.name{
        position: absolute;
        top:90px;
        left:10px;
        color: #041e42;
        font-size:small;
        font-family: 'Lucida Sans';

}
.des{
        position: absolute;
        top:160px;
        left:10px;
        color: #041e42;
        font-size:small;
        font-family: 'Lucida Sans';
}
.price{
        position: absolute;
        top:230px;
        left:10px;
        color: #041e42;
        font-size:small;
        font-family: 'Lucida Sans';
 }
.category{
        position: absolute;
        top:300px;
        left:10px;
        color: #041e42;
        font-size:small;
        font-family: 'Lucida Sans';
}
.stock{
        position: absolute;
        color: #041e42;
        font-size:small;
        font-family: 'Lucida Sans';
        top:370px;
        left:10px;
 }
input[type="submit"] {
    display: inline-block;
    border:1px solid whitesmoke;
    padding-left:10px;
    width:200px;
    height:40px;
    margin-left:150px;
    margin-right:150px;
    color:white;
    background-color: #041e42;
    cursor: pointer;
   
}

input[type="submit"]:hover {
    background-color: rgb(200, 201, 201);
    color: black;

}
    </style>
</head>
<body>
<div class="main-container">
        <div class="left-menu">
            <div class="logo">
                <span class="logoLink"><a href="">EVARA</a></span>
            </div>
            <li class="menu"><i class="fa-sharp fa-solid fa-circle-chevron-down"></i></li>
            <ul>
                <li class="sidebar-item"><a class="sidebar-link" href="#"><i class="fa-solid fa-house"></i> Dashbord </a>
                </li>
                <li class="sidebar-item"><a class="sidebar-link" href="user.php"><i class="fa-solid fa-user"></i>All Users </a>
                </li>
                <li class="sidebar-item"><a class="sidebar-link" href="AffichageProduct.php"><i class="fa-brands fa-product-hunt" style="color: #ffffff;"></i> All Products</a>
                </li>
                <li class="sidebar-item"><a class="sidebar-link" href="newProduct.php"><i class="fa-solid fa-shirt" style="color: #fcfcfc;"></i>New product</a>
                </li>
                <li class="sidebar-item"><a class="sidebar-link" href="order.php"><i class="fa-solid fa-bag-shopping" style="color: #ffffff;"></i>All Orders </a>
                </li>
                <li class="sidebar-item" id="settings"><a id="settings" class="sidebar-link" href="#"><i class="fa-solid fa-gear"></i>Settings </a>           </li>
            </ul>
        </div>
    

<?php if (isset($article)) : ?>

    <form method="POST" enctype="multipart/form-data" class="form-wrapper" action="">
          <h2>Modify Product</h2>
        <input type="hidden" name="id" value="<?php echo $article['id']; ?>">
        <label for="name" class="name">Title:</label>
        <input type="text" name="name" placeholder="Title of the product" value="<?php echo $article['name']; ?>" required>
        
        <label for="description" class="des">Description:</label>
        <textarea name="description" placeholder="Description of the product" required><?php echo $article['description']; ?></textarea>
        
        <label for="price" class="price">Price:</label>
        <input type="number" name="price" placeholder="Price of the product" value="<?php echo $article['price']; ?>" required>
        
        <label for="category" class="category">Category:</label>
        <input type="text" name="category" placeholder="Category of the product" value="<?php echo $article['category']; ?>" required>
        
        <label for="stock" class="stock">Stock:</label>
        <input type="number" name="stock" placeholder="Stock of the product" value="<?php echo $article['stock']; ?>" required>
        
        <input type="submit" name="submit" class="button" value="Update Product">
    </form>

<?php endif; ?>

</body>
</html>

<?php
// Close the database connection
$conn->close();
?>
