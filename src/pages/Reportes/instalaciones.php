<?php
require('../../fpdf/rep_cl.php');
require('../../config/db.php');

$pdf = new FPDF();
$pdf->AddPage();
$fi=$_POST['fechainicial'];
$ff=$_POST['fechafinal'];
$emp=$_POST['empleado'];
$sql="select * from empleados where id='$emp'";
$resultado=mysql_query($sql,$Connect) or die (mysql_error());
$res=mysql_fetch_array($resultado);
$nombre=$res['nombre'];
$apellido=$res['apellido'];
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

$pdf->SetFont('Arial', 'B', 11);
$pdf->Cell(70, 8, '', 0);
$pdf->Cell(100, 8, 'Reporte de Instalacion de:  '.$nombre.$apellido, 0);
$pdf->Ln(23);
$pdf->Cell(0, 6, '------------------------------------------------------------------------------------------------------------------------------------------------------', 0);
$pdf->Ln(6);
$pdf->SetFont('Arial', 'B', 8);
$pdf->Cell(15, 6, '# Usuario', 0);
$pdf->Cell(38, 6, 'Nombre', 0);
$pdf->Cell(22, 6, 'Celular', 0);
$pdf->Cell(15, 6, 'Monto', 0);
$pdf->Cell(10, 6, 'Direccion', 0);

$pdf->Ln(4);
$pdf->Cell(0, 6, '---------------------------------------------------------------------------------------------------------------------------------------------------------------------------------------------------------------', 0);
$pdf->Ln(2);
$pdf->SetFont('Arial', '', 8);
//CONSULTA
$productos = mysqli_query($con,"SELECT * FROM clientesp where id_empleado='$emp' and fecha_inicial between '$fi' and '$ff'order by id desc");
$item = 0;

while($productos2 = mysqli_fetch_array($productos)){
	$item = $item+1;
	$nombre=$productos2['nombres'];
	$apellido= $productos2['apellido'];
	$noma="$nombre $apellido";

	$pdf->Cell(15, 6, $productos2['id'], 0);
	$pdf->Cell(38, 6,$noma, 0);
	$pdf->Cell(22, 6, $productos2['cell'], 0);
	$pdf->Cell(15, 6,$productos2['pago_total'] , 0);
	$pdf->Cell(10, 6, $productos2['direcion'], 0);
	
	$pdf->Ln(3);
}
$pdf->Ln(4);
$pdf->Cell(0, 6, '                                      -----------------------------------------------------------------------------------------------------------------------', 0);
$pdf->Ln(4);
$pdf->Cell(0, 6, '                                                                                     Total:'.$item, 0);
$pdf->Output();
mysqli_close($con);
?>