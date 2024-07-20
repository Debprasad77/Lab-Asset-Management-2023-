<?php
include './header.php';
// include('../php/config.php');

$code = base64_decode($_REQUEST['code']);

// $sql = "SELECT * FROM product_code WHERE p_code = '$code'";
// $qr = mysqli_query($conn, $sql) or die(mysqli_error($conn));
// $row = mysqli_fetch_array($qr);
?>


<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <link rel="preconnect" href="https://fonts.googleapis.com">
    <link rel="preconnect" href="https://fonts.gstatic.com" crossorigin>
    <link href="https://fonts.googleapis.com/css2?family=Poppins:wght@700&family=Roboto&display=swap" rel="stylesheet">

    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.1.1/css/all.min.css">
    <link rel="stylesheet" href="../Css/Lab1_pro_1.css">
    <link rel="stylesheet" href="../Css/_lab1_pro_1_add_first.css">
    <title>lab</title>
</head>

<body>
    <div class="page_body">
        <div class="pageHade">
            <?php
            $labId = $_GET['LabId'];
            $labId_nam = base64_decode($labId);

            $sql11 = "SELECT * FROM lab_data WHERE lab_id = '$labId_nam'";
            $qr11 = mysqli_query($conn, $sql11) or die(mysqli_error($conn));
            //  $no = mysqli_num_rows($qr11);
            if ($rowLab = mysqli_fetch_array($qr11)) {
                echo '<span id="heading">' . $rowLab['lab_name'] . '</span>';
            }

            ?>
            <input onclick="addClick()" type="button" value="Add New Item">
        </div>

        <!-- add new item -->
        <div class="form_section">
            <div class="form_center">

                <p id="close">
                    <i class="fa-regular fa-circle-xmark"></i>
                </p>

                <form id="add_form">

                    <div class="form-group">
                        <label for="product">Product Code:</label>
                        <input name="product" id="product" type="text" value="<?php echo $code ?>" readonly><br>
                        <span class='product_err'></span>
                    </div>

                    <div class="form-group">
                        <label for="desk">Enter Desk Number:</label>
                        <input type="number" placeholder="Optional" name="desk" id="desk"><br>
                        <span class='desk_err'></span>
                    </div>

                    <div class="form-group">
                        <label for="company">Enter Company Name:</label>
                        <input type="text" placeholder="Company Name" name="company" id="company"><br>
                        <span class='company_err'></span>
                    </div>

                    <div class="form-group">
                        <label for="model">Enter Model Name:</label>
                        <input type="text" placeholder="Model Name" name="model" id="model"><br>
                        <span class='model_err'></span>
                    </div>

                    <div class="form-group">
                        <label for="serial">Enter Serial Number:</label>
                        <input type="text" placeholder="Serial Number" name="serial" id="serial"><br>
                        <span class='serial_err'></span>
                    </div>

                    <div class="form-group">
                        <label for="dop">Enter Purchase Date:</label>
                        <input type="date" name="dop" id="dop"><br>
                        <span class='Purchase_err'></span>
                    </div>

                    <div class="form-group">
                        <label for="warrenty">Enter Warrenty Period:</label>
                        <input type="date" name="Warrenty" id="warrenty"><br>
                        <span class='Warrenty_err'></span>
                    </div>

                    <button type="submit" class="form-group" id="Add_btn">ADD</button>
                </form>
            </div>

        </div>

    </div>

    <div class="table_section">
        <table>
            <tr>
                <th>sl. no</th>
                <th>Desk Number</th>
                <th>Product Serial Number</th>
                <th>Model Number</th>
                <th>company Name</th>
                <th>Purchase Date </th>
                <th>Warrenty Period </th>
                <th>Action</th>
                <th>Status</th>
            </tr>
            <?php

            $lab_id = $_GET['LabId'];
            $_SESSION['LabID2'] = $lab_id;


            $sql1 = "SELECT * FROM product WHERE p_code = '$code'";
            $qr1 = mysqli_query($conn, $sql1) or die(mysqli_error($conn));


            $count = 1;
            while ($row1 = mysqli_fetch_array($qr1)) {

                echo '<tr>
                    <td>' . $count . '</td>
                    <td>' . $row1['desk'] . '</td>
                    <td>' . $row1['p_sn'] . '</td>
                    <td>' . $row1['p_model'] . '</td>
                    <td>' . $row1['brand'] . '</td>
                    <td>' . date("l d, M Y", strtotime($row1['dop'])) . '</td>
                    <td>' . $row1['w_period'] . '</td>

                    <td>
                    <i id="del_img" onclick=remove("' . base64_encode($row1['id']) . '") class="fa-solid fa-trash"></i>
                    </td>';
                if ($row1['status'] == 1) {
                    echo '<td> <i onclick=Srepair("' . base64_encode($row1['id']) . '") class="fa-solid fa-circle-check good"></td>';
                } else {
                    echo '<td><i class="fa-solid fa-circle-exclamation bad"></td>';
                }

                echo '</tr>';
                $count++;
            }
            ?>
        </table>
    </div>
    </div>

    <script src="../js/_lab1_pro_1.js"></script>
    <script src="../js/jquery.min.js"></script>
    <script src="https://cdn.jsdelivr.net/npm/sweetalert2@11"></script>
    <script src="https://unpkg.com/sweetalert/dist/sweetalert.min.js"></script>
