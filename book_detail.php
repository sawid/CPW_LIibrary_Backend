<!DOCTYPE html>
<html>

<head>

    <?php
    include 'dist/php/connect_db.php';
    include 'dist/php/function_get_UserData.php';
    include 'dist/php/function_get_BookData.php';
    include 'dist/php/function_get_statistic.php';
    include 'dist/php/link_main_taghead.php';
    $book_id = $_GET['ref'];
    if (isset($book_id)) {
        if (!checkedBook($conn, $book_id)) {
            echo '<script> location.assign("book.php"); </script>';
        }
    } else {
        echo '<script> location.assign("book.php"); </script>';
    }
        $detail = getDataBook_DetailBook($conn, $book_id);
        $sta = getSatusBook($conn, $book_id);

  ?>
    <link rel="stylesheet" href="plugins/bootstrap-select/dist/css/bootstrap-select.min.css">
    <title>CPW.LAS: <?php echo $detail['book_name']; ?></title>
</head>
<script>
var book_id_this_page_exs = <?php echo $book_id; ?> ;
var book_acsn_this_page_exs = <?php echo $detail['book_accession_no']; ?> ;
</script>

<body class="hold-transition sidebar-mini layout-fixed scrollbarB">
    <div class="wrapper">
        <?php

include 'dist/php/link_main_body.php';
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
                            <h1 class="m-0 text-dark text-break text-truncate w-100"><?php echo $detail['book_name']; ?>
                            </h1>
                        </div><!-- /.col -->
                        <div class="col-sm-6">
                            <ol class="breadcrumb float-sm-right">
                                <li class="breadcrumb-item"><a href="book.php"><i class="fas fa-box"> </i>
                                        Library Book</a></li>
                                <li class="breadcrumb-item active"><i class="fas fa-book"> </i>
                                    no.<?php echo  $detail['book_accession_no']; ?></li>
                            </ol>
                        </div><!-- /.col -->
                    </div><!-- /.row -->
                </div><!-- /.container-fluid -->
            </div>
            <!-- /.content-header -->
            <!-- Main content -->
            <!-- Main content -->
            <section class="content">
                <div class="container-fluid">
                    <div class="row">
                        <div class="col-lg-3 col-md-3 col-sm-12">
                            <?php echo getBooklocationName($detail['book_location'])[3]; ?>
                            <div class="card">
                                <div class="card-header <?php if ($sta[2] == 1) {
      echo 'bg-warning';
  } elseif ($sta[2] == 2) {
      echo 'bg-danger';
  } elseif ($sta[2] == 3) {
      echo 'bg-success';
  }?>"><span> <i class="far fa-clock"></i> สถานะหนังสือ "</span>
                                    <?php echo  $sta[1]; ?><span>"</span>
                                </div>
                            </div>

                            <div class="card ">
                                <img id="book_i" class="card-img-top rounded img-responsive center-block" src="<?php if (isset($detail['book_picture'])) {
      echo 'https://app.cpw.ac.th/library_content/images/book/'.$detail['book_picture'];
  } else {
      echo 'dist/img/notAvailableCover.png';
  }?>" alt="">
                                <!-- <div class="card-img-overlay ">
                                    <div class="d-flex flex-column ">
                                        <div class="">
                                            <h4 class="card-title float-right p-1 bg-white rounded-pill ">
                                                <?php //echo $sta[0] . $sta[1];?>
                                            </h4>
                                        </div>
               
                                    </div>
                                </div> -->

                            </div>
                            <div class="card showBtn d-none">
                                <div class="card-header">
                                    <label> เพิ่มรูปหนังสือ </label>

                                    <div class="input-group">
                                        <div class="custom-file">
                                            <input class="text-truncate text-break" id="file"
                                                onchange="$('#info').html($(this).val().split(/[\\|/]/).pop());readURL(this); "
                                                type="file" accept="image/gif, image/jpeg, image/png"
                                                class="custom-file-input">
                                            <label class="custom-file-label text-break text-truncate w-100" id="info"
                                                for="file">Choose file</label>
                                        </div>

                                    </div>
                                </div>
                            </div>
                            <button type="button" class="btn btn-danger btn-block mb-3" id="deleteBuntton">
                                <i class="fas fa-trash-alt"></i>
                                ลบข้อมูล</button>
                            <div class="card ">
                                <div class="card-header  bg-primary">
                                    <h4 class="card-title">
                                        QR CODE This BOOK </h4>
                                </div>
                                <div class="card-body">

                                </div>
                            </div>
                        </div>
                        <!-- /.col -->
                        <div class="col-lg-9 col-md-9">
                            <div class="card">
                                <div class="card-header p-2">
                                    <ul class="nav nav-pills">
                                        <li class="nav-item"><a class="nav-link active" href="#detailBooktab"
                                                data-toggle="tab">ทั่วไป</a></li>
                                        <li class="nav-item"><a class="nav-link" href="#ratingBooktab"
                                                data-toggle="tab">ความรู้สึก</a></li>
                                        <li class="nav-item"><a class="nav-link" href="#listBooktab"
                                                data-toggle="tab">ยืมคืน</a></li>
                                    </ul>
                                </div><!-- /.card-header -->
                                <div class="card-body" id >
                                    <div class="tab-content">
                                        <div class="active tab-pane row" id="detailBooktab">
                                            <div class="card  bg-primary">
                                                <div class="card-header">
                                                    <h4 class="card-title">
                                                        เนื้อหาหนังสือ </h4>
                                                </div>
                                            </div>
                                            <div class="col-12">
                                                <div class="row " style="">
                                                    <div class="form-group col-12">
                                                        <label for="book_name">ชื่อหนังสือ</label>
                                                        <input type="text" disabled class="form-control inputDis"
                                                            id="book_name" value="<?php echo $detail['book_name']; ?> ">
                                                    </div>

                                                    <div class="form-group col-6">
                                                        <label for="book_content_1">หัวข้อที่ 1</label>
                                                        <input type="text" disabled
                                                            class="form-control text-uppercase inputDis"
                                                            id="book_content_1"
                                                            value="<?php echo trim($detail['book_content_1']); ?>">
                                                    </div>

                                                    <div class="form-group col-6">
                                                        <label for="book_content_2">หัวข้อที่ 2</label>
                                                        <input type="text" disabled
                                                            class="form-control text-uppercase inputDis"
                                                            id="book_content_2"
                                                            value="<?php echo  $detail['book_content_2']; ?>">
                                                    </div>

                                                    <div class="form-group col-12 ">
                                                        <label for="book_dep">เนื้อหาหนังสือโดยสังเขป</label>
                                                        <textarea name="book_dep" disabled class="form-control inputDis"
                                                            rows="2"
                                                            placeholder="ใส่คำนำ บทนำ"><?php echo trim($detail['book_dep']); ?></textarea>
                                                    </div>
                                                    <div class="form-group col-12">
                                                        <label for="book_call_meaning">ประเภทหนังสือ</label>
                                                        <p>
                                                            <span
                                                                class="badge badge-info badge-pill"><?php echo $detail['book_call_meaning_x00']; ?></span>
                                                            <span
                                                                class="badge badge-info badge-pill"><?php echo $detail['book_call_meaning_x0']; ?></span>
                                                            <span
                                                                class="badge badge-info badge-pill"><?php echo $detail['book_call_meaning_x']; ?></span>
                                                        </p>
                                                    </div>
                                                </div>
                                            </div>
                                            <div class="card  bg-primary">
                                                <div class="card-header">
                                                    <h4 class="card-title">
                                                        รายละเอียดเฉพาะเล่ม </h4>
                                                </div>
                                            </div>
                                            <div class="col-12 ">
                                                <div class="row">
                                                    <div class="col-lg-9" style="">
                                                        <div class="row ">

                                                            <div class="form-group col-12 col-sm-12 col-md-6 col-lg-6">
                                                                <label for="book_isbn">เลขมาตราฐานสากล</label>
                                                                <input type="text" disabled
                                                                    class="form-control text-uppercase inputDis"
                                                                    id="book_isbn"
                                                                    value="<?php echo $detail['book_isbn']; ?>">
                                                            </div>
                                                            <div class="form-group col-12 col-sm-12 col-md-6 col-lg-6">
                                                                <label>สถานที่เก็บ</label>
                                                                <select name="book_location" disabled
                                                                    class="form-control  inputDis">
                                                                    <?php if ($detail['book_location'] == 1) {
      $d = 'selected';
  } elseif ($detail['book_location'] == 2) {
      $e = 'selected';
  } elseif ($detail['book_location'] == 3) {
      $f = 'selected';
  } else {
      $else_l = 'selected';
  }?>
                                                                    <option value="" <?php echo $else_l; ?>>-โปรดเลือก-
                                                                    </option>
                                                                    <option value="1" <?php echo $d; ?>>ห้องสมุดอาคาร
                                                                        60ปี
                                                                    </option>
                                                                    <option value="2" <?php echo $e; ?>>ห้องสมุดอาคาร
                                                                        40ปี
                                                                    </option>
                                                                    <option value="3" <?php echo $f; ?>>ห้องสมุด EP
                                                                    </option>
                                                                </select>
                                                            </div>
                                                            <div class="form-group col-12 col-sm-12 col-md-6 col-lg-6">
                                                                <label
                                                                    for="book_call_classification_id">เลขหมู่หนังสือ</label>
                                                                <input type="text" disabled
                                                                    class="form-control text-uppercase inputDis"
                                                                    id="book_call_classification_id"
                                                                    value="<?php echo $detail['book_call_classification_id']; ?>">
                                                            </div>
                                                            <div class="form-group col-12 col-sm-12 col-md-6 col-lg-6">
                                                                <label for="book_call_author_number">เลขผู้แต่ง
                                                                    (ระบบอัตโมมัติ)</label>
                                                                <input type="text" disabled
                                                                    class="form-control text-uppercase inputDis-i"
                                                                    id="book_call_author_number"
                                                                    value="<?php  echo $detail['book_call_author_number']; ?>">
                                                            </div>
                                                            <div class="form-group col-6 col-sm-3 col-md-3 col-lg-3">
                                                                <label for="book_pages">จำนวนหน้า</label>
                                                                <div class="input-group">
                                                                    <input type="text" disabled
                                                                        class="form-control text-uppercase inputDis"
                                                                        id="book_pages"
                                                                        value="<?php echo  $detail['book_pages']; ?>">
                                                                    <div class="input-group-append">
                                                                        <span class="input-group-text">หน้า</span>
                                                                    </div>
                                                                </div>

                                                            </div>

                                                            <div class="form-group col-6 col-sm-3 col-md-3 col-lg-3">
                                                                <label for="book_price">ราคา</label>
                                                                <div class="input-group">
                                                                    <input type="text" disabled
                                                                        class="form-control text-uppercase inputDis"
                                                                        id="book_price"
                                                                        value="<?php echo  $detail['book_price']; ?>">
                                                                    <div class="input-group-append">
                                                                        <span class="input-group-text">บาท</span>
                                                                    </div>
                                                                </div>


                                                            </div>
                                                            <div class="form-group col-6 col-sm-3 col-md-3 col-lg-3">
                                                                <?php if ($detail['book_source'] == 1) {
      $a = 'selected';
  } elseif ($detail['book_source'] == 2) {
      $b = 'selected';
  } elseif ($detail['book_source'] == 3) {
      $c = 'selected';
  } else {
      $else_s = 'selected';
  }?>
                                                                <label for="book_source">แหล่งที่มา</label>
                                                                <select name="book_source" disabled
                                                                    class="form-control inputDis">
                                                                    <option value="" <?php echo $else_s; ?>>-เลือก-
                                                                    </option>
                                                                    <option value="1" <?php echo $a; ?>>ซื้อ</option>
                                                                    <option value="2" <?php echo $b; ?>>บริจาค</option>
                                                                    <option value="3" <?php echo $c; ?>>ไม่ทราบ</option>
                                                                </select>
                                                            </div>
                                                            <div class="form-group col-6 col-sm-3 col-md-3 col-lg-3">
                                                                <?php if ($detail['book_content_color'] == 1) {
      $bw = 'selected';
  } elseif ($detail['book_content_color'] == 2) {
      $cl = 'selected';
  } else {
      $else_c = 'selected';
  }?>
                                                                <label for="book_content_color">เนื้อในพิมพ์</label>
                                                                <select name="book_content_color" disabled
                                                                    class="form-control inputDis">
                                                                    <option value="" <?php echo  $c; ?>>
                                                                        -เลือก-</option>
                                                                    <option value="1" <?php echo  $a; ?>>
                                                                        ขาว-ดำ</option>
                                                                    <option value="2" <?php echo  $b; ?>>
                                                                        สี</option>
                                                                </select>
                                                            </div>
                                                            <div class="form-group col-6 col-sm-3 col-md-3 col-lg-3">
                                                                <label for="book_public_year">ปีที่พิมพ์</label>
                                                                <input type="text" disabled
                                                                    class="form-control inputDis" id="book_public_year"
                                                                    value="<?php echo $detail['book_public_year']; ?> ">
                                                            </div>

                                                            <div class="form-group col-6 col-sm-3 col-md-3 col-lg-3">
                                                                <label for="book_public_copy">ครั้งที่พิมพ์</label>
                                                                <input type="text" disabled
                                                                    class="form-control text-uppercase inputDis"
                                                                    id="book_public_copy"
                                                                    value="<?php echo  $detail['book_public_copy']; ?>">
                                                            </div>
                                                            <div class="form-group col-6 col-sm-3 col-md-3 col-lg-3">
                                                                <label for="book_public_series">ลำดับเล่มที่</label>
                                                                <input type="text" disabled
                                                                    class="form-control inputDis"
                                                                    id="book_public_series"
                                                                    value="<?php echo trim($detail['book_public_series']); ?> ">
                                                            </div>

                                                            <div class="form-group col-6 col-sm-3 col-md-3 col-lg-3">
                                                                <label for="">ฉบับซ้ำที่</label>
                                                                <input type="text" disabled
                                                                    class="form-control text-uppercase inputDis" id=""
                                                                    value="<?php echo  $detail['x']; ?>">
                                                            </div>
                                                            <div class="form-group col-12 col-sm-6 col-md-6 col-lg-6">
                                                                <label for="publisher_name">จัดพิมพ์โดย</label>
                                                                <input type="text" disabled
                                                                    class="form-control inputDis" id="publisher_name"
                                                                    value="<?php echo getData_publisher($conn, trim($detail['publisher_id']))['publisher_name'];
 ?> ">
                                                            </div>

                                                            <div class="form-group col-12 col-sm-6 col-md-6 col-lg-6">
                                                                <label
                                                                    for="book_location_print">จังหวัดที่จัดพิมพ์</label>
                                                                <input type="text" disabled
                                                                    class="form-control text-uppercase inputDis"
                                                                    id="book_location_print"
                                                                    value="<?php echo  trim($detail['book_location_print']); ?>">
                                                            </div>
                                                        </div>
                                                    </div>
                                                    <div class="row col-12 col-lg-3  ml-lg-1 " style="">
                                                        <div class="col-12"> <label for="book_languge_id"><i
                                                                    class="fas fa-language"></i> ภาษาในหนังสือ</label>
                                                        </div>
                                                        <?php echo getCheckBok($conn, $book_id); ?>

                                                    </div>
                                                </div>
                                            </div>

                                            <div class="card bg-primary">
                                                <div class="card-header">
                                                    <h4 class="card-title">ผู้แต่ง/ผู้แปล</h4>
                                                </div>
                                            </div>
                                            <div class="col-12">
                                                <div class="row " style="">

                                                    <div class="form-group col-12 col-sm-12 col-md-6 col-lg-6">
                                                        <input type="hidden" name="numAlist" id="numAlist"
                                                            value="<?php $numAlist = getTextBoxWithAuthTran($conn, $book_id, 1, 2); echo $numAlist; ?>">
                                                        <label for="book_pages">ผู้แต่ง</label>
                                                        <div id="showBoxA">
                                                            <?php echo getTextBoxWithAuthTran($conn, $book_id, 1, 1); ?>
                                                        </div>
                                                        <div class="float-right mt-1 showBtn d-none">
                                                            <button type="button" id="addTextBoxA"
                                                                class="btn btn-block btn-secondary"><i
                                                                    class="fas fa-user-plus"></i> เพิ่มคน</button>
                                                        </div>

                                                    </div>
                                                    <div class="form-group col-12 col-sm-12 col-md-6 col-lg-6">
                                                        <input type="hidden" name="numTlist" id="numTlist"
                                                            value="<?php $numTlist = getTextBoxWithAuthTran($conn, $book_id, 2, 2); echo $numTlist; ?>">
                                                        <label for="book_pages">ผู้แปล</label>
                                                        <div id="showBoxT">
                                                            <?php echo getTextBoxWithAuthTran($conn, $book_id, 2, 1); ?>


                                                        </div>

                                                        <div class="float-right mt-1 showBtn d-none">
                                                            <button type="button" class="btn btn-block btn-secondary"
                                                                id="addTextBoxT"><i class="fas fa-user-plus"></i>
                                                                เพิ่มคน</button>
                                                        </div>

                                                    </div>

                                                </div>
                                            </div>


                                            <hr />
                                            <div class="float-right" id="divAE">
                                                <button type="button" class="btn btn-primary" id="editBookData"><i
                                                        class="fas fa-edit"></i> แก้ไขข้อมูล</button>

                                            </div>
                                            <div class="float-right btn-group d-none" id="divAF">
                                                <button type="button" class="btn btn-secondary" id="cancelAction"><i
                                                        class="fas fa-ban"></i> ยกเลิก</button>
                                                <button type="button" class="btn btn-success" id="saveNewData"><i
                                                        class="fas fa-check"></i> บันทึกข้อมูล</button>
                                            </div>


                                        </div>

                                        <!-- /.tab-pane -->
                                        <div class="tab-pane" id="ratingBooktab">
                                            <div class="row align-items-center">
                                                <div class="col-12 overlay-wrapper">
                                                    <div class="row" id="getVoteResult">
                                                        <div class="col-md-6 col-12  h-100">
                                                            <div class="card mb-0">
                                                                <div class="card-header text-center ">
                                                                    <p class="text-center">
                                                                        <strong>ผลแสดงความพึงพอใจ</strong>
                                                                    </p>
                                                                    <p id="getStarforPe" class="m-0"
                                                                        style="//font-size: 1vw;">
                                                                        <span class="fa-stack ">
                                                                            <i
                                                                                class="far  fa-star fa-stack-2x text-secondary"></i>

                                                                        </span>
                                                                        <span class="fa-stack ">
                                                                            <i
                                                                                class="far  fa-star fa-stack-2x text-secondary"></i>

                                                                        </span>
                                                                        <span class="fa-stack ">
                                                                            <i
                                                                                class="far  fa-star fa-stack-2x text-secondary"></i>

                                                                        </span>
                                                                        <span class="fa-stack ">
                                                                            <i
                                                                                class="far  fa-star fa-stack-2x text-secondary"></i>

                                                                        </span>
                                                                        <span class="fa-stack ">
                                                                            <i
                                                                                class="far  fa-star fa-stack-2x text-secondary"></i>

                                                                        </span></p>
                                                                </div>
                                                                <div class="card-body text-center pl-0 pr-0">
                                                                    <p id="getNumberPeople" class="">ยังไม่มีคนโหวต</p>
                                                                    <p id="getDateTimeUp" class="bg-secondary mb-0"
                                                                        style="font-size:10px!important;"><i
                                                                            class="far fa-clock"></i>
                                                                        ข้อมูลอัพเดทเมื่อ
                                                                        <?php echo date("d/m/Y เวลา H:i:s"); ?></p>

                                                                </div>

                                                            </div>
                                                        </div>
                                                        <div class="col-md-6 col-12 mb-0 d-md-block d-none">
                                                            <div id="getSatusBarforPe" style="font-size:0.98rem;">
                                                                <div class="progress-group">
                                                                    <i class="fas fa-grin-hearts"></i>
                                                                    รู้สึกชื่นชอบอย่างมาก
                                                                    (5 ดาว)
                                                                    <span class="float-right" id="label_star_5"><b>0</b>/0</span>
                                                                    <div class="progress progress-sm">
                                                                        <div class="progress-bar bg-success" id="bar_star_5"
                                                                            style="width: 100%">
                                                                        </div>
                                                                    </div>
                                                                </div>
                                                                <div class="progress-group">
                                                                    <i class="fas fa-grin"></i> รู้สึกชื่นชอบ (4 ดาว)
                                                                    <span class="float-right"  id="label_star_4"><b>0</b>/0</span>
                                                                    <div class="progress progress-sm">
                                                                        <div class="progress-bar bg-olive" id="bar_star_4"
                                                                            style="width: 100%">
                                                                        </div>
                                                                    </div>
                                                                </div>
                                                                <!-- /.progress-group -->

                                                                <div class="progress-group">
                                                                    <i class="fas fa-meh"></i> รู้สึกเฉย ๆ (3 ดาว)
                                                                    <span class="float-right"  id="label_star_3"><b>0</b>/0</span>
                                                                    <div class="progress progress-sm">
                                                                        <div class="progress-bar bg-teal" id="bar_star_3"
                                                                            style="width: 100%">
                                                                        </div>
                                                                    </div>
                                                                </div>

                                                                <!-- /.progress-group -->
                                                                <div class="progress-group">
                                                                    <span class="progress-text">
                                                                        <i class="fas fa-frown"></i> ไม่ค่อยโอเค (2
                                                                        ดาว)</span>
                                                                    <span class="float-right"  id="label_star_2"><b>0</b>/0</span>
                                                                    <div class="progress progress-sm">
                                                                        <div class="progress-bar bg-info" id="bar_star_2"
                                                                            style="width: 100%">
                                                                        </div>
                                                                    </div>
                                                                </div>

                                                                <!-- /.progress-group -->
                                                                <div class="progress-group">
                                                                    <i class="fas fa-meh-rolling-eyes"></i>
                                                                    ไม่ปลื้มอย่างมาก (1 ดาว)
                                                                    <span class="float-right" id="label_star_1"><b>0</b>/0</span>
                                                                    <div class="progress progress-sm">
                                                                        <div class="progress-bar bg-lightblue" id="bar_star_1"
                                                                            style="width: 100%">
                                                                        </div>
                                                                    </div>
                                                                </div>
                                                                <!-- /.progress-group -->
                                                            </div>
                                                        </div>
                                                    </div>
                                                    <div id="overlayT" class="overlay light d-none">
                                                        <i class="fas fa-3x fa-sync-alt fa-spin"></i>
                                                        <div class="text-bold pt-2">Loading...</div>
                                                    </div>
                                                </div>
                                                <div class="col-12 mt-3">
                                                    <div class="card ">
                                                        <div class="card-header text-center bg-primary">
                                                            <h4 class="card-title">
                                                                <span id="getNumCountComm"
                                                                    class='badge badge-light text-primary'><?php echo getDataNumberComment($conn, $book_id);?></span>
                                                                ความคิดเห็น 
                                                            </h4>
                                                        </div>

                                                    </div>
                                                    
                                                </div>
                                                <div class="form-group col-12 mb-3">
                                                    <!-- <img class="img-circle img-user-only mb-3"
                                                        src="<?php echo $dataPeople['image'];?>" style=""
                                                        alt="User Image"> -->
                                                    <span class="badge badge-secondary float-right mb-1">
                                                        <span
                                                            href="<?php echo $dataPeople['link'];?>"><?php echo ' '.$dataPeople['name']. ' ' .$dataPeople['lname'] .''; ?></span>
                                                    </span>
                                                    <textarea name="texts" id="texts" class="form-control" rows="3"
                                                        placeholder="แสดงความเห็น"
                                                        style="border-radius: 4px 4px 0px 0px;"></textarea>
                                                    <button type="button" style="border-radius: 0px 0px 4px 4px;"
                                                        id="btnSentCommect"
                                                        class="btn pull-right btn-block  btn-secondary">แสดงความเห็น</button>

                                                </div>
                                                <div class="col-12">
                                                    <hr />
                                                </div>
                                                <div id="getCmment" class="col-12">
                                                </div>
                                            </div>

                                        </div>
                                        <!-- /.tab-pane -->

                                        <div class="tab-pane" id="listBooktab">
                                             <!-- /.row -->
                                            <div class="row ">
                                                <div class="col-12 ">
                                                    <div class="card ">
                                                        <div class="card-header bg-primary">
                                                            <h3 class="card-title">รายการยืมคืน</h3>
                                                        </div>
                                                    </div>
                                                </div>
                                                <div class="col-12">


                                                <div class="btn-group btn-group-toggle mb-3" data-toggle="buttons">
                  <label class="btn btn-sm btn-outline-secondary">
                    <input type="radio" name="options" id="option1" checked autocomplete="off" value="" > ทั้งหมด
                  </label>
                  <label class="btn btn-sm btn-outline-primary">
                    <input type="radio" name="options" id="option5" autocomplete="off" value="1"> กำลังยืม
                  </label>
                  <label class="btn btn-sm btn-outline-warning">
                    <input type="radio" name="options" id="option2" autocomplete="off" value="2"> ขอจอง
                  </label>
                  <label class="btn btn-sm btn-outline-success">
                    <input type="radio" name="options" id="option4" autocomplete="off" value="3"> คืนแล้ว
                  </label>
                  <label class="btn btn-sm btn-outline-danger">
                    <input type="radio" name="options" id="option3" autocomplete="off" value="4"> ยกเลิก
                  </label>
                  
                </div>
                            
                                                                                        
                                  
                            </div>
                            <!-- /.box -->
              
                 <div class="col-12 ">
                                                    <!-- <div class="card">
                                                        
                                                        <div class="card-body table-responsive p-0 scrollbarF"
                                                            style="height: 355px;"> -->
                                                    <table id="datalist_table" style="margin:0px !important;"
                                                        class="table table-head-fixed text-nowrap">
                                                        <thead>
                                                            <tr class="">
                                                                <th>ลำดับ</th>
                                                                <th>ผู้ดำเนินการ</th>
                                                                <th>วันที่ยืม</th>
                                                                <th>วันที่คืน</th>
                                                                <th>สถานะ</th>

                                                            </tr>
                                                        </thead>
                                                        <tbody>
                                                            <tr>
                                                                <td>183</td>
                                                                <td></td>
                                                                <td>11-7-2014</td>
                                                                <td>
                                                                    11-7-2014
                                                                </td>
                                                                <td>FFf</td>
                                                            </tr><tr>
                                                                <td>183</td>
                                                                <td>John Doe</td>
                                                                <td>11-7-2014</td>
                                                                <td>
                                                                    11-7-2014
                                                                </td>
                                                                <td>FFf</td>
                                                            </tr><tr>
                                                                <td>183</td>
                                                                <td>John Doe</td>
                                                                <td>11-7-2014</td>
                                                                <td>
                                                                    11-7-2014
                                                                </td>
                                                                <td>FFf</td>
                                                            </tr><tr>
                                                                <td>183</td>
                                                                <td>John Doe</td>
                                                                <td>11-7-2014</td>
                                                                <td>
                                                                    11-7-2014
                                                                </td>
                                                                <td>FFf</td>
                                                            </tr><tr>
                                                                <td>183</td>
                                                                <td>John Doe</td>
                                                                <td>11-7-2014</td>
                                                                <td>
                                                                    11-7-2014
                                                                </td>
                                                                <td>FFf</td>
                                                            </tr><tr>
                                                                <td>183</td>
                                                                <td>John Doe</td>
                                                                <td>11-7-2014</td>
                                                                <td>
                                                                    11-7-2014
                                                                </td>
                                                                <td>FFf</td>
                                                            </tr><tr>
                                                                <td>183</td>
                                                                <td>John Doe</td>
                                                                <td>11-7-2014</td>
                                                                <td>
                                                                    11-7-2014
                                                                </td>
                                                                <td>FFf</td>
                                                            </tr><tr>
                                                                <td>183</td>
                                                                <td>John Doe</td>
                                                                <td>11-7-2014</td>
                                                                <td>
                                                                    11-7-2014
                                                                </td>
                                                                <td>FFf</td>
                                                            </tr><tr>
                                                                <td>183</td>
                                                                <td>John Doe</td>
                                                                <td>11-7-2014</td>
                                                                <td>
                                                                    11-7-2014
                                                                </td>
                                                                <td>FFf</td>
                                                            </tr><tr>
                                                                <td>183</td>
                                                                <td>John Doe</td>
                                                                <td>11-7-2014</td>
                                                                <td>
                                                                    11-7-2014
                                                                </td>
                                                                <td>FFf</td>
                                                            </tr>

                                                        </tbody>
                                                    </table>
                                                    <!-- </div> -->
                                                    <!-- /.card-body -->
                                                    <!-- </div> -->
                                                    <!-- /.card -->
                                                </div>
                                            </div>
                                            <!-- /.row -->

                                        </div>
                                        <!-- /.tab-pane -->
                                    </div>
                                    <!-- /.tab-content -->
                                </div><!-- /.card-body -->
                            </div>
                            <!-- /.nav-tabs-custom -->
                        </div>
                        <!-- /.col -->
                    </div>
                    <!-- /.row -->
                </div><!-- /.container-fluid -->
            </section>
            <!-- /.content -->
        </div>
        <!-- /.content-wrapper -->
        <?php include 'dist/php/main_footer.php'; ?>

    </div>
    <!-- ./wrapper -->

    <?php include 'dist/php/link_main_function_js.php'; ?>
    <script>
    function startAutoComplete(num, type) {
        var availableTags = [ <?php echo getDataAutherName_json($conn); ?> ];
        $(type + num).autocomplete({
            source: availableTags,
        });

    }
    var i;
    var numTlist_e = document.getElementById("numTlist").value;
    var numAlist_e = document.getElementById("numAlist").value;
    for (i = 1; i <= numAlist_e; i++) {
        // alert(numAlist);
        startAutoComplete(i, "#Author_name");
    }
    for (i = 1; i <= numTlist_e; i++) {
        startAutoComplete(i, "#Tran_name");
    }
    </script>
    <script src="dist/js/function_book_data.js"></script>
    <script src="dist/js/function_page_book_detail.js"></script>
</body>

</html>