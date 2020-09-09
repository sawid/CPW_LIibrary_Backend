<?php 

$dataPeople   = getdataDetailUser($conn,$user_id);
?>
<aside class="main-sidebar">
    <section class="sidebar ">
        <div class="user-panel ">
            <div class="pull-left image">
                <img src="<?php echo $dataPeople['image'];?>" style=" border-radius: 10%;" alt="User Image">
            </div>
            <div class="pull-left image info" style="font-size:15px !important;">
                <p><?php echo $dataPeople['info_title'].$dataPeople['name'];?></p>
                <small>สถานะห้องสมุด </small><a href="#"><i id="onoff" <?php  
$q= "SELECT * FROM data_lib_open where openlib_location = 1  ORDER BY 'openlib_id' DESC ";
$qz = sqlsrv_query($conn, $q);
if ($qz === false) {
    die(print_r(sqlsrv_errors(), true));
}
$row = sqlsrv_fetch_array($qz, SQLSRV_FETCH_ASSOC);
$da  = $row['openlib_status'];
if($da == 1){ ?> class="fa fa-circle text-success"></i>Online</a> <?php } 
else { ?> class="fa fa-circle text-danger"></i>Offline</a> <?php } ?>
            </div>
        </div>
        <form action="#" method="get" class="sidebar-form">
            <div class="input-group">
                <input type="text" name="q" class="form-control" placeholder="Search...">
                <span class="input-group-btn">
                    <button type="submit" name="search" id="search-btn" class="btn btn-flat"><i
                            class="fa fa-search"></i>
                    </button>
                </span>
            </div>
        </form>
        <ul class="sidebar-menu" data-widget="tree">
            <li><a id="onoff_a" href="update_data_normal.php?Action=ChangeStatus&status=<?=$da;
            if($da == 1 ){?>
              "><i class="fa fa-toggle-on text-success "></i> <span>กดเพื่อปิดห้องสมุด</span> </a>
                <?php }
            else { ?>
                "> <i class="fa fa-toggle-off text-danger "></i> <span>กดเพื่อเปิดห้องสมุด</span> </a>
                <?php } ?>
            </li>
            <li class="header" style="font-size:16px;">ระบบทั่ว ๆ ไป</li>
            <!-- <li id="mag_centre"><a href="mag_centre.php"> <i class="fa fa-newspaper-o"></i>
                    <span>ศูนย์การแจ้งเตือน</span> </a> </li> -->


            <li id="data_book"><a href="data_book.php"> <i class="fa fa-book"></i> <span>คลังหนังสือ</span> </a> </li>
            <li class="header" style="font-size:16px;">ระบบจัดการสมาชิก</li>
            <li id="data_student"><a href="data_student.php"> <i class="fa fa-users"></i> <span>สมาชิกห้องสมุด</span>
                </a> </li>
            <!-- <li class="header" style="font-size:16px;">ระบบยืม-คืนหนังสือ</li>
            <li id="booking_rfid"><a href="booking_admin.php"> <i class="fa fa-exchange"></i> <span>ยืมคืนหนังสือ
                        <small>เฉพาะห้องสมุด</small></span> -->
                </a> </li>
            
            <li class="header" style="font-size:16px;">รอหลังแก้ Database</li>
            <li id="history"><a href="history.php"> <i class="fa fa-history"></i> <span>ประวัติการยืม-คืน</span> </a></li>
            <li id="announcement"><a href="announcement.php"> <i class="fa  fa-bullhorn"></i> <span>ประกาศ</span> </a> </li>


        </ul>
    </section>
</aside>