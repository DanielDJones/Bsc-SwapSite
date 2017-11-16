<?php
$accountId = $_SESSION['accountID'];


//Get the Cust ID
$getCustID = $mysqli->query("SELECT * FROM Cust WHERE ACCOUNTID='$accountId'");
$getCUSTID2 = $getCustID->fetch_assoc();
$custID = $getCUSTID2['CUSTID'];

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
