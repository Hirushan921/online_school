<?php
session_start();
$user_type_id = $_POST["user_type_id"];
// echo $user_type_id;
$_SESSION["uti"] = $user_type_id;
echo "ok";

// select user type and add to session 