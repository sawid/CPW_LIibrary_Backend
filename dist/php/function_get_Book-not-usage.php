<?php
function gettimethai($month)
{
    // ThaiCreate.Com By @W_IN //
    // switch($date)
    // {
    // case "Monday":
    // $printdate = "จันทร์";
    // break;
    // case "Tuesday":
    // $printdate = "อังคาร";
    // break;
    // case "Wednesday":
    // $printdate = "พุธ";
    // break;
    // case "Thursday":
    // $printdate = "พฤหัสบดี";
    // break;
    // case "Friday":
    // $printdate = "ศุกร์";
    // break;
    // case "Saturday":
    // $printdate = "เสาร์";
    // break;
    // case "Sunday":
    // $printdate = "อาทิตย์";
    // break;
    // }

    switch ($month) {
        case "1":
            $printmonth = "มกราคม";
            break;
        case "2":
            $printmonth = "กุมภาพันธ์";
            break;
        case "3":
            $printmonth = "มีนาคม";
            break;
        case "4":
            $printmonth = "เมษายน";
            break;
        case "5":
            $printmonth = "พฤษภาคม";
            break;
        case "6":
            $printmonth = "มิถุนายน";
            break;
        case "7":
            $printmonth = "กรกฏาคม";
            break;
        case "8":
            $printmonth = "สิงหาคม";
            break;
        case "9":
            $printmonth = "กันยายน";
            break;
        case "10":
            $printmonth = "ตุลาคม";
            break;
        case "11":
            $printmonth = "พฤศจิกายน";
            break;
        case "12":
            $printmonth = "ธันวาคม";
            break;
    }

    return $printmonth;
}


function getAnnounceBoxLast($conn)
{

    $sql = " SELECT TOP (1) * FROM cpw_library.dbo.data_announce ORDER BY announce_id desc ";
    $stmt = sqlsrv_query($conn, $sql);
    if ($stmt === false) {
        die(print_r(sqlsrv_errors(), true));
    }
    $num = 0;
    while ($row = sqlsrv_fetch_array($stmt, SQLSRV_FETCH_ASSOC)) {
        $num = 1;
        $announce_admin = $row['announce_admin'];
        $announce_head = $row['announce_head'];
        $announce_id = $row['announce_id'];
        $announce_text = $row['announce_text'];
        $announce_date = $row['announce_date'];
        $announce_date_m = date_format($announce_date, "n");
        $announce_date_d = date_format($announce_date, "d");
        $announce_date_y = date_format($announce_date, "Y") + 543;
        $data .= '<div class="box-body">
                                            <h4 ><i class="fa fa-bullhorn"></i> เรื่อง: ' . $announce_head . '</h4>
                                            <blockquote>
                                                <p style="font-size:15px !important;text-indent:15px">
                                                    ' . $announce_text . '
                                                </p>
                                                <small>วันที่ ' . $announce_date_d . ' ' . gettimethai($announce_date_m) . ' ' . $announce_date_y . ' <cite title="Source Title">โดย ' . $announce_admin . ' </cite></small>
                                            </blockquote>

                                            <!-- /.box-body -->
                                        </div>

            ';
    }

    if ($num == 0) {
        $data .= '<div class="box-body">
                                           
                                            <blockquote>
                                                <p style="font-size:15px !important;text-indent:15px">
                                                    <i class="fa  fa-spinner fa-pulse"></i> ขณะนี้ไม่มีประกาศจากบรรณารักษ์
                                                </p>
                                                
                                            </blockquote>

                                            <!-- /.box-body -->
                                        </div>';
    }

    //date_format(datetime,""); -----
    return $data;
}

