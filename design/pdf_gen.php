<?php
require_once "../fpdf/fpdf.php";
require_once "../connection.php";

session_start();

$current_user_id =$_SESSION['user-id'];

$query = "SELECT * FROM tbl_cv WHERE userid='$current_user_id'";

$data = mysqli_query($conn , $query) or die(mysqli_error($conn));

$row = mysqli_fetch_assoc($data);

                                                      //DESIGN ONE

if(isset($_POST['pdf']))
{
	$pdf = new FPDF('p','mm','a4');
	$pdf->AliasNbPages();
	$pdf->SetFont('arial','B','25');
	
	$pdf->AddPage();
	//$pdf->Image('logo.png',10,6,25);
	$pdf->Cell(1);
	$pdf->setTextColor(2,100,90);
	$pdf->Cell(180,10,'CURRICULUM VITAE ',0,1,'C');
	$pdf->SetFont('arial','B','14');
	$pdf->cell(135,10,$row['firstname'],0,0,'C');
	$pdf->cell(-80,10,$row['middlename'],0,0,'C');
	$pdf->cell(140,10,$row['lastname'],0,1,'C');
	
	$pdf->SetFont('arial','b','14');
	$pdf->cell(132,10,'',0,0,'C');
    $pdf->SetFont('arial','','12');
	$pdf->cell(-92,10,$row['address1'],0,1,'C');
	
	$pdf->SetFont('arial','b','12');
	$pdf->cell(58,10,'',0,0,'C');
	$pdf->cell(15,10,'Email :',0,0,'L');
    $pdf->SetFont('arial','','12');
	$pdf->cell(10,10,$row['email'],0,1,'L');
	
	$pdf->SetFont('arial','b','12');
	$pdf->cell(133,10,'Phone :',0,0,'C');
    $pdf->SetFont('arial','','12');
	$pdf->cell(-90,10,$row['phone1'],0,1,'C');
	
	$pdf->SetFont('arial','b','12');
	$pdf->cell(133,10,'',0,0,'C');
    $pdf->SetFont('arial','','12');
	$pdf->cell(-90,10,$row['phone2'],0,1,'C');
	
	$pdf->SetFont('arial','','12');
	$pdf->cell(30,10,'',0,0,'C');
	$pdf->SetFont('arial','B','15');
	$pdf->cell(130,10,'************************************************************************************',0,1,'C');
	
	$pdf->SetFont('arial','B','15');
	$pdf->cell(60,10,'PERSONAL DETAILS',0,1,'L');
	
	$pdf->SetFont('arial','b','11');
	$pdf->cell(20,10,'Id No :',0,0,'L');
    $pdf->SetFont('arial','','11');
	$pdf->cell(-10,10,$row['idno'],0,1,'L');
	
	$pdf->SetFont('arial','b','11');
	$pdf->cell(20,10,'Y.O.B :',0,0,'L');
    $pdf->SetFont('arial','','12');
	$pdf->cell(-10,10,$row['yob'],0,1,'L');
	
	$pdf->SetFont('arial','b','11');
	$pdf->cell(20,10,'Gender :',0,0,'L');
    $pdf->SetFont('arial','','11');
	$pdf->cell(-10,10,$row['gender'],0,1,'L');
	
	$pdf->SetFont('arial','b','11');
	$pdf->cell(20,10,'Address :',0,0,'L');
    $pdf->SetFont('arial','','12');
	$pdf->cell(-15,10,$row['address2'],0,1,'L');
	
	$pdf->SetFont('arial','B','15');
	$pdf->cell(60,10,'PERSONAL PROFILE ',0,1,'L');
	
	$pdf->SetFont('arial','','11');
	$pdf->SetX(10);
	$pdf->MultiCell(150,10,$row['personalprofile'],0,'L',false);
	
	$pdf->SetFont('arial','B','15');
	$pdf->cell(60,10,'CAREER OBJECTIVES',0,1,'L');
	
	$pdf->SetFont('arial','','11');
	$pdf->SetX(10);
	$pdf->MultiCell(150,10,$row['careerobjectives'],0,'L',false);
	
	// Page footer
	$pdf->setTextColor(0,0,0);
	// Position at 1.5 cm from bottom
	$pdf->SetY(-33);
	// Arial italic 11
	$pdf->SetFont('Arial','I',11);
	// Page number
	$pdf->Cell(0,10,'Page '.$pdf->PageNo().' / {nb}',0,1,'C');
	
	$pdf->setTextColor(2,100,90);
	$pdf->SetFont('arial','B','15');
	$pdf->cell(60,15,'EDUCATION BACKGROUND ',0,1,'L');
	
	
	$pdf->SetFont('arial','b','11');
	$pdf->cell(30,10,'Year From :',0,0,'L');
	
	$pdf->SetFont('arial','b','11');
	$pdf->cell(30,10,'Year To :',0,0,'L');
	
	$pdf->SetFont('arial','b','11');
	$pdf->cell(60,10,'Institution :',0,0,'L');
	
	$pdf->SetFont('arial','b','11');
	$pdf->cell(60,10,'Achievement :',0,1,'L');
	
	$con=new PDO("mysql:host=localhost;dbname=cv+","root","");
	
	$query = "SELECT * FROM education WHERE userid='$current_user_id' ORDER BY id DESC ";

    $data = $con->prepare($query);
	
	$data->execute();
	
	if($data ->rowCount()!=0)
	{
		while($row =$data->fetch())
		{
		
		$pdf->SetFont('arial','','11');
		$pdf->cell(30,10,$row['yearfrom'],0,0,'L');
		 
		
		$pdf->SetFont('arial','','11');
		$pdf->cell(30,10,$row['yearto'],0,0,'L');

		
		$pdf->SetFont('arial','','11');
		$pdf->cell(60,10,$row['educationlevel'],0,0,'L');
		
		
		$pdf->SetFont('arial','','11');
		$pdf->cell(60,10,$row['achievement'],0,1,'L');
			
		}
	}
	else
	{
		echo "No Record Found";
	}
    

	$pdf->SetFont('arial','B','15');
	$pdf->cell(60,10,'JOB EXPERIENCE ',0,1,'L');
	
	
	$pdf->SetFont('arial','b','11');
	$pdf->cell(30,10,'Year From :',0,0,'L');
	
	$pdf->SetFont('arial','b','11');
	$pdf->cell(30,10,'Year To :',0,0,'L');
	
	$pdf->SetFont('arial','b','11');
	$pdf->cell(60,10,'Job Title:',0,0,'L');
	
	$pdf->SetFont('arial','b','11');
	$pdf->cell(60,10,'Responsibility :',0,1,'L');
	
	$con=new PDO("mysql:host=localhost;dbname=cv+","root","");
	
	$query = "SELECT * FROM jobexperience WHERE userid='$current_user_id' ORDER BY id DESC";

    $data = $con->prepare($query);
	
	$data->execute();
	
	if($data ->rowCount()!=0)
	{
		while($row =$data->fetch())
		{
		
		$pdf->SetFont('arial','','11');
		$pdf->cell(30,10,$row['yearfrom'],0,0,'L');
		 
		
		$pdf->SetFont('arial','','11');
		$pdf->cell(30,10,$row['yearto'],0,0,'L');

		
		$pdf->SetFont('arial','','11');
		$pdf->cell(60,10,$row['jobtitle'],0,0,'L');
		
		
		$pdf->SetFont('arial','','11');
		$pdf->cell(60,10,$row['responsibility'],0,1,'L');
			
		}
	}
	else
	{
		echo "No Record Found";
	}
    
	
	$pdf->SetFont('arial','B','15');
	$pdf->cell(60,10,'MY SKILLS ',0,1,'L');
	
	
	$pdf->SetFont('arial','b','11');
	$pdf->cell(60,10,'Name :',0,0,'L');
	
	$pdf->SetFont('arial','b','11');
	$pdf->cell(60,10,'Experience :',0,1,'L');
	
	
	$con=new PDO("mysql:host=localhost;dbname=cv+","root","");
	
	$query = "SELECT * FROM skills WHERE userid='$current_user_id' ";

    $data = $con->prepare($query);
	
	$data->execute();
	
	if($data ->rowCount()!=0)
	{
		while($row =$data->fetch())
		{
			
		$pdf->SetFont('arial','','11');
		$pdf->cell(60,10,$row['name'],0,0,'L');
		
		
		$pdf->SetFont('arial','','11');
		$pdf->cell(60,10,$row['experience'],0,1,'L');
			
		}
	}
	else
	{
		echo "No Record Found";
	}
    
	// Page footer
	$pdf->setTextColor(0,0,0);
	// Position at 1.5 cm from bottom
	$pdf->SetY(-33);
	// Arial italic 11
	$pdf->SetFont('Arial','I',11);
	// Page number
	$pdf->Cell(0,10,'Page '.$pdf->PageNo().' / {nb}',0,1,'C');
	
	$pdf->setTextColor(2,100,90);
	
	$pdf->SetFont('arial','B','15');
	$pdf->cell(60,10,'HOBBIES ',0,1,'L');
	
	$pdf->SetFont('arial','b','11');
	$pdf->cell(60,0,'',0,1,'L');
	
	$con=new PDO("mysql:host=localhost;dbname=cv+","root","");
	
	$query = "SELECT * FROM hobbies WHERE userid='$current_user_id' ";

    $data = $con->prepare($query);
	
	$data->execute();
	
	if($data ->rowCount()!=0)
	{
		while($row =$data->fetch())
		{
		
		$pdf->SetFont('arial','','11');
		$pdf->cell(60,10,$row['name'],0,1,'L');
		 
		}
	}
	else
	{
		echo "No Record Found";
	}
    
	
	$pdf->SetFont('arial','B','15');
	$pdf->cell(60,10,'REFEREES',0,1,'L');
	
	
	$pdf->SetFont('arial','b','11');
	$pdf->cell(60,10,'Name :',0,0,'L');
	
	$pdf->SetFont('arial','b','11');
	$pdf->cell(60,10,'Phone Number :',0,0,'L');
	
	$pdf->SetFont('arial','b','11');
	$pdf->cell(60,10,'Position :',0,1,'L');
	
	$con=new PDO("mysql:host=localhost;dbname=cv+","root","");
	
	$query = "SELECT * FROM referee WHERE userid='$current_user_id' ";

    $data = $con->prepare($query);
	
	$data->execute();
	
	if($data ->rowCount()!=0)
	{
		while($row =$data->fetch())
		{
		
		$pdf->SetFont('arial','','11');
		$pdf->cell(60,10,$row['name'],0,0,'L');
		 
		
		$pdf->SetFont('arial','','11');
		$pdf->cell(60,10,$row['phoneno'],0,0,'L');

		
		$pdf->SetFont('arial','','11');
		$pdf->cell(60,10,$row['position'],0,1,'L');	
		}
	}
	else
	{
		echo "No Record Found";
	}
    
	// Page footer
	$pdf->setTextColor(0,0,0);
	// Position at 1.5 cm from bottom
	$pdf->SetY(-33);
	// Arial italic 11
	$pdf->SetFont('Arial','I',11);
	// Page number
	$pdf->Cell(0,10,'Page '.$pdf->PageNo().' / {nb}',0,1,'C');
	
	
	
	$pdf->Output(rand(0001,9999).'document.pdf','D');
}



                                                       //DESIGN TWO

