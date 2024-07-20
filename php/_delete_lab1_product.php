<script src="https://cdn.jsdelivr.net/npm/sweetalert2@11.7.3/dist/sweetalert2.all.min.js"></script>
<script src="../js/jquery.min.js"></script>


<?php
// _Kalayn*****************************************

include("config.php");

$value = base64_decode($_REQUEST['id']);

// PRODUCT table is a CHILD table of PRODUCT_CODE table &
// PRODUCT_CODE table is a PARENT table of PRODUCT table

// fatching those row from product_code table which id is as same as $value [parent table]
// $data_present_qr = "SELECT * FROM product WHERE  lab_id = '$lab_id'";
// $data_present_rn = mysqli_query($conn, $data_present_qr) or die(mysqli_error($conn));

// $data_no = mysqli_num_rows($data_present_rn);

// if(){}
$sql = "SELECT * FROM product_code WHERE id = '$value'";
$qr = mysqli_query($conn, $sql) or die(mysqli_error($conn));
$row = mysqli_fetch_array($qr);
$p_code = $row['p_code'];          //store product code into variable
$img_path = $row['img_path'];      //store img path into variable

$sql1 = "DELETE FROM product WHERE p_code = '$p_code'";
$qr1 = mysqli_query($conn, $sql1) or die(mysqli_error($conn));

if($qr1){
    
    $sql2 = "DELETE FROM product_code WHERE id = '$value'";
    $qr2 = mysqli_query($conn, $sql2) or die(mysqli_error($conn));
    if($qr2){
        echo'<script>  
        const history = window.history;
            history.back()
            </script>';
        // header("location: ../Html/lab1.php");
        unlink("$img_path");
    }
}
?>