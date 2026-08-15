<?php 
session_start();
require "db.php";

$user = $_POST['user'];
$email = $_POST['email'];
$pass = $_POST['pass'];

$sqlVerificar = "SELECT * FROM users WHERE email='$email' OR username='$user' ";
$result01 = $conn->query($sqlVerificar);

if ($result01->num_rows > 0) {
    $_SESSION['error']= "El usuario y/o el correo ya estan registrados. Por favor, intente de nuevo";
    header("Location: registro.php");
} else {
    $sqlInsertar = "INSERT INTO users (username, email, password) VALUES ('$user', '$email', '$pass')";

    if ($conn->query($sqlInsertar) === TRUE) {
        echo "<script> window.location.href='gracias.php';</script>";
        $_SESSION['acceso'] = True ;
    } else {
        echo "<script> alert('Error'); window.location.href='registro.php';</script>";
    }
}

$conn = close();

?>