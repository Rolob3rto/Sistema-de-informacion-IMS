<?php 
    require('../fpdf185/fpdf.php');

    include 'db.php';

    if ($_SERVER["REQUEST_METHOD"] == "POST") {
    $id = $_POST["idParteTrabajo"];

    $sql = "SELECT * FROM parteTrabajo WHERE idParteTrabajo = " . $id;
    }

    $resultado = mysqli_query($mysqli, $sql);
    $parte = mysqli_fetch_assoc($resultado);

    $pdf = new FPDF();
    $pdf->AddPage();
    $pdf->SetFont('Arial','B',16);
    $pdf->Cell(40,10,'¡Hola, Mundo!');
    
    $pdf->Output();
?>