<?php
require "connection.php";
session_start();

if (isset($_SESSION["user"])) {
    $user_id = $_SESSION["user"]["id"];

    $grade = $_POST["grade"];
  


    if ($grade==0) {
        echo "Please select grade. ";
    } else {
// save student grade 
            Database::iud("INSERT INTO `student_has_grade`(`student_id`,`grade_id`) VALUES('" . $user_id . "','" . $grade . "')");

        echo "success";
    }
}
