<?php
include("../includes/head.php");
?>

<!-- Estilos personalizados -->
<style>
  .btn-color {
    background-color: #0e1c36;
    color: #fff;
  }

  .profile-image-pic {
    height: 150px;
    width: 150px;
    object-fit: cover;
  }

  .cardbody-color {
    background-color: #ebf2fa;
  }

  a {
    text-decoration: none;
  }

  .form-container {
    background-color: #fff;
    border-radius: 10px;
    box-shadow: 0 4px 10px rgba(0, 0, 0, 0.1);
  }

  .btn-login {
    background-color: #4CAF50;
    color: white;
    border-radius: 25px;
    font-weight: bold;
    padding: 10px 20px;
  }

  .btn-login:hover {
    background-color: #45a049;
  }
</style>

<!DOCTYPE html>
<html lang="es">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Iniciar Sesión - Bolsa Laboral</title>
    <link rel="stylesheet" href="path-to-css-file">
</head>
<body>

<div class="container mt-5">
    <h2 class="text-center mb-4">Iniciar Sesión</h2>

    <?php if (isset($_GET['error_login'])) { ?>
        <div class="alert alert-danger text-center">Usuario o contraseña incorrectos.</div>
    <?php } ?>

    <?php if (isset($_GET['noautorizado'])) { ?>
        <div class="alert alert-warning text-center">Su cuenta aún no ha sido autorizada.</div>
    <?php } ?>

    <form action="validar_login.php" method="POST" class="p-4 border rounded shadow">
        <div class="form-group">
            <label for="txt_usuario">Usuario</label>
            <input type="text" class="form-control" id="txt_usuario" name="txt_usuario" placeholder="Ingrese su usuario" required>
        </div>
        <div class="form-group">
            <label for="txt_password">Contraseña</label>
            <input type="password" class="form-control" id="txt_password" name="txt_password" placeholder="Ingrese su contraseña" required>
        </div>
        <button type="submit" class="btn btn-primary btn-block">Iniciar Sesión</button>
    </form>
</div>

</body>
</html>
