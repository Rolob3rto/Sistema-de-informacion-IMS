<?php
require('../fpdf185/fpdf.php');
define('EURO', chr(128));

include 'db.php';

if ($_SERVER["REQUEST_METHOD"] == "POST") {
    $id = $_POST["idParteTrabajo"];

    $sql = "SELECT * FROM parteTrabajo WHERE idParteTrabajo = " . $id;
}

$resultado = mysqli_query($mysqli, $sql);

$fila = null;

if (mysqli_num_rows($resultado) > 0) {
     $fila = mysqli_fetch_assoc($resultado);

}
class MyPDF extends FPDF
{
    
    function Header()
    {
        global $fila;

        $this->Image('../img/portada.jpg', 10, 8, 33, 0);

        $this->Image('../img/portada.jpg', $this->GetPageWidth() / 2 + 10, 8, 33, 0);
        
        $this->SetFont('Arial', 'B', 8);
        $this->SetXY(47, 8);
        $this->MultiCell(50, 3.2, iconv('UTF-8', 'windows-1252', 'IMS LINARES SL'), 0, 'C');
        
        $this->SetFont('Arial', '', 8);
        $this->SetXY(47, 8);
        $textoCentral = '' . "\n" . 'B-23.377.286' . "\n" . 'Avda. San Sebastian, 28' . "\n" . '23700 Linares (Jaén)' . "\n" . 'Télf.: 953 697 028 Fax: 953 694 612' . "\n" . 'e-mail: ims@imslinares.es';
        $this->MultiCell(50, 3.2, iconv('UTF-8', 'windows-1252', $textoCentral), 0, 'C');

        $this->SetFont('Arial', 'B', 8);
        $this->SetXY($this->GetPageWidth() / 2 + 47, 8);
        $this->MultiCell(50, 3.2, iconv('UTF-8', 'windows-1252', 'IMS LINARES SL'), 0, 'C');

        $this->SetFont('Arial', '', 8);
        $this->SetXY($this->GetPageWidth() / 2 + 47, 8);        
        $this->MultiCell(50, 3.2, iconv('UTF-8', 'windows-1252', $textoCentral), 0, 'C');
        
        
        $this->SetXY($this->GetPageWidth() / 2 - 50, 8);  
        $this->SetFont('Arial', 'B', 8);
        $this->SetFillColor(192, 192, 192);
        $this->MultiCell(42, 4, iconv('UTF-8', 'windows-1252','RESGUARDO DE DEPOSITO' . "\n" . 'SOLICITUD DE REPARACION'), 1, 'C', true);

        $this->SetXY($this->GetPageWidth() / 2 - 50, 17);  
        $this->SetFont('Arial', 'B', 8);
        $this->SetFillColor(255, 255, 255);
        //$this->MultiCell(42, 4.5, 'IM', 1, 'C', true);
        $this->Cell(42, 4.5, 'IM'. $fila["anio"] . '/' . str_pad($fila["numeroParte"], 8, '0', STR_PAD_LEFT), 1, 0, 'C', true);

        $this->SetXY($this->GetPageWidth() / 2 - 50, 22.5);  
        $this->Cell(28, 4.5, strtoupper($fila["tipo"]), 1, 5, 'C', true);

        $this->SetXY($this->GetPageWidth() / 2 - 20, 22.5);  
        $this->Cell(12, 4.5, strtoupper($fila["estado"]), 1, 5, 'C', true);


        $this->SetXY($this->GetPageWidth() - 50, 8);  
        $this->SetFont('Arial', 'B', 8);
        $this->SetFillColor(192, 192, 192);
        $this->MultiCell(42, 4, 'RESGUARDO DE DEPOSITO' . "\n" . 'SOLICITUD DE REPARACION', 1, 'C', true);

        $this->SetXY($this->GetPageWidth() - 50, 17);  
        $this->SetFont('Arial', 'B', 8);
        $this->SetFillColor(255, 255, 255);
        //$this->MultiCell(42, 4.5, 'IM', 1, 'C', true);
        $this->Cell(42, 4.5, 'IM'. $fila["anio"] . '/' . str_pad($fila["numeroParte"], 8, '0', STR_PAD_LEFT), 1, 0, 'C', true);

        $this->SetXY($this->GetPageWidth() - 50, 22.5);  
        $this->Cell(28, 4.5, strtoupper($fila["tipo"]), 1, 5, 'C', true);

        $this->SetXY($this->GetPageWidth() - 20, 22.5);  
        $this->Cell(12, 4.5, strtoupper($fila["estado"]), 1, 5, 'C', true);
        
        $this->Ln(5);
    }

    function GetBottomMargin()
    {
        return $this->bMargin;
    }
    
   
}

$resultado = mysqli_query($mysqli, $sql);
$parte = mysqli_fetch_assoc($resultado);

