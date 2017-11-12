<?php
session_start();
require 'dbconnect.php';
if ($_SERVER['REQUEST_METHOD'] == 'POST')
{
    if (isset($_POST['edit'])) {

        require 'editProfileBackend.php';

    }
}
?>

<!DOCTYPE html>
  <html>
    <head>
      <link href="https://fonts.googleapis.com/icon?family=Material+Icons" rel="stylesheet">
      <link type="text/css" rel="stylesheet" href="css/materialize.min.css"  media="screen,projection"/>
      <link rel="stylesheet" href="css/style.css">
      <meta name="viewport" content="width=device-width, initial-scale=1.0"/>
      <meta charset="UTF-8">
      <title>Login</title>
    </head>

    <body>
      <div class="container">
        <div class="row">
          <div class="col s12">
            <div class="card green darken-1">
              <div class="card-content white-text">
                <div class="row">

 <form role="form" action="editProfile.php" method="post" class="col s12">

   <!--<div class="row">
     <div class="input-field col s12">
       <input id="cpassword" type="password" class="validate" name="cpassword">
       <label for="cpassword">Confirm Password</label>
     </div>
   </div>-->
   <div class="row">
     <div class="input-field col s12">
       <input id="bio" type="text" class="validate" name="bio">
       <label for="bio">Bio</label>
     </div>
   </div>
   <div class="row">
     <div class="input-field col s12">
       <input id="username" type="text" class="validate" name="username">
       <label for="username">Username</label>
     </div>
   </div>
   <div class="row center">
      <button type="submit" class="btn-large waves-effect waves-light black-text yellow" name="edit" />Submit</button>
   </div>
 </form>
</div>
              </div>
            </div>
          </div>
        </div>
      </div>

      <script type="text/javascript" src="https://code.jquery.com/jquery-3.2.1.min.js"></script>
      <script type="text/javascript" src="js/materialize.min.js"></script>
    </body>
  </html>
