<?php
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
         <form role="form" action="login.php" method="post" class="col s12">
        <div class="row">
          <div class="col s12">
            <div class="card green darken-1">
              <div class="card-content white-text">
                <span class="card-title">Login</span>
                  <div class="input-field white-text">
                    <input id="email" type="text" class="validate" name="email">
                    <label for="email">email</label>
                  </div>
                  <div class="input-field">
                    <input id="password" type="password" class="validate" name="password">
                    <label for="password">Password</label>
                  </div>
                  <div class="row center">
                    <button type="submit" class="btn-large waves-effect waves-light black-text yellow" name="login"/>Login</button>
                  </div>
              </div>
            </div>
          </div>
        </div>
      </form>
      </div>

      <script type="text/javascript" src="https://code.jquery.com/jquery-3.2.1.min.js"></script>
      <script type="text/javascript" src="js/materialize.min.js"></script>
    </body>
  </html>