function getAnnounceBoxButton($conn)
{

    $sql = " SELECT * FROM cpw_library.dbo.data_announce ORDER BY announce_id desc ";
    $stmt = sqlsrv_query($conn, $sql);
    if ($stmt === false) {
        die(print_r(sqlsrv_errors(), true));
    }
    $num = 0;
    while ($row = sqlsrv_fetch_array($stmt, SQLSRV_FETCH_ASSOC)) {
        $num = 1;
        $announce_admin = $row['announce_admin'];
        $announce_head = $row['announce_head'];
        $announce_id = $row['announce_id'];
        $announce_text = $row['announce_text'];
        $announce_date = $row['announce_date'];
        $announce_date_m = date_format($announce_date, "n");
        $announce_date_d = date_format($announce_date, "d");
        $announce_date_y = date_format($announce_date, "Y") + 543;
        $data .= '
            
            <button type="button" class="btn btn-default btn-bd-primary btn-block" data-toggle="modal" data-target="#modal-default-' . $announce_id . '">
                ' . $announce_head . '
              </button>
 <div class="modal fade" id="modal-default-' . $announce_id . '">
          <div class="modal-dialog">
            <div class="modal-content">
              <div class="modal-header">
                <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                  <span aria-hidden="true">&times;</span></button>
                <h4 class="modal-title">เรื่อง: ' . $announce_head . '</h4>
              </div>
              <div class="modal-body">
                <blockquote>
                                                <p style="font-size:15px !important;text-indent:15px">
                                                    ' . $announce_text . '
                                                </p>
                                                <small>วันที่ ' . $announce_date_d . ' ' . gettimethai($announce_date_m) . ' ' . $announce_date_y . ' <cite title="Source Title">โดย ' . $announce_admin . ' </cite></small>
                                            </blockquote>

              </div>
              <div class="modal-footer">
                <button type="button" class="btn btn-default pull-left" data-dismiss="modal">Close</button>
              </div>
            </div>
            <!-- /.modal-content -->
          </div>
          <!-- /.modal-dialog -->
        </div>
        <!-- /.modal -->


            ';
    }

    if ($num == 0) {
        $data .= '<div class="box-body">
                                           
                                            <blockquote>
                                                <p style="font-size:15px !important;text-indent:15px">
                                                    <i class="fa  fa-spinner fa-pulse"></i> ขณะนี้ไม่มีประกาศจากบรรณารักษ์
                                                </p>
                                                
                                            </blockquote>

                                            <!-- /.box-body -->
                                        </div>';
    }

    //date_format(datetime,""); -----
    return $data;
}

function getdataListBookmark_index($conn, $user_id)
{
    $sql = " SELECT top 10 a.book_id , b.book_name , b.book_picture  FROM book_bookmark a left join book_data b on a.book_id  = b.book_id WHERE a.user_id = '$user_id' AND a.bookmark_status = 1 order by a.data_update desc ";
    $stmt = sqlsrv_query($conn, $sql);
    if ($stmt === false) {
        die(print_r(sqlsrv_errors(), true));
    }

    while ($row = sqlsrv_fetch_array($stmt, SQLSRV_FETCH_ASSOC)) {

        $url_files  = 'http://app.cpw.ac.th/library_content/images/book/' . $row['book_picture'];
        $handle = @fopen($url_files, 'r');
        if (!$handle) {
            $image  = '<img src="dist/img/cover.jpg"  alt="">';
            $style_img  = 'style="background-image: url(\'dist/img/cover.jpg\');"';
        } else {

            $image  = '<img src="http://app.cpw.ac.th/library_content/images/book/' . $row['book_picture'] . '"  alt="">';
            $style_img  = 'style="background-image: url(' . $url_files . ');"';
        }
        $data .= '<li class="book sample" ' . $style_img . ' onclick="gotoBookDtail(' . $row['book_id'] . ')" data-toggle="tooltip" data-placement="bottom"  title="' . $row['book_name'] . '">';
        $data .=  $image . $row['book_name'] . ' <p></p>';
        $data .= '</li>';
    }
    return $data;
}


function getComment($conn, $book_id, $user_id)
{

    $sql = " SELECT * FROM data_comment WHERE book_id = '$book_id' order by data_update desc ";
    $stmt = sqlsrv_query($conn, $sql);
    if ($stmt === false) {
        die(print_r(sqlsrv_errors(), true));
    }
    while ($row = sqlsrv_fetch_array($stmt, SQLSRV_FETCH_ASSOC)) {
        $dateToday   = date("Y-m-d");
        if ($dateToday == date_format($row['data_update'], "Y-m-d")) {
            $dataDtateTime  = date_format($row['data_update'], "H:i:s");
        } else {
            $dataDtateTime  = date_format($row['data_update'], "d-M-Y H:i:s");
        }
        $dataPeople  = getdataDetailUser($conn, $row['user_id']);
        $data .= '<div class="item" id="'.$row['text_id'].'">';
        $data .= '<img src="' . $dataPeople['image'] . '" alt="user image" class="">';
        $data .= '<p class="message">';
        $data .= '<span class="nameComment">'. $dataPeople['name'] .'</span> ';
        $data .= $row['texts'];
        $data .= '</p>';
        $data .= '';
        $data .= '<p class="commentInfo">';
        $data.='<small class="text-muted commentTime"><i class="fa fa-clock-o"></i> ' . $dataDtateTime . ' </small>';
        if($user_id == $row['user_id']){
        $data.=' <span class="btnDelete"   data-toggle="modal" data-target="#modal_deleteBook"  onclick="confrimDelete('.$row['text_id'].')"> <i class="fa fa-trash" aria-hidden="true" ></i> ลบความคิดเห็น</span> ';
        }
        $data .= '</p>';
        $data .= '</div>';
    }



    return $data;
}

