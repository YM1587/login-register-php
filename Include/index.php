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
    
include('database.php'); // Ensure this file sets up a proper $conn connection using `mysqli`

if (isset($_POST['login'])) {
    $username = $_POST['username'];
    $pword = $_POST['pword'];
    $errors = array();

    // Input validation
    if (empty($username) || empty($pword)) {
        array_push($errors, "Username and Password are mandatory.");
    }

    if (count($errors) > 0) {
        foreach ($errors as $error) {
            echo "<div class='alert alert-danger'>$error</div>";
        }
    } else {
        // Prepared statement for secure login
        $sql = "SELECT `id`, `full_name`, `username`, `email`, `phone_number`, `password` FROM `users` WHERE `username` = ?";
        $stmt = $conn->prepare($sql);
        $stmt->bind_param("s", $username);
        $stmt->execute();
        $result = $stmt->get_result();

        if ($result->num_rows > 0) {
            $user = $result->fetch_assoc();

            // Check if password matches
            if (password_verify(md5($pword), $user['password'])) { // Matches your registration hash logic
                // Redirect to welcome page
                header('location: ./Assets/welcome.php');
                exit();
            } else {
                echo "<div class='alert alert-danger'>Invalid username or password.</div>";
            }
        } else {
            echo "<div class='alert alert-danger'>User not found.</div>";
        }

        $stmt->close();
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