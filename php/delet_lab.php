<?php
include './config.php';

$response['code'] = 0;
$response['massage'] = 'error';
$lab_id = $_POST['id'];

$lab_id = base64_decode($lab_id);

// echo$lab_id;

$data_present_qr = "SELECT * FROM product_code WHERE  lab_id = '$lab_id'";
$data_present_rn = mysqli_query($conn, $data_present_qr) or die(mysqli_error($conn));

$data_no = mysqli_num_rows($data_present_rn);
if ($data_no) {
    $response['massage'] = 'You cannot delete this Lab because there is data inside it. Please remove the data before attempting to delete the Lab';

} else {
    $delete_lab_qr = "DELETE FROM `lab_data` WHERE  lab_id  = '$lab_id'";

    $lab_qr_rn = mysqli_query($conn, $delete_lab_qr) or die(mysqli_error($conn));

    if ($lab_qr_rn) {
        $response['code'] = 1;
        $response['massage'] = 'Delete Success.';
        $response['redirect'] = "../Html/Home.php";
    } else {
        $response['massage'] = 'Lab not delete';
    }
}



echo json_encode($response);
