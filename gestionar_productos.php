<?php 
    require "db.php";
    session_start();

    if (!isset($_SESSION['user'])) {
        header("Location: login.php");
        exit();
    };

    $search = isset($_GET['search']) ? $_GET['search']: '';
    $sql = "SELECT nombre,precio,descripcion,stock,id FROM productos WHERE nombre LIKE '%$search%' OR precio LIKE '%$search%' OR descripcion LIKE '%$search%' OR stock LIKE '%$search%' OR id LIKE '%$search%'";
    $result1 = $conn -> query($sql);

   
  if (isset($_POST['delete_product_id'])) {
    $product_id = $_POST['delete_product_id'];

    $stmt = $conn -> prepare("DELETE FROM productos WHERE id = ?");
    $stmt -> bind_param("i",$product_id);

    if ($stmt -> execute()) {
        echo "<script>alert('Producto eliminado con exito');</script>";
        header("Location: gestionar_productos.php");
    } else {
        echo "<script>alert('Error ');</script>";
    }
  }

// PROCESAR EDICIÓN 
if (isset($_POST['edit_product_id'])) {
    $id = $_POST['edit_product_id'];
    $precio = $_POST["precio1"];
    $nombre = $_POST["nombre1"];
    $descripcion = $_POST["descripccion1"];
    $stock = $_POST["stock1"];

    // Validar que los datos estén completos
    if (!empty($id) && !empty($nombre) && !empty($precio) && !empty($descripcion) && !empty($stock)) {
        $stmt = $conn->prepare("UPDATE productos SET nombre = ?, precio = ?, descripcion = ?, stock = ? WHERE id = ?");
        $stmt->bind_param("ssssi", $nombre, $precio, $descripcion, $stock, $id);

        if ($stmt->execute()) {
            echo "<script>alert('Producto actualizado con éxito'); window.location.href='gestionar_productos.php';</script>";
            exit();
        } else {
            echo "<script>alert('Error al actualizar el producto: " . $stmt->error . "');</script>";
        }

        $stmt->close();
    } else {
        echo "<script>alert('Por favor, completa todos los campos.');</script>";
    }
}

  if (isset($_GET['view_product_id'])) {
    $product_id = $_GET['view_product_id'];

    $stmt = $conn -> prepare("SELECT * FROM productos WHERE id =? ");
    $stmt -> bind_param("i",$product_id);
    $stmt -> execute();
    $product = $stmt ->get_result()->fetch_assoc();
    $stmt->close();
  }

    if ($_SERVER['REQUEST_METHOD'] == 'POST'){
    $nombre = $_POST['nombre'];
    $precio= $_POST['precio'];
    $descripcion= $_POST['descripcion'];
    $stock = $_POST['stock'];
   

    $stmt = $conn -> prepare("INSERT INTO productos(nombre, precio, descripcion, stock) VALUES (?,?,?,?)");
    $stmt -> bind_param("sssi", $nombre, $precio, $descripcion, $stock);

    if ($stmt -> execute()) {
        echo "<script>alert('Registro creado con éxito'); window.location.href='gestionar_productos.php';</script>";
       
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
        <h2>Productos</h2>

        <div class="row mt-4 ">
            <form class="col-9 d-flex align-items-center ">
                <input class="form-control border-dark me-2" type="search" name="search" placeholder="Ingrese producto" method="GET" value="<?php echo $search ?>">
                <button class="btn btn-outline-dark" type="submit "><i class="fa-solid fa-magnifying-glass"></i></button>
            </form>
            <div class="col-3 px-0">
                <input  type="submit" class="btn btn-dark px-4" data-bs-toggle="modal" data-bs-target="#agregarProducto" value="Nuevo Producto">
                <button class="btn btn-outline-dark mx-1 px-4" >Descargar</button>
            
            </div>
        </div>
        <br>

        <?php if($result1 -> num_rows > 0){?>    
            <table class="table tabble-stripped">
                <thead class="table-dark">
                    <th>Nombre</th>
                    <th>Descripción</th>
                    <th></th>
                    <th></th>
                    <th></th>
                
                    
                </thead>
                <tbody>
                    <?php  while ($row = $result1 -> fetch_assoc()) {?>
                        <tr class="table-warning">
                            <td> <?php echo $row["nombre"]?></td>
                            <td class="d-none"> <?php echo $row["precio"]?></td>
                            <td> <?php echo $row["descripcion"]?></td>
                            <td class="d-none"> <?php echo $row["stock"]?></td>
                            <td> 
                                <form method="GET">
                                    <input type="hidden" name="view_product_id" value="<?php echo $row['id'];?>">
                                    <button type="submit" class="btn btn-success px-4"><i class="fa-solid fa-eye" data-bs-toggle="modal" data-bs-target="#verProductoModal"></i></button>
                                </form>    
                            </td>
                            <td class="option">
                                <form method="POST">
                                    <input type="hidden" name="edit_product_id" value ="<?php echo $row['id']; ?> ">
                                    <button type="button" class="btn btn-warning px-4" data-bs-toggle="modal" data-bs-target="#editarProductoModal">
                                        <i class="fa-solid fa-pen"></i></button>
                                </form>
                             </td>
                            <td class="option">
                                <form method="POST" onsubmit="return confirm('¿Está seguro de que deseas eliminar el producto?');">
                                    <input type="hidden" name="delete_product_id" value="<?php echo $row['id'];?>">
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

    
    <!-- INICIO MODAL AGREGAR  EMPLEADO-->
    <div class="modal fade" id="agregarProducto" tabindex="-1" aria-labelledby="agregarProducto" aria-hidden="true">
        <div class="modal-dialog">
        <div class="modal-content">
            <div class="modal-header bg-warning">
                <h5 class="modal-title" id="agregarProducto">Agregar Nuevo Producto</h5>
                <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Cerrar"></button>
            </div>
            <div class="modal-body">
                <form action="" method="POST">
                    <div class="mb-3">
                        <label> Nombre: </label>
                        <input type="text" class="form-control border-dark" name="nombre" required>
                    </div>
                    <div class="mb-3">
                        <label> Precio: </label>
                        <input type="number" class="form-control border-dark" name="precio"  required>
                    </div>
                    <div class="mb-3">
                        <label> Descripción: </label>
                        <input type="text" class="form-control border-dark" name="descripcion"  required>
                    </div>
                    <div class="mb-3">
                        <label> Stock: </label>
                        <input type="number" class="form-control border-dark" name="stock" required>
                    </div>
                    <hr>
                    <div class="d-flex justify-content-between">
                    <input type="submit" value="Crear Producto" class="btn btn-dark px-5" required >
                    <input type="button" value="Cerrar" class="btn btn-dark" data-bs-dismiss="modal" aria-label="Cerrar">
                    </div>
                    
                </form>
            </div>
        </div>
        </div>
    </div>
    <!-- FIN MODAL AGREGAR  EMPLEADO-->

<!-- Modal Editar Empleado -->
<div class="modal fade" id="editarProductoModal" tabindex="-1" aria-labelledby="editarProductoModalLabel" aria-hidden="true">
    <div class="modal-dialog">
        <div class="modal-content">
            <div class="modal-header bg-warning">
                <h5 class="modal-title" id="editarProductoModalLabel">Editar Producto</h5>
                <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Cerrar"></button>
            </div>
            <div class="modal-body">
                <form action="" method="POST">
                    <input type="hidden" name="edit_product_id" id="edit_product_id">
                    <div class="mb-3">
                        <label>Nombre: </label>
                        <input type="text" name="nombre1" id="edit_nombre" class="form-control" required>
                    </div>
                    <div class="mb-3">
                        <label>Precio:</label>
                        <input type="number" name="precio1" id="edit_precio" class="form-control" required>
                    </div>
                    <div class="mb-3">
                        <label>Descripción: </label>
                        <input type="text" name="descripccion1" id="edit_descripcion" class="form-control" required>
                    </div>
                    <div class="mb-3">
                        <label>Stock: </label>
                        <input type="number" name="stock1" id="edit_stock" class="form-control" required>
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
            const id = row.querySelector('input[name="edit_product_id"]').value.trim();
            const nombre = row.children[0].textContent.trim();
            const precio = row.children[1].textContent.trim();
            const descripcion = row.children[2].textContent.trim();
            const stock = row.children[3].textContent.trim();

            // Rellenar los datos en el modal
            document.getElementById('edit_product_id').value = id;
            document.getElementById('edit_nombre').value = nombre;
            document.getElementById('edit_precio').value = precio;
            document.getElementById('edit_descripcion').value = descripcion;
            document.getElementById('edit_stock').value = stock;

    
        });
    });
});
//FIN MODAL EDITAR EMPLEADO//
</SCript>

    <!-- INICIO MODAL VER EMPLEADO -->
    <?php if (isset($product)) { ?>
    <div class="modal fade" tabindex="-1" id="verProductoModal" aria-labelledby="verProductoModal" aria-hidden="true">
        <div class="modal-dialog">
            <div class="modal-content">
                <div class="modal-header bg-warning">
                    <h5 class="modal-title" id="verProductoModal">Detalles de Producto</h5>
                    <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Cerrar"></button>
                </div>
                <div class="modal-body">
                    <p><strong>Nombre: </strong><?php echo $product['nombre'];?></p>
                    <p><strong>Precio: </strong><?php echo $product['precio'];?></p>
                    <p><strong>Descripción: </strong><?php echo $product['descripcion'];?></p>
                    <p><strong>Stock: </strong><?php echo $product['stock'];?></p>
                </div>
                <div class="modal-footer">
                <button type="button" class="btn btn-dark" data-bs-dismiss="modal">Cerrar</button>
                </div>
            </div>
        </div>
    </div>
    <script>
        const modal = new bootstrap.Modal(document.getElementById('verProductoModal'));
        modal.show();
    </script>
    <?php } ?>

 <!-- FIN MODAL VER EMPLEADO -->

</body>
</html>