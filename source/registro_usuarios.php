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

<div class="container-fluid d-flex justify-content-center mt-5">
    <div class="col-md-8"> <!-- Ajusta el tamaño del contenedor aquí -->
        <h1 class="text-center mb-4">Registro de Nuevos Usuarios</h1>

        <form method="POST" action="guardar_usuario.php" class="bg-light p-4 rounded shadow-sm">
            <!-- DNI, Nombres y Apellidos (solo visibles para Postulante) -->
            <div class="form-group row" id="dni_field">
                <label for="txt_dni" class="col-sm-3 col-form-label">DNI</label>
                <div class="col-sm-9">
                    <input type="text" class="form-control" name="txt_dni" id="txt_dni" pattern="\d{8}" title="Debe contener exactamente 8 dígitos numéricos" placeholder="Ingrese el DNI">
                </div>
            </div>

            <div class="form-group row" id="nombres_field">
                <label for="txt_nombres" class="col-sm-3 col-form-label">Nombres</label>
                <div class="col-sm-9">
                    <input type="text" class="form-control" name="txt_nombres" id="txt_nombres" pattern="[A-Za-z\s]+" title="Solo letras y espacios permitidos" placeholder="Ingrese los nombres">
                </div>
            </div>

            <div class="form-group row" id="apellidos_field">
                <label for="txt_apellidos" class="col-sm-3 col-form-label">Apellidos</label>
                <div class="col-sm-9">
                    <input type="text" class="form-control" name="txt_apellidos" id="txt_apellidos" pattern="[A-Za-z\s]+" title="Solo letras y espacios permitidos" placeholder="Ingrese los apellidos">
                </div>
            </div>

            <!-- Campos adicionales para Empresa -->
            <div id="empresa_fields" style="display: none;">
                <div class="form-group row">
                    <label for="txt_ruc" class="col-sm-3 col-form-label">RUC</label>
                    <div class="col-sm-9">
                        <input type="text" class="form-control" name="txt_ruc" id="txt_ruc" pattern="\d{11}" title="Debe contener exactamente 11 dígitos numéricos" placeholder="Ingrese el RUC">
                    </div>
                </div>

                <div class="form-group row">
                    <label for="txt_razon_social" class="col-sm-3 col-form-label">Razón Social</label>
                    <div class="col-sm-9">
                        <input type="text" class="form-control" name="txt_razon_social" id="txt_razon_social" placeholder="Ingrese la Razón Social">
                    </div>
                </div>
            </div>

            <div class="form-group row">
                <label for="txt_usuario" class="col-sm-3 col-form-label">Usuario</label>
                <div class="col-sm-9">
                    <input type="text" class="form-control" name="txt_usuario" required placeholder="Ingrese el nombre de usuario">
                </div>
            </div>

            <div class="form-group row">
                <label for="txt_contrasenia" class="col-sm-3 col-form-label">Contraseña</label>
                <div class="col-sm-9">
                    <input type="password" class="form-control" name="txt_contrasenia" required placeholder="Ingrese la contraseña">
                </div>
            </div>

            <!-- Selección del tipo de usuario -->
            <div class="form-group row">
                <label for="txt_rol" class="col-sm-3 col-form-label">Tipo de Usuario</label>
                <div class="col-sm-9">
                    <select class="form-control" name="txt_rol" id="txt_rol" required onchange="toggleFields()">
                        <option value="3">Postulante</option>
                        <option value="2">Empresa</option>
                        <option value="1">Administrador</option>
                    </select>
                </div>
            </div>

            <div class="form-group row">
                <div class="col-sm-9 offset-sm-3">
                    <button type="submit" class="btn btn-primary btn-block">Guardar Usuario</button>
                </div>
            </div>
        </form>
    </div>
</div>

<script>
    // Función para mostrar/ocultar campos según el tipo de usuario
    function toggleFields() {
        var tipoUsuario = document.getElementById("txt_rol").value;
        var empresaFields = document.getElementById("empresa_fields");
        var dniField = document.getElementById("dni_field");
        var nombresField = document.getElementById("nombres_field");
        var apellidosField = document.getElementById("apellidos_field");

        if (tipoUsuario == "2") {
            empresaFields.style.display = "block";
            dniField.style.display = "none";
            nombresField.style.display = "none";
            apellidosField.style.display = "none";
        } else {
            empresaFields.style.display = "none";
            dniField.style.display = "flex";
            nombresField.style.display = "flex";
            apellidosField.style.display = "flex";
        }
    }

    // Ejecutar la función al cargar la página
    toggleFields();
</script>

<?php
include("../includes/foot.php");
?>
