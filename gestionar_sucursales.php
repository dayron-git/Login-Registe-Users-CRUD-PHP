<?php 
    require "db.php";
    session_start();

    if (!isset($_SESSION['user'])) {
        header("Location: login.php");
        exit();
    };

    $search = isset($_GET['search']) ? $_GET['search']: '';
    $sql = "SELECT nombre ,direccion ,email,telefono,id FROM sucursales WHERE nombre LIKE '%$search%' OR direccion LIKE'%$search%'OR email LIKE'%$search%' OR telefono LIKE'%$search%' OR id LIKE '%$search%'";
    $result2= $conn -> query($sql);

      
  if (isset($_POST['delete_sucursal_id'])) {
    $sucursal_id = $_POST['delete_sucursal_id'];

    $stmt = $conn -> prepare("DELETE FROM sucursales WHERE id = ?");
    $stmt -> bind_param("i",$sucursal_id);

    if ($stmt -> execute()) {
        echo "<script>alert('Sucursal eliminada con exito');</script>";
        header("Location: gestionar_sucursales.php");
    } else {
        echo "<script>alert('Error ');</script>";
    }
  }

 // PROCESAR EDICIÓN 
if (isset($_POST['edit_sucursal_id'])) {
    $id = $_POST['edit_sucursal_id'];
    $nombre = $_POST["nombre1"];
    $direccion = $_POST["direccion1"];
    $telefono = $_POST["telefono1"];
    $email = $_POST["email"];

    // Validar que los datos estén completos
    if (!empty($id) && !empty($nombre) && !empty($direccion) && !empty($telefono) && !empty($email)) {
        $stmt = $conn->prepare("UPDATE sucursales SET nombre = ?, direccion = ?, telefono = ?, email = ? WHERE id = ?");
        $stmt->bind_param("ssssi", $nombre, $direccion, $telefono, $email, $id);

        if ($stmt->execute()) {
            echo "<script>alert('Sucursal actualizado con éxito'); window.location.href='gestionar_sucursales.php';</script>";
            exit();
        } else {
            echo "<script>alert('Error al actualizar la sucursal: " . $stmt->error . "');</script>";
        }

        $stmt->close();
    } else {
        echo "<script>alert('Por favor, completa todos los campos.');</script>";
    }
}


  if (isset($_GET['view_sucursal_id'])) {
    $sucursal_id = $_GET['view_sucursal_id'];

    $stmt = $conn -> prepare("SELECT * FROM sucursales WHERE id =? ");
    $stmt -> bind_param("i",$sucursal_id);
    $stmt -> execute();
    $sucursal = $stmt ->get_result()->fetch_assoc();
  }


    if ($_SERVER['REQUEST_METHOD'] == 'POST'){
    $nombre = $_POST['nombre'];
    $direccion= $_POST['direccion'];
    $telefono= $_POST['telefono'];
    $email = $_POST['email'];
   

 
    $stmt = $conn -> prepare("INSERT INTO sucursales(nombre, direccion, telefono, email) VALUES (?,?,?,?)");
    $stmt -> bind_param("ssss", $nombre, $direccion, $telefono, $email);

    if ($stmt -> execute()) {
        echo "<script>alert('Registro creado con éxito'); window.location.href='gestionar_sucursales.php';</script>";
       
    } else {
        echo "<script>alert('ERROR')</script>";
    }
    $stmt -> close();
  }
?>
<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.3/dist/css/bootstrap.min.css" rel="stylesheet" integrity="sha384-QWTKZyjpPEjISv5WaRU9OFeRpok6YctnYmDr5pNlyT2bRjXh0JMhjY6hW+ALEwIH" crossorigin="anonymous">
    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.3/dist/js/bootstrap.bundle.min.js" integrity="sha384-YvpcrYf0tY3lHB60NNkmXc5s9fDVZLESaAA55NDzOxhy9GkcIdslK1eN7N6jIeHz" crossorigin="anonymous"></script>
    <link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/bootstrap-icons/font/bootstrap-icons.css">
    <script src="https://kit.fontawesome.com/25d0b10283.js" crossorigin="anonymous"></script>
    <link rel="stylesheet" href="css/mystyle.css">
    <title>Luna Store</title>
