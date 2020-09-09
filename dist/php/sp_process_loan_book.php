<?php
include('connect_db.php');
$actions = $_POST['actions'];
$texts = $_POST['stdCode'];
$texts_checkbook = $_POST['stdCode_process_checkbook'];
$stdCode_checkbook = $_POST['name'];
if ($actions == '1') {
    if (strlen((string)$texts) == 5) {
        $sql = "SELECT * FROM data_user WHERE user_code = '$texts' ";
        $stmt = sqlsrv_query($conn, $sql);
        if ($stmt === false) {
            die(print_r(sqlsrv_errors(), true));
        }
        $row = sqlsrv_fetch_array($stmt, SQLSRV_FETCH_ASSOC);
        $check_id  = $row['user_code'];
        $check_id_user_id  = $row['user_id'];
        if (!isset($row)) {
            echo "invalidtextbox";
        }
        else {
            $sql = "SELECT * FROM cpw.dbo.student_main WHERE info_number_std = '$check_id' ";
            $stmt = sqlsrv_query($conn, $sql);
            if ($stmt === false) {
                die(print_r(sqlsrv_errors(), true));
            }
            $row = sqlsrv_fetch_array($stmt, SQLSRV_FETCH_ASSOC);
            $test_id = $row['ro_key2'];
            if (!isset($row)) {
                $sql = "SELECT * FROM cpw.dbo.teacher_main WHERE tec_number = '$check_id' ";
                $stmt = sqlsrv_query($conn, $sql);
                if ($stmt === false) {
                    die(print_r(sqlsrv_errors(), true));
                }
                $row = sqlsrv_fetch_array($stmt, SQLSRV_FETCH_ASSOC);
                $test_id = $row['tec_number'];
                    if (!isset($row)) {
                        echo "invalidtextbox";
                    }
                    else {
                        $sql = "SELECT COUNT(*) as 'total' FROM data_booking_histery WHERE (user_id = '$check_id_user_id' AND booking_status = '2') OR (user_id = '$check_id_user_id' AND booking_status = '1') ";
                        $stmt = sqlsrv_query($conn, $sql);
                        if ($stmt === false) {
                            die(print_r(sqlsrv_errors(), true));
                        }
                        $row = sqlsrv_fetch_array($stmt, SQLSRV_FETCH_ASSOC);
                        $number_of_booking = $row['total'];
                            if($number_of_booking == 4){
                                echo "validtextboxmaxloan";
                            } else {
                                echo "validtextboxloan";
                            }
                    }
            } else {
                    $sql = "SELECT * FROM cpw.dbo.data_room WHERE ro_key = '$test_id' ";
                    $stmt = sqlsrv_query($conn, $sql);
                    if ($stmt === false) {
                    die(print_r(sqlsrv_errors(), true));
                    }
                    $row = sqlsrv_fetch_array($stmt, SQLSRV_FETCH_ASSOC);
                    $test_id_2 = $row['de_id'];
                    if ($test_id_2 == '3'){
                        $sql = "SELECT COUNT(*) as 'total' FROM data_booking_histery WHERE (user_id = '$check_id_user_id' AND booking_status = '2') OR (user_id = '$check_id_user_id' AND booking_status = '1') ";
                        $stmt = sqlsrv_query($conn, $sql);
                        if ($stmt === false) {
                            die(print_r(sqlsrv_errors(), true));
                        }
                        $row = sqlsrv_fetch_array($stmt, SQLSRV_FETCH_ASSOC);
                        $number_of_booking = $row['total'];
                            if($number_of_booking == 2){
                                echo "validtextboxmaxloan";
                            } else {
                                echo "validtextboxloan";
                            }
                    } elseif ($test_id_2 == '4'){
                        $sql = "SELECT COUNT(*) as 'total' FROM data_booking_histery WHERE (user_id = '$check_id_user_id' AND booking_status = '2') OR (user_id = '$check_id_user_id' AND booking_status = '1') ";
                        $stmt = sqlsrv_query($conn, $sql);
                        if ($stmt === false) {
                            die(print_r(sqlsrv_errors(), true));
                        }
                        $row = sqlsrv_fetch_array($stmt, SQLSRV_FETCH_ASSOC);
                        $number_of_booking = $row['total'];
                            if($number_of_booking == 3){
                                echo "validtextboxmaxloan";
                            } else {
                                echo "validtextboxloan";
                            }
                    } elseif ($test_id_2 == '5'){
                        $sql = "SELECT COUNT(*) as 'total' FROM data_booking_histery WHERE (user_id = '$check_id_user_id' AND booking_status = '2') OR (user_id = '$check_id_user_id' AND booking_status = '1') ";
                        $stmt = sqlsrv_query($conn, $sql);
                        if ($stmt === false) {
                            die(print_r(sqlsrv_errors(), true));
                        }
                        $row = sqlsrv_fetch_array($stmt, SQLSRV_FETCH_ASSOC);
                        $number_of_booking = $row['total'];
                            if($number_of_booking == 4){
                                echo "validtextboxmaxloan";
                            } else {
                                echo "validtextboxloan";
                            }
                    }
            }



           

        }
    } elseif (strlen((string)$texts) == 16){
        $sql = "SELECT * FROM cpw.dbo.student_main WHERE id_crad = '$texts' ";
        $stmt = sqlsrv_query($conn, $sql);
        if ($stmt === false) {
            die(print_r(sqlsrv_errors(), true));
        }
        $row = sqlsrv_fetch_array($stmt, SQLSRV_FETCH_ASSOC);
        $check_id  = $row['info_number_std'];
        if (!isset($row)) {
            echo "invalidtextbox";
        }
        else {
            $sql = "SELECT * FROM data_user WHERE user_code = '$check_id' ";
            $stmt = sqlsrv_query($conn, $sql);
            if ($stmt === false) {
                die(print_r(sqlsrv_errors(), true));
            }
            $row = sqlsrv_fetch_array($stmt, SQLSRV_FETCH_ASSOC);
            $check_id_user_id  = $row['user_id'];
            if (!isset($row)) {
                echo "invalidtextbox";
            }
            else {
                $sql = "SELECT * FROM cpw.dbo.student_main WHERE info_number_std = '$check_id' ";
                $stmt = sqlsrv_query($conn, $sql);
                if ($stmt === false) {
                    die(print_r(sqlsrv_errors(), true));
                }
                $row = sqlsrv_fetch_array($stmt, SQLSRV_FETCH_ASSOC);
                $test_id = $row['ro_key2'];

                if (!isset($row)) {
                    $sql = "SELECT * FROM cpw.dbo.teacher_main WHERE tec_number = '$check_id' ";
                    $stmt = sqlsrv_query($conn, $sql);
                    if ($stmt === false) {
                        die(print_r(sqlsrv_errors(), true));
                    }
                    $row = sqlsrv_fetch_array($stmt, SQLSRV_FETCH_ASSOC);
                    $test_id = $row['tec_number'];
                        if (!isset($row)) {
                            echo "invalidtextbox";
                        }
                        else {
                            $sql = "SELECT COUNT(*) as 'total' FROM data_booking_histery WHERE (user_id = '$check_id_user_id' AND booking_status = '2') OR (user_id = '$check_id_user_id' AND booking_status = '1') ";
                            $stmt = sqlsrv_query($conn, $sql);
                            if ($stmt === false) {
                                die(print_r(sqlsrv_errors(), true));
                            }
                            $row = sqlsrv_fetch_array($stmt, SQLSRV_FETCH_ASSOC);
                            $number_of_booking = $row['total'];
                                if($number_of_booking == 4){
                                    echo "validtextboxmaxloan";
                                } else {
                                    echo "validtextboxloan";
                                }
                        }
                }
                else {

                $sql = "SELECT * FROM cpw.dbo.data_room WHERE ro_key = '$test_id' ";
                    $stmt = sqlsrv_query($conn, $sql);
                if ($stmt === false) {
                    die(print_r(sqlsrv_errors(), true));
                }
                $row = sqlsrv_fetch_array($stmt, SQLSRV_FETCH_ASSOC);
                $test_id_2 = $row['de_id'];

                if ($test_id_2 == '3'){
                    $sql = "SELECT COUNT(*) as 'total' FROM data_booking_histery WHERE (user_id = '$check_id_user_id' AND booking_status = '2') OR (user_id = '$check_id_user_id' AND booking_status = '1') ";
                    $stmt = sqlsrv_query($conn, $sql);
                    if ($stmt === false) {
                        die(print_r(sqlsrv_errors(), true));
                    }
                    $row = sqlsrv_fetch_array($stmt, SQLSRV_FETCH_ASSOC);
                    $number_of_booking = $row['total'];
                        if($number_of_booking == 2){
                            echo "validtextboxmaxloan";
                        } else {
                            echo "validtextboxloan";
                        }
                } elseif ($test_id_2 == '4'){
                    $sql = "SELECT COUNT(*) as 'total' FROM data_booking_histery WHERE (user_id = '$check_id_user_id' AND booking_status = '2') OR (user_id = '$check_id_user_id' AND booking_status = '1') ";
                    $stmt = sqlsrv_query($conn, $sql);
                    if ($stmt === false) {
                        die(print_r(sqlsrv_errors(), true));
                    }
                    $row = sqlsrv_fetch_array($stmt, SQLSRV_FETCH_ASSOC);
                    $number_of_booking = $row['total'];
                        if($number_of_booking == 3){
                            echo "validtextboxmaxloan";
                        } else {
                            echo "validtextboxloan";
                        }
                } elseif ($test_id_2 == '5'){
                    $sql = "SELECT COUNT(*) as 'total' FROM data_booking_histery WHERE (user_id = '$check_id_user_id' AND booking_status = '2') OR (user_id = '$check_id_user_id' AND booking_status = '1') ";
                    $stmt = sqlsrv_query($conn, $sql);
                    if ($stmt === false) {
                        die(print_r(sqlsrv_errors(), true));
                    }
                    $row = sqlsrv_fetch_array($stmt, SQLSRV_FETCH_ASSOC);
                    $number_of_booking = $row['total'];
                        if($number_of_booking == 4){
                            echo "validtextboxmaxloan";
                        } else {
                            echo "validtextboxloan";
                        }
                }
            }
            }
        }
    }
    else {
        echo "errorformattextbox";
    }
}
if($actions == '2'){
    if (strlen((string)$texts_checkbook) >= 1 ){
        $sql = "SELECT * FROM book_data WHERE book_accession_no = '$texts_checkbook' ";
        $stmt = sqlsrv_query($conn, $sql);
        if ($stmt === false) {
            die(print_r(sqlsrv_errors(), true));
        }
        $row = sqlsrv_fetch_array($stmt, SQLSRV_FETCH_ASSOC);
        $book_id_check = $row['book_id'];
        if (!isset($row)) {
            echo "invalidtextboxbookpart";
        } else {
            $sql = "SELECT * FROM data_booking_histery WHERE book_id = '$book_id_check' ";
            $stmt = sqlsrv_query($conn, $sql);
            if ($stmt === false) {
                die(print_r(sqlsrv_errors(), true));
            }
            $row = sqlsrv_fetch_array($stmt, SQLSRV_FETCH_ASSOC);
            $book_status_check_status = $row['booking_status'];
            $user_id_check_status = $row['user_id'];
            if (isset($row)) {
                $sql = "SELECT * FROM data_user WHERE user_code = '$stdCode_checkbook' ";
                $stmt = sqlsrv_query($conn, $sql);
                if ($stmt === false) {
                    die(print_r(sqlsrv_errors(), true));
                }
                $row = sqlsrv_fetch_array($stmt, SQLSRV_FETCH_ASSOC);
                $stdCode_check_history = $row['user_id'];
                    if ($book_status_check_status == 1){
                        if ($stdCode_check_history == $user_id_check_status){
                            echo "validtextboxloanbookpart";
                        } else {
                            echo "validtextboxbookingbookpart";
                        }
                    } elseif ($book_status_check_status == 2) {
                        echo "validtextboxmaxloanbookpart";
                    }
            }
            else {
                echo "validtextboxloanbookpart";
            }
        }
        
    } else {
        echo "errorformattextboxbookpart";
    }
}

