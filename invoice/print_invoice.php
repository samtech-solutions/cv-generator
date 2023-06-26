<?php include "../connection.php"; ?>  

<!DOCTYPE html>
<html>
<style>
.logo{
	width:150px;
	height:150px;
}

</style>
<head>
  <meta charset="utf-8">
  <meta http-equiv="X-UA-Compatible" content="IE=edge">
   <?php 
   session_start();
   $current_user_id = $_SESSION["user-id"];
   $new_trans_id = $_SESSION["newuser"];

$sql = mysqli_query($conn, "SELECT * FROM payment WHERE id='$new_trans_id '");
if(mysqli_num_rows($sql) == 0)
{
echo "<script>alert('Data Not Found!'); </script>";
}
else
{
while($row = mysqli_fetch_assoc($sql)){
?>

<?php }}?>
  <?php 
	$sql = mysqli_query($conn, "SELECT * FROM payment WHERE id='$new_trans_id '");
	while($row = mysqli_fetch_assoc($sql)){
	?>
  <title><?php echo $row ['usertoken']?></title>
  <?php }?>
  <!-- Tell the browser to be responsive to screen width -->
  <meta content="width=device-width, initial-scale=1, maximum-scale=1, user-scalable=no" name="viewport">
  <!-- Bootstrap 3.3.6 -->
   <link href="css/bootstrap.min.css" rel="stylesheet">
  <!-- Font Awesome -->
  <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/4.5.0/css/font-awesome.min.css">
  <!-- Ionicons -->
  <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/ionicons/2.0.1/css/ionicons.min.css">
 

</head>
<body onLoad="window.print();">
<div class="wrapper">
  <!-- Main content -->
  <br>
  <?php 
		 $result= mysqli_query($conn,"SELECT * FROM payment WHERE id='$new_trans_id '")or die(mysqli_error());
		 while($row=mysqli_fetch_array($result))
		 {
		 ?>
		   <div align="center"><img src="../payment/images/cv.png" class="logo"> 
		 <?php }?>
		 </div>
  <section class="invoice">
    <!-- title row -->
    <div class="row">
	<h1 style="color:#009900;font-size:20px ">Invoice Details</h1>
      <div class="col-xs-12">
        <h2 class="page-header">
		 <?php 
		 $sql = "SELECT * FROM payment WHERE id='$new_trans_id'";
		 $result = mysqli_query($conn,$sql);
		 while ($row=mysqli_fetch_array($result))
		{
?>
           <div style="color:#009900"><div style="font-size:15px"><div align="center">iSam Developers</div></div></div>
		  
          <small class="pull-right"><div style="color:#009900"><?php $today = date ('y:m:d'); 
		  								  $new = date ('l, F, d, Y', strtotime($today));	
										      echo $new;?></div>
		</small>
        </h2>
		<?php  
		}
		?>
      </div>
      <!-- /.col -->
    </div>
    <!-- info row -->
    
    <!-- /.row -->

    <!-- Table row -->
    <section class="content">

      <!-- Default box -->
      <div class="box">
           
	            <div class="box-body table-responsive">

			<table id="example1" class="table table-bordered table-striped">
                <thead>
                <tr>
                  <th>&nbsp;&nbsp;Usertoken</th>
                  <th> &nbsp;&nbsp;Userstatus</th>
				  <th>&nbsp;&nbsp;Package Type</th>
                  <th>&nbsp;&nbsp;Payment Plan</th>
                  <th>&nbsp;&nbsp;Amount</th>
                  <th>&nbsp;&nbsp;Payment Code</th>
				  <th>&nbsp;&nbsp;Life duration</th>
                  <th>&nbsp;&nbsp;Date Paid </th>
                 </tr>
                </thead>
                <tbody>
<?php

 $select1  = "SELECT * FROM payment WHERE id='$new_trans_id'";
		 $result = mysqli_query($conn,$select1 );
while($row1 = mysqli_fetch_array($result))
{
$Usertoken = $row1['usertoken'];
$Userstatus = $row1['userstatus'];
$Package_Type = $row1['package_type'];
$Payment_Plan = $row1['payment_plan'];
$Amount = $row1['amount'];
$Payment_code = $row1['mpesa_code'];
$Life_duration = $row1['life_duration'];
$Date_Paid = $row1['date_paid'];
?>    
                <tr>
                <td><?php echo $Usertoken; ?></td>
                <td><?php echo $Userstatus; ?></td>
				<td><?php echo $Package_Type; ?></td>
				<td><?php echo $Payment_Plan; ?></td>
                <td><?php echo $Amount; ?></td>
				 <td><?php echo $Payment_code; ?></td>
				<td><?php echo $Life_duration; ?></td>
                <td><?php echo $Date_Paid; ?></td>

    </tr>
<?php }  ?>
             </tbody>
                </table>  
				</div>
				
              <div class="box-footer">
	 <button type="button" onClick="window.print();" class="btn btn-warning pull-right" ><i class="fa fa-print"></i>Print</button>

            <!-- /.box-body -->
          </div>
      <!-- /.box -->

    </section>
    <!-- /.content -->
  </div>&nbsp;&nbsp;
  <br>
  <br>
<?php include("../footer.php"); ?>