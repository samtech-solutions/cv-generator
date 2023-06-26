<!DOCTYPE html>
<html>

<head>

    <style>


    </style>
</head>

<body>
    <br><br><br><br><br>
    <div style="width:100%;text-align:center;vertical-align:bottom">

        <?php
        session_start();
        $db_password = $_SESSION['password'];
		$db_email = $_SESSION['email'];
        $db_transactionid = $_SESSION['transactionid'];
        //echo "User or Email already taken";
        //echo '<br>';
        //echo $db_password;
        //echo '<br>';
		//echo $db_email;
        //echo '<br>';
		//echo $db_transactionid ;

        echo '<meta http-equiv="refresh" content="2">';
        echo "<script>alert('User id $db_password or Email $db_email already taken, Choose a different one');
		location.href='index.php';</script>";
       
        //echo '<br>';
        ?>
    </div>
</body>

</html>