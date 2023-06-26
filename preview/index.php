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
	<link href="../css2/css/styles2.css" rel="stylesheet">
	<link rel="stylesheet" type="text/css" href="../fonts/css/all.css" media="all"/>
	<link rel="stylesheet" type="text/css" href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0-alpha1/dist/css/bootstrap.min.css" media="all"/>
	<script src="../external/jquery/jquery.js"></script>
    
       
</head>
<style>
 .center{
	  margin-left:100px;
  }
  .document{
	 text-align:left; 
	 background: white;
	 margin-top:0px; 
	 padding-top:10px;
	 padding-left:1px; 
	 padding-bottom:-100px; 
 }
 
  h3{
	 position:relative;
	 font-size:15px;
	 color:blue;
	 text-align:left;
	 margin:5px;
	 text-decoration:none;
	}
	b{
	color:black;
	font-size:17px;
	}
	th{
		color:black;
	}
	td{
		color:blue;
	}
	table{
		border:none;
	}
	.alert_message.error{
		padding:0.8rem 1.4rem;
        margin-bottom:1rem;
        border-radius:var(--card-border-radius-2);
	    background: hsl(346,87%,46%,15%);;
        color:red;	
		text-align:center;
	}
	h2{
	 text-decoration:none !important;
	 color:green;
 }
