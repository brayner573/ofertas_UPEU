<?php
include("../includes/head.php");
?>

<!-- Begin Page Content -->
<div class="container-fluid d-flex justify-content-center mt-5">
    <div class="col-md-8">
        <h1 class="text-center mb-4">Registro de Nuevas Empresas</h1>
        <form method="POST" action="guardar_usuario.php" class="bg-light p-4 rounded shadow-sm">
            <div class="form-group row">
                <label for="txt_dni" class="col-sm-3 col-form-label">RUC</label>
                <div class="col-sm-9">
                    <input type="text" class="form-control" name="txt_dni" id="txt_dni" pattern="\d{11}" title="Debe contener exactamente 11 dígitos numéricos" required placeholder="Ingrese el RUC de la empresa">
                </div>
            </div>

            <div class="form-group row">
                <label for="txt_nombres" class="col-sm-3 col-form-label">Nombre de la Empresa</label>
                <div class="col-sm-9">
                    <input type="text" class="form-control" name="txt_nombres" id="txt_nombres" pattern="[A-Za-z\s]+" title="Solo letras y espacios permitidos" required placeholder="Ingrese el nombre de la empresa">
                </div>
            </div>

            <div class="form-group row">
                <label for="txt_direccion" class="col-sm-3 col-form-label">Dirección</label>
                <div class="col-sm-9">
                    <input type="text" class="form-control" name="txt_direccion" maxlength="100" required placeholder="Ingrese la dirección">
                </div>
            </div>

            <div class="form-group row">
                <label for="txt_telefono" class="col-sm-3 col-form-label">Teléfono</label>
                <div class="col-sm-9">
                    <input type="text" class="form-control" name="txt_telefono" id="txt_telefono" pattern="[0-9+\-() ]+" title="Solo números y símbolos permitidos" required placeholder="Ingrese el número de teléfono">
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

            <!-- Campo oculto para asignar el rol de empresa automáticamente -->
            <input type="hidden" name="txt_rol" value="2">  <!-- 2 es el rol de empresa -->

            <div class="form-group row">
                <div class="col-sm-9 offset-sm-3">
                    <button type="submit" class="btn btn-primary btn-block">Registrar Empresa</button>
                </div>
            </div>
        </form>
    </div>
</div>

<script>
    document.getElementById('txt_dni').addEventListener('input', function (e) {
        var value = e.target.value;
        e.target.value = value.replace(/\D/g, '').slice(0, 11);  // Solo permite números y hasta 11 caracteres
    });
</script>

<?php
include("../includes/foot.php");
?>
