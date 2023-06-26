<?php
require 'config/constants.php';

$username_email = $_SESSION['signin-data']['username_email'] ?? null;
$password = $_SESSION['signin-data']['password'] ?? null;
unset($_SESSION['signin-data']);
?>

<!DOCTYPE html>
<html lang="en">

<head>
  <meta charset="UTF-8" />
  <meta http-equiv="X-UA-Compatible" content="IE=edge" />
  <meta name="viewport" content="width=device-width, initial-scale=1.0" />
  <title>Resume generator</title>
  <!--css style sheet-->

  <link rel="stylesheet" href="./css/style.css" />

  <!---------------------------Font awesome icons-------------------------->
  <link rel="stylesheet" type="text/css" href="./css/all.css" media="all" />
  <link rel="stylesheet" type="text/css" href="fonts/css/all.css" media="all"/>
</head>

<body>
  <section class="form_section">
    <div class="container form_section-container">
      <h2> Sign In </h2>
      <?php if (isset($_SESSION['signin'])) : ?>
        <div class="alert_message error">
          <p>
            <?= $_SESSION['signin'];
            unset($_SESSION['signin']);
            ?>
          </p>
        </div>
      <?php elseif (isset($_SESSION['signup-success'])) : ?>
        <div class="alert_message success ">
          <p>
            <?= $_SESSION['signup-success'];
            unset($_SESSION['signup-success']);
            ?>
          </p>
        </div>
      <?php endif ?>

      <form action="<?= ROOT_URL ?>signin-logic.php" method="POST">
        <input type="text" name="username_email" value="<?= $username_email ?>" placeholder="Enter Your Email" />
        <input type="password" name="idno" value="<?= $password ?>" placeholder="Enter Id Number" />
        <div style="text-align:center">
            <button type="submit" name="submit" class="btn" >  Sign In <i class="fa fa-sign-in" aria-hidden="true"></i></button>
        </div>
      </form>
    </div>
  </section>
</body>

</html>