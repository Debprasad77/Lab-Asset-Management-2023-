<?php
include './config.php';
if (isset($_POST['labName']) != '') {

   $lab_name = $_POST['labName'];
   $labId = uniqid($lab_name);
   $response['code'] = 0;
   $response['massage'] = 'error';
   $floor_no = $_SESSION['flore'];

   $add_quch_first = "SELECT * FROM `lab_data` WHERE floor = '$floor_no' AND lab_name ='$lab_name'";
   $add_quch_first_rn = mysqli_query($conn, $add_quch_first);
   $no = mysqli_num_rows($add_quch_first_rn);
  
   if ($no) {
      $response['massage'] = 'Lab already exist in Floor =>' . $floor_no . '. please change The Lab name';
   } else {
     
      $lab_qur = "INSERT INTO `lab_data`( `lab_name`, `lab_id`,`floor`) VALUES ('$lab_name','$labId','$floor_no')";
      $lab_qur_rn = mysqli_query($conn, $lab_qur) or die(mysqli_error($conn));
      $response['code'] = 1;
      $response['massage'] = 'Lab added successfully';

   }
}
echo json_encode($response);
