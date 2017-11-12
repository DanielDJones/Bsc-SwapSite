<?php
// Set session variables
$_SESSION['username'] = $_POST['username'];

$username = $mysqli->escape_string($_POST['username']);
$bio = $mysqli->escape_string($_POST['bio']);
$accountId = $_SESSION['accountID'];

  $sql = "UPDATE Account SET USERNAME = '$username', BIO = '$bio' WHERE Account.ACCOUNTID = $accountId";
  if ( $mysqli->query($sql) ){
      header("location: profile.php");
  }
  else {
      $_SESSION['message'] = 'Edit failed!';
      header("location: error.php");
  }
