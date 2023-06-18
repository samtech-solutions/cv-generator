<?php
session_start();
$current_user_id = $_SESSION["user-id"];
$new_trans_id = $_SESSION['newuser'];
//echo $new_trans_id ;
//echo $current_user_id ;
?>


<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8" />
    <meta name="viewport" content="width=device-width, initial-scale=1.0" />
    <title>curriculum vitae plus generator</title>
    <link href="css/jquery-ui.css" rel="stylesheet" />
    <!-------------------icon------------>
    <link rel="shortcut icon" type="image/ico" href="images/favicon.ico" />
    <link rel="stylesheet" href="./css/style.css" />
    <link href="css/style.css" rel="stylesheet" />
    <link href="css/styles2.css" rel="stylesheet" />
    <link rel="stylesheet" type="text/css" href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0-alpha1/dist/css/bootstrap.min.css" media="all" />
    <link rel="stylesheet" type="text/css" href="../fonts/css/all.css" media="all" />
    <script src="external/jquery/jquery.js"></script>
    <script src="js/jquery-ui.js"></script>

    <script src="jsPDF/dist/jspdf.min.js"></script>

    <style>
        #container {
            width: 100%;
            height: auto;
        }

        #exampleModalLabel,
        #exampleModalLongTitle,
        #exampleModalCenter {
            color: blue;
        }

        .container {
            border: none !important;
            background-color: white;
        }

        .wrapper {
            margin-top: 25px !important;
            background-color: #ffffff;
            height: 70px;
            padding: 0px 0px;
            display: flex;
            border-radius: 8px;

        }

        .modal-body p {
            text-align: left;
            color: purple;
        }

        .modal-body .fa-times-circle {
            margin-right: 20px;
            color: red;
            font-size: 25px;
        }

        .modal-body .fa-check-circle {
            margin-right: 20px;
            color: green;
            font-size: 25px;
        }

        .modal-body h4 {
            text-align: center;
            color: green !important;
        }

        .words {
            overflow: hidden;

        }

        span {
            display: block;
            height: 100%;
            padding-left: 10px;
            color: #0e6ffc;
            animation: spin_words 10s infinite;
        }

        @keyframes spin_words {
            0% {
                transform: translateY(-60%);
            }

            50% {
                transform: translateY(100%);
            }

            100% {
                transform: translateY(-170%);
            }

        }

        .footer {
            width: 100%;
            height: 30px;
            margin-left: 10px;
            background-color: black;
        }

        .plan {
            width: 400px;
            height: 480px;
            background-color: white;
            margin-left: 30%;
        }

        img {
            width: 300px;
            height: 300px;
        }


        h6 {
            margin-left: 10px;
        }

        .buttons {
            display: flex;
            justify-content: space-between;
            flex-direction: rows;
            width: auto;
        }

        a {
            text-decoration: none;
            ;
        }

        .login {
            width: 80px;
            height: 40px;
            background-color: rgb(43, 201, 12);
            border-radius: 10px;
            border: none;
            color: white;
        }

        .more {
            position: relative;
            color: blue;
            border: none;
            display: inline-block;
            background-color: white;
            cursor: pointer;
            font-size: 16px;
        }

        .logo {
            margin-top: -30px;
            width: auto;
            height: 100px;
        }

        /*===============SIGN IN PAGE==========*/

        .form_control {
            display: flex;
            flex-direction: column;
            gap: 0.6rem;
        }

        .form_control.inline {
            flex-direction: row;
            align-items: center;
        }

        input,
        textarea,
        select {
            padding: 0.6rem 0.9rem;
            background-color: rgb(79, 78, 80);
            border-radius: .4rem;
            resize: none;
            color: white;
        }

        /*-----------------Viewport less than or equal to 520px----------------*/

        @media (max-width: 520px) {
            #container {
                width: 90%;
                height: auto;
                overflow: scroll;
            }

            .container {
                border: none !important;
            }

            .buttons {
                display: flex;
                justify-content: space-between;
                flex-direction: column;
                width: 90%;
            }

            img {
                width: 200px;
                height: 150px;
            }

            .plan {
                width: 90%;
                height: 320px;
                background-color: white;
                margin-left: 20%;
            }

            a {
                margin-left: 20px;
            }

            .logo {
                margin-top: -30px;
                width: auto;
                height: 100px;
            }

            .footer {
                width: 95%;
                height: 40px;
                margin-left: 15px;
                font-size: 13px;
                background-color: black;
            }

            .plan .btn {
                width: 100px !important;
            }
        }
    </style>
