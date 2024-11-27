<form class="row g-3" method="POST" action="guardar_usuario.php">
  <div class="col-md-6">
    <label for="txt_dni" class="form-label">DNI</label>
    <input type="text" class="form-control" id="txt_dni" name="txt_dni" required>
  </div>
  
  <div class="col-md-6">
    <label for="txt_nombres" class="form-label">Nombres</label>
    <input type="text" class="form-control" id="txt_nombres" name="txt_nombres" required>
  </div>
  
  <div class="col-md-6">
    <label for="txt_apellidos" class="form-label">Apellidos</label>
    <input type="text" class="form-control" id="txt_apellidos" name="txt_apellidos" required>
  </div>

  <div class="col-md-6">
    <label for="inputEmail4" class="form-label">Email</label>
    <input type="email" class="form-control" id="inputEmail4" name="txt_usuario" required>
  </div>

  <div class="col-md-6">
    <label for="inputPassword4" class="form-label">Password</label>
    <input type="password" class="form-control" id="inputPassword4" name="txt_contrasenia" required>
  </div>
  
  <div class="col-12">
    <label for="inputAddress" class="form-label">Dirección</label>
    <input type="text" class="form-control" id="inputAddress" name="txt_direccion" placeholder="Calle Principal 123" required>
  </div>

  <div class="col-md-6">
    <label for="inputCity" class="form-label">Ciudad</label>
    <input type="text" class="form-control" id="inputCity" name="txt_ciudad" required>
  </div>

  <div class="col-md-2">
    <label for="inputZip" class="form-label">Código Postal</label>
    <input type="text" class="form-control" id="inputZip" name="txt_zip" required>
  </div>

  <div class="col-12">
    <input type="hidden" name="txt_rol" value="3">  <!-- Rol de postulante asignado automáticamente -->
  </div>

  <div class="col-12">
    <button type="submit" class="btn btn-primary">Registrar</button>
  </div>
</form>
