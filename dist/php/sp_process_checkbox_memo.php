<?php

include('connect_db.php');
$checkbox_id = $_POST['check_id'];

$sql = "SELECT * FROM data_comment WHERE text_id = '$checkbox_id' ";
$stmt = sqlsrv_query($conn, $sql);
    if ($stmt === false) {
        die(print_r(sqlsrv_errors(), true));
    }
$row = sqlsrv_fetch_array($stmt, SQLSRV_FETCH_ASSOC);
$check_id  = $row['user_id'];

if ($check_id  == 0) {

    $sql = " UPDATE data_comment SET user_id = 1 WHERE text_id = '$checkbox_id'";
    $stmt = sqlsrv_query($conn, $sql);
    if ($stmt === false) {
        die(print_r(sqlsrv_errors(), true));
    }
} 
elseif ($check_id  == 1) {

    $sql = " UPDATE data_comment SET user_id = 0 WHERE text_id = '$checkbox_id'";
    $stmt = sqlsrv_query($conn, $sql);
    if ($stmt === false) {
        die(print_r(sqlsrv_errors(), true));
    }
}