<?php
header("Access-Control-Allow-Origin: *");
header("Access-Control-Allow-Methods: POST");
include ('config.php');


// echo $comp=$_POST['company'];
// echo $model=$_POST['model'];
// echo $box3=$_POST['date'];
// echo $box4=$_POST['warrenty'];
// echo $box5=$_POST['product'];

$pro = $_POST['product'];
$brand = $_POST['company'];
$model = $_POST['model'];
$serial = $_POST['serial'];
$dop = $_POST['dop'];
$Warrenty = $_POST['Warrenty'];
$dttm=date('Y-m-d H:i:s');

$response['status']=0;
$response['message']='Error';

    $sqll="SELECT id FROM product where p_sn = '$serial' and p_model = '$model' and p_code = '$pro'";
	$qr1=mysqli_query($conn,$sqll) or die(mysqli_error($conn));
	$noc=mysqli_num_rows($qr1);

    if(!$noc){
        $sql= "INSERT INTO product (p_sn, p_code, p_model, brand, dop, w_period, dttm, ip)
				VALUES ('$serial','$pro', '$model', '$brand', '$dop','$Warrenty','$dttm', '$ip')";
				$qrr=mysqli_query($conn,$sql) or die(mysqli_error($conn));
				if($qrr){
					$response['status']=1;
					$response['message']='Submit Success';
				}else{
					$response['message']='Submit Not Success';
				}
    }else
	{
		$response['message']='Product Already Exist';

	}
    echo json_encode($response);
?>