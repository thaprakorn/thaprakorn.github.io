<?php
$type = $_POST['type'];
if($type!='PDF'){ 
	echo 'EXCEL';
}else{
require('fpdf.php');
$servername = "localhost";
$username = "root";
$password = "";
$dbname = "dreamhome";

$conn = new mysqli($servername, $username, $password, $dbname);

if ($conn->connect_error) {
     die("Connection failed: " . $conn->connect_error);
} 

$sql = "SELECT fname,lname,position,MAX(salary) FROM staff WHERE position != 'Assistant' GROUP BY position";
$result = $conn->query($sql);

$pdf=new FPDF();
$pdf->AddPage();
$pdf->SetFont('Arial','B',12);

$heading = array('Firstname','Lastname','Position','max salary');
foreach($heading as $column_heading)
		
		$pdf->Cell(45,12,$column_heading,1);
		
foreach($result as $row) {
	$pdf->SetFont('Arial','',12);	
	$pdf->Ln();
	foreach($row as $column)
		$pdf->Cell(45,12,$column,1);
}
		

$pdf->Output();
}
?>

