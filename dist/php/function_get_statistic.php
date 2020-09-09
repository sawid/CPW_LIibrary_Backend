<?php

function getDataNumberBook($conn)
{
    $sql = "SELECT COUNT(*) as 'total' FROM book_data ";
    $stmt = sqlsrv_query($conn, $sql);
    if ($stmt === false) {
        die(print_r(sqlsrv_errors(), true));
    }
    $row = sqlsrv_fetch_array($stmt, SQLSRV_FETCH_ASSOC);
    return $row['total'];
}

function getDataNumberUser($conn)
{
    $sql = "SELECT COUNT(*) as 'total' FROM data_user ";
    $stmt = sqlsrv_query($conn, $sql);
    if ($stmt === false) {
        die(print_r(sqlsrv_errors(), true));
    }
    $row = sqlsrv_fetch_array($stmt, SQLSRV_FETCH_ASSOC);
    return $row['total'];
}
function getDataNumberComment($conn, $book_id)
{
    $sql = "SELECT COUNT(*) as 'total' FROM data_comment WHERE book_id = '$book_id'";
    $stmt = sqlsrv_query($conn, $sql);
    if ($stmt === false) {
        die(print_r(sqlsrv_errors(), true));
    }
    $row = sqlsrv_fetch_array($stmt, SQLSRV_FETCH_ASSOC);
    return $row['total'];
}

function getNumberVote($conn, $book_id)
{
    $sql = " SELECT * FROM  [cpw_library].[dbo].[data_vote] WHERE  book_id = '$book_id'";
    $stmt = sqlsrv_query($conn, $sql);
    if ($stmt === false) {
        die(print_r(sqlsrv_errors(), true));
    }
    while ($row = sqlsrv_fetch_array($stmt, SQLSRV_FETCH_ASSOC)) {
        $data[] = $row['rating'];
    }
    return $data;
}


function getDataChartUserStudent($conn)
{
    $sql = "SELECT COUNT(*) as 'total' FROM data_user WHERE user_class = '1' ";
    $stmt = sqlsrv_query($conn, $sql);
    if ($stmt === false) {
        die(print_r(sqlsrv_errors(), true));
    }
    $row = sqlsrv_fetch_array($stmt, SQLSRV_FETCH_ASSOC);
    return $row['total'];
}

function getDataChartUserTeacher($conn)
{
    $sql = "SELECT COUNT(*) as 'total' FROM data_user WHERE user_class = '2' ";
    $stmt = sqlsrv_query($conn, $sql);
    if ($stmt === false) {
        die(print_r(sqlsrv_errors(), true));
    }
    $row = sqlsrv_fetch_array($stmt, SQLSRV_FETCH_ASSOC);
    return $row['total'];
}

function getDataChartUserOtherPerson($conn)
{
    $sql = "SELECT COUNT(*) as 'total' FROM data_user WHERE user_class = '3' ";
    $stmt = sqlsrv_query($conn, $sql);
    if ($stmt === false) {
        die(print_r(sqlsrv_errors(), true));
    }
    $row = sqlsrv_fetch_array($stmt, SQLSRV_FETCH_ASSOC);
    return $row['total'];
}

function getDataChartBookPlace40($conn)
{
    $sql = "SELECT COUNT(*) as 'total' FROM book_data WHERE book_location = '2' ";
    $stmt = sqlsrv_query($conn, $sql);
    if ($stmt === false) {
        die(print_r(sqlsrv_errors(), true));
    }
    $row = sqlsrv_fetch_array($stmt, SQLSRV_FETCH_ASSOC);
    return $row['total'];
}

function getDataChartBookPlace60($conn)
{
    $sql = "SELECT COUNT(*) as 'total' FROM book_data WHERE book_location = '1' ";
    $stmt = sqlsrv_query($conn, $sql);
    if ($stmt === false) {
        die(print_r(sqlsrv_errors(), true));
    }
    $row = sqlsrv_fetch_array($stmt, SQLSRV_FETCH_ASSOC);
    return $row['total'];
}

function getDataChartBookPlaceEP($conn)
{
    $sql = "SELECT COUNT(*) as 'total' FROM book_data WHERE book_location = '3' ";
    $stmt = sqlsrv_query($conn, $sql);
    if ($stmt === false) {
        die(print_r(sqlsrv_errors(), true));
    }
    $row = sqlsrv_fetch_array($stmt, SQLSRV_FETCH_ASSOC);
    return $row['total'];
}

function getDataChartBookPlaceOther($conn)
{
    $sql = "SELECT COUNT(*) as 'total' FROM book_data WHERE book_location = '4' ";
    $stmt = sqlsrv_query($conn, $sql);
    if ($stmt === false) {
        die(print_r(sqlsrv_errors(), true));
    }
    $row = sqlsrv_fetch_array($stmt, SQLSRV_FETCH_ASSOC);
    return $row['total'];
}

function getDataChartMemberStatusNormal($conn)
{
    $sql = "SELECT COUNT(*) as 'total' FROM data_user WHERE user_stats = '1' ";
    $stmt = sqlsrv_query($conn, $sql);
    if ($stmt === false) {
        die(print_r(sqlsrv_errors(), true));
    }
    $row = sqlsrv_fetch_array($stmt, SQLSRV_FETCH_ASSOC);
    return $row['total'];
}

