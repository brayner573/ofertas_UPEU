<?php
require('../fpdf/fpdf.php'); // Asegúrate de que la ruta sea correcta
include("../includes/conectar.php");
$conexion = conectar();

// Crear instancia del objeto FPDF
$pdf = new FPDF();
$pdf->AddPage();

// Establecer fuente
$pdf->SetFont('Arial', 'B', 16);

// Título
$pdf->Cell(0, 10, 'Reporte de Empresas', 0, 1, 'C');

// Añadir un espacio
$pdf->Ln(10);

// Cabecera de la tabla
$pdf->SetFont('Arial', 'B', 12);
$pdf->Cell(40, 10, 'Razón Social', 1);
$pdf->Cell(30, 10, 'RUC', 1);
$pdf->Cell(50, 10, 'Correo', 1);
$pdf->Cell(50, 10, 'Dirección', 1);
$pdf->Cell(30, 10, 'Teléfono', 1);
$pdf->Ln();

// Obtener los datos de las empresas
$sql = "SELECT * FROM empresa";
$resultado = mysqli_query($conexion, $sql);

// Agregar los datos a la tabla
$pdf->SetFont('Arial', '', 12);
while ($row = mysqli_fetch_array($resultado)) {
    $pdf->Cell(40, 10, $row['razon_social'], 1);
    $pdf->Cell(30, 10, $row['ruc'], 1);
    $pdf->Cell(50, 10, $row['correo'], 1);
    $pdf->Cell(50, 10, $row['direccion'], 1);
    $pdf->Cell(30, 10, $row['telefono'], 1);
    $pdf->Ln();
}

// Cerrar y mostrar el documento
$pdf->Output();
?>
