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
        echo '<meta http-equiv="refresh" content="2;url=../dashboard.php">';
        echo '<br>';
        echo '<span class="itext" style="color: green">Saving your profile.. Please Wait!...</span>';
        ?>
    </div>
</body>

</html>