<?php 
    session_start();
    if (!isset($_SESSION['user'])) {
        header("Location: login.php");
        exit();
    };
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
    
<!-- INICIO HEADER -->
<?php
    include 'header.php';
    ?>
    <!-- FIN HEADER -->

    <div class="container mt-4 text-center mb-5">
        <h2>¡Hola, <?php echo ($_SESSION['user']); ?>!</h2>
        <p>Está conectado al sistema, con acceso completo a todas sus funcionalidades y recursos disponibles.</p>
    </div>
    <br>    
    <div class="row text-center mb-5 ">
        <div class="col-md-4">
            <a href="gestionar_empleados.php"><img src="images/em.png" class="miimg mb-3" width="200"></a>
            <h3><a href="gestionar_empleados.php" class="midanger">Gestionar Empleados</a></h3>
        </div>
        <div class="col-md-4">
            <a href="gestionar_productos.php"><img src="images/pro.png" class="miimg mb-3" width="200"></a>
            <h3><a href="gestionar_productos.php" class="midanger">Gestionar Productos</a></h3>
        </div>
        <div class="col-md-4">
            <a href="gestionar_sucursales.php"><img src="images/depa.png"  class="miimg mb-3" width="200"></a>
            <h3><a href="gestionar_sucursales.php" class="midanger">Gestionar Sucursales</a></h3>
        </div>
    </div>
    <br><br><br><br>
     <!-- INICIO FOOTER -->
     <?php
    include 'footer.php';
    ?>
    <!-- FINI FOOTER -->


    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.3/dist/js/bootstrap.bundle.min.js" integrity="sha384-YvpcrYf0tY3lHB60NNkmXc5s9fDVZLESaAA55NDzOxhy9GkcIdslK1eN7N6jIeHz" crossorigin="anonymous"></script>
</body>
</html>