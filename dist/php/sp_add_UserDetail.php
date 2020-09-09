<?php

$code  = $_POST['code'];

if ($code == 1) {
    include("connect_db.php");

    $user_class  = $_POST['user_class'];
    $user_code  = $_POST['user_code'];
    $user_card_id  = $_POST['user_card_id'];
    $ref_id  = $_POST['ref_id'];

    if (strlen((string)$user_code) == 5) {
        if (strlen((string)$user_card_id) > 0 && strlen((string)$ref_id)  > 0 ){
            $sql_1st = " SELECT * FROM data_user where ref_id = '$ref_id' ";
            $stmt_1st = sqlsrv_query($conn, $sql_1st);
            if ($stmt_1st === false) {
                die(print_r(sqlsrv_errors(), true));
            }
            $fetch_1st = sqlsrv_fetch_array($stmt_1st, SQLSRV_FETCH_ASSOC);
            if($fetch_1st['ref_id'] != ''){
                echo 'HAVINGID01' ;
            }
            else {
                $sql = " INSERT INTO [data_user]
           ([user_code]
           ,[user_class]
           ,[ref_id]
           ,[user_card_id]
            )
            VALUES(
            '$user_code'
           ,'$user_class'
           ,'$ref_id'
           ,'$user_card_id'
            ) ";

            $stmt = sqlsrv_query($conn, $sql);
         if ($stmt === false) {
                die(print_r(sqlsrv_errors(), true));
             }
             echo 'ADDINGOK01' ;
            }
        }
        else {
            echo 'NOUSERHERE01' ;
        }
    }
    else {
        echo 'CODEIDNOT000000' ;

    }


   
    
    
}