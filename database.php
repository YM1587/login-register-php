<?php
$hostName = "localhost";
$dbUser = "root";
$dbPassword = "";
$dpName = "login_register" ;
$conn = new mysqli($hostName, $dbUser,$dbPassword ,$dbName);
if (!$conn){
    die("Something went wrong;");
}
?>