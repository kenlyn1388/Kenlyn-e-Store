<?php

session_start();
   include("connection.php");
   include("function.php");

$user_data = check_login($con);

?>


<!DOCTYPE html>
<html lang="eng">
<head>
        <meta charset="UTF-8">
        <meta http-equiv="X-UA-Compatible" content="IE=edge">
        <meta name="viewport" content=""width=device.width, initial.scale="1.0">
        <title> Website With Login & Registration | Kenlyn</title>
        <!- Font Awesome CSS ->
        <link rel="stylesheet"href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.4.2/css/all.min.css"/>
        <!- Custom CSS -> 
        <link rel="stylesheet" href="style_logged_in.css">
</head>


  
<header>
        <h1 class="logo">KENLYN ELECTRONIC CENTRE</h1>
       <nav class="navigation">
            
            <a href="product_toner.php"><submit>Home</submit></a>
            <a href="https://www.hotfrog.com.my/company/1100232502484992"><submit>About</submit></a>
            <a href="services.php"><submit>Services</submit></a>
            <a href="contact_us.html"><submit>Contact</submit>  </a>
            <br>          
            
            
            Hello, <?php echo $user_data['user_name']; ?>
            <br>
            Welcome to Kenlyn Electronic Centre
            <a href="log out.php"> <button>Logout</button></a>
                      
      </nav>
</header> 
 
<div class="container">

 
</div>   

</html>