<?php

session_start();

 if(isset($_POST['submit']) && isset($_FILES['my_image'])){

  include "../connection.php";

  //echo "<pre>";
 // print_r($_FILES['my_image']);
  //echo "<pre>";
  $userid =$_SESSION['user-id'];
  $name =$_POST['name'];
  $img_name = $_FILES['my_image']['name'];
  $img_size = $_FILES['my_image']['size'];
  $tmp_name = $_FILES['my_image']['tmp_name'];
  $error = $_FILES['my_image']['error'];
  
  if($error === 0){
    if($img_size > 125000){
        echo "<script>alert('Sorry, your file is too large!!!');
        window.location.href=' ../testimonies/index.php';</script>";    
    }
    else
    {
      $img_ex = pathinfo($img_name,PATHINFO_EXTENSION);

      $img_ex_lc = strtolower($img_ex);

      $allowed_exs  = array("jpg","jpeg","png");

      if(in_array( $img_ex_lc,$allowed_exs)){
           $new_img_name = uniqid("img-" ,true). '.'.$img_ex_lc;
           $img_upload_path ='uploads/'.$new_img_name;
           move_uploaded_file($tmp_name,$img_upload_path);

           // insert into database
           $sql = "INSERT INTO documents(name,userid,image_url)
                   VALUES('$name','$userid', '$new_img_name')";
            mysqli_query($conn,$sql);

            if (mysqli_affected_rows($conn) > 0) { 
                //echo "<script>alert('YOUR DOCUMENT HAS BEEN SUCCESSFULLY UPLOADED!!!');
                //window.location.href='index.php';</script>";
				echo "<script>window.location='loader.php';</script>";
            }
      }else{
        echo "<script>alert('You can't upload files of this type!!');
        window.location.href='index.php';</script>";
      }
    }
 }
 else
 {
    echo "<script>alert('Unknown error occured!!');
                window.location.href='../testimonies/index.php';</script>";   
 }
 }else{
     header("location: ../testimonies/index.php");
 }
  ?>
