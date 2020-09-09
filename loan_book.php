<!DOCTYPE html>
<html>

<head>

    <title>CPW.LAS: Loan Book</title>
    <?php
  include('dist/php/link_main_taghead.php');
  ?>

</head>



<body class="hold-transition sidebar-collapse scrollbarB lockscreen layout-top-nav">
    <div class="wrapper">
        <?php
  include('dist/php/connect_db.php');
  include('dist/php/function_get_UserData.php');
  include('dist/php/main_sidebar.php');
  include('dist/php/function_get_test.php');
  include('dist/php/sp_process_loan_book.php');

  ?>
        <nav class="main-header navbar navbar-expand-md navbar-light navbar-white">
            <div class="container">
                <a href="index.php" class="navbar-brand">
                    <img src="dist/img/CPWLibraryLOGO.png" alt="AdminLTE Logo"
                        class="brand-image img-circle elevation-3" style="opacity: .8">

                </a>

                <button class="navbar-toggler order-1" type="button" data-toggle="collapse"
                    data-target="#navbarCollapse" aria-controls="navbarCollapse" aria-expanded="false"
                    aria-label="Toggle navigation">
                    <span class="navbar-toggler-icon"></span>
                </button>

                <div class="collapse navbar-collapse order-3" id="navbarCollapse">
                    <!-- Left navbar links -->
                    <ul class="navbar-nav">
                        <li class="nav-item">
                            <a class="nav-link" data-widget="pushmenu" href="#" role="button"><i
                                    class="fas fa-bars"></i></a>
                        </li>
                        <li class="nav-item">
                            <a href="index.php" class="nav-link">Home</a>
                        </li>
                        <li class="nav-item">
                            <a href="contact.php" class="nav-link">Contact</a>
                        </li>
                    </ul>

                    <!-- SEARCH FORM -->
                    <form class="form-inline ml-0 ml-md-3">
                        <div class="input-group input-group-sm">
                            <input class="form-control form-control-navbar" type="search" placeholder="Search"
                                aria-label="Search">
                            <div class="input-group-append">
                                <button class="btn btn-navbar" type="submit">
                                    <i class="fas fa-search"></i>
                                </button>
                            </div>
                        </div>
                    </form>
                </div>

                <!-- Right navbar links -->
                <ul class="order-1 order-md-3 navbar-nav navbar-no-expand ml-auto">
                    <li class="nav-item dropdown">
                        <a class="nav-link" data-toggle="dropdown" href="#">
                            <i class="flag-icon flag-icon-th"></i> TH
                        </a>
                        <div class="dropdown-menu dropdown-menu-right p-0">
                            <a href="#" class="dropdown-item active">
                                <i class="flag-icon flag-icon-us mr-2"></i> English
                            </a>
                            <a href="#" class="dropdown-item">
                                <i class="flag-icon flag-icon-th mr-2"></i> ไทย
                            </a>
                            <a href="#" class="dropdown-item">
                                <i class="flag-icon flag-icon-fr mr-2"></i> French
                            </a>
                            <a href="#" class="dropdown-item">
                                <i class="flag-icon flag-icon-es mr-2"></i> Spanish
                            </a>
                        </div>
                    </li>

                    <!-- Messages Dropdown Menu -->
                    <li class="nav-item d-none d-sm-inline-block">
                        <a class="nav-link" href="dist/php/sp_process_logout.php"><i class="fas fa-sign-out-alt"> </i>
                            ลงชื่อออก </a>
                    </li>


                </ul>
            </div>
        </nav>
        <script>
        var element = document.getElementById("loan_book");
        element.classList.add("active");
        </script>




        <!-- Content Wrapper. Contains page content -->
        <div class="content-wrapper">
            <!-- Content Header (Page header) -->
            <div class="content-header">
                <div class="container">
                    <div class="row mb-2">
                        <div class="col-sm-6">
                            <h1 class="m-0 text-dark">Book Loaning System</h1>
                        </div><!-- /.col -->
                        <div class="col-sm-6">
                            <ol class="breadcrumb float-sm-right">
                                <li class="breadcrumb-item"><a href="index.php"><i class="fas fa-folder-open"></i>
                                        Home</a></li></li>
                                <li class="breadcrumb-item active"><i class="fas fa-qrcode"></i> Loan Book</li>
                            </ol>
                        </div><!-- /.col -->
                    </div><!-- /.row -->
                </div><!-- /.container-fluid -->
            </div>
            <!-- /.content-header -->

            <!-- Main content -->
            <section class="content">
                <div class="container">
                    <div class="card loan-box-bg border-1">
                        <div class="card-body">
                        <div id="main_wrapper" class="lockscreen-wrapper">
                            <div id="loan-box" class="card card-default border-0" style="box-shadow: 0 4px 8px 0 rgba(0, 0, 0, 0.2), 0 6px 20px 0 rgba(0, 0, 0, 0.19);">

                                <div class="">
                                    <div class="lockscreen-logo" style="margin-top: 4%">
                                        <p><b>Loaning System</b> ระบบยืมหนังสือ</p>
                                    </div>
                                    <div id="lock-status" class="lockscreen-name text-break"><span class="badge bg-gray">แตะบัตรเพื่อทำรายการ</span>
                                    </div>

                                    <div class="lockscreen-item">
                                        <div class="lockscreen-image">
                                            <img src="dist/img/CPWLibraryLOGO.png" alt="User Image">
                                        </div>

                                        <div class="lockscreen-credentials">
                                            <div id="main_loan_box" class="input-group">
                                                <input id="text_loan_id" type="number"
                                                    class="text-white hide-arrow form-control text-placewhite text-white"
                                                    placeholder="รหัสของผู้ยืม" onkeydown="enterSubmitLoan(event)">

                                                <div class="input-group-append">
                                                    <button type="button" class="btn"><i
                                                            class="fas fa-arrow-right text-white"
                                                            onclick="loanCheck()"></i></button>
                                                </div>
                                            </div>
                                        </div>
                                        
                                    </div>
                                </div>

                            </div>
                        </div>
                        </div>
                    </div>
                    



                </div><!-- /.container-fluid -->
            </section>
            <!-- /.content -->
        </div>
        <!-- /.content-wrapper -->



    </div>
    <!-- ./wrapper -->
    <?php include('dist/php/link_main_function_js.php') ?>
    <!-- AdminLTE dashboard demo (This is only for demo purposes) -->
    <!-- <script src="dist/js/pages/dashboard.js"></script> -->
    <!-- AdminLTE for demo purposes -->
    <script src="dist/js/function_loan_book.js"></script>
    <script>
    </script>
</body>

</html>