<?php
require 'dbconnect.php';
session_start();

$accountId = $_SESSION['accountID'];


//Listings

$activeListQ = "SELECT * FROM LISTING WHERE LISTINGACTIVE = 1 AND ACCOUNTID = $accountId ORDER BY LISTINGCDATE ";
$activeListR = mysqli_query($mysqli, $activeListQ);
$inactiveListQ = "SELECT * FROM LISTING WHERE LISTINGACTIVE = 0 AND ACCOUNTID = $accountId ORDER BY LISTINGCDATE ";
$inactiveListR = mysqli_query($mysqli, $inactiveListQ);

$getCustID = $mysqli->query("SELECT * FROM Cust WHERE ACCOUNTID='$accountId'");
$getCUSTID2 = $getCustID->fetch_assoc();
$custID = $getCUSTID2['CUSTID'];

// Offers
$activeOfferQ = "SELECT * FROM OFFER, LISTING WHERE LISTINGACTIVE = 1 AND CUSTID = $custID ORDER BY LISTINGCDATE ";
$activeOfferR = mysqli_query($mysqli, $activeOfferQ);
$inactiveOfferQ = "SELECT * FROM OFFER, LISTING WHERE LISTINGACTIVE = 0 AND CUSTID = $custID AND OFFERACCEPTED = 2 ORDER BY LISTINGCDATE ";
$inactiveOfferR = mysqli_query($mysqli, $inactiveOfferQ);

//Confirm
$confirmListQ = "SELECT * FROM LISTING WHERE LISTINGACTIVE = 2 AND ACCOUNTID = $accountId ORDER BY LISTINGCDATE ";
$confirmListR = mysqli_query($mysqli, $confirmListQ);
$confirmOfferQ = "SELECT * FROM OFFER, LISTING WHERE LISTINGACTIVE = 2 AND CUSTID = $custID ORDER BY LISTINGCDATE ";
$confirmOfferR = mysqli_query($mysqli, $confirmOfferQ);
 ?>

<!DOCTYPE html>
<html>
<head>
  <link href="https://fonts.googleapis.com/icon?family=Material+Icons" rel="stylesheet">
  <link type="text/css" rel="stylesheet" href="css/materialize.min.css"  media="screen,projection"/>
  <meta name="viewport" content="width=device-width, initial-scale=1.0"/>
  <meta charset="UTF-8">
  <title>My Swaps</title>
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

<?php
while(TRUE){

  $row = mysqli_fetch_array($confirmListR, MYSQLI_ASSOC);
  if($row == NULL)
  {
    $listingsLeft = 0;
    break;
  }
  $listingTitle = $row['COMPONENTNAME'];
  $listingDesc = $row['COMPONENTDESC'];
  $listingTime = $row['LISTINGCDATE'];
  $listingDesc = substr($listingDesc, 0, 100)."...";
  $listingID = $row['LISTINGID'];
  $getOfferIdQ = $mysqli->query("SELECT * FROM OFFER WHERE LISTINGID = $listingID and OFFERACCEPTED = 1 ");
  $getOfferIdR = $getOfferIdQ->fetch_assoc();
  $offerID = $getOfferIdR['OFFERID'];

 ?>

<div class="row">
  <div class="col s12">
    <div class="card green darken-3 white-text horizontal">
      <div class="card-image">
        <img src="http://via.placeholder.com/400x400">
      </div>
      <div class="card-stacked">
        <div class="card-content">
          <span class="card-title"><?=$listingTitle ?></span>
          <p><?=$listingDesc ?></p>
        </div>
        <div class="card-action">
          <a href="confirmswap.php?id=<?=$offerID?>">Confrim</a>
        </div>
      </div>
    </div>
  </div>
</div>
<?php } ?>

<?php
while(TRUE){

  $row = mysqli_fetch_array($confirmOfferR, MYSQLI_ASSOC);
  if($row == NULL)
  {
    $listingsLeft = 0;
    break;
  }
  $listingTitle = $row['COMPONENTNAME'];
  $listingDesc = $row['COMPONENTDESC'];
  $listingTime = $row['LISTINGCDATE'];
  $listingDesc = substr($listingDesc, 0, 100)."...";
  $listingID = $row['LISTINGID'];
  $offerID = $row['OFFERID'];

 ?>

<div class="row">
  <div class="col s12">
    <div class="card green darken-3 white-text horizontal">
      <div class="card-image">
        <img src="http://via.placeholder.com/400x400">
      </div>
      <div class="card-stacked">
        <div class="card-content">
          <span class="card-title"><?=$listingTitle ?></span>
          <p><?=$listingDesc ?></p>
        </div>
        <div class="card-action">
          <a href="confirmswap.php?id=<?=$offerID?>">Confrim</a>
        </div>
      </div>
    </div>
  </div>
</div>
<?php } ?>

