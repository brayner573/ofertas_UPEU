<?php
include("../includes/conectar.php");
$conexion = conectar();

if ($_SERVER["REQUEST_METHOD"] == "POST") {
    $id_empresa = $_POST["id_empresa"];

    // Actualizar la tabla empresa
    $sql_update_empresa = "UPDATE empresa SET id_usuario = NULL WHERE id = $id_empresa";
    mysqli_query($conexion, $sql_update_empresa);

    // Actualizar la tabla usuarios
    $sql_update_usuario = "UPDATE usuarios SET id_empresa = NULL, estado_asignacion = 0, id_rol = 3  WHERE id_empresa = $id_empresa";
    mysqli_query($conexion, $sql_update_usuario);

    echo "Usuario quitado de la empresa exitosamente";
} else {
    echo "Error: Método de solicitud incorrecto";
}
