<?php

 // ข้อมูลสำคัญ array_unique() สำหรับ ตัดอันที่เหมือนกัน
        // array_merge() รวมกันสองอัน
        // array_intersect() รวมกันโดยเอาเฉพาะตัวที่เหมือนกัน
        // array_diff(a,b) เอาตัวที่ b  มีเหมือน a ลบออกจาก a
        // if (in_array('1', $_POST["searchbybooking"]) && in_array('2', $_POST["searchbybooking"]) && in_array('0', $_POST["searchbybooking"])) {
        //     // ข้าม
        //     $searchbybooking = '';
        // }
        // elseif (in_array('1', $_POST["searchbybooking"]) && in_array('2', $_POST["searchbybooking"]) && !(in_array('0', $_POST["searchbybooking"]))) {
        //     ค้นทั้ง 2 แล้วนำไปอินเตอร์เซค ()
        
        //     $querys = " SELECT * FROM cpw_library.dbo.data_booking_histery WHERE booking_status IN('1','2') AND book_id IN (".$ref_id_final_filter.")  ";
        //     $stmts = sqlsrv_query($conn, $querys);
        //     if ($stmts === false) {
        //         die(print_r(sqlsrv_errors(), true));
        //     }
        //     $searchbybooking = array();
        //     while ($row = sqlsrv_fetch_array($stmt, SQLSRV_FETCH_ASSOC)) {
        //         $searchbybooking[] = $row['book_id'];
        //     }
           
        // }

        // } elseif ((in_array('1', $_POST["searchbybooking"])) && !(in_array('2', $_POST["searchbybooking"])) && (in_array('0', $_POST["searchbybooking"]))) {
        //     // ค้นแค่ 2 แล้วเอาไปลบ กับก้อนใหญ่
        //     $querys = " SELECT * FROM cpw_library.dbo.data_booking_histery WHERE booking_status IN('2') AND book_id IN (".$ref_id_final_filter.") ";
        //     $stmts = sqlsrv_query($conn, $querys);
        //     if ($stmts === false) {
        //         die(print_r(sqlsrv_errors(), true));
        //     }
        //     $searchbybooking = array();
        //     while ($row = sqlsrv_fetch_array($stmt, SQLSRV_FETCH_ASSOC)) {
        //         $searchbybooking[] = $row['book_id'];
        //     }
        // } elseif (!(in_array('1', $_POST["searchbybooking"])) && (in_array('2', $_POST["searchbybooking"])) && (in_array('0', $_POST["searchbybooking"]))) {
        //     // ค้นแค่ 1 แล้วเอาไปลบกับกอนใหญ่
        //     $querys = " SELECT * FROM cpw_library.dbo.data_booking_histery WHERE booking_status IN('1') AND book_id IN (".$ref_id_final_filter.") ";
        //     $stmts = sqlsrv_query($conn, $querys);
        //     if ($stmts === false) {
        //         die(print_r(sqlsrv_errors(), true));
        //     }
        //     $searchbybooking = array();
        //     while ($row = sqlsrv_fetch_array($stmt, SQLSRV_FETCH_ASSOC)) {
        //         $searchbybooking[] = $row['book_id'];
        //     }
        // } elseif (!(in_array('1', $_POST["searchbybooking"])) && !(in_array('2', $_POST["searchbybooking"])) && (in_array('0', $_POST["searchbybooking"]))) {
        //     //ค้นหาทัง 2 แล้วนำไปลบก้อนใหญ่
        //     $querys = " SELECT * FROM cpw_library.dbo.data_booking_histery WHERE booking_status IN('1','2') AND book_id IN (".$ref_id_final_filter.") ";
        //     $stmts = sqlsrv_query($conn, $querys);
        //     if ($stmts === false) {
        //         die(print_r(sqlsrv_errors(), true));
        //     }
        //     $searchbybooking = array();
        //     while ($row = sqlsrv_fetch_array($stmt, SQLSRV_FETCH_ASSOC)) {
        //         $searchbybooking[] = $row['book_id'];
        //     }
        // } elseif (!(in_array('1', $_POST["searchbybooking"])) && (in_array('2', $_POST["searchbybooking"])) && !(in_array('0', $_POST["searchbybooking"]))) {
        //     // ค้นแค่ 2 แล้วเอาไปอินเตอร์เซต
        //     $querys = " SELECT * FROM cpw_library.dbo.data_booking_histery WHERE booking_status IN('2') AND book_id IN (".$ref_id_final_filter.") ";
        //     $stmts = sqlsrv_query($conn, $querys);
        //     if ($stmts === false) {
        //         die(print_r(sqlsrv_errors(), true));
        //     }
        //     $searchbybooking = array();
        //     while ($row = sqlsrv_fetch_array($stmt, SQLSRV_FETCH_ASSOC)) {
        //         $searchbybooking[] = $row['book_id'];
        //     }
        // } elseif ((in_array('1', $_POST["searchbybooking"])) && !(in_array('2', $_POST["searchbybooking"])) && !(in_array('0', $_POST["searchbybooking"]))) {
        //     // ค้นแค่ 1 แล้วเอาไปอินเตอร์เซ็ค
        //     $querys = " SELECT * FROM cpw_library.dbo.data_booking_histery WHERE booking_status IN('1') AND book_id IN (".$ref_id_final_filter.") ";
        //     $stmts = sqlsrv_query($conn, $querys);
        //     if ($stmts === false) {
        //         die(print_r(sqlsrv_errors(), true));
        //     }
        //     $searchbybooking = array();
        //     while ($row = sqlsrv_fetch_array($stmt, SQLSRV_FETCH_ASSOC)) {
        //         $searchbybooking[] = $row['book_id'];
        //     }
        
        // }
        
    
