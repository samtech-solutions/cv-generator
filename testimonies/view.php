<?php 
include "../connection.php"

session_start();

?>


<!DOCTYPE html>
 <html>
     <head>
         <title>view documents</title>
         <style>
                          /*-----------------Viewport less than or equal to 900px----------------*/
 
 @media (max-width:1024px){
	 
             .container{
                 display: flex;
                 justify-content: center;
                 align-items: center;
                 flex-wrap: wrap;
                 min-height: 30vh;  
                 background: white; 
             }
             .document{
                 text-align:center; 
                 background: white;
                 margin-top:-150px; 
                 padding-left:200px; 
                 padding-bottom:-100px; 

             }
             h1{
                 position:absolute;
                 top:25px;
                 color:green;
                 text-decoration:underline;
             }
             h3{
                 position:relative;
                 top:45px;
                 color:blue;
                 text-align:center;
                 margin:5px;
             }
              .alb{
                padding:30px;
                width:400px;
                height:400px;
                padding-bottom:5px;
  
              }
              .alb img{
                padding:20px;
                width:100%;
                height:100%;
               
              }
              a {
                  text-decoration:none;
                  color:black;
                  position:relative;
                  top:-25px;
                  color:#456894;
                  right:-170px;
              }
              .back{
                  text-decoration:true;
                  color:lightblue;
                  font-size:30px;
                  top:80px;
                  right:600px;
              }
              a:hover{
                  color:#567809;
                  font-size:20px;    
              }
              .alb img:hover{
                  background:transparent;
	              border:1px solid rgb(164, 164, 235);
                  padding:-15px;
              }
              p{
                  color:red;
              }
 }
               /*-----------------Viewport less than or equal to 450px----------------*/
 
 @media (max-width:450px){
           .container{
                 display: flex;
                 justify-content: center;
                 align-items: center;
                 flex-wrap: wrap;
                 min-height: 30vh;  
                 background: white; 
             }
             .document{
                 text-align:center; 
                 background: white;
                 margin-top:-150px; 
                 padding-left:200px; 
                 padding-bottom:-100px; 

             }
             h1{
                 position:absolute;
                 top:25px;
                 color:green;
                 text-decoration:underline;
             }
             h3{
                 position:relative;
                 top:45px;
                 color:blue;
                 text-align:center;
                 margin:5px;
             }
              .alb{
                padding:30px;
                width:400px;
                height:400px;
                padding-bottom:5px;
  
              }
              .alb img{
                padding:20px;
                width:100%;
                height:100%;
               
              }
              a {
                  text-decoration:none;
                  color:black;
                  position:relative;
                  top:-25px;
                  color:#456894;
                  right:-170px;
              }
              .back{
                  text-decoration:true;
                  color:lightblue;
                  font-size:30px;
                  top:80px;
                  right:600px;
              }
              a:hover{
                  color:#567809;
                  font-size:20px;    
              }
              .alb img:hover{
                  background:transparent;
	              border:1px solid rgb(164, 164, 235);
                  padding:-15px;
              }
    }
         </style>
     </head>
     <body>
           <div class="container">
               <h1>MY DOCUMENTS</h1>
               <p>***Alert : Press on Create Pdf button to Generate your Document Pdf file.</p><br>
          <a href="documents.html" class="back">&#8592;Go Back</a><br>
            </div>
          <div class="document">
          <?php 
           $images = "";
		   $current_user_id =$_SESSION['user-id'];
           $sql = "SELECT * FROM documents WHERE userid='$current_user_id' ORDER BY id DESC";

           $res = mysqli_query($conn,$sql);

           if(mysqli_num_rows($res) > 0){

               while($images = mysqli_fetch_assoc($res)){ ?>
     
                <div class="alb">
                    <h3><?php echo $images['name']?></h3>
                    <img src="uploads/<?=$images['image_url']?>">
                    <a href="pdf.php?id=<?=$images['id']?>"
                     onclick="return confirm('Are you sure you want to Generate/Download this PDF?');">CREATE PDF</a>
                </div>
             <?php  }
           }
          ?>
          </div>
     </body>
 </html>