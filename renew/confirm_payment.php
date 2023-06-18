<?php

include "../connection.php";
session_start();

if (isset($_POST['pay'])) {

    $current_user_id = $_SESSION['userid'];

    //echo $current_user_id;

    $userstatus = "Paid";

    $amount =  $_POST['amount']; //Amount to transact 
    $phonenumber = $_POST['number']; // Phone number paying
    $Account_no = '0716660942'; // Enter account number optional
    $url = 'https://tinypesa.com/api/v1/express/initialize';
    $data = array(
        'amount' => $amount,
        'msisdn' => $phonenumber,
        'account_no' => $Account_no
    );
    $headers = array(
        'Content-Type: application/x-www-form-urlencoded',
        'ApiKey: WIAtw77Bl0l' // Replace with your api key
    );
    $info = http_build_query($data);
    $curl = curl_init();
    curl_setopt($curl, CURLOPT_URL, $url);
    curl_setopt($curl, CURLOPT_POST, true);
    curl_setopt($curl, CURLOPT_POSTFIELDS, $info);
    curl_setopt($curl, CURLOPT_RETURNTRANSFER, true);
    curl_setopt($curl, CURLOPT_HTTPHEADER, $headers);
    $resp = curl_exec($curl);

    // Check for CURL errors
    if ($resp === false) {
        echo "CURL ERROR: " . curl_error($curl);
    } else {
        $msg_resp = json_decode($resp);
        // Check if the request was successful
        if ($msg_resp->success == 'true') {

            //echo "<script>alert('WAIT FOR STK POPUP!');
            //    window.location='loader20.php'
            //</script>";
            echo "WAIT FOR STK POPUP";
            //echo "✔✔ TinyPesa transaction initialized successfully. With request id " . $msg_resp->request_id ."";

        } else {
            // Handle any errors returned by the API
            echo "ERROR: " . $resp;
        }
    }
}
