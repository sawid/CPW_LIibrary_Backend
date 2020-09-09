
<?php


function login($user_id, $ref_id, $user_class, $user, $pass, $user_type)
{

    include('connect_db.php');
    if ($user_class == 1) {

        $sql        = "SELECT * FROM cpw.dbo.student_main WHERE info_id ='$ref_id'";
        $stmt       = sqlsrv_query($conn, $sql);
        if ($stmt === false) {
            die(print_r(sqlsrv_errors(), true));
        }
        $row  = sqlsrv_fetch_array($stmt, SQLSRV_FETCH_ASSOC);
        $pass_md        = md5($pass);
        $password_date    = md5($row['info_pass']);
        if ($pass_md == $password_date) {

            if($user_type == 'a'){
                
            session_start();
            $_SESSION['user_type']                = $user_type;
            $_SESSION['user_id']                = $user_id;
                return 'LOGIN_OK1';
            }
            else {
                return 'คุณไม่มีสิทธิ์เข้าถึงระบบ';
            }
        } else {
            return 'รหัสผ่านของคุณไม่ถูกต้อง 2'; // รหัสผ่านของคุณไม่ถูกต้อง
        }
    } else if ($user_class == 2) {
        $sql        = "SELECT * FROM cpw.dbo.teacher_main WHERE tec_id='$ref_id' AND tec_status=1";
        $stmt       = sqlsrv_query($conn, $sql);
        if ($stmt === false) {
            die(print_r(sqlsrv_errors(), true));
        }
        $row_main  = sqlsrv_fetch_array($stmt, SQLSRV_FETCH_ASSOC);
        if ($row_main['tec_number'] == $user) {
            $pass_md        = md5($pass);
            $password_date    = md5($row_main['tec_pass']);
            if ($pass_md == $password_date) {
               
                if($user_type == 'a'){
                     session_start();
                     $_SESSION['user_type']                = $user_type;
                $_SESSION['user_id']                = $user_id;
                return 'LOGIN_OK1';
            }
            else {
                return 'คุณไม่มีสิทธิ์เข้าถึงระบบ';
            }
            } else {
                return 'รหัสผ่านของคุณไม่ถูกต้อง 2'; // รหัสผ่านของคุณไม่ถูกต้อง
            }
        }
    } else {
        return '000';
    }

}
if ($_POST['user'] != '' && $_POST['pass'] != '') {
    include('connect_db.php');

    $user        = $_POST['user'];
    $pass        = $_POST['pass'];


    $sql        = "SELECT * FROM data_user WHERE user_code='$user' ";
    $stmt       = sqlsrv_query($conn, $sql);
    if ($stmt === false) {
        die(print_r(sqlsrv_errors(), true));
    }
    $row  = sqlsrv_fetch_array($stmt, SQLSRV_FETCH_ASSOC);

    $ref_id   = $row['ref_id'];
    $user_id  = $row['user_id'];
    $user_class  = $row['user_class'];
    $user_type  = $row['user_type'];
    if ($user_id == '') {
        echo 'ไม่พบข้อมูลของท่านในระบบ'; // รหัสผ่านของคุณไม่ถูกต้อง
        
        // $sql = "SELECT * FROM cpw.dbo.student_main WHERE info_number_std ='$user' and info_pass = '$pass'";
        // $stmt       = sqlsrv_query($conn, $sql);
        // if ($stmt === false) {
        //     die(print_r(sqlsrv_errors(), true));
        // }
        // $row  = sqlsrv_fetch_array($stmt, SQLSRV_FETCH_ASSOC);
        // $ref_id  = $row['info_id'];
        // $user_class  = 1;
        // $user_code  = $row['info_number_std'];
        // $user_card_id  = $row['code'];
        // if ($row['info_id'] == '') {
        //     $sql        = "SELECT * FROM cpw.dbo.teacher_main WHERE tec_number ='$user' and tec_pass = '$pass' AND tec_status=1";
        //     $stmt       = sqlsrv_query($conn, $sql);
        //     if ($stmt === false) {
        //         die(print_r(sqlsrv_errors(), true));
        //     }
        //     $row_main  = sqlsrv_fetch_array($stmt, SQLSRV_FETCH_ASSOC);
        //     $ref_id  = $row_main['tec_id'];
        //     $user_class  = 2;
        //     $user_code  = $row_main['tec_number'];
        //     $user_card_id  = $row_main['code'];
        //     if ($row_main['tec_id'] == '') {
        //         echo 'ไม่พบข้อมูลของท่านในระบบ';
        //     }
        // }

        // $user_token  = md5(date("YmdHis"));

        // $sql = " INSERT INTO [data_user] ([user_code] ,[user_class] ,[ref_id] ,[user_card_id] , user_token ) VALUES( '$user_code','$user_class','$ref_id','$user_card_id' , '$user_token' ) ";
        // $stmt = sqlsrv_query($conn, $sql);
        // if ($stmt === false) {
        //     die(print_r(sqlsrv_errors(), true));
        // }

        // $sql        = "SELECT * FROM data_user WHERE user_code='$user_code' ";
        // $stmt       = sqlsrv_query($conn, $sql);
        // if ($stmt === false) {
        //     die(print_r(sqlsrv_errors(), true));
        // }
        // $row  = sqlsrv_fetch_array($stmt, SQLSRV_FETCH_ASSOC);
        // $ref_id   = $row['ref_id'];
        // $user_id  = $row['user_id'];
        // $user_class  = $row['user_class'];
       

        // echo login($user_id, $ref_id, $user_class, $user, $pass, $user_type);
    } else {

        echo login($user_id, $ref_id, $user_class, $user, $pass, $user_type);
    }
}
