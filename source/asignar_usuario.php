<?php
include("../includes/conectar.php");
$conexion = conectar();

if ($_SERVER["REQUEST_METHOD"] == "POST") {
    $id_empresa = $_POST['id_empresa'];
    $id_usuario = $_POST['id_usuario'];



    // Actualizar la tabla usuarios para marcar el estado de asignación
    $sql_update_usuario = "UPDATE usuarios SET id_empresa = $id_empresa, estado_asignacion = 1, id_rol = 2 WHERE id = $id_usuario";
    mysqli_query($conexion, $sql_update_usuario);

    // Actualizar la tabla empresa para agregar el ID del usuario asignado
    $sql_update_empresa = "UPDATE empresa SET id_usuario = $id_usuario WHERE id = $id_empresa";
    mysqli_query($conexion, $sql_update_empresa);

    echo "Usuario asignado correctamente.";
} else {
    echo "Error: No se pudo procesar la solicitud.";
}
