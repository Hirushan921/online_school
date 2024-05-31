<?php
session_start();

use PHPMailer\PHPMailer\PHPMailer;

require 'Exception.php';
require 'PHPMailer.php';
require 'SMTP.php';

require "connection.php";
// get inputs 
$uti = $_POST["uti"];
$username = $_POST["username"];
$password = $_POST["password"];
$remember = $_POST["remember"];


if (empty($username)) {
    echo "Please enter your username.";
} elseif (empty($password)) {
    echo "Please enter your password.";
} else {
    $usersq = Database::search("SELECT * FROM `user` WHERE `username`='" . $username . "' AND `password`='" . $password . "' AND `user_type_id`='" . $uti . "'");
    $un = $usersq->num_rows;

    if ($un == 1) {
        // if correct user 
        $usersd = $usersq->fetch_assoc();

        $active_status_id = $usersd["active_status_id"];

        $login_status_id = $usersd["login_status_id"];

        $email_status_id = $usersd["email_status_id"];

        // check user active status  
        if ($active_status_id == 1) {

            // if not blocked
            if ($uti == 2 || $uti == 3) {
                // if teacher or officer 
                if ($login_status_id == 1) {
                    echo "success";
                    $_SESSION["user"] = $usersd;

                    if ($remember == "true") {
                        setcookie("u", $username, time() + (60 * 60 * 24 * 30));
                        setcookie("p", $password, time() + (60 * 60 * 24 * 30));
                    } else {
                        setcookie("u", "", -1);
                        setcookie("p", "", -1);
                    }
                } else {
                    echo "your registration not compleate.. please follow registration link..";
                }
            } elseif ($uti == 1) {
                // if student 
                if ($email_status_id == 2) {
                    // if not sent verify email
                    echo "You are not register yet.. Please waiting and check your email..";
                } else {
                    // if sent email 
                    if ($login_status_id == 1) {
                        // if old user 
                        echo "success";
                        $_SESSION["user"] = $usersd;
                    } else {
                        // if first login 
                        echo "firstlogin";
                    }
                    if ($remember == "true") {
                        setcookie("u", $username, time() + (60 * 60 * 24 * 30));
                        setcookie("p", $password, time() + (60 * 60 * 24 * 30));
                    } else {
                        setcookie("u", "", -1);
                        setcookie("p", "", -1);
                    }
                }
            }
        } else {
            echo "Your account has been blocked..";
        }
    } else {
        echo "You are not a valid user.";
    }
}
