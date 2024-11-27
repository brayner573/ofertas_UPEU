<?php
include("../includes/conectar.php");

if (isset($_GET['id'])) {
    $id = $_GET['id'];

    // Recuperar información del usuario de la base de datos según el ID
    $conexion = conectar();
    $id = mysqli_real_escape_string($conexion, $id); // Evita inyección SQL
    $sql = "SELECT * FROM oferta_laboral WHERE id = $id";
    $resultado = mysqli_query($conexion, $sql);

    if ($resultado && mysqli_num_rows($resultado) > 0) {
        $oferta_laboral = mysqli_fetch_assoc($resultado);
    } else {
        echo "Oferta no encontrado.";
        exit();
    }
} else {
    echo "ID de oferta no especificado.";
    exit();
}

?>

<?php
include("../includes/head.php");
?>

<!-- Begin Page Content -->
<div class="container-fluid">


    <!-- Inicio Zona  central del sistema  -->

    <h1 class="mt-5">Editar Oferta</h1>
    <form action="actualizar_oferta.php" method="post">
        <input type="hidden" name="id" value="<?php echo $oferta_laboral['id']; ?>">
        <div class="form-group">
            <label for="txt_dni">Titulo:</label>
            <input type="text" class="form-control" id="txt_titulo" name="txt_titulo" value="<?php echo $oferta_laboral['titulo']; ?>">
        </div>
        <div class="form-group">
            <label for="txt_nombres">Descripcion:</label>
            <input type="text" class="form-control" id="txt_descripcion" name="txt_descripcion" value="<?php echo $oferta_laboral['descripcion']; ?>">
        </div>
        <div class="form-group">
            <label for="txt_apellidos">Fecha Publicacion:</label>
            <input type="text" class="form-control" id="txt_fecha_publicacion" name="txt_fecha_publicacion" value="<?php echo $oferta_laboral['fecha_publicacion']; ?>">
        </div>
        <div class="form-group">
            <label for="txt_direccion">Fecha Cierre:</label>
            <input type="text" class="form-control" id="txt_fecha_cierre" name="txt_fecha_cierre" value="<?php echo $oferta_laboral['fecha_cierre']; ?>">
        </div>
        <div class="form-group">
            <label for="txt_telefono">Remuneracion:</label>
            <input type="text" class="form-control" id="txt_remuneracion" name="txt_remuneracion" value="<?php echo $oferta_laboral['remuneracion']; ?>">
        </div>
        <div class="form-group">
            <label for="txt_telefono">Ubicacion:</label>
            <input type="text" class="form-control" id="txt_ubicacion" name="txt_ubicacion" value="<?php echo $oferta_laboral['ubicacion']; ?>">
        </div>
        <div class="form-group">
            <label for="txt_telefono">Tipo:</label>
            <input type="text" class="form-control" id="txt_tipo" name="txt_tipo" value="<?php echo $oferta_laboral['tipo']; ?>">
        </div>
        <div class="form-group">
            <label for="txt_telefono">Limite Postulantes:</label>
            <input type="text" class="form-control" id="txt_limite_postulantes" name="txt_limite_postulantes" value="<?php echo $oferta_laboral['limite_postulantes']; ?>">
        </div>
        <button type="submit" class="btn btn-primary">Actualizar</button>

    </form>

    <!-- Fin Zona  central del sistema  -->

</div>

<script src="https://code.jquery.com/jquery-3.5.1.slim.min.js"></script>
<script src="https://cdn.jsdelivr.net/npm/@popperjs/core@2.5.4/dist/umd/popper.min.js"></script>
<script src="https://stackpath.bootstrapcdn.com/bootstrap/4.5.2/js/bootstrap.min.js"></script>
<!-- /.container-fluid -->
<?php
include("../includes/foot.php");
?>