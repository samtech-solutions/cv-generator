

<!DOCTYPE html>
<html>
<link rel="stylesheet" href="./css/styles.css" />  
<head>

<style>

</style>
</head>
<body>

<div class="container">
		<div class="loader"></div>
    <?php
    session_start();
        $db_password = $_SESSION['password'];
        $db_email = $_SESSION['email'];
    echo '<meta http-equiv="refresh" content="2;url=confirmuser.php">';
    echo '<br>';
    echo'<span class="itext" style="color: #FF0000">Checking your details. Please Wait!...</span>';
    ?>
    </div>
</body>
</html>
