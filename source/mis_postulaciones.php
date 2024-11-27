<?php
session_start();
include("../includes/conectar.php");
$conexion = conectar();

// Verificar si el usuario ha iniciado sesión
if (!isset($_SESSION["SESION_ID_USUARIO"])) {
    header("Location: form_login.php");
    exit();
}

// Obtener el ID del usuario de la sesión
$id_usuario = $_SESSION["SESION_ID_USUARIO"];

// Consulta para obtener las postulaciones del usuario
$sql = "SELECT p.id, o.titulo, o.descripcion, p.fecha_hora_postulacion AS fecha_postulacion, p.estado_actual 
        FROM postulaciones p 
        INNER JOIN oferta_laboral o ON p.id_oferta = o.id 
        WHERE p.id_usuario = $id_usuario";

$resultado = mysqli_query($conexion, $sql);

include("../includes/head.php");
?>

<div class="container-fluid mt-4">
    <h1 class="h3 mb-4 text-gray-800">Mis Postulaciones</h1>

    <!-- Botón para generar el reporte en PDF -->
    <a href="generar_reporte_postulaciones.php" class="btn btn-primary mb-4">Generar Reporte PDF</a>

    <?php
    // Verificar si la consulta fue exitosa
    if ($resultado === false) {
        echo "<div class='alert alert-danger'>Error al ejecutar la consulta: " . mysqli_error($conexion) . "</div>";
    } else {
        // Verificar si hay postulaciones
        if (mysqli_num_rows($resultado) > 0) {
            echo '<div class="table-responsive">';
            echo '<table class="table table-bordered table-hover table-striped">';
            echo '<thead class="thead-dark"><tr><th>Título</th><th>Descripción</th><th>Fecha y Hora de Postulación</th><th>Estado</th><th>Acciones</th></tr></thead>';
            echo '<tbody>';

            // Mostrar los resultados de las postulaciones
            while ($fila = mysqli_fetch_assoc($resultado)) {
                echo '<tr>';
                echo '<td>' . htmlspecialchars($fila['titulo']) . '</td>';
                echo '<td>' . htmlspecialchars($fila['descripcion']) . '</td>';
                echo '<td>' . date('d-m-Y H:i', strtotime($fila['fecha_postulacion'])) . '</td>'; // Mostrar fecha y hora de postulación
                echo '<td>' . htmlspecialchars(ucfirst($fila['estado_actual'])) . '</td>';
                echo '<td>';
                echo '<a href="ver_detalles.php?id=' . $fila['id'] . '" class="btn btn-info btn-sm">Ver Detalles</a> ';
                echo '<button class="btn btn-danger btn-sm" onclick="eliminarPostulacion(' . $fila['id'] . ')">Eliminar</button>';
                echo '</td>';
                echo '</tr>';
            }

            echo '</tbody>';
            echo '</table>';
            echo '</div>'; // Cierra el contenedor
        } else {
            echo '<div class="alert alert-info text-center">No has realizado ninguna postulación.</div>';
        }
    }
    ?>

</div>

<script>
function eliminarPostulacion(id) {
    if (confirm('¿Estás seguro de que deseas eliminar esta postulación?')) {
        window.location.href = "eliminar_postulacion.php?id=" + id;
    }
}
</script>

<?php
include("../includes/foot.php");
?>
