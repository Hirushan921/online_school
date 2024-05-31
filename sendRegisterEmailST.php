<?php
// send register email by a.officers 
session_start();


use PHPMailer\PHPMailer\PHPMailer;

require 'Exception.php';
require 'PHPMailer.php';
require 'SMTP.php';


require "connection.php";

if (isset($_POST["uid"])) {
    $uid = $_POST["uid"];

    // search user 
    $rs = Database::search("SELECT * FROM `user` WHERE `id`='" . $uid . "'");
    if ($rs->num_rows == 1) {
        $rsd = $rs->fetch_assoc();
        $email = $rsd["email"];

        // create username 
        $username;
        $charst = "ABCDEFGHIJKLMNOPQRSTUVWXYZ0123456789";
        $username = "EWS" . "" . substr(str_shuffle($charst), 0, 5);

        // craete first login code 
        $code = uniqid();

        $d = new DateTime();
        $tz = new DateTimeZone("Asia/Colombo");
        $d->setTimezone($tz);
        $date = $d->format("Y-m-d H:i:s");
        $rd = $date;
        $splitrd = explode(" ", $rd);
        $date = $splitrd[0];

        $reg_user_id = $_SESSION["user"]["id"];

        // echo $username." ".$password." ".$code;

        // update details for approval 
        Database::iud("UPDATE `user` SET `username`='" . $username . "',`verification_code`='" . $code . "',`email_status_id`='1' WHERE `id`='" . $uid . "'");
        // insert register details 
        Database::iud("INSERT INTO `registration`(`user_id`,`reg_user_id`,`reg_date`) 
        VALUES('" . $uid . "','" . $reg_user_id . "','" . $date . "')");

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
        $mail->Subject = 'EduWeb Student Login Details';
        $bodyContent = '<h4>Hi! new user.. This is your login details for login EDUWEB..</h4><br/>
        <h3><b>Username=</b> ' . $username . '</h3>
       <h3><b>First Login Verification Code=</b> ' . $code . '</h3>';
        $mail->Body = $bodyContent;

        if (!$mail->send()) {
            echo 'Message could not be sent. Mailer Error: ' . $mail->ErrorInfo;
        } else {
            echo 'success';
        }
    } else {
        echo "User not found";
    }
}
