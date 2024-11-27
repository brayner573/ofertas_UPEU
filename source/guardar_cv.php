<?php
session_start();
include("../includes/conectar.php");

if ($_SERVER["REQUEST_METHOD"] == "POST") {
    $conexion = conectar();
    $idUsuario = $_POST['idUsuario'];

    // Verificar si se ha subido un archivo
    if (isset($_FILES['nuevoDocumento']) && $_FILES['nuevoDocumento']['error'] == 0) {
        $archivoTmp = $_FILES['nuevoDocumento']['tmp_name'];
        $nombreArchivo = $_FILES['nuevoDocumento']['name'];
        $extensionArchivo = strtolower(pathinfo($nombreArchivo, PATHINFO_EXTENSION));

        // Verificar que el archivo sea un PDF
        if ($extensionArchivo != 'pdf') {
            echo "<script>alert('Solo se permiten archivos en formato PDF.'); window.location.href = 'perfil.php';</script>";
            exit;
        }

        // Ruta para guardar el archivo
        $directorioDestino = "../document/";
        $rutaArchivo = $directorioDestino . uniqid() . "_" . basename($nombreArchivo);

        // Mover el archivo al directorio de destino
        if (move_uploaded_file($archivoTmp, $rutaArchivo)) {
            // Actualizar la ruta del CV en la base de datos
            $sql = "UPDATE usuarios SET ruta_cv = '$rutaArchivo' WHERE id = $idUsuario";
            if (mysqli_query($conexion, $sql)) {
                echo "<script>alert('CV subido correctamente.'); window.location.href = 'perfil.php';</script>";
            } else {
                echo "<script>alert('Error al actualizar la base de datos.'); window.location.href = 'perfil.php';</script>";
            }
        } else {
            echo "<script>alert('Error al subir el archivo.'); window.location.href = 'perfil.php';</script>";
        }
    } else {
        echo "<script>alert('No se ha seleccionado ningún archivo.'); window.location.href = 'perfil.php';</script>";
    }

    mysqli_close($conexion);
} else {
    header("Location: perfil.php");
    exit;
}
?>
