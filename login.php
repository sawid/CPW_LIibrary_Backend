<?php
session_start();
  $user_type =$_SESSION['user_type'];
if($user_type == 'm') {
    session_destroy();
    echo '<script> location.reload(); </script>';
}
if($user_type == 'a'){
     echo '<script> location.replace("index.php"); </script>';
}
?>
<!DOCTYPE html>
<html>

<head>
    <title>CPW-LAS: Check Permission</title>
    <?php
  // include('main_head.php');
  include('dist/php/main_icon.php');
?>


    <meta charset="utf-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <!-- Tell the browser to be responsive to screen width -->
    <meta name="viewport" content="width=device-width, initial-scale=1">

    <!-- Font Awesome -->
    <link rel="stylesheet" href="plugins/fontawesome-free/css/all.min.css">
    <!-- Ionicons -->
    <link rel="stylesheet" href="https://code.ionicframework.com/ionicons/2.0.1/css/ionicons.min.css">
    <!-- icheck bootstrap -->
    <link rel="stylesheet" href="plugins/icheck-bootstrap/icheck-bootstrap.min.css">
    <!-- Theme style -->
    <link rel="stylesheet" href="dist/css/adminlte.min.css">
    <!-- Google Font: Source Sans Pro -->
    <link href="https://fonts.googleapis.com/css?family=Source+Sans+Pro:300,400,400i,700" rel="stylesheet">
</head>

<body class="hold-transition login-page" style="overflow-x: hidden;overflow-y: hidden;">
    <div class="login-box">
        <div class="login-logo">
            <b>CPW</b>Library
        </div>
        <!-- /.login-logo -->
        <div class="card">
            <div class="card-body login-card-body">
                <p class="login-box-msg">ลงชื่อเข้าสู่ระบบการจัดการห้องสมุด</p>
                <form action="javascript:void(0)" method="post">
                    เลขประจำตัว
                    <div class="input-group mb-3 has-feedback">
                        <input type="number" class="form-control" id="user" placeholder="เลขประจำตัว">
                        <!-- <span class="glyphicon glyphicon-user form-control-feedback"></span> -->
                        <div class="input-group-append">
                            <div class="input-group-text">
                                <span class="fas fa-user"></span>
                            </div>
                        </div>


                    </div>
                    <p id="check-allright-urna" class="text-red"></p>
                    รหัสผ่าน
                    <div class="input-group mb-3  has-feedback">
                        <input type="password" class="form-control" id="pass" placeholder="รหัสผ่าน">
                        <!-- <span class="glyphicon glyphicon-lock form-control-feedback"></span> -->
                        <div class="input-group-append">
                            <div class="input-group-text">
                                <span class="fas fa-lock"></span>
                            </div>
                        </div>

                    </div>
                    <p id="check-allright-pawo" class="text-red"></p>
                    <div class="row">
                        <div class="col-8">
                            <p id="check-allright-lgin" class="text-primary"></p>
                        </div>
                        <!-- /.col -->
                        <div class="col-4">
                            <button type="" onclick="Userlogin()" class="btn btn-primary btn-block ">ลงชื่อ</button>

                        </div>

                        <!-- /.col -->
                    </div>
                </form>

            </div>
            <!-- /.login-card-body -->
        </div>
    </div>
    <!-- /.login-box -->

    <!-- jQuery -->
    <script src="plugins/jquery/jquery.min.js"></script>
    <!-- Bootstrap 4 -->
    <script src="plugins/bootstrap/js/bootstrap.bundle.min.js"></script>
    <!-- AdminLTE App -->
    <script src="dist/js/adminlte.min.js"></script>
    <script src="plugins/sweetalert2/sweetalert2.all.min.js"></script>
    <!-- Optional: include a polyfill for ES6 Promises for IE11 -->
    <!-- <script src="https://cdn.jsdelivr.net/npm/promise-polyfill"></script>
 -->


    <script>
    function Userlogin() {
        $("#check-allright-urna").empty();
        $("#check-allright-pawo").empty();
        var user = document.getElementById("user").value;
        if (user.length != 5) {
            $("#check-allright-urna").append(
                '<i class="fas fa-times-circle"></i> กรุณาใส่เลขประจำตัวให้ถูกต้อง'
            );
            show_modal('error', 'กรุณาใส่เลขประจำตัวให้ถูกต้อง');

            document.getElementById("user").focus();
            return false;
        }
        var pass = document.getElementById("pass").value;
        if (pass.length == 0) {
            $("#check-allright-pawo").append(
                '<i class="fas fa-times-circle"></i> กรุณาใส่รหัสผ่าน'
            );
            show_modal('error', 'กรุณาใส่รหัสผ่าน');

            document.getElementById("pass").focus();
            return false;
        }
        $("#check-allright-lgin").empty();
        $("#check-allright-lgin").append(
            '<i class="fas fa-circle-notch fa-pulse fa-fw"></i> กำลังตรวจสอบข้อมูล...'
        );
        show_modal('info', 'กำลังตรวจสอบข้อมูล');

        $.post("dist/php/sp_process_login.php", {
            user: user,
            pass: pass
        }, function(data) {
            if ($.trim(data) == "LOGIN_OK1") {
                show_result('success', 'สำเร็จ', 'ระบบกำลังนำท่างท่านไป');
                setTimeout(function() {
                    // location.reload();
                    // history.go(-2);
                    location.replace("index.php");
                    //    window.history.back();
                    // location.reload(); 
                }, 
                1500);
            } else {
                $("#check-allright-lgin").empty();
                $("#check-allright-lgin").append('<i class="fas fa-times-circle"></i> ' + data);
                show_result('error', 'ผิดพลาด', data);
            }
        });
    }

    function show_modal(icon, title) {
        const Toast = Swal.mixin({
            toast: true,
            position: 'top-end',
            showConfirmButton: false,

            timer: 3000,
            timerProgressBar: true,
            onOpen: (toast) => {
                toast.addEventListener('mouseenter', Swal.stopTimer)
                toast.addEventListener('mouseleave', Swal.resumeTimer)
            }
        })

        Toast.fire({
            icon: icon,
            title: title

            // iconHtml: '<i class="fas fa-circle-notch fa-pulse fa-fw"></i>';
        })
    }

    function show_result(icon, title, text) {
        Swal.fire({
            icon: icon,
            title: title,
            timer: 1500,
            timerProgressBar: true,
            text: text
            // footer: '<a href>ติดต่อผู้ดูแล</a>'
        })
    }

    $(function() {
        $('input').iCheck({
            checkboxClass: 'icheckbox_square-blue',
            radioClass: 'iradio_square-blue',
            increaseArea: '20%' /* optional */
        });
    });
    </script>
</body>

</html>