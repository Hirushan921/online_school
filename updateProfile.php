<?php
// update profile process 
require "connection.php";
session_start();

if (isset($_SESSION["user"])) {
    $user_id = $_SESSION["user"]["id"];

    $fname = $_POST["fname"];
    $lname = $_POST["lname"];
    $fullname = $_POST["fullname"];
    $title = $_POST["title"];
    $adline1 = $_POST["adline1"];
    $adline2 = $_POST["adline2"];
    $city = $_POST["city"];


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
    } elseif ($title == "0") {
        echo "Please select your title";
    } elseif (empty($adline1)) {
        echo "Please enter your address line 01";
    } elseif (empty($adline2)) {
        echo "Please enter your address line 02";
    } elseif (empty($city)) {
        echo "Please enter your city";
    } else {

        $address_id = $_SESSION["user"]["address_id"];
        $cr = Database::search("SELECT * FROM `city` WHERE `name`='" . $city . "'");
        $crn = $cr->num_rows;

        $city_id;
        if ($crn >0) {
            $crd = $cr->fetch_assoc();
            $city_id = $crd["id"];
        } else {
            Database::iud("INSERT INTO `city`(`name`) VALUES('" . $city . "')");
            $city_id = Database::$connection->insert_id;
        }

        // update address 
        Database::iud("UPDATE `address` SET `line1`='" . $adline1 . "',`line2`='" . $adline2 . "',`city_id`='" . $city_id . "' WHERE `id`='" . $address_id . "'");

        // update user details 
        Database::iud("UPDATE `user` SET `fname`='" . $fname . "',`lname`='" . $lname . "',`fullname`='" . $fullname . "',`user_title_id`='" . $title . "',`address_id`='" . $address_id . "' WHERE `id`='" . $user_id . "'");

     
        // after update,add session 
        $result = Database::search("SELECT * FROM `user` WHERE `id`='" . $user_id . "'");
        $s = $result->fetch_assoc();
        $_SESSION["user"] = $s;

        echo "success";
    }
}
