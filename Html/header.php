<?php
include '../php/config.php';

?>

<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Document</title>
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.2.0/css/all.min.css">
    <link rel="stylesheet" href="../Css/header.css">
    <link rel="stylesheet" href="../Css/profile.css">
    <link rel="stylesheet" href="../Css/notifay.css">

</head>

<body>
    <div id="preloader">

    </div>

    <div class="sidenav" id="sidenav">

        <img src="../Img/headerlogo.jpg" alt="img">

        <a class="nav" href="./Home.php?page=1"><i class="fa fa-home" aria-hidden="true"></i><span>Dashboard</span></a>
        <?php

        $email = $_SESSION['email'];
        // echo $pass;
        $check_password_qur = "SELECT * FROM `login` WHERE email =  '$email'";

        $password_ch_qur = "SELECT * FROM `login` WHERE email ='$email'";
        $password_qur_ran = mysqli_query($conn, $password_ch_qur) or die(mysqli_error($conn));

        $no = mysqli_num_rows($password_qur_ran);

        $row = mysqli_fetch_array($password_qur_ran);

        if ($row['status'] == '10') {
            echo '<a class="nav" href="./permission.php"><i class="fa fa-cog" aria-hidden="true"></i><span>Permission</span></a>';
        }
        ?>
        <a class="nav" href="./Repair_Status.php"><i class="fa fa-clock" aria-hidden="true"></i><span>Repair Status</span></a>
        <a class="nav" href="./account.php"><i class="fa fa-user" aria-hidden="true"></i><span>Account</span></a>
        <a class="nav" href="./contact_us.php"><i class="fa fa-phone" aria-hidden="true"></i><span>Contact Us</span></a>
    </div>

    <div class="header_body">
        <div class="search">
            <div class="icon">
                <i class="fa fa-search" aria-hidden="true"></i>
            </div>
            <div class="input">
                <input type="search" placeholder="Search...">
            </div>
        </div>
        <?php

        $mail = $_SESSION['email'];
        $sql = "SELECT * FROM login WHERE email = '$mail'";
        $qr = mysqli_query($conn, $sql) or die(mysqli_error($conn));
        $row = mysqli_fetch_array($qr);

        if ($row['status'] == 10) {

            if (isset($_SESSION['newUser']['details'])) {

                // $dttm = date('d M Y h:i:s A',strtotime($_SESSION['newUser']['details']['date']));

                echo '
    <div class="profile">
        <span id="num"></span>
        <a onclick="Notifi()"><i class="fa fa-bell" aria-hidden="true"></i></a>
        <a onclick="PopupProfile()"><i class="fa fa-user-circle" aria-hidden="true"></i></a>
        
        <div class="popup_form" id="popup_form">

            <div class="dropdown">
                <div class="notify_item">
                    <div class="notify_img">
                    <img src="../Img/profile.png" alt="profile_pic" style="width: 50px">
                    </div>
                    <div class="notify_info">                       
                        <p>' . $_SESSION['newUser']['details']['name'] . '</p>
                        <p>' . $_SESSION['newUser']['details']['mail'] . '</p>
                    </div>

                    </div>                        
                    
            </div>
            
        </div>
        
        </div>';
                unset($_SESSION['newUser']['details']);
            } else {  ?>

                <div class="profile">
                    <a onclick="Notifi()"><i class="fa fa-bell" aria-hidden="true"></i></a>
                    <a onclick="PopupProfile()"><i class="fa fa-user-circle" aria-hidden="true"></i></a>
                </div>
            <?php
            }
        } else {  ?>

            <div class="profile">
                <a onclick="PopupProfile()"><i class="fa fa-user-circle" aria-hidden="true"></i></a>
            </div>
        <?php
        }
        ?>

        <!-- profile item -->
        <div class="popup_profile" id="popup_profile">
            <div class="profile_card" id="profile_card">
                <img id="profile_img1" src="../Img/profile.png" alt="">
                <?php echo ' <img id="profile_img2" src="' . $row['Img_path'] . '" alt="Image" class="shadow" >' ?>
                <p><?php echo ($_SESSION['name']) ?></p>
                <p class="profile_email"><?php echo ($_SESSION['email']) ?></p>
                <input type="button" id="Manage_Your_account" value="Manage Your account">
                <input type="button" id="logout" value="Logout">

            </div>
        </div>


        <!-- <button id='back' onclick="history.back()">Go Back</button> -->
    </div>

</body>

</html>


<script src="../js/jquery.min.js"></script>
<script src="https://cdnjs.cloudflare.com/ajax/libs/sweetalert/2.1.2/sweetalert.min.js"></script>
<script src="https://unpkg.com/sweetalert/dist/sweetalert.min.js"></script>
<script src="../js/notification.js"></script>
<script src="../js/popup_profile.js"></script>
<script src="../js/preloader.js"></script>
<script>
    let btn_cont = location.href
    let btns = document.querySelectorAll('.sidenav a')
    let men = btns.length
    for (let i = 0; i < men; i++) {

        if (btns[i].href === btn_cont) {
            btns[i].className = 'active'
            document.querySelector('.fa-arrow-left').style.display = 'none';


        }
    }
</script>



<script>
    $('#Manage_Your_account').click(function() {
        window.location.href = "./account.php";

    })

    $("#logout").click(function(e) {

        swal({
                title: "Do you really want to logout ?",
                icon: "warning",
                buttons: true,
                dangerMode: true,
            })
            .then((willDelete) => {
                if (willDelete) {
                    window.location.href = "../php/logout.php"

                    swal("Logout success!", {
                        icon: "success",
                    });
                } else {

                }
            });

    })




    // const history = window.history;
    // const Back_for = () => {
    //     history.back()

    // }


    $(document).ready(function() {
        var rowCount = $(".dropdown .notify_item").length;
        // alert(rowCount); 
        $('#num').html(rowCount);
    });




    if ($('#profile_img2').attr('src') != '') {
        // alert('gotikkhj');
        $('#profile_img1').hide();

    } else {
        $('#profile_img1').show()
        $('#profile_img2').hide();


    }
</script>