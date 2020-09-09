<?php
include('connect_db.php');
function test($conn){
    $book_id_check_book_id = 14880;
    $check_id_return = 31;
    $sql = "SELECT * FROM data_booking_histery WHERE book_id = '$book_id_check_book_id' AND user_id = '$check_id_return' ";
    $stmt = sqlsrv_query($conn, $sql);
    if ($stmt === false) {
        die(print_r(sqlsrv_errors(), true));
    }
    $row = sqlsrv_fetch_array($stmt, SQLSRV_FETCH_ASSOC);
    $date2 = $row['booking_dateline']->format('Y-m-d H:i:s');
    $date1 = "2020-06-20 00:00:00.000";
    /*$datetime1 = new DateTime($date1);
    $datetime2 = new DateTime($date2);
    $interval = $datetime2->diff($datetime1);
    $x = (int)$interval->format('%R%a');*/
    /*if($x < 0){
        echo $x;
    }
    else {
        echo "false";
    }*/
    echo $date2;
}
