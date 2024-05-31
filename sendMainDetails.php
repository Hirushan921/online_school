<?php
session_start();

   include "connection.php";

$fullname = $_POST["fullname"];
$email = $_POST["email"];
$mobile = $_POST["mobile"];



if (empty($fullname)) {
    echo "Please enter your full name";
} elseif (empty($email)) {
    echo  "Please enter your email";
} elseif (strlen($email) > 100) {
    echo "email must be less than 100 characters";
} elseif (!filter_var($email, FILTER_VALIDATE_EMAIL)) {
    echo  "Invalid email address";
} elseif (empty($mobile)) {
    echo  "Please enter your mobile";
} elseif (strlen($mobile) != 10) {
    echo  "Please enter 10 digit mobile number";
} elseif (preg_match("/07[0,1,2,,4,5,6,7,8][0-9]+/", $mobile) == 0) {
    echo  "Invalid mobile number";
} else {
 
// search user 
    $r = Database::search("SELECT * FROM `user` WHERE `email`='" . $email . "'");
    if ($r->num_rows > 0) {
        echo  "This user with this email already exists.";

        //if no user, 
    } else {
        $login_status_id = 2;
        $user_type_id = $_SESSION["uti"];
        $email_status_id=2;

// insert main details for approval 
        Database::iud("INSERT INTO user(`fullname`,`email`,`mobile`,`user_type_id`,`login_status_id`,`email_status_id`) 
        VALUES('" . $fullname . "','" . $email . "','" . $mobile . "','" . $user_type_id . "','" . $login_status_id . "','" . $email_status_id . "')");



        echo "success";
    }
}
