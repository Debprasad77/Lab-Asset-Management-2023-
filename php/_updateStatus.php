<?php

include('config.php');

$res = $_REQUEST['ChPassword'];

$address = $res['0'];
$s_dttm = $res['1'];
$r_dttm = $res['2'];
$dttm = date('Y-m-d H:i:s');

$p_id = base64_decode($res['3']);


// echo'<pre>';
// print_r($res);

// first update the status of the product table 
$sql = "UPDATE product SET status = '0' WHERE id = '$p_id'";
$qr = mysqli_query($conn, $sql) or die(mysqli_error($conn));

if($qr){
    // log();
    // then find the product serial number from product table
    $sql1 = "SELECT * FROM product WHERE id = '$p_id'";
    $qr1 = mysqli_query($conn, $sql1) or die(mysqli_error($conn));
    $row = mysqli_fetch_array($qr1);
    $pSn = $row['p_sn'];

    // at the end insert the product detail to the repair table
    $sql2 = "INSERT INTO repair (p_sn, rc_address, p_s_dttm, p_r_dttm, dttm, ip)
            VALUES('$pSn', '$address', '$s_dttm', '$r_dttm', '$dttm', '$ip') ";
    $qr2 = mysqli_query($conn, $sql2) or die(mysqli_error($conn));

    if($qr2){
        echo '1';       //insert sucessfull
    }else{
        echo '0';      //error
    }
}else{
    echo '00';      //Status not updated
}

// function log(){

//     // creating log folder if not Exists
//     if(!file_exists('../log')){
//         mkdir('../log', 0777, true);
//     }

//     //Something to write to txt log
//     $log  = "User: ".$_SERVER['REMOTE_ADDR'].' - '.date("F j, Y, g:i a").PHP_EOL.
//             "Attempt: ".($result[0]['success']=='1'?'Success':'Failed').PHP_EOL.
//             "User: ".$_SESSION['email'].PHP_EOL.
//             "-------------------------".PHP_EOL;
//     //Save string to log, use FILE_APPEND to append.
//     file_put_contents('../log/log_'.date("j.n.Y").'.log', $log, FILE_APPEND);
// }

?>