if(isset($_POST['pdf2']))
{
	$pdf = new FPDF('p','mm','a4');
	$pdf->AliasNbPages();
	$pdf->SetFont('arial','B','25');
	
	$pdf->AddPage();
	//$pdf->Image('logo.png',10,6,25);
	$pdf->Cell(1);
	$pdf->setTextColor(30,10,70);
	$pdf->Cell(180,10,'CURRICULUM VITAE ',0,1,'C');
	$pdf->SetFont('arial','B','14');
	$pdf->cell(135,10,$row['firstname'],0,0,'C');
	$pdf->cell(-80,10,$row['middlename'],0,0,'C');
	$pdf->cell(140,10,$row['lastname'],0,1,'C');
	
	$pdf->SetFont('arial','b','14');
	$pdf->cell(58,10,'',0,0,'L');
    $pdf->SetFont('arial','','12');
	$pdf->cell(5,10,$row['address1'],0,1,'L');
	
	$pdf->SetFont('arial','b','12');
	$pdf->cell(58,10,'',0,0,'C');
	$pdf->cell(15,10,'Email :',0,0,'L');
    $pdf->SetFont('arial','','12');
	$pdf->cell(10,10,$row['email'],0,1,'L');
	
	$pdf->SetFont('arial','b','12');
	$pdf->cell(133,10,'Phone :',0,0,'C');
    $pdf->SetFont('arial','','12');
	$pdf->cell(-90,10,$row['phone1'],0,1,'C');
	
	$pdf->SetFont('arial','b','12');
	$pdf->cell(133,10,'',0,0,'C');
    $pdf->SetFont('arial','','12');
	$pdf->cell(-90,10,$row['phone2'],0,1,'C');
	
	$pdf->SetFont('arial','','12');
	$pdf->cell(30,10,'',0,0,'C');
	$pdf->SetFont('arial','B','15');
	$pdf->cell(130,10,'************************************************************************************',0,1,'C');
	
	$pdf->SetFont('arial','B','15');
	$pdf->cell(60,10,'PERSONAL DETAILS',0,1,'L');
	
	$pdf->SetFont('arial','b','11');
	$pdf->cell(20,10,'Id No :',0,0,'L');
    $pdf->SetFont('arial','','11');
	$pdf->cell(-10,10,$row['idno'],0,1,'L');
	
	$pdf->SetFont('arial','b','11');
	$pdf->cell(20,10,'Y.O.B :',0,0,'L');
    $pdf->SetFont('arial','','12');
	$pdf->cell(-10,10,$row['yob'],0,1,'L');
	
	$pdf->SetFont('arial','b','11');
	$pdf->cell(20,10,'Gender :',0,0,'L');
    $pdf->SetFont('arial','','11');
	$pdf->cell(-10,10,$row['gender'],0,1,'L');
	
	$pdf->SetFont('arial','b','11');
	$pdf->cell(20,10,'Address :',0,0,'L');
    $pdf->SetFont('arial','','12');
	$pdf->cell(-15,10,$row['address2'],0,1,'L');
	
	$pdf->SetFont('arial','B','15');
	$pdf->cell(60,10,'PERSONAL PROFILE ',0,1,'L');
	
	$pdf->SetFont('arial','','11');
	$pdf->SetX(10);
	$pdf->MultiCell(150,10,$row['personalprofile'],0,'L',false);
	
	$pdf->SetFont('arial','B','15');
	$pdf->cell(60,10,'CAREER OBJECTIVES',0,1,'L');
	
	$pdf->SetFont('arial','','11');
	$pdf->SetX(10);
	$pdf->MultiCell(150,10,$row['careerobjectives'],0,'L',false);
	
	// Page footer
	$pdf->setTextColor(0,0,0);
	// Position at 1.5 cm from bottom
	$pdf->SetY(-33);
	// Arial italic 11
	$pdf->SetFont('Arial','I',11);
	// Page number
	$pdf->Cell(0,10,'Page '.$pdf->PageNo().' / {nb}',0,1,'C');
	
	                               //EDUCATION BACKGROUND
	$pdf->setTextColor(30,10,70);
	$pdf->SetFont('arial','B','15');
	$pdf->cell(60,15,'EDUCATION BACKGROUND ',0,1,'L');
	
	$con=new PDO("mysql:host=localhost;dbname=cv+","root","");
	
	$query = "SELECT * FROM education WHERE userid='$current_user_id' ORDER BY id DESC ";

    $data = $con->prepare($query);
	
	$data->execute();
	
	if($data ->rowCount()!=0)
	{
		while($row =$data->fetch())
		{
		
		$pdf->SetFont('arial','b','11');
		$pdf->cell(10,10,'',0,0,'L');
		$pdf->SetFont('arial','','11');
		$pdf->cell(20,10,$row['yearfrom'],0,0,'L');
		 
		
	    $pdf->SetFont('arial','b','11');
	    $pdf->cell(10,10,'-',0,0,'L');
		$pdf->SetFont('arial','','11');
		$pdf->cell(10,10,$row['yearto'],0,0,'L');

		$pdf->SetFont('arial','b','11');
	    $pdf->cell(10,10,'',0,0,'L');
		$pdf->SetFont('arial','','11');
		$pdf->cell(60,10,$row['educationlevel'],0,1,'L');
		
		$pdf->SetFont('arial','b','11');
		$pdf->cell(60);
        $pdf->cell(30,10,'Achievement :',0,0,'c');
		$pdf->SetFont('arial','','11');
		$pdf->cell(60,10,$row['achievement'],0,1,'L');
			
		}
	}
	else
	{
		echo "No Record Found";
	}
    
                                             //JOB EXPERIENCE
	$pdf->SetFont('arial','B','15');
	$pdf->cell(60,10,'JOB EXPERIENCE ',0,1,'L');
	
	
	$con=new PDO("mysql:host=localhost;dbname=cv+","root","");
	
	$query = "SELECT * FROM jobexperience WHERE userid='$current_user_id' ORDER BY id DESC ";

    $data = $con->prepare($query);
	
	$data->execute();
	
	if($data ->rowCount()!=0)
	{
		while($row =$data->fetch())
		{
		
		$pdf->SetFont('arial','b','11');
		$pdf->cell(10,10,'',0,0,'L');
		$pdf->SetFont('arial','','11');
		$pdf->cell(20,10,$row['yearfrom'],0,0,'L');
		 
		
	    $pdf->SetFont('arial','b','11');
	    $pdf->cell(10,10,'-',0,0,'L');
		$pdf->SetFont('arial','','11');
		$pdf->cell(10,10,$row['yearto'],0,0,'L');

		$pdf->SetFont('arial','b','11');
	    $pdf->cell(10,10,'',0,0,'L');
		$pdf->SetFont('arial','','11');
		$pdf->cell(60,10,$row['jobtitle'],0,1,'L');
		
		$pdf->SetFont('arial','b','11');
		$pdf->cell(60);
        $pdf->cell(30,10,'Responsibility :',0,0,'c');
		$pdf->SetFont('arial','','11');
		$pdf->cell(60,10,$row['responsibility'],0,1,'L');
		 
		}
	}
	else
	{
		echo "No Record Found";
	}
    
	                                            //MY SKILLS
	$pdf->SetFont('arial','B','15');
	$pdf->cell(60,10,'MY SKILLS ',0,1,'L');
	
	
	$pdf->SetFont('arial','b','11');
	$pdf->cell(60,10,'',0,0,'L');
	
	$pdf->SetFont('arial','b','11');
	$pdf->cell(60,10,'Experience :',0,1,'L');
	
	
	$con=new PDO("mysql:host=localhost;dbname=cv+","root","");
	
	$query = "SELECT * FROM skills WHERE userid='$current_user_id' ORDER BY id DESC ";

    $data = $con->prepare($query);
	
	$data->execute();
	
	if($data ->rowCount()!=0)
	{
		while($row =$data->fetch())
		{
			
		$pdf->SetFont('arial','','11');
		$pdf->cell(60,10,$row['name'],0,0,'L');
		
		
		$pdf->SetFont('arial','','11');
		$pdf->cell(60,10,$row['experience'],0,1,'L');
			
		}
	}
	else
	{
		echo "No Record Found";
	}
    
	// Page footer
	$pdf->setTextColor(0,0,0);
	// Position at 1.5 cm from bottom
	$pdf->SetY(-33);
	// Arial italic 11
	$pdf->SetFont('Arial','I',11);
	// Page number
	$pdf->Cell(0,10,'Page '.$pdf->PageNo().' / {nb}',0,1,'C');
	
	$pdf->setTextColor(30,10,70);
	
	$pdf->SetFont('arial','B','15');
	$pdf->cell(60,10,'HOBBIES ',0,1,'L');
	
	$pdf->SetFont('arial','b','11');
	$pdf->cell(60,0,'',0,1,'L');
	
	$con=new PDO("mysql:host=localhost;dbname=cv+","root","");
	
	$query = "SELECT * FROM hobbies WHERE userid='$current_user_id' ";

    $data = $con->prepare($query);
	
	$data->execute();
	
	if($data ->rowCount()!=0)
	{
		while($row =$data->fetch())
		{
		
		$pdf->SetFont('arial','','11');
		$pdf->cell(60,10,$row['name'],0,1,'L');
		 
		}
	}
	else
	{
		echo "No Record Found";
	}
    
	                                           //REFEREES
	$pdf->SetFont('arial','B','15');
	$pdf->cell(60,10,'REFEREES',0,1,'L');
		
	$con=new PDO("mysql:host=localhost;dbname=cv+","root","");
	
	$query = "SELECT * FROM referee WHERE userid='$current_user_id' ";

    $data = $con->prepare($query);
	
	$data->execute();
	
	if($data ->rowCount()!=0)
	{
		while($row =$data->fetch())
		{
		$pdf->SetFont('arial','b','11');
	    $pdf->cell(10,10,'',0,0,'L');
		$pdf->SetFont('arial','','11');
		$pdf->cell(60,10,$row['name'],0,1,'L');
		 
		$pdf->SetFont('arial','b','11');
	    $pdf->cell(10,10,'',0,0,'L');
		$pdf->SetFont('arial','','11');
		$pdf->cell(60,10,$row['phoneno'],0,1,'L');
       
        $pdf->SetFont('arial','b','11');
	    $pdf->cell(10,10,'',0,0,'L');
		$pdf->SetFont('arial','','11');
		$pdf->cell(60,10,$row['position'],0,1,'L');
		$pdf->cell(10,10,'',0,1,'L');
		}
	}
	else
	{
		echo "No Record Found";
	}
    
	// Page footer
	$pdf->setTextColor(0,0,0);
	// Position at 1.5 cm from bottom
	$pdf->SetY(-33);
	// Arial italic 11
	$pdf->SetFont('Arial','I',11);
	// Page number
	$pdf->Cell(0,10,'Page '.$pdf->PageNo().' / {nb}',0,1,'C');
	
	
   
	$pdf->Output(rand(0001,9999).'document.pdf','I');
}



                                                        //DESIGN THREE

