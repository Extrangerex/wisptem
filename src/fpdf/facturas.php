<?php

//Recibir detalles de factura




//Recibir los datos de la empresa
$nombre_tienda = $_POST["nombre_tienda"];
$telefono_tienda = $_POST["telefono_tienda"];
$fecha_actual = $_POST["fecha_actual"];
$concepto = $_POST["concepto"];


//Recibir los datos del cliente
$nombre_cliente = $_POST["nombre_cliente"];
$cell_cliente = $_POST["cell_cliente"];
$cod_cliente = $_POST["codigo_cliente"];
$fec_cliente = $_POST["fec_cliente"];
$dip_cliente = $_POST["diasp_cliente"];
$pago_cliente = $_POST["pago_cliente"];




//variable que guarda el nombre del archivo PDF
$archivo="factura-$fecha_actual.pdf";

//Llamada al script fpdf
require('fpdf.php');


$archivo_de_salida=$archivo;

$pdf=new FPDF();  //crea el objeto
$pdf->AddPage();  //añadimos una página. Origen coordenadas, esquina superior izquierda, posición por defeto a 1 cm de los bordes.







$pdf->SetFont('Arial','B',12);
$pdf->Cell(200, 5, "Playcenter Universal",0,1,'C'); 
$pdf->SetFont('Arial','',8);
$pdf->Cell(200, 5,  "Ave. Estrella Sadhala #55",0,1,'C');
$pdf->SetFont('Arial','',9);
$pdf->Cell(200, 5,  $concepto,0,1,'C');
$pdf->SetFont('Arial','',9);
$pdf->Cell(200, 5,  $fecha_actual,0,1,'C');  
$pdf->Ln(2);
$pdf->Ln(2);
$pdf->Ln(2);
$pdf->Ln(2);
$pdf->Ln(2);
$pdf->Ln(2);
$pdf->Ln(2);
$pdf->Ln(2);
$pdf->Ln(2);
$pdf->Ln(2);
$pdf->Ln(2);
$pdf->SetFont('Arial','',9);
$pdf->Cell( 200, 7, "Nombre: ".$nombre_cliente,0,1,'C');
$pdf->SetFont('Arial','',9); 
$pdf->Cell( 200, 7, "Celular: ".$cell_cliente,0,1,'C');
$pdf->SetFont('Arial','',9);
$pdf->Cell( 200, 7, "Codigo: ".$cod_cliente,0,1,'C');
$pdf->SetFont('Arial','',9);
$pdf->Cell( 200, 7,"Factura Corespondiente A: ".$fec_cliente,0,1,'C');
$pdf->SetFont('Arial','',9);
$pdf->Cell( 200, 7,"Dias de Pagos: ".$dip_cliente,0,1,'C');
$pdf->SetFont('Arial','',9);
$pdf->Cell( 200, 7,"Total: $ ".$pago_cliente,0,1,'C');


 

//Salto de línea
$pdf->Ln(2);






 
$precio_subtotal = 0; // variable para almacenar el subtotal
$y = 115; // variable para la posición top desde la cual se empezarán a agregar los datos
$x=0;

{



// aumento del top 5 cm
$y = $y + 5;
}





$pdf->Ln(2);






$pdf->Output();
?>
