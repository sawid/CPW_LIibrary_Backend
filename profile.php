<?php
  
    ?>

<!DOCTYPE html>
<html>

<head>
    <?php   include('dist/php/link_main_taghead.php');
            include('dist/php/connect_db.php');
            include('dist/php/function_get_UserData.php');
            $user_id_d = $_GET['ref'];
  if (isset($user_id_d)) {
      if (checkedUser($conn, $user_id_d)) {
      } else {
          echo '<script> location.assign("member.php"); </script>';
      }
  } else {
      echo '<script> location.assign("member.php"); </script>';
  }
//   location.assign("member.php");location.reload();
    $dataPeople_d = getdataDetailUser($conn, $user_id_d);
    $classroom =  getdataClassroomStudent($conn, $dataPeople_d['userCode'], $dataPeople_d['user_class']);
    ?>
    
    <title>CPW.LAS: <?php echo $dataPeople_d['name']."'s Profile" ; ?></title>
    
</head>

<body class="hold-transition sidebar-mini layout-fixed scrollbarB">
    <div class="wrapper">
        <?php include('dist/php/link_main_body.php'); ?>
        <script>
        var element = document.getElementById("member_library");
        element.classList.add("active");
        document.getElementById("member_profile").setAttribute("href", "#");;
        document.getElementById("member_profile").classList.add('active');
        document.getElementById("ml_h").classList.add('menu-open');
        </script>

        <!-- Content Wrapper. Contains page content -->
        <div class="content-wrapper">
            <!-- Content Header (Page header) -->
            <section class="content-header">
                <div class="container-fluid">
                    <div class="row mb-2">
                        <div class="col-sm-6">
                            <h1 class="m-0 text-dark">Member's Profile</h1>
                        </div><!-- /.col -->
                        <div class="col-sm-6">
                            <ol class="breadcrumb float-sm-right">
                                <li class="breadcrumb-item"><a href="member.php"><i class="fas fa-users"></i> Member
                                        Library
                                    </a></li>
                                <li class="breadcrumb-item active"><i class="fa fa-user"></i>
                                    <?php echo $dataPeople_d['name'] ?></li>
                            </ol>
                        </div><!-- /.col -->
                    </div><!-- /.row -->
                </div><!-- /.container-fluid -->
            </section>
            <!-- /.content-header -->
            <!-- Main content -->
            <section class="content">
                <div class="container-fluid">
                    <div class="row">
                        <div class="col-lg-3 col-md-4">

                            <!-- Profile Image -->
                            <div class="card card-primary card-outline">
                                <div class="card-body box-profile">
                                    <div class="text-center mb-3">
                                        <img class="profile-user-img img-fluid img-circle border-success"
                                            style="object-fit: cover;object-position: top;height: 125px;width: 125px; "
                                            src="<?php echo $dataPeople_d['image'];?>" alt="User profile picture">
                                    </div>

                                    <h4 class="profile-username text-center">
                                        <?php echo $dataPeople_d['name']." ".$dataPeople_d['lname']; ?> </h4>

                                    <h5 class="text-muted text-center"><span
                                            class="badge badge- p-2"><?php //echo getdataClassroomStudent($conn, $dataPeople_d['userCode'],$dataPeople_d['user_class']);?></span>
                                    </h5>
                                    <p class="font-weight-bolder text-right "><span>สถานะ</span></p>
                                    <ul class="list-group list-group-unbordered mb-3 " style="">
                                        <li class="list-group-item">
                                            <b>บัญชี</b>
                                            <spen class="float-right font-weight-bold">
                                                <?php echo $dataPeople_d['status'];  ?>
                                            </spen>
                                        </li>
                                        <li class="list-group-item">
                                            <b>อาชีพ</b>
                                            <spen class="float-right badge badge-pill <?php if ($dataPeople_d['user_class'] == 2) {
        echo 'bg-indigo' ;
    } elseif ($dataPeople_d['user_class'] == 1) {
        echo 'bg-olive' ;
    }
                                                    ?> font-weight-bold">
                                                <?php if ($dataPeople_d['user_class'] == 2) {
                                                        echo 'ครู' ;
                                                    } elseif ($dataPeople_d['user_class'] == 1) {
                                                        echo 'นักเรียน' ;
                                                    }
                                                    ?></spen>
                                        </li>
                                        <li class="list-group-item">
                                            <b>สถิติยืมหนังสือ</b>
                                            <spen class="float-right badge badge-pill badge-primary font-weight-bold">8
                                                เล่ม</spen>
                                        </li>
                                        <li class="list-group-item collapse statemore" id="statemore">
                                            <b>สถิติข้อความ</b>
                                            <spen class="float-right badge badge-pill badge-primary font-weight-bold">
                                                100 ข้อความ</spen>
                                        </li>
                                        <li class="list-group-item collapse statemore" id="statemore">
                                            <b>สถิติข้อความ</b>
                                            <spen class="float-right badge badge-pill badge-primary font-weight-bold">
                                                88 ข้อความ</spen>
                                        </li>
                                        <li class="list-group-item collapse statemore" id="statemore">
                                            <b>สถิติข้อความ</b>
                                            <spen class="float-right badge badge-pill badge-primary font-weight-bold">
                                                55 ข้อความ</spen>
                                        </li>
                                        <li class="list-group-item collapse statemore" id="statemore">
                                            <b>สถิติข้อความ</b>
                                            <spen class="float-right badge badge-pill badge-primary font-weight-bold">
                                                44 ข้อความ</spen>
                                        </li>
                                        <li class="list-group-item collapse statemore" id="statemore">
                                            <b>สถิติข้อความ</b>
                                            <spen class="float-right badge badge-pill badge-primary font-weight-bold">
                                                33 ข้อความ</spen>
                                        </li>
                                    </ul>

                                    <a href="#" id="showWord" class="btn btn-primary btn-xs btn-block"
                                        data-toggle="collapse" data-target=".statemore" aria-expanded="false"
                                        aria-controls="statemore" value="0" onclick="changeWord()">ดูเพิ่มเติม</a>



                                </div>
                                <!-- /.card-body -->
                            </div>
                            <!-- /.card -->


                        </div>
                        <!-- /.col -->
                        <div class="col-lg-9 col-md-8">
                            <div class="card">
                                <div class="card-header p-2">
                                    <ul class="nav nav-pills">
                                        <li class="nav-item"><a class="nav-link active" href="#activity"
                                                data-toggle="tab">ทั่วไป</a></li>
                                        <li class="nav-item"><a class="nav-link" href="#timeline"
                                                data-toggle="tab">ยืมคืนหนังสือ</a></li>
                                        <li class="nav-item"><a class="nav-link" href="#settings"
                                                data-toggle="tab">อื่น ๆ</a></li>
                                    </ul>
                                </div><!-- /.card-header -->
                                <div class="card-body">
                                    <div class="tab-content">
                                        <div class="active tab-pane row" id="activity">
                                            <div class="card  bg-pink">
                                                <div class="card-header">
                                                    <h4 class="card-title">
                                                        ข้อมูลพื้นฐาน </h4>
                                                </div>
                                            </div>
                                            <div class="col-12">
                                                <div class="row " style="">
                                                    <div class="form-group col-6">
                                                        <label for="thaiN">ชื่อภาษาไทย</label>
                                                        <!-- <p class="text-uppercase" style="text-indent: 15px;">
                                                        <?php //echo $dataPeople_d['title'] .$dataPeople_d['name'] . "  " . $dataPeople_d['lname'];?>
                                                    </p> -->
                                                        <input type="text" disabled class="form-control" id="thaiN"
                                                            value="<?php echo $dataPeople_d['title'] .$dataPeople_d['name'] . "  " . $dataPeople_d['lname'];?>">

                                                    </div>
                                                    <div class="form-group col-6">
                                                        <label for="englishN">ชื่อภาษาอังกฤษ</label>
                                                        <!-- <p class="text-uppercase" style="text-indent: 15px;">
                                                        <?php // echo $dataPeople_d['name_en'] . "  " . $dataPeople_d['lname_en'];?>
                                                    </p> -->
                                                        <input type="text" disabled class="form-control text-uppercase"
                                                            id="englishN"
                                                            value="<?php echo $dataPeople_d['name_en'] . "  " . $dataPeople_d['lname_en'];?>">
                                                    </div>
                                                    <div class="form-group col-2">
                                                        <label for="userCode">เลขประจำตัว</label>
                                                        <input type="text" disabled class="form-control text-uppercase"
                                                            id="userCode"
                                                            value="<?php echo  $dataPeople_d['userCode']  ;?>">
                                                    </div>
                                                    <?php if (isset($classroom['ro_name'])) {?>
                                                    <div class="form-group col-3">
                                                        <label for="le_name">ระดับชั้น</label>
                                                        <input type="text" disabled class="form-control text-uppercase"
                                                            id="le_name" value="<?php echo $classroom['ro_name'] ;?>">
                                                    </div>
                                                    <?php } ?>
                                                     <?php if (isset($classroom['st_num'])) {?>
                                                    <div class="form-group col-2">
                                                        <label for="st_num">เลขที่</label>
                                                        <input type="text" disabled class="form-control text-uppercase"
                                                            id="st_num" value="<?php echo $classroom['st_num'] ;?>">
                                                    </div>
                                                     <?php } ?>
                                                    <div class="form-group col-4 ">
                                                        <label for="outline">สถานะ</label>
                                                     <input type="text" disabled class="form-control  <?php if (!isset($classroom['st_num'])) { ?>is-invalid  <?php }?> text-uppercase"
                                                            id="outline" value="<?php echo $classroom['outline'] ;?>">
                                                    </div>

                                                    <!-- <div class="form-group col-4">
                                                        <label for="Nicn">ชื่อเล่น</label>
                                                        <p class="text-uppercase" style="text-indent: 15px;">
                                                            <?php //echo $dataPeople_d['nicnaame'] ;?>
                                                        </p>
                                                        <input type="text" disabled class="form-control text-uppercase"
                                                            id="Nicn" value="<?php //echo $dataPeople_d['nicnaame'] ;?>">
                                                    </div>
                                                    <div class="form-group col-4">
                                                        <label for="Gender">เพศ</label>
                                                        <input type="text" disabled class="form-control text-uppercase"
                                                            id="Gender" value="<?php //echo $dataPeople_d['gender'] ;?>">
                                                    </div>
                                                    <div class="form-group col-4">
                                                        <label for="BirthD">ปี-เดือน-วันเกิด</label>
                                                        <input type="text" disabled class="form-control text-uppercase"
                                                            id="BirthD"
                                                            value="<?php // echo $dataPeople_d['birthday_bk'] ;?>">
                                                    </div> -->
                                                    <!-- <div class="form-group col-4">
                                                        <label for="race">เชื้อชาติ</label>
                                                        <input type="text" disabled class="form-control text-uppercase"
                                                            id="race" value="<?php //echo $dataPeople_d['race'] ;?>">
                                                    </div>
                                                    <div class="form-group col-4">
                                                        <label for="nationality">สัญชาติ</label>
                                                        <input type="text" disabled class="form-control text-uppercase"
                                                            id="nationality"
                                                            value="<?php //echo $dataPeople_d['nationality'] ;?>">
                                                    </div>
                                                    <div class="form-group col-4">
                                                        <label for="religion">ศาสนา</label>
                                                        <input type="text" disabled class="form-control text-uppercase"
                                                            id="religion"
                                                            value="<?php //echo $dataPeople_d['religion'] ;?>">
                                                    </div> -->
                                                </div>
                                            </div>
                                            <div class="card  bg-pink">
                                                <div class="card-header">
                                                    <h4 class="card-title">
                                                        ข้อมูลติดต่อ </h4>
                                                </div>
                                            </div>
                                            <div class="col-12">
                                                <div class="row justify-content-center" style="">

                                                    <div class="form-group col-6">
                                                        <label for="email">อีเมล์</label>
                                                        <div class="input-group ">
                                                            <input type="text" disabled
                                                                class="form-control text-lowercase" id="email"
                                                                value="<?php echo $dataPeople_d['email'] ;?>">
                                                            <?php if ($dataPeople_d['email'] != '-') {  ?>
                                                            <div class="input-group-append">
                                                                <button type="button" class="btn btn-secondary"
                                                                    onclick="document.location = 'mailto: <?php echo $dataPeople_d['email'] ;?>'">ส่งอีเมล์</button>
                                                            </div>
                                                            <?php } ?>
                                                        </div>

                                                    </div>
                                                    <div class="form-group col-6">
                                                        <label for="phone">เบอร์โทรศัพท์</label>
                                                        <div class="input-group ">
                                                            <input type="text" disabled
                                                                class="form-control text-uppercase" id="phone"
                                                                value="<?php echo $dataPeople_d['phone'] ;?>">
                                                            <?php if ($dataPeople_d['phone'] != '-') {  ?>
                                                            <div class="input-group-append">
                                                                <button type="button" class="btn btn-secondary"
                                                                    onclick="document.location = 'tel: <?php echo $dataPeople_d['phone'] ;?>'">โทรเลย</button>
                                                            </div>
                                                            <?php } ?>
                                                        </div>
                                                    </div>

                                                </div>
                                            </div>

                                        </div>

                                        <!-- /.tab-pane -->
                                        <div class="tab-pane" id="timeline">

                                        </div>
                                        <!-- /.tab-pane -->

                                        <div class="tab-pane" id="settings">
                                        <div class="row">
          <div class="col-md-3 col-sm-6 col-12">
            <div class="info-box">
              <span class="info-box-icon bg-info"><i class="far fa-envelope"></i></span>

              <div class="info-box-content">
                <span class="info-box-text">ความคิดเห็น</span>
                <span class="info-box-number">52</span>
              </div>
              <!-- /.info-box-content -->
            </div>
            <!-- /.info-box -->
          </div>
          <!-- /.col -->
          <div class="col-md-3 col-sm-6 col-12">
            <div class="info-box">
              <span class="info-box-icon bg-success"><i class="far fa-flag"></i></span>

              <div class="info-box-content">
                <span class="info-box-text">บุ๊กมาร์ก</span>
                <span class="info-box-number">410</span>
              </div>
              <!-- /.info-box-content -->
            </div>
            <!-- /.info-box -->
          </div>
          <!-- /.col -->
          <div class="col-md-3 col-sm-6 col-12">
            <div class="info-box">
              <span class="info-box-icon bg-warning"><i class="far fa-copy"></i></span>

              <div class="info-box-content">
                <span class="info-box-text">Uploads</span>
                <span class="info-box-number">13,648</span>
              </div>
              <!-- /.info-box-content -->
            </div>
            <!-- /.info-box -->
          </div>
          <!-- /.col -->
          <div class="col-md-3 col-sm-6 col-12">
            <div class="info-box">
              <span class="info-box-icon bg-danger"><i class="far fa-star"></i></span>

              <div class="info-box-content">
                <span class="info-box-text">โหวต</span>
                <span class="info-box-number">93,139</span>
              </div>
              <!-- /.info-box-content -->
            </div>
            <!-- /.info-box -->
          </div>
          <!-- /.col -->
        </div>

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






        <?php include 'dist/php/link_main_function_js.php'; ?>

        <script>
        function changeWord() {
            var e = $('#showWord').val();
            if (e == 0) {
                document.getElementById("showWord").innerHTML = 'ดูน้อยลง';
                document.getElementById("showWord").value = 1;
            } else {
                document.getElementById("showWord").innerHTML = 'ดูเพิ่มเติม';
                document.getElementById("showWord").value = 0;
            }

        }
        </script>
</body>

</html>