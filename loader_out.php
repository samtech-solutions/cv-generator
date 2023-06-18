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
        echo '<meta http-equiv="refresh" content="2;url=signup/signin.php">';
        echo '<br>';
        echo '<span class="itext" style="color: red;margin-bottom:10px">Logging out..... Thank you <br>for using our services</span>';
        ?>
    </div>
</body>

</html>