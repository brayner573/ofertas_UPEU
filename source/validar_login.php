<?php
include("../includes/conectar.php");
$conexion = conectar();
session_start();

// Recibimos los datos de usuario y contraseña de forma segura
$usuario = mysqli_real_escape_string($conexion, $_POST['txt_usuario']);
$password = mysqli_real_escape_string($conexion, $_POST['txt_password']);

// Consulta para obtener el usuario
$sql = "SELECT * FROM usuarios WHERE usuario='$usuario' AND contrasenia='$password'";
$resultado = mysqli_query($conexion, $sql);

// Verificar si se encontró un usuario con las credenciales proporcionadas
if (mysqli_num_rows($resultado) == 1) {
    $fila = mysqli_fetch_assoc($resultado);

    // Verificar si el usuario está aprobado
    if ($fila['estado_asignacion'] == 0) {
        // El usuario no está autorizado aún
        header("Location: form_login.php?noautorizado=true");
    } else {
        // El usuario está aprobado, iniciar sesión
        $_SESSION["SESION_ROL"] = $fila['id_rol'];
        $_SESSION["SESION_NOMBRES"] = $fila['nombres'];
        $_SESSION["SESION_APELLIDOS"] = $fila['apellidos'];
        $_SESSION["SESION_ID_EMPRESA"] = $fila['id_empresa'] ?? null; // Solo si es empresa
        $_SESSION["SESION_ID_USUARIO"] = $fila['id'];
        
        // Redirigir según el rol
        if ($_SESSION["SESION_ROL"] == 2) {
            // Si es empresa
            header("Location: empresa_dashboard.php");
        } else {
            // Otros roles (ej: postulante, administrador)
            header("Location: ../index.php");
        }
    }
} else {
    // Usuario o contraseña incorrectos
    header("Location: form_login.php?error_login=error");
}
exit();
