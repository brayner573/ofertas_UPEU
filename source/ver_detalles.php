<?php
session_start();
include("../includes/conectar.php");
$conexion = conectar();

// Verificar si el usuario ha iniciado sesión
if (!isset($_SESSION["SESION_ID_USUARIO"])) {
    header("Location: form_login.php");
    exit();
}

// Verificar si se ha pasado un ID válido
if (!isset($_GET['id']) || empty($_GET['id'])) {
    echo "<div class='alert alert-danger'>ID de postulación no válido.</div>";
    exit();
}

$id_postulacion = $_GET['id'];

// Modifica la consulta para que solo seleccione las columnas existentes en tu tabla
$sql = "SELECT p.id, o.titulo, o.descripcion, p.fecha_hora_postulacion AS fecha_postulacion, p.estado_actual
        FROM postulaciones p
        INNER JOIN oferta_laboral o ON p.id_oferta = o.id
        WHERE p.id = $id_postulacion AND p.id_usuario = {$_SESSION['SESION_ID_USUARIO']}";

$resultado = mysqli_query($conexion, $sql);

// Verificar si la consulta fue exitosa
if ($resultado === false) {
    echo "<div class='alert alert-danger'>Error al ejecutar la consulta: " . mysqli_error($conexion) . "</div>";
    exit();
}

// Verificar si se encontró la postulación
if (mysqli_num_rows($resultado) == 0) {
    echo "<div class='alert alert-info'>No se encontraron detalles para esta postulación.</div>";
    exit();
}

// Obtener los detalles de la postulación
$detalle = mysqli_fetch_assoc($resultado);

include("../includes/head.php");
?>

<div class="container mt-4">
    <h1 class="h3 mb-4 text-gray-800">Detalles de la Postulación</h1>

    <div class="card">
        <div class="card-body">
            <h5 class="card-title"><?php echo htmlspecialchars($detalle['titulo']); ?></h5>
            <p class="card-text"><strong>Descripción: </strong><?php echo htmlspecialchars($detalle['descripcion']); ?></p>
            <p class="card-text"><strong>Fecha de Postulación: </strong><?php echo date('d-m-Y H:i', strtotime($detalle['fecha_postulacion'])); ?></p>
            <p class="card-text"><strong>Estado Actual: </strong><?php echo htmlspecialchars(ucfirst($detalle['estado_actual'])); ?></p>
        </div>
    </div>

    <a href="mis_postulaciones.php" class="btn btn-secondary mt-4">Volver a Mis Postulaciones</a>
</div>

<?php
include("../includes/foot.php");
?>
