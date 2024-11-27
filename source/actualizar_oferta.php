<?php
include("../includes/conectar.php");

if ($_SERVER["REQUEST_METHOD"] == "POST") {

    if (isset($_POST['id']) && !empty($_POST['id'])) {
        $id = $_POST['id'];

        $titulo = $_POST['txt_titulo'];
        $descripcion = $_POST['txt_descripcion'];
        $fecha_publicacion = $_POST['txt_fecha_publicacion'];
        $fecha_cierre = $_POST['txt_fecha_cierre'];
        $remuneracion = $_POST['txt_remuneracion'];
        $ubicacion = $_POST['txt_ubicacion'];
        $tipo = $_POST['txt_tipo'];
        $limite_postulantes = $_POST['txt_limite_postulantes'];

        $conexion = conectar();
        $id = mysqli_real_escape_string($conexion, $id); // Evita inyección SQL
        $titulo = mysqli_real_escape_string($conexion, $titulo);
        $descripcion = mysqli_real_escape_string($conexion, $descripcion);
        $fecha_publicacion = mysqli_real_escape_string($conexion, $fecha_publicacion);
        $fecha_cierre = mysqli_real_escape_string($conexion, $fecha_cierre);
        $remuneracion = mysqli_real_escape_string($conexion, $remuneracion);
        $ubicacion = mysqli_real_escape_string($conexion, $ubicacion);
        $tipo = mysqli_real_escape_string($conexion, $tipo);
        $limite_postulantes = mysqli_real_escape_string($conexion, $limite_postulantes);


        $sql = "UPDATE oferta_laboral SET titulo='$titulo', descripcion='$descripcion', fecha_publicacion='$fecha_publicacion', fecha_cierre='$fecha_cierre', remuneracion='$remuneracion', ubicacion='$ubicacion', tipo='$tipo', limite_postulantes='$limite_postulantes' WHERE id=$id";

        if (mysqli_query($conexion, $sql)) {
            echo "Oferta actualizado correctamente.";
        } else {
            echo "Error al actualizar Oferta: " . mysqli_error($conexion);
        }


        mysqli_close($conexion);
    } else {
        echo "ID de oferta no válido.";
    }
} else {
    echo "Solicitud no válida.";
}

header("location: listar_ofertas.php");