if($actions == '3'){
    $sql = "SELECT * FROM cpw.dbo.student_main WHERE info_number_std = '$stdCode_checkbook' ";
    $stmt = sqlsrv_query($conn, $sql);
    if ($stmt === false) {
        die(print_r(sqlsrv_errors(), true));
    }
    $row = sqlsrv_fetch_array($stmt, SQLSRV_FETCH_ASSOC);
    $std_firstname = $row['info_name_th'];
    $std_lastname = $row['info_lname_th'];
    $std_title = $row['info_title'];
    if (!isset($row)) {
        $sql = "SELECT * FROM cpw.dbo.teacher_main WHERE tec_number = '$stdCode_checkbook' ";
        $stmt = sqlsrv_query($conn, $sql);
        if ($stmt === false) {
            die(print_r(sqlsrv_errors(), true));
        }
        $row = sqlsrv_fetch_array($stmt, SQLSRV_FETCH_ASSOC);
        $std_firstname = $row['tec_name'];
        $std_lastname = $row['tec_lname'];
        $std_title = $row['tec_title'];
    }
    $sql = "SELECT * FROM book_data WHERE book_accession_no = '$texts_checkbook' ";
    $stmt = sqlsrv_query($conn, $sql);
    if ($stmt === false) {
        die(print_r(sqlsrv_errors(), true));
    }
    $row = sqlsrv_fetch_array($stmt, SQLSRV_FETCH_ASSOC);
    $book_name = $row['book_name'];
    $data = 'ผู้ใช้ '. $std_title . $std_firstname .' '. $std_lastname . ' ต้องการยืมหนังสือ ' . $book_name . ' ใช่หรือไม่?';
    echo $data;
}

