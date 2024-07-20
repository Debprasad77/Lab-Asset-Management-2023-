<?php
include 'config.php';
$email = $_POST['login_email'];
$pass = $_POST['login_password'];
$response['code'] = 0;
$response['massage'] = 'error';


$qur = "SELECT * FROM `login` WHERE email ='$email'";
$qur_ran = mysqli_query($conn, $qur) or die(mysqli_error($conn));

$no = mysqli_num_rows($qur_ran);

$row = mysqli_fetch_array($qur_ran);


if ($no) {


    if ($row['password'] == md5($pass)) {

        $date = date('Y-m-d H:i:s');
        $token = md5(rand(0, 9999));
        $p_email=$row['email'];
        $id=$row['id'];
        $p_name=$row['name'];
        $_SESSION['name']=$p_name;
        $_SESSION['id']=$id;
        $_SESSION['email']=$p_email;
        $_SESSION['login_status']=true;
        $sql = "UPDATE `login` SET login_token='$token', login_date ='$date' WHERE email='$email'";
        $qrr = mysqli_query($conn, $sql) or die(mysqli_error($conn));

        $response['code'] = 1;
        // header("Location: ../Html/Home.php");
        $response['redirect'] = "../Html/Home.php?page=1";
        $response['massage'] = 'Login Success. 😀😀';
    } else {
        $response['massage'] = 'Please enter valid password. 🥵🥵';
    }
} else {
    $response['massage'] = 'User not found. 😔😔';
}
echo json_encode($response);

?>