<div class="row">
  <div class="col s12">
    <div class="card yellow darken-2">
      <div class="card-content white-text">
        <span class="card-title">My Current Listings</span>
      </div>
    </div>
  </div>
</div>
<?php
while(TRUE){

  $row = mysqli_fetch_array($activeListR, MYSQLI_ASSOC);
  if($row == NULL)
  {
    $listingsLeft = 0;
    break;
  }
  $listingTitle = $row['COMPONENTNAME'];
  $listingDesc = $row['COMPONENTDESC'];
  $listingTime = $row['LISTINGCDATE'];
  $listingDesc = substr($listingDesc, 0, 100)."...";
  $listingID = $row['LISTINGID'];
 ?>

<div class="row">
  <div class="col s12">
    <div class="card green darken-3 white-text horizontal">
      <div class="card-image">
        <img src="http://via.placeholder.com/400x400">
      </div>
      <div class="card-stacked">
        <div class="card-content">
          <span class="card-title"><?=$listingTitle ?></span>
          <p><?=$listingDesc ?></p>
        </div>
        <div class="card-action">
          <a href="listing.php?id=<?=$listingID?>">View listing: <?=$listingTime ?></a>
        </div>
      </div>
    </div>
  </div>
</div>
<?php } ?>

<div class="row">
  <div class="col s12">
    <div class="card yellow darken-2">
      <div class="card-content white-text">
        <span class="card-title">My Current Offers</span>
      </div>
    </div>
  </div>
</div>

<?php
while(TRUE){

  $row = mysqli_fetch_array($activeOfferR, MYSQLI_ASSOC);
  if($row == NULL)
  {
    $listingsLeft = 0;
    break;
  }
  $offerDesc = $row['OFFERDESC'];
  $creditsOfferd = $row['CURRENCYOFFERD'];
  $listingID = $row['LISTINGID'];

 ?>

<div class="row">
  <div class="col s12">
    <div class="card yellow darken-3 white-text horizontal">
      <div class="card-stacked">
        <div class="card-content">
          <span class="card-title">Offer</span>
          <p><?=$offerDesc ?></p>
          <p>Credits Offerd: <?=$creditsOfferd ?></p>
        </div>
        <div class="card-action">
          <a href="listing.php?id=<?=$listingID?>">View listing: <?=$listingTime ?></a>
        </div>
      </div>
    </div>
  </div>
</div>
<?php } ?>

<div class="row">
  <div class="col s12">
    <div class="card yellow darken-2">
      <div class="card-content white-text">
        <span class="card-title">Swap History</span>
      </div>
    </div>
  </div>
</div>

<?php
while(TRUE){

  $row = mysqli_fetch_array($inactiveListR, MYSQLI_ASSOC);
  if($row == NULL)
  {
    $listingsLeft = 0;
    break;
  }
  $listingTitle = $row['COMPONENTNAME'];
  $listingDesc = $row['COMPONENTDESC'];
  $listingTime = $row['LISTINGCDATE'];
  $listingDesc = substr($listingDesc, 0, 100)."...";
  $listingID = $row['LISTINGID'];
 ?>

<div class="row">
  <div class="col s12">
    <div class="card green darken-3 white-text horizontal">
      <div class="card-image">
        <img src="http://via.placeholder.com/400x400">
      </div>
      <div class="card-stacked">Offer
        <div class="card-content">
          <span class="card-title"><?=$listingTitle ?></span>
          <p><?=$listingDesc ?></p>
        </div>
        <div class="card-action">
          <a href="listing.php?id=<?=$listingID?>">View listing: <?=$listingTime ?></a>
        </div>
      </div>
    </div>
  </div>
</div>
<?php } ?>

<div class="row">
  <div class="col s12">
    <div class="card yellow darken-2">
      <div class="card-content white-text">
        <span class="card-title">Accepted Offer History</span>
      </div>
    </div>
  </div>
</div>

<?php
while(TRUE){

  $row = mysqli_fetch_array($inactiveOfferR, MYSQLI_ASSOC);
  if($row == NULL)
  {
    $listingsLeft = 0;
    break;
  }
  $offerDesc = $row['OFFERDESC'];
  $creditsOfferd = $row['CURRENCYOFFERD'];
  $listingID = $row['LISTINGID'];

 ?>

<div class="row">
  <div class="col s12">
    <div class="card green darken-3 white-text horizontal">
      <div class="card-stacked">
        <div class="card-content">
          <span class="card-title">Offer</span>
          <p><?=$offerDesc ?></p>
          <p>Credits Offerd: <?=$creditsOfferd ?></p>
        </div>
        <div class="card-action">
          <a href="listing.php?id=<?=$listingID?>">View listing</a>
        </div>
      </div>
    </div>
  </div>
</div>
<?php } ?>

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
