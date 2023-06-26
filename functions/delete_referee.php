<?php
include "../connection.php";
session_start();
?>
<!--Delete a record -->
<?php
if (isset($_GET['id'])) {

    $id = $_GET['id'];

    if ($id == '') {
        echo "<script>alert('Row Not Selected!!!'); </script>";
        
    } else {

        $result = mysqli_query($conn, "DELETE FROM referee WHERE id ='$id'");
        echo "<script>window.location='delete_referee_loader.php'; </script>";
    }
}
?>