if(isset($_POST['pdf3']))
{
	
	$pdf = new FPDF('p','mm','a4');
	$pdf->AliasNbPages();
	$pdf->SetFont('arial','B','20');
	
	$pdf->AddPage();
	//$pdf->Image('logo.png',10,6,25);
	$pdf->Cell(1);
	$pdf->setTextColor(30,24,10);
	$pdf->Cell(180,10,'CURRICULUM VITAE ',0,1,'C');
	$pdf->SetFont('arial','B','14');
	$pdf->cell(135,10,$row['firstname'],0,0,'C');
	$pdf->cell(-80,10,$row['middlename'],0,0,'C');
	$pdf->cell(140,10,$row['lastname'],0,1,'C');
	
	
	$pdf->SetFont('arial','','12');
	$pdf->cell(30,10,'',0,0,'C');
	$pdf->SetFont('arial','B','15');
	$pdf->cell(130,10,'************************************************************************************',0,1,'C');
	
	$pdf->SetFont('arial','B','15');
	$pdf->cell(60,10,'PERSONAL DETAILS',0,1,'L');
	
	$pdf->SetFont('arial','b','11');
	$pdf->cell(60,10,'Id No :',0,0,'L');
    $pdf->SetFont('arial','','11');
	$pdf->cell(-60,10,$row['idno'],0,1,'C');
	
	$pdf->SetFont('arial','b','11');
	$pdf->cell(20,10,'Email :',0,0,'L');
    $pdf->SetFont('arial','','11');
	$pdf->cell(-120,10,$row['email'],0,1,'L');
	
	$pdf->SetFont('arial','b','11');
	$pdf->cell(20,10,'Y.O.B :',0,0,'L');
    $pdf->SetFont('arial','','12');
	$pdf->cell(10,10,$row['yob'],0,1,'C');
	
	$pdf->SetFont('arial','b','11');
	$pdf->cell(40,10,'Gender :',0,0,'L');
    $pdf->SetFont('arial','','12');
	$pdf->cell(-25,10,$row['gender'],0,1,'C');
	
	$pdf->SetFont('arial','b','11');
	$pdf->cell(60,10,'Phone :',0,0,'L');
    $pdf->SetFont('arial','','12');
	$pdf->cell(-60,10,$row['phone1'],0,1,'C');
	
	$pdf->SetFont('arial','b','11');
	$pdf->cell(60,10,'',0,0,'C');
    $pdf->SetFont('arial','','12');
	$pdf->cell(-60,10,$row['phone2'],0,1,'C');
	
	$pdf->SetFont('arial','b','11');
	$pdf->cell(25,10,'Address :',0,0,'L');
    $pdf->SetFont('arial','','12');
	$pdf->cell(-125,10,$row['address1'],0,1,'L');
	
	$pdf->SetFont('arial','b','11');
	$pdf->cell(25,10,'',0,0,'L');
    $pdf->SetFont('arial','','12');
	$pdf->cell(-125,10,$row['address2'],0,1,'L');
	
	$pdf->SetFont('arial','B','15');
	$pdf->cell(60,10,'PERSONAL PROFILE ',0,1,'L');
	
	$pdf->SetFont('arial','','11');
	$pdf->SetX(10);
	$pdf->MultiCell(150,10,$row['personalprofile'],0,'L',false);
	
	$pdf->SetFont('arial','B','15');
	$pdf->cell(60,10,'CAREER OBJECTIVES',0,1,'L');
	
	$pdf->SetFont('arial','','11');
	$pdf->SetX(10);
	$pdf->MultiCell(150,10,$row['careerobjectives'],0,'L',false);
	
	// Page footer
	$pdf->setTextColor(0,0,0);
	// Position at 1.5 cm from bottom
	$pdf->SetY(-33);
	// Arial italic 11
	$pdf->SetFont('Arial','I',11);
	// Page number
	$pdf->Cell(0,10,'Page '.$pdf->PageNo().' / {nb}',0,1,'C');
	
	                               //EDUCATION BACKGROUND
	$pdf->setTextColor(30,24,10);
	$pdf->SetFont('arial','B','15');
	$pdf->cell(60,15,'EDUCATION BACKGROUND ',0,1,'L');
	
	$con=new PDO("mysql:host=localhost;dbname=cv+","root","");
	
	$query = "SELECT * FROM education WHERE userid='$current_user_id' ORDER BY id DESC ";

    $data = $con->prepare($query);
	
	$data->execute();
	
	if($data ->rowCount()!=0)
	{
		while($row =$data->fetch())
		{
		
		$pdf->SetFont('arial','b','11');
		$pdf->cell(10,10,'',0,0,'L');
		$pdf->SetFont('arial','','11');
		$pdf->cell(20,10,$row['yearfrom'],0,0,'L');
		 
		
	    $pdf->SetFont('arial','b','11');
	    $pdf->cell(10,10,'-',0,0,'L');
		$pdf->SetFont('arial','','11');
		$pdf->cell(10,10,$row['yearto'],0,0,'L');

		$pdf->SetFont('arial','b','11');
	    $pdf->cell(10,10,'',0,0,'L');
		$pdf->SetFont('arial','','11');
		$pdf->cell(60,10,$row['educationlevel'],0,1,'L');
		
		$pdf->SetFont('arial','b','11');
		$pdf->cell(60);
        $pdf->cell(30,10,'Achievement :',0,0,'c');
		$pdf->SetFont('arial','','11');
		$pdf->cell(60,10,$row['achievement'],0,1,'L');
			
		}
	}
	else
	{
		echo "No Record Found";
	}
    
                                             //JOB EXPERIENCE
	$pdf->SetFont('arial','B','15');
	$pdf->cell(60,10,'JOB EXPERIENCE ',0,1,'L');
	
	
	$con=new PDO("mysql:host=localhost;dbname=cv+","root","");
	
	$query = "SELECT * FROM jobexperience WHERE userid='$current_user_id' ORDER BY id DESC ";

    $data = $con->prepare($query);
	
	$data->execute();
	
	if($data ->rowCount()!=0)
	{
		while($row =$data->fetch())
		{
		
		$pdf->SetFont('arial','b','11');
		$pdf->cell(10,10,'',0,0,'L');
		$pdf->SetFont('arial','','11');
		$pdf->cell(20,10,$row['yearfrom'],0,0,'L');
		 
		
	    $pdf->SetFont('arial','b','11');
	    $pdf->cell(10,10,'-',0,0,'L');
		$pdf->SetFont('arial','','11');
		$pdf->cell(10,10,$row['yearto'],0,0,'L');

		$pdf->SetFont('arial','b','11');
	    $pdf->cell(10,10,'',0,0,'L');
		$pdf->SetFont('arial','','11');
		$pdf->cell(60,10,$row['jobtitle'],0,1,'L');
		
		$pdf->SetFont('arial','b','11');
		$pdf->cell(60);
        $pdf->cell(30,10,'Responsibility :',0,0,'c');
		$pdf->SetFont('arial','','11');
		$pdf->cell(60,10,$row['responsibility'],0,1,'L');
		 
		}
	}
	else
	{
		echo "No Record Found";
	}
    
	                                            //MY SKILLS
	$pdf->SetFont('arial','B','15');
	$pdf->cell(60,10,'MY SKILLS ',0,1,'L');
	
	
	$pdf->SetFont('arial','b','11');
	$pdf->cell(60,10,'',0,0,'L');
	
	$pdf->SetFont('arial','b','11');
	$pdf->cell(60,10,'Experience :',0,1,'L');
	
	
	$con=new PDO("mysql:host=localhost;dbname=cv+","root","");
	
	$query = "SELECT * FROM skills WHERE userid='$current_user_id' ORDER BY id DESC ";

    $data = $con->prepare($query);
	
	$data->execute();
	
	if($data ->rowCount()!=0)
	{
		while($row =$data->fetch())
		{
			
		$pdf->SetFont('arial','','11');
		$pdf->cell(60,10,$row['name'],0,0,'L');
		
		
		$pdf->SetFont('arial','','11');
		$pdf->cell(60,10,$row['experience'],0,1,'L');
			
		}
	}
	else
	{
		echo "No Record Found";
	}
    
	// Page footer
	$pdf->setTextColor(0,0,0);
	// Position at 1.5 cm from bottom
	$pdf->SetY(-33);
	// Arial italic 11
	$pdf->SetFont('Arial','I',11);
	// Page number
	$pdf->Cell(0,10,'Page '.$pdf->PageNo().' / {nb}',0,1,'C');
	
	$pdf->setTextColor(30,24,10);
	
	$pdf->SetFont('arial','B','15');
	$pdf->cell(60,10,'HOBBIES ',0,1,'L');
	
	$pdf->SetFont('arial','b','11');
	$pdf->cell(60,0,'',0,1,'L');
	
	$con=new PDO("mysql:host=localhost;dbname=cv+","root","");
	
	$query = "SELECT * FROM hobbies WHERE userid='$current_user_id' ";

    $data = $con->prepare($query);
	
	$data->execute();
	
	if($data ->rowCount()!=0)
	{
		while($row =$data->fetch())
		{
		
		$pdf->SetFont('arial','','11');
		$pdf->cell(60,10,$row['name'],0,1,'L');
		 
		}
	}
	else
	{
		echo "No Record Found";
	}
    
	                                           //REFEREES
	$pdf->SetFont('arial','B','15');
	$pdf->cell(60,10,'REFEREES',0,1,'L');
		
	$con=new PDO("mysql:host=localhost;dbname=cv+","root","");
	
	$query = "SELECT * FROM referee WHERE userid='$current_user_id' ";

    $data = $con->prepare($query);
	
	$data->execute();
	
	if($data ->rowCount()!=0)
	{
		while($row =$data->fetch())
		{
		$pdf->SetFont('arial','b','11');
	    $pdf->cell(10,10,'',0,0,'L');
		$pdf->SetFont('arial','','11');
		$pdf->cell(60,10,$row['name'],0,1,'L');
		 
		$pdf->SetFont('arial','b','11');
	    $pdf->cell(10,10,'',0,0,'L');
		$pdf->SetFont('arial','','11');
		$pdf->cell(60,10,$row['phoneno'],0,1,'L');
       
        $pdf->SetFont('arial','b','11');
	    $pdf->cell(10,10,'',0,0,'L');
		$pdf->SetFont('arial','','11');
		$pdf->cell(60,10,$row['position'],0,1,'L');
		$pdf->cell(10,10,'',0,1,'L');
		}
	}
	else
	{
		echo "No Record Found";
	}
    
	// Page footer
	$pdf->setTextColor(0,0,0);
	// Position at 1.5 cm from bottom
	$pdf->SetY(-33);
	// Arial italic 11
	$pdf->SetFont('Arial','I',11);
	// Page number
	$pdf->Cell(0,10,'Page '.$pdf->PageNo().' / {nb}',0,1,'C');
	
	
   
	$pdf->Output(rand(0001,9999).'document.pdf','D');
}

                                                       //DESIGN FOUR

