
<?php
session_start();

include "mpdf/mpdf.php";

function selectTable()
{

	include "db_connect.php";
	//check error
	$current_user_id = $_SESSION['user-id'];
	$sql = "SELECT * FROM documents WHERE userid='$current_user_id'";
	$res = mysqli_query($conn, $sql);

	$table = "";

	$table .= "<table>
             <tr>
			 
		    </tr>          
        ";

	if (mysqli_num_rows($res) > 0) {

		while ($row = $res->fetch_assoc()) {
			$table .= "
					 <tr>
					 
						 <td style='width:10px,height:200px,color:green'>" . $row['name'] . "</td><br>
						 <td><img src='uploads /" . $row['image_url'] . "' style='width:700px,height:600px'></td> 
						   
					 </tr>
				 ";
		}
	}

	$table .= "</table>";

	return $table;
}
//echo "$id";
$html = selectTable();
$mpdf = new mPDF('c');
$mpdf->Addpage('L'); //add a new page
//$mpdf->writeHTML

$mpdf->WriteHTML($html, 2);
$mpdf->Output(rand(0001, 9999) . 'my_document.pdf', 'D');
exit;

?>