</head>

<body>
    <div id="container" style="background-color:rgb(246, 239, 239);width:100%">

        <h3 align="center"><img src="../images/cv-logo.jpg" class="logo"></h3>
        <p style="font-size:20px;text-align:center;color:purple">CURRICULUM VITAE PLUS GENERATOR SYSTEM</p>

        <div class="buttons">

            <div class="plan">
                <!-- <h4 style="text-align:center">Starter Package Version</h4>-->
                <a style="text-decoration: none; color: rgb(56, 46, 192)" href="#">

                    <img src="../images/p2.png"></img>

                    <div class="wrapper">
                        <p style="text-decoration:none">Payment Plans</p>

                        <div class="words">
                            <span>Monthly <b>100 KSH</b> or <b>1 USD</b> </span>
                            <span>Yearly <b>1200 KSH</b> or <b>12 USD</b> </span>
                            <span>Yearly <b>3000 KSH</b> or <b>30 USD</b> </span>

                        </div>
                    </div>
                    <button class="btn btn-primary" data-bs-toggle="modal" data-bs-target="#exampleModal" style="margin-left:40px;margin-bottom:0px">Subscribe</button>
                    <button class="more tooltip-test" title="Read More Information" data-bs-toggle="modal" data-bs-target="#exampleModalCenter" style="margin-left:80px;margin-bottom:0px"><i class="fa fa-stream" aria-hidden="true"></i></button>

                </a>
            </div>

        </div>
        <div class="footer">

            <?php include_once '../footer1.php' ?>

        </div>
    </div>


    <!-- Modal for Starter Package Version -->
    <div class="modal fade" id="exampleModal" tabindex="-1" aria-labelledby="exampleModalLabel" aria-hidden="true">
        <div class="modal-dialog">
            <div class="modal-content">
                <div class="modal-header">
                    <h1 class="modal-title fs-5" id="exampleModalLabel">Active  Package Version</h1>
                    <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
                </div>

                <form action="renew_package.php" method="POST">
                    <div class="modal-body">
                        <h4 style="color:red">Payment Plan</h4>
                        <p>Please choose your plan!!</p>

                        <input type="radio" id="monthly" name="starter" value="Monthly" required> <label for="monthly"> Monthly(100Ksh/1Usd)</label>

                        <br>
                        <br>
                        <input type="radio" id="yearlys" name="starter" value="Yearlystarter" required> <label for="yearlys"> Starter Yearly(1200Ksh/12Usd)</label>

                        <br>
                        <br>
                        <input type="radio" id="yearlyp" name="starter" value="Yearlyprofessional" required> <label for="yearlyp">Professional Yearly(3000Ksh/30Usd)</label>

                        <br>
                    </div>
                    <div class="modal-footer">
                        <button type="button" class="btn btn-danger" data-bs-dismiss="modal"> <i class="fa fa-times" aria-hidden="true"></i> Close</button>
                        <button type="submit" name="save" id="save" class="btn btn-info" data-toggle="modal" data-target="#exampleModal"> <i class="fa fa-save" aria-hidden="true"></i> Save </button>
                    </div>

                </form>

            </div>
        </div>
    </div>
    <!-- end modal-->


    <script src="js/custom.js"></script>
    <script src="https://cdn.jsdelivr.net/npm/@popperjs/core@2.11.6/dist/umd/popper.min.js" integrity="sha384-oBqDVmMz9ATKxIep9tiCxS/Z9fNfEXiDAYTujMAeBAsjFuCZSmKbSSUnQlmh/jp3" crossorigin="anonymous"></script>
    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0-alpha1/dist/js/bootstrap.min.js" integrity="sha384-mQ93GR66B00ZXjt0YO5KlohRA5SY2XofN4zfuZxLkoj1gXtW8ANNCe9d5Y3eG5eD" crossorigin="anonymous"></script>
</body>

</html>