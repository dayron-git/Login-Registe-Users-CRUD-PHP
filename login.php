<?php 
   session_start();

   $error='';
   if (isset($_SESSION['error'])) {
       $error = $_SESSION['error'];
       unset($_SESSION['error']);
   }
?>
<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.3/dist/css/bootstrap.min.css" rel="stylesheet" integrity="sha384-QWTKZyjpPEjISv5WaRU9OFeRpok6YctnYmDr5pNlyT2bRjXh0JMhjY6hW+ALEwIH" crossorigin="anonymous">
    <link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/bootstrap-icons/font/bootstrap-icons.css">
    <script src="https://kit.fontawesome.com/25d0b10283.js" crossorigin="anonymous"></script>
   
    <link  href="css/mystyle.css" rel="stylesheet">
    <title>Luna Store</title>
</head>
<body>
    <?php 
        include "header.php"
    ?>


    <div class="container-fluid text-center my-5 px-5">
        <h2>Inicia sesión</h2>
        <p class="mb-0">Escribe tus datos correctamente.</p>
    </div>
    
    <div class="container-fluid my-5 px-5">


        <?php if (!empty($error)): ?>
            <div class="alert alert-danger text-center">
                <?php echo $error;?>
            </div>
        <?php endif; ?>


        <form action="login_registrando.php" method="POST" >
            <div class="form-group ">
                <label class="col-forml-label py-2">Usuario: </label>
                <input name="user" class="form-control" type="text"  placeholder="Username">
            </div>
            <div class="form-group">
                <label class="col-forml-label py-2">Contraseña: </label>
                <input id="pass" name="pass" class="form-control" type="password" placeholder="Password">
                <i style="display:flex; justify-content:end;" class="fa-regular fa-eye"></i>
            </div>

            <div class="text-center mb-5">
                <input class="btn btn-info mt-3 px-5" type="submit" value="Ingresar">
            </div>

            <p class="text-center pb-5">¿Todavia no tienes una cuenta? <strong><ins> <a href="registro.php">Registrate aqui</a></ins></strong> </p>
        </form>
    </div>
    <script src="myjs/contra.js"></script>
   
    <?php 
        include "footer.php"
    ?>
   
</body>
</html>