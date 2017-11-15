<?php

$custID = $_SESSION['accountID'];
$offerB= $mysqli->escape_string($_POST['offerB']);
$offerCred = $mysqli->escape_string($_POST['creditsOfferd']);
$offerCred = (int)$offerCred;

    $sql = "INSERT INTO OFFER (CUSTID, LISTINGID, OFFERDESC, CURRENCYOFFERD) VALUES ($custID,$listingID,'$offerB',$offerCred)";

    if ( $mysqli->query($sql) ){
            header("location: login.php");
    }
    else {
        $_SESSION['message'] = 'Registration failed!';
        header("location: error.php");
    }
