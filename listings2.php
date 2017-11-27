<?php

require 'dbconnect.php';
session_start();

$cat = $mysqli->escape_string($_GET['param']);
echo "<script>alert($cat)</script>";
$query = "SELECT * FROM LISTING WHERE LISTINGACTIVE = 1 AND category = '$cat' ORDER BY LISTINGID ";
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
    <title>Listing</title>
</head>

<body>


<nav class="yellow darken-2">
  <div class="container">
    <div class="nav-wrapper">
      <a href="index.html" class="brand-logo">Electro Swappers</a>
      <ul id="nav-mobile" class="right hide-on-med-and-down">
        <li><a href="listings.php">All Listings</a></li>
        <li><a href="profile.php">My Profile</a></li>
        <li><a href="ongoingswaps.php">My Swaps</a></li>
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
              <img src="userimg/listing/<?=$listingID?>.jpg">
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
    <li><a href="listings2.php?param=R330">330 ohm</a></li>
    <li><a href="listings2.php?param=R1K">1K ohm</a></li>
    <li><a href="listings2.php?param=R100K">100K ohm</a></li>
  </ul>

  <ul id='capacitorDrop' class='dropdown-content'>
    <li><a href="listings2.php?param=Cap10">10uF</a></li>
    <li><a href="listings2.php?param=Cap20">20uF</a></li>
    <li><a href="listings2.php?param=Cap30">30UF</a></li>
  </ul>



    <script type="text/javascript" src="https://code.jquery.com/jquery-3.2.1.min.js"></script>
    <script type="text/javascript" src="js/materialize.min.js"></script>
  </body>
</html>
