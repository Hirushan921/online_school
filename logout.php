<?php
session_start();

// logout process 
if (isset($_SESSION["user"])) {
    $_SESSION["user"] = null;
    $_SESSION["uti"] = null;
    session_destroy();


    echo "success";
}
?>