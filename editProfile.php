<?php
session_start();
require 'dbconnect.php';
if ($_SERVER['REQUEST_METHOD'] == 'POST')
{
  $accountId = $_SESSION['accountID'];

    if (isset($_POST['edit'])) {

      $bio = $mysqli->escape_string($_POST['bio']);


      $sql = "UPDATE Account SET BIO = '$bio' WHERE Account.ACCOUNTID = $accountId";
      if ( $mysqli->query($sql) ){
          header("location: profile.php");
      }
      else {
          $_SESSION['message'] = 'Edit failed!';
          header("location: error.php");
      }

    }
    elseif (isset($_POST['editName'])) {
      $_SESSION['username'] = $_POST['username'];
      $username = $mysqli->escape_string($_POST['username']);

      $sql = "UPDATE Account SET USERNAME = '$username' WHERE Account.ACCOUNTID = $accountId";
      if ( $mysqli->query($sql) ){
          header("location: profile.php");
      }
      else {
          $_SESSION['message'] = 'Edit failed!';
          header("location: error.php");
      }

    }


    elseif (isset($_POST['editImg'])) {

      $file = $_FILES['file'];
      $fileName = $file['name'];
      $fileTmpName = $file['tmp_name'];
      $fileSize = $file['size'];
      $fileError = $file['error'];
      $fileType = $file['type'];

      $fileExt = explode('.', $fileName);
      $fileActualExt = strtolower(end($fileExt));

      $allowed = array('jpg', 'jpeg');

      if (in_array($fileActualExt, $allowed)) {
        if($fileError === 0){
          if ($fileSize < 1000000){
            $fileNameNew = $accountId.".jpg";
            $fileDestination = 'userimg/profile/'.$fileNameNew;
            move_uploaded_file($fileTmpName, $fileDestination);
            header("location: profile.php");
          } else{
            $_SESSION['message'] = 'Your File is to big';
            header("location: error.php");
          }
        } else {
          $_SESSION['message'] = 'There was an error uploading your image';
          header("location: error.php");
        }

      } else {
        $_SESSION['message'] = 'Only .jpg and .jpeg files are allowed!';
        header("location: error.php");
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
      <title>Edit Profile</title>
    </head>

    <body>
      <div class="container">
        <div class="row">
          <div class="col s12">
            <div class="card green darken-1">
              <div class="card-content white-text">
                <div class="row">

 <form role="form" action="editProfile.php" method="post" class="col s12" enctype="multipart/form-data">
   <div class="row">
     <div class="input-field col s12">
       <input id="bio" type="text" class="validate" name="bio">
       <label for="bio">Bio</label>
       <button type="submit" class="btn-large waves-effect waves-light black-text yellow" name="edit" />Change Bio</button>
     </div>
   </div>
 </form>
<form role="form" action="editProfile.php" method="post" class="col s12" enctype="multipart/form-data">
   <div class="row">
     <div class="input-field col s12">
       <input id="username" type="text" class="validate" name="username">
       <label for="username">Username</label>
       <button type="submit" class="btn-large waves-effect waves-light black-text yellow" name="editName" />Change Name</button>
     </div>
   </div>
 </form>
 <form role="form" action="editProfile.php" method="post" class="col s12" enctype="multipart/form-data">
   <div class="row">
     <div class="input-field col s12">
       <input type="file" name="file" class="btn-large waves-effect waves-light black-text yellow">
       <button type="submit" class="btn-large waves-effect waves-light black-text yellow" name="editImg" />Change Profile Picture</button>
     </div>
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
