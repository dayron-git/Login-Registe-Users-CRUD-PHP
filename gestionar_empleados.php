<?php 
    require "db.php";
    session_start();

    if (!isset($_SESSION['user'])) {
        header("Location: login.php");
        exit();
    };

    $search = isset($_GET['search']) ? $_GET['search']: '';
    $sql = "SELECT nombre ,puesto,email,telefono, id FROM empleados WHERE nombre LIKE '%$search%' OR puesto LIKE'%$search%'OR email LIKE'%$search%' OR telefono LIKE'%$search%' OR id LIKE '%$search%'";
    $result= $conn -> query($sql);


  if (isset($_POST['delete_employee_id'])) {
    $employee_id = $_POST['delete_employee_id'];

    $stmt = $conn -> prepare("DELETE FROM empleados WHERE id = ?");
    $stmt -> bind_param("i",$employee_id);

    if ($stmt -> execute()) {
        echo "<script>alert('Empleado eliminado con exito');</script>";
        header("Location: gestionar_empleados.php");
        exit(); 
    } else {
        echo "<script>alert('Error al elimiar emlpeado');</script>";
    }
  }


  if (isset($_GET['view_employee_id'])) {
    $employee_id = $_GET['view_employee_id'];

    $stmt = $conn -> prepare("SELECT * FROM empleados WHERE id =? ");
    $stmt -> bind_param("i",$employee_id);
    $stmt -> execute();
    $employee = $stmt ->get_result()->fetch_assoc();
    $stmt->close();
  }

  