if(isset($_POST['pdf4']))
{
	$pdf = new FPDF('p','mm','a4');
	$pdf->AliasNbPages();
	$pdf->SetFont('arial','B','20');
	
	$pdf->AddPage();
	//$pdf->Image('logo.png',10,6,25);
	$pdf->Cell(1);
	$pdf->setTextColor(14,4,196);
	$pdf->Cell(180,10,'CURRICULUM VITAE ',0,1,'C');
	$pdf->SetFont('arial','B','14');
	$pdf->cell(135,10,$row['firstname'],0,0,'C');
	$pdf->cell(-80,10,$row['middlename'],0,0,'C');
	$pdf->cell(140,10,$row['lastname'],0,1,'C');
	
	
	$pdf->SetFont('arial','','12');
	$pdf->cell(30,10,'',0,0,'C');
	$pdf->SetFont('arial','B','15');
	$pdf->cell(130,10,'************************************************************************************',0,1,'C');
	
	$pdf->SetFont('arial','B','13');
	$pdf->cell(60,10,'PERSONAL PROFILE ',0,1,'L');
	
	$pdf->SetFont('arial','','11');
	$pdf->SetX(10);
	$pdf->MultiCell(150,10,$row['personalprofile'],0,'L',false);
	
	$pdf->SetFont('arial','B','13');
	$pdf->cell(60,10,'CAREER OBJECTIVES',0,1,'L');
	
	$pdf->SetFont('arial','','11');
	$pdf->SetX(10);
	$pdf->MultiCell(150,10,$row['careerobjectives'],0,'L',false);
	
	$pdf->SetFont('arial','B','13');
	$pdf->cell(60,10,'PERSONAL DETAILS',0,1,'L');
	
	$pdf->SetFont('arial','b','11');
	$pdf->cell(60,10,'Id No :',0,0,'L');
    $pdf->SetFont('arial','','11');
	$pdf->cell(-60,10,$row['idno'],0,1,'C');
	
	$pdf->SetFont('arial','b','11');
	$pdf->cell(20,10,'Email :',0,0,'L');
    $pdf->SetFont('arial','','11');
	$pdf->cell(-120,10,$row['email'],0,1,'L');
	
	$pdf->SetFont('arial','b','11');
	$pdf->cell(20,10,'Y.O.B :',0,0,'L');
    $pdf->SetFont('arial','','12');
	$pdf->cell(10,10,$row['yob'],0,1,'C');
	
	$pdf->SetFont('arial','b','11');
	$pdf->cell(40,10,'Gender :',0,0,'L');
    $pdf->SetFont('arial','','12');
	$pdf->cell(-25,10,$row['gender'],0,1,'C');
	
	$pdf->SetFont('arial','b','11');
	$pdf->cell(60,10,'Phone :',0,0,'L');
    $pdf->SetFont('arial','','12');
	$pdf->cell(-60,10,$row['phone1'],0,1,'C');
	
	$pdf->SetFont('arial','b','11');
	$pdf->cell(60,10,'',0,0,'C');
    $pdf->SetFont('arial','','12');
	$pdf->cell(-60,10,$row['phone2'],0,1,'C');
	
	$pdf->SetFont('arial','b','11');
	$pdf->cell(25,10,'Address :',0,0,'L');
    $pdf->SetFont('arial','','12');
	$pdf->cell(-125,10,$row['address1'],0,1,'L');
	
	$pdf->SetFont('arial','b','11');
	$pdf->cell(25,10,'',0,0,'L');
    $pdf->SetFont('arial','','12');
	$pdf->cell(-125,10,$row['address2'],0,1,'L');
	
	
	    
	// Page footer
	$pdf->setTextColor(0,0,0);
	// Position at 1.5 cm from bottom
	$pdf->SetY(-33);
	// Arial italic 11
	$pdf->SetFont('Arial','I',11);
	// Page number
	$pdf->Cell(0,10,'Page '.$pdf->PageNo().' / {nb}',0,1,'C');
	
	
	                               //EDUCATION BACKGROUND
	$pdf->setTextColor(14,4,196);
	$pdf->SetFont('arial','B','13');
	$pdf->cell(120,15,'EDUCATION BACKGROUND ',0,1,'L');
	
	$con=new PDO("mysql:host=localhost;dbname=cv+","root","");
	
	$query = "SELECT * FROM education WHERE userid='$current_user_id' ORDER BY id DESC ";

    $data = $con->prepare($query);
	
	$data->execute();
	
	if($data ->rowCount()!=0)
	{
		while($row =$data->fetch())
		{
		
		$pdf->SetFont('arial','b','11');
		$pdf->cell(10,10,'',0,0,'L');
		$pdf->SetFont('arial','','11');
		$pdf->cell(20,10,$row['yearfrom'],0,0,'L');
		 
		
	    $pdf->SetFont('arial','b','11');
	    $pdf->cell(10,10,'-',0,0,'L');
		$pdf->SetFont('arial','','11');
		$pdf->cell(10,10,$row['yearto'],0,0,'L');

		$pdf->SetFont('arial','b','11');
	    $pdf->cell(10,10,'',0,0,'L');
		$pdf->SetFont('arial','','11');
		$pdf->cell(60,10,$row['educationlevel'],0,1,'L');
		
		$pdf->SetFont('arial','b','11');
		$pdf->cell(60);
        $pdf->cell(30,10,'Achievement :',0,0,'c');
		$pdf->SetFont('arial','','11');
		$pdf->cell(60,10,$row['achievement'],0,1,'L');
			
		}
	}
	else
	{
		echo "No Record Found";
	}

                                             //JOB EXPERIENCE
	$pdf->setTextColor(14,4,196);
	$pdf->SetFont('arial','B','13');
	$pdf->cell(60,10,'JOB EXPERIENCE ',0,1,'L');
	
	
	$con=new PDO("mysql:host=localhost;dbname=cv+","root","");
	
	$query = "SELECT * FROM jobexperience WHERE userid='$current_user_id' ORDER BY id DESC ";

    $data = $con->prepare($query);
	
	$data->execute();
	
	if($data ->rowCount()!=0)
	{
		while($row =$data->fetch())
		{
		
		$pdf->SetFont('arial','b','11');
		$pdf->cell(10,10,'',0,0,'L');
		$pdf->SetFont('arial','','11');
		$pdf->cell(20,10,$row['yearfrom'],0,0,'L');
		 
		
	    $pdf->SetFont('arial','b','11');
	    $pdf->cell(10,10,'-',0,0,'L');
		$pdf->SetFont('arial','','11');
		$pdf->cell(10,10,$row['yearto'],0,0,'L');

		$pdf->SetFont('arial','b','11');
	    $pdf->cell(10,10,'',0,0,'L');
		$pdf->SetFont('arial','','11');
		$pdf->cell(60,10,$row['jobtitle'],0,1,'L');
		
		$pdf->SetFont('arial','b','11');
		$pdf->cell(60);
        $pdf->cell(30,10,'Responsibility :',0,0,'c');
		$pdf->SetFont('arial','','11');
		$pdf->cell(60,10,$row['responsibility'],0,1,'L');
		 
		}
	}
	else
	{
		echo "No Record Found";
	}
    
	                                            //MY SKILLS
	$pdf->SetFont('arial','B','13');
	$pdf->cell(60,10,'MY SKILLS ',0,1,'L');
	
	
	$pdf->SetFont('arial','b','11');
	$pdf->cell(60,10,'',0,0,'L');
	
	$pdf->SetFont('arial','b','11');
	$pdf->cell(60,10,'Experience :',0,1,'L');
	
	
	$con=new PDO("mysql:host=localhost;dbname=cv+","root","");
	
	$query = "SELECT * FROM skills WHERE userid='$current_user_id' ORDER BY id DESC ";

    $data = $con->prepare($query);
	
	$data->execute();
	
	if($data ->rowCount()!=0)
	{
		while($row =$data->fetch())
		{
			
		$pdf->SetFont('arial','','11');
		$pdf->cell(60,10,$row['name'],0,0,'L');
		
		
		$pdf->SetFont('arial','','11');
		$pdf->cell(60,10,$row['experience'],0,1,'L');
			
		}
	}
	else
	{
		echo "No Record Found";
	}
    
	// Page footer
	$pdf->setTextColor(0,0,0);
	// Position at 1.5 cm from bottom
	$pdf->SetY(-33);
	// Arial italic 11
	$pdf->SetFont('Arial','I',11);
	// Page number
	$pdf->Cell(0,10,'Page '.$pdf->PageNo().' / {nb}',0,1,'C');
	
	$pdf->setTextColor(14,4,196);
	
	$pdf->SetFont('arial','B','15');
	$pdf->cell(60,10,'HOBBIES ',0,1,'L');
	
	$pdf->SetFont('arial','b','11');
	$pdf->cell(60,0,'',0,1,'L');
	
	$con=new PDO("mysql:host=localhost;dbname=cv+","root","");
	
	$query = "SELECT * FROM hobbies WHERE userid='$current_user_id' ";

    $data = $con->prepare($query);
	
	$data->execute();
	
	if($data ->rowCount()!=0)
	{
		while($row =$data->fetch())
		{
		
		$pdf->SetFont('arial','','11');
		$pdf->cell(60,10,$row['name'],0,1,'L');
		 
		}
	}
	else
	{
		echo "No Record Found";
	}
    
	                                           //REFEREES
	$pdf->SetFont('arial','B','13');
	$pdf->cell(60,10,'REFEREES',0,1,'L');
		
	$con=new PDO("mysql:host=localhost;dbname=cv+","root","");
	
	$query = "SELECT * FROM referee WHERE userid='$current_user_id' ";

    $data = $con->prepare($query);
	
	$data->execute();
	
	if($data ->rowCount()!=0)
	{
		while($row =$data->fetch())
		{
		$pdf->SetFont('arial','b','11');
	    $pdf->cell(10,10,'',0,0,'L');
		$pdf->SetFont('arial','','11');
		$pdf->cell(60,10,$row['name'],0,1,'L');
		 
		$pdf->SetFont('arial','b','11');
	    $pdf->cell(10,10,'',0,0,'L');
		$pdf->SetFont('arial','','11');
		$pdf->cell(60,10,$row['phoneno'],0,1,'L');
       
        $pdf->SetFont('arial','b','11');
	    $pdf->cell(10,10,'',0,0,'L');
		$pdf->SetFont('arial','','11');
		$pdf->cell(60,10,$row['position'],0,1,'L');
		$pdf->cell(10,10,'',0,1,'L');
		}
	}
	else
	{
		echo "No Record Found";
	}
    
	// Page footer
	$pdf->setTextColor(0,0,0);
	// Position at 1.5 cm from bottom
	$pdf->SetY(-33);
	// Arial italic 11
	$pdf->SetFont('Arial','I',11);
	// Page number
	$pdf->Cell(0,10,'Page '.$pdf->PageNo().' / {nb}',0,1,'C');
	
	
   
	$pdf->Output(rand(0001,9999).'document.pdf','D');
}


                                                       //DESIGN FIVE