//     print_r($ref_id_final);
//     $ref_id_final_filter = implode(",", $ref_id_final);
//     echo '<br/>';
//     echo $ref_id_final_filter ;
//     $searchbybooking_sql = '';
//     $searchbyplace_sql= '';
//     $searchbymo_sql ='';
//     $sort_by ='';

//     if (isset($_POST["searchbybooking"])) {
//         // echo '<script>alert("efefefefefe") </script>';
//         $searchbybooking = array();
//         $searchbybooking[] = 0;
//         if (in_array(1, $_POST["searchbybooking"]) && in_array(2, $_POST["searchbybooking"]) && in_array(0, $_POST["searchbybooking"])) {
//             $searchbybooking_sql = " book_id IN (".$ref_id_final_filter.") ";
//         } else {
//             foreach ($ref_id_final as $book_id_each) {
//                 echo($ref_id_final);
//                 if (checkSatusBook($conn, $book_id_each) == 1 && in_array(1, $_POST["searchbybooking"])) {
//                     //จอง
//                     $searchbybooking[] = $book_id_each;
//                 } elseif (checkSatusBook($conn, $book_id_each) == 2 && in_array(2, $_POST["searchbybooking"])) {
//                     //ยืม
//                     $searchbybooking[] = $book_id_each;
//                 } elseif (checkSatusBook($conn, $book_id_each) == 0 && in_array(0, $_POST["searchbybooking"])) {
//                     //ว่าง
//                     $searchbybooking[] = $book_id_each;
//                 }
//             }
//             $searchbybooking_filter =  implode(",", $searchbybooking);
//             $searchbybooking_sql = " book_id IN (".$searchbybooking_filter.") ";
//         }
//     } else {
//         $searchbybooking_sql = " book_id IN (".$ref_id_final_filter.") ";
//     }

//     if (isset($_POST["searchbymo"])) {
//         $searchbymo_filter = implode(",", $_POST["searchbymo"]);
//         $searchbymo_sql = "AND ( book_call_classification_1 IN(" . $searchbymo_filter . ") ) ";
//     }
//     if (isset($_POST["searchbyplace"])) {
//         $searchbyplace_filter = implode(",", $_POST["searchbyplace"]);
//         $searchbyplace_sql = " AND ( book_location IN(" . $searchbyplace_filter . ") ) ";
//     }
//     if (isset($_POST["showby"])) {
//         if ($_POST["showby"] == 0) {
//             $show_by = count($ref_id_final) ;
//         } else {
//             $show_by = $_POST["showby"];
//         }
//         $limit = $show_by;
//         $page = 1;
//         if ($_POST['page'] > 1) {
//             $start = (($_POST['page'] - 1) * $limit);
//             $page = $_POST['page'];
//         } else {
//             $start = 0;
//         }
//     }
    
