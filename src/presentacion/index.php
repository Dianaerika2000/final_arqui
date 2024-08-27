<?php
define('PROJECT_URL', 'http://localhost:80/plantilla3C/');
?>
<!DOCTYPE html>
<html lang="en">

<head>
  <meta charset="UTF-8">
  <meta name="viewport" content="width=device-width, initial-scale=1.0">
  <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.2/dist/css/bootstrap.min.css" rel="stylesheet" integrity="sha384-T3c6CoIi6uLrA9TneNEoa7RxnatzjcDSCmG1MXxSR1GAsXEV/Dwwykc2MPK8M2HN" crossorigin="anonymous">
  <link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/bootstrap-icons@1.11.1/font/bootstrap-icons.css">
  <title>Examen Final</title>
  <style>
    .icono {
      font-size: 50px;
    }
  </style>
</head>

<body>
  <nav class="navbar navbar-expand-lg bg-primary" data-bs-theme="dark">
    <div class="container-fluid">
      <a class="navbar-brand" href="#">Nombre de la App</a>
      <button class="navbar-toggler" type="button" data-bs-toggle="collapse" data-bs-target="#navbarNav" aria-controls="navbarNav" aria-expanded="false" aria-label="Toggle navigation">
        <span class="navbar-toggler-icon"></span>
      </button>
      <div class="collapse navbar-collapse justify-content-center" id="navbarNav">
        <!-- <ul class="navbar-nav">
          <li class="nav-item">
            <a class="nav-link active" href="<?php echo constant('PROJECT_URL'); ?>src/presentacion/PEvento/PEventoList.php">Eventos</a>
          </li>
          <li class="nav-item">
            <a class="nav-link active" href="<?php echo constant('PROJECT_URL'); ?>src/presentacion/PInvitado/PInvitadoList.php">Invitados</a>
          </li>
          <li class="nav-item">
            <a class="nav-link active" href="<?php echo constant('PROJECT_URL'); ?>src/presentacion/PAcceso/PAccesoCreate.php">Control de Acceso</a>
          </li>
        </ul> -->
      </div>
    </div>
  </nav>


  <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.2/dist/js/bootstrap.bundle.min.js" integrity="sha384-C6RzsynM9kWDrMNeT87bh95OGNyZPhcTNXj1NW7RuBCsyN/o0jlpcV8Qyq46cDfL" crossorigin="anonymous"></script>
</body>

</html>