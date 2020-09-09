<?php
    $code   = $_POST['code'];

    if($code == 1){

        include("connect_db.php");

        $Author_name = trim($_POST['Author_name']);

        $sql = "SELECT * FROM cpw_library.dbo.data_Author WHERE Author_name = '$Author_name'";
        $stmt = sqlsrv_query($conn, $sql);
        if ($stmt === false) {
            die(print_r(sqlsrv_errors(), true));
        }
        $row = sqlsrv_fetch_array($stmt, SQLSRV_FETCH_ASSOC);
        echo  $row['Author_id'];
    }
 