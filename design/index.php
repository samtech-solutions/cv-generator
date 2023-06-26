<?php
include "../connection.php";
session_start();

$current_user_id =$_SESSION['user-id'];

$sql = "SELECT * FROM tbl_cv WHERE userid='$current_user_id'";

$res = mysqli_query($conn,$sql);

?>
<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>cv+ resume</title>
    <link href="../css/jquery-ui.css" rel="stylesheet">
    <link href="../css/style.css" rel="stylesheet">
	<link href="../css/styles2.css" rel="stylesheet">
	<link rel="stylesheet" type="text/css" href="../fonts/css/all.css" media="all"/>
	<link rel="stylesheet" type="text/css" href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0-alpha1/dist/css/bootstrap.min.css" media="all"/>
	<script src="../external/jquery/jquery.js"></script>
    
       
</head>
<style>
.button{
	margin:10px 10px 10px 10px;
}
 .button:hover{
	 width:300px;
	 height:300px;
 }
 img:hover{
	width:300px;
	 height:300px; 
	 .button{
	margin:0px 0px 0px 0px;
}
 }
 h2{
	 text-decoration:none !important;
	 color:green;
 }
</style>
<body> 
   
     <div class="container">
            <h2 align="center">CV+ GENERATOR</h2>
           <hr>
            <div class="title">
			    <div class="center" style="text-align:center">
				  <a href="index.php"><button id="header" class="btn btn-success btn-xs" style="width:auto"> <i class="fa fa-id-card" aria-hidden="true"></i> Choose Design</button></a>
			    </div>
                <br>
            </div>

         <div class="table-responsive" id="user_data">
		  
			
            <div align="center">
            <form action="pdf_gen.php" method="post">
				<button type="submit"  name ="pdf" style="border:none" class="button">
				  <image style="width:250px;height:250px" type="image" name="pdf" src="../images/design1.pdf" id="pdf"
				   class="image"></image>
				</button>
				
				<button type="submit"  name ="pdf2" style="border:none" class="button">
				  <image style="width:250px;height:250px" type="image" name="pdf2" src="../images/design2.pdf" id="pdf2"
				   class="image"></image>
				</button>
				
				<button type="submit"  name ="pdf3" style="border:none" class="button">
				  <image style="width:250px;height:250px" type="image" name="pdf3" src="../images/design3.pdf" id="pdf3"
				   class="image"></image>
				</button>
               
               <button type="submit"  name ="pdf4" style="border:none" class="button">
				  <image style="width:250px;height:250px" type="image" name="pdf4" src="../images/design4.pdf" id="pdf4"
				   class="image"></image>
				</button>
				
				<button type="submit"  name ="pdf5" style="border:none" class="button">
				  <image style="width:250px;height:250px" type="image" name="pdf5" src="../images/design5.pdf" id="pdf5"
				   class="image"></image>
				</button>
				<button type="submit"  name ="pdf2" style="border:none" class="button">
				  <image style="width:250px;height:250px" type="image" name="pdf2" src="../images/design2.pdf" id="pdf2"
				   class="image"></image>
				</button>
			 </form>
            </div>
            <hr>
            
           
			
			   <div class="center" style="text-align:center">
				  <a href="../application_letter/application.html"><button id="header" class="btn btn-success btn-xs" style="width:auto"> <i class="fa fa-envelope" aria-hidden="true"></i> Application Letter</button></a>
			   </div>
			   <br>
              <div  align="center">
                <a href="../application_letter/application.html" target="_blank"><img src="../images/design2.pdf" height="250px" width="250px" class="image"/></a>
              </div>
             <hr>
            <p style="color:blue">**Alert: Your CV has been created successfully. Go to downloads and locate for
            Resume.pdf</p>
       
        </div>  
   </div>
        <div id="pop-up" >
          <div id="close-btn">x</div>
          <h1 style="text-align:center;color:green">Support Us </h1>
          <h4>Donate to support Our Hosting and Maintenance charges.</h4>
          <a href="../donation.html" target="_blank">Make Your Donation -><a>
		  <br>
		  <br>
          <p>Thanks for supporting Us.</p>   
        </div>
   <script src="../js/custom.js"></script>
   <script src="https://cdn.jsdelivr.net/npm/@popperjs/core@2.11.6/dist/umd/popper.min.js" integrity="sha384-oBqDVmMz9ATKxIep9tiCxS/Z9fNfEXiDAYTujMAeBAsjFuCZSmKbSSUnQlmh/jp3" crossorigin="anonymous"></script>
   <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0-alpha1/dist/js/bootstrap.min.js" integrity="sha384-mQ93GR66B00ZXjt0YO5KlohRA5SY2XofN4zfuZxLkoj1gXtW8ANNCe9d5Y3eG5eD" crossorigin="anonymous"></script>

</body>
</html>
