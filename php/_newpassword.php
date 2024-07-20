<!-- redirected from forget3.html page -->

<?php
include("./config.php");
extract($_POST);
$email = $_SESSION['mail'];

// echo $emali;
// echo $pass;
// die;

$sql = "SELECT * FROM login WHERE email = '$email'";
$qr = mysqli_query($conn, $sql) or die(mysqli_error($conn));
$noc = mysqli_num_rows($qr);

if ($noc) {
    // $row = mysqli_fetch_array($qr);

    $sql2 = "UPDATE login SET password=md5('$pass') WHERE email='$email'";
    $qr2 = mysqli_query($conn, $sql2) or die(mysqli_error($conn));

    if ($qr2) {
        echo "
        <script>
            alert('Password Update Successful');
            window.location.href = '../Html/index.php';
        </script>";
    } else {
        echo "
        <script>
            alert('Something Wrong Try Again later');
            window.location.href = '../Html/forget3.html';
        </script>
        ";
    }
}


?>