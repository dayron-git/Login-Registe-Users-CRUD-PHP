<?php 
  require "db.php";
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

    <div class="container-fluid mb-5 mt-4 px-5">
        <h2>Contacto</h2>
        <p>La tienda Luna PetShop, especializada en productos para mascotas. La tienda ofrece una variedad de alimentos y artículos para el cuidado de mascotas. <span style="font-weight:600">Nuestra redes la pueden encontrar en el pie de pagina :)</span></p>
    </div>
        <iframe src="https://www.google.com/maps/embed?pb=!1m18!1m12!1m3!1d25745.959226493636!2d-77.05848615988744!3d-12.07361881904511!2m3!1f0!2f0!3f0!3m2!1i1024!2i768!4f13.1!3m3!1m2!1s0x9105c9a2228bca9f%3A0xbab4eff3ab2add55!2sPet%20Shop%20Mimascota!5e0!3m2!1ses-419!2spe!4v1728757779638!5m2!1ses-419!2spe" width="100%" height="400"  allowfullscreen="" loading="lazy" referrerpolicy="no-referrer-when-downgrade"></iframe>
    
        

      <div class="container" data-aos="fade-up">

        <div class="row mt-5">

          <div class="col-lg-4">
            <div class="info">
              <div class="address">
                <h4>Locacion:</h4>
                <p>Av Horacio Urteaga 452, Jesús María 15083, Lima</p>
              </div>
              <hr>

              <div class="open-hours">
                <h4>Horario de atencion:</h4>
                <p>
                  Lunes-Sabado:<br>
                  9:00am a 10:00pm 
                </p>
              </div>

                <hr>

              <div class="email">
                <h4>Email:</h4>
                <p>mimascotapetshop@gmail.com</p>
              </div>

            <hr>

              <div class="phone">
                <h4>Telefono:</h4>
                <p>969 715 298</p>
              </div>

            </div>

          </div>

          <div class="col-lg-8 mt-5 mt-lg-0">

            <form action="forms/contact.php" method="post" role="form" class="php-email-form">
              <div class="row">
                <div class="col-md-6 form-group">
                  <input type="text" name="name" class="form-control border-info" id="name" placeholder="Nombres" required>
                </div>
                <div class="col-md-6 form-group mt-3 mt-md-0">
                  <input type="email" class="form-control border-info" name="email" id="email" placeholder="E-mail" required>
                </div>
              </div>
              <div class="form-group mt-3">
                <input type="text" class="form-control border-info" name="subject" id="subject" placeholder="Asunto" required>
              </div>
              <div class="form-group mt-3">
                <textarea class="form-control border-info" name="message" rows="8" placeholder="Mensaje" required></textarea>
              </div>
              <div class="text-center my-4"><button class="boton1" type="submit">Enviar mensaje</button></div>
            </form>

          </div>

        </div>

      </div>
    </section>

    </div>

    <?php 
        include "footer.php"
    ?>

</body>
</html>