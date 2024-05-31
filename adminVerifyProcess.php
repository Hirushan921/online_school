<?php

require "connection.php";
session_start();

$vc = $_POST["verification_code"];

if (empty($vc)) {
    echo "Add the verification code first.";

} else {
    // search code 
    $adminvrs = Database::search("SELECT * FROM `user` WHERE `verification_code`='" . $vc . "'");
    $avn = $adminvrs->num_rows;

    if ($avn == 1) {
        $avr = $adminvrs->fetch_assoc();
        //add session
        $_SESSION["user"] = $avr;

        echo "success";

    } else {
        echo "You must enter a valid verification code to log in.";
    }
}

?>