</body>

</html>

<script>
    $("#add_form").submit(function(e) {
        e.preventDefault();

        $('.product_err').html('');
        if ($("#product").val() == '$code') {
            $("#product").focus();
            $('.product_err').html('Please Enter product name !');
            return false;
        }
        $('.company_err').html('');
        if ($("#company").val() == '') {
            $("#company").focus();
            $('.company_err').html('Please Enter company name !');
            return false;
        }
        $('.model_err').html('');
        if ($("#model").val() == '') {
            $("#model").focus();
            $('.model_err').html('Please Enter model name !');
            return false;
        }
        $('.serial_err').html('');
        if ($("#serial").val() == '') {
            $("#serial").focus();
            $('.serial_err').html('Please Enter Serial name !');
            return false;
        }
        $('.Purchase_err').html('');
        if ($("#dop").val() == '') {
            $("#dop").focus();
            $('.Purchase_err').html('Please Enter Purchase date!');
            return false;
        }
        $('.Warrenty_err').html('');
        if ($("#warrenty").val() == '') {
            $("#warrenty").focus();
            $('.Warrenty_err').html('Please Enter Warrenty period !');
            return false;
        }

        const formData = new FormData(document.getElementById('add_form'));
        //Update Status

        $.ajax({
            type: "POST",
            url: "../php/_lab1_pro_1.php",
            data: formData,
            dataType: "json",
            processData: false,
            contentType: false,
            cache: false,
            success: function(data) {

                if (data.code == 1) {
                    Swal.fire(data.massage, {
                        // position: 'top-end',
                        icon: 'success',
                        // title: 'Your work has been saved',
                        showConfirmButton: false,
                        timer: 1500
                    }).then((data) => {
                        window.location.reload();

                    })

                } else {
                    Swal.fire(data.massage, {
                        // position: 'top-end',
                        icon: 'error',
                        // title: 'Your work has been saved',
                        showConfirmButton: false,
                        timer: 1500
                    }).then((data) => {
                        // window.location.reload();

                    })


                }








                // if (data.status == '11') {
                //     swal.fire({
                //         // Submit Success
                //         icon: "success",
                //         title: data.message,
                //         showConfirmButton: false,
                //         timer: 500
                //     }).then((value) => {
                //         location.reload();
                //     });
                // } else if (data.status == '10') {
                //     swal.fire({
                //         // Submit Not Success
                //         icon: "error",
                //         title: data.message,
                //     });
                // } else if (data.status == '01') {
                //     swal.fire({
                //         // Product Already Exist!
                //         icon: "error",
                //         title: data.message,
                //         text: 'Check The Serial Number & Try Again',
                //     });
                // } else {
                //     swal.fire({
                //         // Product Code Not Found
                //         icon: "error",
                //         title: data.message,
                //         text: 'Don\'t Change The Product Code',
                //     });
                // }
            }
        });
    });
</script>