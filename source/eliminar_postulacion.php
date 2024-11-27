<?php
include("../includes/conectar.php");
$conexion = conectar();

session_start();

// Verificar si el usuario ha iniciado sesión
if (!isset($_SESSION["SESION_ID_USUARIO"])) {
    header("Location: form_login.php");
    exit();
}

// Verificar si se pasó un ID de postulación válido
if (isset($_GET['id'])) {
    $id_postulacion = $_GET['id'];

    // Eliminar la postulación
    $sql = "DELETE FROM postulaciones WHERE id = $id_postulacion AND id_usuario = {$_SESSION['SESION_ID_USUARIO']}";
    $resultado = mysqli_query($conexion, $sql);

    if ($resultado) {
        // Redirigir a la página de mis postulaciones con un mensaje de éxito
        header("Location: mis_postulaciones.php?mensaje=eliminado");
        exit();
    } else {
        // Si ocurre un error, mostrar mensaje
        echo "<script>alert('Error al eliminar la postulación.'); window.history.back();</script>";
    }
} else {
    // Si no se pasa un ID válido, redirigir a mis postulaciones
    header("Location: mis_postulaciones.php");
}
?>
