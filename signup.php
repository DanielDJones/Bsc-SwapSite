<?php

session_start();

if(isset($_SESSION['usr_id'])){
    header("Location:index.php");
}

include_once 'dbconnect.php';

$error = false;

if (isset($_POST['signup'])){
  $name = mysqli_real_escape_string($con, $_POST['name']);
  $username = mysqli_real_escape_string($con, $_POST['username'])
  $username = mysqli_real_escape_string($con, $_POST['email']);;
  $password = mysqli_real_escape_string($con, $_POST['password']);
  $cpassword = mysqli_real_escape_string($con, $_POST['cpassword']);

  //Name validation only letters and spaces
  if(!preg_match("/^[a-zA-Z]+$/",$name)){
      $error = true;
      $name_error = "Name must only contain letters and spaces";
  }
  if(!preg_match("/^[a-zA-Z]+$/",$username)){
      $error = true;
      $username_error = "Username must only contain letters and spaces";
  }
  if(!filter_var($email,FILTER_VALIDATE_EMAIL)){
      $error = true;
      $email_error = "Please enter a valid email address";
  }
  if(strlen($password) < 6){
      $error = true;
      $password_error = "Password must be at least 6 characters long"
  }
  if($password != $cpassword){
      $error = true;
      $cpassword_error = "Passwords do not match"
  }

  if(!$error){
      if(mysqli_query($con,"INSERT INTO account(ACCOUNTNAME, USERNAME, EMAIL, PASSWORD) VALUES(".$name.",".$username.",".$email.",".md5($password).")")){
        $successmsg = "Account Created Welcome to Electro Swap <a href='login.php'>Click here to login</a> ";
      } else {
        $errormsg = "Error Please try again later";
      }
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
      <title>Signup</title>
    </head>

    <body>
      <div class="container">
        <div class="row">
          <div class="col s12">
            <div class="card green darken-1">
              <div class="card-content white-text">
                <div class="row">

 <form class="col s12">
   <div class="row">
     <div class="input-field col s6">
       <input id="first_name" type="text" class="validate">
       <label for="first_name">Name</label>
     </div>
     <div class="input-field col s6">
       <input id="last_name" type="text" class="validate">
       <label for="last_name">Username</label>
     </div>
   </div>

   <div class="row">
     <div class="input-field col s12">
       <input id="password" type="password" class="validate">
       <label for="password">Password</label>
     </div>
   </div>
   <div class="row">
     <div class="input-field col s12">
       <input id="password" type="password" class="validate">
       <label for="password">Confirm Password</label>
     </div>
   </div>
   <div class="row">
     <div class="input-field col s12">
       <input id="email" type="email" class="validate">
       <label for="email">Email</label>
     </div>
   </div>
   <div class="row center">
     <a href="login.php" class="btn-large waves-effect waves-light black-text yellow">Submit</a>
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
