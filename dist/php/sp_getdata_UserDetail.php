<?php

    $code = $_POST['code'];


    if($code == 1){

        include("connect_db.php");

        $user_class  = $_POST['user_class'];
        $user_code   = $_POST['user_code'];

        if($user_class == 2){

            $sql=" SELECT * FROM cpw.dbo.teacher_main WHERE tec_status = 1 and tec_number = '$user_code'";
            $stmt = sqlsrv_query($conn, $sql);
            if ($stmt === false) {
                die(print_r(sqlsrv_errors(), true));
            }
            $row = sqlsrv_fetch_array($stmt, SQLSRV_FETCH_ASSOC);
            echo 'https://app.cpw.ac.th/cpw_api_content/images/teacher/'.$row['tec_image'].'###'.$row['tec_title'].$row['tec_name'].' '.$row['tec_lname'].'###'.$row['tec_id'].'###'.$row['code'];

        }
        if($user_class == 1){

            $sql=" SELECT * FROM cpw.dbo.student_main WHERE status_key not in (2,3,4,5) and info_number_std = '$user_code'";
            $stmt = sqlsrv_query($conn, $sql);
            if ($stmt === false) {
                die(print_r(sqlsrv_errors(), true));
            }
            $row = sqlsrv_fetch_array($stmt, SQLSRV_FETCH_ASSOC);
            echo 'https://app.cpw.ac.th/cpw_api_content/images/student/'.$row['image_pro'].'###'.$row['info_title'].$row['info_name_th'].' '.$row['info_lname_th'].'###'.$row['info_id'].'###'.$row['code'];

        }

    }