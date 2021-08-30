<?php

	require_once ("../../config/db.php");//Contiene las variables de configuracion para conectar a la base de datos


	session_start();
	if (!isset($_SESSION['user_login_status']) AND $_SESSION['user_login_status'] != 1) {
        header("location: login.php");
	
		exit;
        }
		$_SESSION['usuario']=$_REQUEST['user_name'];
require('../../fpdf/fpdf.php');

$fnombre   = $_SESSION['firstname'];
$fapellido = $_SESSION['lastname'];
$fullname  = "$fnombre $fapellido";

$fullname  = "$fnombre $fapellido";

	$pdf=new FPDF('P', 'mm', 'A5');
$pdf->Open();
 // agregamos la pagina
$id = $_GET["id"];
$ff = $_GET["ff"];


$sql=mysqli_query($con, "select * from clientesp where id=$id");



$sql2=mysqli_query($con, "select max(numero_factura) as maximo from facturas");
$row2=mysqli_fetch_array($sql2);
$numfac = $row2['maximo'] + 1;

while ($row=mysqli_fetch_array($sql))
	{
		$pdf->AddPage();
	$id=$row["id"];
	
	$mac=$row['mac'];
	$pago=$row['pago_total'];
	$nombre=$row['nombres'];
	$apellido=$row['apellido'];
	$fec=$row['fecha_final'];
	$plan=$row['plan'];
	
	$nombres="$nombre $apellido";
	$celular=$row['cell'];
	$dir=$row['direcion'];
	$ref=$row['poste'];

$idpago=$row['id_pago'];
$mora=$row['mora'];

if ($idpago==2) {
$query_pago = mysqli_query($con,"select * from tipo_pago where id=$idpago");
$pag = mysqli_fetch_array($query_pago);
$tpago = $pag['descripcion'];
$query_plazo = mysqli_query($con,"select * from financiamiento where id_cliente=$id");
$rows = mysqli_fetch_array($query_plazo);
$plazo = $rows['plazo'];
$cuota = $rows['monto'] / $plazo;
}
$montotal = $pago + $mora;

$date=date("Y-m-d H:i:s");

$pdf->SetFont('Arial', 'B', 8);
$pdf->Cell(1, 5, '', 0);
$pdf->Cell(49, 5,$date,0);
$pdf->Ln(6);
$query=mysqli_query($con,"select * from perfil where id_perfil=1");
$row=mysqli_fetch_array($query);
$url=$row['logo_url'];
$imagen="../$url";
$pdf->Cell($pdf->Image($imagen, $pdf->GetX()+10, $pdf->GetY()+0, 20), 0, false );

$pdf->Ln(25);


$pdf->SetFont('Arial', 'B', 12);
$pdf->Cell(1, 5, '', 0);
$pdf->Cell(40, 5,'   '.NAME_EMPRESA, 0);
$pdf->Ln(5);
$pdf->SetFont('Arial', 'B', 9);
$pdf->Cell(1, 5, '', 0);
$pdf->Cell(40, 5,'   '.RNC_COMP, 0);
$pdf->Ln(5);

$pdf->SetFont('Arial', 'B', 8);
$pdf->Cell(1, 5, '', 0);
$pdf->Cell(40, 5,''.DIR_EMPRESA, 0);
$pdf->Ln(4);
$pdf->SetFont('Arial', 'B', 8);
$pdf->Cell(1, 5, '', 0);
$pdf->Cell(40, 5,''.CITYNAME, 0);
$pdf->Ln(4);
$pdf->SetFont('Arial', 'B', 8);
$pdf->Cell(1, 5, '', 0);
$pdf->Cell(40, 5,'      Tel: '.CELL_EMPRESA, 0);
$pdf->Ln(4);
$pdf->SetFont('Arial', 'B', 8);
$pdf->Cell(1, 5, '', 0);
$pdf->Cell(40, 5,'      Cell: '.CELL_OFICINA, 0);
$pdf->Ln(16);

$pdf->SetFont('Arial', 'B', 12);
$pdf->Cell(1, 5, '', 0);
$pdf->Cell(49, 5,'DATOS DEL CLIENTE',0);

$pdf->Ln(10);
$pdf->SetFont('Arial', 'B', 10);
$pdf->Cell(1, 5, '', 0);
$pdf->Cell(40, 5,'ID:   '.$id, 0);

$pdf->Ln(6);
$pdf->SetFont('Arial', 'B', 10);
$pdf->Cell(1, 5, '', 0);
$pdf->Cell(40, 5,'Nombre:   '.$nombres, 0);

$pdf->Ln(6);
$pdf->SetFont('Arial', '', 10);
$pdf->Cell(1, 5, '', 0);
$pdf->Cell(130, 5,'Cell:   '.$celular, 0);
$pdf->Ln(6);
$pdf->SetFont('Arial', '', 10);
$pdf->Cell(1, 5, '', 0);
$pdf->Cell(130, 5,'Factura No:   '.$numfac, 0);
$pdf->Ln(6);

$pdf->SetFont('Arial', '', 10);
$pdf->Cell(1, 5, '', 0);
$pdf->Cell(130, 5,'Fecha de pago:   '.$ff, 0);
$pdf->Ln(6);

$pdf->SetFont('Arial', '', 10);
$pdf->Cell(1, 5, '', 0);
$pdf->Cell(130, 5,'Plan:   '.$plan, 0);
$pdf->Ln(6);

$pdf->SetFont('Arial', 'B', 8);
$pdf->Cell(1, 5, '', 0);
$pdf->Cell(130, 5,'Mensualidad:   RD $'.number_format($pago), 0);
$pdf->Ln(6);
$pdf->SetFont('Arial', 'B', 8);
$pdf->Cell(1, 5, '', 0);
$pdf->Cell(130, 5,'Mora:                RD $'.number_format($mora), 0);
$pdf->Ln(6);
$pdf->SetFont('Arial', 'B', 8);
$pdf->Cell(1, 5, '', 0);
$pdf->Cell(130, 5,'Pago Total:      RD $'.number_format($montotal), 0);
$pdf->Ln(6);
$pdf->SetFont('Arial', '', 8);
$pdf->Cell(1, 5, '', 0);
$pdf->Cell(130, 5,'Direccion: '.$dir, 0);

$pdf->Ln(8);

$pdf->SetFont('Arial', 'B', 10);
$pdf->Cell(1, 5, '', 0);
$pdf->Cell(130, 5,'Cobrador:   '.$fullname, 0);



$pdf->Ln(10);
$pdf->SetFont('Arial', 'B', 8);
$pdf->Cell(1, 5, '', 0);
$pdf->Cell(40, 5,'REF:      '.$ref, 0);




$pdf->Ln(8);



$pdf->SetFont('Arial', '', 8);
$pdf->Cell(1, 5, '', 0);
$pdf->Cell(40, 5,'           Gracias por preferirnos', 0);
$pdf->Ln(4);


 // variable para almacenar el subtotal
$y = 115; // variable para la posici�n top desde la cual se empezar�n a agregar los datos
$x=0;

{

// aumento del top 5 cm
$y = $y + 5;
}

$pdf->Ln(2);

	}



$pdf->Output();
mysqli_close($con);
?>


	


      
