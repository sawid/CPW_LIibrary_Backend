<!DOCTYPE html>
<html>

<head>

    <title>CPW.LAS: Dashboard</title>
    <?php
  include('dist/php/link_main_taghead.php');
  ?>

</head>



<body class="hold-transition sidebar-mini layout-fixed scrollbarB">
    <div class="wrapper">
        <?php
  include('dist/php/connect_db.php');
  include('dist/php/function_get_UserData.php');
  include('dist/php/function_get_statistic.php');
  include('dist/php/link_main_body.php');
  include('dist/php/sp_process_show_memo.php');
  ?>

        <script>
        var element = document.getElementById("dashboard");
        element.classList.add("active");
        </script>




        <!-- Content Wrapper. Contains page content -->
        <div class="content-wrapper">
            <!-- Content Header (Page header) -->
            <div class="content-header">
                <div class="container-fluid">
                    <div class="row mb-2">
                        <div class="col-sm-6">
                            <h1 class="m-0 text-dark">Dashboard</h1>
                        </div><!-- /.col -->
                        <div class="col-sm-6">
                            <ol class="breadcrumb float-sm-right">
                                <li class="breadcrumb-item"><a href="index.php"><i class="fas fa-folder-open"></i>
                                        Home</a></li></li>
                                <li class="breadcrumb-item active">Dashboard</li>
                            </ol>
                        </div><!-- /.col -->
                    </div><!-- /.row -->
                </div><!-- /.container-fluid -->
            </div>
            <!-- /.content-header -->

            <!-- Main content -->
            <section class="content">
                <div class="container-fluid">
                    <!-- Small boxes (Stat box) -->
                    <div class="row">
                        <div class="col-12">

                        </div>
                        <div class="col-lg-3 col-6">
                            <!-- small box -->
                            <div class="small-box bg-secondary">
                                <div class="inner">
                                    <h3>X</h3>

                                    <p>จำนวนผู้ทำรายการวันนี้</p>
                                </div>
                                <div class="icon">
                                    <i class="ion ion-android-notifications-none"></i>
                                </div>
                                <a href="#" class="small-box-footer">ดูทั้งหมด <i
                                        class="fa fa-arrow-circle-right"></i></a>
                            </div>
                        </div>
                        <!-- ./col -->
                        <div class="col-lg-3 col-6">
                            <!-- small box -->
                            <div class="small-box bg-secondary">
                                <div class="inner">
                                    <h3>X</h3>

                                    <p>ข้อความที่ยังไม่ได้ตอบ</p>
                                </div>

                                <div class="icon">
                                    <i class="ion ion-chatbox-working"></i>
                                </div>
                                <a href="#" class="small-box-footer">ดูทั้งหมด <i
                                        class="fa fa-arrow-circle-right"></i></a>
                            </div>
                        </div>
                        <!-- ./col -->
                        <div class="col-lg-3 col-6">
                            <!-- small box -->
                            <div class="small-box bg-secondary">
                                <div class="inner">
                                    <h3><?php echo number_format(getDataNumberBook($conn)) ;?></h3>

                                    <p>จำนวนหนังสือทั้งหมด</p>
                                </div>
                                <div class="icon">
                                    <i class="ion ion-ios-albums"></i>
                                </div>
                                <a href="book.php" class="small-box-footer">ดูทั้งหมด <i
                                        class="fa fa-arrow-circle-right"></i></a>
                            </div>
                        </div>
                        <!-- ./col -->
                        <div class="col-lg-3 col-6">
                            <!-- small box -->
                            <div class="small-box bg-secondary ">
                                <div class="inner">
                                    <h3><?php echo number_format(getDataNumberUser($conn)) ;?></h3>

                                    <p>จำนวนสมาชิกทั้งหมด</p>
                                </div>
                                <div class="icon">
                                    <i class="ion ion-android-people"></i>
                                </div>
                                <a href="member.php" class="small-box-footer">ดูทั้งหมด <i
                                        class="fa fa-arrow-circle-right"></i></a>
                            </div>
                        </div>
                        <!-- ./col -->
                    </div>
                    <!-- /.row -->
                    <!-- Main row -->
                    <div class="row">
                        <!-- Left col -->
                        <section class="col-lg-7 connectedSortable">
                            <!-- Custom tabs (table with tabs)-->
                            <div class="card">
                                <div class="card-header border-0">
                                    <h3 class="card-title">
                                        <i class="fas fa-table mr-1"></i>
                                        ตารางรายการ
                                    </h3>
                                    <div class="card-tools">
                                        <ul class="nav nav-pills ml-auto">
                                            <li class="nav-item">
                                                <a class="nav-link active" href="#table-b"
                                                    data-toggle="tab">กำหนดคืน</a>
                                            </li>
                                            <li class="nav-item">
                                                <a class="nav-link" href="#sales-chart" data-toggle="tab">ล่าสุด</a>
                                            </li>
                                        </ul>
                                    </div>
                                </div><!-- /.card-header -->
                                <div class="">
                                    <div class="tab-content p-0">

                                        <div class="tab-pane active table-responsive scrollbarB" id="table-b"
                                            style="position: relative; height: 300px;">
                                            <!-- TABLE: LATEST ORDERS -->
                                            <table class="table table-head-fixed m-0">
                                                <thead>
                                                    <tr>
                                                        <th>ผู้ยืม</th>
                                                        <th>รายการ</th>
                                                        <th>กำหนดคืน</th>
                                                        <th></th>
                                                    </tr>
                                                </thead>
                                                <tbody>
                                                    <tr>
                                                        <td class="text-center">
                                                            <div class="image">
                                                                <img src="https://app.cpw.ac.th/cpw_api_content/images/student/25191.jpg"
                                                                    class="img--circle elevation-1"
                                                                    style=" width:2.1rem;  height:2.1rem;  object-fit:cover;object-position: top; border-radius:50%;"
                                                                    alt="User Image">
                                                                <span class="">25191</span>
                                                            </div>

                                                        </td>
                                                        <td>Update software <span class="badge bg-red">เลยกำหนด</span>
                                                        </td>
                                                        <td>
                                                            10.05.2020
                                                        </td>
                                                        <td><button type="button"
                                                                class="btn btn-xs btnutline-primary"><i
                                                                    class="fa fa-search-plus"></i></button></td>
                                                    </tr>
                                                    <tr>
                                                        <td class="text-center">
                                                            <div class="image">
                                                                <img src="https://app.cpw.ac.th/cpw_api_content/images/student/25191.jpg"
                                                                    class="img--circle  elevation-1"
                                                                    style=" width:2.1rem;  height:2.1rem;  object-fit:cover;object-position: top; border-radius:50%;"
                                                                    alt="User Image">
                                                                <span class="">25191</span>
                                                            </div>

                                                        </td>
                                                        <td>Clean database <span
                                                                class="badge bg-primary">ต้องคืนวันนี้</span></td>
                                                        <td>
                                                            10.05.2020
                                                        </td>
                                                        <td><button type="button"
                                                                class="btn btn-xs btnutline-primary"><i
                                                                    class="fa fa-search-plus"></i></button></td>
                                                    </tr>
                                                    <tr>
                                                        <td class="text-center">
                                                            <div class="image">
                                                                <img src="https://app.cpw.ac.th/cpw_api_content/images/student/25191.jpg"
                                                                    class="img--circle  elevation-1"
                                                                    style=" width:2.1rem;  height:2.1rem;  object-fit:cover;object-position: top; border-radius:50%;"
                                                                    alt="User Image">
                                                                <span class="">25191</span>
                                                            </div>

                                                        </td>
                                                        <td>Cron job running <span class="badge bg-success">เหลืออีก 3
                                                                วัน</span></td>
                                                        <td>
                                                            10.05.2020
                                                        </td>
                                                        <td><button type="button"
                                                                class="btn btn-xs btnutline-primary"><i
                                                                    class="fa fa-search-plus"></i></button></td>
                                                    </tr>
                                                    <tr>
                                                        <td class="text-center">
                                                            <div class="image">
                                                                <img src="https://app.cpw.ac.th/cpw_api_content/images/student/25191.jpg"
                                                                    class="img--circle  elevation-1"
                                                                    style=" width:2.1rem;  height:2.1rem;  object-fit:cover;object-position: top; border-radius:50%;"
                                                                    alt="User Image">
                                                                <span class="">25191</span>
                                                            </div>

                                                        </td>
                                                        <td>Cron job running <span class="badge bg-success">เหลืออีก 3
                                                                วัน</span></td>
                                                        <td>
                                                            10.05.2020
                                                        </td>
                                                        <td><button type="button"
                                                                class="btn btn-xs btnutline-primary"><i
                                                                    class="fa fa-search-plus"></i></button></td>
                                                    </tr>
                                                    <tr>
                                                        <td class="text-center">
                                                            <div class="image">
                                                                <img src="https://app.cpw.ac.th/cpw_api_content/images/student/25191.jpg"
                                                                    class="img--circle elevation-2"
                                                                    style=" width:2.1rem;  height:2.1rem;  object-fit:cover;object-position: top; border-radius:50%;"
                                                                    alt="User Image">
                                                                <span class="">25191</span>
                                                            </div>

                                                        </td>
                                                        <td>Cron job running <span class="badge bg-success">เหลืออีก 3
                                                                วัน</span></td>
                                                        <td>
                                                            10.05.2020
                                                        </td>
                                                        <td><button type="button"
                                                                class="btn btn-xs  btnutline-primary"><i
                                                                    class="fa fa-search-plus"></i></button></td>
                                                    </tr>

                                                </tbody>
                                            </table>

                                        </div>
                                        <div class="tab-pane" id="sales-chart"
                                            style="position: relative; height: 300px;">

                                        </div>
                                    </div>
                                </div><!-- /.card-body -->
                            </div>
                            <!-- /.card -->
                            <!-- Calendar -->
                            <div class="card bg-gradient-light">
                                <div class="card-header border-0">

                                    <h3 class="card-title">
                                        <i class="far fa-calendar-alt"></i>
                                        ปฎิทินห้องสมุด
                                    </h3>
                                    <!-- tools card -->
                                    <div class="card-tools">
                                        <!-- button with a dropdown -->
                                        <div class="btn-group">
                                            <button type="button" class="btn btnutline-primary btn-sm dropdown-toggle"
                                                data-toggle="dropdown">
                                                <i class="fas fa-bars"></i></button>
                                            <div class="dropdown-menu float-right dropdown-menu-right" role="menu">
                                                <a href="#" class="dropdown-item">Add new event</a>
                                                <a href="#" class="dropdown-item">Clear events</a>
                                                <div class="dropdown-divider"></div>
                                                <a href="#" class="dropdown-item">View calendar</a>
                                            </div>
                                        </div>

                                    </div>
                                    <!-- /. tools -->
                                </div>
                                <!-- /.card-header -->
                                <div class="card-body pt-0">
                                    <!--The calendar -->
                                    <div id="calendar" style="width: 100%"></div>
                                </div>
                                <!-- /.card-body -->
                            </div>
                            <!-- /.card -->



                            <!-- TO DO List -->
                            <div class="card">
                                <div class="card-header">
                                    <h3 class="card-title">
                                        <i class="ion ion-chatbox mr-1"></i>
                                        ตารางบันทึกข้อความ
                                    </h3>

                                    <div class="card-tools">

                                    </div>
                                </div>
                                <!-- /.card-header -->
                                <div class="card-body">
                                    
                                    <ul id="showMemo" class="todo-list" data-widget="todo-list">
                                   
                                        
                                    </ul>
                                </div>
                                <!-- /.card-body -->
                                <div class="card-footer clearfix">
                                <div class="mb-1">
                                <span id="memo-text" name="memo-text"></span>
                                </div>
                                
                                    <div class="input-group input-group-md">
                                        <input type="text" name="texts" id="texts" class="form-control" placeholder="ข้อความบันทึก" onkeydown="enterSubmit(event)">
                                        <span class="input-group-append">
                                            <button type="button" onclick="addNewMemo() " class="btn btn-info float-right"><i class="fas fa-plus"></i>
                                        เพิ่มบันทึกใหม่</button>
                                        </span>
                                    </div>    
                                </div>
                            </div>
                            <!-- /.card -->
                        </section>
                        <!-- /.Left col -->
                        <!-- right col (We are only adding the ID to make the widgets sortable)-->
                        <section class="col-lg-5 connectedSortable">

                            <div class="card">
                                <div class="card-header  border-0">
                                    <h3 class="card-title">
                                        <i class="fas fa-users mr-1"></i>
                                        ข้อมูลสมาชิก
                                    </h3>

                                    <div class="card-tools">
                                        <ul class="nav nav-pills ml-auto">
                                            <li class="nav-item">
                                                <a class="nav-link active" href="#table-c" data-toggle="tab">ประเภท</a>
                                            </li>
                                            <li class="nav-item">
                                                <a class="nav-link" href="#table-d" data-toggle="tab">สถานะ</a>
                                            </li>
                                        </ul>

                                    </div>
                                </div>
                                <!-- /.card-header -->

                                <!-- /.footer -->
                                <div class="">
                                    <div class="tab-content p-0">

                                        <div class="tab-pane active table-responsive scrollbarB" id="table-c"
                                            style="position: relative;">
                                            <!-- TABLE: LATEST ORDERS -->
                                            <div class="card-body">
                                                <div class="row">
                                                    <div class="col-md-8">
                                                        <div class="chart-responsive">
                                                            <canvas id="MemberChart" height="150"></canvas>
                                                        </div>
                                                        <!-- ./chart-responsive -->
                                                    </div>
                                                    <!-- /.col -->
                                                    <div class="col-md-4">
                                                        <ul class="chart-legend clearfix">
                                                            <li><i class="far fa-circle text-danger"></i> นักเรียน</li>
                                                            <li><i class="far fa-circle text-success"></i> ครู</li>
                                                            <li><i class="far fa-circle text-warning"></i> บุคลากร / บุคคลทั่วไป</li>
                                                        </ul>
                                                    </div>
                                                    <!-- /.col -->
                                                </div>
                                                <!-- /.row -->
                                            </div>
                                            <!-- /.card-body -->
                                            <!--<div class="card-footer bg-white p-0">
                                                <ul class="nav nav-pills flex-column">
                                                    <li class="nav-item">
                                                        <a href="#" class="nav-link">
                                                            United States of America
                                                            <span class="float-right text-danger">
                                                                <i class="fas fa-arrow-down text-sm"></i>
                                                                12%</span>
                                                        </a>
                                                    </li>
                                                    <li class="nav-item">
                                                        <a href="#" class="nav-link">
                                                            India
                                                            <span class="float-right text-success">
                                                                <i class="fas fa-arrow-up text-sm"></i> 4%
                                                            </span>
                                                        </a>
                                                    </li>
                                                    <li class="nav-item">
                                                        <a href="#" class="nav-link">
                                                            China
                                                            <span class="float-right text-warning">
                                                                <i class="fas fa-arrow-left text-sm"></i> 0%
                                                            </span>
                                                        </a>
                                                    </li>
                                                </ul>
                                            </div>-->

                                        </div>
                                        <div class="tab-pane" id="table-d" style="position: relative;">
                                            <!-- TABLE: LATEST ORDERS -->
                                            <div class="card-body">
                                                <div class="row">
                                                    <div class="col-md-8">
                                                        <div class="chart-responsive">
                                                            <canvas id="BookChart" height="150"></canvas>
                                                        </div>
                                                        <!-- ./chart-responsive -->
                                                    </div>
                                                    <!-- /.col -->
                                                    <div class="col-md-4">
                                                        <ul class="chart-legend clearfix">
                                                            <li><i class="far fa-circle text-success"></i>
                                                            สามารถใช้งานได้</li>
                                                            <li><i class="far fa-circle text-danger"></i> ถูกระงับการใช้งาน
                                                            </li>
                                                        </ul>
                                                    </div>
                                                    <!-- /.col -->
                                                </div>
                                                <!-- /.row -->
                                            </div>
                                            <!-- /.card-body -->
                                            <!--<div class="card-footer bg-white p-0">
                                                <ul class="nav nav-pills flex-column">
                                                    <li class="nav-item">
                                                        <a href="#" class="nav-link">
                                                            United States of America
                                                            <span class="float-right text-danger">
                                                                <i class="fas fa-arrow-down text-sm"></i>
                                                                12%</span>
                                                        </a>
                                                    </li>
                                                    <li class="nav-item">
                                                        <a href="#" class="nav-link">
                                                            India
                                                            <span class="float-right text-success">
                                                                <i class="fas fa-arrow-up text-sm"></i> 4%
                                                            </span>
                                                        </a>
                                                    </li>
                                                    <li class="nav-item">
                                                        <a href="#" class="nav-link">
                                                            China
                                                            <span class="float-right text-warning">
                                                                <i class="fas fa-arrow-left text-sm"></i> 0%
                                                            </span>
                                                        </a>
                                                    </li>
                                                </ul>
                                            </div>-->
                                        </div>
                                    </div>
                                </div>
                            </div>
                            <!-- /.card -->
                            <div class="card">
                                <div class="card-header  border-0">
                                    <h3 class="card-title">
                                        <i class="fas fa-book mr-1"></i>
                                        ข้อมูลหนังสือ
                                    </h3>

                                    <div class="card-tools">
                                        <ul class="nav nav-pills ml-auto">
                                            <li class="nav-item">
                                                <a class="nav-link active" href="#table-e" data-toggle="tab">สถานที่</a>
                                            </li>
                                            <li class="nav-item">
                                                <a class="nav-link" href="#table-f" data-toggle="tab">สถานะ</a>
                                            </li>
                                        </ul>

                                    </div>
                                </div>
                                <!-- /.card-header -->

                                <!-- /.footer -->
                                <div class="">
                                    <div class="tab-content p-0">

                                        <div class="tab-pane active table-responsive scrollbarB" id="table-e"
                                            style="position: relative;">
                                            <!-- TABLE: LATEST ORDERS -->
                                            <div class="card-body">
                                                <div class="row">
                                                    <div class="col-md-8">
                                                        <div class="chart-responsive">
                                                            <canvas id="LocationChart" height="150"></canvas>
                                                        </div>
                                                        <!-- ./chart-responsive -->
                                                    </div>
                                                    <!-- /.col -->
                                                    <div class="col-md-4">
                                                        <ul class="chart-legend clearfix">
                                                            <li><i class="far fa-circle text-danger"></i> ห้องสมุด 40 ปี
                                                            </li>
                                                            <li><i class="far fa-circle text-success"></i> ห้องสมุด 60
                                                                ปี</li>
                                                            <li><i class="far fa-circle text-warning"></i> ห้องสมุด EP
                                                            </li>
                                                            <li><i class="far fa-circle text-info"></i> อื่นๆ
                                                            </li>
                                                        </ul>
                                                    </div>
                                                    <!-- /.col -->
                                                </div>
                                                <!-- /.row -->
                                            </div>
                                            <!-- /.card-body -->
                                            <!--<div class="card-footer bg-white p-0">
                                                <ul class="nav nav-pills flex-column">
                                                    <li class="nav-item">
                                                        <a href="#" class="nav-link">
                                                            United States of America
                                                            <span class="float-right text-danger">
                                                                <i class="fas fa-arrow-down text-sm"></i>
                                                                12%</span>
                                                        </a>
                                                    </li>
                                                    <li class="nav-item">
                                                        <a href="#" class="nav-link">
                                                            India
                                                            <span class="float-right text-success">
                                                                <i class="fas fa-arrow-up text-sm"></i> 4%
                                                            </span>
                                                        </a>
                                                    </li>
                                                    <li class="nav-item">
                                                        <a href="#" class="nav-link">
                                                            China
                                                            <span class="float-right text-warning">
                                                                <i class="fas fa-arrow-left text-sm"></i> 0%
                                                            </span>
                                                        </a>
                                                    </li>
                                                </ul>
                                            </div> -->

                                        </div>
                                        <div class="tab-pane" id="table-f" style="position: relative;">
                                            <!-- TABLE: LATEST ORDERS -->
                                            <div class="card-body">
                                                <div class="row">
                                                    <div class="col-md-8">
                                                        <div class="chart-responsive">
                                                            <canvas id="BookStatusChart" height="150"></canvas>
                                                        </div>
                                                        <!-- ./chart-responsive -->
                                                    </div>
                                                    <!-- /.col -->
                                                    <div class="col-md-4">
                                                        <ul class="chart-legend clearfix">
                                                            <li><i class="far fa-circle text-success"></i> หนังสือที่ว่าง</li>
                                                            <li><i class="far fa-circle text-yellow"></i> หนังสือที่ถูกจอง</li>
                                                            <li><i class="far fa-circle text-orange"></i> หนังสือที่ถูกยืม</li>
                                                            <li><i class="far fa-circle text-red"></i> หนังสือที่ถูกลบ</li>
                                                            <li><i class="far fa-circle text-gray"></i>
                                                                หนังสือที่เก็บเข้าในคลัง</li>

                                                        </ul>
                                                    </div>
                                                    <!-- /.col -->
                                                </div>
                                                <!-- /.row -->
                                            </div>
                                            <!-- /.card-body -->
                                            <!--<div class="card-footer bg-white p-0">
                                                <ul class="nav nav-pills flex-column">
                                                    <li class="nav-item">
                                                        <a href="#" class="nav-link">
                                                            United States of America
                                                            <span class="float-right text-danger">
                                                                <i class="fas fa-arrow-down text-sm"></i>
                                                                12%</span>
                                                        </a>
                                                    </li>
                                                    <li class="nav-item">
                                                        <a href="#" class="nav-link">
                                                            India
                                                            <span class="float-right text-success">
                                                                <i class="fas fa-arrow-up text-sm"></i> 4%
                                                            </span>
                                                        </a>
                                                    </li>
                                                    <li class="nav-item">
                                                        <a href="#" class="nav-link">
                                                            China
                                                            <span class="float-right text-warning">
                                                                <i class="fas fa-arrow-left text-sm"></i> 0%
                                                            </span>
                                                        </a>
                                                    </li>
                                                </ul>
                                            </div>-->
                                        </div>
                                    </div>
                                </div>
                            </div>
                            <!-- /.card -->
                            <div class="card">
                                <div class="card-header  border-0">
                                    <h3 class="card-title">
                                        <i class="fas fa-book mr-1"></i>
                                        ปริมาณหนังสือในแต่ละหมวด
                                    </h3>
                                </div>
                                <div class="card-body">
                                    <div class="row">
                                        <div class="col-md-12">
                                            <div class="chart-responsive m-auto">
                                                <canvas id="BookDivChart" height="150"></canvas>
                                            </div>
                                            <!-- ./chart-responsive -->
                                        </div>
                                        <!-- /.col -->
                                        <div class="col-12 mt-3">
                                            <ul class="chart-legend-1">
                                                <li class="d-inline-block mr-2"><i
                                                        class="far fa-circle text-indigo"></i> ความรู้ทั่วไป</li>
                                                <li class="d-inline-block mr-2"><i
                                                        class="far fa-circle text-navy"></i> ปรัชญาและจิตวิทยา</li>
                                                <li class="d-inline-block mr-2"><i
                                                        class="far fa-circle text-navy"></i> ศาสนา</li>
                                                <li class="d-inline-block mr-2"><i
                                                        class="far fa-circle text-fuchsia"></i> สังคมศึกษา</li>
                                                <li class="d-inline-block mr-2"><i
                                                        class="far fa-circle text-pink"></i> ภาษาศาสตร์</li>
                                                <li class="d-inline-block mr-2"><i
                                                        class="far fa-circle text-maroon"></i> วิทยาศาสตร์</li>
                                                <li class="d-inline-block mr-2"><i
                                                        class="far fa-circle text-orange"></i> วิทยาศาสตร์ประยุกต์</li>
                                                <li class="d-inline-block mr-2"><i
                                                        class="far fa-circle text-lime"></i> ศิลปกรรม</li>
                                                <li class="d-inline-block mr-2"><i
                                                        class="far fa-circle text-teal"></i> วรรณคดี</li>
                                                <li class="d-inline-block mr-2"><i
                                                        class="far fa-circle text-olive"></i> ประวัติศาสตร์</li>
                                            </ul>
                                        </div>
                                        <!-- /.col -->
                                    </div>
                                    <!-- /.row -->
                                </div>
                                <!-- /.card-header -->

                                <!-- /.footer -->

                            </div>

                        </section>
                        <!-- right col -->
                    </div>
                    <!-- /.row (main row) -->
                </div><!-- /.container-fluid -->
            </section>
            <!-- /.content -->
        </div>
        <!-- /.content-wrapper -->
        <?php include('dist/php/main_footer.php') ?>


    </div>
    <!-- ./wrapper -->
    <?php include('dist/php/link_main_function_js.php') ?>
    <!-- AdminLTE dashboard demo (This is only for demo purposes) -->
    <!-- <script src="dist/js/pages/dashboard.js"></script> -->
    <!-- AdminLTE for demo purposes -->
    <script src="dist/js/demo.js"></script>
    <script src="dist/js/function_memo.js"></script>
    <script>
    $(function() {

        // Make the dashboard widgets sortable Using jquery UI
        $('.connectedSortable').sortable({
            placeholder: 'sort-highlight',
            connectWith: '.connectedSortable',
            handle: '.card-header, .nav-tabs',
            forcePlaceholderSize: true,
            zIndex: 999999
        })
        $('.connectedSortable .card-header, .connectedSortable .nav-tabs-custom').css('cursor', 'move')

        // jQuery UI sortable for the todo list
        $('.todo-list').sortable({
            placeholder: 'sort-highlight',
            handle: '.handle',
            forcePlaceholderSize: true,
            zIndex: 999999
        })

        // The Calender
        $('#calendar').datetimepicker({
            format: 'L',
            inline: true
        })

        //-------------
        //- BookStatusChart CHART -
        //-------------
        // Get context with jQuery - using jQuery's .get() method.
        var pieChartCanvas = $('#BookStatusChart').get(0).getContext('2d')
        var pieData = {
            labels: [
                'หนังสือที่ว่าง',
                'หนังสือที่ถูกจอง',
                'หนังสือที่ถูกยืม',
                'หนังสือที่ถูกลบ',
                'หนังสือที่ถูกเก็บในคลัง',
            ],
            datasets: [{
                data: [[<?php echo number_format(getDataNumberBook($conn) - getDataChartBookBooking($conn) - getDataChartBookLoaning($conn), 0, '.', '') ;?>], 
                [<?php echo number_format(getDataChartBookBooking($conn), 0, '.', '') ;?>], 
                [<?php echo number_format(getDataChartBookLoaning($conn), 0, '.', '') ;?>], 0, 0],
                backgroundColor: ['#f56954', '#ffc107', '#fd7e14', '#00a65a', '#6c757d'],
            }]
        }
        var pieOptions = {
            legend: {
                display: false
            }
        }
        //Create pie or douhnut chart
        // You can switch between pie and douhnut using the method below.
        var pieChart = new Chart(pieChartCanvas, {
            type: 'doughnut',
            data: pieData,
            options: {
                elements: {
                    center: {
                        text: [<?php echo number_format(getDataNumberBook($conn)) ;?>] //set as you wish
                    }
                },
                cutoutPercentage: 50,
                legend: {
                    display: false
                }
            }
        })

        //-----------------
        //- END BookStatusChart -
        //-----------------

        //-------------
        //- LocationChart CHART -
        //-------------
        // Get context with jQuery - using jQuery's .get() method.
        var pieChartCanvas = $('#LocationChart').get(0).getContext('2d')
        var pieData = {
            labels: [
                'ห้องสมุด 40 ปี',
                'ห้องสมุด 60 ปี',
                'ห้องสมุด EP',
                'อื่นๆ',
            ],
            datasets: [{
                data: [[<?php echo number_format(getDataChartBookPlace40($conn), 0, '.', '') ;?>], 
                [<?php echo number_format(getDataChartBookPlace60($conn), 0, '.', '') ;?>], 
                [<?php echo number_format(getDataChartBookPlaceEP($conn), 0, '.', '') ;?>],
                [<?php echo number_format(getDataChartBookPlaceOther($conn), 0, '.', '') ;?>]],
                backgroundColor: ['#f56954', '#00a65a', '#f39c12', '#17a2b8'],
            }]
        }
        var pieOptions = {
            legend: {
                display: false
            }
        }
        //Create pie or douhnut chart
        // You can switch between pie and douhnut using the method below.
        var pieChart = new Chart(pieChartCanvas, {
            type: 'doughnut',
            data: pieData,
            options: {
                elements: {
                    center: {
                        text: [<?php echo number_format(getDataNumberBook($conn)) ;?>] //set as you wish
                    }   
                },
                cutoutPercentage: 50,
                legend: {
                    display: false
                }
            }
        })

        //-----------------
        //- END LocationChart -
        //-----------------
        //-------------
        //- BookDiv CHART -
        //-------------
        // Get context with jQuery - using jQuery's .get() method.
        var pieChartCanvas = $('#BookDivChart').get(0).getContext('2d')
        var pieData = {
            labels: [
                'ความรู้ทั่วไป',
                'ปรัชญาและจิตวิทยา',
                'ศาสนา',
                'สังคมศึกษา',
                'ภาษาศาสตร์',
                'วิทยาศาสตร์',
                'วิทยาศาสตร์ประยุกต์',
                'ศิลปกรรม',
                'วรรณคดี',
                'ประวัติศาสตร์',
            ],
            datasets: [{
                data: [[<?php echo number_format(getDataChartDiv0($conn), 0, '.', '') ;?>],
                [<?php echo number_format(getDataChartDiv1($conn), 0, '.', '') ;?>], 
                [<?php echo number_format(getDataChartDiv2($conn), 0, '.', '') ;?>], 
                [<?php echo number_format(getDataChartDiv3($conn), 0, '.', '') ;?>], 
                [<?php echo number_format(getDataChartDiv4($conn), 0, '.', '') ;?>], 
                [<?php echo number_format(getDataChartDiv5($conn), 0, '.', '') ;?>], 
                [<?php echo number_format(getDataChartDiv6($conn), 0, '.', '') ;?>], 
                [<?php echo number_format(getDataChartDiv7($conn), 0, '.', '') ;?>], 
                [<?php echo number_format(getDataChartDiv8($conn), 0, '.', '') ;?>], 
                [<?php echo number_format(getDataChartDiv9($conn), 0, '.', '') ;?>]],
                backgroundColor: ['#6610f2', '#001f3f', '#6f42c1','#f012be', '#e83e8c', '#d81b60','#fd7e14', '#01ff70', '#20c997','#3d9970'],
            }]
        }
        var pieOptions = {
            legend: {
                display: false
            }
        }
        //Create pie or douhnut chart
        // You can switch between pie and douhnut using the method below.
        var pieChart = new Chart(pieChartCanvas, {
            type: 'doughnut',
            data: pieData,
            options: {
                elements: {
                    center: {
                        text: [<?php echo number_format(getDataNumberBook($conn)) ;?>] //set as you wish
                    }
                },
                cutoutPercentage: 50,
                legend: {
                    display: false
                }
            }
        })

        //-----------------
        //- END BookDiv CHART -
        //-----------------
        //-------------
        //- Member CHART -
        //-------------
        // Get context with jQuery - using jQuery's .get() method.
        var pieChartCanvas = $('#MemberChart').get(0).getContext('2d')
        var pieData = {
            labels: [
                'นักเรียน',
                'ครู',
                'บุคลากร',
            ],
            datasets: [{
                data: [[<?php echo number_format(getDataChartUserStudent($conn), 0, '.', '') ;?>], [<?php echo number_format(getDataChartUserTeacher($conn), 0, '.', '') ;?>], [<?php echo number_format(getDataChartUserOtherPerson($conn), 0, '.', '') ;?>]],
                backgroundColor: ['#f56954', '#00a65a', '#f39c12'],
            }]
        }
        var pieOptions = {
            legend: {
                display: false
            }
        }
        //Create pie or douhnut chart
        // You can switch between pie and douhnut using the method below.
        var pieChart = new Chart(pieChartCanvas, {
            type: 'doughnut',
            data: pieData,
            options: {
                elements: {
                    center: {
                        text: [<?php echo number_format(getDataNumberUser($conn)) ;?>] //set as you wish
                    }
                },
                cutoutPercentage: 50,
                legend: {
                    display: false
                }
            }
        })

        //-----------------
        //- END Member CHART -
        //-----------------
        //-------------
        //- Book CHART -
        //-------------
        // Get context with jQuery - using jQuery's .get() method.
        var pieChartCanvas = $('#BookChart').get(0).getContext('2d')
        var pieData = {
            labels: [
                'ถูกระงับการใช้งาน',
                'สามารถใช้งานได้',
            ],
            datasets: [{
                data: [[<?php echo number_format(getDataChartMemberStatusAbnormal($conn), 0, '.', '') ;?>], [<?php echo number_format(getDataChartMemberStatusNormal($conn), 0, '.', '') ;?>]],
                backgroundColor: ['#f56954', '#00a65a'],
            }]
        }

        var pieOptions = {
            legend: {
                display: false
            }
        }
        //Create pie or douhnut chart
        // You can switch between pie and douhnut using the method below.
        var pieChart = new Chart(pieChartCanvas, {
            type: 'doughnut',
            data: pieData,
            options: {
                elements: {
                    center: {
                        text: [<?php echo number_format(getDataNumberUser($conn)) ;?>] //set as you wish
                    }
                },
                cutoutPercentage: 50,
                legend: {
                    display: false
                }
            }
        })
        Chart.pluginService.register({
            beforeDraw: function(chart) {
                var width = chart.chart.width,
                    height = chart.chart.height,
                    ctx = chart.chart.ctx;
                ctx.restore();
                var fontSize = (height / 114).toFixed(2);
                ctx.font = fontSize + "em prompt";
                ctx.textBaseline = "middle";
                var text = chart.config.options.elements.center.text,
                    textX = Math.round((width - ctx.measureText(text).width) / 2),
                    textY = height / 2;
                ctx.fillText(text, textX, textY);
                ctx.save();
            }
        });
        //-----------------
        //- END Book CHART -
        //-----------------
    })
    </script>
</body>

</html>