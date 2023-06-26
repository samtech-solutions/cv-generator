
<?php
require_once "../fpdf/fpdf.php";
require_once "../connection.php";

 $today = date ('y:m:d'); 
 $new = date ('l, F, d, Y', strtotime($today));	
 
session_start();
$current_user_id = $_SESSION["user-id"];
$new_trans_id = $_SESSION["newuser"];

$query = "SELECT * FROM payment WHERE id='$new_trans_id'";
//echo $new_trans_id ; 
$data = mysqli_query($conn, $query) or die(mysqli_error($conn));

$row = mysqli_fetch_assoc($data);

//DESIGN ONE
			
	$pdf = new FPDF('p', 'mm', 'a4');
	$pdf->AliasNbPages();
	$pdf->SetFont('arial', 'B', '14');

	$pdf->AddPage();
	$pdf->Image('../images/cv1.png',10,6,25);
	$pdf->Cell(1);
		
	$pdf->SetFont('arial', 'b', '12');
	$pdf->cell(58, 10, '', 0, 0, 'L');
	$pdf->SetFont('arial', 'B', '11');
	$pdf->cell(5, 10,'INVOICE', 0, 1, 'L');
    
	$pdf->SetFont('arial', 'b', '12');
	$pdf->cell(58, 10, '', 0, 0, 'L');
	$pdf->SetFont('arial', 'B', '11');
	$pdf->cell(5, 10,$new, 0, 1, 'L');

	$pdf->SetFont('arial', 'b', '12');
	$pdf->cell(58, 10, '', 0, 0, 'C');
	$pdf->cell(25,10, 'Receipt no:', 0, 0, 'L');
	$pdf->SetFont('arial', '', '12');
	$pdf->cell(5, 10, $row['usertoken'], 0, 1, 'L');
    
	$pdf->SetFont('arial', 'b', '12');
	$pdf->cell(58, 10, '', 0, 0, 'C');
    $pdf->SetFont('arial', 'b', '11');
	$pdf->cell(25,10, 'Date Paid :', 0, 0, 'L');
	$pdf->SetFont('arial', '', '12');
	$pdf->cell(5, 10, $row['date_paid'], 0, 1, 'L');

	$pdf->SetFont('arial', '', '12');
	$pdf->cell(30, 10, '', 0, 0, 'C');
	$pdf->SetFont('arial', 'B', '15');
	$pdf->cell(130, 10, '************************************************************************************', 0, 1, 'C');

	
	$pdf->SetFont('arial', 'b', '11');
	$pdf->cell(40,10,'Userstatus :', 0, 0, 'L');
	$pdf->SetFont('arial', '', '11');
	$pdf->cell(5, 10, $row['userstatus'], 0, 1, 'L');

	$pdf->SetFont('arial', 'b', '11');
	$pdf->cell(40, 10, 'Package Type:', 0, 0, 'L');
	$pdf->SetFont('arial', '', '12');
	$pdf->cell(5, 10, $row['package_type'], 0, 1, 'L');

	$pdf->SetFont('arial', 'b', '11');
	$pdf->cell(40, 10, 'Payment Plan:', 0, 0, 'L');
	$pdf->SetFont('arial', '', '11');
	$pdf->cell(5, 10, $row['payment_plan'], 0, 1, 'L');

	$pdf->SetFont('arial', 'b', '11');
	$pdf->cell(40, 10, 'Amount :', 0, 0, 'L');
	$pdf->SetFont('arial', '', '12');
	$pdf->cell(5, 10, $row['amount'], 0, 1, 'L');

		$pdf->SetFont('arial', 'b', '11');
	$pdf->cell(40, 10, 'Payment Code:', 0, 0, 'L');
	$pdf->SetFont('arial', '', '11');
	$pdf->cell(5, 10, $row['mpesa_code'], 0, 1, 'L');

	$pdf->SetFont('arial', 'b', '11');
	$pdf->cell(40, 10, 'Life duration :', 0, 0, 'L');
	$pdf->SetFont('arial', '', '12');
	$pdf->cell(5, 10, $row['life_duration'], 0, 1, 'L');

   
	// Page footer
	$pdf->setTextColor(0, 0, 0);
	// Position at 1.5 cm from bottom
	$pdf->SetY(-33);
	// Arial italic 11
	$pdf->SetFont('Arial', 'I', 11);
	// Page number
	$pdf->Cell(0, 10, 'Page ' . $pdf->PageNo() . ' / {nb}', 0, 1, 'C');


	$pdf->Output(rand(0001, 9999) . 'pdf_invoice.pdf', 'D');

?>