function getDataChartMemberStatusAbnormal($conn)
{
    $sql = "SELECT COUNT(*) as 'total' FROM data_user WHERE user_stats = '2' ";
    $stmt = sqlsrv_query($conn, $sql);
    if ($stmt === false) {
        die(print_r(sqlsrv_errors(), true));
    }
    $row = sqlsrv_fetch_array($stmt, SQLSRV_FETCH_ASSOC);
    return $row['total'];
}

function getDataChartDiv0($conn)
{
    $sql = "SELECT COUNT(*) as 'total' FROM book_data WHERE book_call_classification_100 = '0' ";
    $stmt = sqlsrv_query($conn, $sql);
    if ($stmt === false) {
        die(print_r(sqlsrv_errors(), true));
    }
    $row = sqlsrv_fetch_array($stmt, SQLSRV_FETCH_ASSOC);
    return $row['total'];
}

function getDataChartDiv1($conn)
{
    $sql = "SELECT COUNT(*) as 'total' FROM book_data WHERE book_call_classification_100 = '1' ";
    $stmt = sqlsrv_query($conn, $sql);
    if ($stmt === false) {
        die(print_r(sqlsrv_errors(), true));
    }
    $row = sqlsrv_fetch_array($stmt, SQLSRV_FETCH_ASSOC);
    return $row['total'];
}

function getDataChartDiv2($conn)
{
    $sql = "SELECT COUNT(*) as 'total' FROM book_data WHERE book_call_classification_100 = '2' ";
    $stmt = sqlsrv_query($conn, $sql);
    if ($stmt === false) {
        die(print_r(sqlsrv_errors(), true));
    }
    $row = sqlsrv_fetch_array($stmt, SQLSRV_FETCH_ASSOC);
    return $row['total'];
}

function getDataChartDiv3($conn)
{
    $sql = "SELECT COUNT(*) as 'total' FROM book_data WHERE book_call_classification_100 = '3' ";
    $stmt = sqlsrv_query($conn, $sql);
    if ($stmt === false) {
        die(print_r(sqlsrv_errors(), true));
    }
    $row = sqlsrv_fetch_array($stmt, SQLSRV_FETCH_ASSOC);
    return $row['total'];
}

function getDataChartDiv4($conn)
{
    $sql = "SELECT COUNT(*) as 'total' FROM book_data WHERE book_call_classification_100 = '4' ";
    $stmt = sqlsrv_query($conn, $sql);
    if ($stmt === false) {
        die(print_r(sqlsrv_errors(), true));
    }
    $row = sqlsrv_fetch_array($stmt, SQLSRV_FETCH_ASSOC);
    return $row['total'];
}

function getDataChartDiv5($conn)
{
    $sql = "SELECT COUNT(*) as 'total' FROM book_data WHERE book_call_classification_100 = '5' ";
    $stmt = sqlsrv_query($conn, $sql);
    if ($stmt === false) {
        die(print_r(sqlsrv_errors(), true));
    }
    $row = sqlsrv_fetch_array($stmt, SQLSRV_FETCH_ASSOC);
    return $row['total'];
}

function getDataChartDiv6($conn)
{
    $sql = "SELECT COUNT(*) as 'total' FROM book_data WHERE book_call_classification_100 = '6' ";
    $stmt = sqlsrv_query($conn, $sql);
    if ($stmt === false) {
        die(print_r(sqlsrv_errors(), true));
    }
    $row = sqlsrv_fetch_array($stmt, SQLSRV_FETCH_ASSOC);
    return $row['total'];
}

function getDataChartDiv7($conn)
{
    $sql = "SELECT COUNT(*) as 'total' FROM book_data WHERE book_call_classification_100 = '7' ";
    $stmt = sqlsrv_query($conn, $sql);
    if ($stmt === false) {
        die(print_r(sqlsrv_errors(), true));
    }
    $row = sqlsrv_fetch_array($stmt, SQLSRV_FETCH_ASSOC);
    return $row['total'];
}

function getDataChartDiv8($conn)
{
    $sql = "SELECT COUNT(*) as 'total' FROM book_data WHERE book_call_classification_100 = '8' ";
    $stmt = sqlsrv_query($conn, $sql);
    if ($stmt === false) {
        die(print_r(sqlsrv_errors(), true));
    }
    $row = sqlsrv_fetch_array($stmt, SQLSRV_FETCH_ASSOC);
    return $row['total'];
}

function getDataChartDiv9($conn)
{
    $sql = "SELECT COUNT(*) as 'total' FROM book_data WHERE book_call_classification_100 = '9' ";
    $stmt = sqlsrv_query($conn, $sql);
    if ($stmt === false) {
        die(print_r(sqlsrv_errors(), true));
    }
    $row = sqlsrv_fetch_array($stmt, SQLSRV_FETCH_ASSOC);
    return $row['total'];
}

function getDataChartBookBooking($conn)
{
    $sql = "SELECT COUNT(*) as 'total' FROM data_booking_histery WHERE booking_status = '1' ";
    $stmt = sqlsrv_query($conn, $sql);
    if ($stmt === false) {
        die(print_r(sqlsrv_errors(), true));
    }
    $row = sqlsrv_fetch_array($stmt, SQLSRV_FETCH_ASSOC);
    return $row['total'];
}

function getDataChartBookLoaning($conn)
{
    $sql = "SELECT COUNT(*) as 'total' FROM data_booking_histery WHERE booking_status = '2' ";
    $stmt = sqlsrv_query($conn, $sql);
    if ($stmt === false) {die(print_r(sqlsrv_errors(), true));}
   $row = sqlsrv_fetch_array($stmt, SQLSRV_FETCH_ASSOC);
   return $row['total'];

}?>

