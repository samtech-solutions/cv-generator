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

        $result1 = mysqli_query($conn, "DELETE FROM jobexperience WHERE id ='$id'");
        echo "<script>window.location='delete_job_loader.php'; </script>";
    }
}
?>