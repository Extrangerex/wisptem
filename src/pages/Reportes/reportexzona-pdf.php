<?php
require('../../fpdf/rep_cl.php');
require('../../config/db.php');
$zona = $_POST["sector"];
$fecha = $_POST["fecha"];
$pdf = new FPDF();
$pdf->AddPage();
$imagen="../../images/logo.png";
$pdf->Cell($pdf->Image($imagen, $pdf->GetX()+0, $pdf->GetY()+0, 30), 0, false );

$pdf->Ln(2);
$pdf->SetFont('Arial', '', 9);
$pdf->Cell(160, 8, '', 0);
$pdf->Cell(30, 10, 'Fecha: '.date('d-m-Y').'', 0);
$pdf->Ln(15);
$pdf->SetFont('Arial', 'B', 11);
$pdf->Cell(70, 8, '', 0);
$pdf->Cell(70, 8, 'LISTADO DE CLIENTES POR ZONA', 0);
$pdf->Ln(12);
$pdf->SetFont('Arial', 'B', 11);
$pdf->Cell(1, 10, '', 0);
$pdf->Cell(12, 10,'Zona:', 0);

$pdf->SetFont('Arial', 'B', 11);
$pdf->Cell(2, 10, '', 0);
$pdf->Cell(10, 10,$zona, 0);

$pdf->SetFont('Arial', 'B', 11);
$pdf->Cell(90, 10, '', 0);
$pdf->Cell(10, 10,'Fecha de corte:', 0);

$pdf->SetFont('Arial', 'B', 11);
$pdf->Cell(20, 10, '', 0);
$pdf->Cell(10, 10,$fecha, 0);
$pdf->Ln(15);



$pdf->Cell(0, 6, '------------------------------------------------------------------------------------------------------------------------------------------------------', 0);
$pdf->Ln(4);
$pdf->SetFont('Arial', 'B', 8);
$pdf->Cell(10, 6, 'ID', 0);
$pdf->Cell(15, 6, 'Postes', 0);
$pdf->Cell(38, 6, 'Nombre', 0);
$pdf->Cell(22, 6, 'Celular', 0);
$pdf->Cell(10, 6, 'Monto', 0);
$pdf->Cell(10, 6, 'Direccion', 0);

$pdf->Ln(4);
$pdf->Cell(0, 6, '---------------------------------------------------------------------------------------------------------------------------------------------------------------------------------------------------------------', 0);
$pdf->Ln(10);
$pdf->SetFont('Arial', '', 8);
//CONSULTA
if ($zona=='TODAS'){
	$productos = mysql_query("select * from clientesp where fecha_final='$fecha' order by poste asc");
}
else{
$productos = mysql_query("select * from clientesp where fecha_final='$fecha' and sector='$zona' order by poste asc");
}
$item = 0;
while($productos2 = mysql_fetch_array($productos)){
$item = $item+1;
	$nombre=$productos2['nombres'];
	$apellido= $productos2['apellido'];
	$noma="$nombre $apellido";
	$pdf->Cell(10, 6, $productos2['id'], 0);
	$pdf->Cell(15, 6, $productos2['poste'], 0);
	$pdf->Cell(38, 6,$noma, 0);
	$pdf->Cell(22, 6, $productos2['cell'], 0);
	$pdf->Cell(10, 6,$productos2['pago_total'] , 0);
	$pdf->Cell(10, 6, $productos2['direcion'], 0);
	
	
	$pdf->Ln(4);
}

$pdf->Output();


mysqli_close($con);

?>