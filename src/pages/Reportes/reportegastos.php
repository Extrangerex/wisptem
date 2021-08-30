<?php
date_default_timezone_set("America/Santo_Domingo");
require('../../fpdf/rep_cl.php');
require('../../config/db.php');

$pdf = new FPDF();
$pdf->AddPage();
$fi = $_POST["fi"];
$ff = $_POST["ff"];
$productos = mysqli_query($con," select * from gastos where fecha between '$fi' and '$ff'");
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
$pdf->Cell(100, 8, '   Listado De Todos Los Gastos', 0);
$pdf->Ln(8);
$pdf->SetFont('Arial', 'B', 8);
$pdf->Cell(10, 8, '', 0);
$pdf->Cell(100, 8, 'Fecha Inicial: '.$fi.'      Fecha Final: '.$ff, 0);

$pdf->Ln(8);
$pdf->Cell(0, 6, '_______________________________________________________________________________________________________________________________________________________________________________________________________________', 0);
$pdf->Ln(6);
$pdf->SetFont('Arial', 'B', 8);
$pdf->Cell(8, 6, '#', 0);
$pdf->Cell(20, 6, 'Fecha', 0);
$pdf->Cell(140, 6, 'Motivo', 0);
$pdf->Cell(8, 6, 'Monto', 0);



$pdf->Ln(4);
$pdf->Cell(0, 6, '----------------------------------------------------------------------------------------------------------------------------------------------------------------------------------------------------------------------', 0);
$pdf->Ln(4);
$pdf->SetFont('Arial', '', 8);
//CONSULTA


while($productos2 = mysqli_fetch_array($productos)){
    $contador ++;
    $total = $total+$productos2['monto'];
    


    $pdf->Cell(8, 6, $contador, 0);

    $pdf->Cell(20, 6, $productos2['fecha'], 0);
    $pdf->Cell(140, 6,$productos2['motivo'], 0);
    $pdf->Cell(8, 6, 'RD$ '.number_format($productos2['monto'],2), 0);
   
    
    $pdf->Ln(4);
}
$pdf->Ln(8);
$pdf->Cell(0, 6, '                                                          -------------------------------------------------------------------------------------', 0);
$pdf->Ln(8);
$pdf->SetFont('Arial', 'B', 12);
$pdf->Cell(0, 6, '                                                         Total: RD$ '.number_format($total,2), 0);

$pdf->Output();

mysqli_close($con);

?>