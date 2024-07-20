<?php
include '../php/config.php';
// include '../Html/header.php';

if (isset($_SESSION['login_status']) && $_SESSION['login_status'] == true) {


} else {
    header('Location:index.php');
    exit;
}
?>

<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Document</title>

    <?php
    // echo $id;


    ?>
    <link rel="stylesheet" href="../Css/notifay.css">
    <link rel="stylesheet" href="../Css/profile.css">

    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.2.0/css/all.min.css">


    <link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/bootstrap@4.3.1/dist/css/bootstrap.min.css" integrity="sha384-ggOyR0iXCbMQv3Xipma34MD+dH/1fQ784/j6cY/iJTQUOhcWr7x9JvoRxT2MZw1T" crossorigin="anonymous">
    <link rel="stylesheet" href="../Css/home_page.css">


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

    </div>
    <div class="bac_button">
        <i class="fa-solid fa-arrow-left back"></i>
    </div>
    </div>


    <!-- home -->
    <div class="page_body">

        <div class="container">

            <?php

            $lab_qur = "SELECT * FROM `lab_data` ORDER BY a_id ";
            $lab_qur_rn = mysqli_query($conn, $lab_qur) or die(mysqli_error($conn));

            // $no = mysqli_num_rows($lab_qur_rn);
            // $lab_row = mysqli_fetch_array($lab_qur_rn);
            $flore_no_ch = $_GET['page'];




            while ($lab_row = mysqli_fetch_array($lab_qur_rn)) {
                if ($lab_row['floor'] ==  $flore_no_ch) {

                    echo '
                <div class="col-sm box1" id="' . base64_encode($lab_row['lab_id']) . '">
                <i class="fa fa-trash Lab_del" aria-hidden="true" id="' . base64_encode($lab_row['lab_id']) . '"></i>
                <i class="fa-solid fa-computer"></i><br>
                <h4>' . $lab_row['lab_name'] . '</h4>
                </div>
              
                ';
                } else {
                }
            }
            ?>

        </div>


        <div class="labAddBtn">
            <button id="addLab" class="add_box"><i class="fa fa-add"></i></button>
        </div>
     
        <?php

        $flore = $_GET['page'];
        $_SESSION['flore'] = $flore;
        $fl_qu = "SELECT * FROM `lab_data`";
        $fl_qu_rn = mysqli_query($conn, $fl_qu) or die(mysqli_error($conn));
        // if (mysqli_num_rows($fl_qu_rn) > 0) {
        echo '<nav aria-label="Page navigation example">
                <ul class="pagination justify-content-center "> ';
        for ($i = 1; $i <= 5; $i++) {

            if ($i == $flore) {
                $floor_adtive = "active";
            } else {
                $floor_adtive = "";
            }

            echo '
              <li class="page-item ' . $floor_adtive . '"><a class="page-link" href="./Home.php?page=' . $i . '">' . $i . '</a></li>
              ';
        }

        echo '
        </ul>
        <h5 class="pagination justify-content-center">Floor Number</h5>
          </nav>';
        // }


        ?>

        <!-- form ad item -->
        <div class="form_section">
            <div class="form_center">
                <p id="close">
                    <i class="fa-regular fa-circle-xmark"></i>
                </p>
                <form id="add_lab_form">
                    <div class="form-group">
                        <label>Enter Lab name</label>
                        <input type="text" name="labName" class="form-control" id="" placeholder="Lab name">
                    </div>
                    <button type="submit" class="form-group" id="sub_btn">Submit</button>
                </form>
            </div>

        </div>




    </div>





    </div>
    <script src="https://code.jquery.com/jquery-3.3.1.slim.min.js" integrity="sha384-q8i/X+965DzO0rT7abK41JStQIAqVgRVzpbzo5smXKp4YfRvH+8abtTE1Pi6jizo" crossorigin="anonymous"></script>
    <script src="https://cdn.jsdelivr.net/npm/popper.js@1.14.7/dist/umd/popper.min.js" integrity="sha384-UO2eT0CpHqdSJQ6hJty5KVphtPhzWj9WO1clHTMGa3JDZwrnQq4sF86dIHNDz0W1" crossorigin="anonymous"></script>
    <script src="https://cdn.jsdelivr.net/npm/bootstrap@4.3.1/dist/js/bootstrap.min.js" integrity="sha384-JjSmVgyd0p3pXB1rRibZUAYoIIy6OrQ6VrjIEaFf/nJGzIxFDsf4x0xIM+B07jRM" crossorigin="anonymous"></script>
