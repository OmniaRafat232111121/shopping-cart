<?php
//sesion_start
session_start();

require_once ('./php/component.php');
require_once('php/req.php');
$db = new req("shopping_cart", "product");

if (isset($_POST['remove'])){
    if ($_GET['action'] == 'remove'){
        foreach ($_SESSION['cart'] as $key => $value){
            if($value["product_id"] == $_GET['id']){
                unset($_SESSION['cart'][$key]);
                echo "<script>alert('Product has been Removed...!')</script>";
                echo "<script>window.location = 'cart.php'</script>";
            }
        }
    }
  }
  
?>
<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title> cart</title>
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
  
<div class="container-fluid">
    <div class="row px-5">
        <div class="col-md-7">
        <div class="shopping-cart">
            <h6 class="mt-3">My cart</h6>
            <hr>
            <?php
        $total = 0;
        if (isset($_SESSION['cart'])){
            $product_id = array_column($_SESSION['cart'], 'product_id');

            $result = $db->getData();
            while ($row = mysqli_fetch_assoc($result)){
                foreach ($product_id as $id){
                    if ($row['id'] == $id){
                        cartProduct($row['product_image'], $row['product_name'],$row['product_price'], $row['id']);
                        $total = $total + (int)$row['product_price'];
                    }
                }
            }
        }else{
            echo "<h5>Cart is Empty</h5>";
        }
            ?>
        </div>
        </div>
        <div class="col-md-5">
            <div class="pt-4">
                <h6>PRICE DETAILS</h6>
                <hr>
                <div class="row price-details">
                    <div class="col-md-6">
                        <?php
if(isset($_SESSION ['cart'])){
    $count  = count($_SESSION['cart']);
    echo "<h6> price($count items)</h6>";

}
else{
    echo "<h6>Price (0 items)</h6>";
}

?>

<h6>Delivery Charges</h6>
                        <hr>
                        <h6>Amount Payable</h6>
                    </div>
                    <div class="col-md-6">
                        <h6>$<?php echo $total; ?></h6>
                        <h6 class="text-success">FREE</h6>
                        <hr>
                        <h6>$<?php
                            echo $total;
                            ?></h6>
                    </div>
                    </div>

                </div>
            </div>

        </div>

    </div>
</div>


</div>
</body>
</html>