// Crear un objeto PDF
$pdf = new MyPDF();

$pdf->AddPage('L');


// Divide la página en dos mitades
$pdf->Line($pdf->GetPageWidth() / 2, $pdf->GetY() - 20, $pdf->GetPageWidth() / 2, $pdf->GetPageHeight() - $pdf->GetBottomMargin() - $pdf->GetY() + 30);
$pdf->Line(10, 30, $pdf->GetPageWidth() / 2 - 10, 30 );
$pdf->Line($pdf->GetPageWidth() / 2 + 10, 30, $pdf->GetPageWidth() - 10, 30);
$pdf->Line(10, 46, $pdf->GetPageWidth() / 2 - 10, 46);
$pdf->Line($pdf->GetPageWidth() / 2 + 10, 46, $pdf->GetPageWidth() - 10, 46);
//$pdf->Line(10, 180, $pdf->GetPageWidth() / 2 - 10, 180 );
//$pdf->Line($pdf->GetPageWidth() / 2 + 10, 180, $pdf->GetPageWidth() - 10, 180 );


$pdf->SetX(10);
$pdf->SetFont('Arial', 'B', 8);
$pdf->SetFillColor(192, 192, 192);
$pdf->Cell(20, 5, 'ENTRADA', 0, 0, 'C', true);

//var_dump($fila['fechaEntrada']);
$pdf->SetFont('Arial', '', 8);
$fechaEntrada = new DateTime($fila['fechaEntrada']);
$fechaEntradaString = $fechaEntrada->format('d/m/Y H:i:s');
$pdf->Cell(30, 5, $fechaEntradaString, 0, 0, 'C');


$pdf->SetX($pdf->GetX() + 30);
$pdf->SetFont('Arial', 'B', 8);
$pdf->Cell(20, 5, 'RECOGIDA', 0, 0, 'C', true);

$pdf->SetFont('Arial', '', 8);
if ($fila['fechaSalida'] != null) {
    
    $fechaSalida = new DateTime($fila['fechaSalida']);
    $fechaSalidaString = $fechaSalida->format('d/m/Y H:i:s');
    
} else {
    $fechaSalidaString = '';
}
$pdf->Cell(30, 5, $fechaSalidaString, 0, 0, 'C');

$pdf->SetXY(10, 39);
$pdf->SetFont('Arial', 'B', 8);
$pdf->SetFillColor(192, 192, 192);
$pdf->Cell(20, 5, 'TECNICO', 0, 0, 'C', true);

$pdf->SetFont('Arial', '', 8);
$pdf->Cell(35, 5, $fila['tecnico'], 0, 0, 'L');

$pdf->SetFont('Arial', 'B', 8);
$pdf->SetFillColor(192, 192, 192);
$pdf->Cell(20, 5, 'HORAS', 0, 0, 'C', true);

$pdf->SetFont('Arial', '', 8);
if ($fila['horas'] != null) {
    $horas = $fila['horas'];
} else {
    $horas = '0';
}
$pdf->Cell(10, 5, $horas, 0, 0, 'C');

$pdf->SetX($pdf->GetX() + 6);
$pdf->SetFont('Arial', 'B', 8);
$pdf->SetFillColor(192, 192, 192);
$pdf->Cell(30, 5, 'PRESUPUESTO', 0, 0, 'C', true);


$pdf->SetFont('Arial', '', 8);
$pdf->Cell(5, 5, 'N', 0, 0, 'C');

$pdf->SetXY(10, 48);
$pdf->SetFont('Arial', 'B', 8);
$pdf->SetFillColor(192, 192, 192);
$pdf->Cell(20, 5, 'CLIENTE', 0, 0, 'C', true);

$pdf->SetXY($pdf->GetPageWidth() / 2 + 10, $pdf->GetY()); // Agrega un espacio entre las dos mitades

$pdf->SetXY($pdf->GetPageWidth() / 2 + 10, 32);
$pdf->SetFont('Arial', 'B', 8);
$pdf->Cell(18, 5, 'ENTRADA', 0, 0, 'C', true);

$pdf->SetFont('Arial', '', 8);
$fechaEntrada = new DateTime($fila['fechaEntrada']);
$fechaEntradaString = $fechaEntrada->format('d/m/Y H:i:s');
$pdf->Cell(30, 5, $fechaEntradaString, 0, 0, 'C');

$pdf->SetX($pdf->GetX() + 30);
$pdf->SetFont('Arial', 'B', 8);
$pdf->Cell(20, 5, 'RECOGIDA', 0, 0, 'C', true);

$pdf->SetFont('Arial', '', 8);
if ($fila['fechaSalida'] != null) {
    
    $fechaSalida = new DateTime($fila['fechaSalida']);
    $fechaSalidaString = $fechaSalida->format('d/m/Y H:i:s');
    
} else {
    $fechaSalidaString = '';
}
$pdf->Cell(30, 5, $fechaSalidaString, 0, 0, 'C');

