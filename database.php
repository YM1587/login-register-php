<?php

session_start();

$hostName = "localhost";
$dbUser = "root";
$dbPassword = "";
$dbName = "login_register" ;
$conn = new mysqli($hostName, $dbUser,$dbPassword ,$dbName);
if (!$conn){
    die("Something went wrong;");
}
?>