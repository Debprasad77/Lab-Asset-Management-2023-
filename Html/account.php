<?php
include './header.php';


?>
<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <title>Account Settings UI Design</title>
    <meta content="width=device-width, initial-scale=1, maximum-scale=1, user-scalable=no" name="viewport">
    <link rel="stylesheet" type="text/css" href="https://stackpath.bootstrapcdn.com/bootstrap/4.3.1/css/bootstrap.min.css">
    <link rel="stylesheet" href="https://stackpath.bootstrapcdn.com/font-awesome/4.7.0/css/font-awesome.min.css">

    <!-- <link rel="stylesheet" href="http://maxcdn.bootstrapcdn.com/bootstrap/3.3.6/css/bootstrap.min.css"> -->
    <script src="https://ajax.googleapis.com/ajax/libs/jquery/1.12.4/jquery.min.js"></script>
    <!-- <script src="http://maxcdn.bootstrapcdn.com/bootstrap/3.3.6/js/bootstrap.min.js"></script> -->
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/croppie/2.6.5/croppie.min.css" />
    <link rel="stylesheet" href="../Css/account.css">
</head>

<body>
    <div class="page_body">
        <section class="py-2 my-2">
            <div class="container">
                <div class="bg-white shadow rounded-lg d-block ">
                    <!-- <i class="fa fa-arrow-left"></i> -->

                    <div class="profile-tab-nav text-center ">
                        <?php


                        $email = $_SESSION['email'];
                        $sql1 = "SELECT * FROM `login` WHERE email ='$email'";
                        $qr1 = mysqli_query($conn, $sql1) or die(mysqli_error($conn));
                        $noc = mysqli_num_rows($qr1);
                        $row = mysqli_fetch_array($qr1);

                        $user = null;

                        if ($row['status'] == 10) {
                            $user = "Admin";
                        } else {
                            $user = "User";
                        }

                        ?>

                        <div class="p-3">
                            <div class="img-circle mb-3">
                                <form id="imgForm">
                                    <input type="file" name="image" id="image">
                                </form>
                                <?php echo ' <img id="pro_img1"  src="' . $row['Img_path'] . '" alt="Image" class="shadow" >' ?>
                            </div>
                            <h4 class="text-center"><?php echo $row['name'] ?></h4>
                            <h6 style="color:green"><?php echo $user ?></h6>
                        </div>


                        <div id="uploadimageModal" class="modal" role="dialog">
                            <div class="modal-dialog">
                                <div class="modal-content">
                                    <div class="modal-header">
                                        <button type="button" class="close" data-dismiss="modal">×</button>
                                        <h4 class="modal-title">Upload & Crop Image</h4>
                                    </div>
                                    <div class="modal-body">
                                        <div class="row">
                                            <div class="col-md-8 text-center">
                                                <div id="image_demo" style="width:350px; margin-top:30px"></div>
                                            </div>
                                            <div class="col-md-4" style="padding-top:30px;">
                                                <br />
                                                <br />
                                                <br />
                                                <button class="btn btn-success crop_image">Crop & Upload Image</button>
                                            </div>
                                        </div>
                                    </div>
                                    <div class="modal-footer">
                                        <button type="button" class="btn btn-default" data-dismiss="modal">Close</button>
                                    </div>
                                </div>
                            </div>
                        </div>


                        <div class="nav flex-row nav-pills border-bottom" id="v-pills-tab " role="tablist" aria-orientation="vertical">
                            <a class="nav-link active" id="account-tab" data-toggle="pill" href="#account" role="tab" aria-controls="account" aria-selected="true">
                                <i class="fa fa-home" aria-hidden="true"></i>
                                Account
                            </a>
                            <a class="nav-link" id="password-tab" data-toggle="pill" href="#password" role="tab" aria-controls="password" aria-selected="false">
                                <i class="fa fa-key" aria-hidden="true"></i>
                                Password
                            </a>

                        </div>
                    </div>
                    <div class="tab-content p-4 p-md-5" id="v-pills-tabContent">
                        <div class="tab-pane fade show active" id="account" role="tabpanel" aria-labelledby="account-tab">
                            <h3 class="mb-4">Account Settings</h3>
                            <div class="row">
                                <div class="col-md-6">
                                    <div class="form-group">
                                        <label>Name</label>
                                        <input type="text" id="Name" class="form-control" value='<?php echo $row['name'] ?>'>
                                    </div>
                                </div>
                                <div class="col-md-6">
                                    <div class="form-group">
                                        <label>Email</label>
                                        <input type="email" id="Email" class="form-control" value="<?php echo $row['email'] ?>">
                                    </div>
                                </div>
                                <div class="col-md-6">
                                    <div class="form-group">
                                        <label>Phone number</label>
                                        <input type="number" id="Phone" class="form-control" value="<?php echo $row['phone_number'] ?>">
                                    </div>
                                </div>

                            </div>
                            <div>
                                <button class="btn btn-primary" id="user_data">Update</button>
                                <button class="btn btn-light">Cancel</button>
                            </div>
                        </div>
                        <div class="tab-pane fade" id="password" role="tabpanel" aria-labelledby="password-tab">
                            <h3 class="mb-4">Password Settings</h3>
                            <div class="row">
                                <div class="col-md-6">
                                    <div class="form-group">
                                        <label>Old password</label>
                                        <input id="old_pass" type="password" class="form-control">
                                    </div>
                                </div>
                            </div>
                            <div class="row">
                                <div class="col-md-6">
                                    <div class="form-group">
                                        <label>New password</label>
                                        <input id="new_pass" type="password" class="form-control">
                                    </div>
                                </div>
                                <div class="col-md-6">
                                    <div class="form-group">
                                        <label>Confirm new password</label>
                                        <input id="con_pass" type="password" class="form-control">
                                    </div>
                                </div>
                            </div>
                            <div>
                                <button id="update_pass" class="btn btn-primary">Update</button>
                                <button class="btn btn-light">Cancel</button>
                            </div>
                        </div>

                    </div>
                </div>
            </div>
        </section>




    </div>
