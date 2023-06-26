<?php
include "../connection.php";

session_start();

$current_user_id =$_SESSION['user-id'];

$query = "SELECT * FROM skills WHERE userid='$current_user_id'";


$result = mysqli_query($conn , $query) or die(mysqli_error($conn));
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
</style>
<body> 
   
     <div class="container">
            <h3 align="center">CV+ GENERATOR</h3>
               <progress id="progressBar" value="60" max="100"
                style="width:420px;height:15px;"></progress>
            <h6 id="status">Phase 6 of 10</h6>

            <hr>

            <div class="title">
			    <div class="cente">
				  <a href="index.php"><button id="header" class="btn btn-xs" style="width:150px">My Skills Details</button></a>
			    </div>
                <br>
            </div>

         <div class="table-responsive" id="user_data">
		 <table class="table">
         <thead>
           <tr>
             <th>Skill</th>
             <th>Experience</th>
             			 
			 <!-- Button trigger modal -->
             <div style="text-align:right">
			    <button class="btn btn-primary" data-bs-toggle="modal" data-bs-target="#exampleModal" >
				  <i class="fa fa-phone fa-plus"></i> Add
			     </button>
			 </div>
			 
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
        </div>
		
		<!-- Modal -->
		<div class="modal fade" id="exampleModal" tabindex="-1" aria-labelledby="exampleModalLabel" aria-hidden="true">
		  <div class="modal-dialog">
			<div class="modal-content">
			  <div class="modal-header">
				<h1 class="modal-title fs-5" id="exampleModalLabel">My Skills Details</h1>
				<button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
			  </div>
			  
			  <form action="skills.php" method="POST">
				  <div class="modal-body">
				   
					<label> Skill :</label> <input id="name" name="name"  class="form-control" placeholder="Enter your skill" required>
					   
					 <br>
					<label >Experience :</label> <select type="text" id="experience" name="experience"  class="form-control" placeholder="Choose years of Experience" required >
                             <option value=""></option>
                             <option value="Below 1 year">Below 1 year</option>
                             <option value="1 - 2 year">1 - 2 year</option>
                             <option value="2 - 3 year">2 - 3 year</option>
                             <option value="3 - 5 year">3 - 4 year</option>
                             <option value="5 - 7 year">5 - 7 year</option>
                             <option value="7- 9 year">7 - 9 year</option>
                             <option value="Above 10 year">Above 10 year</option>
                             </select>
                      <br>
					 
				  </div>
				  <div class="modal-footer">
					<button type="button" class="btn btn-danger" data-bs-dismiss="modal"> <i class="fa fa-times" aria-hidden="true"></i> Close</button>
					<button  type="submit" name="save" id="save" class="btn btn-info" 
					data-toggle="modal" data-target="#exampleModal"><i class="fa fa-upload" aria-hidden="true"></i> Save </button> 
				  </div>
			  </form>
     
			</div>
		  </div>
		</div>
       
  
   <div style="text-align:center">
      <a href="../hobbies/index.php"><button  class="btn btn-success btn-xs"> <i class="fa fa-bicycle" aria-hidden="true"></i> Hobbies</button></a>
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
