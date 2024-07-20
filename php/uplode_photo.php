<?php
// ajjjjjjjj
include('./config.php');
if (isset($_POST["image"])) {
    $email = $_SESSION['email'];
    $data = $_POST["image"];
    $img_array_1 = explode(";", $data);
    $img_array_2 = explode(",", $img_array_1[1]);
    $basedecode = base64_decode($img_array_2[1]);

    // echo $email;
    // die;

    $ch_qu = "SELECT * FROM `login` WHERE  email = '$email'";
    $ch_qu_rn = mysqli_query($conn, $ch_qu) or die(mysqli_error($conn));


    $row = mysqli_fetch_array($ch_qu_rn);


    $filename_ch = $row['Img_path'];
    $directory = '../upload/';

    if (file_exists($directory . $filename)) {

        unlink($filename_ch);

        $filename = time() . '.jpg';
        file_put_contents("../upload/$filename", $basedecode);
        //file_put_contents($filename, $basedecode);
        $target_file = '../upload/' . $filename;
        $sql = "UPDATE `login` SET Img_path='$target_file' WHERE email='$email'";
        $qrr = mysqli_query($conn, $sql) or die(mysqli_error($conn));
        if ($qrr) {
            echo 'Submit Success';
        } else {
            echo 'Submit Not Success';
        }
        echo "The file $filename_ch exists in the directory $directory";
    } else {
        $filename = time() . '.jpg';
        file_put_contents("../upload/$filename", $basedecode);
        //file_put_contents($filename, $basedecode);
        $target_file = '../upload/' . $filename;
        $sql = "UPDATE `login` SET Img_path='$target_file' WHERE email='$email'";
        $qrr = mysqli_query($conn, $sql) or die(mysqli_error($conn));
        if ($qrr) {
            echo 'Submit Success';
        } else {
            echo 'Submit Not Success';
        }
        echo "The file $filename does not exist in the directory $directory";
    }
}