</body>


</html>

<script src="../js/jquery.min.js"></script>
<script src="https://cdnjs.cloudflare.com/ajax/libs/sweetalert/2.1.2/sweetalert.min.js"></script>
<script src="https://unpkg.com/sweetalert/dist/sweetalert.min.js"></script>
<script src="../js/notification.js"></script>
<script src="../js/popup_profile.js"></script>
<script src="../js/preloader.js"></script>





<script>
    //  click function in all lab box 


    $('#Manage_Your_account').click(function(){
        window.location.href = "./account.php";

    })




    $(".box1").click(function(e) {
        var Id = $(this).attr('id');
        window.location.href = "../Html/Lab1.php?lab_id=" + Id;
    })

    $('.Lab_del').click(function(e) {
        event.preventDefault();
        e.stopPropagation();
        var Lb_id = $(this).attr('id');
        // alert(Lb_id)
        swal({
                title: "Do you really want to Delete?",
                icon: "warning",
                buttons: true,
                dangerMode: true,
            })
            .then((willDelete) => {

                $.ajax({
                    type: "POST",
                    url: "../php/delet_lab.php",
                    data: {
                        'id': Lb_id
                    },
                    dataType: 'json',
                    success: function(data) {
                        if (data.code == 1) {
                            // swal(data.massage, "success");

                            swal({
                                text: data.massage,
                                icon: "success",
                                button: "OK",
                            }).then((val) => {
                                window.location.reload()

                            });
                            // window.location.reload()

                        } else if (data.code == 0) {

                            swal({
                                text: data.massage,
                                icon: "error",
                                button: "OK",
                            });


                        }
                    }


                })

            });
    })


    // all nave active code
    let btn_cont = location.href
    let btns = document.querySelectorAll('.sidenav a')
    let men = btns.length
    for (let i = 0; i < men; i++) {

        if (btns[i].href === btn_cont) {
            btns[i].className = 'active'
            // document.querySelector('.fa-arrow-left').style.display = 'none';


        }
    }

    // logout button jquary code
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


    // back button js code
    // const history = window.history;
    // const Back_for = () => {
    //     history.back()

    // }

    $(document).ready(function() {
        var rowCount = $(".dropdown .notify_item").length;
        // alert(rowCount); 
        $('#num').html(rowCount);
    });

    $('.fa-list-ul').click(function(e) {
        e.preventDefault()
        alert("hfdsufgdskfgekdfesdfkesdgfkesudg")
    })


    if ($('#profile_img2').attr('src') != '') {
        // alert('gotikkhj');
        $('#profile_img1').hide();

    } else {
        $('#profile_img1').show()
        $('#profile_img2').hide();


    }

    // addbutton and add la

    $('#addLab').click(function() {
        document.querySelector(".form_section").style.display = "flex";

    })

    document.getElementById("close").addEventListener("click", function() {
        document.querySelector(".form_section").style.display = "none";
    });

    $('#add_lab_form').submit(function(e) {
        // let LabName = document.getElementById()
        e.preventDefault();
        $.ajax({
            type: "POST",
            url: "../php/add_new_lab.php",
            data: $('#add_lab_form').serialize(),
            dataType: 'json',
            success: function(data) {
                // alert(data)
                if (data.code == 1) {
                    swal(data.massage, {
                        icon: "success",
                    }).then((val) => {
                        window.location.reload()

                    })

                } else {
                    swal(data.massage, {
                        icon: "error",
                    });


                }
            }

        })
    })
</script>