function getNumberComment($conn, $book_id)
{
    $sql = " SELECT count(*) as 'total' FROM data_comment WHERE book_id = '$book_id' ";
    $stmt = sqlsrv_query($conn, $sql);
    if ($stmt === false) {
        die(print_r(sqlsrv_errors(), true));
    }
    $row = sqlsrv_fetch_array($stmt, SQLSRV_FETCH_ASSOC);
    echo $row['total'];
}

function  getStarVoteResult($conn, $book_id)
{
    $sql = " SELECT vote_result FROM data_vote_result WHERE  book_id = '$book_id'";
    $stmt = sqlsrv_query($conn, $sql);
    if ($stmt === false) {
        die(print_r(sqlsrv_errors(), true));
    }
    $data .= 'คะแนน ';
    $row = sqlsrv_fetch_array($stmt, SQLSRV_FETCH_ASSOC);
    $vote_result  = $row['vote_result'];
    for ($i = 1; $i <= $vote_result; $i++) {
        $data .=  '<i class="fa fa-star vote" aria-hidden="true"></i> ';
    }
    if($vote_result == 0){
        $data = 'ยังไม่มีคะแนนโหวต';
    }
    return $data;
}

function checkStarVote($conn, $book_id, $user_id)
{

    $sql = " SELECT rating FROM data_vote WHERE user_id = '$user_id' AND book_id = '$book_id'";
    $stmt = sqlsrv_query($conn, $sql);
    if ($stmt === false) {
        die(print_r(sqlsrv_errors(), true));
    }
    $row = sqlsrv_fetch_array($stmt, SQLSRV_FETCH_ASSOC);
    $rating  = $row['rating'];
    $n = 5;
    for ($i = 1; $i <= 5; $i++) {

        if ($n == $rating) {
            $checked  = 'checked';
        } else {
            $checked  = '';
        }

        $data .= '<input type="radio" id="star' . $n . '" name="rate" value="' . $n . '"  ' . $checked . '/>';
        $data .= '<label onclick="addVoidBook(' . $n . ')" for="star' . $n . '" title="ให้ ' . $n . '  ">' . $n . ' stars</label>';

        $n--;
    }
    return $data;
}

function getBookvote_result($conn)
{
    $sql = " SELECT top 10  *  FROM data_vote_result a left join book_data b on a.book_id  = b.book_id    order by a.vote_result desc ";
    $stmt = sqlsrv_query($conn, $sql);
    if ($stmt === false) {
        die(print_r(sqlsrv_errors(), true));
    }

    while ($row = sqlsrv_fetch_array($stmt, SQLSRV_FETCH_ASSOC)) {
        $url_files  = 'http://app.cpw.ac.th/library_content/images/book/' . $row['book_picture'];
        $handle = @fopen($url_files, 'r');
        if (!$handle) {
            $image  = '<img src="dist/img/cover.jpg"  alt="">';
            $style_img  = 'style="background-image: url(\'dist/img/cover.jpg\');"';
            $data .= '<li class="book sample" onclick="gotoBookDtail(' . $row['book_id'] . ')" data-toggle="tooltip" data-placement="bottom" title="' . $row['book_name'] . '">';
        $data .= '<p class="text-center">' . $row['book_name']. '</p> '. $image;
        $data .= '</li>';
        } else {

            $image  = '<img src="http://app.cpw.ac.th/library_content/images/book/' . $row['book_picture'] . '"  alt="">';
            $style_img  = 'style="background-image: url(' . $url_files . ');"';
            $data .= '<li class="book sample" onclick="gotoBookDtail(' . $row['book_id'] . ')" data-toggle="tooltip" data-placement="bottom" title="' . $row['book_name'] . '">';
        $data .=  $image;
        $data .= '</li>';
        }
        
    }
    return $data;
}


