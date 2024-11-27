<?php
include("../includes/conectar.php");
$conexion = conectar();

if ($_SERVER["REQUEST_METHOD"] == "POST" && isset($_POST['postular'])) {
    $id_usuario = $_POST['id_usuario'];
    $id_oferta = $_POST['id_oferta'];
    $fecha_hora_postulacion = date('Y-m-d H:i:s');

    // Verificar si el usuario ya se ha postulado a esta oferta
    $sql_verificar = "SELECT * FROM postulaciones WHERE id_usuario = ? AND id_oferta = ?";
    $stmt_verificar = $conexion->prepare($sql_verificar);
    $stmt_verificar->bind_param("ii", $id_usuario, $id_oferta);
    $stmt_verificar->execute();
    $resultado_verificar = $stmt_verificar->get_result();

    if ($resultado_verificar->num_rows > 0) {
        echo "<script>alert('Ya te has postulado a esta oferta.'); window.location.href = 'mis_postulaciones.php';</script>";
    } else {
        // Obtener el número de cupos disponibles
        $sql_cupos = "SELECT limite_postulantes FROM oferta_laboral WHERE id = ?";
        $stmt_cupos = $conexion->prepare($sql_cupos);
        $stmt_cupos->bind_param("i", $id_oferta);
        $stmt_cupos->execute();
        $resultado_cupos = $stmt_cupos->get_result();
        $fila = $resultado_cupos->fetch_assoc();
        $limite_postulantes = $fila['limite_postulantes'];

        // Verificar si aún hay cupos disponibles
        if ($limite_postulantes > 0) {
            // Reducir el número de cupos
            $nuevo_limite = $limite_postulantes - 1;
            $sql_actualizar = "UPDATE oferta_laboral SET limite_postulantes = ? WHERE id = ?";
            $stmt_actualizar = $conexion->prepare($sql_actualizar);
            $stmt_actualizar->bind_param("ii", $nuevo_limite, $id_oferta);
            $stmt_actualizar->execute();

            // Insertar la postulación
            $sql_insert = "INSERT INTO postulaciones (id_usuario, id_oferta, fecha_hora_postulacion, estado_postulacion) 
                           VALUES (?, ?, ?, 'pendiente')";
            $stmt_insert = $conexion->prepare($sql_insert);
            $stmt_insert->bind_param("iis", $id_usuario, $id_oferta, $fecha_hora_postulacion);

            if ($stmt_insert->execute()) {
                echo "<script>alert('Tu postulación ha sido enviada y está pendiente de aprobación.'); window.location.href = 'mis_postulaciones.php';</script>";
            } else {
                echo "<script>alert('Error al intentar postularse.'); window.history.back();</script>";
            }
        } else {
            echo "<script>alert('No hay cupos disponibles para esta oferta.'); window.history.back();</script>";
        }
    }

    // Cerrar la conexión
    $stmt_verificar->close();
    $stmt_insert->close();
    $stmt_actualizar->close();
    $conexion->close();
}
?>
