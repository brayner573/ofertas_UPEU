<?php
include("../includes/conectar.php");

if (isset($_GET['id'])) {
    $id = $_GET['id'];

    // Recuperar información del usuario de la base de datos según el ID
    $conexion = conectar();
    $id = mysqli_real_escape_string($conexion, $id); // Evita inyección SQL
    $sql = "SELECT * FROM empresa WHERE id = $id";
    $resultado = mysqli_query($conexion, $sql);

    if ($resultado && mysqli_num_rows($resultado) > 0) {
        $empresa = mysqli_fetch_assoc($resultado);
    } else {
        echo "Empresa no encontrado.";
        exit();
    }
} else {
    echo "ID de empresa no especificado.";
    exit();
}

// Más adelante en el mismo archivo, puedes utilizar la información de $usuario para mostrar un formulario de edición.
?>

<?php
include("../includes/head.php");
?>

<!-- Begin Page Content -->
<div class="container-fluid">


    <!-- Inicio Zona  central del sistema  -->

    <h1 class="mt-5">Editar Empresa</h1>
    <form action="actualizar_empresa.php" method="post">
        <input type="hidden" name="id" value="<?php echo $empresa['id']; ?>">
        <div class="form-group">
            <label for="txt_dni">Razon Social:</label>
            <input type="text" class="form-control" id="txt_razon_social" name="txt_razon_social" value="<?php echo $empresa['razon_social']; ?>">
        </div>
        <div class="form-group">
            <label for="txt_nombres">RUC:</label>
            <input type="text" class="form-control" id="txt_ruc" name="txt_ruc" value="<?php echo $empresa['ruc']; ?>">
        </div>
        <div class="form-group">
            <label for="txt_apellidos">Direccion:</label>
            <input type="text" class="form-control" id="txt_direccion" name="txt_direccion" value="<?php echo $empresa['direccion']; ?>">
        </div>
        <div class="form-group">
            <label for="txt_telefono">Teléfono:</label>
            <input type="text" class="form-control" id="txt_telefono" name="txt_telefono" value="<?php echo $empresa['telefono']; ?>">
        </div>
        <div class="form-group">
            <label for="txt_direccion">Correo:</label>
            <input type="text" class="form-control" id="txt_correo" name="txt_correo" value="<?php echo $empresa['correo']; ?>">
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