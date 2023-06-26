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
        //echo "<script>window.location='listloans.php?id=".$_SESSION['tid']."'; </script>";
    } else {

        $result = mysqli_query($conn, "DELETE FROM skills WHERE id ='$id'");
        echo "<script>window.location='delete_skill_loader.php'; </script>";
    }
}
?>