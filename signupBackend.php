<?php

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

if ( $result->num_rows > 0 ) {

    $_SESSION['message'] = 'User with this email already exists!';
    header("location: error.php");

}
else {


    $password = md5($password);
    $sql = "INSERT INTO Account (ACCOUNTNAME, USERNAME, EMAIL, PASSWORD) VALUES ('$name','$username','$email','$password')";

    if ( $mysqli->query($sql) ){

        header("location: login.php");
    }

    else {
        $_SESSION['message'] = 'Registration failed!';
        header("location: error.php");
    }

}
