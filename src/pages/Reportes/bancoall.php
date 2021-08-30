<?php
date_default_timezone_set("America/Santo_Domingo");
require('../../fpdf/rep_cl.php');
require('../../config/db.php');

$pdf = new FPDF();
$pdf->AddPage();

$sql = mysqli_query($con," select f.condiciones,f.numero_factura,f.fecha_factura,c.nombres,c.apellido,f.total_venta,u.firstname,u.lastname,u.user_id from facturas f left join  clientesp c on c.id=f.id_cliente left join users u on f.id_vendedor=u.user_id where f.condiciones=1");
$total = 0;

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
$pdf->Ln(10);

$pdf->SetFont('Arial', 'B', 8);
$pdf->Cell(70, 8, '', 0);
$pdf->Cell(100, 8, '         Pagos x Banco', 0);
$pdf->Ln(8);
$pdf->SetFont('Arial', 'B', 8);
$pdf->Cell(10, 8, '', 0);
$pdf->Cell(100, 8, 'Fecha: '.$fecha, 0);

$pdf->Ln(8);
$pdf->Cell(0, 6, '_______________________________________________________________________________________________________________________________________________________________________________________________________________', 0);
$pdf->Ln(6);
$pdf->SetFont('Arial', 'B', 8);

$pdf->Cell(15, 6, 'No Fact', 0);
$pdf->Cell(30, 6, 'Fecha del Pago', 0);
$pdf->Cell(70, 6, 'Nombre', 0);
$pdf->Cell(60, 6, 'Cobrador(a)', 0);
$pdf->Cell(15, 6, 'Monto', 0);


$pdf->Ln(4);
$pdf->Cell(0, 6, '---------------------------------------------------------------------------------------------------------------------------------------------------------------------------------------------------------------', 0);
$pdf->Ln(4);
$pdf->SetFont('Arial', '', 8);
//CONSULTA


while($row = mysqli_fetch_array($sql)){
  
	$total = $total+$row['total_venta'];
	$nombre=$row['nombres'];
	$apellido= $row['apellido'];
	$noma="$nombre $apellido";
	$fname = $row['firstname'];
	$lname = $row['lastname'];
	$nom = "$fname $lname";


    $pdf->Cell(4, 6, $contador, 0);

	$pdf->Cell(15, 6, $row['numero_factura'], 0);
	$pdf->Cell(30, 6,$row['fecha_factura'], 0);
	$pdf->Cell(70, 6, $noma, 0);
    $pdf->Cell(60, 6, $nom, 0);
	$pdf->Cell(15, 6,'RD $'.number_format($row['total_venta'],2), 0);
	
	$pdf->Ln(4);
}
$pdf->Ln(8);
$pdf->Cell(0, 6, '                                                          -------------------------------------------------------------------------------------', 0);
$pdf->Ln(8);
$pdf->Cell(0, 6, '                                                                                    Total: RD $'.number_format($total,2), 0);

$pdf->Output();
mysqli_close($con);
?>