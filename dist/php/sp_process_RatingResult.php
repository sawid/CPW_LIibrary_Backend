<?php

include('connect_db.php');
include('function_get_UserData.php');

$actions = $_POST['actions'];

if ($actions == 'getVotedetail') {
    $book_id = $_POST['book_id'];
    $sql = " SELECT * FROM  [cpw_library].[dbo].[data_vote] WHERE  book_id = '$book_id'";
    $stmt = sqlsrv_query($conn, $sql);
    if ($stmt === false) {
        die(print_r(sqlsrv_errors(), true));
    }
    $voteResult=0;
    $vote1 =0;
    $vote2=0;
    $vote3=0;
    $vote4=0;
    $vote5=0;
    $num = 0;
    while ($row = sqlsrv_fetch_array($stmt, SQLSRV_FETCH_ASSOC)) {
        if ($row['rating'] == 1) {
            $vote1 += 1;
        } elseif ($row['rating'] == 2) {
            $vote2 += 1;
        } elseif ($row['rating'] == 3) {
            $vote3 += 1;
        } elseif ($row['rating'] == 4) {
            $vote4 += 1;
        } elseif ($row['rating'] == 5) {
            $vote5 += 1;
        }
        $voteResult += $row['rating'];
        $num++;
    }
    if ($num != 0) {
        $ratingR = $voteResult/$num;
        $htmlStar  =  array() ;
        for ($i = 0 ; $i < floor($ratingR) ; $i++) {
            $htmlStar[$i] .= '<span class="fa-stack ">';
            $htmlStar[$i] .= '<i class="far  fa-star fa-stack-2x text-secondary"></i>';
            $htmlStar[$i] .= '<i class="fas fa-star fa-stack-2x text-yellow"></i>';
            $htmlStar[$i] .= '</span>';
        }
        if (round($ratingR)-floor($ratingR) == 1) {
            $htmlStar[floor($ratingR)] .= '<span class="fa-stack ">';
            $htmlStar[floor($ratingR)] .= '<i class="far  fa-star fa-stack-2x text-secondary"></i>';
            $htmlStar[floor($ratingR)] .= '<i class="fas fa-star-half fa-stack-2x text-yellow"></i>';
            $htmlStar[floor($ratingR)] .= '</span>';
        }
        for ($i = round($ratingR) ; $i < 5 ; $i++) {
            $htmlStar[$i] .= '<span class="fa-stack ">';
            $htmlStar[$i] .= '<i class="far  fa-star fa-stack-2x text-secondary"></i>';
            $htmlStar[$i] .= '</span>';
        }
        $htmlSatus .= '<div class="progress-group">';
        $htmlSatus .= '<i class="fas fa-grin-hearts"></i> รู้สึกชื่นชอบอย่างมาก (5 ดาว)';
        $htmlSatus .= '<span class="float-right"><b>'.$vote5.'</b>/'.$num.'</span>';
        $htmlSatus .= '<div class="progress progress-sm">';
        $htmlSatus .= '<div class="progress-bar bg-success" style="width: '.(($vote5/$num)*100).'%"></div>';
        $htmlSatus .= '</div>';
        $htmlSatus .= '</div>';
        $htmlSatus .= '<div class="progress-group">';
        $htmlSatus .= '<i class="fas fa-grin"></i> รู้สึกชื่นชอบ (4 ดาว)';
        $htmlSatus .= '<span class="float-right"><b>'.$vote4.'</b>/'.$num.'</span>';
        $htmlSatus .= '<div class="progress progress-sm">';
        $htmlSatus .= '<div class="progress-bar bg-olive" style="width: '.(($vote4/$num)*100).'%"></div>';
        $htmlSatus .= '</div>';
        $htmlSatus .= '</div>';
        $htmlSatus .= '<div class="progress-group">';
        $htmlSatus .= '<i class="fas fa-meh"></i> รู้สึกเฉย ๆ (3 ดาว)';
        $htmlSatus .= '<span class="float-right"><b>'.$vote3.'</b>/'.$num.'</span>';
        $htmlSatus .= '<div class="progress progress-sm">';
        $htmlSatus .= '<div class="progress-bar bg-teal" style="width: '.(($vote3/$num)*100).'%"></div>';
        $htmlSatus .= '</div>';
        $htmlSatus .= '</div>';
        $htmlSatus .= '<div class="progress-group">';
        $htmlSatus .= '<i class="fas fa-frown"></i> ไม่ค่อยโอเค (2 ดาว)';
        $htmlSatus .= '<span class="float-right"><b>'.$vote2.'</b>/'.$num.'</span>';
        $htmlSatus .= '<div class="progress progress-sm">';
        $htmlSatus .= '<div class="progress-bar bg-info" style="width: '.(($vote2/$num)*100).'%"></div>';
        $htmlSatus .= '</div>';
        $htmlSatus .= '</div>';
        $htmlSatus .= '<div class="progress-group">';
        $htmlSatus .= '<i class="fas fa-meh-rolling-eyes"></i> ไม่ปลื้มอย่างมาก (1 ดาว)';
        $htmlSatus .= '<span class="float-right"><b>'.$vote1.'</b>/'.$num.'</span>';
        $htmlSatus .= '<div class="progress progress-sm">';
        $htmlSatus .= '<div class="progress-bar bg-lightblue" style="width: '.(($vote1/$num)*100).'%"></div>';
        $htmlSatus .= '</div>';
        $htmlSatus .= '</div>';
        $htmltell = 'ผลโหวตจากทั้งหมด '.$num.' คน';
        $htmltime = '<i class="far fa-clock"></i> ข้อมูลอัพเดทเมื่อ '.date("d/m/Y เวลา H:i:s");
        echo implode(" ", $htmlStar) . '_____' . $htmltell . '_____' . $htmltime . '_____' . '<b>'.$vote5.'</b>/'.$num .'_____' . 'width: '.(($vote5/$num)*100).'%'
        . '_____' . '<b>'.$vote4.'</b>/'.$num .'_____' . 'width: '.(($vote4/$num)*100).'%' . '_____' . '<b>'.$vote3.'</b>/'.$num .'_____' . 'width: '.(($vote3/$num)*100).'%'
        . '_____' . '<b>'.$vote2.'</b>/'.$num .'_____' . 'width: '.(($vote2/$num)*100).'%' . '_____' . '<b>'.$vote1.'</b>/'.$num .'_____' . 'width: '.(($vote1/$num)*100).'%';
    } else {
        echo 'NoV';
    }
} elseif ($actions == 'addCommentBook') {
    $book_id = $_POST['book_id'];
    $user_id = $_POST['user_id'];
    $token  = date("YmdHis") . $user_id . $book_id;
    $texts = str_replace("'","''",trim($_POST['texts']));
    $sql = " INSERT INTO data_comment (book_id,user_id,texts,token) VALUES('$book_id', '$user_id', '$texts','$token')";
    $stmt = sqlsrv_query($conn, $sql);
    if ($stmt === false) {
        die(print_r(sqlsrv_errors(), true));
    }
    echo 'OK_YES_IS_WORKING';
}  elseif ($actions == 'getCommentdetail') {
    $book_id = $_POST['book_id'];
    $sql = " SELECT * FROM  [cpw_library].[dbo].[data_comment] WHERE  book_id = '$book_id' order by data_update asc ";
    $stmt = sqlsrv_query($conn, $sql);
    if ($stmt === false) {
        die(print_r(sqlsrv_errors(), true));
    }
    $num = 0;
    while ($row = sqlsrv_fetch_array($stmt, SQLSRV_FETCH_ASSOC)) {
        if (date('d-m-Y-H-i') ==  date_format($row['data_update'], "d-m-Y-H-i")) {
            $date_n = 'เมื่อสักครู่นี้';
        } elseif (date('d-m-Y') == date_format($row['data_update'], "d-m-Y")) {
            $date_n = 'วันนี้ เวลา ' . date_format($row['data_update'], "H:i:s");
        } else {
            $date_n = date_format($row['data_update'], "d/m/Y เวลา H:i:s");
        }
        $detail_u = getdataDetailUser($conn, $row['user_id']);
        $html .= '<div class="card " id="text_'.$row['text_id'].'_id">';
        $html .= '<div class="card-footer card-comments">';
        $html .= '<div class="card-comment">';
        $html .= '<img class="img-circle img-lg img-user-only" src="'.$detail_u['image'].'" style="" alt="User Image">';
        $html .= '<div class="comment-text">';
        $html .= '<span class="username text-pink">';
        $html .= '<a href="'.$detail_u['link'].'">'.$detail_u['name']. ' ' .$detail_u['lname'] .'</a>';
        $html .= '<span class="text-muted float-right d-none d-sm-block">';
        $html .= '<i class="far fa-clock"></i> ';
        $html .= $date_n;
        $html .= '</span>';
        $html .= '</span>';
        $html .= '<p>' .$row['texts'] . '</p>';
        $html .= '</div>';
        $html .= '<button class="btn btn-xs btn-outline-danger float-right " onClick="getDeleteComment('.$row['text_id'].');"><i class="fa fa-trash" aria-hidden="true"></i> ลบความคิดเห็น</button>';
        // $html .= '<small class="btnDelete float-right" data-toggle="modal" data-target="#modal_deleteBook" onclick="confrimDelete(1002)"> <i class="fa fa-trash" aria-hidden="true"></i> ลบความคิดเห็น</small>';
        $html .= '</div>';
        $html .= '</div>';
        $html .= '</div>';
        $num++ ;
    }
    echo $num . '_____' . $html;
} else if ($actions == 'deleteThisComment') {
     $book_id = $_POST['book_id'];
    $text_id = $_POST['text_id'];

    $sql = 'DELETE FROM [cpw_library].[dbo].[data_comment] WHERE book_id = '.$book_id.' AND text_id = '.$text_id.'';
    $stmt = sqlsrv_query($conn, $sql);
    if ($stmt === false) {
        echo 'dCOM101ps';
        die(print_r(sqlsrv_errors(), true));
    }
   
    echo 'IS_WORK_DELETE_COM';
}  elseif ($actions == 'getTableForBooking') {
    $book_id = $_POST['book_id'];
    $sql = " SELECT * FROM  [cpw_library].[dbo].[data_booking_histery] WHERE book_id = '$book_id' ORDER BY booking_id DESC";
    $stmt = sqlsrv_query($conn, $sql);
    if ($stmt === false) {
        die(print_r(sqlsrv_errors(), true));
    }
    $num = 0;
    while ($row = sqlsrv_fetch_array($stmt, SQLSRV_FETCH_ASSOC)) {
        $nestedData=[];
    $nestedData[] = $row["employee_name"];
    $nestedData[] = $row["employee_salary"];
    $nestedData[] = $row["employee_age"];
    $data[] = $nestedData;

        if (date('d-m-Y-H-i') ==  date_format($row['data_update'], "d-m-Y-H-i")) {
            $date_n = 'เมื่อสักครู่นี้';
        } elseif (date('d-m-Y') == date_format($row['data_update'], "d-m-Y")) {
            $date_n = 'วันนี้ เวลา ' . date_format($row['data_update'], "H:i:s");
        } else {
            $date_n = date_format($row['data_update'], "d/m/Y เวลา H:i:s");
        }
        $detail_u = getdataDetailUser($conn, $row['user_id']);
        $html .= '<div class="card " id="text_'.$row['text_id'].'_id">';
        $html .= '<div class="card-footer card-comments">';
        $html .= '<div class="card-comment">';
        $html .= '<img class="img-circle img-lg img-user-only" src="'.$detail_u['image'].'" style="" alt="User Image">';
        $html .= '<div class="comment-text">';
        $html .= '<span class="username text-pink">';
        $html .= '<a href="'.$detail_u['link'].'">'.$detail_u['name']. ' ' .$detail_u['lname'] .'</a>';
        $html .= '<span class="text-muted float-right d-none d-sm-block">';
        $html .= '<i class="far fa-clock"></i> ';
        $html .= $date_n;
        $html .= '</span>';
        $html .= '</span>';
        $html .= '<p>' .$row['texts'] . '</p>';
        $html .= '</div>';
        $html .= '<button class="btn btn-xs btn-outline-danger float-right " onClick="getDeleteComment('.$row['text_id'].');"><i class="fa fa-trash" aria-hidden="true"></i> ลบความคิดเห็น</button>';
        // $html .= '<small class="btnDelete float-right" data-toggle="modal" data-target="#modal_deleteBook" onclick="confrimDelete(1002)"> <i class="fa fa-trash" aria-hidden="true"></i> ลบความคิดเห็น</small>';
        $html .= '</div>';
        $html .= '</div>';
        $html .= '</div>';
        $num++ ;
    }
    echo $num . '_____' . $html;
}