if($actions == '4'){
    $sql = "SELECT * FROM cpw.dbo.student_main WHERE info_number_std = '$texts' ";
    $stmt = sqlsrv_query($conn, $sql);
    if ($stmt === false) {
        die(print_r(sqlsrv_errors(), true));
    }
    while ($row = sqlsrv_fetch_array($stmt, SQLSRV_FETCH_ASSOC)) {
        $std_firstname = $row['info_name_th'];
        $std_lastname = $row['info_lname_th'];
        $std_title = $row['info_title'];
        $data .= ''. $std_title . $std_firstname .' '. $std_lastname . '';
    }
    echo $data;
}

if($actions == '5'){
    $transaction_status = 2;
    $datetoday = date("d-m-Y");
    $datedeadline = date("d-m-Y", time()+604800);
    $sql = "SELECT * FROM book_data WHERE book_accession_no = '$texts_checkbook' ";
    $stmt = sqlsrv_query($conn, $sql);
    if ($stmt === false) {
        die(print_r(sqlsrv_errors(), true));
    }
    $row = sqlsrv_fetch_array($stmt, SQLSRV_FETCH_ASSOC);
    $book_id_check = $row['book_id'];
    $sql = "SELECT * FROM data_user WHERE user_code = '$stdCode_checkbook' ";
    $stmt = sqlsrv_query($conn, $sql);
    if ($stmt === false) {
        die(print_r(sqlsrv_errors(), true));
    }
    $row = sqlsrv_fetch_array($stmt, SQLSRV_FETCH_ASSOC);
    $user_code_check = $row['user_id'];

    $sql = "SELECT * FROM data_booking_histery WHERE book_id = '$book_id_check' AND user_id = '$user_code_check' AND booking_status = '1' ";
    $stmt = sqlsrv_query($conn, $sql);
    if ($stmt === false) {
        die(print_r(sqlsrv_errors(), true));
    }
    $row = sqlsrv_fetch_array($stmt, SQLSRV_FETCH_ASSOC);
        if (isset($row)) {
            $sql = " UPDATE data_booking_histery SET booking_status = 2, booking_dateline = '$datedeadline', booking_date_in = '$datetoday'  WHERE book_id = '$book_id_check' AND user_id = '$user_code_check' ";
            $stmt = sqlsrv_query($conn, $sql);
            if ($stmt === false) {
                die(print_r(sqlsrv_errors(), true));
            }
            echo 'updatebookingsuccess';
        } 
        else {
            $sql = " INSERT INTO [data_booking_histery]
            ([book_id],[user_id],[booking_status],[booking_date_in],[booking_dateline]
             )
             VALUES(
             '$book_id_check','$user_code_check','$transaction_status','$datetoday','$datedeadline'
             ) ";
         
            $stmt = sqlsrv_query($conn, $sql);
            if ($stmt === false) {
                die(print_r(sqlsrv_errors(), true));
            }
            echo 'addbookingsuccess';
        }
}

