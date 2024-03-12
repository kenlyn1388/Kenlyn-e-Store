<header class="header">

<div class="flex">

    <a href="#" class="logo">KENLYN ELECTRONIC CENTRE</a>

 <nav class="navbar">
    <a href="product_toner.php">toner cartridge</a>
    <a href="product_ink.php">ink cartridge</a>
    <a href="product_printer.php">printer</a>
    <a href="product_stationery.php">stationery</a>

</nav>

<?php

$select_rows = mysqli_query($conn,"SELECT * FROM `cart`") or die('query failed');
$row_count = mysqli_num_rows($select_rows);

?>

<a href = "cart.php" class="cart" >cart <span> <?php echo $row_count; ?> </span> </a>


<div id="menu-btn" class="fas fa-bars"></div>

</div>


</header>