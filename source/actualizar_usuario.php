<?php
include("../includes/conectar.php");
session_start();

if ($_SERVER["REQUEST_METHOD"] == "POST") {
    if (isset($_POST['id']) && !empty($_POST['id'])) {
        $id = $_POST['id'];

        $dni = $_POST['txt_dni'];
        $nombres = $_POST['txt_nombres'];
        $apellidos = $_POST['txt_apellidos'];
        $direccion = $_POST['txt_direccion'];
        $telefono = $_POST['txt_telefono'];

        // Actualizar los datos del usuario en la base de datos
        $conexion = conectar();
        $id = mysqli_real_escape_string($conexion, $id); // Evita inyección SQL
        $dni = mysqli_real_escape_string($conexion, $dni);
        $nombres = mysqli_real_escape_string($conexion, $nombres);
        $apellidos = mysqli_real_escape_string($conexion, $apellidos);
        $direccion = mysqli_real_escape_string($conexion, $direccion);
        $telefono = mysqli_real_escape_string($conexion, $telefono);

        $sql = "UPDATE usuarios SET dni='$dni', nombres='$nombres', apellidos='$apellidos', direccion='$direccion', telefono='$telefono' WHERE id=$id";

        if (mysqli_query($conexion, $sql)) {
            echo "Usuario actualizado correctamente.";
        } else {
            echo "Error al actualizar usuario: " . mysqli_error($conexion);
        }

        // Cerrar la conexión
        mysqli_close($conexion);
    } else {
        echo "ID de usuario no válido.";
    }
} else {
    echo "Solicitud no válida.";
}

// Verificar el rol del usuario
if (isset($_SESSION['SESION_ROL']) && $_SESSION['SESION_ROL'] == '1') {
    header("Location: listar_usuarios.php");
} else {
    header("Location: perfil.php");
}


