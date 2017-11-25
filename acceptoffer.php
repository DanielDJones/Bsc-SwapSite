<?php
require 'dbconnect.php';
session_start();

$offerID = $mysqli->escape_string($_GET['id']);

$result = $mysqli->query("SELECT * FROM OFFER WHERE OFFERID= $offerID ") or die($mysqli->error());
$offer = $result->fetch_assoc();
$listingID = $offer['LISTINGID'];

  $sql = "UPDATE OFFER SET OFFERACCEPTED = '1' WHERE OFFER.OFFERID = $offerID ";
  if ( $mysqli->query($sql) ){
    $sql = "UPDATE LISTING SET LISTINGACTIVE = '2' WHERE LISTING.LISTINGID = $listingID ";
    if ( $mysqli->query($sql) ){
        header("location: ongoingswaps.php");
      }
      else {
        $_SESSION['message'] = 'Edit failed!';
        header("location: error.php");
      }
    }
    else {
      $_SESSION['message'] = 'Edit failed!';
      header("location: error.php");
    }

?>