if($actions == '6'){
    
    $sql = "SELECT * FROM cpw.dbo.student_main WHERE info_number_std = '$stdCode_checkbook' ";
    $stmt = sqlsrv_query($conn, $sql);
    if ($stmt === false) {
        die(print_r(sqlsrv_errors(), true));
    }
    $row = sqlsrv_fetch_array($stmt, SQLSRV_FETCH_ASSOC);
    $std_firstname = $row['info_name_th'];
    $std_lastname = $row['info_lname_th'];
    $std_title = $row['info_title'];
    if (!isset($row)) {
        $sql = "SELECT * FROM cpw.dbo.teacher_main WHERE tec_number = '$stdCode_checkbook' ";
        $stmt = sqlsrv_query($conn, $sql);
        if ($stmt === false) {
            die(print_r(sqlsrv_errors(), true));
        }
        $row = sqlsrv_fetch_array($stmt, SQLSRV_FETCH_ASSOC);
        $std_firstname = $row['tec_name'];
        $std_lastname = $row['tec_lname'];
        $std_title = $row['tec_title'];
    }


    $order_num = 1;
    $header_temp = 0;
    $sql = "SELECT * FROM data_booking_histery WHERE (user_id = '$check_id_user_id' AND booking_status = '2') OR (user_id = '$check_id_user_id' AND booking_status = '1') ";
    $stmt = sqlsrv_query($conn, $sql);
    if ($stmt === false) {
        die(print_r(sqlsrv_errors(), true));
    }
    $number_of_fetch = mysql_num_rows($sql);
    while ($row = sqlsrv_fetch_array($stmt, SQLSRV_FETCH_ASSOC)) {
        if($header_temp == 0){
            $data .= '<div class="card">';
            $data .= '<div class="card-header border-0">';
            $data .= '<h3 class="card-title">ประวัติการจอง - ยืมหนังสือ ('. $std_title . $std_firstname .' '. $std_lastname . ')';
            $data .= '</h3>';
            $data .= '<div class="card-tools">';
            $data .= '<button class="btn btn-primary btn-sm">กลับหน้าหลัก</button>';
            $data .= '</div>';
            $data .= '</div>';
            $data .= '<div class="">';
            $data .= '<div class="table-responsive scrollbarB" id="table-b" style="position: relative; height: 300px;">';
            $data .= '<table class="table table-head-fixed m-0">';
            $data .= '<thead>';
            $data .= '<tr>';
            $data .= '<th class="text-center">ลำดับ</th>';
            $data .= '<th>ชื่อหนังสือ</th>';
            $data .= '<th>ครบกำหนด</th>';
            $data .= '</tr>';
            $data .= '</thead>';
            $data .= '<tbody>';
            $header_temp ++;
        }
        
        $data .= '<tr>';
        $data .= '<td class="text-center">';
        $data .= '<div class="image">';
        $data .= '<span class="">'. $order_num .'</span>';
        $data .= '</div>';
        $data .= '</td>';
        $data .= '<td class="text-oneline">';
        $data .= '<span class="badge bg-yellow">กำลังยืม</span> Clean database is to dat to wordwrap';
        $data .= '</td>';
        $data .= '<td>';
        $data .= '10.05.2020';
        $data .= '</td>';
        $data .= '</tr>';

        if($number_of_fetch == 0){
            $data .= '</tbody>';
            $data .= '</table>';
            $data .= '</div>';
            $data .= '</div>';
            $data .= '</div>';

        }

        $order_num ++;
    }
    echo $data;
}

function testcountloan($conn) {
    $sql = "SELECT COUNT(*) as 'total' FROM data_booking_histery WHERE (user_id = '31' AND booking_status = '2') OR (user_id = '31' AND booking_status = '1')";
    $stmt = sqlsrv_query($conn, $sql);
                    if ($stmt === false) {
                        die(print_r(sqlsrv_errors(), true));
                    }
                    $row = sqlsrv_fetch_array($stmt, SQLSRV_FETCH_ASSOC);
                    $number_of_transaction = $row['total'];
    return $number_of_transaction;
  }