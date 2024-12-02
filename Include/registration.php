<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Registratin Form</title>
    <link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.3/dist/css/bootstrap.min.css" integrity="sha384-QWTKZyjpPEjISv5WaRU9OFeRpok6YctnYmDr5pNlyT2bRjXh0JMhjY6hW+ALEwIH" crossorigin="anonymous">
    <link rel="stylesheet" href="style.css">
    <link href='https://unpkg.com/boxicons@2.1.4/css/boxicons.min.css' rel='stylesheet'>
</head>
<body>
    <div class="container">
        <?php
        // error_reporting(E_ALL);
        // ini_set('display_errors', 1);
        // Debug: Check if form is submitted and show $_POST data
        // if ($_SERVER['REQUEST_METHOD'] == 'POST') {
        // var_dump($_POST); // Debugging statement to see form data
        // }
        if(isset($_POST["submit"])){
            // echo "Form submitted!"; // Debugging purpose
            
            $fullname = $_POST["fullname"];
            $username = $_POST["username"];
            $email = $_POST["email"];
            $phone_number = $_POST["phone_number"];
            $pword = md5($_POST["password"]);
            $confirm_password = $_POST["confirm_password"];

            $passwordHash = password_hash($pword, PASSWORD_DEFAULT);
            $errors = array();
            
            if(empty($fullname) && empty($username) && empty($email) && empty($phone_number) && empty($password) && empty ($confirm_password)){
                array_push($errors,"All fields required!");
            }
            if (!filter_var($email, FILTER_VALIDATE_EMAIL)){
                array_push($errors,"Email is not valid");

            }
            if(strlen($pword)<8){
                array_push($errors,"Password must be at least 8 chatacters long");
            }
            if($pword!==$confirm_password){
                array_push($errors,"Password does not match");
            }
            if(count($errors)>0){
                foreach($errors as $error){
                    echo "<div class='alert alert-danger'>$error</div>";
                }
            }else{
                include("database.php");
                $sql = "INSERT INTO `users`(`id`, `full_name`, `username`, `email`, `phone_number`, `password`) VALUES ('','$fullname','$username','$email','$phone_number','$pword')";

                if($conn -> query($sql)){
                    echo "You have registered successfully!";
                }
                /*
                $stmt = mysqli_stmt_init($conn);
                $prepareStmt = mysqli_stmt_prepare($stmt,$sql);
                if($prepareStmt){
                    mysqli_stmt_bind_param($stmt,"sssss",$fullname,$username,$email,$phone_number,$passwordHash);
                    mysqli_stmt_execute($stmt);
                    echo "<div class='alert alert-success'>You Have Registered successfully!</div>";*/
                else {
                    die("Something went wrong");
                }
                    
            }
        }
        

    
        ?>
        <form action="registration.php" method="post">
            <h1>Registration</h1>

            <div class="input-box">
               <div class="input-field">
                <input type="text"   name="fullname" placeholder="Full Name" required>
                <i class='bx bxs-user'></i>
               </div>

               <div class="input-field">
                <input type="text"   name="username" placeholder="Username" required>
                <i class='bx bxs-user'></i>
               </div>

               <div class="input-field">
                <input type="email"   name="email"  placeholder="Email" required>
                <i class='bx bxs-envelope' ></i>
               </div>

               <div class="input-field">
                <input type="number"   name="phone_number"   placeholder="Phone Number" required>
                <i class='bx bxs-phone' ></i>
               </div>

               <div class="input-field">
                <input type="password"   name="password"   placeholder="Password" required>
                <i class='bx bxs-lock-alt' ></i>
               </div>

               <div class="input-field">
                <input type="password"   name="confirm_password"  placeholder="Confirm Password" required>
                <i class='bx bxs-lock-alt' ></i>
               </div>
            </div>

            <label><input type="checkbox" >I hereby declare that the above information provided is true and correct</label>
            <button type="submit" class="btn"  name="submit" >Register </button>

        </form>
    </div>
</body>
</html>