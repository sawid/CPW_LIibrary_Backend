<!DOCTYPE html>
<html>

<head>
    <title>CPW.LAS: Member MS</title>
    <?php
  include('dist/php/link_main_taghead.php');
  ?>
</head>

<body class="hold-transition sidebar-mini layout-fixed scrollbarB">
    <div class="wrapper">
        <?php
include('dist/php/connect_db.php');
include('dist/php/function_get_UserData.php');
include('dist/php/link_main_body.php');
  ?>
        <script>
        var element = document.getElementById("member_library");
        element.classList.add("active");
        // document.getElementById("member_search").setAttribute("href", "#");;
        // document.getElementById("member_search").classList.add('active');
        // document.getElementById("ml_h").classList.add('menu-open');
        </script>

        <!-- Content Wrapper. Contains page content -->
        <div class="content-wrapper">
            <!-- Content Header (Page header) -->
            <div class="content-header">
                <div class="container-fluid">
                    <div class="row mb-2">
                        <div class="col-sm-6">
                            <h1 class="m-0 text-dark">Member Management</h1>
                        </div>
                        <div class="col-sm-6">
                            <ol class="breadcrumb float-sm-right">
                                <li class="breadcrumb-item"><a href="index.php"><i class="fas fa-folder-open"></i>
                                        Home</a></li>
                                <li class="breadcrumb-item active"><i class="fas fa-users"></i> Member Library</li>
                            </ol>
                        </div>
                    </div>
                </div>
            </div>
            <!-- /.content-header -->

            <!-- Main content -->
            <section class="content">
                <div class="container-fluid">

                    <!-- Main row -->
                    <div class="row">
                        <!-- /.col (left) -->
                        <div class="col-12">
                            <div class="card card-default">
                                <div class=" card-body text-center">
                                    <div class="text-left">
                                        <span style="font-size:20px; ">Live Finding Member System </span>
                                        <button type="button" class="btn btn-default text-right" data-toggle="modal"
                                            data-target="#add_user">
                                            เพิ่มสมาชิก
                                        </button>
                                    </div>
                                    <div class=" text-right"></div>
                                    <div class="col-12 " style="padding:10px; ">
                                        <div class="input-group mb-3">
                                            <div class="input-group-prepend">
                                                <span class="input-group-text">
                                                    ค้นหา</span>
                                            </div>
                                            <input type="text" name="search_box" id="search_box" class="form-control"
                                                placeholder="ค้นหา" value="<?php echo $_GET['search']?>">
                                            <div class="input-group-append">
                                                <button type="button" onclick="searchSolid()" class="btn btn-danger"><i
                                                        class="fas fa-search"></i></button>

                                            </div>
                                        </div>


                                        <div class="center-block row">
                                            <div class="col-lg-3 col-md-6 col-sm-12 "
                                                style=" margin-top:10px; margin-bottom:10px; ">
                                                <span>ค้นหาสมาชิกด้วย: <select class="selectpicker selectpicker-new"
                                                        data-actions-box="true" id="searchby" name="searchby"
                                                        multiple="multiple" title="ค้นจากทั้งหมด">
                                                        <option value="1">ชื่อผู้ใช้</option>
                                                        <option value="2">สกุลผู้ใช้</option>
                                                        <option value="3">เลขประจำตัว</option>
                                                        <option value="4">เบอร์โทรศัพท์</option>
                                                        <!-- <option value="5"></option> -->
                                                    </select>
                                                </span>
                                            </div>
                                            <div class="col-lg-3 col-md-6 col-sm-12 "
                                                style=" margin-top:10px; margin-bottom:10px; ">
                                                <span>สถานะภาพ: <select class="selectpicker selectpicker-new"
                                                        data-actions-box="true" id="searchbyty" name="searchbyty"
                                                        multiple="multiple" title="ค้นจากทั้งหมด">
                                                        <option value="2">ครู</option>
                                                        <option value="1">นักเรียน</option>
                                                        <!-- <option value="3">บุคคลทั่วไป</option> -->
                                                        <option value="4">บัญชีสามารถใช้งานได้</option>
                                                        <option value="5">บัญชีสามารถไม่ใช้งานได้</option>
                                                        <option value="6">เพศชาย</option>
                                                        <option value="7">เพศหญิง</option>
                                                    </select>
                                                </span>
                                            </div>
                                            <div class="col-lg-3 col-md-6 col-sm-12 "
                                                style=" margin-top:10px; margin-bottom:10px; ">
                                                <span>การเรียงลำดับ: <select class="selectpicker selectpicker-redo"
                                                        id="sortby" name="sortby" title="">

                                                        <option class="text-truncate" value="2">
                                                            จากสมาชิกใหม่ไปสมาชิกเก่า</option>
                                                        <option class="text-truncate" value="1">
                                                            จากสมาชิกเก่าไปสมาชิกใหม่</option>
                                                        <option class="text-truncate" value="3">จากเลขประจำตัวน้อยไปมาก
                                                        </option>
                                                        <option class="text-truncate" value="4">จากเลขประจำตัวมากไปน้อย
                                                        </option>
                                                    </select>
                                                </span>
                                            </div>
                                            <div class="col-lg-3 col-md-6 col-sm-12 "
                                                style=" margin-top:10px; margin-bottom:10px; ">
                                                <span>แสดงสมาชิกหน้าละ:<select class="selectpicker selectpicker-redo"
                                                        id="showby" name="showby" title="">

                                                        <option value="12">12</option>
                                                        <option value="36">36</option>
                                                        <option value="48">48</option>
                                                        <option value="0">ทั้งหมด</option>
                                                    </select>

                                                </span>
                                            </div>
                                        </div>
                                    </div>


                                    <!-- <span id="member-p" name="member-p" style="font-size:10px!important;"> </span> -->

                                </div>
                            </div>
                            <!-- /.box -->
                        </div>
                        <!-- <section class="col-12 row"> -->
                        <!-- <div class="col-12 row"> -->
                        <div class="justify-content-center col-12">
                            <div id="member" name="member" class="justify-content-center row">
                            </div>
                        </div>



                        <div class="col-12">
                            <div class="justify-content-center">
                                <div id="pagination" name="pagination" >
                                </div>
                                <div class="">
                                </div>
                                <!-- </section> -->
                                <input type="hidden" hidden name="filter_data" id="filter_data" class="form-control"
                                    value="">
                                <input type="hidden" hidden name="page_data" id="page_data" class="form-control"
                                    value="">
                                <input type="hidden" hidden name="page_start" id="page_start" class="form-control"
                                    value="">

                            </div>
                        </div>
                        <!-- /.row (main row) -->

                        <!-- /.container-fluid -->
            </section>
            <!-- /.content -->
        </div>
        <!-- /.content-wrapper -->
        <?php include('dist/php/main_footer.php') ?>

        <div class="modal fade show" id="add_user">
            <div class="modal-dialog">
                <div class="modal-content">
                    <div class="modal-header">
                        <h4 class="modal-title">เพิ่มสมาชิกผ่านรหัสประจำตัว</h4>
                        <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                            <span aria-hidden="true">×</span>
                        </button>
                    </div>
                    <div class="modal-body row">
                        <div class="col-md-4 text-center" style="margin-bottom:10px;">
                            <img src="dist/img/user.png" id="imagePro" class=" img-thumbnail" alt=""
                                style="width:150px;height:150px;object-fit:cover;object-position: top;">
                        </div>
                        <div class="col-md-8 row" style="margin-bottom:10px;">
                            <div class="form-group col-md-6">
                                <label for="exampleInputEmail1">ประเภทของผู้ใช้</label>
                                <select name="user_class" onchange="searchUser()" id="user_class" class="form-control">
                                    <option value='1'>นักเรียน</option>
                                    <option value='2'>คุณครู</option>
                                </select>

                            </div>
                            <div class="form-group col-md-6">
                                <label for="user_code">รหัสประจำตัว</label>
                                <input name="user_code" type="number" class="form-control" onkeyup="searchUser()"
                                    id="user_code" placeholder="00000">
                            </div>
                            <div class="form-group col-md-12">
                                <label for="exampleInputEmail1">ชื่อและนามสกุลผู้ใช้</label>
                                <input name="" type="text" class="form-control" id="user_name" placeholder="ชื่อผู้ใช้"
                                    disabled>
                            </div>
                        </div>
                    </div>
                    <div class="modal-footer justify-content-between">
                        <button type="button" class="btn btn-default" id="end" data-dismiss="modal">ยกเลิก</button>
                        <span id="member-a" name="member-a"></span>
                        <input type="hidden" name="ref_id" id="ref_id">
                        <input type="hidden" name="user_card_id" id="user_card_id">
                        <button type="button" onclick="saveUser()" class="btn btn-primary">เพิ่มสมาชิก</button>
                    </div>
                </div>
                <!-- /.modal-content -->
            </div>
            <!-- /.modal-dialog -->
        </div>

    </div>
    <!-- ./wrapper -->
    <?php include('dist/php/link_main_function_js.php') ;?>
    <script src="dist/js/function_member_data.js"></script>
    <script src="dist/js/function_page_member.js"></script>
</body>

</html>