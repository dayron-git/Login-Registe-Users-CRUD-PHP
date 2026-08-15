<?php 
session_start();
require 'db.php';

$user = $_POST['user'];
$pass = $_POST['pass'];

$sql4 = "SELECT username, password FROM users WHERE username='$user' AND password='$pass'";
$result4 = $conn -> query($sql4);

if ($result4 -> num_rows > 0) {
    $_SESSION['user']=$user;
    header("Location: welcome.php");
} else {
    //username no existe
    $_SESSION['error']= "El usuario y/o contraseña ingresada son incorrectos";
    header("Location: login.php");
}

$conn = close();

?>