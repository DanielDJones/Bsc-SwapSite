<?php
session_start();
require 'dbconnect.php';
if ($_SERVER['REQUEST_METHOD'] == 'POST')
{
    if (isset($_POST['login'])) {

        require 'loginBackend.php';

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

 <form role="form" action="login.php" method="post" class="col s12">

   <!--<div class="row">
     <div class="input-field col s12">
       <input id="cpassword" type="password" class="validate" name="cpassword">
       <label for="cpassword">Confirm Password</label>
     </div>
   </div>-->
   <div class="row">
     <div class="input-field col s12">
       <input id="email" type="email" class="validate" name="email">
       <label for="email">Email</label>
     </div>
   </div>
   <div class="row">
     <div class="input-field col s12">
       <input id="password" type="password" class="validate" name="password">
       <label for="password">Password</label>
     </div>
   </div>
   <div class="row center">
      <button type="submit" class="btn-large waves-effect waves-light black-text yellow" name="login" />Login</button>
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
