<?php
include("../includes/head.php");
include("../includes/conectar.php");
$conexion = conectar();

// Verificar si el usuario ha iniciado sesión
if (!isset($_SESSION['SESION_ID_USUARIO'])) {
    header("Location: form_login.php");
    exit();
}

$id_postulacion = $_GET['id_postulacion'];

// Consulta para obtener los detalles de la postulación
$query = "
    SELECT o.titulo, o.descripcion, p.fecha_hora_postulacion, p.estado_actual 
    FROM postulaciones p
    INNER JOIN oferta_laboral o ON p.id_oferta = o.id
    WHERE p.id = $id_postulacion
";
$resultado = mysqli_query($conexion, $query);
$datos_postulacion = mysqli_fetch_assoc($resultado);
?>

<div class="container-fluid mt-4">
    <h1 class="mb-4">Detalles de la Postulación</h1>

    <?php if ($datos_postulacion): ?>
        <div class="card">
            <div class="card-header">
                Oferta: <?php echo $datos_postulacion['titulo']; ?>
            </div>
            <div class="card-body">
                <h5 class="card-title">Descripción de la oferta:</h5>
                <p class="card-text"><?php echo $datos_postulacion['descripcion']; ?></p>
                <p><strong>Fecha de Postulación:</strong> <?php echo $datos_postulacion['fecha_hora_postulacion']; ?></p>
                <p><strong>Estado Actual:</strong> <?php echo ucfirst($datos_postulacion['estado_actual']); ?></p>
                <?php if ($datos_postulacion['estado_actual'] == 'aprobado'): ?>
                    <div class="alert alert-success">¡Felicidades! Tu postulación ha sido aprobada.</div>
                <?php elseif ($datos_postulacion['estado_actual'] == 'rechazado'): ?>
                    <div class="alert alert-danger">Lo sentimos, tu postulación ha sido rechazada.</div>
                <?php else: ?>
                    <div class="alert alert-info">Tu postulación está en estado pendiente.</div>
                <?php endif; ?>
            </div>
        </div>
    <?php else: ?>
        <div class="alert alert-danger">No se encontraron detalles de la postulación.</div>
    <?php endif; ?>
</div>

<?php
include("../includes/foot.php");
?>
