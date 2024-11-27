<?php
require_once('../includes/fpdf186/fpdf.php');
include("../includes/conectar.php");

$conexion = conectar();

// Realizar la consulta para obtener los usuarios
$sql = "SELECT nombres, apellidos, dni, direccion, telefono, id_empresa, estado_asignacion, id_rol FROM usuarios";
$resultado = mysqli_query($conexion, $sql);

// Crear instancia de FPDF
$pdf = new FPDF();
$pdf->AddPage();
$pdf->SetFont('Arial', 'B', 16);

// Título del PDF
$pdf->Cell(0, 10, utf8_decode('Reporte de Usuarios'), 0, 1, 'C');
$pdf->Ln(10);

// Cabeceras de la tabla
$pdf->SetFont('Arial', 'B', 12);
$pdf->Cell(40, 10, 'Nombres', 1);
$pdf->Cell(40, 10, 'Apellidos', 1);
$pdf->Cell(30, 10, 'DNI', 1);
$pdf->Cell(40, 10, 'Direccion', 1);
$pdf->Cell(40, 10, 'Telefono', 1);
$pdf->Ln();

// Verificar si hay resultados
if ($resultado && mysqli_num_rows($resultado) > 0) {
    // Establecer el estilo para el contenido de la tabla
    $pdf->SetFont('Arial', '', 12);

    // Recorrer los resultados
    while ($fila = mysqli_fetch_assoc($resultado)) {
        // Verificar si los campos existen antes de mostrarlos
        $nombres = isset($fila['nombres']) ? utf8_decode($fila['nombres']) : 'No disponible';
        $apellidos = isset($fila['apellidos']) ? utf8_decode($fila['apellidos']) : 'No disponible';
        $dni = isset($fila['dni']) ? $fila['dni'] : 'No disponible';
        $direccion = isset($fila['direccion']) ? utf8_decode($fila['direccion']) : 'No disponible';
        $telefono = isset($fila['telefono']) ? $fila['telefono'] : 'No disponible';

        // Agregar datos al PDF
        $pdf->Cell(40, 10, $nombres, 1);
        $pdf->Cell(40, 10, $apellidos, 1);
        $pdf->Cell(30, 10, $dni, 1);
        $pdf->Cell(40, 10, $direccion, 1);
        $pdf->Cell(40, 10, $telefono, 1);
        $pdf->Ln();
    }
} else {
    $pdf->Cell(0, 10, 'No se encontraron usuarios.', 1, 1, 'C');
}

// Salida del PDF al navegador
$pdf->Output('I', 'Reporte_Usuarios.pdf');
?>
