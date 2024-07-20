<?php
include './config.php';

$OldPass = $_POST['Old_pass'];
$NewPass = $_POST['New_pass'];
$ConPass = $_POST['Con_pass'];
$response['code'] = 0;
$response['massage'] = 'error';

if ($NewPass === $ConPass) {


    $ch_email = $_SESSION['email'];


    $qur = "SELECT * FROM `login` WHERE email ='$ch_email'";
    $qur_ran = mysqli_query($conn, $qur) or die(mysqli_error($conn));

    $no = mysqli_num_rows($qur_ran);

    $row = mysqli_fetch_array($qur_ran);


    if ($no) {
        if ($row['password'] === md5($OldPass)) {
            $pass = md5($NewPass);
            $sql = "UPDATE `login` SET `password`='$pass' WHERE email ='$ch_email'";
            $qrr = mysqli_query($conn, $sql) or die(mysqli_error($conn));
            $response['code'] = 1;
            $response['massage'] = 'Password Update success';
        } else {
            $response['massage'] = 'Old password not match..!!';
        }
    } else {
        $response['massage'] = 'User not found';
    }
} else {
    $response['massage'] = 'New password and confirm password not match..!';
}

echo json_encode($response);