//     if (isset($_POST["sortby"])) {
//         if ($_POST["sortby"] == 1) {
//             $sort_by = " ORDER BY book_accession_no_int DESC ";
//         } elseif ($_POST["sortby"] == 2) {
//             $sort_by = " ORDER BY book_accession_no_int ASC ";
//         }
//     }
//     // $sql_final = " SELECT * FROM data_user where ref_id IN ('".$ref_id_final_filter."') ".$sort_by." OFFSET ".$start." ROWS FETCH NEXT ".$limit." ROWS ONLY ";
//     $sql_final = " SELECT * , CONVERT(int, book_accession_no) AS book_accession_no_int FROM book_data where ".$searchbybooking_sql." ".$searchbymo_sql." ".$searchbyplace_sql." ".$sort_by." OFFSET ".$start." ROWS FETCH NEXT ".$limit." ROWS ONLY  ";
//     $stmt_final = sqlsrv_query($conn, $sql_final);
//     if ($stmt_final === false) {
//         die(print_r(sqlsrv_errors(), true));
//         // $data .= '<input type="hidden" name="count_data" id="count_data" class="form-control" value="'.count($ref_id_final).'">';
//     }
//     while ($fetch_final = sqlsrv_fetch_array($stmt_final, SQLSRV_FETCH_ASSOC)) {
//         $data .= '<tr>';
//         $data .= '<td>';
//         $data .= $fetch_final['book_accession_no'];
//         $data .= '</td>';
//         // $data .= '</tr>';
//         // $data .= '<tr>';
//         $data .= '<td>';
//         $data .= getSatusBook($conn, $fetch_final['book_id']);
//         $data .= '</td>';
//         // $data .= '</tr>';
//         // $data .= '<tr>';
//         $data .= '<td>';
//         $data .= '<spen class="text-break">'.$fetch_final['book_name'] . '</spen>';
//         $data .= '</td>';
//         // $data .= '</tr>';
//         // $data .= '<tr>';
//         $data .= '<td>';
//         $data .= $fetch_final['book_call_classification_100'] .'['  .floor($fetch_final['book_call_classification_id']) . ']';
//         $data .= '</td>';
//         // $data .= '</tr>';
//         // $data .= '<tr>';
//         $data .= '<td>';
//         $data .= '<spen class="text-break">'.$fetch_final['book_location'] . '</spen>';
//         $data .= '</td>';
//         $data .= '</tr>';
//     }

//     if ($data == '') {
//         // $data = '<div id="loading-w" class="text-center">';
//         // $data .= '<div class="card card-danger">';
//         // $data .= '<div class="card-header">';
//         // $data .= '<h3 class="card-title" style="text-align: center !important;float: none;">: ไม่พบข้อมูล :</h3>';
//         // $data .= '</div>';
//         // $data .= '<div class="card-body">';
//         // $data .= '.: กรุณาลองใหม่อีกครั้ง :.';
//         // $data .= '</div>';
//         // $data .= '<!-- /.card-body -->';
//         // $data .= '</div>';
//         // $data .= '<!-- /.card -->';
//         // $data .= '  </div>';
//         $data  = 'NoFound101';
//     } else {
//         $head = '<div class="table-responsive card-body p-0 ">';
//         $head .= '<table class="table table-hover text-nowrap m-0 ">';
//         $head .= '<thead class="text-center ">';
//         $head .= '<tr>';
//         $head .= '<th class="">เลขทะเบียน</th>';
//         $head .= '<th class="">สถานะ</th>';
//         $head .= '<th class="">หนังสือ</th>';
//         $head .= '<th class="">หมวดหนังสือ</th>';
//         $head .= '<th class="">แก้ไข</th>';
//         $head .= '</tr>';
//         $head .= '</thead>';
//         $head .= '<tbody>';
//         $end = '</tbody></table></div>';
//         $data = $head . $data . $end;
//     }
//     echo $data;


?>