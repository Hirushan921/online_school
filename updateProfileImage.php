<?php

// update profile image process 
require "connection.php";
session_start();

if (isset($_SESSION["user"])) {
    $uid = $_SESSION["user"]["id"];

    // search has user image 
    $imgs = Database::search("SELECT * FROM `images` WHERE `user_id`='" . $uid . "'");
    $ir = $imgs->num_rows;
    if ($ir == 1) {
        //  if user has img update that  

        if (isset($_FILES["img"])) {
            $imageFile = $_FILES["img"];
            $fileNewName = $_FILES["img"]["name"];

            $allowed_image_extension = array("jpg", "png", "svg");  // Allow karana img files
            $file_extension = pathinfo($fileNewName, PATHINFO_EXTENSION);  // img eke extension

            // echo $file_extension = $image["type"];

            if (!in_array($file_extension, $allowed_image_extension)) {
                echo "Please Select a Valid Image";
            } else {
                // echo $imageFile["name"];
                $fileName = "resources/profile_img//" . uniqid() . "." . $file_extension;
                move_uploaded_file($imageFile["tmp_name"], $fileName);

                Database::iud("UPDATE `images` SET `path`='" . $fileName . "' WHERE `user_id`='" . $uid . "'");

                echo "success";
            }
        }
    } else {

        // if user has not image insert image 
        if (isset($_FILES["img"])) {
            $imageFile = $_FILES["img"];
            $fileNewName = $_FILES["img"]["name"];

            $allowed_image_extension = array("jpg", "png", "svg");  // Allow karana img files
            $file_extension = pathinfo($fileNewName, PATHINFO_EXTENSION);  // img eke extension

            // echo $file_extension = $image["type"];

            if (!in_array($file_extension, $allowed_image_extension)) {
                echo "Please Select a Valid Image";
            } else {
                // echo $imageFile["name"];
                $fileName = "resources/profile_img//" . uniqid() . "." . $file_extension;
                move_uploaded_file($imageFile["tmp_name"], $fileName);

                Database::iud("INSERT INTO `images` (`path`,`user_id`) VALUES('" . $fileName . "','" . $uid . "')");

                echo "success";
            }
        }
    }
}
