<?php

// officer and teacher registration process 

$fname = $_POST["fname"];
$lname = $_POST["lname"];
$fullname = $_POST["fullname"];
$bdy = $_POST["bdy"];
$title = $_POST["title"];
$adline1 = $_POST["adline1"];
$adline2 = $_POST["adline2"];
$city = $_POST["city"];
$nic = $_POST["nic"];
$contact = $_POST["contact"];
$username = $_POST["username"];
$email = $_POST["email"];
$password = $_POST["password"];
$vcode = $_POST["vcode"];
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
} elseif ($title == "0") {
    echo "Please select your title";
} elseif (empty($adline1)) {
    echo "Please enter your address line 01";
} elseif (empty($adline2)) {
    echo "Please enter your address line 02";
} elseif (empty($city)) {
    echo "Please enter your city";
} elseif (empty($nic)) {
    echo "Please enter your nic number";
} elseif (preg_match("/^([0-9]{9}[x|X|v|V]|[0-9]{12})$/", $nic) == 0) {
    echo  "Invalid nic number";
} elseif (empty($contact)) {
    echo  "Please enter your contact number";
} elseif (strlen($contact) != 10) {
    echo  "Please enter 10 digit contact number";
} elseif (preg_match("/07[0,1,2,,4,5,6,7,8][0-9]+/", $contact) == 0) {
    echo  "Invalid contact number";
} elseif (empty($username)) {
    echo  "Please enter your username";
} elseif (empty($email)) {
    echo  "Please enter your email";
} elseif (strlen($email) > 100) {
    echo "email must be less than 100 characters";
} elseif (!filter_var($email, FILTER_VALIDATE_EMAIL)) {
    echo  "Invalid email address";
} elseif (empty($password)) {
    echo  "Please enter your password";
} elseif (empty($vcode)) {
    echo  "Please enter your verification code";
} elseif ($agree == "false") {
    echo  "Please agree to the terms.";
} else {
    include "connection.php";

    // search details 
    $r = Database::search("SELECT * FROM `user` WHERE `fullname`='" . $fullname . "' AND `email`='" . $email . "' 
    AND `mobile`='" . $contact . "' AND `username`='" . $username . "' AND `password`='" . $password . "' AND `verification_code`='" . $vcode . "'");
    
    if ($r->num_rows == 1) {
        // if correct user, update other details 
        $rd = $r->fetch_assoc();

        $user_id=$rd["id"];

        $rt = Database::search("SELECT * FROM `user_title` WHERE `id`='" . $title . "'");
        $rtd = $rt->fetch_assoc();
        $gender_id = $rtd["gender_id"];

        $login_status_id = 1;

        $city_id;
        $rc = Database::search("SELECT * FROM `city` WHERE `name`='" . $city . "'");
        if ($rc->num_rows > 0) {
            $cityresult = $rc->fetch_assoc();
            $city_id = $cityresult["id"];
        } else {
            Database::iud("INSERT INTO `city`(`name`) VALUES('" . $city . "')");
            $city_id = Database::$connection->insert_id;
        }

        Database::iud("INSERT INTO `address`(`line1`,`line2`,`city_id`) 
        VALUES('" . $adline1 . "','" . $adline2 . "','" . $city_id . "')");
        $address_id = Database::$connection->insert_id;

        Database::iud("UPDATE `user` SET `fname`='" . $fname . "',`lname`='" . $lname . "',`fullname`='" . $fullname . "',`birthday`='" . $bdy . "',
        `gender_id`='" . $gender_id . "',`nic`='" . $nic . "',`user_title_id`='" . $title . "',`address_id`='" . $address_id . "',
        `login_status_id`='" . $login_status_id . "' WHERE `id`='" . $user_id . "'");

        $result = Database::search("SELECT * FROM `user` WHERE `id`='" . $user_id . "'");
        $s = $result->fetch_assoc();
        $_SESSION["user"] = $s;
        echo  "success";

    } else {
        echo "You are invalid user. Please check again.";
    }
}
