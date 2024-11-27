<?php
include("../includes/conectar.php");
$conexion = conectar();

if (isset($_POST['id_empresa'])) {
    $id_empresa = $_POST['id_empresa'];

    // Consulta para eliminar la empresa
    $sql = "DELETE FROM empresa WHERE id = $id_empresa";
    if (mysqli_query($conexion, $sql)) {
        echo "Empresa eliminada con éxito.";
    } else {
        echo "Error al eliminar la empresa: " . mysqli_error($conexion);
    }
} else {
    echo "ID de la empresa no recibido.";
}

mysqli_close($conexion);
?>
