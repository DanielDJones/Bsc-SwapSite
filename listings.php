<?php

require 'dbconnect.php';
session_start();

$query = "SELECT * FROM LISTING WHERE LISTINGACTIVE = 1 ORDER BY LISTINGID ";
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
    <title>Buy Credits</title>
</head>

<body>


<nav class="yellow darken-2">
  <div class="container">
    <div class="nav-wrapper">
      <a href="index.html" class="brand-logo">Electro Swappers</a>
      <ul id="nav-mobile" class="right hide-on-med-and-down">
        <li><a href="createListing.php">Create Listing</a></li>
        <li><a href="profile.php">My Profile</a></li>
        <li><a href="ongoingswaps.php">My Swaps</a></li>
        <li><a href="buycredits.php">Buy Credits</a></li>
      </ul>
    </div>
  </div>
</nav>


<div class="wrapper">
  <div class="row">
    <div class="col s12 m4 l2">
      <div class="card yellow darken-2">
        <div class="card-content white-text">
          <span class="card-title">Filter</span>
          <p>---------------------------------</p>

          <a class='dropdown-button btn green darken-3' href='#' data-activates='resistorDrop'>Resistor</a>
          <p>-</p>
          <a class='dropdown-button btn green darken-3' href='#' data-activates='capacitorDrop'>Capacitor</a>
        </div>
      </div>
    </div>
    <div class="col s12 m8 l10">
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
              <img src="http://via.placeholder.com/400x400">
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



  <!-- Dropdown Structure -->
<ul id='resistorDrop' class='dropdown-content'>
    <li><a href="#!">10uF</a></li>
    <li><a href="#!">20uF</a></li>
    <li><a href="#!">30UF</a></li>
</ul>

<ul id='capacitorDrop' class='dropdown-content'>
    <li><a href="#!">10uF</a></li>
    <li><a href="#!">20uF</a></li>
    <li><a href="#!">30UF</a></li>
</ul>

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
