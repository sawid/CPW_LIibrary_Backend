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
                        $sql = "SELECT * FROM data_booking_histery WHERE user_id = '$check_id_user_id' AND booking_status = '2' ";
                        $stmt = sqlsrv_query($conn, $sql);
                        if ($stmt === false) {
                            die(print_r(sqlsrv_errors(), true));
                        }
                        $row = sqlsrv_fetch_array($stmt, SQLSRV_FETCH_ASSOC);
                        $number_of_booking = $row['user_id'];
                            if(!isset($row)){
                                echo "validtextboxnoreturn";
                            } else {
                                echo "validtextboxreturn";
                            }
                    }
            } else {
                $sql = "SELECT * FROM data_booking_histery WHERE user_id = '$check_id_user_id' AND booking_status = '2' ";
                $stmt = sqlsrv_query($conn, $sql);
                if ($stmt === false) {
                    die(print_r(sqlsrv_errors(), true));
                }
                $row = sqlsrv_fetch_array($stmt, SQLSRV_FETCH_ASSOC);
                $number_of_booking = $row['user_id'];
                    if(!isset($row)){
                        echo "validtextboxnoreturn";
                    } else {
                        echo "validtextboxreturn";
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
                            $sql = "SELECT * FROM data_booking_histery WHERE user_id = '$check_id_user_id' AND booking_status = '2' ";
                            $stmt = sqlsrv_query($conn, $sql);
                            if ($stmt === false) {
                                die(print_r(sqlsrv_errors(), true));
                            }
                            $row = sqlsrv_fetch_array($stmt, SQLSRV_FETCH_ASSOC);
                            $number_of_booking = $row['user_id'];
                                if(!isset($row)){
                                    echo "validtextboxnoreturn";
                                } else {
                                    echo "validtextboxreturn";
                                }
                        }
                } else {
                    $sql = "SELECT * FROM data_booking_histery WHERE user_id = '$check_id_user_id' AND booking_status = '2' ";
                    $stmt = sqlsrv_query($conn, $sql);
                    if ($stmt === false) {
                        die(print_r(sqlsrv_errors(), true));
                    }
                    $row = sqlsrv_fetch_array($stmt, SQLSRV_FETCH_ASSOC);
                    $number_of_booking = $row['user_id'];
                        if(!isset($row)){
                            echo "validtextboxnoreturn";
                        } else {
                            echo "validtextboxreturn";
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
        $sql = "SELECT * FROM data_user WHERE user_code = '$stdCode_checkbook' ";
        $stmt = sqlsrv_query($conn, $sql);
        if ($stmt === false) {
            die(print_r(sqlsrv_errors(), true));
        }
        $row = sqlsrv_fetch_array($stmt, SQLSRV_FETCH_ASSOC);
        $check_id_user_id_return  = $row['user_id'];

        if (!isset($row)) {
            echo "invalidtextboxbookpart";
        } else {
            $sql = "SELECT * FROM data_booking_histery WHERE book_id = '$book_id_check' AND user_id = '$check_id_user_id_return' ";
            $stmt = sqlsrv_query($conn, $sql);
            if ($stmt === false) {
                die(print_r(sqlsrv_errors(), true));
            }
            $row = sqlsrv_fetch_array($stmt, SQLSRV_FETCH_ASSOC);
            if (!isset($row)) {
                echo "validtextboxbookingbookpart";
            } else {
                echo "validtextboxreturnbookpart";
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
    $book_id_check_book_id = $row['book_id'];

    $sql = "SELECT * FROM data_user WHERE user_code = '$stdCode_checkbook' ";
    $stmt = sqlsrv_query($conn, $sql);
    if ($stmt === false) {
        die(print_r(sqlsrv_errors(), true));
    }
    $row = sqlsrv_fetch_array($stmt, SQLSRV_FETCH_ASSOC);
    $check_id_return  = $row['user_id'];

    $sql = "SELECT * FROM data_booking_histery WHERE book_id = '$book_id_check_book_id' AND user_id = '$check_id_return' ";
    $stmt = sqlsrv_query($conn, $sql);
    if ($stmt === false) {
        die(print_r(sqlsrv_errors(), true));
    }
    $row = sqlsrv_fetch_array($stmt, SQLSRV_FETCH_ASSOC);
    $date2 = $row['booking_dateline']->format('Y-m-d H:i:s');

    $date1 = date("d-m-Y");
    $datetime1 = new DateTime($date1);
    $datetime2 = new DateTime($date2);
    $interval = $datetime2->diff($datetime1);
    $date_cal = (int)$interval->format('%R%a');

    if ($date_cal > 0) {
        $date_print = $date_cal * 1;
        $data = 'ผู้ใช้ '. $std_title . $std_firstname .' '. $std_lastname . ' ต้องการคืนหนังสือ ' . $book_name . ' พร้อมจ่ายค่าธรรมเนียมจำนวน ' . $date_print . ' บาท ใช่หรือไม่?';
    } elseif ($date_cal == 0) {
        $data = 'ผู้ใช้ '. $std_title . $std_firstname .' '. $std_lastname . ' ต้องการคืนหนังสือ ' . $book_name . ' ใช่หรือไม่?';
    } elseif ($date_cal < 0) {
        $data = 'ผู้ใช้ '. $std_title . $std_firstname .' '. $std_lastname . ' ต้องการคืนหนังสือ ' . $book_name . ' ใช่หรือไม่?';
    }
    echo $data;
}

if($actions == '5'){
    $transaction_status_return = 3;
    $dateToday = date("d-m-Y");
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

    $sql = "SELECT * FROM data_booking_histery WHERE book_id = '$book_id_check' AND user_id = '$user_code_check' ";
    $stmt = sqlsrv_query($conn, $sql);
    if ($stmt === false) {
        die(print_r(sqlsrv_errors(), true));
    }
    $row = sqlsrv_fetch_array($stmt, SQLSRV_FETCH_ASSOC);
    $date2 = $row['booking_dateline']->format('Y-m-d H:i:s');

    $date1 = date("d-m-Y");
    $datetime1 = new DateTime($date1);
    $datetime2 = new DateTime($date2);
    $interval = $datetime2->diff($datetime1);
    $date_cal = (int)$interval->format('%R%a');

    if ($date_cal > 0) {
        $date_print = $date_cal * 1;
        $fine = $date_print;
    } elseif ($date_cal == 0) {
        $fine = 0;
    } elseif ($date_cal < 0) {
        $fine = 0;
    }
    
    $sql = " UPDATE data_booking_histery SET booking_status = 3, booking_date_form = '$dateToday',booking_fine = '$fine' WHERE book_id = '$book_id_check' AND user_id = '$user_code_check' ";
    $stmt = sqlsrv_query($conn, $sql);
    if ($stmt === false) {
        die(print_r(sqlsrv_errors(), true));
    }
    echo 'updatebookingsuccess';       
}