</head>
<body>
    <?php 
        include "admin_header.php"
    ?>

    <div class="container-fluid mt-4 mb-5 px-5">
        <h2>Sucursales</h2>

        <div class="row mt-4 ">
            <form class="col-9 d-flex align-items-center ">
                <input class="form-control border-dark me-2" type="search" name="search" placeholder="Ingrese sucursal" method="GET" value="<?php echo $search ?>">
                <button class="btn btn-outline-dark" type="submit "><i class="fa-solid fa-magnifying-glass"></i></button>
            </form>
            <div class="col-3 px-0">
                <input  type="submit" class="btn btn-dark px-4" data-bs-toggle="modal" data-bs-target="#agregarProducto" value="Nueva Sucursal">
                <button class="btn btn-outline-dark mx-1 px-4" >Descargar</button>
            
            </div>
        </div>
        <br>

        <?php if($result2 -> num_rows > 0){?>    
            <table class="table tabble-stripped">
                <thead class="table-dark">
                    <th>Nombre</th>
                    <th>Direccion</th>  
                    <th></th>
                    <th></th>
                    <th></th>                
                </thead>
                <tbody>
                    <?php  while ($row = $result2 -> fetch_assoc()) {?>
                        <tr class="table-warning">
                            <td> <?php echo $row["nombre"]?></td>
                            <td> <?php echo $row["direccion"]?></td>
                            <td class="d-none"> <?php echo $row["telefono"]?></td>
                            <td class="d-none"> <?php echo $row["email"]?></td>
                            <td> 
                                <form method="GET">
                                    <input type="hidden" name="view_sucursal_id" value="<?php echo $row['id'];?>">
                                    <button type="submit" class="btn btn-success px-4"><i class="fa-solid fa-eye" data-bs-toggle="modal" data-bs-target="#verSucursalModal"></i></button>
                                </form>    
                            </td>
                            <td class="option">
                                <form method="POST">
                                    <input type="hidden" name="edit_sucursal_id" value ="<?php echo $row['id']; ?> ">
                                    <button type="button" class="btn btn-warning px-4" data-bs-toggle="modal" data-bs-target="#editarSucursalModal">
                                        <i class="fa-solid fa-pen"></i></button>
                                </form>
                             </td>
                            <td class="option">
                                <form method="POST" onsubmit="return confirm('¿Estás seguro de que deseas eliminar la sucursal?');">
                                    <input type="hidden" name="delete_sucursal_id" value="<?php echo $row['id'];?>">
                                    <button type="submit" class="btn btn-danger px-4" data-bs-toggle="tooltip" data-bs-placement="top" data-bs-title="Eliminar"> <i class="fa-solid fa-trash"></i> </button>
                                </form>
                            </td>
                        </tr>
                    <?php }?>
                </tbody>
            </table>        
        <?php } else {
            echo "No se encontraron datos con los criterios de busqueda ingresados.";
        }?>

    </div>
    <br><br>
   

    <?php 
        include "footer.php"
    ?>
    <!-- Modal Editar Empleado -->
<div class="modal fade" id="editarSucursalModal" tabindex="-1" aria-labelledby="editarSucursalModalLabel" aria-hidden="true">
    <div class="modal-dialog">
        <div class="modal-content">
            <div class="modal-header bg-warning">
                <h5 class="modal-title" id="editarSucursalModalLabel">Editar Sucursal</h5>
                <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Cerrar"></button>
            </div>
            <div class="modal-body">
                <form action="" method="POST">
                    <input type="hidden" name="edit_sucursal_id" id="edit_sucursal_id">
                    <div class="mb-3">
                        <label>Nombre: </label>
                        <input type="text" name="nombre1" id="edit_nombre" class="form-control" required>
                    </div>
                    <div class="mb-3">
                        <label>Dirección:</label>
                        <input type="text" name="direccion1" id="edit_direccion" class="form-control" required>
                    </div>
                    <div class="mb-3">
                        <label>Telefono: </label>
                        <input type="number" name="telefono1" id="edit_number" class="form-control" required>
                    </div>
                    <div class="mb-3">
                        <label>Correo electronico: </label>
                        <input type="email" name="email" id="edit_email" class="form-control" required>
                    </div>
                    <div class="d-flex justify-content-between">
                        <input type="submit" value="Actualizar datos" class="btn btn-dark px-5" required >
                        <input type="button" value="Cerrar" class="btn btn-dark" data-bs-dismiss="modal" aria-label="Cerrar">
                    </div>
                </form>
            </div>
        </div>
    </div>