</style>
<body> 
   
 <div class="container">
		<h2 align="center">CV+ GENERATOR</h2>
		   <progress id="progressBar" value="100" max="100"
			style="width:420px;height:15px;"></progress>
		<h6 id="status" style="color:red">Phase 10 of 10</h6>

		<hr>

		<div class="title">
			<div class="center">
			  <a href="index.php"><button id="header" class="btn btn-xs" style="width:auto">Resume Preview</button></a>
			</div>
			<br>
		</div>

	 <div class="table-responsive" id="user_data">
		 
		<div class="document">
		<!-- personal details -->
		 <h4 style="text-align:left;text-decoration:underline;color:green">Personal Details</h4>
		 
		  <?php 
		   
		   if(mysqli_num_rows($res) > 0){

			   while($row = mysqli_fetch_assoc($res)){ ?>
				
				<div class="alb1">
				   <h3><b>Full Name : </b> <?php echo $row['firstname']; ?> <?php echo $row['middlename']; ?> <?php echo $row['lastname']; ?></h3><br>
				   <h3><b>Gender : </b> <?php echo $row['gender']; ?>&nbsp &nbsp &nbsp &nbsp &nbsp &nbsp  &nbsp &nbsp &nbsp <b>Id Number : </b> <?php echo $row['idno']; ?> 
				   &nbsp &nbsp &nbsp &nbsp &nbsp &nbsp &nbsp &nbsp &nbsp
				   <b>Year of Birth : </b> <?php echo $row['yob']; ?>
				   </h3>
				   <br>
				   <h3><b>Email : </b> <?php echo $row['email']; ?></h3><br>
				   <h3><b>Phone1 : </b> <?php echo $row['phone1']; ?> &nbsp &nbsp &nbsp &nbsp &nbsp &nbsp &nbsp &nbsp &nbsp <b>Phone2 : </b> <?php echo $row['phone2']; ?></h3><br>
				   <h3><b>Address1 </b> : <?php echo $row['address1']; ?> &nbsp &nbsp &nbsp &nbsp &nbsp &nbsp <b>Address2 : </b> <?php echo $row['address2']; ?></h3><br>
				   <h3><b>Personal profile : </b> <?php echo $row['personalprofile']; ?></h3><br>
				   <h3><b>Career Objectives : </b> <?php echo $row['careerobjectives']; ?></h3><br>
				   
				</div>
			 <?php  }
		   }
		  ?>
		   
         
		 <!-- education details -->
	    <h4 style="text-align:left;text-decoration:underline;color:green">Education Details</h4>
		
		<?php 
		   $query = "SELECT * FROM education WHERE userid='$current_user_id' ORDER BY id DESC";

           $result = mysqli_query($conn , $query) or die(mysqli_error($conn));
		  
		 ?>
		 <?php if (mysqli_num_rows($result) > 0) : ?>
		<table class="table">
         <thead>
           <tr>
             <th>Year From</th>
             <th>Year To</th>
             <th>Education Level</th>
             <th>Achievement</th>			 
			 		
           </tr>
         </thead>
         <?php
          while($row =$result->fetch_assoc()):
         ?>
         <tr>
           <td style="height:auto"><?php echo $row['yearfrom']; ?></td>
           <td><?php echo $row['yearto']; ?></td>
		   <td style="height:auto"><?php echo $row['educationlevel']; ?></td>
           <td><?php echo $row['achievement']; ?></td>
           
         </tr>
          <?php endwhile; ?>
         </table> 
		<?php else : ?>		 
		   <div class="alert_message error"><?= "No Education Background found" ?></div>
         <?php endif ?>
		 
		 
		<!-- work experience details -->
		<h4 style="text-align:left;text-decoration:underline;color:green">Work Experience Details</h4>
		
		<?php
		   $query = "SELECT * FROM jobexperience WHERE userid='$current_user_id' ORDER BY id DESC";

		   $result = mysqli_query($conn , $query) or die(mysqli_error($conn));
		?>
		<?php if (mysqli_num_rows($result) > 0) : ?>
		 <table class="table">
         <thead>
           <tr>
             <th>Year From</th>
             <th>Year To</th>
             <th>Job Title</th>
             <th>Responsibility</th>			 
			 		
           </tr>
         </thead>
         <?php
          while($row =$result->fetch_assoc()):
         ?>
         <tr>
           <td style="height:auto"><?php echo $row['yearfrom']; ?></td>
           <td><?php echo $row['yearto']; ?></td>
		   <td style="height:auto"><?php echo $row['jobtitle']; ?></td>
           <td><?php echo $row['responsibility']; ?></td>
           
         </tr>
          <?php endwhile; ?>
         </table> 
		 <?php else : ?>		 
		   <div class="alert_message error"><?= "No Job Experience found" ?></div>
         <?php endif ?>
		 
		 
		 <!-- skills details -->
		<h4 style="text-align:left;text-decoration:underline;color:green">Skills Details</h4> 
		 <?php
		$query = "SELECT * FROM skills WHERE userid='$current_user_id'";

		$result = mysqli_query($conn , $query) or die(mysqli_error($conn));
		?>
		<?php if (mysqli_num_rows($result) > 0) : ?>
		<table class="table">
         <thead>
           <tr>
             <th>Skill</th>
             <th>Experience</th>
            
           </tr>
         </thead>
         <?php
          while($row =$result->fetch_assoc()):
         ?>
         <tr>
           <td style="height:auto"><?php echo $row['name']; ?></td>
           <td><?php echo $row['experience']; ?></td>
		   
           
         </tr>
          <?php endwhile; ?>
         </table>
		 <?php else : ?>		 
		   <div class="alert_message error"><?= "No Skill found" ?></div>
         <?php endif ?>
		 
		 
		<!-- hobbies details -->
		<h4 style="text-align:left;text-decoration:underline;color:green">Hobbies Details</h4>  
		
		<?php

		$query = "SELECT * FROM hobbies WHERE userid='$current_user_id'";

		$result = mysqli_query($conn , $query) or die(mysqli_error($conn));
		?>
		<?php if (mysqli_num_rows($result) > 0) : ?>
		<table class="table">
         <thead>
           <tr>
		    <th>Id</th>
             <th>Hobby</th>
            
           </tr>
         </thead>
         <?php
          while($row =$result->fetch_assoc()):
         ?>
         <tr>
           <td style="height:auto"><?php echo $row['id']; ?></td>
           <td><?php echo $row['name']; ?></td>
		   
           
         </tr>
          <?php endwhile; ?>
         </table>
        <?php else : ?>		 
		<div class="alert_message error"><?= "No Hobbies found" ?></div>
         <?php endif ?>
		 
		<!-- referees details -->
		<h4 style="text-align:left;text-decoration:underline;color:green">Referees Details</h4> 
		<?php

         $query = "SELECT * FROM referee WHERE userid='$current_user_id'";

         $result = mysqli_query($conn , $query) or die(mysqli_error($conn));
        ?>
		<?php if (mysqli_num_rows($result) > 0) : ?>
		<table class="table">
         <thead>
           <tr>
             <th>Name</th>
             <th>Phone Number</th>
			 <th>Position</th>
            
           </tr>
         </thead>
         <?php
          while($row =$result->fetch_assoc()):
         ?>
         <tr>
           <td><?php echo $row['name']; ?></td>
           <td><?php echo $row['phoneno']; ?></td>
		   <td><?php echo $row['position']; ?></td>
		   
           
         </tr>
          <?php endwhile; ?>
         </table> 
		 <?php else : ?>		 
		<div class="alert_message error"><?= "No Referee found" ?></div>
         <?php endif ?>
	  </div>
	</div>
	
        <div style="text-align:center">
		   
		   <a href="../design/index.php"><button  class="btn btn-success btn-xs" style="width:auto"> <i class="fa fa-file-pdf" aria-hidden="true"></i> Generate PDF</button></a>
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
