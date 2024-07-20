<?php
include './config.php';
// $labId ;



if (isset($_POST['product'])) {
    // echo $_POST[''];
    $p_name = $_POST['product'];

    $date = date('Y-m-d H:i:s');
    $response['code'] = 0;
    $response['massage'] = 'error';
    $labID= base64_decode($_SESSION['LabID']);
    $p_code = $labID. $p_name; 

    $floor_qu = "SELECT * FROM lab_data WHERE lab_id='$labID'";
    $floor_qu_rn=mysqli_query($conn,$floor_qu);
    $floor_row=mysqli_fetch_array($floor_qu_rn);
    $floor_no=$floor_row['floor'];

    $qr1 = "SELECT * FROM product_code WHERE p_code = '$p_code'";
    $sql1 = mysqli_query($conn, $qr1) or die(mysqli_error($conn));
    $noc = mysqli_num_rows($sql1);
    if (!$noc) {

        if (isset($_FILES['filedata']) && $_FILES['filedata']["error"] != true) {

            // creating procuct image folder if not Exists
            if (!file_exists('../upload')) {
                mkdir('../upload', 0777, true);
            }

            $imgFileType = strtolower(pathinfo($_FILES["filedata"]["name"], PATHINFO_EXTENSION));   // Extract file Extention
            $filename = time() . rand(1111, 9999);    //rename file name using time and random 4 digits number
            $target_file = "../upload/" . $filename . '.' . $imgFileType;  //concatinate component to make file name perfect
            move_uploaded_file($_FILES["filedata"]["tmp_name"], $target_file); //upload file to the folder
        } else {
            $target_file = NULL;
        }




        // echo $p_code;
        $qr = "INSERT INTO `product_code`( `floor`, `lab_id`,`p_code`, `p_name`,`date_time`,`img_path`,`ip`) VALUES ('$floor_no','$labID','$p_code','$p_name','$date','$target_file','$ip')";
        $sql = mysqli_query($conn, $qr) or die(mysqli_error($conn));
        if (!$sql) {
            // Something Wrong
            // $response['status'] = '0';
            $response['massage'] = 'Something Wrong';
        } else {
            // Data Added Successful
            // $response['status'] = '1';
            $response['code'] = 1;
            $response['massage'] = 'Data Added Successful';
            // unset($_SESSION['LabID']);
        }
    } else {
        // $response['status'] = '01';
        $response['massage'] = 'Duplicate Entry Found';
    }
    echo json_encode($response);
}
