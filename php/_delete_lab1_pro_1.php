<?php
include("config.php");

$id = base64_decode($_REQUEST['id']);


$sql = "DELETE FROM product WHERE id = '$id'";
$qr = mysqli_query($conn, $sql) or die(mysqli_error($conn));
if($qr){
    echo "<script>
    history.go(-1);
    </script>";
}

?>