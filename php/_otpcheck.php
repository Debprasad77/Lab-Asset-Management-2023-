<?php
// backend of forget2.html page

include('config.php');

$time = $_SERVER['REQUEST_TIME'];

if(!isset($_SESSION['mail'])){
    header("location: ../Html/forget1.html");
}

// check the otp time if timeout then it destory the otp session 
if($time - $_SESSION['otp_sent_time'] > 120){
    unset($_SESSION["otp"]);
    $_SESSION['key'] = "false";
    echo "
    <script>
    alert('OTP timeout.Hit Re-send OTP button to generate new OTP');
    </script>";
    header("location: ../Html/forget2.php");
}

$data = $_POST['otp'];
$otp= $_SESSION['otp'];

// once the otp check successful the it immediately destory the otp session and checking time session
if($data === $otp){
    unset($_SESSION["otp"]);
    unset($_SESSION["otp_sent_time"]);
    header("location: ../Html/forget3.html");
}else{
    echo "
        <script>
            alert('OTP not matching try again');
            history.go(-1);
        </script>";
}
?>
