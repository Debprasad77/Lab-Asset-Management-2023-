<?php
include './config.php';

$search_valu = $_POST['search'];

$s_valu = $_POST['sdata'];

if ($s_valu == '') {
    $cnt = 0;
    $table_sql = "SELECT * FROM `repair`  WHERE p_sn LIKE '%{$search_valu}%'";
    $table_qur_ran = mysqli_query($conn, $table_sql) or die(mysqli_error($conn));

    $output = "";
    // echo$search_valu;
    // die;
    if (mysqli_num_rows($table_qur_ran)) {
        $output = '<table class="table" width="200px">
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
                </tr>';
        while ($table_row = mysqli_fetch_array($table_qur_ran)) {



            $sql2 = "SELECT * FROM repair where p_sn='$p_sn'";
            $qr2 = mysqli_query($conn, $sql2) or die(mysqli_error($conn));
            $noc = mysqli_num_rows($qr2);


            $btn = '';
            if ($table_row['status'] == 1) {
                $btn = '<img src="../Img/remove.jpeg" id="del_img" onclick=changeStatus("' . $table_row['id'] . '","0") >';
            } else {
                $btn = '<img src="../img/good.jpeg" >';
            }

            $output .= '<tr>
                
               <td>' . $table_row['p_name'] . '</td>
               <td>' . $table_row['p_sn'] . '</td>
               <td>' . $table_row['p_model'] . '</td>
               <td>' . $table_row['rc_address'] . '</td>
               <td>' . $table_row['floor'] . '</td>
               <td>' . $table_row['lab'] . '</td>
               <td>' . $table_row['desk'] . '</td>
               <td>' . $table_row['p_s_dttm'] . '</td>
               <td>' . $table_row['p_r_dttm'] . '</td>
               <td>' . $noc . '</td>
               <td>' . $btn . '</td>
               </tr>';
        }

        $output .= "</table>";

        echo $output;
    } else {
        echo '<h3>No Record Found</h3>';
    }
} else {
    $cnt = 0;
    $table_sql = "SELECT * FROM `repair`  WHERE p_sn LIKE '%{$search_valu}%' and  status = '$s_valu'";
    $table_qur_ran = mysqli_query($conn, $table_sql) or die(mysqli_error($conn));

    $output = "";
    // echo$search_valu;
    // die;
    if (mysqli_num_rows($table_qur_ran)) {
        $output = '<table class="table" width="200px">
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
                </tr>';
        while ($table_row = mysqli_fetch_array($table_qur_ran)) {



            $sql2 = "SELECT * FROM repair where p_sn='$p_sn'";
            $qr2 = mysqli_query($conn, $sql2) or die(mysqli_error($conn));
            $noc = mysqli_num_rows($qr2);


            $btn = '';
            if ($table_row['status'] == 1) {
                $btn = '<img src="../Img/remove.jpeg" id="del_img" onclick=changeStatus("' . $table_row['id'] . '","0") >';
            } else {
                $btn = '<img src="../img/good.jpeg" >';
            }

            $output .= '<tr>
                
               <td>' . $table_row['p_name'] . '</td>
               <td>' . $table_row['p_sn'] . '</td>
               <td>' . $table_row['p_model'] . '</td>
               <td>' . $table_row['rc_address'] . '</td>
               <td>' . $table_row['floor'] . '</td>
               <td>' . $table_row['lab'] . '</td>
               <td>' . $table_row['desk'] . '</td>
               <td>' . $table_row['p_s_dttm'] . '</td>
               <td>' . $table_row['p_r_dttm'] . '</td>
               <td>' . $noc . '</td>
               <td>' . $btn . '</td>
               </tr>';
        }

        $output .= "</table>";

        echo $output;
    } else {
        echo '<h3>No Record Found</h3>';
    }
}
