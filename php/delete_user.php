<?php
include './config.php';

if (isset($_POST['id'])) {
    $id = base64_decode($_POST['id']);

    // $id =9;
    $response['code'] = 0;
    $response['massage'] = 'error';
    // echo $id;


    $qur = "SELECT * FROM `login` WHERE id ='$id'";
    $qur_ran = mysqli_query($conn, $qur) or die(mysqli_error($conn));

    $no = mysqli_num_rows($qur_ran);

    // echo $no;
    // die;

    if ($no) {

        $del_qur = "DELETE FROM `login` WHERE id ='$id'";
        $del_qur_ran = mysqli_query($conn, $del_qur)or die(mysqli_error($conn));
        $response['code'] = 1;
        $response['massage'] = 'Delete Success';
    } else {
        $response['massage'] = 'Delete user not found';
    }
    echo json_encode($response);
}
