<?php
@include 'config_shop.php';

if(isset($_POST['add_to_cart'])){

    
    $message[] = 'Please register and log in for shopping !' ;
}
?>

<!DOCTYPE html>
<html lang="en">
<head>
        <meta charset="utf-8">
        <meta http-equiv="X-UA-Conpatible" content="IE-edge">
        <meta name="viewport" content="width=device-width, initial-scale=1.0">
        <title>Products</title>

<!--font awesme cdn link -------------->
<link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.0.0/css/all.min.css">

<!--custom css file link-------------->
<link rel="stylesheet" href="css/style.css">
</head>

<body>

<?php

if(isset($message)){
    foreach($message as $message){
        echo '<div class="message"><span>'.$message.'</span> <i class="fas fa-times" onclick="this.
        parentElement.style.display =`none`;"></i> </div>';
    };
};

?>

     
<?php include 'header_user_viewonly.php'; ?>

<div class="container">

<section class="products">

<h1 class="heading">Latest Products</h1>

<div class="box-container">

<?php

$select_products = mysqli_query($conn,"SELECT * FROM `products`");
if(mysqli_num_rows($select_products) > 0){
    while($fetch_product = mysqli_fetch_assoc($select_products)){
?>
<form action="" method="post">
<div class="box">
    <img src="uploaded_img/<?php echo $fetch_product['image']; ?>" height="250" alt=""> 
    <h3><?php echo $fetch_product['name']; ?></h3>
    <div class ="price">RM<?php echo $fetch_product['price']; ?>/= </div>
    <input type="hidden" name="product_name" value="<?php echo $fetch_product['name'];?>">
    <input type="hidden" name="product_price" value="<?php echo $fetch_product['price'];?>">
    <input type="hidden" name="product_image" value="<?php echo $fetch_product['image'];?>">
    <input type="submit" class="btn" value="add to cart" name="add_to_cart">
    

</div>
</form>


<?php
    };

};

?>


</div>

</section>
</div>


<!-- Custom.js.file.link -->
<script src="js/script.js"></script>



</body>
</html>


  