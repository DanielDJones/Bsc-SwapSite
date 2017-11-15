<?php

$accountId = $_SESSION['accountID'];
$compName= $mysqli->escape_string($_POST['compName']);
$compDesc = $mysqli->escape_string($_POST['compDesc']);
$locationTown = $mysqli->escape_string($_POST['locationTown']);
$locationDetails = $mysqli->escape_string($_POST['locationDetails']);
$lookingFor = $mysqli->escape_string($_POST['lookingFor']);
if(!isset($_POST['cat'])){
  $_SESSION['message'] = 'You Forgot to set a catagory!';
  header("location: error.php");
}
$cat = $_POST['cat'];


  $sql = "INSERT INTO LISTING (ACCOUNTID, COMPONENTNAME, COMPONENTDESC, category, LOCATIONTOWN, LOCATIONDETAILS, LOOKINGFOR, LISTINGACTIVE) VALUES ($accountId,'$compName','$compDesc','$cat', '$locationTown', '$locationDetails', '$lookingFor', 1)";
  if ( $mysqli->query($sql) ){
    header("location: profile.php");
  }

  else {
      $_SESSION['message'] = 'Listing Creation Failed!';
      header("location: error.php");
  }
