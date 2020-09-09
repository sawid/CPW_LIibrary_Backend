<?php

include('connect_db.php');
$delete_id = $_POST['clicked_id'];

$sql = "DELETE FROM data_comment WHERE text_id = '$delete_id' ";
$stmt = sqlsrv_query($conn, $sql);
    if ($stmt === false) {
        die(print_r(sqlsrv_errors(), true));
    }
    echo 'textboxdeletesuccess' ;
