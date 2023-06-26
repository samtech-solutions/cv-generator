<style>
  /*----------------------NAV---------------------*/
  .nav_container {
    height: 100%;
    display: flex;
    align-items: center;
    justify-content: space-between;
  }

  .nav_items {
    display: flex;
    align-items: center;
    gap: 2rem;
  }

  .nav_profile {
    position: relative;
    cursor: pointer;
  }

  li {
    list-style: none;
  }

  i {
    display: flex;
    flex-direction: rows;
    justify-content: space-between;
    margin-right: 5px;
  }

  .nav_profile:hover>ul {
    visibility: visible;
    opacity: 1;
  }

  .nav_profile ul li a {
    padding: 0.6rem;
    color: purple !important;
    border-bottom: 1px dotted blue;
    background: #ffb;
    display: block;
    border-radius: 5px;
    width: 180px;
  }

  li ul li:nth-child(5) a,
  li ul li:nth-child(7) a {
    color: red !important;
    font-size: 18px !important;
  }

  .nav_items ul li a:hover {
    background: #fff;
    border-bottom: 2px solid black;
    margin-bottom: 2px;
    border-radius: 0;
  }

  .nav_items ul {
    position: absolute;
    top: 90%;
    right: 55px;
    display: flex;
    flex-direction: column;
    visibility: hidden;
    opacity: 0;
    animation: animateDropdown 10s 0s ease forwards;
    animation-iteration-count: 1;
    transform-origin: top;
  }

  .nav_items li:nth-child(2) {
    animation-delay: 200ms;
  }

  .nav_items li:nth-child(3) {
    animation-delay: 400ms;
  }

  .nav_items li:nth-child(4) {
    animation-delay: 600ms;
  }

  .nav_items li:nth-child(5) {
    animation-delay: 800ms;
  }

  .nav_items li:nth-child(6) {
    animation-delay: 1000ms;
  }

  .nav_items li:nth-child(7) {
    animation-delay: 1200ms;

  }

  /*dropdown animation*/
  @keyframes animateDropdown {
    0% {
      transform: rotateX(90deg);
    }

    100% {
      transform: rotateX(0deg);
      opacity: 1;
    }
  }

  #profile {
    display: flex;
    flex-direction: column;

  }

  .profile {
    width: 50px;
    height: 50px;
    border-radius: 50%;
    margin-top: 5px;
    margin-right: 20px;
    display: flex;
    flex-direction: column;
  }

  .logo {
    margin-top: 0px;
    width: auto;
    height: 80px;
  }

  /*-----------------Viewport less than or equal to 520px----------------*/

  @media (max-width: 520px) {
    .nav_items ul {
      position: absolute;
      top: 90%;
      right: 30px;
    }

    .nav_profile ul li a {
      padding: 0.6rem;
      color: purple !important;
      border-bottom: 1px dotted blue;
      background: #ffb;
      display: block;
      border-radius: 5px;
      width: 130px;
    }

    .nav_items ul li a:hover {
      background: #fff;
      border-bottom: 1px solid black;
      margin-bottom: 2px;
      border-radius: 0;
    }

    li ul li:nth-child(7) a,
    li ul li:nth-child(5) a {
      color: red !important;
      font-size: 12px !important;
    }
  }
</style>

<?php

if (isset($current_user_id)) {
  $id = $current_user_id;
  $query10 = "SELECT * FROM tbl_cv WHERE userid=$id";
  $result10 = mysqli_query($conn, $query10);
  $avatar = mysqli_fetch_assoc($result10);
}

?>

<nav>
  <div class="nav_container">
    <h3 align="center"><img src="payment/images/cv-logo.jpg" class="logo"></h3>


    <div id="profile">
      <ul class="nav_items">
        <li style="color:aqua">Welcome: <?= $avatar['firstname'] ?></li>

        <li class="nav_profile">
          <div id="profile">
            <h3 align="center"> <img src="profile/images/<?= $avatar['avatar'] ?>" alt="P" class="profile" /></h3>
          </div>
          <?php
          $new_trans_id = $_SESSION['newuser'];
          //echo $new_trans_id;
          $status = '';
          $type = '';

          $res4 = mysqli_query($conn, "SELECT * FROM payment WHERE id ='$new_trans_id'");

          while ($row4 = mysqli_fetch_array($res4)) {

            $status = $row4['userstatus'];
            $type = $row4['package_type'];
          }

          if ($status == "Paid") {
            $current_user_id = $_SESSION["user-id"];
            //echo $current_user_id;
            echo ' <ul>
                     
					 <li><button data-bs-toggle="modal" data-bs-target="#exampleModal2" class="btn btn-primary" aria-hidden="true" style="width:130px !important">Change Profile</button></li> 
                      
					  <li><a href="education/index.php" style="width:120px !important"><i class="fa fa-arrow-left" aria-hidden="true"></i>Back</a></li> 
                     
                    </ul>
                </li>';
          } else {
          }

          ?>

    </div>

  </div>
</nav>
<!-- Modal for trial Version -->
<div class="modal fade" id="exampleModal2" tabindex="-1" aria-labelledby="exampleModalLabel" aria-hidden="true">
  <div class="modal-dialog">
    <div class="modal-content">
      <div class="modal-header">
        <h1 class="modal-title fs-5" id="exampleModalLabel">Change Profile</h1>
        <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
      </div>
      <?php
      $current_user = $_SESSION["user-id"];
      // echo $current_user;
      $res5 = mysqli_query($conn, "SELECT * FROM tbl_cv WHERE userid ='$current_user'");

      while ($row5 = mysqli_fetch_array($res5)) {

        //$profile = $row5['avatar'];

      }
      ?>
      <form action="profile/change_profile.php" enctype="multipart/form-data" method="POST">
        <div class="modal-body">
          <p style="font-size:12px;color:red">**NOTE: Choose a .png .jpg or .jpeg picture</p>
          <input type="file" name="my_image" class="form-control"><br>

          <br>
        </div>
        <div class="modal-footer">
          <button type="button" class="btn btn-danger" data-bs-dismiss="modal"> <i class="fa fa-times" aria-hidden="true"></i> Close</button>
          <button type="submit" name="update" id="update" class="btn btn-info" data-toggle="modal" data-target="#exampleModal2"> <i class="fa fa-save" aria-hidden="true"></i> Change</button>
        </div>

      </form>

    </div>
  </div>
</div>
<!-- end modal-->