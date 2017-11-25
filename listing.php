<?php
require 'dbconnect.php';
session_start();
if ( $_SESSION['logged_in'] != 1 ) {
  $_SESSION['message'] = "You must log in before viewing this page";
  header("location: error.php");
}


$listingID = $mysqli->escape_string($_GET['id']);

$result = $mysqli->query("SELECT * FROM LISTING WHERE LISTINGID= $listingID");
$listing = $result->fetch_assoc();
$postAccountID = $listing['ACCOUNTID'];
$result2 = $mysqli->query("SELECT * FROM Account WHERE ACCOUNTID= $postAccountID");
$postAccount = $result2->fetch_assoc();

$custID = $_SESSION['accountID'];

//Get the True Cust ID
$getTCustID = $mysqli->query("SELECT * FROM Cust WHERE ACCOUNTID='$custID'");
$getTCUSTID2 = $getTCustID->fetch_assoc();
$tCustID = $getTCUSTID2['CUSTID'];

$listingOffersQ = "SELECT * FROM OFFER WHERE CUSTID= $tCustID AND LISTINGID = $listingID";
$result = mysqli_query($mysqli, $listingOffersQ);


if ( $result->num_rows == 0 ) {
  //ADD Make offer field
  $offerSet = 0;
}
else {
  //Show Set offer
  $offerSet = 1;
  $result3 = $mysqli->query("SELECT * FROM OFFER WHERE CUSTID= $tCustID");
  $offer = $result3->fetch_assoc();
  $offerDesc = $offer['OFFERDESC'];
  $offerCurr = $offer['CURRENCYOFFERD'];
  $offerID = $offer['OFFERID'];
  if ($offer['OFFERACCEPTED'] == 1) {
    $offerAccepted = "Offer Accepted <button href='confirmswap.php?id=$offerID' class='btn-large waves-effect waves-light white-text green darken-3'/>Confirm Swap</button></span>";
  }
  else {
    $offerAccepted = 0;
  }
}

if ($_SERVER['REQUEST_METHOD'] == 'POST')
{
    if (isset($_POST['submit'])) {

        require 'makeOffer.php';

    }
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
  <div class="col s12 m4 l2">
    <div class="card green darken-3">
      <div class="card-image">
        <img src="http://via.placeholder.com/400x400">
      </div>

      <div class="card-action">
        <a href="#">1</a>
        <a href="#">2</a>
        <a href="#">3</a>
      </div>
    </div>
  </div>
  <div class="col s12 m8 l10">
    <div class="row">
      <div class="col s12">
        <div class="card yellow darken-2">
          <div class="card-content white-text">
            <span class="card-title"><?= $listing['COMPONENTNAME'] ?></span>
          </div>
          <div class="card-action yellow darken-4">
            <a href="viewprofile.php?id=<?=$postAccount['ACCOUNTID'] ?>"><?= $postAccount['USERNAME'] ?></a>
          </div>
        </div>
      </div>
      <div class="col s12">
        <div class="card green darken-3">
          <div class="card-content white-text">
            <span class="card-title">Details</span>
            <p><?= $listing['COMPONENTDESC'] ?></p>
          </div>

        </div>
      </div>
    </div>
  </div>

</div>

<div class="row">
  <div class="col s12 m4 l2">
    <div class="card yellow darken-2">
      <div class="card-content white-text">
        <span class="card-title"><?= $listing['LOCATIONTOWN'] ?></span>
      </div>
    </div>
  </div>
  <div class="col s12 m8 l10">
    <div class="card yellow darken-2">
      <div class="card-content white-text">
        <span class="card-title">Location Details</span>
        <p><?= $listing['LOCATIONDETAILS'] ?></p>
      </div>
    </div>
  </div>
  <div class="col s12 m12 l12">
    <div class="card yellow darken-2">
      <div class="card-content white-text">
        <span class="card-title">Looking for</span>
        <p><?= $listing['LOOKINGFOR'] ?></p>
      </div>
    </div>
  </div>

</div>

<?php if($listing['LISTINGACTIVE'] == 1){ ?>
<div class="row">
  <div class="col s12">
    <div class="card yellow darken-2">
      <div class="card-content white-text">
      <?php if($_SESSION['accountID'] == $listing['ACCOUNTID']){echo "<span class='card-title'>View Offers:<a href='viewlistingoffers.php?id=$listingID'>View</a></span>";} elseif($offerSet == 0){echo "<span class='card-title'>Make a offer</span>";}else{echo "<span class='card-title'>Your offer</span>";}?>
      </div>
    </div>
  </div>
</div>
<?php }if ($_SESSION['accountID'] == $listing['ACCOUNTID']){echo "";}elseif($offerSet == 0){ echo"<script>alert($offerSet)</script>"; echo"<script>alert($custID)</script>;" ?>
  <div class="card green white-text darken-3">
    <form role="form" action="listing.php?id=<?=$listingID?>" method="post" class="col s12">
    <div class="row">
      <div class="input-field col s12">
        <input id="offerB" type="text" class="validate" name="offerB">
        <label for="offerB">Offer</label>
      </div>
    </div>
    <div class="row">
      <div class="input-field col s12">
        <input id="creditsOfferd" type="text" class="validate" name="creditsOfferd">
        <label for="creditsOfferd">Credits Offerd</label>
      </div>
    </div>
    <div class="row center">
       <button type="submit" class="btn-large waves-effect waves-light black-text yellow" name="submit" />Submit Offer</button>
    </div>
  </form>
  </div>
<?php } else {?>
  <div class="row">
    <div class="col s12">
      <div class="card green darken-3">
        <div class="card-content white-text">
          <span class="card-title">Offer</span>
          <div class="row">
            <p><?= $offerDesc ?></p>
            <p>Credits Offerd: <?= $offerCurr ?> <?php if($offerAccepted != 0){$offerAccepted;} ?></p>
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
