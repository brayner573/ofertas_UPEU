<?php
include("../includes/conectar.php");
$conexion = conectar();

if ($_SERVER['REQUEST_METHOD'] == 'POST') {
    $titulo = mysqli_real_escape_string($conexion, $_POST['txt_titulo']);
    $descripcion = mysqli_real_escape_string($conexion, $_POST['txt_descripcion']);
    $fecha_publicacion = mysqli_real_escape_string($conexion, $_POST['txt_fecha_publicacion']);
    $fecha_cierre = mysqli_real_escape_string($conexion, $_POST['txt_fecha_cierre']);
    $remuneracion = mysqli_real_escape_string($conexion, $_POST['txt_remuneracion']);
    $ubicacion = mysqli_real_escape_string($conexion, $_POST['txt_ubicacion']);
    $tipo = mysqli_real_escape_string($conexion, $_POST['txt_tipo']);
    $limite_postulantes = mysqli_real_escape_string($conexion, $_POST['txt_limite_postulantes']);
    $id_empresa = $_SESSION['SESION_ID_EMPRESA']; // Asegúrate de que la empresa esté en la sesión

    // Consulta para insertar la oferta laboral
    $sql = "INSERT INTO oferta_laboral (id_empresa, titulo, descripcion, fecha_publicacion, fecha_cierre, remuneracion, ubicacion, tipo, limite_postulantes) 
            VALUES ('$id_empresa', '$titulo', '$descripcion', '$fecha_publicacion', '$fecha_cierre', '$remuneracion', '$ubicacion', '$tipo', '$limite_postulantes')";

    if (mysqli_query($conexion, $sql)) {
        echo "<script>alert('Oferta guardada correctamente.'); window.location.href = 'listar_ofertas.php';</script>";
    } else {
        echo "<script>alert('Error al guardar la oferta.'); window.history.back();</script>";
    }
}
?>
