<?php 
   session_start();
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
    <!--CAROUSEL-->
    <div id="carouselExampleIndicators" class="carousel slide">
    <div class="carousel-indicators">
        <button type="button" data-bs-target="#carouselExampleIndicators" data-bs-slide-to="0" class="active" aria-current="true" aria-label="Slide 1"></button>
        <button type="button" data-bs-target="#carouselExampleIndicators" data-bs-slide-to="1" aria-label="Slide 2"></button>
        <button type="button" data-bs-target="#carouselExampleIndicators" data-bs-slide-to="2" aria-label="Slide 3"></button>
    </div>
    <div class=" carousel-inner">
        <div class="mio2 carousel-item active">
        <img src="images/1-2.jpg" class="d-block">
        </div>
        <div class="mio carousel-item">
        <img src="images/1-3.jpg" class="d-block ">
        </div>
        <div class="mio carousel-item"> 
        <img src="images/1-4.jpg" class="d-block ">
        </div>
    </div>
    <button class="carousel-control-prev" type="button" data-bs-target="#carouselExampleIndicators" data-bs-slide="prev">
        <span class="carousel-control-prev-icon" aria-hidden="true"></span>
        <span class="visually-hidden">Previous</span>
    </button>
    <button class="carousel-control-next" type="button" data-bs-target="#carouselExampleIndicators" data-bs-slide="next">
        <span class="carousel-control-next-icon" aria-hidden="true"></span>
        <span class="visually-hidden">Next</span>
    </button>
    </div>  
      
    <!---->
    <div class="container-fluid ">
        <h2 class="text-center pt-4">Nuevos Productos</h2>
        <div class="row d-flex justify-content-around" >
            <div class="col-md-3 col-sm-6 mt-4 mb-4 p-0">
                <h3>Platos de aluminio</h3>
                <a href=""><img src="images/a.png" class="miimg img-fluid" alt="3DS slim digital" > </a>
                <p>Los platos de aluminio para mascotas son resistentes, ligeros y fáciles de limpiar. Ofrecen una opción duradera e higiénica para servir comida y agua a perros y gatos.</p>
                <button class="boton1 btn-md"> Comprar <i class="fa-solid fa-cart-shopping"></i></button>
                <button class="boton2 btn-md">Ver mas</button>
            </div>
            <div class="col-md-3 col-sm-6 mt-4 mb-4 p-0">
                <h3>Juguetes para mordedura</h3>
                <a href=""> <img src="images/b.png" class="miimg img-fluid" alt="3DS slim digital" ></a>
                <p>Estos juguetes son duraderos y diseñados para satisfacer su instinto natural de masticar. Ayudan a mantener la salud dental y proporcionan entretenimiento, evitando el aburrimiento.</p>
                <button class="boton1 btn-md"> Comprar <i class="fa-solid fa-cart-shopping"></i></button>
                <button class="boton2  btn-md">Ver mas</button>
            </div>
            <div class="col-md-3 col-sm-6 mt-4 mb-4 p-0">
                <h3>Camas</h3>
                <a href=""><img src="images/c.png" class="miimg img-fluid" alt="3DS slim digital" ></a>
                <p>Estas camas que brindan comodidad y soporte, ofreciendo un lugar acogedor para descansar. Están disponibles en diversos tamaños y materiales, adaptándose a las necesidades de cada mascota.</p>
                <button class="boton1 btn-md"> Comprar <i class="fa-solid  fa-cart-shopping"></i></button>
                <button class="boton2  btn-md">Ver mas</button>
            </div>
        </div>
    </div>

    <!--COMMENTS-->
    <section class="bg-info">
        <div class="container  py-5">
            <div class="row d-flex justify-content-center">
            <div class="col-md-12 col-lg-10">
                <div class="card text-body">
                <div class="card-body p-4">
                    <h4 class="mb-0">Comentarios recientes</h4>
                    <br>

                    <div class="d-flex flex-start">
                    <img class="rounded-circle shadow-1-strong me-3"
                        src="images/avatar.png" alt="avatar" width="60"
                        height="60" />
                    <div>
                        <h6 class="fw-bold mb-1">Valentina Romero</h6>
                        <div class="d-flex align-items-center mb-3">
                        <p class="mb-0">
                            Marzo 07, 2024
                        </p>
                        </div>
                        <p class="mb-0">
                        Los platos de aluminio para perros son una opción práctica y duradera para la alimentación de nuestras mascotas. Son ligeros, fáciles de limpiar y no retienen olores, lo que garantiza una buena higiene. Además, su resistencia a las mordeduras y disponibilidad en varios tamaños los convierten en una elección ideal para cualquier dueño responsable.
                        </p>
                    </div>
                    </div>
                </div>

                <hr class="my-0" />

                <div class="card-body p-4">
                    <div class="d-flex flex-start">
                    <img class="rounded-circle shadow-1-strong me-3"
                        src="images/avatar.png" alt="avatar" width="60"
                        height="60" />
                    <div>
                        <h6 class="fw-bold mb-1">Ana Herrera</h6>
                        <div class="d-flex align-items-center mb-3">
                        <p class="mb-0">
                            Marzo 15, 2021
                        </p>
                        </div>
                        <p class="mb-0">                    
                        Las camas para mascotas son esenciales para proporcionar comodidad y un lugar acogedor para descansar. Diseñadas con materiales suaves y duraderos, ofrecen soporte para las articulaciones y ayudan a mantener a nuestras mascotas cómodas. Disponibles en diferentes tamaños y estilos, son una excelente inversión para el bienestar de nuestros compañeros peludos.
                        </p>
                    </div>
                    </div>
                </div>

                <hr class="my-0" style="height: 1px;" />

                <div class="card-body p-4">
                    <div class="d-flex flex-start">
                    <img class="rounded-circle shadow-1-strong me-3"
                        src="images/avatar.png" alt="avatar" width="60"
                        height="60" />
                    <div>
                        <h6 class="fw-bold mb-1">Pedro Lopez</h6>
                        <div class="d-flex align-items-center mb-3">
                        <p class="mb-0">
                            Marzo 24, 2024
                        </p>
                        </div>
                        <p class="mb-0">
                        Los juguetes para morder de perros son ideales para satisfacer su instinto natural de masticar y mantenerlos entretenidos. Además, ayudan a promover la salud dental al reducir la acumulación de placa. Disponibles en una variedad de materiales y texturas, son una excelente manera de evitar el aburrimiento y fomentar el ejercicio en nuestras mascotas.
                        </p>
                    </div>
                    </div>
                </div>
                </div>
            </div>
            </div>
        </div>
    </section>

    <?php 
        include "footer.php"
    ?>

</body>
</html>