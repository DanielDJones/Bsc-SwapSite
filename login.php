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
                <span class="card-title">Login</span>
                  <div class="input-field white-text">
                    <input id="first_name" type="text" class="validate">
                    <label for="first_name">Username</label>
                  </div>
                  <div class="input-field">
                    <input id="last_name" type="password" class="validate">
                    <label for="last_name">Password</label>
                  </div>
                  <div class="row center">
                    <a href="login.php" class="btn-large waves-effect waves-light black-text yellow">Login</a>
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
