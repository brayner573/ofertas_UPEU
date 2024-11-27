<?php
include("../includes/conectar.php"); // Ajusta la ruta de acuerdo con tu estructura de carpetas
$conexion = conectar();

$id = $_GET['id'];
$estado = $_GET['estado'];

// Cambiar el estado
$nuevo_estado = ($estado == 1) ? 0 : 1;

$sql = "UPDATE usuarios SET estado_asignacion = $nuevo_estado WHERE id = $id";
mysqli_query($conexion, $sql);

header("Location: listar_usuarios.php");
?>
