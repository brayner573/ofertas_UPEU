<?php
include("../includes/conectar.php");

$conexion = conectar();

// Recibimos datos del formulario
$dni = $_POST['txt_dni'];
$nombres = $_POST['txt_nombres'];
$direccion = $_POST['txt_direccion'];
$telefono = $_POST['txt_telefono'];
$usuario = $_POST['txt_usuario'];
$contrasenia = $_POST['txt_contrasenia'];
$rol = $_POST['txt_rol'];  // Recibir el rol de empresa (2)

$id_empresa = null;  // Este campo se llenará si deseas asociar con alguna tabla de empresas

// Guardamos datos en la tabla usuarios
$sql = "INSERT INTO usuarios (dni, nombres, direccion, telefono, usuario, contrasenia, id_rol, estado_asignacion, id_empresa) 
        VALUES ('$dni', '$nombres', '$direccion', '$telefono', '$usuario', '$contrasenia', '$rol', '0', '$id_empresa')";

// Verificamos si se guardó correctamente
if (mysqli_query($conexion, $sql)) {
    session_start();

    // Redirigir a la página de agradecimiento independientemente del rol
    header("location: gracias_registro.php");
} else {
    echo "<script>alert('Error al guardar el usuario.'); window.history.back();</script>";
}
?>
