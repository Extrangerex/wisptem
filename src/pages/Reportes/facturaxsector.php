<?php

	require_once ("../../config/db.php");//Contiene las variables de configuracion para conectar a la base de datos


	session_start();
	if (!isset($_SESSION['user_login_status']) AND $_SESSION['user_login_status'] != 1) {
        header("location: login.php");
	
		exit;
        }
		$_SESSION['usuario']=$_REQUEST['user_name'];
require('../../fpdf/fpdf.php');

	$pdf=new FPDF('P', 'mm', 'A5');
$pdf->Open();
 // agregamos la pagina
$zona = $_POST["sector"];
$fecha = $_POST["fecha"];

$sql=mysqli_query($con, "select * from clientesp where fecha_final='$fecha' and sector like '%$zona%'");

while ($row=mysqli_fetch_array($sql))
	{

		$pdf->AddPage();
	$id=$row["id"];
	
	$mac=$row['mac'];
	$pago=$row['pago_total'];
	$nombre=$row['nombres'];
	$apellido=$row['apellido'];
	$fec=$row['fecha_final'];
	$montot=$pago;
	$nombres="$nombre $apellido";
	$celular=$row['cell'];
	$dir=$row['direcion'];
	$ref=$row['poste'];
$date=date("Y-m-d");

$pdf->SetFont('Arial', 'B', 8);
$pdf->Cell(1, 5, '', 0);
$pdf->Cell(49, 5,$date,0);

$imagen="../../images/logo.png";
$pdf->Cell($pdf->Image($imagen, $pdf->GetX()+0, $pdf->GetY()+0, 30), 0, false );

$pdf->Ln(34);





$pdf->SetFont('Arial', 'B', 12);
$pdf->Cell(1, 5, '', 0);
$pdf->Cell(49, 5,'DATOS DEL CLIENTE:', 1, 'L',0);

$pdf->Ln(8);
$pdf->SetFont('Arial', 'B', 10);
$pdf->Cell(1, 5, '', 0);
$pdf->Cell(40, 5,'TITULAR DE PAGO:  '.$nombres, 0);
$pdf->SetFont('Arial', '', 8);
$pdf->Cell(1, 5, '', 0);
$pdf->Cell(140, 5,'TELEFONO O CEL:   '.$celular, 0, 1, 'C');
$pdf->Ln(2);
$pdf->SetFont('Arial', 'B', 10);
$pdf->Cell(1, 5, '', 0);
$pdf->Cell(180, 5,'Total del mes:            RD$'.$pago, 0);
$pdf->SetFont('Arial', '', 8);
$pdf->Cell(1, 5, '', 0);
$pdf->Cell(-140, 5,'FECHA DE PAGO:   '.$fec, 0, 1, 'C');
$pdf->Ln(2);


$pdf->SetFont('Arial', 'B', 8);
$pdf->Cell(1, 5, '', 0);
$pdf->Cell(40, 5,'DIRECCION:      '.$dir, 0);
$pdf->Ln(8);

$pdf->SetFont('Arial', 'B', 10);
$pdf->Cell(1, 5, '', 0);
$pdf->Cell(40, 5,'REF:      '.$ref, 0);
$pdf->Ln(8);
$pdf->SetFont('Arial', 'B', 8);
$pdf->Cell(1, 5, '', 0);
$pdf->Cell(49, 5,'Servicio al Cliente',0);
$pdf->SetFont('Arial', 'B', 8);
$pdf->Cell(1, 5, '', 0);
$pdf->Cell(49, 5,'Tecnico:                        809-850-2774',0, 1, 'L');

	$pdf->Ln(2);
$pdf->SetFont('Arial', 'B', 8);
$pdf->Cell(1, 5, '', 0);
$pdf->Cell(40, 5,'829-345-4100', 0);
$pdf->SetFont('Arial', 'B', 8);
$pdf->Cell(1, 5, '', 0);
$pdf->Cell(49, 5,'            Cobrador Santiago:     829-345-4101',0, 1, 'L');

$pdf->Ln(2);
$pdf->SetFont('Arial', 'B', 8);
$pdf->Cell(1, 5, '', 0);
$pdf->Cell(40, 5,'809-241-2693   Oficina', 0);	
$pdf->SetFont('Arial', 'B', 8);
$pdf->Cell(1, 5, '', 0);
$pdf->Cell(49, 5,'            Cobrador Tamboril:     829-345-4102',0, 1, 'L');


$pdf->Ln(2);
$pdf->SetFont('Arial', 'B', 8);
$pdf->Cell(1, 5, '', 0);
$pdf->Cell(249, 15,'Nota: el Mensajero solo pasara 2 veces por su localidad.',0);
$pdf->Ln(4);
$pdf->SetFont('Arial', 'B', 8);
$pdf->Cell(1, 5, '', 0);
$pdf->Cell(249, 15,'Tiene la opcion de depositar en Nuestra cuentas de bancos ',0);
$pdf->Ln(4);
$pdf->SetFont('Arial', 'B', 8);
$pdf->Cell(1, 5, '', 0);
$pdf->Cell(249, 15,'Si le toca pagar los 30 tiene para pagar hasta el dia 5. ',0);
$pdf->Ln(4);
$pdf->SetFont('Arial', 'B', 8);
$pdf->Cell(1, 5, '', 0);
$pdf->Cell(249, 15,'Si le toca pagar los 15 tiene para pagar hasta el dia 20. ',0);
$pdf->Ln(12);
$pdf->SetFont('Arial', '', 8);
$pdf->Cell(1, 5, '', 0);
$pdf->Cell(26, 5,'Cuentas Bancarias:', 1, 'L',0);
$pdf->Ln(4);
$pdf->SetFont('Arial', 'B', 9);
$pdf->Cell(1, 5, '', 0);
$pdf->Cell(249, 15,'BHD Leon No: 16815110011     Popular: No 772378816     Banreservas No: 7200050364 ',0);
$pdf->Ln(8);
$pdf->SetFont('Arial', 'B', 8);
$pdf->Cell(1, 5, '', 0);
$pdf->Cell(249, 15,'---------------------------------------------------------------------------------------------------------------------',0);
$pdf->Ln(12);
$pdf->SetFont('Arial', 'B', 10);
$pdf->Cell(1, 5, '', 0);
$pdf->Cell(249, 5,'                                                COPIA FUN                              '.$date, 0);

$pdf->SetFont('Arial', 'B', 10);
$pdf->Cell(1, 5, '', 0);
$pdf->Cell(49, 5,'DATOS DEL CLIENTE:', 1, 'L',0);

$pdf->Ln(8);
$pdf->SetFont('Arial', 'B', 10);
$pdf->Cell(1, 5, '', 0);
$pdf->Cell(40, 5,'TITULAR DE PAGO:  '.$nombres, 0);
$pdf->SetFont('Arial', '', 8);
$pdf->Cell(1, 5, '', 0);
$pdf->Cell(140, 5,'TELEFONO O CEL:   '.$celular, 0, 1, 'C');
$pdf->Ln(2);
$pdf->SetFont('Arial', 'B', 10);
$pdf->Cell(1, 5, '', 0);
$pdf->Cell(180, 5,'Total del mes:            RD$'.$pago, 0);
$pdf->SetFont('Arial', '', 8);
$pdf->Cell(1, 5, '', 0);
$pdf->Cell(-140, 5,'FECHA DE PAGO:   '.$fec, 0, 1, 'C');
$pdf->Ln(2);


$pdf->SetFont('Arial', 'B', 8);
$pdf->Cell(1, 5, '', 0);
$pdf->Cell(40, 5,'Direccion:      '.$dir, 0);
$pdf->Ln(6);

$pdf->SetFont('Arial', 'B', 10);
$pdf->Cell(1, 5, '', 0);
$pdf->Cell(40, 5,'REF:      '.$ref, 0);

 
 



 // variable para almacenar el subtotal
$y = 115; // variable para la posición top desde la cual se empezarán a agregar los datos
$x=0;

{

// aumento del top 5 cm
$y = $y + 5;
}

$pdf->Ln(2);

	}

mysqli_close($con);

$pdf->Output();

	


      
