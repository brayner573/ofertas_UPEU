<?php
include("../includes/conectar.php");

if ($_SERVER["REQUEST_METHOD"] == "POST") {

    if (isset($_POST['id']) && !empty($_POST['id'])) {
        $id = $_POST['id'];


        $ruc = $_POST['txt_ruc'];
        $razon_social = $_POST['txt_razon_social'];
        $correo = $_POST['txt_correo'];
        $direccion = $_POST['txt_direccion'];
        $telefono = $_POST['txt_telefono'];


        $conexion = conectar();
        $id = mysqli_real_escape_string($conexion, $id);
        $ruc = mysqli_real_escape_string($conexion, $ruc);
        $razon_social = mysqli_real_escape_string($conexion, $razon_social);
        $correo = mysqli_real_escape_string($conexion, $correo);
        $direccion = mysqli_real_escape_string($conexion, $direccion);
        $telefono = mysqli_real_escape_string($conexion, $telefono);

        $sql = "UPDATE empresa SET ruc='$ruc', razon_social='$razon_social', correo='$correo', direccion='$direccion', telefono='$telefono' WHERE id=$id";

        if (mysqli_query($conexion, $sql)) {
            echo "Empresa actualizado correctamente.";
        } else {
            echo "Error al actualizar Empresa: " . mysqli_error($conexion);
        }

        mysqli_close($conexion);
    } else {
        echo "ID de empresa no válido.";
    }
} else {
    echo "Solicitud no válida.";
}

header("location: listar_empresas.php");
