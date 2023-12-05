<?php
$servername = "127.0.0.1";
$username = "root";
$password = "";
$dbname = "ecommerce";

$conn = new mysqli($servername, $username, $password, $dbname);

// Recherche par nom
$search_name = isset($_GET['search_name']) ? $_GET['search_name'] : '';
$search_category = isset($_GET['search_category']) ? $_GET['search_category'] : '';

// Filtrage par catégorie
$filter_category = isset($_GET['filter_category']) ? $_GET['filter_category'] : '';

// Requête pour récupérer les produits
$select_products_query = "SELECT * FROM products WHERE 
                         (name LIKE '%$search_name%') AND
                         ('$filter_category' = '' OR category = '$filter_category')";
$result = $conn->query($select_products_query);
?>

<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Product Management</title>
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.2.1/css/all.min.css" integrity="sha512-MV7K8+y+gLIBoVD59lQIYicR65iaqukzvf/nwasF0nqhPay5w/9lJmVM2hMDcnK1OnMGCdVK+iQrJ7lzPJQd1w==" crossorigin="anonymous" referrerpolicy="no-referrer" />
    <link rel="stylesheet" href="affichage.css">
</head>

<body>
<div class="main-container">
        <div class="left-menu">
            <div class="logo">
                <span class="logoLink"><a href="">EVARA</a></span>
            </div>
            <li class="menu"><i class="fa-sharp fa-solid fa-circle-chevron-down"></i> </li>
            <ul>
                <li class="sidebar-item"><a class="sidebar-link" href="#"><i class="fa-solid fa-house"></i> Dashbord </a>
                </li>
                <li class="sidebar-item"><a class="sidebar-link" href="user.php"><i class="fa-solid fa-user"></i>All Users </a>
                </li>
                <li class="sidebar-item"><a class="sidebar-link" href="AffichageProduct.php"><i class="fa-brands fa-product-hunt" style="color: #ffffff;"></i> All Products</a>
                </li>
                <li class="sidebar-item"><a class="sidebar-link" href="newProduct.php"><i class="fa-solid fa-shirt" style="color: #fcfcfc;"></i>New product</a>
                </li>
                <li class="sidebar-item"><a class="sidebar-link" href="order.php"><i class="fa-solid fa-bag-shopping" style="color: #ffffff;"></i> All Orders </a>
                </li>
                <li class="sidebar-item"><a class="sidebar-link" href="#"><i class="fa-solid fa-chart-simple" style="color: #ffffff;"></i>
                     Sales Statistics </a></li>
                     <li class="sidebar-item" id="setting"><a href="#" id="setting" class="sidebar-link"><i class="fa-regular fa-circle-user" style="color: #ffffff;"></i></a></li>
                <li class="sidebar-item" id="settings"><a id="settings" class="sidebar-link" href="#"><i class="fa-solid fa-gear"></i></a>
                <li>
            </ul>
        </div>

    <form action="" method="GET" class="form">
       

        <label for="filter_category">Filter by Category:</label>
        <select name="filter_category" class="filtrer">
            <option value="">All Categories</option>
            <option value="clothes" <?php echo ($filter_category == 'clothes') ? 'selected' : ''; ?>>clothes</option>
            <option value="bags" <?php echo ($filter_category == 'bags') ? 'selected' : ''; ?>>bags</option>
            <option value="accessories" <?php echo ($filter_category == 'accessories') ? 'selected' : ''; ?>>accessories</option>
            <option value="shoes" <?php echo ($filter_category == 'shoes') ? 'selected' : ''; ?>>shoes</option>
        </select>

        <input type="submit" value="Filter">
         <label for="search_name"></label>
        <input type="text" name="search_name" class="search" placeholder="Search by Name:" value="<?php echo $search_name; ?>">
        <input type="submit" value="Search">
    </form>

    <table border="1" class="tab">
        <tr>
            <th>Image</th>
            <th>Name</th>
            <th>Price</th>
            <th>Category</th>
            <th>Quantity</th>
            <th>Delete</th>
            <th>Edit</th>
        </tr>
        <?php
        // Affichez chaque produit dans le tableau
        while ($row = $result->fetch_assoc()) {
            echo "<tr>";
            echo "<td><img src='" . $row["image_path"] . "' alt='" . $row["name"] . "' width='50' height='50'></td>";

            echo "<td>" . $row["name"] . "</td>";
            echo "<td>$" . $row["price"] . "</td>";
            echo "<td>" . $row["category"] . "</td>";
            echo "<td>" . $row["stock"] . "</td>";
            echo "<td><a class='delete-product' href='delete.php?id=" . $row["id"] . "'><i class='fa-solid fa-trash' style='color: #eb000c;'></i> </td>";
            echo "<td><a href='Edit.php' onclick='openForm(" . $row["id"] . ")'><i class='fa-solid fa-pen-to-square'></i></a> </td>";

            echo "</tr>";
        }
        ?>
    </table>
    </script>

</body>
<script src="admin.js"></script>
</html>
<?php
// Fermez la connexion à la base de données
$conn->close();
?>
