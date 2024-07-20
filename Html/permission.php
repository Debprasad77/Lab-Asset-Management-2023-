<?php
include './header.php';


?>


<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.2.0/css/all.min.css">
    <link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/bootstrap@4.3.1/dist/css/bootstrap.min.css" integrity="sha384-ggOyR0iXCbMQv3Xipma34MD+dH/1fQ784/j6cY/iJTQUOhcWr7x9JvoRxT2MZw1T" crossorigin="anonymous">
    <link rel="stylesheet" href="../Css/permission.css">
    <title>Permission</title>
</head>

<body>
    <div class="page_body">
        <div id="result"></div>

        <!-- <div class="add_permission">
            <div class="csrd1">
                <p id="close">
                    <i class="fa-regular fa-circle-xmark"></i>

                </p>

                <div class="head">
                    <h1>Permissions</h1>
                </div>

                <div class="p-table">
                    <form id="change_permission" method="post" action="../php/update_user_permission.php">

                        <table>
                            <tr>
                                <th>read</th>
                                <th>write</th>
                            </tr>
                            <tr>
                                <td><input type="checkbox" id="vehicle1" checked value="1" onclick="notChange()" name="read"></td>
                                <td><input type="checkbox" id="vehicle2" value="0" name="write"></td>
                            </tr>
                        </table>
                        <div class="row">
                        <button type="submit" id="subm" name="submit" class="btn btn-primary">Save</button>
                        <button type="button" class="btn btn-danger">Cancel</button>
                        </div>
                    </form>

                </div>


            </div>

        </div> -->





        <div class="container shadow">
            <div class="row row-head">
                <div class="col-sm">
                    Candidate's Name
                </div>
                <div class="col-sm">
                    Status
                </div>
                <div class="col-sm">
                    Action
                </div>
            </div>
            <hr>


            <?php

            $password_ch_qur = "SELECT * FROM `login` ";
            $password_qur_ran = mysqli_query($conn, $password_ch_qur) or die(mysqli_error($conn));

            $no = mysqli_num_rows($password_qur_ran);

            // $table_row = mysqli_fetch_array($password_qur_ran);

            while ($table_row = mysqli_fetch_array($password_qur_ran)) {
                $user = null;

                // $type=$table_row['type'];
                // if ($type == 10) {
                //     // echo'<script>$("#removeElemen").hide()<script>';
                // }

                if ($table_row['status'] == 10) {
                    $user = "Admin";
                    $remove_button='';
                   
                } else {
                    $user = "User";
                    $remove_button=' <button type="button" class="btn btn-danger removeElement"  onclick=remove("' . base64_encode($table_row['id']) . '") >REMOVE</button>';
                }

                $email = $table_row['email'];

                echo '<div class="row row-body">
                
                <div class="col-sm">
                    <div class="notify_img">
                        <img id="profile_img"src="'.$table_row['Img_path'].'" alt="pic" style="width: 50px">
                        <span>' . $table_row['name'] . '</span>
                    </div>
                </div>
                <div class="col-sm">
                    <p>' . $user . '</p>

                </div>
                <div class="col-sm">
                    <button type="button" class="btn btn-primary permission" id="' . $table_row['email'] . '">Change Permission</button>
                    '.$remove_button.'
                </div>
            </div>
            <hr>';
            }

            ?>
        </div>


    </div>
</body>

</html>


<script src="../js/jquery.min.js"></script>
<!-- <script src="https://cdnjs.cloudflare.com/ajax/libs/sweetalert/2.1.2/sweetalert.min.js"></script> -->
<script src="https://cdn.jsdelivr.net/npm/sweetalert2@11"></script>
<script src="https://unpkg.com/sweetalert/dist/sweetalert.min.js"></script>



<script>
    function remove(e) {

        swal({
            title: "Do you really want to Delete",
            icon: "warning",
            buttons: true,
            dangerMode: true,
        }).then((willDelete) => {
            // alert(e);
            if (willDelete) {

                $.ajax({
                    type: "POST",
                    url: "../php/delete_user.php",
                    data: 'id=' + e,
                    dataType: 'json',
                    success: function(data) {
                        if (data.code == 1) {
                            swal(data.massage, {
                                icon: "success",
                            }).then((val) => {
                                window.location.reload();
                            })

                        } else {
                            swal(data.massage, {
                                icon: "error",
                            });


                        }
                    }
                })
            }

        });


    }
</script>
<script>
    // Change Permission password
    $(".permission").click(function(e) {
        var del_id = $(this).attr('id');
        (async () => {

            const {
                value: password
            } = await Swal.fire({
                title: 'Enter your password',
                input: 'password',
                inputLabel: 'Password',
                inputPlaceholder: 'Enter your password',
                inputAttributes: {
                    // maxlength: 10,
                    autocapitalize: 'off',
                    autocorrect: 'off'
                }
            })

            if (password) {
                $.post('../php/check_admin_password.php', {
                        ChPassword: password
                    },
                    function(data) {
                        if (data == "1") {

                            window.location.href = "./change_permiton.php?code=" + del_id;

                        } else {
                            // alert(password)
                            $('#result').html(Swal.fire('Admin password is wrong'));

                        }
                    })
            } else {
                Swal.fire("Entered password")
            }


        })()

    })


</script>