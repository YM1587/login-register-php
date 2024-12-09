<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <link rel="stylesheet" href="stylelogin.css">
    <link href='https://unpkg.com/boxicons@2.1.4/css/boxicons.min.css' rel='stylesheet'>
    <script src="https://cdn.jsdelivr.net/npm/@popperjs/core@2.11.8/dist/umd/popper.min.js" integrity="sha384-I7E8VVD/ismYTF4hNIPjVp/Zjvgyol6VFvRkX/vR+Vc4jQkC+hVqc2pM8ODewa9r" crossorigin="anonymous"></script>
    <title>Document</title>
</head>
<body>
    <!-- creating the container class -->

    <?php
    
include('./Include/database.php'); // Ensure this file sets up a proper $conn connection using `mysqli`

if (isset($_POST['login'])) {
    $username = $_POST['username'];
    $pword = $_POST['pword'];

    $sql = "SELECT * FROM `users` WHERE username = '$username' AND password = '$pword'";

    $result = mysqli_query($conn, $sql);

    // Input validation
    if($result -> num_rows == 1){

        $row = $result -> fetch_assoc();

        $_SESSION['username'] = $row['username'];
        $_SESSION['email'] = $row['email'];

        header('location: ./Assets/welcome.php');

        /*if(password_verify($pword, $row['password'])){
            session_start();
            $_SESSION['username'] = $row['username'];
            $_SESSION['email'] = $row['email'];

            header('location: ./Assets/welcome.php');

        }
        else{
            echo "Invalid username or password";
        }*/

        exit();
    }
    else{
        echo "No username with this account";
        header('location: ./Include/registration.php');
    
    }
}
?>


    <div class="wrapper">
        <form action="index.php" method="post">
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
                    <a href="./Include/registration.php" >Register</a>
                </p>
            </div>


        </form>
    </div>
    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.3/dist/js/bootstrap.min.js" integrity="sha384-0pUGZvbkm6XF6gxjEnlmuGrJXVbNuzT9qBBavbLwCsOGabYfZo0T0to5eqruptLy" crossorigin="anonymous"></script>
</body>
</html>