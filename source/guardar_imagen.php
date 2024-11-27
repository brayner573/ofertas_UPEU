
<?php
include("../includes/conectar.php");

if ($_SERVER["REQUEST_METHOD"] == "POST") {
    // Verificar si se recibió un ID de usuario válido
    if (isset($_POST['idUsuario']) && !empty($_POST['idUsuario'])) {
        $idUsuario = $_POST['idUsuario'];

        // Manejar la carga de la nueva imagen
        if (isset($_FILES['nuevaImagen']) && $_FILES['nuevaImagen']['error'] === UPLOAD_ERR_OK) {
            $rutaDestino = "../images/"; // Ruta donde se guardarán las imágenes (ajusta según tu configuración)
            $nombreArchivo = uniqid('imagen_') . '_' . $_FILES['nuevaImagen']['name'];
            $rutaImagen = $rutaDestino . $nombreArchivo;

            // Mover la imagen del directorio temporal al directorio de destino
            if (move_uploaded_file($_FILES['nuevaImagen']['tmp_name'], $rutaImagen)) {
                // Actualizar la ruta de la imagen en la base de datos
                $conexion = conectar();
                $idUsuario = mysqli_real_escape_string($conexion, $idUsuario);
                $rutaImagen = mysqli_real_escape_string($conexion, $rutaImagen);

                $sql = "UPDATE usuarios SET ruta_imagen='$rutaImagen' WHERE id=$idUsuario";

                if (mysqli_query($conexion, $sql)) {
                    echo "Imagen actualizada correctamente.";
                } else {
                    echo "Error al actualizar imagen: " . mysqli_error($conexion);
                }

                // Cerrar la conexión
                mysqli_close($conexion);
            } else {
                echo "Error al cargar la imagen.";
            }
        } else {
            echo "No se ha enviado ninguna imagen nueva.";
        }
    } else {
        echo "ID de usuario no válido.";
    }
} else {
    echo "Solicitud no válida.";
}

header("location: perfil.php"); // Redireccionar a la página de listado de usuarios
