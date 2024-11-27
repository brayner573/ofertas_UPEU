<?php
include("../includes/head.php");
?>
<div class="container-fluid">

<?php
// Verifica si el usuario está autenticado
if (!isset($_SESSION['SESION_ID_USUARIO'])) {
    // Si no está autenticado, redirige a la página de inicio de sesión
    header("Location: form_login.php");
    exit();
}

// Agrega la conexión a la base de datos
include("../includes/conectar.php");
$conexion = conectar();

// Recupera el ID del usuario actual
$id_usuario = $_SESSION['SESION_ID_USUARIO'];

// Realiza una consulta segura para obtener las notificaciones del usuario
$query = "SELECT n.*, o.titulo AS titulo_oferta 
          FROM notificaciones n 
          INNER JOIN oferta_laboral o ON n.id_oferta = o.id 
          WHERE n.id_usuario = ?";
$stmt = $conexion->prepare($query);
$stmt->bind_param("i", $id_usuario);
$stmt->execute();
$resultado = $stmt->get_result();

// Verifica si la consulta fue exitosa
if ($resultado === false) {
    echo "<div class='alert alert-danger'>Error al ejecutar la consulta: " . $conexion->error . "</div>";
} else {
    // Verifica si hay notificaciones
    if ($resultado->num_rows > 0) {
        echo '<h2 class="mb-4">Tus Notificaciones</h2>';
        echo '<div class="row">';

        // Muestra las notificaciones
        while ($fila = $resultado->fetch_assoc()) {
            echo '<div class="col-md-4">';
            echo '<div class="card mb-4 shadow-sm">';
            echo '<div class="card-header bg-info text-white text-center">Notificación</div>';
            echo '<div class="card-body">';
            echo '<h5 class="card-title">' . htmlspecialchars($fila['titulo_oferta']) . '</h5>';
            echo '<p class="card-text">' . htmlspecialchars($fila['mensaje']) . '</p>';
            echo '<p class="text-muted"><small>Recibido el: ' . date('d/m/Y H:i', strtotime($fila['fecha'])) . '</small></p>';
            echo '</div>';
            echo '</div>';
            echo '</div>';
        }

        echo '</div>'; // Cierra la fila
    } else {
        echo '<div class="alert alert-info">No tienes notificaciones pendientes.</div>';
    }
}

// Cierra la conexión a la base de datos
$stmt->close();
$conexion->close();
?>

</div>

<?php
include("../includes/foot.php");
?>
