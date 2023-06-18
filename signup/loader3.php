
<!DOCTYPE html>
<html>
<link rel="stylesheet" href="../css/styles.css" /> 
<head>

<style>

</style>
</head>
<body>
<div class="container">
		<div class="loader"></div>
<?php
session_start();
echo '<meta http-equiv="refresh" content="2;url=signin.php">';
  $_SESSION['signin'] = "User not found";
echo '<br>';
echo'<span class="itext" style="color: #FF0000">Checking Details... Please Wait!...</span>';
?>
</div>
</body>
</html>
