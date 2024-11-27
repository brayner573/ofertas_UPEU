<?php
include("../includes/conectar.php");

if ($_SERVER["REQUEST_METHOD"] == "POST") {
    $idUsuario = $_POST['idUsuario'];
    $conexion = conectar();

    // Obtener la ruta del archivo CV para eliminarlo del servidor
    $sql = "SELECT ruta_cv FROM usuarios WHERE id = $idUsuario";
    $resultado = mysqli_query($conexion, $sql);

    if ($resultado && mysqli_num_rows($resultado) > 0) {
        $fila = mysqli_fetch_assoc($resultado);
        $ruta_cv = $fila['ruta_cv'];

        // Eliminar archivo del servidor
        if (file_exists($ruta_cv)) {
            unlink($ruta_cv);
        }

        // Actualizar la base de datos para eliminar la referencia al CV
        $sql_update = "UPDATE usuarios SET ruta_cv = NULL WHERE id = $idUsuario";
        if (mysqli_query($conexion, $sql_update)) {
            header("Location: perfil.php?success_cv_deleted");
        } else {
            echo "Error al actualizar la base de datos.";
        }
    } else {
        echo "No se encontró el CV.";
    }

    // Cerrar la conexión
    mysqli_close($conexion);
}
?>