function getdataBooking($conn,$user_id){
    $sql =" SELECT * FROM data_booking_histery   WHERE user_id = '$user_id' AND booking_status = 1";
        $stmt = sqlsrv_query($conn, $sql);
    if ($stmt === false) {
        die(print_r(sqlsrv_errors(), true));
    }

    
    while($row = sqlsrv_fetch_array($stmt, SQLSRV_FETCH_ASSOC)){
        $detail  =  getDataBook_DetailBook($conn, $row['book_id']);
        $book_id= $detail['book_id'];
            $book_name= $detail['book_name'];
            $book_accession_no = $detail['book_accession_no'];
            $book_picture = $detail['book_picture'];
            $book_call_classification_100 = $detail['book_call_classification_100'];  
            $day =  date_format($row['booking_dateline'],"d/m/Y") - date_format($row['booking_date_in'],"d") ;


       $data .= ' <li class="book-item col-sm-12 col-md-6 "';
       $data .= ' data-groups="[&quot;classic&quot;]" data-date-created="' . $row['book_id'] . '"';
       $data .= ' data-title="'.$detail['book_name'].'" data-color="#fcc278" style="">';
       $data .= ' <div align="center" class="center-block bk-img">';
       $data .= ' <div class="bk-wrapper">';
       $data .= ' <div class="bk-book bk-bookdefault">';
       $data .= ' <div class="bk-front">';
       $data .= ' <div class="bk-cover"';
       $data .= ' style="background-image: url(../library_content/images/book/'.$detail['book_picture'].'); background-color: rgb(252, 194, 120);">';
       $data .= ' </div>';
       $data .= ' </div>';
       $data .= ' <div class="bk-back"></div>';
       $data .= ' <div class="bk-left" style="background-color: #400000">';
       $data .= ' </div>';
       $data .= ' </div>';
       $data .= ' </div>';
       $data .= ' </div>';
       $data .= ' <div class="item-details">';
       $data .= ' <h4 class="book-item_title"> <a href="#" class=""><i  class="fa fa-star text-orange"></i> </a> '.$detail['book_name'];
       $data .= ' </h4>';
       $data .= ' <p class="author"> วันที่จองหนังสือ : '.date_format($row['booking_date_in'],"d/m/Y").' </p>';
       $data .= ' <p class="author">หมดอายุการจอง : '.date_format($row['booking_dateline'],"d/m/Y").'</p>';
       $data .= ' <p class="author">เหลือเวลา : เหลืออีก '. $day .' วัน</p>';
       $data .= ' <span></span>';
       $data .= ' <span>';
       $data .= ' <div class="btn-group pull-right">';
       $data .= ' <button type="button" onclick="gotoBookDtail(' . $row['book_id'] . ')"   class="btn btn-danger">ยกเลิกการจอง</button>';
       $data .= ' <button type="button"  onclick="gotoBookDtail(' . $row['book_id'] . ')"  class="btn btn bg-teal">รายละเอียด</button>';
       $data .= ' </div>';
       $data .= ' <p></P>';
       $data .= ' <span>';
       $data .= ' </div>';
       $data .= ' </li>';




    }
    return $data;

}
function getdataBookingBBookmark($conn,$user_id){
    $sql =" SELECT   a.book_id , b.book_name , b.book_picture  FROM book_bookmark a left join book_data b on a.book_id  = b.book_id WHERE a.user_id = '$user_id' AND a.bookmark_status = 1 order by a.data_update desc ";

  
    $stmt = sqlsrv_query($conn, $sql);
    if ($stmt === false) {
        die(print_r(sqlsrv_errors(), true));
    }

    
    while($row = sqlsrv_fetch_array($stmt, SQLSRV_FETCH_ASSOC)){
        $detail  =  getDataBook_DetailBook($conn, $row['book_id']);
        $book_id= $detail['book_id'];
            $book_name= $detail['book_name'];
            $book_accession_no = $detail['book_accession_no'];
            $book_picture = $detail['book_picture'];
            $book_call_classification_100 = $detail['book_call_classification_100'];  

            $data .= ' <li class="book-item col-sm-12 col-md-6 "';
            $data .= ' data-groups="[&quot;classic&quot;]" data-date-created="1937"';
            $data .= ' data-title="Of Mice and Men" data-color="#fcc278" style="">';
            $data .= ' <div align="center" class="center-block bk-img">';
            $data .= ' <div class="bk-wrapper">';
            $data .= ' <div class="bk-book bk-bookdefault">';
            $data .= ' <div class="bk-front">';
            $data .= ' <div class="bk-cover"';
            $data .= ' style="background-image: url(../library_content/images/book/'.$detail['book_picture'].'); background-color: rgb(252, 194, 120);">';
            $data .= ' </div>';
            $data .= ' </div>';
            $data .= ' <div class="bk-back"></div>';
            $data .= ' <div class="bk-left" style="background-color: #400000">';
            $data .= ' </div>';
            $data .= ' </div>';
            $data .= ' </div>';
            $data .= ' </div>';
            $data .= ' <div class="item-details">';
            $data .= ' <h4 class="book-item_title"> <a href="#" class=""><i  class="fa fa-star text-orange"></i> </a> '.$detail['book_name'];
            $data .= ' </h4>';
            $data .= ' <p class="author"> สถานะ :  </p>';
            $data .= ' <p class="author">กำหนดที่ต้องคืน : </p>';
            $data .= ' <p class="author">เหลือเวลา : เหลือ 6 วัน</p>';
            $data .= ' <span></span>';
            $data .= ' <span>';
            $data .= ' <div class="btn-group pull-right">';
            $data .= ' <button type="button" class="btn btn-danger">ยกเลิกการบุ๊คมาร์ค</button>';
            $data .= ' <button type="button"  onclick="gotoBookDtail(' . $row['book_id'] . ')"  class="btn btn bg-teal">รายละเอียด</button>';
            $data .= ' </div>';
            $data .= ' <p></P>';
            $data .= ' <span>';
            $data .= ' </div>';
            $data .= ' </li>';
     
    }
    return $data;

}