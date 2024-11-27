<?php
include("../includes/conectar.php");
$conexion = conectar();
session_start();

// Verificar si el usuario tiene el rol de administrador
if ($_SESSION['SESION_ROL'] != '1') {
    header("Location: ../index.php?noautorizado");
    exit();
}

// Obtener el ID del usuario a autorizar
$id_usuario = $_GET['id'];

// Actualizar el estado del usuario a 1 (autorizado)
$sql = "UPDATE usuarios SET estado_asignacion = 1 WHERE id = $id_usuario";
$resultado = mysqli_query($conexion, $sql);

if ($resultado) {
    // Redirigir de vuelta a la lista de usuarios con un mensaje de éxito
    header("Location: listar_usuarios.php?autorizado=exito");
} else {
    // Redirigir de vuelta a la lista de usuarios con un mensaje de error
    header("Location: listar_usuarios.php?autorizado=error");
}
?>