// PROCESAR EDICIÓN DE EMPLEADO
if (isset($_POST['edit_employee_id'])) {
    $id = $_POST['edit_employee_id'];
    $nombre = $_POST["nombre1"];
    $puesto = $_POST["puesto1"];
    $email = $_POST["email1"];
    $telefono = $_POST["telefono1"];

    // Validar que los datos estén completos
    if (!empty($id) && !empty($nombre) && !empty($puesto) && !empty($email) && !empty($telefono)) {
        $stmt = $conn->prepare("UPDATE empleados SET nombre = ?, puesto = ?, email = ?, telefono = ? WHERE id = ?");
        $stmt->bind_param("ssssi", $nombre, $puesto, $email, $telefono, $id);

        if ($stmt->execute()) {
            echo "<script>alert('Empleado actualizado con éxito'); window.location.href='gestionar_empleados.php';</script>";
            
        } else {
            echo "<script>alert('Error al actualizar el empleado: " . $stmt->error . "');</script>";
        }

        $stmt->close();
    } else {
        echo "<script>alert('Por favor, completa todos los campos.');</script>";
    }
}

    if ($_SERVER['REQUEST_METHOD'] == 'POST'){
    $nombre = $_POST['nombre'];
    $puesto= $_POST['puesto'];
    $email= $_POST['email'];
    $telefono = $_POST['telefono'];
   


    $stmt = $conn -> prepare("INSERT INTO empleados(nombre, puesto, email, telefono) VALUES (?,?,?,?)");
    $stmt -> bind_param("sssi", $nombre, $puesto, $email, $telefono);

    if ($stmt -> execute()) {
        echo "<script>alert('Registro creado con éxito'); window.location.href='gestionar_empleados.php';</script>";
       
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
        <h2>Empleados</h2>
        
        <div class="row mt-4 ">
            <form class="col-9 d-flex align-items-center ">
                <input class="form-control border-dark me-2" type="search" name="search" placeholder="Ingrese empleado" method="GET" value="<?php echo $search ?>">
                <button class="btn btn-outline-dark" type="submit "><i class="fa-solid fa-magnifying-glass"></i></button>
            </form>
            <div class="col-3 px-0">
                <input  type="submit" class="btn btn-dark px-4" data-bs-toggle="modal" data-bs-target="#agregarEmpleado" value="Nuevo Empleado">
                <button class="btn btn-outline-dark mx-1 px-4" >Descargar</button>
            
            </div>
        </div>
        <br>
      

        <?php if($result -> num_rows > 0){?>    
            <table class="table tabble-stripped">
                <thead class="table-dark">
                    <th>Nombre</th>
                    <th>Puesto</th>
                    <th></th>
                    <th></th>                   
                    <th></th>                   
                </thead>
                <tbody>
                    <?php  while ($row = $result-> fetch_assoc()) {?>
                        <tr class="table-warning">
                            <td> <?php echo $row["nombre"]?></td>
                            <td> <?php echo $row["puesto"]?></td>
                            <td class="d-none"> <?php echo $row["email"]?></td>
                            <td class="d-none"> <?php echo $row["telefono"]?></td>
                            <td> 
                                <form method="GET">
                                    <input type="hidden" name="view_employee_id" value="<?php echo $row['id'];?>" >
                                    <button type="submit" class="btn btn-success px-4" data-bs-toggle="modal" data-bs-target="#verEmpleadoModal"><i class="fa-solid fa-eye"></i></button>
                                </form>
                            </td>
                            <td class="option">
                                <form method="POST">
                                    <input type="hidden" name="edit_employee_id" value ="<?php echo $row['id']; ?> ">
                                    <button type="button" class="btn btn-warning px-4" data-bs-toggle="modal" data-bs-target="#editarEmpleadoModal">
                                    <i class="fa-solid fa-pen"></i></button>
                                </form>
                             </td>
                            <td class="option">
                                <form method="POST" onsubmit="return confirm('¿Está seguro de que deseas eliminar el empleado?');">
                                    <input type="hidden" name="delete_employee_id" value="<?php echo $row['id'];?>">
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

    <!-- INICIO MODAL AGREGAR  EMPLEADO-->
    <div class="modal fade" id="agregarEmpleado" tabindex="-1" aria-labelledby="agregarEmpleado" aria-hidden="true">
        <div class="modal-dialog">
        <div class="modal-content">
            <div class="modal-header bg-warning">
                <h5 class="modal-title" id="agregarEmpleado">Agregar Nuevo Empleado</h5>
                <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Cerrar"></button>
            </div>
            <div class="modal-body">
                <form action="" method="POST">
                    <div class="mb-3">
                        <label> Nombre </label>
                        <input type="text" class="form-control border-dark" name="nombre"  required>
                    </div>
                    <div class="mb-3">
                        <label> Cargo </label>
                        <input type="text" class="form-control border-dark" name="puesto"  required>
                    </div>
                    <div class="mb-3">
                        <label> Correo electronico </label>
                        <input type="email" class="form-control border-dark" name="email"  required>
                    </div>
                    <div class="mb-3">
                        <label> Telefono </label>
                        <input type="number" class="form-control border-dark" name="telefono" required>
                    </div>
                    <hr>
                    <div class="d-flex justify-content-between">
                        <input type="submit" value="Crear empleado" class="btn btn-dark px-5" required >
                        <input type="button" value="Cerrar" class="btn btn-dark" data-bs-dismiss="modal" aria-label="Cerrar">
                    </div>
    
                </form>
            </div>
        </div>
        </div>
    </div>
    <!-- FIN MODAL AGREGAR  EMPLEADO-->

    
    <?php 
        include "footer.php"
    ?>

        <!-- Modal Editar Empleado -->
<div class="modal fade" id="editarEmpleadoModal" tabindex="-1" aria-labelledby="editarEmpleadoModalLabel" aria-hidden="true">
    <div class="modal-dialog">
        <div class="modal-content">
            <div class="modal-header bg-warning">
                <h5 class="modal-title" id="editarEmpleadoModalLabel">Editar Empleado</h5>
                <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Cerrar"></button>
            </div>
            <div class="modal-body">
                <form action="" method="POST">
                    <input type="hidden" name="edit_employee_id" id="edit_employee_id">
                    <div class="mb-3">
                        <label>Nombre</label>
                        <input type="text" name="nombre1" id="edit_nombre" class="form-control" >
                    </div>
                    <div class="mb-3">
                        <label>Puesto</label>
                        <input type="text" name="puesto1" id="edit_puesto" class="form-control" >
                    </div>
                    <div class="mb-3">
                        <label>Email</label>
                        <input type="email" name="email1" id="edit_email" class="form-control" >
                    </div>
                    <div class="mb-3">
                        <label>Teléfono</label>
                        <input type="number" name="telefono1" id="edit_telefono" class="form-control" >
                    </div>
                    <div class="d-flex justify-content-between">
                        <input type="submit" value="Actualizar datos" class="btn btn-dark px-5" >
                        <input type="button"  value="Cerrar" class="btn btn-dark" data-bs-dismiss="modal" aria-label="Cerrar">
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
            const id = row.querySelector('input[name="edit_employee_id"]').value.trim();
            const nombre = row.children[0].textContent.trim();
            const puesto = row.children[1].textContent.trim();
            const email = row.children[2].textContent.trim();
            const telefono = row.children[3].textContent.trim();

            // Rellenar los datos en el modal
            document.getElementById('edit_employee_id').value = id;
            document.getElementById('edit_nombre').value = nombre;
            document.getElementById('edit_puesto').value = puesto;
            document.getElementById('edit_email').value = email;
            document.getElementById('edit_telefono').value = telefono;
                
        });
    });
});

//FIN MODAL EDITAR EMPLEADO//
</SCript>
     

    <!-- INICIO MODAL VER EMPLEADO -->
    <?php if (isset($employee)) { ?>
    <div class="modal fade" tabindex="-1" id="verEmpleadoModal" aria-labelledby="verEmpleadoModal" aria-hidden="true">
        <div class="modal-dialog">
            <div class="modal-content">
                <div class="modal-header bg-warning">
                    <h5 class="modal-title" id="verEmpleadoModal">Detalles del Empleado</h5>
                    <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Cerrar"></button>
                </div>
                <div class="modal-body">
                    <p><strong>Nombre: </strong><?php echo $employee['nombre']; ?></p>
                    <p><strong>Cargo: </strong><?php echo $employee['puesto']; ?></p>
                    <p><strong>Email: </strong><?php echo $employee['email']; ?></p>
                    <p><strong>Telefono: </strong><?php echo $employee['telefono']; ?></p>
                </div>
                <div class="modal-footer">
                    <button type="button" class="btn btn-dark" data-bs-dismiss="modal">Cerrar</button>
                </div>
            </div>
        </div>
    </div>
    <script>
        const modal = new bootstrap.Modal(document.getElementById('verEmpleadoModal'));
        modal.show();
    </script>
<?php } ?>

    
   
   

 <!-- FIN MODAL VER EMPLEADO -->

</body>
</html>