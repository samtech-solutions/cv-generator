<?php

require 'config/constants.php';

//connect to database
$conn = new mysqli(DB_HOST, DB_USER, DB_PASS, DB_NAME);

if (mysqli_errno($conn)) {
    die(mysqli_error($conn));
}
