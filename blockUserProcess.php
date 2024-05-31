<?php
session_start();

require "connection.php";
// get user id 
if (isset($_POST["uid"])) {
    $uid = $_POST["uid"];

    // search user 
    $rs = Database::search("SELECT * FROM `user` WHERE `id`='" . $uid . "'");
    if ($rs->num_rows == 1) {
        $rd = $rs->fetch_assoc();

        // search active status 
        $as = $rd["active_status_id"];

        // if active 
        if ($as == "1") {
            Database::iud("UPDATE `user` SET `active_status_id`='2' WHERE `id`='" . $uid . "'");

            echo "success";
            
            // if deactive 
        } else {
            Database::iud("UPDATE `user` SET `active_status_id`='1' WHERE `id`='" . $uid . "'");

            echo "success";
        }

   
    } else {
        echo "User not found";
    }
}
