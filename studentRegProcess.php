<?php

// get inputs 

$fname = $_POST["fname"];
$lname = $_POST["lname"];
$fullname = $_POST["fullname"];
$bdy = $_POST["bdy"];
$gender = $_POST["gender"];
$adline1 = $_POST["adline1"];
$adline2 = $_POST["adline2"];
$city = $_POST["city"];
$contact = $_POST["contact"];
$email = $_POST["email"];
$password = $_POST["password"];
$repassword = $_POST["repassword"];
$agree = $_POST["agree"];

if (empty($fname)) {
    echo "Please enter your first name";
} elseif (strlen($fname) > 50) {
    echo "First name must be less than 50 characters";
} elseif (empty($lname)) {
    echo "Please enter your last name";
} elseif (strlen($lname) > 50) {
    echo "Last name must be less than 50 characters";
} elseif (empty($fullname)) {
    echo "Please enter your full name";
} elseif (empty($bdy)) {
    echo "Please enter your birthday";
} elseif ($gender == "0") {
    echo "Please select your gender";
} elseif (empty($adline1)) {
    echo "Please enter your address line 01";
} elseif (empty($adline2)) {
    echo "Please enter your address line 02";
} elseif (empty($city)) {
    echo "Please enter your city";
} elseif (!empty($contact) && strlen($contact) != 10) {
    echo  "Please enter 10 digit mobile number";
} elseif (!empty($contact) && preg_match("/07[0,1,2,,4,5,6,7,8][0-9]+/", $contact) == 0) {
    echo  "Invalid mobile number";
} elseif (empty($email)) {
    echo  "Please enter your email";
} elseif (strlen($email) > 100) {
    echo "email must be less than 100 characters";
} elseif (!filter_var($email, FILTER_VALIDATE_EMAIL)) {
    echo  "Invalid email address";
} elseif (empty($password)) {
    echo  "Please enter your password";
} elseif (strlen($password) < 8 || strlen($password) > 20) {
    echo  "Password length must between 8 to 20";
} elseif ($password != $repassword) {
    echo  "Password doesn't match";
} elseif ($agree == "false") {
    echo  "Please agree to the terms.";
} else {
    include "connection.php";

    // search if user exists
    $r = Database::search("SELECT * FROM `user` WHERE `fullname`='" . $fullname . "' AND `email`='" . $email . "'");
    if ($r->num_rows > 0) {
        echo  "This user with this email already exists.";
    } else {
        $login_status_id = 2;
        $user_type_id = 1;
        $email_status_id = 2;

        // search city 
        $city_id;
        $rc = Database::search("SELECT * FROM `city` WHERE `name`='" . $city . "'");
        if ($rc->num_rows > 0) {
            $cityresult = $rc->fetch_assoc();
            $city_id = $cityresult["id"];
        } else {
            // if no city, insert that
            Database::iud("INSERT INTO `city`(`name`) VALUES('" . $city . "')");
            $city_id = Database::$connection->insert_id;
        }

        // insert address 
        Database::iud("INSERT INTO `address`(`line1`,`line2`,`city_id`) 
        VALUES('" . $adline1 . "','" . $adline2 . "','" . $city_id . "')");
        $address_id = Database::$connection->insert_id;
        
        // insert user details 
        Database::iud("INSERT INTO user(`fname`,`lname`,`fullname`,`birthday`,`gender_id`,`address_id`,`mobile`,`email`,`password`,`user_type_id`,`login_status_id`,`email_status_id`) 
        VALUES('" . $fname . "','" . $lname . "','" . $fullname . "','" . $bdy . "','" . $gender . "','" . $address_id . "','" . $contact . "','" . $email . "','" . $password . "','" . $user_type_id . "','" . $login_status_id . "','".$email_status_id."')");



        echo "success";
    }
}
