

<?php
@include 'config_shop.php' ;





if(isset($_POST['order_btn'])){
    
 //header("location:pay.php"); 
 
 //header("Location:https://rzp.io/l/njoeKoEzb");





    $name = $_POST['name'];
    $number = $_POST['number'];
    $email = $_POST['email'];
    $method = $_POST['method'];
    $flat = $_POST['flat'];
    $street = $_POST['street'];
    $city = $_POST['city'];
    $state = $_POST['state'];
    $postcode = $_POST['postcode'];
    $country = $_POST['country'];
    
    $cart_query = mysqli_query($conn,  "SELECT * FROM `cart`");
    $total_price = 0;
    if(mysqli_num_rows($cart_query) > 0){
        while($product_item = mysqli_fetch_assoc($cart_query)){
            $product_name [] = $product_item['name'] .'('. $product_item['quantity'] .')';
            $product_price = ($product_item['price'] * $product_item['quantity']);
            (int)$total_price += $product_price;
        };

    };

   // header("Location:https://rzp.io/l/njoeKoEzb");

    header("location:pay.php"); 

    $total_product = implode ( ',',$product_name);
    $detail_query = mysqli_query($conn, "INSERT INTO `order` (name,number, email, method, flat, street, city, state, postcode, country, total_product, total_price ) VALUES ( '$name', '$number', '$email' , '$method','$flat', '$street', '$city', '$state', '$postcode', '$country', '$total_product', '$total_price')") or die( 'query failed');

    
   
   
    if( $cart_query && $detail_query){
        echo "
        <div class = 'order-message-container'>
        <div class='message-container'>
        <h3>thank you for shopping!</h3>
        <div class='order-detail'>
            <span>".$total_product."</span>
            <span class='total'> total : RM".$total_price."/= </span>
        </div>
        <div class='customer-details'>
            <p> your name : <span>".$name."</span> </p>
            <p> your number : <span>".$number."</span> </p>
            <p> your email : <span>".$email."</span> </p>
            <p> your address : <span>".$flat.", ".$street.", ".$city.", ".$state.", ".$postcode.", ".$country."</span> </p>
            <p> your payment method : <span>".$method."</span> </p>
            <p> (*pay when product arrives*) </p>
        </div>

  
        <a href='product_toner.php' class='btn'>continue shopping </a>
        </div>
    </div> 
        ";
    }

}

?>

<!DOCTYPE html>
<html lang="en">
<head>
        <meta charset="utf-8">
        <meta http-equiv="X-UA-Conpatible" content="IE-edge">
        <meta name="viewport" content="width=device-width, initial-scale=1.0">
        <title>Checkout</title>

<!--font awesme cdn link -------------->
<link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.0.0/css/all.min.css">

<!--custom css file link-------------->
<link rel="stylesheet" href="css/style.css">

</head>

<body>

<?php include 'header_user.php'; ?>
<div class="container">


<section class="checkout-form">
    <h1 class="heading">complete your order</h1>
    <form action="" method="post">
    <div class="display-order">
        <?php
            $select_cart=mysqli_query($conn, "SELECT * FROM `cart`");
            $total = 0;
            $grand_total=0; 
            if(mysqli_num_rows($select_cart) > 0){
                while($fetch_cart=mysqli_fetch_assoc($select_cart)){
                $total_price = (int)($fetch_cart['price'] * $fetch_cart['quantity']);
                $grand_total = $total += $total_price;

            ?>    
              <span> <?=$fetch_cart['name'];?> (<?=$fetch_cart['quantity'];?>)</span>
            <?php
                }
            }else{
                    echo "<div class='display-order'><span>your is empty!</span></div>";
                }
            
            ?>       
            <span class="grand-total" > grand total : RM<?= $grand_total; ?>/= </span>

    </div>

        <div class="flex">
            <div class="inputBox">
                <span>your name</span>
                <input type= "text" placeholder="enter your name" name="name" required>
            </div>

            <div class="inputBox">
                <span>your number</span>
                <input type= "number" placeholder="enter your number" name="number" required>
            </div>

            <div class="inputBox">
                <span>your email</span>
                <input type= "email" placeholder="enter your email" name="email" required>
            </div>

            <div class="inputBox">
                <span>payment method</span>
                <select name="method">
                    <option value="cash on delivery" selected>cash on delivery</option>
                    <option value="credit card">credit card</option>
                    <option value="paypal">paypal</option>
                </select>
             </div>
            <div class="inputBox">
                <span>address line 1</span>
                <input type= "text" placeholder="e.g. flat no." name="flat" required>
            </div>  
            <div class="inputBox">
                <span>address line 2</span>
                <input type= "text" placeholder="e.g. street name." name="street" required>
            </div>  
            <div class="inputBox">
                <span>city</span>
                <input type= "text" placeholder="e.g. Alor Setar" name="city" required>
            </div>
            <div class="inputBox">
                <span>state</span>
                <input type= "text" placeholder="e.g. Kedah" name="state" required>
            </div>
            <div class="inputBox">
                <span>postcode</span>
                <input type= "text" placeholder="e.g. 05150" name="postcode" required>
            </div>

            <div class="inputBox">
                <span>country</span>
                <input type= "text" placeholder="e.g. Malaysia" name="country" required>
            </div>
        </div>
        
        <!-- <input type="submit" value="Click to Pay Now" name="order_btn" class="btn" >   -->
        <input type="submit" value="Click to Pay Now" name="order_btn" class="btn" >   


        <div class="razorpay-embed-btn" data-url="https://pages.razorpay.com/pl_NhxZa5kt9370z8/view" data-text="Pay Now" data-color="#528FF0" data-size="large">
  <script>
    (function(){
      var d=document; var x=!d.getElementById('razorpay-embed-btn-js')
      if(x){ var s=d.createElement('script'); s.defer=!0;s.id='razorpay-embed-btn-js';
      s.src='https://cdn.razorpay.com/static/embed_btn/bundle.js';d.body.appendChild(s);} else{var rzp=window['__rzp__'];
      rzp && rzp.init && rzp.init()}})();
  </script>
        </div>
    

<div>   
        
</form>

</section>

</div>




<!-- Custom.js.file.link -->
<script src="js/script.js"></script>



</body>
</html>