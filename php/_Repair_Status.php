<?php

include('config.php');

$response['status']=0;
$response['message']='Error';

$id=$_POST['i'];
$status=$_POST['s'];    //0
$sql= "UPDATE repair SET status=$status WHERE id = $id";
$qrr=mysqli_query($conn,$sql) or die(mysqli_error($conn));

	if($qrr){
    $sql1 = "SELECT * FROM repair WHERE id = $id";
    $qr1 = mysqli_query($conn, $sql1) or die(mysqli_error($conn));
    $row = mysqli_fetch_array($qr1);

    $psn = $row['p_sn'];
    update($psn, $conn);
    // $st = '1';

		$response['status']=1;
		$response['message']='Success.';
	}
echo json_encode($response);


function update($id, $conn){
    // include('config.php');

    $forr= "UPDATE `product` SET `status` = '1' WHERE `p_sn`='$id'";
    // $forr= "UPDATE product SET status = $st WHERE p_sn = $psn";
	$abcd=mysqli_query($conn, $forr) or die(mysqli_error($conn));
}

?>