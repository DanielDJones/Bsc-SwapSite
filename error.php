<?php
/* Displays all error messages */
session_start();
?>
<!DOCTYPE html>
<html>
<head>
  <link href="https://fonts.googleapis.com/icon?family=Material+Icons" rel="stylesheet">
  <link type="text/css" rel="stylesheet" href="css/materialize.min.css"  media="screen,projection"/>
  <meta name="viewport" content="width=device-width, initial-scale=1.0"/>
  <meta charset="UTF-8">
  <title>Error</title>
</head>
<body>
<div class="form">
  <div class="row">
    <div class="col s12">
      <div class="card yellow darken-2">
        <div class="card-content white-text">
          <span class="card-title">Error</span>
          <?php
          if( isset($_SESSION['message']) AND !empty($_SESSION['message']))
              {?>
                <p><?=$_SESSION['message']; ?> <a href="index.html">Back To Home</a></p>
          <?php }
          else {
              header( "location: index.php" );
          }
          ?>
        </div>
      </div>
    </div>
  </div>


</div>
<script type="text/javascript" src="https://code.jquery.com/jquery-3.2.1.min.js"></script>
<script type="text/javascript" src="js/materialize.min.js"></script>
</body>
</html>
