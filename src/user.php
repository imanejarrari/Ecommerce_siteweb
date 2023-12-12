<?php 
  $servername="127.0.0.1";
  $username="root";
  $password="";
  $dbname="ecommerce";

  $conn=new mysqli($servername,$username,$password,$dbname);
  

  $search_name = isset($_GET['search_name']) ? $_GET['search_name'] : '';

  $sql = 'SELECT * FROM users WHERE IsAdmin = 0 AND username LIKE ?';
  $stmt = $conn->prepare($sql);
  
  // Ajouter le paramètre de recherche à la requête préparée
  $stmt->bind_param('s', $search_name_param);
  $search_name_param = '%' . $search_name . '%';
  
  // Exécuter la requête préparée
  $stmt->execute();
  
  // Récupérer le résultat de la requête
  $result = $stmt->get_result();
  
  // Fermer la requête préparée
  $stmt->close();

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
    <style>
    table td{
      height:40px ;
    }
    .search{
      width:1050px;
      height:40px;
      padding-left:490px;
     margin-right:60px;
     display: inline-block;
     font-size:small;
     border-style: solid ;
    border-color:#041e42 ;
    border-width:1px 1px 1px 1px;
    
    }

    </style>
     <script>
        document.addEventListener("DOMContentLoaded", function () {
            const searchInput = document.querySelector(".search");

            // Ajoutez un écouteur d'événements pour détecter les changements dans le champ de recherche
            searchInput.addEventListener("input", function () {
                // Soumettez automatiquement le formulaire lorsqu'il y a un changement
                this.form.submit();
            });
        });
    </script>
</head>

<body>
<div class="main-container">
        <div class="left-menu">
            <div class="logo">
                <span class="logoLink"><a href="">EVARA</a></span>
            </div>
            <li class="menu"><i class="fa-sharp fa-solid fa-circle-chevron-down"></i></li>
            <ul>
                <li class="sidebar-item"><a class="sidebar-link" href="Admin.php"><i class="fa-solid fa-house"></i> Dashbord </a>
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
    

    <form action="" method="GET" class="form">
       
         <label for="search_name"></label>
        <input type="text" name="search_name" class="search" placeholder="Search by Name:" value="<?php echo $search_name; ?>">
    </form>

    <table border="1" class="tab">
        <tr>
            <th>id</th>
            <th>Profile</th>
            <th>Name</th>
            <th>E-mail</th>
            <th>Registration date</th>
        </tr>
        <?php
        // Affichez chaque produit dans le tableau
        while ($row = $result->fetch_assoc()) {
            echo "<tr>";
            echo "<td>" . $row["id"] . "</td>";
            echo "<td><img src='" . $row["profile_picture"] . "' alt='" . $row["username"] . "' width='40' height='40' border-radius='50%'></td>";
            echo "<td>" . $row["username"] . "</td>";
            echo "<td>" . $row["email"] . "</td>";
            echo "<td>" . $row["registration_date"] . "</td>";
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