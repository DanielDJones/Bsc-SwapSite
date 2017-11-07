<?php
/* Registration process, inserts user info into the database
   and sends account confirmation email message
 */

// Set session variables
$_SESSION['email'] = $_POST['email'];
$_SESSION['username'] = $_POST['username'];
$_SESSION['name'] = $_POST['name'];

$name= $mysqli->escape_string($_POST['name']);
$username = $mysqli->escape_string($_POST['username']);
$email = $mysqli->escape_string($_POST['email']);
$password = $mysqli->escape_string($_POST['password']);



// Check if user with that email already exists
$result = $mysqli->query("SELECT * FROM Account WHERE EMAIL='$email'") or die($mysqli->error());

// We know user email exists if the rows returned are more than 0
if ( $result->num_rows > 0 ) {

    $_SESSION['message'] = 'User with this email already exists!';
    header("location: error.php");

}
else {



    $sql = "INSERT INTO Account (ACCOUNTNAME, USERNAME, EMAIL, PASSWORD) VALUES ('$name','$username','$email','md5($password)')";

    // Add user to the database
    if ( $mysqli->query($sql) ){

        $_SESSION['logged_in'] = true; // So we know the user has logged in

        header("location: profile.php");
    }

    else {
        $_SESSION['message'] = 'Registration failed!';
        header("location: error.php");
    }

}
