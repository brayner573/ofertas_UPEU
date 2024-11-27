<?php
session_start();
include("../includes/conectar.php");
$conexion = conectar();

// Verificar si el usuario está logueado y tiene el rol de empresa
if (!isset($_SESSION['SESION_ID_USUARIO']) || $_SESSION['SESION_ROL'] != 2) {
    header("Location: form_login.php");
    exit();
}

// Obtener el ID de la empresa logueada desde la sesión
$id_empresa_logueada = $_SESSION['SESION_ID_EMPRESA'];

// Obtener el ID de la oferta a eliminar desde el parámetro GET
$id_oferta = $_GET['id'];

// Verificar que la oferta pertenezca a la empresa logueada
$sql_verificar = "SELECT * FROM oferta_laboral WHERE id = '$id_oferta' AND id_empresa = '$id_empresa_logueada'";
$resultado_verificar = mysqli_query($conexion, $sql_verificar);

if (mysqli_num_rows($resultado_verificar) > 0) {
    // Si la oferta pertenece a la empresa logueada, proceder con la eliminación
    $sql_eliminar = "DELETE FROM oferta_laboral WHERE id = '$id_oferta'";
    if (mysqli_query($conexion, $sql_eliminar)) {
        echo "<script>alert('La oferta ha sido eliminada exitosamente.'); window.location.href = 'listar_ofertas.php';</script>";
    } else {
        echo "<script>alert('Error al eliminar la oferta.'); window.history.back();</script>";
    }
} else {
    // Si la oferta no pertenece a la empresa logueada, no permitir la eliminación
    echo "<script>alert('No tienes permiso para eliminar esta oferta.'); window.history.back();</script>";
}

mysqli_close($conexion);
?>
