<?php
session_start();
require_once('../includes/fpdf186/fpdf.php');
include("../includes/conectar.php");

$conexion = conectar();
$id_usuario = $_SESSION["SESION_ID_USUARIO"];

// Consulta para obtener las postulaciones del usuario
$sql = "SELECT o.titulo, o.descripcion, p.fecha_hora_postulacion AS fecha_postulacion, p.estado_actual 
        FROM postulaciones p 
        INNER JOIN oferta_laboral o ON p.id_oferta = o.id 
        WHERE p.id_usuario = $id_usuario";

$resultado = mysqli_query($conexion, $sql);

// Crear nueva instancia de FPDF
$pdf = new FPDF();
$pdf->AddPage();

// Encabezado personalizado del PDF
$pdf->SetFont('Arial', 'B', 16);
$pdf->SetTextColor(0, 102, 204); // Color azul
$pdf->Cell(0, 10, utf8_decode('Reporte de Postulaciones'), 0, 1, 'C');
$pdf->Ln(10);

// Información del usuario
$pdf->SetFont('Arial', 'I', 12);
$pdf->Cell(0, 10, utf8_decode('Generado el: ') . date('d/m/Y H:i'), 0, 1, 'R');
$pdf->Ln(5);

$pdf->SetFont('Arial', 'B', 12);
$pdf->SetTextColor(0, 0, 0); // Color negro

// Verificar si hay resultados
if (mysqli_num_rows($resultado) > 0) {
    $pdf->SetFont('Arial', '', 12);
    $pdf->SetFillColor(230, 230, 230); // Color de fondo gris claro
    $pdf->SetTextColor(0, 0, 0); // Color negro

    // Estilo para cada sección
    $contador = 0;
    while ($fila = mysqli_fetch_assoc($resultado)) {
        $contador++;
        // Dibujar borde superior
        $pdf->Cell(0, 0, '', 'T');
        $pdf->Ln(3);

        $pdf->SetFont('Arial', 'B', 12);
        $pdf->SetFillColor(200, 200, 255); // Fondo azul claro para títulos
        $pdf->Cell(0, 10, 'Postulación ' . $contador . ' - ' . utf8_decode($fila['titulo']), 0, 1, 'L', true);

        $pdf->SetFont('Arial', '', 12);
        $pdf->Cell(0, 8, 'Descripción: ' . utf8_decode($fila['descripcion']), 0, 1, 'L');
        $pdf->Cell(0, 8, 'Fecha de Postulación: ' . date('d-m-Y H:i', strtotime($fila['fecha_postulacion'])), 0, 1, 'L');
        $pdf->Cell(0, 8, 'Estado: ' . ucfirst($fila['estado_actual']), 0, 1, 'L');
        $pdf->Ln(5); // Espacio entre cada postulación
    }

    // Mostrar el total de postulaciones al final
    $pdf->SetFont('Arial', 'B', 12);
    $pdf->Cell(0, 10, utf8_decode('Total de Postulaciones: ') . $contador, 0, 1, 'L');
} else {
    $pdf->SetFont('Arial', 'I', 12);
    $pdf->Cell(0, 10, 'No has realizado ninguna postulación.', 0, 1, 'C');
}

// Salida del PDF
$pdf->Output('reporte_postulaciones.pdf', 'I');
?>
