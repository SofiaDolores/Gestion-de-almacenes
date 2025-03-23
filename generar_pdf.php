<?php
require('fpdf.php');
include 'db.php';

class PDF extends FPDF
{
    // Cabecera de página
    function Header()
    {
        $this->SetFont('Arial', 'B', 12);
        $this->Cell(0, 10, 'Reporte de Inventario', 0, 1, 'C');
        $this->Ln(5);
        $this->Cell(10, 10, 'ID', 1);
        $this->Cell(40, 10, 'Nombre', 1);
        $this->Cell(60, 10, 'Descripcion', 1);
        $this->Cell(20, 10, 'Precio', 1);
        $this->Cell(20, 10, 'Cantidad', 1);
        $this->Cell(35, 10, 'Estado de Stock', 1);
        $this->Ln();
    }

    // Pie de página
    function Footer()
    {
        $this->SetY(-15);
        $this->SetFont('Arial', 'I', 8);
        $this->Cell(0, 10, 'Página ' . $this->PageNo(), 0, 0, 'C');
    }
}

$limite_stock_bajo = 10;

// Consultar los productos
$query = $conn->query("SELECT * FROM productos");
$productos = $query->fetchAll(PDO::FETCH_ASSOC);

// Crear un nuevo PDF
$pdf = new PDF();
$pdf->AddPage();
$pdf->SetFont('Arial', '', 10);

foreach ($productos as $producto) {
    $pdf->Cell(10, 10, $producto['id'], 1);
    $pdf->Cell(40, 10, $producto['nombre'], 1);
    $pdf->Cell(60, 10, $producto['descripcion'], 1);
    $pdf->Cell(20, 10, $producto['precio'], 1);
    $pdf->Cell(20, 10, $producto['cantidad'], 1);

    // Determinar estado de stock
    $estado_stock = $producto['cantidad'] <= $limite_stock_bajo ? 'Stock Bajo' : 'En Stock';
    $pdf->Cell(35, 10, $estado_stock, 1);
    $pdf->Ln();
}

// Salida del archivo PDF
$pdf->Output('D', 'reporte_inventario.pdf');
?>
