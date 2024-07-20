<?php
include './config.php';

$name = $_POST['Name'];
$email = $_POST['Email'];
$phone = $_POST['Phone'];

$ch_email = $_SESSION['email'];
$response['code'] = 0;
$response['massage'] = 'error';

$qur = "SELECT * FROM `login` WHERE email ='$ch_email'";
$qur_ran = mysqli_query($conn, $qur) or die(mysqli_error($conn));

$no = mysqli_num_rows($qur_ran);

// $row = mysqli_fetch_array($qur_ran);


if ($no) {
    $sql = "UPDATE `login` SET `name`='$name',`email`='$email',`phone_number`='$phone' WHERE email ='$ch_email'";
    $qrr = mysqli_query($conn, $sql) or die(mysqli_error($conn));
    $response['code'] = 1;
    $response['massage'] = 'Update success';

}else{
    $response['massage'] = 'User not found';
}
echo json_encode( $response);

