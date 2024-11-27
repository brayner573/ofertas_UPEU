<?php
include("../includes/conectar.php");
$conexion = conectar();
session_start();

// Recibimos los datos de usuario y contraseña de forma segura
$usuario = mysqli_real_escape_string($conexion, $_POST['txt_usuario']);
$password = $_POST['txt_password']; // No es necesario escaparlo, ya que lo validaremos con hash más adelante

// Consulta segura para obtener el usuario y su estado de aprobación usando prepared statements
$sql = "SELECT * FROM usuarios WHERE usuario = ?";
$stmt = $conexion->prepare($sql);
$stmt->bind_param("s", $usuario);
$stmt->execute();
$resultado = $stmt->get_result();

// Verificar si se encontró un usuario con las credenciales proporcionadas
if ($resultado->num_rows == 1) {
    $fila = $resultado->fetch_assoc();

    // Verificar si la contraseña es correcta y si el usuario está aprobado
    if (password_verify($password, $fila['contrasenia'])) {
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
                header("Location: panel_empresa.php");
            } else {
                // Otros roles (ej: postulante)
                header("Location: ../index.php");
            }
        }
    } else {
        // Contraseña incorrecta
        header("Location: form_login.php?error_login=error");
    }
} else {
    // Usuario no encontrado
    header("Location: form_login.php?error_login=error");
}
exit();
