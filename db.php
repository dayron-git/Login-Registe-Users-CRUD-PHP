<?php 
$severName ="localhost";
$user = "root";
$passowrd = "";
$dbName = "luna_store";

$conn = new mysqli($severName, $user, $passowrd, $dbName);
if ($conn -> connect_error) {
    die ("Conexion fallida" .$conn -> connect_error);
}

$sql = "SELECT nombre, puesto, email, telefono FROM empleados";
$result =$conn -> query($sql);

$sql1 = "SELECT nombre, precio, descripcion, stock FROM productos";
$result1 = $conn ->query($sql1);

$sql2 = "SELECT nombre, direccion, telefono, email FROM sucursales";
$result2 = $conn -> query($sql2);

?>