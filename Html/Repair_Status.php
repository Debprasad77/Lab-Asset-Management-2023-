<?php
include './header.php';


?>


<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <link rel="stylesheet" href="../Css/Repair_Status.css">
    <title>Repair_Status</title>
</head>

<body>
    <div class="page_body">
        <div class="wrapper">
            <div class="sidebar">

            </div>
        </div>

        <div class="text">
            <div class="text1">
                <i class="fa-solid fa-circle-check" style="color: #42d737;"></i>
                <h5>Item Repaired</h5><br>
                <i class="fa-solid fa-circle-xmark" style="color: #ff0a0a;"></i>
                <h5>Item Under Repaired</h5><br>
                <!-- <i class="fa-solid fa-circle-exclamation" style="color: #ffee33;"></i>
                <h5>Item Repaired</h5> -->
            </div>
        </div>
        <form id="fdata">
            <div class="sortbox">
                <label for="sort">Sort by:</label>
                <select id="sort" name="sort" onchange="myFunction(this.value)">>
                    <option value="">-----Select-----</option>
                    <option value="1">Active</option>
                    <option value="0">Already Done</option>
                </select><br><br>
                <span for="srch">Or</span>
                <input type="text" name="srch" id="srch" placeholder="Enter Product Serial Number">
                <!-- <button class="btn"> Apply </button> -->
            </div>
        </form>

        <div class="table1">
            <table class="table" width="200px">
                <tr>
                    <th>Item info </th>
                    <th>product serial number</th>
                    <th>Model name</th>
                    <th>Repair center name</th>
                    <th>Floor</th>
                    <th>Lab</th>
                    <th>Desk</th>
                    <th>Send Date</th>
                    <th>Receive date</th>
                    <th>Repair count</th>
                    <th>service info</th>
                </tr>


                <?php
                // die;
                // 
                $sql = "SELECT * FROM repair ";
                $qr = mysqli_query($conn, $sql) or die(mysqli_error($conn));
                while ($row = mysqli_fetch_array($qr)) {

                    $p_sn = $row['p_sn'];

                    // $lab = substr( $row1['lab_id'], 0, strpos($row1['lab_id'], '-') );  //extract lab name
                    // $name = substr( $row1['p_code'], (strpos($row1['p_code'], '_') + 1) );  //extract product name

                    $sql2 = "SELECT * FROM repair where p_sn='$p_sn'";
                    $qr2 = mysqli_query($conn, $sql2) or die(mysqli_error($conn));
                    $noc = mysqli_num_rows($qr2);

                    $bgc = '';
                    if ($row['status'] == 1) {
                        $bgc = 'red';
                    } else {
                        $bgc = '';
                    }

                    $btn = '';
                    if ($row['status'] == 1) {
                        $btn = '<img src="../img/remove.jpeg" id="del_img" onclick=changeStatus("' . $row['id'] . '","0") >';
                    } else {
                        $btn = '<img src="../img/good.jpeg" >';
                    }

                    echo '<tr>
                
                <td>' . $row['p_name'] . '</td>
                <td>' . $row['p_sn'] . '</td>
                <td>' . $row['p_model'] . '</td>
                <td>' . $row['rc_address'] . '</td>
                <td>' . $row['floor'] . '</td>
                <td>' . $row['lab'] . '</td>
                <td>' . $row['desk'] . '</td>
                <td>' . $row['p_s_dttm'] . '</td>
                <td>' . $row['p_r_dttm'] . '</td>
                <td>' . $noc . '</td>
                <td>' . $btn . '</td>
                </tr>';
                }
                ?>


            </table>



        </div>
</body>

</html>



<script src="../js/jquery.min.js"></script>
<script>
    $(document).ready(function() {
        $('#srch').on("keyup", function() {
            var search_item = $(this).val();
            $.ajax({
                type: 'POST',
                url: '../php/Repair_item_serch.php',
                data: {
                    search: search_item
                },
                success: function(data) {
                    $('.table').html(data);

                }
            })
        })
    })

    function changeStatus(id, st) {
        let formdata = new FormData();
        formdata.append('i', id);
        formdata.append('s', st);
        swal({
                title: "Are you sure this product is required?",
                icon: "warning",
                buttons: true,
                dangerMode: true,
            })
            .then((willDelete) => {
                $.ajax({
                    type: "POST",
                    url: "../php/_Repair_Status.php",
                    data: formdata,
                    dataType: "json",
                    processData: false,
                    contentType: false,
                    cache: false,
                    success: function(data) {
                        // alert(data.message);
                        if (data.status == 1) {
                            window.location.reload();
                        }
                    }
                });
            });
        // $.ajax({
        //     type: "POST",
        //     url: "../php/_Repair_Status.php",
        //     data: formdata,
        //     dataType: "json",
        //     processData: false,
        //     contentType: false,
        //     cache: false,
        //     success: function(data) {
        //         // alert(data.message);
        //         if (data.status == 1) {
        //             window.location.reload();
        //         }
        //     }
        // });
    }




    function myFunction(data) {

        $.ajax({
            type: 'POST',
            url: '../php/Repair_item_serch.php',
            data: {
                sdata: data
            },
            success: function(data) {
                $('.table').html(data);

            }
        })
        // let req = new XMLHttpRequest();
        // req.open('GET', 'select_customer.php?name_select=' + data, true);
        // req.send();
        // req.onreadystatechange = function() {
        //     if (req.readyState == 4 && req.status == 200) {
        //         document.getElementById('address_print').innerHTML = req.responseText;
        //     }
        // }
    }
</script>