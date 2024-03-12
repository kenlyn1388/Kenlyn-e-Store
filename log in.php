<?php
session_start();
include("connection.php");
include("function.php");

if($_SERVER['REQUEST_METHOD'] == "POST")
    {
        //something was posted
        $email = $_POST['email'];
        $password = $_POST['password'];

        if(!empty($email) && !empty($password) && !is_numeric($email))
            {
                //Read from database
                $query = "select * from data where email = '$email' limit 1";
                $result = mysqli_query($con, $query);

                if($result)
                    {
                        if($result && mysqli_num_rows($result) >0)
                            {
                                $user_data = mysqli_fetch_assoc($result);

                                if($user_data['password'] === $password)
                                    {
                                        $_SESSION['user_id'] = $user_data['user_id'];
                                        header("Location: user logged in.php");
                                        die;
                                    }       
                            }
                    }
                 echo "Wrong user name or password !";
            }else
                {
                    echo "invalid user name or password !";
                };    
    }

?>

<!DOCTYPE html>
<html lang="eng">
<!-Final Year Project Name : Responsive Login Page -- >

<head>
        <meta charset="UTF-8">
        <meta http-equiv="X-UA-Compatible" content="IE=edge">
        <meta name="viewport" content=""width=device.width, initial.scale="1.0">
        <title> Website With Login & Registration | Kenlyn</title>
        <!- Font Awesome CSS ->
        <link rel="stylesheet"href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.4.2/css/all.min.css"/>
        <!- Custom CSS -> 
        <link rel="stylesheet" href="style_home.css">
</head>

<body>
   <div class="container">
    <div class="login-box">
        <!-- Login Form -->
        <form method="post">
            <h2>Login</h2>
            <div class="input-box">
                <span class="icon"><i class="fa-solid fa-envelope"></i></span>
                <input id="text" type="text" name="email" placeholder="Email" required>
            </div>
            <div class="input-box">
                <span class="icon"><i class="fa-solid fa-lock"></i></span>
                <input id="text" type="password" name="password" placeholder="Password"
                 required>
            </div>
           <div class="remember-forgot">
            <label for="remember"><input type="checkbox">Remember Me</label>
            <a href="forgot_password.php">Forgot Password ?</a>
           </div>
           
           <button id="button" type="submit" value="Login">Login</button>
                      <div class="register-link">
           <a href="sign up.php">Don't have an account ? Create Now !</a>
            
        </div>
   </form>
   </div>
</div>

</body>
</html>