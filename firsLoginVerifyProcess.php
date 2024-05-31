<?php
// if first login,

require "connection.php";
session_start();

$vc = $_POST["vcode"];

if (empty($vc)) {
    echo "Add the verification code first.";

} else {
    
    // search code 
    $flq = Database::search("SELECT * FROM `user` WHERE `verification_code`='" . $vc . "'");
    $fln = $flq->num_rows;

    if ($fln == 1) {
        $fld = $flq->fetch_assoc();
        $user_id = $fld["id"];

        // update verify 
     Database::iud("UPDATE `user` SET `login_status_id`='1' WHERE `id`='".$user_id."' ");
        
        $_SESSION["user"] = $fld;

        echo "success";

    } else {
        echo "You must enter a valid verification code to log in.";
    }
}

?>