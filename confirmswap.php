<?php
require 'dbconnect.php';
session_start();
if ( $_SESSION['logged_in'] != 1 ) {
  $_SESSION['message'] = "You must log in before viewing this page";
  header("location: error.php");
}




$offerID = $mysqli->escape_string($_GET['id']);

$result = $mysqli->query("SELECT * FROM OFFER WHERE OFFERID= $offerID ") or die($mysqli->error());
$offer = $result->fetch_assoc();

$listingID = $offer['LISTINGID'];
$custID = $offer['CUSTID'];
$offerAccepted = $offer['OFFERACCEPTED'];

$listingAccountAccepted = $offer['OFFERDONELIST'];
$offerAccountAccepted = $offer['OFFERDONEPOST'];

if ($offerAccountAccepted == 1 and $listingAccountAccepted = 1)
{
  $sql = "UPDATE OFFER SET OFFERDONELIST = '1' WHERE OFFER.OFFERID = $offerID ";
  if ( $mysqli->query($sql) ){
      header("location: confirmswap.php");
  }
  else {
      $_SESSION['message'] = 'Edit failed!';
      header("location: error.php");
  }
}

if ($_SERVER['REQUEST_METHOD'] == 'POST')
{
    if (isset($_POST['submit'])) {

      if ($_SESSION['accountID'] == $accountID)
      {
        $sql = "UPDATE OFFER SET OFFERDONELIST = '1' WHERE OFFER.OFFERID = $offerID ";
        if ( $mysqli->query($sql) ){
            header("location: confirmswap.php");
        }
        else {
            $_SESSION['message'] = 'Updateing OFFERDONELIST failed';
            header("location: error.php");
        }
      }
      else {
        $sql = "UPDATE OFFER SET OFFERDONEPOST = '1' WHERE OFFER.OFFERID = $offerID ";
        if ( $mysqli->query($sql) ){
            header("location: confirmswap.php");
        }
        else {
            $_SESSION['message'] = 'Updateing OFFERDONELIST failed';
            header("location: error.php");
        }
      }

    }
}


if ($offerAccepted = 0){
  $_SESSION['message'] = "This swap has not been accepted by the listing creator";
  header("location: error.php");
}

elseif ($offerAccepted = 2){
  $_SESSION['message'] = "This swap has been completed";
  header("location: error.php");
}


$result2 = $mysqli->query("SELECT * FROM Account WHERE ACCOUNTID= $custID ") or die($mysqli->error());
$offerAccount = $result2->fetch_assoc();

$result3 = $mysqli->query("SELECT * FROM Account WHERE ACCOUNTID= $accountID ") or die($mysqli->error());
$listingAccount = $result3->fetch_assoc();

$result4 = $mysqli->query("SELECT * FROM LISTING WHERE LISTINGID= $listigID ") or die($mysqli->error());
$listing = $result4->fetch_assoc();

$listingTitle = $listing['COMPONENTNAME'];

$listingAccountUsername = $listingAccount['USERNAME'];
$listingAccountEmail = $listingAccount['EMAIL'];
$offerAccountUsername = $listingAccount['USERNAME'];
$offerAccountEmail = $offerAccount['EMAIL'];




if ($listingAccountAccepted == 1){
  $displayAcceptedList = "Listing creator has accepted";
}
else {
  $displayAcceptedList = "Listing creator has not accepted";
}

if ($offerAccountAccepted == 1){
  $displayAcceptedPost = "Offer creator has accepted";
}
else {
  $displayAcceptedPost = "Offer creator has not accepted";
}

?>
<!DOCTYPE html>
<html>
<head>
  <link href="https://fonts.googleapis.com/icon?family=Material+Icons" rel="stylesheet">
  <link type="text/css" rel="stylesheet" href="css/materialize.min.css"  media="screen,projection"/>
  <meta name="viewport" content="width=device-width, initial-scale=1.0"/>
  <meta charset="UTF-8">
  <title>Listing</title>
</head>
<body>

<nav class="yellow darken-2">
  <div class="container">
    <div class="nav-wrapper">
      <a href="index.html" class="brand-logo">Electro Swappers</a>
      <ul id="nav-mobile" class="right hide-on-med-and-down">
        <li><a href="listings.php">Listings</a></li>
        <li><a href="profile.php">My Profile</a></li>
        <li><a href="ongoingswaps.php">My Swaps</a></li>
        <li><a href="buycredits.php">Buy Credits</a></li>
      </ul>
    </div>
  </div>
</nav>

<div class="row">
  <div class="col s12">
    <div class="row">
      <div class="col s12">
        <div class="card yellow darken-2">
          <div class="card-content white-text">
            <span class="card-title"><?= $listing['COMPONENTNAME'] ?></span>
            <p><?= $listingAccountUsername ?>`s email: <?= $listingAccountEmail ?></p>
            <p><?= $offerAccountUsername ?>`s email: <?= $offerAccountEmail ?></p>
            <p><?= $displayAcceptedList ?></p>
            <p><?= $displayAcceptedPost ?></p>
          </div>
        </div>
      </div>
    </div>
  </div>
</div>




<div class="row">
  <div class="col s12">

    <form role="form" action="listing.php?id=<?=$listingID?>" method="post" class="col s12">

    <div class="row center">
       <button type="submit" class="btn-large waves-effect waves-light black-text yellow" name="submit" />Confirm Swap</button>
    </div>


<footer class="page-footer green darken-2">
  <div class="footer-copyright">
    <div class="container">
    © 2017 Daniel Jones
    <a class="grey-text text-lighten-4 right" href="#x">Back to top</a>
    </div>
  </div>
</footer>

  <script type="text/javascript" src="https://code.jquery.com/jquery-3.2.1.min.js"></script>
  <script type="text/javascript" src="js/materialize.min.js"></script>
</body>
</html>
