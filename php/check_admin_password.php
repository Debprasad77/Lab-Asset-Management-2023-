<?php
include 'config.php';
$pass = $_POST['ChPassword'];
// $id = $_REQUEST['code'];
// echo $id;

$email = $_SESSION['email'];
// echo $pass;
$check_password_qur = "SELECT * FROM `login` WHERE email =  '$email'";

$password_ch_qur = "SELECT * FROM `login` WHERE email ='$email'";
$password_qur_ran = mysqli_query($conn, $password_ch_qur) or die(mysqli_error($conn));

$no = mysqli_num_rows($password_qur_ran);

$row = mysqli_fetch_array($password_qur_ran);


if ($no) {

    if ($row['password'] === md5($pass) && $row['status']=='10') {
        echo "1";
    } else {
        echo "0";
    }
}
