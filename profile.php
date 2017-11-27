<?php

require 'dbconnect.php';
session_start();
if ( $_SESSION['logged_in'] != 1 ) {
  $_SESSION['message'] = "You must log in before viewing your profile page!";
  header("location: error.php");
}

$accountId = $_SESSION['accountID'];
$username = $_SESSION['username'];
$result = $mysqli->query("SELECT * FROM Account WHERE ACCOUNTID= $accountId");
$user = $result->fetch_assoc();
$aboutMe = $user['BIO'];

$query = "SELECT * FROM LISTING WHERE LISTINGACTIVE = 1 AND ACCOUNTID = $accountId ORDER BY LISTINGID ";
$result = mysqli_query($mysqli, $query);

$listingsLeft = 1;

?>

<!DOCTYPE html>
  <html>
    <head>
      <link href="https://fonts.googleapis.com/icon?family=Material+Icons" rel="stylesheet">
      <link type="text/css" rel="stylesheet" href="css/materialize.min.css"  media="screen,projection"/>
      <meta name="viewport" content="width=device-width, initial-scale=1.0"/>
      <meta charset="UTF-8">
      <title>MY Profile</title>
    </head>

    <body>

      <nav class="yellow darken-2">
        <div class="container">
          <div class="nav-wrapper">
            <a href="index.html" class="brand-logo">Electro Swappers</a>
            <ul id="nav-mobile" class="right hide-on-med-and-down">
              <li><a href="listings.php">Listings</a></li>
              <li><a href="logout.php">Logout</a></li>
              <li><a href="ongoingswaps.php">My Swaps</a></li>
            </ul>
          </div>
        </div>
      </nav>

      <div class="wrapper">
        <div class="row">
          <div class="col s12 m4 l2">
            <div class="card green darken-3">
              <div class="card-image">
                <img src="userimg/profile/<?=$accountId?>.jpg">
              </div>

              <div class="card-action white-text">
              </div>
            </div>
          </div>
          <div class="col s12 m8 l10">
            <div class="row">
              <div class="col s12">
                <div class="card yellow darken-2">
                  <div class="card-content white-text">
                    <span class="card-title"><?= $username ?> <a href="editProfile.php" class="btn-large waves-effect waves-light white-text green darken-3">Edit Profile</a></span>
                  </div>
                </div>
              </div>

            </div>
          </div>

        </div>
        <div class="row">
          <div class="col s12">
            <div class="card green darken-3">
              <div class="card-content white-text">
                <span class="card-title">About Me</span>
                <p><?= $aboutMe ?></p>
              </div>
            </div>
          </div>
        </div>
        <div class="row">
          <div class="col s12">
            <div class="card yellow darken-2">
              <div class="card-content white-text">
                <span class="card-title">Current Listings</span>
              </div>
            </div>
          </div>
        </div>

        <div class="row">
          <div class="col s12">
            <?php
            while($listingsLeft == 1){

              $row = mysqli_fetch_array($result, MYSQLI_ASSOC);
              if($row == NULL)
              {
                $listingsLeft = 0;
                break;
              }
              $listingTitle = $row['COMPONENTNAME'];
              $listingDesc = $row['COMPONENTDESC'];
              $listingDesc = substr($listingDesc, 0, 100)."...";
              $listingID = $row['LISTINGID'];
             ?>
            <div class="row">
              <div class="col s12">
                <div class="card green darken-3 white-text horizontal">
                  <div class="card-image">

                  </div>
                  <div class="card-stacked">
                    <div class="card-content">
                      <span class="card-title"><?=$listingTitle ?></span>
                      <p><?=$listingDesc ?></p>
                    </div>
                    <div class="card-action">
                      <a href="listing.php?id=<?=$listingID?>">View listing</a>
                    </div>
                  </div>
                </div>
              </div>
            </div>
          <?php } ?>
          </div>
        </div>

      </div>



      <script type="text/javascript" src="https://code.jquery.com/jquery-3.2.1.min.js"></script>
      <script type="text/javascript" src="js/materialize.min.js"></script>
    </body>
  </html>
