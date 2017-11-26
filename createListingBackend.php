<?php

$accountId = $_SESSION['accountID'];
$compName= $mysqli->escape_string($_POST['compName']);
$compDesc = $mysqli->escape_string($_POST['compDesc']);
$locationTown = $mysqli->escape_string($_POST['locationTown']);
$locationDetails = $mysqli->escape_string($_POST['locationDetails']);
$lookingFor = $mysqli->escape_string($_POST['lookingFor']);
$cat = $_POST['cat'];

if ($compName != '' && $compDesc != '' && $locationTown != '' && $locationDetails != '' && $lookingFor != '' && $cat != 'Null'){



$getListID = $mysqli->query("SELECT * FROM LISTING ORDER BY LISTINGID DESC LIMIT 1");
$getListID2 = $getListID->fetch_assoc();
$newListID3 = $getListID2['LISTINGID'];
$newListID3 = (int) $newListID3 + 1;
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
      $fileNameNew = (string)$newListID3.".jpg";
      $fileDestination = 'userimg/listing/'.$fileNameNew;
      move_uploaded_file($fileTmpName, $fileDestination);
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



  $sql = "INSERT INTO LISTING (ACCOUNTID, COMPONENTNAME, COMPONENTDESC, category, LOCATIONTOWN, LOCATIONDETAILS, LOOKINGFOR, LISTINGACTIVE) VALUES ($accountId,'$compName','$compDesc','$cat', '$locationTown', '$locationDetails', '$lookingFor', 1)";
  if ( $mysqli->query($sql) ){
    header("location: profile.php");

  }

  else {
      $_SESSION['message'] = 'Listing Creation Failed!';
      header("location: error.php");
  }
} else {
  $_SESSION['message'] = 'All fields are required!';
  header("location: error.php");
}
