<?php 
 include ("conexion.php");
?>
<?php if(isset($_POST['enviar'])){

} else{
    $id = $_GET['id']
    $sql = "SELECT * FROM empleados WHERE id='$id'";
    $result = mysqli_query($conexion,$sql);
    $fila = mysqli_fetch_assoc($result);

    $nombre = $fila['nombre'];
    $puesto= $fila['puesto'];
    $email= $fila['email'];
    $telefono = $fila['telefono'];

?>
<div class="modal fade show d-block" tabindex="-1" aria-labelledby="verEmpleadoModal" aria-hidden="true" style="background: rgba(0,0,0,0.5);">
        <div class="modal-dialog">
            <div class="modal-content">
                <div class="modal-header bg-warning">
                    <h5 class="modal-title" id="verEmpleadoModal">Detalles del Empleado</h5>
                    <a href="gestionar_empleados.php" class="btn-close" aria-label="Cerrar"></a>
                </div>
                <div class="modal-body">
                <form action="<?php $_SERVER['PHP_SELF']?>" method="POST">
                    <div class="mb-3">
                        <label> Nombre </label>
                        <input type="text" class="form-control border-dark" name="nombre" value="<?php echo $row['nombre'];?>"  required>
                    </div>
                    <div class="mb-3">
                        <label> Cargo </label>
                        <input type="text" class="form-control border-dark" name="puesto" value="<?php echo $editEmployee['puesto'];?>" required>
                    </div>
                    <div class="mb-3">
                        <label> Correo electronico </label>
                        <input type="email" class="form-control border-dark" name="email" value="<?php echo $editEmployee['email'];?>" required>
                    </div>
                    <div class="mb-3">
                        <label> Telefono </label>
                        <input type="number" class="form-control border-dark" name="telefono"value="<?php echo $editEmployee['telefono'];?>" required>
                    </div>
                    <hr>
                    <div class="mb-3 d-flex align-items-center">
                        <input type="submit" value="Editar" class="form-control btn btn-dark" required >
                        <a href="gestionar_empleados.php" class="btn btn-dark mx-1">Cerrar</a>
                    </div>  
                </form>
                </div>
            </div>
        </div>
    </div>
    <?php }?>

