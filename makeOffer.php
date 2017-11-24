<?php
$accountId = $_SESSION['accountID'];


//Get the Cust ID
$getCustID = $mysqli->query("SELECT * FROM Cust WHERE ACCOUNTID='$accountId'");
$getCUSTID2 = $getCustID->fetch_assoc();
$custID = $getCUSTID2['CUSTID'];

$offerB= $mysqli->escape_string($_POST['offerB']);
$offerCred = $mysqli->escape_string($_POST['creditsOfferd']);

    $sql = "INSERT INTO OFFER (CUSTID, LISTINGID, OFFERDESC, CURRENCYOFFERD) VALUES ($custID,$listingID,'$offerB',$offerCred)";

    if ( $mysqli->query($sql) ){
            header("location: listing.php?id=$listingID");
    }
    else {
        $_SESSION['message'] = 'Failed to make an offer!';
        header("location: error.php");
    }
