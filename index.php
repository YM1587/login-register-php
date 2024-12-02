<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <link rel="stylesheet" href="./Include/stylelogin.css">
    <link href='https://unpkg.com/boxicons@2.1.4/css/boxicons.min.css' rel='stylesheet'>
    <title>Document</title>
</head>
<body>
    <!-- creating the container class -->

    <?php 
    include('database.php');
    
    if(isset($_POST['login'])){
        $username = $_POST['username'];
        $pword = $_POST['pword'];

        
        if( empty($username) && empty($password)){
            echo "Username and Password Mandatory ";
        }
        else{
            $fetch = "SELECT `id`, `full_name`, `username`, `email`, `phone_number`, `password` FROM `users` WHERE  `username` == $username  && `password` == $pword";
            
            $res = mysql_query($fetch);
            $row = mysql_fetch_array($res);

            if( $row[0] > 0 ){
                header('location: ../Assets/welcome.php');
            }
            else{
                echo "Failed To Login";
            }
        }    

    }


    ?>


    <div class="wrapper">
        <form action="" method="post">
            <h1>Login</h1>
            <div class="input-box">
                <input type="text" placeholder="Username" name="username" required>
                <i class='bx bxs-user'></i>
                

            </div>
            <div class="input-box">
                <input type="password" placeholder="Password" name="pword" required>
                <i class='bx bxs-lock-alt'></i>
                
            </div>
            <div class="remember-forgot">
                <label>
                    <input type="checkbox">Remember me
                </label>
                <a href="#">Forgot password?</a>
        
            </div>
            <button type="submit" name="login" class="btn">Login</button>
            <div class="register-link">
                <p>Don't have an account?
                    <a href="#" >Register</a>
                </p>
            </div>


        </form>
    </div>
    
</body>
</html>