</body>

</html>

<!-- <script src="https://unpkg.com/sweetalert/dist/sweetalert.min.js"></script> -->

<script src="../js/jquery.min.js"></script>
<script src="https://ajax.googleapis.com/ajax/libs/jquery/1.12.4/jquery.min.js"></script>
<script src="https://cdnjs.cloudflare.com/ajax/libs/croppie/2.6.5/croppie.min.js"></script>

<!-- <script src="https://code.jquery.com/jquery-3.2.1.slim.min.js"></script> -->
<script src="https://cdnjs.cloudflare.com/ajax/libs/popper.js/1.12.9/umd/popper.min.js"></script>
<script src="https://maxcdn.bootstrapcdn.com/bootstrap/4.0.0/js/bootstrap.min.js"></script>

<script src="https://cdn.jsdelivr.net/npm/sweetalert2@11"></script>
<script src="https://unpkg.com/sweetalert/dist/sweetalert.min.js"></script>


<script>
    $(document).ready(function() {

        $image_crop = $('#image_demo').croppie({
            enableExif: true,
            viewport: {
                width: 200,
                height: 200,
                type: 'square' //circle
            },
            boundary: {
                width: 300,
                height: 300
            }
        });

        $('#image').on('change', function() {
            var reader = new FileReader();
            reader.onload = function(event) {
                $image_crop.croppie('bind', {
                    url: event.target.result
                }).then(function() {
                    console.log('jQuery bind complete');
                });
            }
            reader.readAsDataURL(this.files[0]);
            $('#uploadimageModal').modal('show');
        });

        $('.crop_image').click(function(event) {
            $image_crop.croppie('result', {
                type: 'canvas',
                size: 'viewport'
            }).then(function(response) {
                $.ajax({
                    url: "../php/uplode_photo.php",
                    type: "POST",
                    data: {
                        "image": response
                    },
                    success: function(data) {
                        window.location.reload();
                        // $('#uploadimageModal').modal('hide');
                        // $('.img').html(data);
                    }
                });
            })
        });

    });


    // user data update

    $('#user_data').click(function() {
        let name = document.getElementById('Name').value;
        let email = document.getElementById('Email').value;
        let phone = document.getElementById('Phone').value;
        // alert(name);
        $.ajax({
            url: "../php/account_ch.php",
            type: "POST",
            dataType: 'json',
            data: {
                Name: name,
                Email: email,
                Phone: phone
            },
            success: function(data) {
                if (data.code == 1) {
                    Swal.fire(data.massage, {
                        icon: 'success',
                        showConfirmButton: false,
                        timer: 1500
                    }).then((data) => {
                        window.location.reload();

                    })

                } else {
                    Swal.fire(data.massage, {
                        icon: 'error',
                        showConfirmButton: false,
                        timer: 1500
                    }).then((data) => {
                        window.location.reload();

                    })


                }

            }
        });
    })



    // User password update
    $('#update_pass').click(function() {
        let OldPass = document.getElementById('old_pass').value;
        let NewPass = document.getElementById('new_pass').value;
        let ConPass = document.getElementById('con_pass').value;
        // alert(name);
        $.ajax({
            url: "../php/update_account_pass.php",
            type: "POST",
            dataType: 'json',
            data: {
                Old_pass: OldPass,
                New_pass: NewPass,
                Con_pass: ConPass
            },
            success: function(data) {
                if (data.code == 1) {
                    Swal.fire(data.massage, {
                        icon: 'success',
                        showConfirmButton: false,
                        timer: 1500
                    }).then((data) => {
                        window.location.reload();

                    })

                } else {
                    Swal.fire(data.massage, {
                        icon: 'error',
                        showConfirmButton: false,
                        timer: 1500
                    })


                }

            }
        });
    })

    if ($('#pro_img1').attr('src') != '') {
        // alert('gotikkhj');
        // $('#pro_img1').hide();

    } else {
        // $('#pro_img1').show()
        $('#pro_img1').hide();


    }
</script>