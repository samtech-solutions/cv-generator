
<!DOCTYPE html>
<html>
<head>

<style>
.loader {
  border: 16px solid #f3f3f3;
  border-radius: 50%;
  border-top: 8px solid blue;
  border-right: 8px solid green;
  border-bottom: 8px solid red;
  border-left: 8px solid pink;
  width: 50px;
  height: 50px;
  -webkit-animation: spin 2s linear infinite;
  animation: spin 2s linear infinite;
  margin:auto;
  
}

@-webkit-keyframes spin {
  0% { -webkit-transform: rotate(0deg); }
  100% { -webkit-transform: rotate(360deg); }
}

@keyframes spin {
  0% { transform: rotate(0deg); }
  100% { transform: rotate(360deg); }
}
</style>
</head>
<body>
<br><br><br><br><br><br><br><br><br>
<div style="width:100%;text-align:center;vertical-align:bottom">
		<div class="loader"></div>
<?php
session_start();
echo '<meta http-equiv="refresh" content="2;url=index.php">';
echo '<br>';
echo'<span class="itext" style="color: red">Generating your Document. Please Wait...</span>';
?>
</div>
</body>
</html>
