<?php
include 'config.php';

$name = $_POST['register_name'];
$email = $_POST['register_email'];
$pass = $_POST['register_password'];
$con_pass = $_POST['confirm_password'];
$date = date('Y-m-d H:i:s');
$token = md5(rand(0, 9999));
$type=1;
$status=1;

$response['code'] = 0;
$response['massage'] = 'error';

if ($pass === $con_pass) {

    $qur = "SELECT email FROM `login` WHERE email ='$email'";
    $qur_ran = mysqli_query($conn, $qur) or die(mysqli_error($conn));
    $no = mysqli_num_rows($qur_ran);

    if (!$no) {
        $pass=md5($pass);
        $sql = "INSERT INTO `login` (`name`, `email`,`password`, `login_token`, `login_date`, `type`, `status`) VALUES ('$name','$email','$pass','$token','$date','$type','$status')";
        $qrr = mysqli_query($conn, $sql) or die(mysqli_error($conn));

        $response['code'] = 1;
        $response['redirect'] = '../Html/index.php';
        $response['massage'] = 'Register Success..!';

        $_SESSION['newUser']['details'] = array('name' => $name, 'mail' => $email);

    } else {
        $response['massage'] = 'Email already exist.. please try to login';
    }
}
else {
    $response['massage'] = 'password not match';
}


echo json_encode($response);

?>