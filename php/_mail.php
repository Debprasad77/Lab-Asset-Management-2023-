<?php
// backend of forget1.html page

include 'config.php';
 extract($_POST);
// $mail=$_POST['email'];                  // for normal call
    

use PHPMailer\PHPMailer\PHPMailer;
use PHPMailer\PHPMailer\Exception;

require 'PHPMailer/src/Exception.php';
require 'PHPMailer/src/PHPMailer.php';
require 'PHPMailer/src/SMTP.php';

//Create an instance; passing `true` enables exceptions
$mail = new PHPMailer(true);





// SUDIP change massage
$response['code'] = 0;
$response['massage'] = 'error';



if (isset($_POST['email'])) {
    $_SESSION['mail'] = $email;  // for resend otp call
}

if (isset($_SESSION['mail'])) {
    $email = $_SESSION['mail'];      // for resend otp call
} else {
    header("location: ../Html/forget1.html");
    die;
}

$qur = "SELECT * FROM `login` WHERE email ='$email'";
$qur_ran = mysqli_query($conn, $qur) or die(mysqli_error($conn));

$no = mysqli_num_rows($qur_ran);

// Message for user if email address not found
if ($no) {
    
    try {
        //Server settings
        //$mail->SMTPDebug = SMTP::DEBUG_SERVER;                    //Enable verbose debug output
        $mail->isSMTP();                                            //Send using SMTP
        $mail->Host       = 'smtp.gmail.com';                       //Set the SMTP server to send through
        $mail->SMTPAuth   = true;                                   //Enable SMTP authentication
        $mail->Username   = 'labproject94@gmail.com';               //SMTP username
        $mail->Password   = 'hepwymekyhxihhtr';                     //SMTP password
        $mail->SMTPSecure = PHPMailer::ENCRYPTION_SMTPS;            //Enable implicit TLS encryption
        $mail->Port       = 465;                                    //TCP port to connect to; use 587 if you have set `SMTPSecure = PHPMailer::ENCRYPTION_STARTTLS`
    
        //Recipients
        $mail->setFrom('labproject94@gmail.com', 'Admin');
        $mail->addAddress($email);                                  //Add a recipient
    
        //Content
        $mail->isHTML(true);                                        //Set email format to HTML
        $mail->Subject = 'OTP For Login';
        $mail->Body    = '<b>' . getOTP() . '</b><br>Here is your one time password (OTP) Verification Code to login. This OTP is valid for 2 minutes only.';
    
        $mail->send();
        // echo 'Message has been sent to '.$email;
        // <script src="https://unpkg.com/sweetalert/dist/sweetalert.min.js"></script>
    
        // SUDIP change massage
        $response['code'] = 1;
        $response['massage'] = 'OTP has been sent Successfully';
        $response['redirect'] = '../Html/forget2.php';
       
    
    } catch (Exception $e) {
        // SUDIP change massage
        $response['massage'] = "Message could not be sent. Mailer Error : {$mail->ErrorInfo}";

    }
}else{
     $response['massage'] = 'Sorry! Email address not found';

}
echo json_encode($response);




// This Function for generating OTP 
function getOTP()
{
    $char = '0123456789';
    $randomString = '';
    $time = $_SERVER['REQUEST_TIME'];

    for ($i = 0; $i < 5; $i++) {
        $index = rand(0, strlen($char) - 1);
        $randomString .= $char[$index];
    }

    // save otp into session
    $_SESSION['otp'] = $randomString;
    $_SESSION['otp_sent_time'] = $time;

    return $randomString;
}
