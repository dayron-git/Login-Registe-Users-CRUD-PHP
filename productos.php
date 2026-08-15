<?php 
    require "db.php";
    session_start();

    $search = isset($_GET['search']) ? $_GET['search']: '';
    $sql = "SELECT nombre,precio,descripcion,stock FROM productos WHERE nombre LIKE '%$search%' OR precio LIKE '%$search%' OR descripcion LIKE '%$search%' OR stock LIKE '%$search%' ";
    $result1 = $conn -> query($sql);
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
        include "header.php"
    ?>

    <div class="container-fluid mt-4 mb-5 px-5">
        <h2>Productos</h2>

        <div class="mt-4">
            <form class="d-flex mb-4">
                <input class="form-control border-info me-2" type="search" name="search" placeholder="Ingresa producto" method="GET" value="<?php echo $search ?>">
                <button class="boton2" type="submit"><i class="fa-solid fa-magnifying-glass"></i></button>
            </form>
        </div>

        <?php if($result1 -> num_rows > 0){?>    
            <table class="table tabble-stripped ">
                <thead class="table-dark">
                    <th>Nombre</th>
                    <th>Precio</th>
                    <th>Descripción</th>     
                </thead>
                <tbody>
                    <?php  while ($row = $result1 -> fetch_assoc()) {?>
                        <tr>
                            <td> <?php echo $row["nombre"]?></td>
                            <td> <?php echo $row["precio"]?></td>
                            <td> <?php echo $row["descripcion"]?></td>
                        </tr>
                    <?php }?>
                </tbody>
            </table>        
        <?php } else {
            echo "No se encontraron datos con los criterios de busqueda ingresados.";
        }?>

    </div>
    <br><br><br><br>


    <?php 
        include "footer.php"
    ?>

</body>
</html>