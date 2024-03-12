<?php


session_start();
include("connection.php");
include("function.php");

if($_SERVER['REQUEST_METHOD'] == "POST")
{
       //something was posted


  
    $email = $_POST['email'];
    $select_email = mysqli_query( $con, "SELECT * FROM `data` WHERE email = '$email'");
    if(mysqli_num_rows($select_email) >0 )
    {
    echo "Registration failed, This email already has been used, Please try again !" ;
    }
    
    else{
            $user_id = $_POST['user_id'];
            $user_name = $_POST['user_name'];
            $gender = $_POST['gender'];
            $email = $_POST['email'];
            $mobile = $_POST['mobile'];
            $address = $_POST['address'];
            $password = $_POST['password'];
 
 
        if(!empty($user_name) && !empty($password) && !is_numeric($user_name))
            {   
                //Save to database
                $user_id = random_num(5);
                $query = "insert into data (user_id,user_name,gender,email,mobile,address,password) values ('$user_id','$user_name','$gender','$email','$mobile','$address','$password')";
                mysqli_query($con, $query);
                
                header("Location: log in.php");
                //die;
            }else{echo "Wrong username or pasword !";}     
        }   
    }

?>

<!DOCTYPE html>
<html lang="eng">
<head>
        <meta charset="UTF-8">
        <meta http-equiv="X-UA-Compatible" content="IE=edge">
        <meta name="viewport" content=""width=device.width, initial.scale="1.0">
        <title>Forms</title>
        <link rel="stylesheet" href="style_Form.css">
</head>
<body>
    <h1> Registration FORM</h1>
    <div class="container">
    <!--<form action="connection.php" method="POST">  -->
     <form method="post">   
    <div>
        <label>Name</label>
        <input type="text" name="user_name" placeholder="Enter your name">
    </div>
    
    <div class="gendercontainer">
        <label>Gender</label>
        <input class="gender1"type="radio" name="gender"
        value="m">Male
        <input class="gender1"type="radio" name="gender"
        value="f">Female
        <input class="gender1"type="radio" name="gender"
        value="o">Others
    </div>
    
    <div>
        <label>Email</label>
        <input type="text" name="email" placeholder="Enter your email">
    </div>
        
    <div>
        <label>Mobile</label>
        <input type="text" name="mobile" placeholder="Enter your mobile">
    </div>
    <div>
        <label>Address</label>
        <input type="text" name="address" placeholder="Enter your address">

    <div>
        <label>Password</label>
        <input type="text" name="password" placeholder="Enter your password">
    </div>
    
    <div class="btn">
        <a href="log in.php"> <button type="submit">Submit data</button>  </a>
     </div>   


</form>
</div>
</body>
</html>