</div>
<SCript>
document.addEventListener('DOMContentLoaded', function () {
    // Seleccionar todos los botones de editar
    const editButtons = document.querySelectorAll('.btn-warning');

    editButtons.forEach(button => {
        button.addEventListener('click', function () {
            const row = this.closest('tr'); // Obtener la fila
            const id = row.querySelector('input[name="edit_sucursal_id"]').value.trim();
            const nombre = row.children[0].textContent.trim();
            const direccion = row.children[1].textContent.trim();
            const numero = row.children[2].textContent.trim();
            const email = row.children[3].textContent.trim();

            // Rellenar los datos en el modal
            document.getElementById('edit_sucursal_id').value = id;
            document.getElementById('edit_nombre').value = nombre;
            document.getElementById('edit_direccion').value = direccion;
            document.getElementById('edit_number').value = numero;
            document.getElementById('edit_email').value = email;
        });
    });
});
//FIN MODAL EDITAR EMPLEADO//
</SCript>

    <!-- INICIO MODAL AGREGAR  EMPLEADO-->
    <div class="modal fade" id="agregarProducto" tabindex="-1" aria-labelledby="agregarProducto" aria-hidden="true">
        <div class="modal-dialog">
        <div class="modal-content">
            <div class="modal-header bg-warning">
                <h5 class="modal-title" id="agregarProducto">Agregar Nueva Sucursal</h5>
                <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Cerrar"></button>
            </div>
            <div class="modal-body">
                <form action="" method="POST">
                    <div class="mb-3">
                        <label> Nombre: </label>
                        <input type="text" class="form-control" name="nombre" required>
                    </div>
                    <div class="mb-3">
                        <label> Dirección: </label>
                        <input type="text" class="form-control" name="direccion"  required>
                    </div>
                    <div class="mb-3">
                        <label> Telefono: </label>
                        <input type="number" class="form-control" name="telefono"  required>
                    </div>
                    <div class="mb-3">
                        <label> Correo electronico: </label>
                        <input type="email" class="form-control" name="email" required>
                    </div>
                    <div class="d-flex justify-content-between">
                        <input type="submit" value="Crear Sucursal" class="btn btn-dark px-5" required >
                        <input type="button" value="Cerrar" class="btn btn-dark" data-bs-dismiss="modal" aria-label="Cerrar">
                    </div>  
                    
                </form>
            </div>
        </div>
        </div>
    </div>
    <!-- FIN MODAL AGREGAR  EMPLEADO-->


    <!-- INICIO MODAL VER EMPLEADO -->
    <?php if (isset($sucursal)) { ?>
    <div class="modal fade" tabindex="-1" id="verSucursalModal" aria-labelledby="verSucursalModal" aria-hidden="true">
        <div class="modal-dialog">
            <div class="modal-content">
                <div class="modal-header bg-warning">
                    <h5 class="modal-title" id="verSucursalModal">Detalles de Sucursal</h5>
                    <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Cerrar"></button>
                </div>
                <div class="modal-body">
                    <p><strong>Nombre: </strong><?php echo $sucursal['nombre'];?></p>
                    <p><strong>Dirección: </strong><?php echo $sucursal['direccion'];?></p>
                    <p><strong>Telefono: </strong><?php echo $sucursal['telefono'];?></p>
                    <p><strong>email: </strong><?php echo $sucursal['email'];?></p>
                </div>
                <div class="modal-footer">
                <button type="button" class="btn btn-dark" data-bs-dismiss="modal">Cerrar</button>
                </div>
            </div>
        </div>
    </div>
    <script>
        const modal = new bootstrap.Modal(document.getElementById('verSucursalModal'));
        modal.show();
    </script>
    <?php } ?>

 <!-- FIN MODAL VER EMPLEADO -->

</body>
</html>