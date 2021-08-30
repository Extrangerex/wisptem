<?php
require('../../fpdf/rep_cl.php');
require('../../config/db.php');
$zona = $_POST["sector"];
$fecha = $_POST["fecha"];
class PDF extends FPDF
{

//Pie de página
function Footer()
{
    //Posición: a 1,5 cm del final
    $this->SetY(-15);
    //Arial italic 8
    $this->SetFont('Arial','I',8);
    //Número de página
    $this->Cell(0,10,'Pagina '.$this->PageNo().'/{nb}',0,0,'C');
}
}

//Creación del objeto de la clase heredada
$pdf=new PDF();
$pdf->AliasNbPages();
$pdf->AddPage();
$query=mysqli_query($con,"select * from perfil where id_perfil=1");
$row=mysqli_fetch_array($query);
$url=$row['logo_url'];
$imagen="../$url";
$pdf->Cell($pdf->Image($imagen, $pdf->GetX()+0, $pdf->GetY()+0, 30), 0, false );

$pdf->Ln(2);
$pdf->SetFont('Arial', '', 9);
$pdf->Cell(160, 8, '', 0);
$pdf->Cell(30, 10, 'Fecha: '.date('d-m-Y').'', 0);
$pdf->Ln(15);
$pdf->SetFont('Arial', 'B', 14);
$pdf->Cell(70, 8, '', 0);
$pdf->Cell(100, 8, $row['nombre_empresa'], 0);

$pdf->Ln(6);
$pdf->SetFont('Arial', 'B', 10);
$pdf->Cell(70, 8, '', 0);
$pdf->Cell(100, 8, '       RNC: '.$row['rnc'], 0);
$pdf->Ln(20);

$pdf->SetFont('Arial', 'B', 8);
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
$pdf->Cell(37, 6, 'Usuario', 0);
$pdf->Cell(38, 6, 'Nombre', 0);
$pdf->Cell(22, 6, 'Celular', 0);
$pdf->Cell(10, 6, 'Monto', 0);

$pdf->Cell(10, 6, 'Direccion', 0);

$pdf->Ln(4);
$pdf->Cell(0, 6, '---------------------------------------------------------------------------------------------------------------------------------------------------------------------------------------------------------------', 0);
$pdf->Ln(10);
$pdf->SetFont('Arial', '', 8);
//CONSULTA

$productos = mysqli_query($con,"select * from clientesp where fecha_final='$fecha' and sector='$zona' order by usuario asc");

$item = 0;
$montototal=0;
while($productos2 = mysqli_fetch_array($productos)){
	$item = $item+1;
	$montototal = $montototal + $productos2['pago_total'];
	$pdf->SetFont('Arial', 'B', 8);
	$nombre=$productos2['nombres'];
	$apellido= $productos2['apellido'];
	$noma="$nombre $apellido";
	$pdf->Cell(10, 6, $productos2['id'], 0);
	$pdf->Cell(37, 6, $productos2['usuario'], 0);
	$pdf->Cell(40, 6,$noma, 0);
	$pdf->Cell(22, 6, $productos2['cell'], 0);
	$pdf->Cell(10, 6,$productos2['pago_total'] , 0);
	$pdf->SetFont('Arial', 'B', 6);
	$pdf->Cell(10, 6, $productos2['direcion'], 0);
	
	$pdf->Ln(4);
}
$pdf->Ln(8);
$pdf->Cell(0, 6, '                                                          --------------------------------------------------------------------------------------------------------------------------', 0);
$pdf->Ln(8);
$pdf->SetFont('Arial', 'B', 8);
$pdf->Cell(0, 6, '                                                                                    Total: '.$item. '    Monto Total: RD$ '.$montototal);

$pdf->Output();



mysqli_close($con);

?>