<?php
$email = $mysqli->escape_string($_POST['email']);
$result = $mysqli->query("SELECT * FROM Account WHERE email='$email'");

if ( $result->num_rows == 0 ){
    $_SESSION['message'] = "User with that email doesn't exist!";
    header("location: error.php");
}
else {
    $user = $result->fetch_assoc();
    $password = $mysqli->escape_string($_POST['password']);
    $password = md5($password);
    if ( $password == $user['PASSWORD']) {

        //Store data from db into session
        $_SESSION['email'] = $user['EMAIL'];
        $_SESSION['name'] = $user['ACCOUNTNAME'];
        $_SESSION['username'] = $user['USERNAME'];
        $_SESSION['logged_in'] = true;

        header("location: profile.php");
    }
    else {
        $_SESSION['message'] = "You have entered wrong password, try again!";
        header("location: error.php");
    }
}
