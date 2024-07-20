<?php
// include ("../php/config.php");
include '../Html/header.php';

// echo"<pre>";
// print_r($p_c_arr);

// echo"<pre>";
// print_r($p_q_arr);


// die;
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
    <link rel="stylesheet" href="../Css/Lab1.css">
    <link rel="stylesheet" href="../Css/lab1_add_first.css">
    <title>lab</title>
</head>

<body>
    <div class="page_body">
        <div class="pageHade">
            <?php
            $labId = $_GET['lab_id'];
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


        <!-- <hr> -->
        <!-- add new item -->
        <div class="form_section">
            <div class="form_center">

                <p id="close">
                    <i class="fa-regular fa-circle-xmark"></i>
                </p>

                <form id="add_form">

                    <div class="form-group">
                        <label for="product">Enter Product Name:</label>
                        <input type="text" placeholder="eg: mouse or cpu" name="product" id="product">
                        <span class='product_err'></span>
                    </div>

                    <div class="form-group">
                        <label for="file">Choose Product Image(Optional):</label>
                        <input type='file' id="file" name='filedata' accept="image/png, image/jpeg">
                        <span id='show'>Max Size: 1MB. Supported file png & jpeg</span><br>
                        <span id='file_err'></span>
                    </div>

                    <div class="from-group">
                        <input type="submit" value="submit" name="submit" id="btn" class="btn">
                    </div>

                </form>
            </div>
        </div>

        <div class="table_section">

            <table>
                <tr>
                    <th>Product </th>
                    <th>Name</th>
                    <th>Quantity</th>
                    <th>Products need to be fixed</th>
                    <th>Action</th>
                </tr>

                <?php

                $labId = $_GET['lab_id'];

                $_SESSION['LabID'] = $labId;
                $labId_u = base64_decode($labId);

                $sql = "SELECT * FROM product_code WHERE lab_id = '$labId_u'";
                $qr = mysqli_query($conn, $sql) or die(mysqli_error($conn));

                while ($row = mysqli_fetch_array($qr)) {

                    $code = $row['p_code'];
                    $sql1 = "SELECT * FROM product WHERE p_code = '$code'";
                    $qr1 = mysqli_query($conn, $sql1) or die(mysqli_error($conn));
                    $noc = mysqli_num_rows($qr1);
                    $_product_row = mysqli_fetch_array($qr1);

                    $product_sn_repiar = $_product_row['p_code'];



                    $Products_need_to_be_fixed = "SELECT * FROM product WHERE status = '0' AND p_code = '$product_sn_repiar'";
                    $need_to_be_fixed_qr2 = mysqli_query($conn, $Products_need_to_be_fixed) or die(mysqli_error($conn));
                    $need_to_be_fixed_noc = mysqli_num_rows($need_to_be_fixed_qr2);


                    echo '<tr class="hov">

                    <td data-href=" ./_lab1_pro_1.php?code=' . base64_encode($row['p_code']) . '&LabId=' . $labId . ' "><img src="' . $row['img_path'] . '" alt="' . $row['p_name'] . '"></td>
                    
                    <td data-href=" ./_lab1_pro_1.php?code=' . base64_encode($row['p_code']) . '&LabId=' . $labId . ' ">' . $row['p_name'] . '</td>        

                    <td data-href=" ./_lab1_pro_1.php?code=' . base64_encode($row['p_code']) . '&LabId=' . $labId . ' ">' . $noc . '</td>

                    <td data-href=" ./_lab1_pro_1.php?code=' . base64_encode($row['p_code']) . '&LabId=' . $labId . ' ">' . $need_to_be_fixed_noc . '</td>

                         

                    <td ><i id="del_img" onclick=remove("' . base64_encode($row['id']) . '&LabId=' . $labId . '") class="fa-solid fa-trash"></i></td>
                    </tr>';
                }
                ?>
        </div>
    </div>


    <script src="../js/lab1.js"></script>
    <script src="../js/jquery.min.js"></script>

    <script src="https://cdn.jsdelivr.net/npm/sweetalert2@11"></script>
    <script src="https://unpkg.com/sweetalert/dist/sweetalert.min.js"></script>

</body>

</html>

<script>
    $(document).ready(function() {
        $("#add_form").submit(function(e) {
            e.preventDefault();

            $('')
            $('.product_err').html('');
            if ($("#product").val() == '') {
                $("#product").focus();
                $('.product_err').html('Please Enter product name !');
                return false;
            }

            const formData = new FormData(document.getElementById('add_form'));


            $.ajax({
                type: "POST",
                url: "../php/lab1_ch.php",
                data: formData,
                dataType: "json",
                processData: false,
                contentType: false,
                cache: false,
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
        });
    });
</script>