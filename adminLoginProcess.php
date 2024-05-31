<?php

use PHPMailer\PHPMailer\PHPMailer;

require 'Exception.php';
require 'PHPMailer.php';
require 'SMTP.php';

require "connection.php";

$email = $_POST["email"];
$password = $_POST["password"];


if(empty($email)){
    echo "Please enter your email address."; 
}elseif(empty($password)){
    echo "Please enter your password.";
}else{
    $adminrs = Database::search("SELECT * FROM `user` WHERE `email`='".$email."' AND `password`='".$password."' AND `user_type_id`='4'");
    $an = $adminrs->num_rows; 

    if($an==1){
        $code = uniqid();

        //update code
        Database::iud("UPDATE `user` SET `verification_code`='".$code."' WHERE `email`='".$email."'");

        // send email 
        $mail = new PHPMailer;
        $mail->IsSMTP();
        $mail->Host = 'smtp.gmail.com';
        $mail->SMTPAuth = true;
        $mail->Username = 'eduwebsch@gmail.com';
        $mail->Password = 'yaqmpwdkimcbozld';
        $mail->SMTPSecure = 'ssl';
        $mail->Port = 465;
        $mail->setFrom('eduwebsch@gmail.com', 'eduweb');
        $mail->addReplyTo('eduwebsch@gmail.com', 'eduweb');
        $mail->addAddress($email);
        $mail->isHTML(true);
        $mail->Subject = 'EduWeb Admin Login Verification';
        $bodyContent = '<h4>Your Verification Code is,</h4><h3>'.$code.'</h3>';
        $mail->Body = $bodyContent;

        if (!$mail->send()) {
            echo 'Message could not be sent. Mailer Error: ' . $mail->ErrorInfo;
        } else {
        echo 'success';
        }

    }else{
        echo "You are not a valid user.";
    }
}


?>