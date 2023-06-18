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
        echo '<meta http-equiv="refresh" content="2;url=../referee/index.php">';
        echo '<br>';
        echo '<span class="itext" style="color: red">Deleting Data. Please Wait...</span>';
        ///echo "<script>alert('Row Delete Successfully!!!'); </script>";

        ?>
    </div>
</body>

</html>