<?PHP
session_start();
require('fpdf.php');
ob_end_clean();
ob_start();

$conn=new mysqli("localhost", "root", "", "db_bash");
$pdf = new FPDF("P", "mm", array(215,279.95));
$pdf->AddPage();

$result = $conn->query("SELECT * FROM users");

$pdf->SetFont('Arial', 'B', 12);
$pdf->Cell(180,8, "Student List", 1, 1, 'C');
$pdf->Cell(60,8, "ID", 1, 0, 'C');
$pdf->Cell(60,8, "Name", 1, 0, 'C');
$pdf->Cell(60,8, "Age", 1, 1, 'C');
$pdf->SetFont('Arial', '', 12);
while ($row=$result->fetch_assoc()) {
    $pdf->Cell(60,8, "$row[id]", 1, 0, '');
    $pdf->Cell(60,8, "$row[name]", 1, 0, '');
    $pdf->Cell(60,8, "$row[age]", 1, 1, '');
}

$pdf->Output();
ob_end_flush();
?>