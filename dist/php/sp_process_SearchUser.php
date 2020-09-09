<?php
// session_start();
include('function_Pagination.php');
include('function_get_UserData.php');
include('connect_db.php');
$actions = $_POST['actions'];

if ($actions == '1') {
    $ref_id_final = $_POST['ref_id_final'];
    if (isset($_POST["showby"])) {
        if ($_POST["showby"] == 0) {
            $show_by = count($ref_id_final) ;
        } else {
            $show_by = $_POST["showby"];
        }
    }
    $limit = $show_by;
    $page = 1;
    if ($_POST['page'] > 1) {
        $start = (($_POST['page'] - 1) * $limit);
        $page = $_POST['page'];
    } else {
        $start = 0;
    }

         
    if (isset($_POST["sortby"])) {
        if ($_POST["sortby"] == 1) {
            $sort_by = " ORDER BY user_id ASC ";
        } elseif ($_POST["sortby"] == 2) {
            $sort_by = " ORDER BY user_id DESC ";
        } elseif ($_POST["sortby"] == 3) {
            $sort_by = " ORDER BY user_code ASC ";
        } elseif ($_POST["sortby"] == 4) {
            $sort_by = " ORDER BY user_code DESC ";
        }
    } else {
        $sort_by = " ";
    }
    // $sql_final = " SELECT * FROM data_user where ref_id IN ('".$ref_id_final_filter."') ".$sort_by." OFFSET ".$start." ROWS FETCH NEXT ".$limit." ROWS ONLY ";

    $ref_id_final_filter = implode(",", $ref_id_final);
    $sql_final = " SELECT * FROM data_user where ref_id IN (".$ref_id_final_filter.") ".$sort_by." OFFSET ".$start." ROWS FETCH NEXT ".$limit." ROWS ONLY  ";
    $stmt_final = sqlsrv_query($conn, $sql_final);
    if ($stmt_final === false) {
        die(print_r(sqlsrv_errors(), true));
        // $data .= '<input type="hidden" name="count_data" id="count_data" class="form-control" value="'.count($ref_id_final).'">';
    }
    while ($fetch_final = sqlsrv_fetch_array($stmt_final, SQLSRV_FETCH_ASSOC)) {
        if ($fetch_final['user_class'] == 1) {
            $DataPeople  = getdataStudent($conn, $fetch_final['ref_id']);
            
            $image   = 'https://app.cpw.ac.th/cpw_api_content/images/student/' . $DataPeople['image_pro'];
            $name    = $DataPeople['info_title']. $DataPeople['info_name_th'].' '. $DataPeople['info_lname_th'];
            $userCode  = $DataPeople['info_number_std'];
        } elseif ($fetch_final['user_class'] == 2) {
            $DataPeople  = getdataTeacher($conn, $fetch_final['ref_id']);
            $image   = 'https://app.cpw.ac.th/cpw_api_content/images/teacher/' . $DataPeople['tec_image'];
            $name    = $DataPeople['tec_title']. $DataPeople['tec_name'].' '. $DataPeople['tec_lname'];
            $userCode  = $DataPeople['tec_number'];
        }
        
        if ($fetch_final['user_stats'] == 1) {
            $status   = '<span class="badge badge-success">ใช้งานได้</span>';
        } else {
            $status   = '<span class="badge badge-danger">ไม่ให้ใช้งาน</span>';
        }
        $data .= ' <div class="col-lg-4 col-md-6 col-sm-12 col-xs-12  col-12"> ';
        $data .= ' <div class="info-box mb-3 card-hover-shadow" style="">';
        $data .= ' <span class="info-box-icon-basic info-box-icon-member info-box-icon" style="overflow: hidden;"><img src="'.$image.'"  style=" position: relative;"  class=" image-responsive"   alt="" ></span>';
        // $data .= ' <span class="info-box-icon0 info-box-icon" style="background-repeat: no-repeat;background-size: cover;overflow: hidden;
        // background-image: url('.$image.');"></span>';
        $data .= ' <div class="info-box-content">';
        $data .= ' <span class="info-box-text">'.$name.'</span>';
        $data .= ' <span class="info-box-text">รหัสประจำตัว : '.$userCode.'</span>';
        $data .= ' <span class="info-box-text">สถานะ : '.$status.' </span></a>';
        $data .= ' <span class="justify-content-end" style="float: right!important;">';
        $data .= ' <div class="btn-group">';
        $data .= ' <a  href="profile.php?ref='.$fetch_final['user_id'].'" class="btn btn-outline-primary byn- btn-sm">ดูรายละเอียด</a>';
        // $data .= ' <button type="button" onclick="" class="btn btn-warning btn-sm">แก้ไข</button>';
        // $data .= ' <button type="button" class="btn btn-danger btn-sm">ลบ</button>';
        $data .= ' </div>';
        $data .= ' </span>';
        $data .= ' </div>';
        $data .= ' </div>';
        $data .= ' </div> ';
    }

    if ($data == '') {
        $data  = 'NoFound101';
    }
    echo $data;
} elseif ($actions == '3') {
     $search  = str_replace("'", " ", trim($_POST["search"]));
     $search = str_replace(' ', '%', $search);
     // $search = trim($_POST["search"]);
     // $ref_id_1st_stu=array();
     // $ref_id_1st_tec=array();

     $sql_1st = " SELECT * FROM data_user";
     $stmt_1st = sqlsrv_query($conn, $sql_1st);
     if ($stmt_1st === false) {
         die(print_r(sqlsrv_errors(), true));
     }
     while ($fetch_1st = sqlsrv_fetch_array($stmt_1st, SQLSRV_FETCH_ASSOC)) {
         if ($fetch_1st['user_class'] == 1) {
             $ref_id_1st_stu[] = $fetch_1st['ref_id'];

         // array_push($ref_id_1st_stu, $fetch_1st['ref_id']);
         } elseif ($fetch_1st['user_class'] == 2) {
             $ref_id_1st_tec[] = $fetch_1st['ref_id'];

             // array_push($ref_id_1st_tec, $fetch_1st['ref_id']);
         }
         // echo json_encode($fetch_1st['ref_id']);
     }
     $ref_id_1_t_filter = implode(",", $ref_id_1st_tec);
     $ref_id_1_s_filter = implode(",", $ref_id_1st_stu);


     // echo json_encode($ref_id_1_s_filter);

     // เตรียมตรวจสอบชื่อ และนามสกุล
     $numsearchby = 0;
     $search_m_tec = " ";
     $search_m_stu = " ";

     if (isset($_POST["searchbyty"])) {
         if (in_array("6", $_POST["searchbyty"]) && !in_array("7", $_POST["searchbyty"])) {
             $search_m_tec = " AND gender_id =1 ";
             $search_m_stu = " AND gender_key=1 ";
         // male
         }
         // else {
         //     $search_m_tec = " ";
         //      $search_m_stu = " ";

         // }
         elseif (in_array("7", $_POST["searchbyty"]) && !in_array("6", $_POST["searchbyty"])) {
             //female
             $search_m_tec = " AND gender_id =2 ";
             $search_m_stu = " AND gender_key=2 ";
         } else {
             $search_m_tec = " ";
             $search_m_stu = " ";
         }
     }

     if ($search != '') {
         if (isset($_POST["searchby"])) {
             if (in_array("1", $_POST["searchby"])) {
                 //  echo "<script>alert('Hi 1') </script>";
                 $search_name_stu = " OR info_name_th LIKE '%" . $search . "%' ";
                 $search_name_tec = " OR tec_name LIKE '%" . $search . "%' ";
             // echo $search_name_stu;
             } else {
                 $search_name_stu = " ";
                 $search_name_tec = " ";
                 $numsearchby++;
             }
             if (in_array("2", $_POST["searchby"])) {
                 //  echo "<script>alert('Hi 1') </script>";
                 $search_lname_stu = " OR info_lname_th LIKE '%" . $search . "%' ";
                 $search_lname_tec = " OR tec_lname LIKE '%" . $search . "%' ";
             //    echo $search_lname_tec;
             } else {
                 $search_lname_stu = " ";
                 $search_lname_tec = " ";
                 $numsearchby++;
             }
             if (in_array("3", $_POST["searchby"])) {
                 // จะนำไปเช็คตอนหลัง
                 $search_code_stu = " OR info_number_std LIKE '%" . $search . "%' ";
                 $search_code_tec = " OR tec_number LIKE '%" . $search . "%' ";
             //    echo $search_code_stu;
             } else {
                 $search_code_stu = " ";
                 $numsearchby++;
                 $search_code_tec = " ";
             }
             if (in_array("4", $_POST["searchby"])) {
                 //  echo "<script>alert('Hi 1') </script>";
                   
                 $search_phone_stu = " OR info_number_phone LIKE '%" . $search . "%' ";
                 $search_phone_tec = " OR tec_phone LIKE '%" . $search . "%' ";
             // echo $search_phone_stu;
             } else {
                 $search_phone_stu = " ";
                 $search_phone_tec = " ";
                 $numsearchby++;
             }
        
             $sql_2nd_tec = " SELECT  * FROM cpw.dbo.teacher_main where (tec_id = '-1' ".$search_name_tec." ".$search_lname_tec." ".$search_phone_tec." ".$search_code_tec.") ".$search_m_tec." AND tec_id IN (".$ref_id_1_t_filter.")";
             $sql_2nd_stu = " SELECT  * FROM cpw.dbo.student_main where (info_id = '-1' ".$search_name_stu." ".$search_lname_stu." ".$search_phone_stu." ".$search_code_stu.") ".$search_m_stu." AND info_id IN (".$ref_id_1_s_filter.") ";
         } else {
             $sql_2nd_tec = " SELECT  * FROM cpw.dbo.teacher_main where (tec_id = '-1' OR tec_name LIKE '%" . $search . "%' OR tec_lname LIKE '%" . $search . "%'   OR tec_phone LIKE '%" . $search . "%'  OR tec_number LIKE '%" . $search . "%') ".$search_m_tec."  AND tec_id IN (".$ref_id_1_t_filter.") ";
             $sql_2nd_stu = " SELECT  * FROM cpw.dbo.student_main where (info_id = '-1' OR info_name_th LIKE '%" . $search . "%' OR info_lname_th LIKE '%" . $search . "%' OR info_number_phone LIKE '%" . $search . "%'  OR info_number_std LIKE '%" . $search . "%') ".$search_m_stu." AND info_id IN (".$ref_id_1_s_filter.")   ";
         }
     } else {
         $sql_2nd_tec = " SELECT  * FROM cpw.dbo.teacher_main where   tec_id IN (".$ref_id_1_t_filter.") ".$search_m_tec." ";
         $sql_2nd_stu = " SELECT  * FROM cpw.dbo.student_main where  info_id IN (".$ref_id_1_s_filter.") ".$search_m_stu."";
     }
     // echo count($ref_id_1st_tec) . " " . count($ref_id_1st_stu). "แย่จัง t s \n ";

     // echo $sql_2nd_tec;
     // echo '-------------------';
     // echo $sql_2nd_stu;

     //  $ref_id_2nd_stu=array();
     //  $ref_id_2nd_tec=array();

     $stmt_2nd_stu = sqlsrv_query($conn, $sql_2nd_stu);
     if ($stmt_2nd_stu === false) {
         die(print_r(sqlsrv_errors(), true));
     }
     while ($fetch_2nd_stu = sqlsrv_fetch_array($stmt_2nd_stu, SQLSRV_FETCH_ASSOC)) {
         $ref_id_2nd_stu[] = $fetch_2nd_stu['info_id'];
       
         //  array_push($ref_id_2nd_stu, $fetch_2nd_stu['ref_id']);
     }
     // echo count($ref_id_2nd_stu);
     $stmt_2nd_tec = sqlsrv_query($conn, $sql_2nd_tec);
     if ($stmt_2nd_tec === false) {
         die(print_r(sqlsrv_errors(), true));
     }
     while ($fetch_2nd_tec = sqlsrv_fetch_array($stmt_2nd_tec, SQLSRV_FETCH_ASSOC)) {
         $ref_id_2nd_tec[] = $fetch_2nd_tec['tec_id'];
         //  array_push($ref_id_2nd_tec, $fetch_2nd_tec['ref_id']);

            // echo $fetch_2nd_stu['tec_id'] .'dd';
     }
     $ref_id_2nd_stu[] = -11;
     $ref_id_2nd_tec[] = -11;
     // echo $ref_id_2nd_tec;
     // $ref_id_3rd_stu = array_intersect($ref_id_1st_stu, $ref_id_2nd_stu);
     // $ref_id_3rd_tec = array_intersect($ref_id_1st_tec, $ref_id_2nd_tec);
     // echo count($ref_id_3rd_stu);
     // $ref_id_3rd = array_merge($ref_id_3rd_stu , $ref_id_3rd_tec);
     // $ref_id_3rd = array_merge($ref_id_2nd_stu , $ref_id_2nd_tec);

     // echo count($ref_id_1st_tec) . " " . (count($ref_id_2nd_tec)-1). "แย่จัง \n " . count($ref_id_3rd_tec) ."<<<<รวมแล้ว"  ;
     $xyz =$_POST["searchbyty"];
     if (isset($xyz) && (in_array("2", $xyz) || in_array("1", $xyz))) {
         if (in_array("2", $xyz) && !in_array("1", $xyz)) {
             $search_class = " AND user_class  =2 ";
         } elseif (in_array("1", $xyz) && !in_array("2", $xyz)) {
             $search_class = " AND user_class = 1 ";
         } else {
             $search_class = " ";
         }
     }
     if (isset($xyz) && (in_array("4", $xyz) || in_array("5", $xyz))) {
         if (in_array("4", $xyz) && !in_array("5", $xyz)) {
             $search_able = " AND user_stats  =1 ";
         } elseif (in_array("5", $xyz) && !in_array("4", $xyz)) {
             $search_able = " AND user_stats =2 ";
         } else {
             $search_able = " ";
         }
     }


     // $ref_id_3rd_filter = implode(",", $ref_id_3rd);
     $ref_id_2nd_tec_filter = implode(",", $ref_id_2nd_tec);
     $ref_id_2nd_stu_filter = implode(",", $ref_id_2nd_stu);

     $sql_4th = " SELECT * FROM data_user where (ref_id IN (".$ref_id_2nd_tec_filter.") OR ref_id IN (".$ref_id_2nd_stu_filter.") ) ".$search_class."  ".$search_able."  ";
     // echo $sql_4th;
     $stmt_4th = sqlsrv_query($conn, $sql_4th);
     if ($stmt_4th === false) {
         die(print_r(sqlsrv_errors(), true));
     }
     while ($fetch_4th = sqlsrv_fetch_array($stmt_4th, SQLSRV_FETCH_ASSOC)) {
         $ref_id_final[] = $fetch_4th['ref_id'];
     }
     echo json_encode($ref_id_final);
 } elseif ($actions == 4) {
 }
