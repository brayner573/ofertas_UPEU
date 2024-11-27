<link href="themplates/vendor/fontawesome-free/css/all.min.css" rel="stylesheet" type="text/css">

<?php
include("../includes/head.php");
?>

<!-- Begin Page Content -->
<div class="container-fluid d-flex justify-content-center mt-5">

  <div class="col-md-8"> <!-- Ajusta el tamaño del contenedor aquí -->
    <h1 class="text-center mb-4">Registro de Empresas</h1>
    <!-- Inicio Zona central del sistema -->

    <form method="POST" action="guardar_empresa.php" class="bg-light p-4 rounded shadow-sm">

      <div class="form-group row">
        <label for="txt_razon_social" class="col-sm-3 col-form-label">Razón Social</label>
        <div class="col-sm-9">
          <input type="text" class="form-control" name="txt_razon_social" required placeholder="Ingrese la razón social">
        </div>
      </div>

      <div class="form-group row">
        <label for="txt_ruc" class="col-sm-3 col-form-label">RUC</label>
        <div class="col-sm-9">
          <input type="text" class="form-control" name="txt_ruc" id="txt_ruc" pattern="\d{11}" title="Debe contener exactamente 11 dígitos numéricos" required placeholder="Ingrese el RUC">
        </div>
      </div>

      <div class="form-group row">
        <label for="txt_direccion" class="col-sm-3 col-form-label">Dirección</label>
        <div class="col-sm-9">
          <input type="text" class="form-control" name="txt_direccion" required placeholder="Ingrese la dirección">
        </div>
      </div>

      <div class="form-group row">
        <label for="txt_correo" class="col-sm-3 col-form-label">Correo</label>
        <div class="col-sm-9">
          <input type="email" class="form-control" name="txt_correo" id="txt_correo" pattern="[a-z0-9._%+-]+@(gmail\.com|hotmail\.com)" title="Debe ser un correo válido @gmail.com o @hotmail.com" required placeholder="Ingrese un correo válido">
        </div>
      </div>

      <div class="form-group row">
        <label for="txt_telefono" class="col-sm-3 col-form-label">Teléfono</label>
        <div class="col-sm-9">
          <input type="text" class="form-control" name="txt_telefono" id="txt_telefono" pattern="[0-9+\-() ]+" title="Solo números y símbolos permitidos" required placeholder="Ingrese el número de teléfono">
        </div>
      </div>

      <div class="form-group row">
        <div class="col-sm-9 offset-sm-3">
          <button type="submit" class="btn btn-primary btn-block">Guardar Empresa</button>
        </div>
      </div>

    </form>
  </div>
</div>

<?php
include("../includes/foot.php");
?>

<script>
document.getElementById('txt_ruc').addEventListener('input', function (e) {
    var value = e.target.value;
    // Solo permite números
    e.target.value = value.replace(/\D/g, '').slice(0, 11); // Máximo 11 dígitos
});

document.getElementById('txt_telefono').addEventListener('input', function (e) {
    var value = e.target.value;
    // Solo permite números, +, -, (, ) y espacios
    e.target.value = value.replace(/[^0-9+\-() ]/g, '');
});
</script>
