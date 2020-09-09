<!DOCTYPE html>
<html>

<head>
    <title>CPW.LAS: Book Storage</title>
    <?php
  include('dist/php/link_main_taghead.php');
  ?>
    <link rel="stylesheet" href="plugins/bootstrap-select/dist/css/bootstrap-select.min.css">
</head>

<body class="hold-transition sidebar-mini layout-fixed scrollbarB">
    <div class="wrapper">
        <?php
include('dist/php/connect_db.php');
include('dist/php/function_get_UserData.php');
include('dist/php/function_get_BookData.php');
include('dist/php/link_main_body.php');
  ?>
        <script>
        var element = document.getElementById("book_library");
        element.classList.add("active");
        </script>

        <!-- Content Wrapper. Contains page content -->
        <div class="content-wrapper">
            <!-- Content Header (Page header) -->
            <div class="content-header">
                <div class="container-fluid">
                    <div class="row mb-2">
                        <div class="col-sm-6">
                            <h1 class="m-0 text-dark">Book Management</h1>
                        </div><!-- /.col -->
                        <div class="col-sm-6">
                            <ol class="breadcrumb float-sm-right">
                                <li class="breadcrumb-item"><a href="index.php"><i class="fas fa-folder-open"></i>
                                        Home</a></li>
                                <li class="breadcrumb-item active"><i class="fas fa-box"></i> Library Book</li>
                            </ol>
                        </div><!-- /.col -->
                    </div><!-- /.row -->
                </div><!-- /.container-fluid -->
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
                                        <span style="font-size:20px; ">Live Finding Book System </span>
                                        <button type="button" id="addNBook" class="btn btn-default text-right">
                                            Insert
                                        </button>
                                    </div>
                                    <div class=" text-right"></div>
                                    <div class="col-12 " style="padding:10px; ">
                                        <div class="input-group mb-3">
                                            <div class="input-group-prepend form-group">

                                            </div>
                                            <input type="text" name="search_box" id="search_box" class="form-control"
                                                placeholder="ค้นหา" value="<?php echo $_GET['search']?>">
                                            <div class="input-group-append  form-group">
                                                <button type="button" onclick="searchSolid()" class="btn btn-danger"><i
                                                        class="fas fa-search"></i></button>

                                            </div>
                                        </div>


                                        <div class="center-block row">
                                            <div class="col-md-2 col-sm-6 "
                                                style=" margin-top:10px; margin-bottom:10px; ">
                                                <span>ค้นจาก : <select
                                                        class="selectpicker selectpicker-new form-control"
                                                        data-n-box="true" id="searchby" data-header="ค้นด้วย..."
                                                        multiple data-selected-text-format="count" name="searchby"
                                                        multiple="multiple" title="ค้นจากทั้งหมด">
                                                        <option value="1">ชื่อหนังสือ</option>
                                                        <!-- <option value="2">ชื่อผู้แต่งหรือผู้แปล</option> -->
                                                        <option value="3">รหัสหนังสือสากล</option>
                                                        <option value="4">เลขทะเบียนหนังสือ</option>
                                                        <option value="5">เรื่องย่อ</option>
                                                    </select>
                                                </span>
                                            </div>
                                            <div class="col-md-2 col-sm-6 "
                                                style=" margin-top:10px; margin-bottom:10px; ">
                                                <span>หมวดหมู่หนังสือ : <select
                                                        class="selectpicker w-100 selectpicker-new  "
                                                        style="max-height:100px" data-actions-box="true" id="searchbymo"
                                                        name="searchbymo" multiple="multiple" title="ค้นจากทั้งหมด">
                                                        <?php  echo getClassification100($conn); ?>
                                                    </select>
                                                </span>
                                            </div>
                                            <div class="col-md-2 col-sm-6 "
                                                style=" margin-top:10px; margin-bottom:10px; ">
                                                <span>สถานที่เก็บ :<select class="selectpicker selectpicker-new w-100"
                                                        data-actions-box="true" id="searchbyplace" name="searchbyplace"
                                                        multiple="multiple" title="ค้นจากทั้งหมด">
                                                        <option value="1">ห้องสมุด 60ปี</option>
                                                        <option value="2">ห้องสมุด 40ปี</option>
                                                        <option value="3">ห้องสมุด EP</option>
                                                    </select>
                                                </span>
                                            </div>

                                            <div class="col-md-2 col-sm-6 "
                                                style=" margin-top:10px; margin-bottom:10px; ">
                                                <span>สถานะ :<select class="selectpicker selectpicker-new w-100"
                                                        data-actions-box="true" disabled id="searchbybooking"
                                                        name="searchbybooking" multiple="multiple"
                                                        title="ค้นจากทั้งหมด">
                                                        <option value="1">จอง</option>
                                                        <option value="2">ยืม</option>
                                                        <option value="0">ว่าง</option>
                                                    </select>
                                                </span>
                                            </div>
                                            <div class="col-md-2 col-sm-6"
                                                style=" margin-top:10px; margin-bottom:10px; ">
                                                <span>การเรียงลำดับ: <select class="selectpicker w-100 selectpicker-new"
                                                        id="sortby" name="sortby" title="">

                                                        <option value="1">เรียงจากหนังสือล่าสุดก่อน</option>
                                                        <option value="2">เรียงจากหนังสือแรกสุดก่อน</option>
                                                        <option value="3">เรียงจากID แรก</option>
                                                        <option value="4">เรียงจากID ท้าย</option>
                                                    </select>
                                                </span>
                                            </div>
                                            <div class="col-md-2  col-sm-6"
                                                style=" margin-top:10px; margin-bottom:10px; ">
                                                <span>แสดงครั้งละ:<select class="selectpicker w-100 selectpicker-new"
                                                        id="showby" name="showby" title="">
                                                        <option value="10">10</option>
                                                        <option value="25">25</option>
                                                        <option value="50">50</option>
                                                        <option value="100">100</option>
                                                        <option value="250">250</option>
                                                        <option value="500">500</option>
                                                        <!-- <option value="2000">2000</option>
                                                        <option value="5000">5000</option> -->
                                                        <!-- <option value="0">ทั้งหมด</option> -->
                                                    </select>

                                                </span>
                                            </div>
                                        </div>
                                    </div>


                                    <!-- <span id="book-p" class="text-break" name="book-p" style="font-size:10px!important;"> </span> -->
                                    <!-- <span id="book" class="text-break" name="book " style="font-size:10px!important;"> -->
                                    </span>


                                </div>

                            </div>
                            <!-- /.box -->
                        </div>
                        <!-- <section class="col-12 row"> -->
                        <!-- <div class="col-12 row"> -->

                        <div id="sear_overry" class="col-12 d-none">
                            <div class="card card-default " style="height:160px">
                                <div class=" card-body text-center bg-secondary">

                                </div>
                                <div class="overlay light">
                                    <i class="fas fa-5x fa-sync-alt fa-spin"></i>
                                </div>
                            </div>
                        </div>

                        <!-- /.box -->

                        <div class="justify-content-center col-12">
                            <!-- <div class="card">
                                <div class="table-responsive card-body p-0 ">
                                    <table class="table table-hover text-nowrap m-0 ">
                                        <thead class="text-center ">
                                            <tr>
                                                <th class="">ทะเบียน</th>
                                                <th class="">สถานะ</th>
                                                <th class="">หนังสือ</th>
                                                <th class="">หมวดหนังสือ</th>
                                                <th class="">แก้ไข</th>
                                            </tr>
                                        </thead>
                                        <tbody id="book" name="book">


                                        </tbody>
                                    </table>
                                </div> -->
                            <!-- <div class="card"> -->
                            <!-- <div id="58" class="table-responsive card-body p-0 "> -->
                            <div id="book" name="book" class="">

                            </div>
                            <!-- </div>
                            </div>
                        </div> -->



                            <div class="">
                            </div>
                            <!-- </section> --> 
                            <!-- <input type="hidden" hidden name="step_across2" id="step_across2"
                                                            class="form-control" value="0">
                            <input type="hidden" hidden name="step_across1" id="step_across1"
                                                            class="form-control" value="0"> -->
<input type="hidden" hidden name="access_pass" id="access_pass" class="form-control"
                                value="">
                            <input type="hidden" hidden name="filter_data" id="filter_data" class="form-control"
                                value="">
                            <input type="hidden" hidden name="next_on" id="next_on" class="form-control" value="">
                            <input type="hidden" hidden name="page_data" id="page_data" class="form-control" value="<?php if (isset($_GET['page'])) {
      echo $_GET['page'];
  } else {
      echo '1';
  }?>">

                        </div>
                        <!-- /.row (main row) -->

                        <!-- /.container-fluid -->
            </section>

            <!-- /.content -->
            <!-- <div class=" overlay-wrapper ">
                 <div class="overlay dark">
          <i class="fas fa-10x fa-sync-alt fa-spin"></i>
            </div>
            </div> -->
        </div>


        <!-- /.content-wrapper -->
        <?php include('dist/php/main_footer.php') ?>

    </div>
    <!-- ./wrapper -->
    <?php include('dist/php/link_main_function_js.php') ;?>
    <script src="dist/js/function_api_getBook_info.js"></script>
    <script src="dist/js/function_book_data.js"></script>
    <script src="dist/js/function_page_book.js"></script>
    <script>
    
    </script>
</body>

</html>