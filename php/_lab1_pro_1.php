<?php
include('./config.php');

$pro = $_POST['product'];
$brand = $_POST['company'];
$model = $_POST['model'];
$serial = $_POST['serial'];
$dop = $_POST['dop'];
$Warrenty = $_POST['Warrenty'];
$desk = $_POST['desk'];
$dttm = date('Y-m-d H:i:s');

$response['code'] = 0;
$response['massage'] = 'error';
$labID = base64_decode($_SESSION['LabID2']);

$floor_qu = "SELECT * FROM lab_data WHERE lab_id='$labID'";
$floor_qu_rn = mysqli_query($conn, $floor_qu);
$floor_row = mysqli_fetch_array($floor_qu_rn);
$floor_no = $floor_row['floor'];


$sql2 = "SELECT * FROM product_code WHERE p_code = '$pro'";
$qr2 = mysqli_query($conn, $sql2) or die(mysqli_error($conn));
$noc = mysqli_num_rows($qr2);

if ($noc) {

	$sql1 = "SELECT id FROM product where p_sn = '$serial'";
	$qr1 = mysqli_query($conn, $sql1) or die(mysqli_error($conn));
	$noc = mysqli_num_rows($qr1);

	if (!$noc) {
		$insert_pro = "INSERT INTO `product`(`floor`,`lab_id`, `desk`, `p_sn`, `p_code`, `p_model`, `brand`, `dop`, `w_period`,`date`) VALUES ('$floor_no','$labID','$desk','$serial','$pro', '$model','$brand','$dop','$Warrenty','$dttm')";
		// $sql = "INSERT INTO product (p_sn, p_code, p_model, brand, dop, w_period, desk, dttm, ip)
		// 		VALUES ('$serial','$pro', '$model', '$brand', '$dop','$Warrenty','$desk','$dttm', '$ip')";
		$qrr = mysqli_query($conn, $insert_pro) or die(mysqli_error($conn));

		$response['code'] = 1;
		$response['massage'] = 'Submit Success';
		unset($_SESSION['LabID2']);
	} else {
		$response['massage'] = 'Product Already Exist';
	}
} else {
	$response['message'] = 'Product Code Not Found';
}
echo json_encode($response);
