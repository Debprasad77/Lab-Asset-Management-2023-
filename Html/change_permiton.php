<?php
include '../php/config.php';



?>


<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>User Permission</title>
    <link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/bootstrap@4.3.1/dist/css/bootstrap.min.css" integrity="sha384-ggOyR0iXCbMQv3Xipma34MD+dH/1fQ784/j6cY/iJTQUOhcWr7x9JvoRxT2MZw1T" crossorigin="anonymous">
    <link rel="stylesheet" href="../Css/change_permiton.css">

</head>

<body>

    <section class="csrd1">

        <div class="head">
            <h1>Permissions</h1>
        </div>

        <div class="p-table">
            <form id="chPermission" method="post" action="">
                <label class="container">READ
                    <input type="checkbox" id="vehicle1" checked value="1" onclick="notChange()" name="read" class="checkmark">
                </label>

                <label class="container">WRITE
                    <input type="checkbox" id="vehicle2" value="1" name="write" class="checkmark">
                </label>
                <!-- <div class="row"> -->
                <button type="submit" name="submit" class="btn btn-primary">Save</button>
                <button type="button" class="btn btn-danger">Cancel</button>
                <!-- </div> -->
            </form>
        </div>


    </section>
</body>

</html>

<script src="../js/jquery.min.js"></script>
<script src="https://cdnjs.cloudflare.com/ajax/libs/sweetalert/2.1.2/sweetalert.min.js"></script>
<script src="https://cdn.jsdelivr.net/npm/sweetalert2@11"></script>

<script>
    function notChange() {
        Swal.fire("Set by default, cannot be changed").then((val) => {
            document.getElementById("vehicle1").checked = true;
        })
    }
</script>


<?php
$email = $_GET['code'];
$qur = "SELECT * FROM `login` WHERE email ='$email'";
$qur_ran = mysqli_query($conn, $qur) or die(mysqli_error($conn));

$no = mysqli_num_rows($qur_ran);

$row = mysqli_fetch_array($qur_ran);
// echo $email;
// die;

if ($row['status'] == 10) {
    echo '<script>
    document.getElementById("vehicle1").checked = true;
    document.getElementById("vehicle2").checked = true;
    </script>';
} else {
    echo '<script>
    document.getElementById("vehicle1").checked = true;
    document.getElementById("vehicle2").checked = false;
    </script>';
}


?>


<?php

$read = $_POST['read'];
$write = $_POST['write'];
$email = $_GET['code'];
// echo $write;

// die;
if (isset($_POST['submit'])) {

    $qur = "SELECT * FROM `login` WHERE email ='$email'";
    $qur_ran = mysqli_query($conn, $qur) or die(mysqli_error($conn));

    $no = mysqli_num_rows($qur_ran);

    $row = mysqli_fetch_array($qur_ran);
    // die;

    if ($no) {
        if ($write == 1 && $read == 1) {
            $set = 10;
            $sql_update = "UPDATE `login` SET `status`='$set' WHERE email ='$email'";
            $qrr_update = mysqli_query($conn, $sql_update) or die(mysqli_error($conn));


            echo "<script>alert('Admin access success')
            window.location.href='permission.php';
            </script>";

        } elseif ($write == '' && $read == 1) {
            $set = 1;
            $sql_update = "UPDATE `login` SET `status`='$set' WHERE email ='$email'";
            $qrr_update = mysqli_query($conn, $sql_update) or die(mysqli_error($conn));

            echo "<script>alert('User access success')
            window.location.href='permission.php';
            </script>";
        } else {
            echo '<script>alert("Update not success")</script>';
        }
    }
}
?>