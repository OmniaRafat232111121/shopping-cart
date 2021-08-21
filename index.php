<?php
//sesion_start
session_start();

require_once ('./php/component.php');
require_once('php/req.php');
$database = new req("shopping_cart", "product");
if(isset($_POST['add'])){
    //print_r($_POST['product_id']);
    if(isset($_SESSION['cart'])){
        $item_array_id = array_column($_SESSION['cart'], "product_id");

        if(in_array($_POST['product_id'], $item_array_id)){
            echo "<script>alert('Product is already added in the cart..!')</script>";
            echo "<script>window.location = 'index.php'</script>";
        }else{

            $count = count($_SESSION['cart']);
            $item_array = array(
                'product_id' => $_POST['product_id']
            );

            $_SESSION['cart'][$count] = $item_array;
        }

    }else{

        $item_array = array(
                'product_id' => $_POST['product_id']
        );

        // Create new session variable
        $_SESSION['cart'][0] = $item_array;
        print_r($_SESSION['cart']);
    }
    }
?>

<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>shopping cart</title>
    <link rel="stylesheet" href="shopping/css/all.min.css">
  <link rel="stylesheet" href="shopping/css/bootstrap.min.css" />
   <link rel="stylesheet" href="shopping/css/style.css">
 

<!--scrollbar-->
<script src="https://unpkg.com/scrollreveal"></script>
   <!--font awesome-->
<link rel="preconnect" href="https://fonts.googleapis.com">
<link rel="preconnect" href="https://fonts.gstatic.com" crossorigin>
<link href="https://fonts.googleapis.com/css2?family=Quicksand:wght@300&family=Roboto:wght@300&display=swap" rel="stylesheet">
  <script src="js/jquery-3.5.1.min.js"></script>
  <script src="js/popper.min.js"></script>
  <script src="js/bootstrap.min.js"></script>
</head>
<body>
      
<?php
require_once("php/header.php");
?>

<div class="container">
<div class="row text-center py-5">
       <?php
          
          $result = $database->getData();
          while ($row = mysqli_fetch_assoc($result)){
              component($row['product_name'], $row['product_price'], $row['product_image'], $row['id']);
          }
         
        ?> 
           
</div>
           
</div>




</body>
</html>