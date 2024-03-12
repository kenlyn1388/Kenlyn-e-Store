<?php
require 'config_shop.php';

if(isset($_POST['add_product'])){
    $p_name = $_POST['p_name'];
    $p_price = $_POST['p_price'];
    $p_image = $_FILES['p_image']['name'];
    $p_image_tmp_name = $_FILES['p_image']['tmp_name'];
    $p_image_folder = 'uploaded_img/'.$p_image;
    $insert_query = mysqli_query($conn, "INSERT INTO `stationery` (name, price, image) VALUES('$p_name', '$p_price', '$p_image')") 
        or die('query failed');
 
    if($insert_query){
        move_uploaded_file($p_image_tmp_name, $p_image_folder);
        $message[] = 'Product added succesfully';
    }else{
        $message[] = 'Product could not been added succesfully';
    }
};
 
if(isset($_GET['delete'])){

        $delete_id = $_GET['delete'];
        $delete_query = mysqli_query($conn, "DELETE FROM `stationery` WHERE id = $delete_id") 
        or die('query failed');
            if($delete_query){
                 header('location:admin_stationery.php');
                 $message[] = 'Product has been deleted';
                }else{
                 header('location:admin_stationery.php');
                 $message[] = 'Product could not be deleted';

                };
    };

if(isset($_POST['update_product'])){
    $update_p_id = $_POST['update_p_id'];
    $update_p_name = $_POST['update_p_name'];
    $update_p_price = $_POST['update_p_price'];
    $update_p_image = $_FILES['update_p_image']['name'];
    $update_p_image_tmp_name = $_POST['update_p_image']['tmp_name'];
    $update_p_image_folder = 'uploaded_img/' .$update_p_image;

    $update_query = mysqli_query($conn, "UPDATE `stationery` SET name = '$update_p_name', price = '$update_p_price', image ='$update_p_image' WHERE id = '$update_p_id'");
       if($update_query){
            move_uploaded_file ($update_p_image_tmp_name, $update_p_image_folder);
                $message[] = 'Product updated succesfully';
                header('location:admin_stationery.php');
            }else{
                $message[] = 'Product could not be updated succesfully';
                header('location:admin_stationery.php');
            }
           };

?>

<!DOCTYPE html>
<html lang="en">
    <head>
        <meta charset="utf-8">
        <meta http-equiv="X-UA-Conpatible" content="IE-edge">
        <meta name="viewport" content="width=device-width, initial-scale=1.0">
        <title>Admin Page</title>

        <!--font awesme cdn link -------------->
        <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.0.0/css/all.min.css">

        <!--custom css file link-------------->
        <!-- <link rel="stylesheet" href="admincss/admin.css">  -->
       <!--  <link rel="stylesheet" href="adminjs/script.js"> -->
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

<?php include 'header_admin.php'; ?>
<div class="container">
<section>

<form action="" method="post" class="add-product-form" enctype="multipart/form-data">
    <h3>Stationery Items</h3>
    <h3>Add a new product</h3>
    <input type="text" name="p_name" placeholder="Enter the product name" class="box" required>
    <input type="number" name="p_price" min="0" placeholder="Enter the product price" class="box" required>
    <input type="file" name="p_image" accept="image/png, image/jpg, image/jpeg" class="box" required>
    <input type="submit" value="Add the product" name="add_product" class="btn">
</form>
</section>

<section class="display-product-table">

<table >

<thead>
      <th>Product Image</th>
      <th>Product Name</th>
      <th>Product Price</th>
      <th>Action</th>
</thead>
   
    <tbody>
        <?php
            include 'config_shop.php';
            $select_products = mysqli_query($conn, "SELECT * FROM `stationery`");
            if(mysqli_num_rows($select_products) > 0){
                while($row = mysqli_fetch_assoc($select_products)){
        ?>

        <tr>
            <td> <img src= "uploaded_img/<?php echo $row['image']; ?>" height="100" alt=""></td>
            <td><?php echo $row['name']; ?></td>
            <td>RM<?php echo $row['price']; ?>/=</td>
            <td>
                <a href = "admin_stationery.php?delete=<?php echo $row['id']; ?>" class="delete-btn" 
                onclick="return confirm('Are you sure you want delete this?');"> 
                <i class="fas fa-trash"> </i> Delete </a>
                <a href = "admin_stationery.php?edit=<?php echo $row['id']; ?>" class="option-btn" > 
                <i class="fas fa-edit"> </i> Update </a>
            </td>
        </tr>

        <?php
                };
            }else{
                echo "<div class='empty' > No product added</div>";
             };
        ?>
    </tbody>
</table>
</section>

<section class="edit-form-container">
    
<?php

if(isset($_GET['edit']));
 
    $edit_id = $_GET['edit'];
    $edit_query = mysqli_query($conn, "SELECT * FROM  `stationery` WHERE id = $edit_id");
    
    if(mysqli_num_rows($edit_query) >0){
        while($fetch_edit = mysqli_fetch_assoc($edit_query)){
    ?>   

    <form action="" method="post" enctype="multipart/form-data">
        <img src="uploaded_img/<?php echo $fetch_edit['image']; ?>" height="200" alt="">
        <input type="hidden" name="update_p_id" value="<?php echo  $fetch_edit['id']; ?>"> 
        <input type="text" class="box" required name="update_p_name" value="<?php echo  $fetch_edit['name']; ?>">  
        <input type="number" min="0" class="box" required name="update_p_price" value="<?php echo  $fetch_edit['price']; ?>">  
        <input type="file" class="box" required name="update_p_image" accept="images/png, images/jpg, images/jpeg">  
        <input type="submit" value="update the product" name="update_product" class="btn">  
        <input type="reset" value="cancel" id="close-edit" class="option-btn">  
    </form>
       
    <?php
            
        };
    };
  
echo "<script> document.querySelector('.edit-form-container').style.display = 'flex';  </script>";  

?>
 
</section>

</div>



<!-- Custom.js.file.link -->
<script src="js/script.js"></script>

</body>
</html>






