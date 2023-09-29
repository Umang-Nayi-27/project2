

<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>verify E-mail</title>
    <link rel="shortcut icon" type="x-icon" href="img/browser.jpg" style="background-color: white;" >
    <link rel="preconnect" href="https://fonts.googleapis.com">
    <link rel="preconnect" href="https://fonts.gstatic.com" crossorigin>
    <link href="https://fonts.googleapis.com/css2?family=Viga&display=swap" rel="stylesheet">
    <link rel="stylesheet" href="signup.css">
    <script src="https://unpkg.com/sweetalert/dist/sweetalert.min.js"></script>
</head>
<body>
    <div id="page1">
        <div id="divlg">
            <div class="registration-container">
                <a class="navbar-logo" href="#">
                    <img src="img\log2.png" alt="" style="width: 200px;height: auto;">
                </a>
                <hr>
                <h2>Registered E-mail</h2>
                <form action="#" method="post">
                    <input type="email" name="email" placeholder="Registered Email" required>
                    <button type="submit" name="register">Get Link</button>
                </form>
            </div>
        </div>
        <div id="divvid">
            <video autoplay loop muted playsinline>
                <source src="img/p3vid3.mp4" type="video/mp4">
            </video>
        </div>
    </div>
</body>


<?php

ini_set('display_errors', 1);
error_reporting(E_ALL);

$connection = mysqli_connect("localhost", "root", "", "demo");

use PHPMailer\PHPMailer\PHPMailer;
use PHPMailer\PHPMailer\Exception;
use PHPMailer\PHPMailer\SMTP;

function sendMail($email,$reset_token)
{
    require('mailer/Exception.php');
    require('mailer/PHPMailer.php');
    require('mailer/SMTP.php');

    $mail = new PHPMailer(true);

    try {
        //Server settings                   //Enable verbose debug output
        $mail->isSMTP();                                            //Send using SMTP
        $mail->Host       = 'smtp.gmail.com';                     //Set the SMTP server to send through
        $mail->SMTPAuth   = true;                                   //Enable SMTP authentication
        $mail->Username   = 'vikramkohli277@gmail.com';                     //SMTP username
        $mail->Password   = 'zjysmgkymgaepshq        ';                               //SMTP password
        $mail->SMTPSecure = PHPMailer::ENCRYPTION_SMTPS;            //Enable implicit TLS encryption
        $mail->Port       = 465;                                    //TCP port to connect to; use 587 if you have set `SMTPSecure = PHPMailer::ENCRYPTION_STARTTLS`
    
        //Recipients
        $mail->setFrom('vikramkohli277@gmail.com', 'BeatBoxify');
        $mail->addAddress($email);     //Add a recipient
        //Attachments
       //Optional name
    
        //Content
        $mail->isHTML(true);                                  //Set email format to HTML
        $mail->Subject = 'Password Link For BeatBoxify';
        $mail->Body    = "Response of your forgot Password  <br> <b> Click link below </b>
                            <br>
                            <a href='http://localhost/proj/enter_system/forgetpass.php?email=$email&token=$reset_token'> Reset Password</a>";
        $mail->AltBody = 'This is the body in plain text for non-HTML mail clients';
    
        $mail->send();
        return true;
        } catch (Exception $e) {
            return false;
        }
}

if (!$connection) {
    die("not connected" . mysqli_connect_error());
} else {
    echo "connected successfully";
}

if (isset($_POST['register'])) {
    $email = $_POST['email'];

    // Insert data into the database
    $query = "SELECT `email` FROM `demo_reg` WHERE `email`='$email' LIMIT 1";
    $result = mysqli_query($connection, $query);

    if (mysqli_num_rows($result) > 0) {
        echo " ///present in database";

        $reset_token=bin2hex(random_bytes(16));
        date_default_timezone_set('Asia/kolkata');
        $date=date("Y-m-d");
        $query="UPDATE `demo_reg` SET `token`='$reset_token',`token_exp`='$date' WHERE `email`='$email'";
        if(mysqli_query($connection, $query)  && sendMail($_POST['email'],$reset_token) ){
            echo " /// works";
            echo "<script>
                        swal('Done !', 'Reset Pass link has been sent to Your Email Address', 'success');
                        </script>";
        }
        else{
            echo "///not wokrking";
        }

    } else {
        echo " ///not present in database";
    }
}

?>


</html>