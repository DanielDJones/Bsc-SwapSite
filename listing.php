<?php
require 'dbconnect.php';
session_start();
if ( $_SESSION['logged_in'] != 1 ) {
  $_SESSION['message'] = "You must log in before viewing your profile page!";
  header("location: error.php");
}

$listingID = $mysqli->escape_string($_GET['id']);

$result = $mysqli->query("SELECT * FROM LISTING WHERE LISTINGID= $listingID");
$listing = $result->fetch_assoc();
$postAccountID = $listing['ACCOUNTID'];
echo "<script>alert('$postAccountID')</script>";
$result2 = $mysqli->query("SELECT * FROM Account WHERE ACCOUNTID= $postAccountID");
$postAccount = $result2->fetch_assoc();
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
  <div class="col s12 m8 l10">
    <div class="card yellow darken-2">
      <div class="card-content white-text">
        <span class="card-title">Looking for</span>
        <p><?= $listing['LOOKINGFOR'] ?></p>
      </div>
    </div>
  </div>

</div>


<div class="row">
  <div class="col s12">
    <div class="card yellow darken-2">
      <div class="card-content white-text">
        <span class="card-title">Make a offer</span>
      </div>
    </div>
  </div>
</div>

<div class="row">
  <div class="col s12">
    <div class="card green darken-3">
      <div class="card-content white-text">
        <span class="card-title">Offer</span>
        <div class="row">
          <div class="input-field col s12">
          <textarea id="Offer" class="materialize-textarea"></textarea>
          <label for="Offer">Offer</label>
          </div>
        </div>
        <div class="row center">
          <a href="#" class="btn-large waves-effect waves-light black-text yellow">Submit offer</a>
        </div>
      </div>
    </div>
  </div>
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
