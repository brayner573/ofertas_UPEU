<?php
require_once('../includes/fpdf186/fpdf.php');
include("../includes/conectar.php");

$conexion = conectar();

// Consulta para obtener las ofertas laborales
$sql = "SELECT titulo, descripcion, fecha_publicacion, fecha_cierre, remuneracion, ubicacion, tipo FROM oferta_laboral";
$resultado = mysqli_query($conexion, $sql);

// Crear instancia de FPDF
$pdf = new FPDF();
$pdf->AddPage();

// Encabezado
$pdf->SetFont('Arial', 'B', 16);
$pdf->SetTextColor(0, 102, 204);
$pdf->Cell(0, 10, utf8_decode('Reporte Detallado de Ofertas Laborales'), 0, 1, 'C');
$pdf->Ln(10);

// Información general
$pdf->SetFont('Arial', 'I', 12);
$pdf->SetTextColor(0, 0, 0);
$pdf->Cell(0, 10, utf8_decode('Generado el: ') . date('d/m/Y'), 0, 1, 'R');
$pdf->Ln(5);

// Verificar si hay resultados
if (mysqli_num_rows($resultado) > 0) {
    $pdf->SetFont('Arial', 'B', 12);
    $pdf->SetFillColor(220, 220, 220); // Fondo gris claro para la cabecera de la tabla
    $pdf->Cell(0, 8, utf8_decode('Lista de Ofertas'), 0, 1, 'L', true);
    $pdf->Ln(5);

    while ($fila = mysqli_fetch_assoc($resultado)) {
        // Título de la oferta
        $pdf->SetFont('Arial', 'B', 12);
        $pdf->SetFillColor(230, 230, 250); // Fondo color lavanda para los títulos de ofertas
        $pdf->Cell(0, 10, 'Titulo: ' . utf8_decode($fila['titulo']), 0, 1, 'L', true);

        // Descripción y demás detalles
        $pdf->SetFont('Arial', '', 12);
        $pdf->Cell(0, 8, 'Descripcion: ' . utf8_decode($fila['descripcion']), 0, 1, 'L');
        $pdf->Cell(0, 8, 'Fecha de Publicación: ' . date('d-m-Y', strtotime($fila['fecha_publicacion'])), 0, 1, 'L');
        $pdf->Cell(0, 8, 'Fecha de Cierre: ' . date('d-m-Y', strtotime($fila['fecha_cierre'])), 0, 1, 'L');
        $pdf->Cell(0, 8, 'Remuneración: S/. ' . number_format($fila['remuneracion'], 2), 0, 1, 'L');
        $pdf->Cell(0, 8, utf8_decode('Ubicación: ') . utf8_decode($fila['ubicacion']), 0, 1, 'L');
        $pdf->Cell(0, 8, 'Tipo: ' . ucfirst(utf8_decode($fila['tipo'])), 0, 1, 'L');
        $pdf->Ln(5); // Espacio entre cada oferta
    }
} else {
    $pdf->SetFont('Arial', 'I', 12);
    $pdf->Cell(0, 10, utf8_decode('No se encontraron ofertas laborales.'), 0, 1, 'C');
}

// Pie de página
$pdf->Ln(20);
$pdf->SetFont('Arial', 'I', 10);
$pdf->SetTextColor(128, 128, 128);
$pdf->Cell(0, 10, utf8_decode('Fin del reporte'), 0, 1, 'C');

// Salida del PDF
$pdf->Output('reporte_ofertas_laborales.pdf', 'I');
?>
