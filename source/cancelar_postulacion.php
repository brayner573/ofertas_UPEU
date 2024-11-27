<?php
session_start();
include("../includes/conectar.php");

if ($_SERVER['REQUEST_METHOD'] == 'POST' && isset($_POST['id_postulacion'])) {
    $conexion = conectar();
    $id_postulacion = mysqli_real_escape_string($conexion, $_POST['id_postulacion']);
    $id_usuario = $_SESSION['SESION_ID_USUARIO'];

    // Consulta para verificar que la postulación pertenece al usuario
    $query = "SELECT * FROM postulaciones WHERE id = $id_postulacion AND id_usuario = $id_usuario";
    $resultado = mysqli_query($conexion, $query);

    if (mysqli_num_rows($resultado) > 0) {
        // Actualizar el estado de la postulación a "cancelado"
        $update_query = "UPDATE postulaciones SET estado_actual = 'cancelado' WHERE id = $id_postulacion";
        if (mysqli_query($conexion, $update_query)) {
            // Aumentar el límite de postulantes en la oferta laboral correspondiente
            $postulacion = mysqli_fetch_assoc($resultado);
            $id_oferta = $postulacion['id_oferta'];
            $update_limite_query = "UPDATE oferta_laboral SET limite_postulantes = limite_postulantes + 1 WHERE id = $id_oferta";
            mysqli_query($conexion, $update_limite_query);
            header("Location: listar_postulaciones.php"); // Redirigir de vuelta a la página de postulaciones
        } else {
            echo "Error al cancelar la postulación.";
        }
    } else {
        echo "No tienes permiso para cancelar esta postulación.";
    }
} else {
    echo "Solicitud inválida.";
}

exit();
?>
