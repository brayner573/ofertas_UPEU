<!-- Incluimos los archivos necesarios para usar Bootstrap y JQuery -->
<link href="https://cdn.jsdelivr.net/npm/bootstrap@4.5.2/dist/css/bootstrap.min.css" rel="stylesheet">
<script src="https://cdnjs.cloudflare.com/ajax/libs/jquery/3.5.1/jquery.min.js"></script>
<script src="https://cdn.jsdelivr.net/npm/bootstrap@4.5.2/dist/js/bootstrap.bundle.min.js"></script>

<?php include("../includes/head.php"); ?>

<!-- Begin Page Content -->
<div class="container-fluid d-flex justify-content-center mt-5">
  <div class="col-md-8">
    <h1 class="text-center mb-4">Registro de Oferta Laboral</h1>

    <!-- Formulario de Registro de Oferta -->
    <form method="POST" action="guardar_oferta.php" novalidate>
      
      <div class="form-group row">
        <label for="txt_titulo" class="col-sm-3 col-form-label">Título</label>
        <div class="col-sm-9">
          <input type="text" class="form-control" name="txt_titulo" id="txt_titulo" placeholder="Ingrese el título" required>
          <div class="invalid-feedback">Por favor, ingrese el título de la oferta.</div>
        </div>
      </div>

      <div class="form-group row">
        <label for="txt_descripcion" class="col-sm-3 col-form-label">Descripción</label>
        <div class="col-sm-9">
          <textarea class="form-control" name="txt_descripcion" id="txt_descripcion" rows="3" placeholder="Descripción de la oferta" required></textarea>
          <div class="invalid-feedback">Por favor, ingrese una descripción.</div>
        </div>
      </div>

      <div class="form-group row">
        <label for="txt_fecha_publicacion" class="col-sm-3 col-form-label">Fecha de Publicación</label>
        <div class="col-sm-9">
          <input type="date" class="form-control" name="txt_fecha_publicacion" id="txt_fecha_publicacion" required>
          <div class="invalid-feedback">Seleccione la fecha de publicación.</div>
        </div>
      </div>

      <div class="form-group row">
        <label for="txt_hora_publicacion" class="col-sm-3 col-form-label">Hora de Publicación</label>
        <div class="col-sm-9">
          <input type="time" class="form-control" name="txt_hora_publicacion" id="txt_hora_publicacion" required>
          <div class="invalid-feedback">Seleccione la hora de publicación.</div>
        </div>
      </div>

      <div class="form-group row">
        <label for="txt_fecha_cierre" class="col-sm-3 col-form-label">Fecha de Cierre</label>
        <div class="col-sm-9">
          <input type="date" class="form-control" name="txt_fecha_cierre" id="txt_fecha_cierre" required>
          <div class="invalid-feedback">Seleccione la fecha de cierre.</div>
        </div>
      </div>

      <div class="form-group row">
        <label for="txt_hora_cierre" class="col-sm-3 col-form-label">Hora de Cierre</label>
        <div class="col-sm-9">
          <input type="time" class="form-control" name="txt_hora_cierre" id="txt_hora_cierre" required>
          <div class="invalid-feedback">Seleccione la hora de cierre.</div>
        </div>
      </div>

      <div class="form-group row">
        <label for="txt_remuneracion" class="col-sm-3 col-form-label">Remuneración (S/)</label>
        <div class="col-sm-9">
          <input type="number" class="form-control" name="txt_remuneracion" id="txt_remuneracion" placeholder="Ingrese la remuneración" min="0" step="0.01" required>
          <div class="invalid-feedback">Ingrese un monto válido de remuneración.</div>
        </div>
      </div>

      <div class="form-group row">
        <label for="txt_ubicacion" class="col-sm-3 col-form-label">Ubicación</label>
        <div class="col-sm-9">
          <input type="text" class="form-control" name="txt_ubicacion" id="txt_ubicacion" placeholder="Ubicación de la oferta" required>
          <div class="invalid-feedback">Ingrese la ubicación.</div>
        </div>
      </div>

      <div class="form-group row">
        <label for="txt_tipo" class="col-sm-3 col-form-label">Tipo de Trabajo</label>
        <div class="col-sm-9">
          <input type="text" class="form-control" name="txt_tipo" id="txt_tipo" placeholder="Tipo (e.g. Tiempo Completo)" required>
          <div class="invalid-feedback">Ingrese el tipo de trabajo.</div>
        </div>
      </div>

      <div class="form-group row">
        <label for="txt_limite_postulantes" class="col-sm-3 col-form-label">Límite de Postulantes</label>
        <div class="col-sm-9">
          <input type="number" class="form-control" name="txt_limite_postulantes" id="txt_limite_postulantes" min="1" max="99" placeholder="Ingrese el límite" required>
          <div class="invalid-feedback">Ingrese un límite válido entre 1 y 99.</div>
        </div>
      </div>

      <div class="form-group row">
        <div class="col-sm-9 offset-sm-3">
          <button type="submit" class="btn btn-primary btn-block">Guardar Oferta</button>
        </div>
      </div>

    </form>
  </div>
</div>

<?php include("../includes/foot.php"); ?>

<!-- Scripts -->
<script>
  $(document).ready(function() {
    // Validaciones adicionales para ciertos campos
    document.getElementById('txt_remuneracion').addEventListener('input', function(e) {
      var value = e.target.value;
      e.target.value = value.replace(/[^0-9.]/g, '');
    });

    document.getElementById('txt_tipo').addEventListener('input', function(e) {
      var value = e.target.value;
      e.target.value = value.replace(/[^A-Za-z\s]/g, '');
    });

    document.getElementById('txt_limite_postulantes').addEventListener('input', function(e) {
      var value = e.target.value;
      e.target.value = value.replace(/\D/g, '').slice(0, 2);
    });

    // Validación del formulario antes del envío
    (function() {
      'use strict';
      window.addEventListener('load', function() {
        var forms = document.getElementsByTagName('form');
        Array.prototype.filter.call(forms, function(form) {
          form.addEventListener('submit', function(event) {
            if (form.checkValidity() === false) {
              event.preventDefault();
              event.stopPropagation();
            }
            form.classList.add('was-validated');
          }, false);
        });
      }, false);
    })();
  });
</script>
