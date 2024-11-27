<?php
include("../includes/conectar.php");
$conexion = conectar();

if ($_SERVER["REQUEST_METHOD"] == "POST") {
    $id_usuario = $_POST['idUsuario'];
    $id_oferta = $_POST['idOferta'];
    $aceptado = $_POST['aceptado'];

    if ($aceptado) {
        // Si el usuario es aceptado, envía una notificación
        $mensaje = "¡Felicidades! Has sido seleccionado para el puesto de trabajo.";
        $fecha_creacion = date('Y-m-d H:i:s');
        $query = "INSERT INTO notificaciones (id_usuario, id_oferta, mensaje, fecha_creacion) 
                  VALUES ('$id_usuario', '$id_oferta', '$mensaje', '$fecha_creacion')";
        if (mysqli_query($conexion, $query)) {
            echo "Notificación enviada con éxito.";
        } else {
            echo "Error al enviar la notificación: " . mysqli_error($conexion);
        }
    } else {
        // Si el usuario es descalificado, actualiza el estado a "cerrado"
        $sql = "UPDATE postulaciones SET estado_actual = 'cerrado' WHERE id_usuario = $id_usuario AND id_oferta = $id_oferta";
        if (mysqli_query($conexion, $sql)) {
            echo "Usuario descalificado y estado actualizado a cerrado.";
        } else {
            echo "Error al actualizar el estado: " . mysqli_error($conexion);
        }
    }
}
?>
