<?php require 'dbconnect.php';
session_start();
if ( $_SESSION['logged_in'] != 1 ) {
  $_SESSION['message'] = "You must log in before viewing this page";
  header("location: error.php");
}



$listingID = $mysqli->escape_string($_GET['id']);

$listingOffersQ = "SELECT * FROM OFFER WHERE LISTINGID = $listingID ORDER BY OFFERTIME ";
$listingOffersR = mysqli_query($mysqli, $listingOffersQ);

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
      </ul>
    </div>
  </div>
</nav>

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

  $row = mysqli_fetch_array($listingOffersR, MYSQLI_ASSOC);
  if($row == NULL)
  {
    $listingsLeft = 0;
    break;
  }
  $offerDesc = $row['OFFERDESC'];
  $creditsOfferd = $row['CURRENCYOFFERD'];
  $offerID = $row['OFFERID'];

 ?>

<div class="row">
  <div class="col s12">
    <div class="card green darken-2 white-text horizontal">
      <div class="card-stacked">
        <div class="card-content">
          <span class="card-title">Offer</span>
          <p><?=$offerDesc ?></p>
          <p>Credits Offerd: <?=$creditsOfferd ?></p>
        </div>
        <div class="card-action">
          <a href="acceptoffer.php?id=<?=$offerID?>">Accept Offer</a>
        </div>
      </div>
    </div>
  </div>
</div>
<?php } ?>



<script type="text/javascript" src="https://code.jquery.com/jquery-3.2.1.min.js"></script>
<script type="text/javascript" src="js/materialize.min.js"></script>
</body>
</html>