if(isset($_POST['pdf5']))
{
	$pdf = new FPDF('p','mm','a4');
	$pdf->AliasNbPages();
	$pdf->SetFont('arial','B','24');
	
	$pdf->AddPage();
	//$pdf->Image('logo.png',10,6,25);
	$pdf->Cell(1);
	$pdf->setTextColor(80,160,50);
	$pdf->Cell(180,10,'CURRICULUM VITAE ',0,1,'C');
	$pdf->SetFont('arial','B','14');
	$pdf->cell(135,10,$row['firstname'],0,0,'C');
	$pdf->cell(-80,10,$row['middlename'],0,0,'C');
	$pdf->cell(140,10,$row['lastname'],0,1,'C');
	
	$pdf->SetFont('arial','b','14');
	$pdf->cell(58,10,'',0,0,'L');
    $pdf->SetFont('arial','','12');
	$pdf->cell(5,10,$row['address1'],0,1,'L');
	
	$pdf->SetFont('arial','b','12');
	$pdf->cell(58,10,'',0,0,'C');
	$pdf->cell(15,10,'Email :',0,0,'L');
    $pdf->SetFont('arial','','12');
	$pdf->cell(10,10,$row['email'],0,1,'L');
	
	$pdf->SetFont('arial','b','12');
	$pdf->cell(133,10,'Phone :',0,0,'C');
    $pdf->SetFont('arial','','12');
	$pdf->cell(-90,10,$row['phone1'],0,1,'C');
	
	$pdf->SetFont('arial','b','12');
	$pdf->cell(133,10,'',0,0,'C');
    $pdf->SetFont('arial','','12');
	$pdf->cell(-90,10,$row['phone2'],0,1,'C');
	
	$pdf->SetFont('arial','','12');
	$pdf->cell(30,10,'',0,0,'C');
	$pdf->SetFont('arial','B','15');
	$pdf->cell(130,10,'************************************************************************************',0,1,'C');
	
	$pdf->SetFont('arial','B','15');
	$pdf->cell(60,10,'PERSONAL PROFILE ',0,1,'L');
	
	$pdf->SetFont('arial','','11');
	$pdf->SetX(10);
	$pdf->MultiCell(150,10,$row['personalprofile'],0,'L',false);
	
	$pdf->SetFont('arial','B','15');
	$pdf->cell(60,10,'CAREER OBJECTIVES',0,1,'L');
	
	$pdf->SetFont('arial','','11');
	$pdf->SetX(10);
	$pdf->MultiCell(150,10,$row['careerobjectives'],0,'L',false);
	
	
	$pdf->SetFont('arial','B','15');
	$pdf->cell(60,10,'PERSONAL DETAILS',0,1,'L');
	
	$pdf->SetFont('arial','b','11');
	$pdf->cell(20,10,'Id No :',0,0,'L');
    $pdf->SetFont('arial','','11');
	$pdf->cell(-10,10,$row['idno'],0,1,'L');
	
	$pdf->SetFont('arial','b','11');
	$pdf->cell(20,10,'Y.O.B :',0,0,'L');
    $pdf->SetFont('arial','','12');
	$pdf->cell(-10,10,$row['yob'],0,1,'L');
	
	$pdf->SetFont('arial','b','11');
	$pdf->cell(20,10,'Gender :',0,0,'L');
    $pdf->SetFont('arial','','11');
	$pdf->cell(-10,10,$row['gender'],0,1,'L');
	
	$pdf->SetFont('arial','b','11');
	$pdf->cell(20,10,'Address :',0,0,'L');
    $pdf->SetFont('arial','','12');
	$pdf->cell(-15,10,$row['address2'],0,1,'L');
	
	
	// Page footer
	$pdf->setTextColor(0,0,0);
	// Position at 1.5 cm from bottom
	$pdf->SetY(-33);
	// Arial italic 11
	$pdf->SetFont('Arial','I',11);
	// Page number
	$pdf->Cell(0,10,'Page '.$pdf->PageNo().' / {nb}',0,1,'C');
	
	
	                               //EDUCATION BACKGROUND
	$pdf->setTextColor(80,160,50);
	$pdf->SetFont('arial','B','15');
	$pdf->cell(60,15,'EDUCATION BACKGROUND ',0,1,'L');
	
	$con=new PDO("mysql:host=localhost;dbname=cv+","root","");
	
	$query = "SELECT * FROM education WHERE userid='$current_user_id' ORDER BY id DESC ";

    $data = $con->prepare($query);
	
	$data->execute();
	
	if($data ->rowCount()!=0)
	{
		while($row =$data->fetch())
		{
		
		$pdf->SetFont('arial','b','11');
		$pdf->cell(10,10,'',0,0,'L');
		$pdf->SetFont('arial','','11');
		$pdf->cell(20,10,$row['yearfrom'],0,0,'L');
		 
		
	    $pdf->SetFont('arial','b','11');
	    $pdf->cell(10,10,'-',0,0,'L');
		$pdf->SetFont('arial','','11');
		$pdf->cell(10,10,$row['yearto'],0,0,'L');

		$pdf->SetFont('arial','b','11');
	    $pdf->cell(10,10,'',0,0,'L');
		$pdf->SetFont('arial','','11');
		$pdf->cell(60,10,$row['educationlevel'],0,1,'L');
		
		$pdf->SetFont('arial','b','11');
		$pdf->cell(60);
        $pdf->cell(30,10,'Achievement :',0,0,'c');
		$pdf->SetFont('arial','','11');
		$pdf->cell(60,10,$row['achievement'],0,1,'L');
			
		}
	}
	else
	{
		echo "No Record Found";
	}
    
                                             //JOB EXPERIENCE
	$pdf->SetFont('arial','B','15');
	$pdf->cell(60,10,'JOB EXPERIENCE ',0,1,'L');
	
	
	$con=new PDO("mysql:host=localhost;dbname=cv+","root","");
	
	$query = "SELECT * FROM jobexperience WHERE userid='$current_user_id' ORDER BY id DESC ";

    $data = $con->prepare($query);
	
	$data->execute();
	
	if($data ->rowCount()!=0)
	{
		while($row =$data->fetch())
		{
		
		$pdf->SetFont('arial','b','11');
		$pdf->cell(10,10,'',0,0,'L');
		$pdf->SetFont('arial','','11');
		$pdf->cell(20,10,$row['yearfrom'],0,0,'L');
		 
		
	    $pdf->SetFont('arial','b','11');
	    $pdf->cell(10,10,'-',0,0,'L');
		$pdf->SetFont('arial','','11');
		$pdf->cell(10,10,$row['yearto'],0,0,'L');

		$pdf->SetFont('arial','b','11');
	    $pdf->cell(10,10,'',0,0,'L');
		$pdf->SetFont('arial','','11');
		$pdf->cell(60,10,$row['jobtitle'],0,1,'L');
		
		$pdf->SetFont('arial','b','11');
		$pdf->cell(60);
        $pdf->cell(30,10,'Responsibility :',0,0,'c');
		$pdf->SetFont('arial','','11');
		$pdf->cell(60,10,$row['responsibility'],0,1,'L');
		 
		}
	}
	else
	{
		echo "No Record Found";
	}
    
	                                            //MY SKILLS
	$pdf->SetFont('arial','B','15');
	$pdf->cell(60,10,'MY SKILLS ',0,1,'L');
	
	
	$pdf->SetFont('arial','b','11');
	$pdf->cell(60,10,'',0,0,'L');
	
	$pdf->SetFont('arial','b','11');
	$pdf->cell(60,10,'Experience :',0,1,'L');
	
	
	$con=new PDO("mysql:host=localhost;dbname=cv+","root","");
	
	$query = "SELECT * FROM skills WHERE userid='$current_user_id' ORDER BY id DESC ";

    $data = $con->prepare($query);
	
	$data->execute();
	
	if($data ->rowCount()!=0)
	{
		while($row =$data->fetch())
		{
			
		$pdf->SetFont('arial','','11');
		$pdf->cell(60,10,$row['name'],0,0,'L');
		
		
		$pdf->SetFont('arial','','11');
		$pdf->cell(60,10,$row['experience'],0,1,'L');
			
		}
	}
	else
	{
		echo "No Record Found";
	}
    
	// Page footer
	$pdf->setTextColor(0,0,0);
	// Position at 1.5 cm from bottom
	$pdf->SetY(-33);
	// Arial italic 11
	$pdf->SetFont('Arial','I',11);
	// Page number
	$pdf->Cell(0,10,'Page '.$pdf->PageNo().' / {nb}',0,1,'C');
	
	$pdf->setTextColor(80,160,50);
	
	$pdf->SetFont('arial','B','15');
	$pdf->cell(60,10,'HOBBIES ',0,1,'L');
	
	$pdf->SetFont('arial','b','11');
	$pdf->cell(60,0,'',0,1,'L');
	
	$con=new PDO("mysql:host=localhost;dbname=cv+","root","");
	
	$query = "SELECT * FROM hobbies WHERE userid='$current_user_id' ";

    $data = $con->prepare($query);
	
	$data->execute();
	
	if($data ->rowCount()!=0)
	{
		while($row =$data->fetch())
		{
		
		$pdf->SetFont('arial','','11');
		$pdf->cell(60,10,$row['name'],0,1,'L');
		 
		}
	}
	else
	{
		echo "No Record Found";
	}
    
	                                           //REFEREES
	$pdf->SetFont('arial','B','15');
	$pdf->cell(60,10,'REFEREES',0,1,'L');
		
	$con=new PDO("mysql:host=localhost;dbname=cv+","root","");
	
	$query = "SELECT * FROM referee WHERE userid='$current_user_id' ";

    $data = $con->prepare($query);
	
	$data->execute();
	
	if($data ->rowCount()!=0)
	{
		while($row =$data->fetch())
		{
		$pdf->SetFont('arial','b','11');
	    $pdf->cell(10,10,'',0,0,'L');
		$pdf->SetFont('arial','','11');
		$pdf->cell(60,10,$row['name'],0,1,'L');
		 
		$pdf->SetFont('arial','b','11');
	    $pdf->cell(10,10,'',0,0,'L');
		$pdf->SetFont('arial','','11');
		$pdf->cell(60,10,$row['phoneno'],0,1,'L');
       
        $pdf->SetFont('arial','b','11');
	    $pdf->cell(10,10,'',0,0,'L');
		$pdf->SetFont('arial','','11');
		$pdf->cell(60,10,$row['position'],0,1,'L');
		$pdf->cell(10,10,'',0,1,'L');
		}
	}
	else
	{
		echo "No Record Found";
	}
    
	// Page footer
	$pdf->setTextColor(0,0,0);
	// Position at 1.5 cm from bottom
	$pdf->SetY(-33);
	// Arial italic 11
	$pdf->SetFont('Arial','I',11);
	// Page number
	$pdf->Cell(0,10,'Page '.$pdf->PageNo().' / {nb}',0,1,'C');
	
	
   
	$pdf->Output(rand(0001,9999).'document.pdf','D');
}


?>