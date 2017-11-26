<?php
// Set session variables
$_SESSION['username'] = $_POST['username'];



$username = $mysqli->escape_string($_POST['username']);
$bio = $mysqli->escape_string($_POST['bio']);
$accountId = $_SESSION['accountID'];

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


  $sql = "UPDATE Account SET USERNAME = '$username', BIO = '$bio' WHERE Account.ACCOUNTID = $accountId";
  if ( $mysqli->query($sql) ){
      header("location: profile.php");
  }
  else {
      $_SESSION['message'] = 'Edit failed!';
      header("location: error.php");
  }
