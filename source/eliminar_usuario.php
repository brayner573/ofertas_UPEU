<?php
include("../includes/conectar.php");

if (isset($_GET['id'])) {
    $id = $_GET['id'];
    

    // Eliminar el usuario de la base de datos
    $conexion = conectar();
    $id = mysqli_real_escape_string($conexion, $id); // Evita inyección SQL
    $sql = "DELETE FROM usuarios WHERE id = $id";
    $resultado = mysqli_query($conexion, $sql);

    if ($resultado) {
        echo "Usuario eliminado correctamente.";
    } else {
        echo "Error al eliminar usuario.";
    }
} else {
    echo "ID de usuario no especificado.";
    exit();
}
header("location: listar_usuarios.php");
