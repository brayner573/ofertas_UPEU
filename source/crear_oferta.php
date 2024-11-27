<?php
include("../includes/head.php");
include("../includes/conectar.php");
$conexion = conectar();

// Verificar si la sesión está activa y evitar llamar session_start() más de una vez
if (session_status() == PHP_SESSION_NONE) {
    session_start();
}

// Verificar si el usuario ha iniciado sesión
if (!isset($_SESSION['SESION_ID_USUARIO'])) {
    header("Location: form_login.php");
    exit();
}

$id_empresa = $_SESSION['SESION_ID_EMPRESA']; // Asegúrate de que la empresa esté en la sesión

?>

<div class="container-fluid mt-4">

    <h1 class="mb-4">Crear Nueva Oferta Laboral</h1>

    <form method="POST" action="guardar_oferta.php">
        <div class="mb-3">
            <label for="txt_titulo" class="form-label">Título</label>
            <input type="text" class="form-control" name="txt_titulo" required>
        </div>
        <div class="mb-3">
            <label for="txt_descripcion" class="form-label">Descripción</label>
            <textarea class="form-control" name="txt_descripcion" rows="3" required></textarea>
        </div>
        <div class="mb-3">
            <label for="txt_fecha_publicacion" class="form-label">Fecha de Publicación</label>
            <input type="date" class="form-control" name="txt_fecha_publicacion" required>
        </div>
        <div class="mb-3">
            <label for="txt_fecha_cierre" class="form-label">Fecha de Cierre</label>
            <input type="date" class="form-control" name="txt_fecha_cierre" required>
        </div>
        <div class="mb-3">
            <label for="txt_remuneracion" class="form-label">Remuneración</label>
            <input type="number" class="form-control" name="txt_remuneracion" required>
        </div>
        <div class="mb-3">
            <label for="txt_ubicacion" class="form-label">Ubicación</label>
            <input type="text" class="form-control" name="txt_ubicacion" required>
        </div>
        <div class="mb-3">
            <label for="txt_tipo" class="form-label">Tipo</label>
            <select class="form-select" name="txt_tipo" required>
                <option value="temporal">Temporal</option>
                <option value="permanente">Permanente</option>
            </select>
        </div>
        <div class="mb-3">
            <label for="txt_limite_postulantes" class="form-label">Cupos</label>
            <input type="number" class="form-control" name="txt_limite_postulantes" required>
        </div>
        <button type="submit" class="btn btn-primary">Crear Oferta</button>
    </form>

</div>

<?php
include("../includes/foot.php");
?>