$pdf->SetXY($pdf->GetPageWidth() / 2 + 10, 39);
$pdf->SetFont('Arial', 'B', 8);
$pdf->SetFillColor(192, 192, 192);
$pdf->Cell(20, 5, 'TECNICO', 0, 0, 'C', true);

$pdf->SetFont('Arial', '', 8);
$pdf->Cell(35, 5, $fila['tecnico'], 0, 0, 'L');

$pdf->SetFont('Arial', 'B', 8);
$pdf->SetFillColor(192, 192, 192);
$pdf->Cell(20, 5, 'HORAS', 0, 0, 'C', true);

$pdf->SetFont('Arial', '', 8);
if ($fila['horas'] != null) {
    $horas = $fila['horas'];
} else {
    $horas = '0';
}
$pdf->Cell(10, 5, $horas, 0, 0, 'C');

$pdf->SetX($pdf->GetX() + 6);
$pdf->SetFont('Arial', 'B', 8);
$pdf->SetFillColor(192, 192, 192);
$pdf->Cell(30, 5, 'PRESUPUESTO', 0, 0, 'C', true);


$pdf->SetFont('Arial', '', 8);
$pdf->Cell(5, 5,'N', 0, 0, 'C');

$pdf->SetFont('Arial', '', 6);
$textazoAbajo = 'Es ncesaria la presentación de este resguardo de deposito tanto para la recogida de la máquina depositada como del presupuesto de servido técnico. En caso de pérdida se entregará con la suficiente identificación del cliente, por del SAT de IMS. Las máquinas entregadas y no retiradas en un plazo superior a 60 dias de la fecha de reparación denvengará un cargo adicional de 0,95€ por día, esta misma norma se aplicara a aquellos productos que elaborado el presupuesto de reparación y no aceptación del mismo, no se retiren en 10 días hábiles, desde fecha de su comunicado, NO haciéndose responsable la empresa de dichos productos pasados los 60 días, mencionados con anterioridad. La reparación tiene una garantia de 3 meses desde fecha salida del equipo (según art. 6º del RD num. 58/1988 de 29 de febrero, por el que se regula la prestación de servicios de reparación).NO estarán en garantía los consumibles y accesorios utilizados para la misma, así mismo, NO están garantizados las piezas o máquinas que hayan sido manipulados o mal usadas por otras personas ajenas a nuestro SAT, tampoco, aquellas piezas defectuosas por causas ajenas al normal funcionamiento de la máquina. NO son garantizados por problemas derivados por el Sist. Operativo, virus, mala instalación o configuración software, etc. ajenos a intervención de nuestro SAT. NO se garantiza las piezas montadas por personas ajenas anuestro SAT, aunque haya sido vendido por IMS Linares. La empresa NO se hace responsable de la perdida de BBDD, Software instalado, aplicaciones... instalado en los equipos depositados (es responsabilidad del cliente las copias de seguridad o respaldo). El diente queda OBLIGADO al pago del presupuesto sólo cuando, NO fuera aceptado por el cliente. El mismo tiene una validez de 30 días desde fecha de su comunicación. El coste del mismo es el mismo de la intervención mínima. Mano de obra de taller 48€, visita a domicilio (Linares) 60€, recogida y entrega (Linares) 12€. Desplazamineto otras localidades a razón de 0,28€/KM. NO incluido IVA 18%.';
$textilloAbajo = 'INTERVENCIÓN MÍNIMA O DIASNOSTICO 15 €. IMS LINARES no se responsabiliza de la perdida de datos o información ni de consumibles. El CLIENTE debe comunicar EXPLICITAMENTE si necesita copia de respaldo de sus documentos personales ANTES DE CUALQUIER INTERVENCIÓN en el equipo depositado.';

$pdf->SetY($pdf->GetPageHeight() - 66);
$pdf->MultiCell($pdf->GetPageWidth() / 2 - 20, 2, iconv('UTF-8', 'windows-1252', $textazoAbajo . "\n\n"), 0, 'J');
$pdf->MultiCell($pdf->GetPageWidth() / 2 - 20, 2, iconv('UTF-8', 'windows-1252', $textilloAbajo), 0, 'J');

$pdf->SetXY($pdf->GetPageWidth() / 2 + 10, $pdf->GetPageHeight() - 66);
$pdf->MultiCell($pdf->GetPageWidth() / 2 - 20, 2, iconv('UTF-8', 'windows-1252', $textazoAbajo . "\n\n"), 0, 'J');
$pdf->SetX($pdf->GetPageWidth() / 2 + 10);
$pdf->MultiCell($pdf->GetPageWidth() / 2 - 20, 2, iconv('UTF-8', 'windows-1252', $textilloAbajo), 0, 'J');

$pdf->Output();