<nav class="navbar navbar-expand-lg bg-info bg-gradient py-3">
  <div class="container-fluid mx-3">
      <a class="miinicio navbar-brand fw-bold" href="index.php">Inicio</a>
      <button class="navbar-toggler" type="button" data-bs-toggle="collapse" data-bs-target="#navbarNav" aria-controls="navbarNav" aria-expanded="false" aria-label="Toggle navigation">
        <span class="navbar-toggler-icon"></span>
      </button>
      <div class="collapse navbar-collapse" id="navbarNav">
        <ul class="navbar-nav">
            <li class="nav-item">
              <a class="mimenu nav-link fw-bold" aria-current="page" href="empleados.php">Empleados</a>
            </li>
            <li class="nav-item">
              <a class="mimenu nav-link fw-bold" href="productos.php">Productos</a>
            </li>
            <li class="nav-item">
              <a class="mimenu nav-link fw-bold" href="sucursales.php">Sucursales</a>
            </li>
            <li class="nav-item">
              <a class="mimenu nav-link fw-bold" href="contacto.php">Contacto</a>
            </li>
        </ul>
      </div>    
      <?php if (isset($_SESSION['user'])): ?>
        <a class='miadmin nav-link fw-bold' href='welcome.php'> <i class='fa-solid fa-user'></i><span> Bienvenido, <?php echo ($_SESSION['user']);?>    </span></a>        
        <span class=" nav-link fw-bold mx-1"> - </span>
        <a class=' micerrarsesion nav-link fw-bold' href='logout.php'>  Cerrar Sesión</a>        
      <?php else:?>
        <a class='misesion nav-link fw-bold' href='login.php'>Iniciar Sesión</a>
      <?php endif; ?>

    </div>
  </nav>