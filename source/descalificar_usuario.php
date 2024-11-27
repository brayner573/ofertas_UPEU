<?php
include("../includes/conectar.php");
$conexion = conectar();

if ($_SERVER["REQUEST_METHOD"] == "POST") {
    $id_usuario = $_POST['idUsuario'];
    $id_oferta = $_POST['idOferta'];

    $sql = "UPDATE postulaciones SET estado_actual = 'cerrado' WHERE id_usuario = $id_usuario AND id_oferta = $id_oferta";
    if (mysqli_query($conexion, $sql)) {
        echo "Usuario descalificado y estado actualizado a cerrado.";
    } else {
        echo "Error al actualizar el estado: " . mysqli_error($conexion);
    }
}
?>
