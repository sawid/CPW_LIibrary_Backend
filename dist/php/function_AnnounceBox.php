<?php

function getAnnounceBox($conn)
{

    $sql = " SELECT * FROM cpw_library.dbo.data_announce ORDER BY announce_id desc ";
    $stmt = sqlsrv_query($conn, $sql);
    if ($stmt === false) {
        die(print_r(sqlsrv_errors(), true));
    }
    $announce_date_day_1 = '00/00/00';
    $num = 0;
    while ($row = sqlsrv_fetch_array($stmt, SQLSRV_FETCH_ASSOC)) {
        $num += 1;
        $announce_admin = $row['announce_admin'];
        $announce_head = $row['announce_head'];
        $announce_id = $row['announce_id'];
        $announce_text = $row['announce_text'];
        $announce_date = $row['announce_date'];
        $announce_date_time = date_format($announce_date, "H:i");
        $announce_date_day_2 = date_format($announce_date, "d/m/y");
        if ($announce_date_day_2 != $announce_date_day_1) {
            $data .= '<li class="time-label">
                            <span class="bg-purple">
                                ' . $announce_date_day_2 . '
                            </span>
                        </li>';
        }
        $data .= '<li>
                            <i class="fa fa-bullhorn bg-teal-active"></i>  
                            <div class="timeline-item">
                                <span class="time"><i class="fa fa-clock-o"></i> ' . $announce_date_time . '</span>
                                <h3 class="timeline-header"><a href="#">' . $announce_admin . ' </a>
                                , ได้ประกาศ: ' . $announce_head . '</h3>
                                <div id="announce_text_' . $announce_id . '" class="timeline-body" style="text-indent:35px">
                                   ' . $announce_text . '
                                </div>
                                <div class="timeline-footer">
                                    <!-- <a class="btn btn-warning btn-xs" data-toggle="modal" data-target="#myModal">แก้ไข</a> -->
                                    <a class="btn btn-danger btn-xs confirmation"  href="update_data_normal.php?Action=DeleteAnnounceBxs&id=' . $announce_id . '">ลบ</a>
                                </div>
                            </div>
                        </li>
            ';
        $announce_date_day_1 = $announce_date_day_2;
    }

    if ($num == 0) {
        $data .= '<li class="time-label">
                            <span class="bg-maroon">
                                ' . date('d/m/y') . '
                            </span>
                        </li>
                        <li>
                            <i class="fa  fa-spinner fa-pulse bg-orange-active"></i>  
                            <div class="timeline-item">
                                <span class="time"><i class="fa fa-clock-o"></i> ' . date('H:s') . '</span>
                                <h3 class="timeline-header">ขณะนี้ ไม่มีประกาศของบรรณารักษ์!</h3>
                                
                            </div>
                        </li>
            ';
    }

    //date_format(datetime,""); -----
    return $data;
}
function getEditwithAnnounceBox(Type $var = null)
{
    $sql = " SELECT * FROM cpw_library.dbo.data_announce ORDER BY announce_id desc ";
    $stmt = sqlsrv_query($conn, $sql);
    if ($stmt === false) {
        die(print_r(sqlsrv_errors(), true));
    }
    // <div class="modal fade" id="modal-default">
    //       <div class="modal-dialog">
    //         <div class="modal-content">
    //           <div class="modal-header">
    //             <button type="button" class="close" data-dismiss="modal" aria-label="Close">
    //               <span aria-hidden="true">&times;</span></button>
    //             <h4 class="modal-title">Default Modal</h4>
    //           </div>
    //           <div class="modal-body">
    //             <p>One fine body&hellip;</p>
    //           </div>
    //           <div class="modal-footer">
    //             <button type="button" class="btn btn-default pull-left" data-dismiss="modal">Close</button>
    //             <button type="button" class="btn btn-primary">Save changes</button>
    //           </div>
    //         </div>
    //         <!-- /.modal-content -->
    //       </div>
    //       <!-- /.modal-dialog -->
    //     </div>
    //     <!-- /.modal -->
    # code...
}

?>