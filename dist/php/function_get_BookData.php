<?php

function getNumberComment1($conn, $book_id)
{
    $sql = " SELECT count(*) as 'total' FROM data_comment WHERE book_id = '$book_id' ";
    $stmt = sqlsrv_query($conn, $sql);
    if ($stmt === false) {
        die(print_r(sqlsrv_errors(), true));
    }
    $row = sqlsrv_fetch_array($stmt, SQLSRV_FETCH_ASSOC);
    return $row['total'];
}

function getStarVoteResult1($conn, $book_id)
{
    $sql = " SELECT vote_result FROM data_vote_result WHERE  book_id = '$book_id'";
    $stmt = sqlsrv_query($conn, $sql);
    if ($stmt === false) {
        die(print_r(sqlsrv_errors(), true));
    }
    $data .=  'คะแนนโหวต ';
    $row = sqlsrv_fetch_array($stmt, SQLSRV_FETCH_ASSOC);
    $vote_result  = $row['vote_result'];
    for ($i = 1; $i <= $vote_result; $i++) {
        $data .=  '<i class="fa fa-star vote" aria-hidden="true"></i> ';
    }
    $data =  'ยังไม่มีคะแนนโหวต';
    return $data;
}

function checkStatusBooking1($conn, $book_id)
{
    $sql = " SELECT count(*) as 'total' FROM data_booking_histery   WHERE book_id = '$book_id' AND booking_status = 1";
    $stmt = sqlsrv_query($conn, $sql);
    if ($stmt === false) {
        die(print_r(sqlsrv_errors(), true));
    }
    $row = sqlsrv_fetch_array($stmt, SQLSRV_FETCH_ASSOC);
    return $row['total'];
}
function getAuthor($conn, $book_id)
{
    $sqlau = "SELECT TOP (1) * FROM cpw_library.dbo.book_Author_Translator WHERE book_id = '$book_id' AND bat_type = 1 ";
    $stmt = sqlsrv_query($conn, $sqlau);
    if ($stmt === false) {
        die(print_r(sqlsrv_errors(), true));
    }
    $rowau = sqlsrv_fetch_array($stmt, SQLSRV_FETCH_ASSOC);
    $author_id = $rowau['Author_id'];
    $sqlaus = " SELECT TOP (1) * FROM cpw_library.dbo.data_Author WHERE Author_id = '$author_id' ORDER BY author_id asc ";
    $stmt = sqlsrv_query($conn, $sqlaus);
    if ($stmt === false) {
        die(print_r(sqlsrv_errors(), true));
    }
    $rowau = sqlsrv_fetch_array($stmt, SQLSRV_FETCH_ASSOC);
    if ($rowau['Author_name'] != '') {
        return 'โดย ' . $rowau['Author_name'];
    }
    return $rowau['Author_name'];
}

function getSatusBook($conn, $book_id)
{
    $sqlau = "SELECT TOP (1) * FROM cpw_library.dbo.data_booking_histery WHERE book_id = '$book_id' ORDER BY booking_id DESC";
    $stmt = sqlsrv_query($conn, $sqlau);
    if ($stmt === false) {
        die(print_r(sqlsrv_errors(), true));
    }
    $rowau = sqlsrv_fetch_array($stmt, SQLSRV_FETCH_ASSOC);
    $book_status = $rowau['booking_status'];
    if ($book_status == 1) {
        $data[] =  '<spen><i class="fas fa-circle text-warning"></i></spen>';
        $data[] =  '<spen> จอง </spen>';
        $data[] = 1;
        return $data;
    } elseif ($book_status == 2) {
        $data[] =  '<spen><i class="fas fa-circle text-danger"></i></spen>';
        $data[] =  '<spen> ยืม </spen>';
        $data[] = 2;
        return $data;
    }
    $data[] =  '<spen><i class="fas fa-circle text-success"></i></spen>';
    $data[] =  '<spen> ว่าง </spen>';
    $data[] = 3;
    return $data;
}

function checkSatusBook($conn, $book_id)
{
    $sqlau = "SELECT TOP (1) * FROM cpw_library.dbo.data_booking_histery WHERE book_id = '$book_id' ORDER BY booking_id DESC";
    $stmt = sqlsrv_query($conn, $sqlau);
    if ($stmt === false) {
        die(print_r(sqlsrv_errors(), true));
    }
    $rowau = sqlsrv_fetch_array($stmt, SQLSRV_FETCH_ASSOC);
    $book_status = $rowau['booking_status'];
    if ($book_status == 1) {
        return '1';
    } elseif ($book_status == 2) {
        return '2';
    }
    return '0';
}

function checkBookmark($book_id, $user_id, $conn)
{
    $sql = " SELECT  *  FROM book_bookmark WHERE user_id = '$user_id' AND book_id = '$book_id'  ";
    $stmt = sqlsrv_query($conn, $sql);
    if ($stmt === false) {
        die(print_r(sqlsrv_errors(), true));
    }
    $row = sqlsrv_fetch_array($stmt, SQLSRV_FETCH_ASSOC);
    if ($row['bookmark_status'] == 1) {
        return '<i class="fa fa-bookmark" onclick="addBookmark(' . $book_id . ')" aria-hidden="true" id="bookmark' . $book_id . '"></i>';
    } else {
        return '<i class="fa fa-bookmark-o" onclick="addBookmark(' . $book_id . ')" aria-hidden="true" id="bookmark' . $book_id . '"></i>';
    }
}

function getCheckBok($conn, $book_id)
{
    $sql = " SELECT * FROM data_languge ORDER BY book_lan_id asc ";
    $stmt = sqlsrv_query($conn, $sql);
    if ($stmt === false) {
        die(print_r(sqlsrv_errors(), true));
    }
    $nun = 1;
    while ($row = sqlsrv_fetch_array($stmt, SQLSRV_FETCH_ASSOC)) {
        if (checkLanguge_Chackbook($conn, $book_id, $row['book_lan_id']) == 1) {
            $checked = 'checked';
        } else {
            $checked  = '';
        }
        $data .= '<div class="col-lg-12 col-md-3  col-sm-4 col-6">';
        $data .= '<div class="icheck-secondary ">';
        $data .= '<input type="checkbox" class="inputDis edit_book" disabled name="book_languge_id[]"  id="book_languge_id' . $num . '" value="' . $row['book_lan_id'] . '" ' . $checked . ' >';
        $data .= '<label for="book_languge_id' . $num . '">';
        $data .= $row['languge'];
        $data .= '</label>';
        $data .= '</div>';
        $data .= '</div>';
        // $data .= '<label class=" col-lg-6"><input type="checkbox"  name="book_languge_id[]"  id="book_languge_id' . $num . '" class="minimal" value="' . $row['book_lan_id'] . '" ' . $checked . ' > ' . $row['languge'] . '</label> <p>';

        $num++;
    }
    $data .= '<div class="col-lg-12 col-md-3  col-sm-4 col-12">';
    $data .= '<div class="icheck-danger ">';
    $data .= '<input type="checkbox"  class="inputDis edit_book" disabled name="book_languge_id[]"  id="book_languge_id0" value="0" ' . $checked . ' >';
    $data .= '<label for="book_languge_id0">';
    $data .= '<input name="languge_other" type="text" class="form-control" disabled id="languge_other" placeholder="อื่น ๆ (ระบุ)" required="">';
    // $data .=  'อื่น ๆ';
    $data .= '</label>';
    $data .= '</div>';
    $data .= '</div>';

    // $data .= '<label class=" col-lg-12"><input type="checkbox"  name="book_languge_id[]"  id="book_languge_id0" class="minimal" value="0" > อื่น ๆ <br/></label> <input name="languge_other" type="text" class="form-control" id="languge_other" placeholder="ระบุ" required=""> <p>';

    return $data;
}

function checkLanguge_Chackbook($conn, $book_id, $book_languge_id)
{
    $sql = " SELECT count(*) as 'total' FROM book_languge where book_id = '$book_id' and  book_languge_id = '$book_languge_id'";
    $stmt = sqlsrv_query($conn, $sql);
    if ($stmt === false) {
        die(print_r(sqlsrv_errors(), true));
    }
    $row = sqlsrv_fetch_array($stmt, SQLSRV_FETCH_ASSOC);
    return $row['total'];
}

function getDataAutherName_json($conn)
{
    $sql = " SELECT * FROM data_Author ORDER BY Author_name asc ";
    $stmt = sqlsrv_query($conn, $sql);
    if ($stmt === false) {
        die(print_r(sqlsrv_errors(), true));
    }
    $nun = 1;
    $data  = array();
    while ($row = sqlsrv_fetch_array($stmt, SQLSRV_FETCH_ASSOC)) {
        $data[] = '"' . $row['Author_name'] . '"';
    }
    $dataAuther  = implode(",", $data);
    return $dataAuther;
}

function getDataBook_DetailBook($conn, $inputCombo)
{
    if (strlen($inputCombo) >= 10) {
        $where = " where a.book_isbn ='$inputCombo'";
    } else {
        $where = " where a.book_id ='$inputCombo'";
    }
    $sql = " SELECT TOP (1) * FROM book_data a 
    left join data_book_call_classification_100 b on a.book_call_classification_100 = b.book_call_classification_100  
    left join data_book_call_classification_10 c on (a.book_call_classification_10 = c.book_call_classification_10 AND a.book_call_classification_100 = c.book_call_classification_100)  
    left join data_book_call_classification_1 d on (a.book_call_classification_1 = d.book_call_classification_1 AND a.book_call_classification_10 = d.book_call_classification_10 AND a.book_call_classification_100 = d.book_call_classification_100)
      ".$where."";
    $stmt = sqlsrv_query($conn, $sql);
    if ($stmt === false) {
        die(print_r(sqlsrv_errors(), true));
    }
    $row = sqlsrv_fetch_array($stmt, SQLSRV_FETCH_ASSOC);
    return $row;
}

function getDataLanguge_DetailBook($conn, $book_id)
{
    $sql = " SELECT * FROM book_languge a left join data_languge b on a.book_languge_id = b.book_lan_id where a.book_id ='$book_id'";
    $stmt = sqlsrv_query($conn, $sql);
    if ($stmt === false) {
        die(print_r(sqlsrv_errors(), true));
    }
    while ($row = sqlsrv_fetch_array($stmt, SQLSRV_FETCH_ASSOC)) {
        $data[] = $row['languge'];
    }

    return implode(",", $data);
}

function getDataAuthorTranslator_DetailBook($conn, $book_id, $bat_type)
{
    $sql = " SELECT * FROM book_Author_Translator a left join data_Author b on a.Author_id = b.Author_id  where a.book_id ='$book_id' and a.bat_type = '$bat_type'";
    $stmt = sqlsrv_query($conn, $sql);
    if ($stmt === false) {
        die(print_r(sqlsrv_errors(), true));
    }
    while ($row = sqlsrv_fetch_array($stmt, SQLSRV_FETCH_ASSOC)) {
        $data[] = $row['Author_name'];
    }

    return implode(",", $data);
}
function getData_publisher($conn, $publisher_id)
{
    $sql = " SELECT * FROM data_publisher where publisher_id ='$publisher_id'";
    $stmt = sqlsrv_query($conn, $sql);
    if ($stmt === false) {
        die(print_r(sqlsrv_errors(), true));
    }
    $row = sqlsrv_fetch_array($stmt, SQLSRV_FETCH_ASSOC);
    return $row;
}


function getTextBoxWithAuthTran($conn, $book_id, $bat_type, $type)
{
    if ($type == 1) {
        $sql = " SELECT count(*) as 'total' FROM book_Author_Translator where book_id ='$book_id' and bat_type = '$bat_type'";
        $stmt = sqlsrv_query($conn, $sql);
        if ($stmt === false) {
            die(print_r(sqlsrv_errors(), true));
        }
        $row = sqlsrv_fetch_array($stmt, SQLSRV_FETCH_ASSOC);
        if ($row['total'] == 0) {
            if ($bat_type == 1) {
                $paa   = ' id="Author_name' . $num . '" placeholder="ใส่ชื่อ-สกุลผู้แต่ง" ';
            } elseif ($bat_type == 2) {
                $paa   = ' id="Tran_name' . $num . '" placeholder="ใส่ชื่อ-สกุลผู้แปล" ';
            }

            // return '<input name="Author_name1[]" type="text" class="form-control" ' . $paa . '  onkeyup="getOneName()" required>';
            return '<label>(ไม่ระบุ/ไม่ทราบ)</label>';
        }
        // return 'wdwdwdw';

        $sql = " SELECT * FROM book_Author_Translator a left join data_Author b on a.Author_id = b.Author_id  where a.book_id ='$book_id' and a.bat_type = '$bat_type'";
        $stmt = sqlsrv_query($conn, $sql);
        if ($stmt === false) {
            die(print_r(sqlsrv_errors(), true));
        }

        $num = 1;
        while ($row = sqlsrv_fetch_array($stmt, SQLSRV_FETCH_ASSOC)) {
            if ($num == 1) {
                $onclick  = ' onkeyup="getOneName()" ';
            } else {
                $onclick  = ' ';
            }
            if ($bat_type == 1) {
                $paa   = ' id="Author_name' . $num . '" placeholder="ใส่ชื่อ-สกุลผู้แต่ง" ';
                $baa   = 'authBox' . $num ;
                $caa = 'authName';
            } elseif ($bat_type == 2) {
                $paa   = ' id="Tran_name' . $num . '" placeholder="ใส่ชื่อ-สกุลผู้แปล" ';
                $baa   = 'tranBox' . $num ;
                $caa = 'trunName';
            }

            // $data .= '<input name="Author_name' . $bat_type . '[]" type="text" class="form-control" ' . $paa . ' value="' . $row['Author_name'] . '"  ' . $onclick . '  required>';
            $data .= '<div class="input-group mb-2" id="'.$baa.'">';
            $data .= '<div class="input-group-prepend">';
            $data .= '<span class="input-group-text">'.'<i class="fas fa-user-tie"></i>'.'</span>';
            $data .= '<select name="title_n" disabled style=""';
            $data .= 'class="form-control title_n">';
            $data .= '<option value="">ยศ</option>';
            $data .= '</select>';
            $data .= '</div>';
            $data .= '<input name="'.$caa.'[]" type="text" disabled';
            $data .=  $paa;
            $data .= 'class="form-control text-uppercase-x inputDis" required ';
            $data .= 'value="' . $row['Author_name'] . '">';
            $data .= '<div class="input-group-append showBtn d-none ">';
            $data .= '<spen onclick="cuteHide(' . "'#". $baa. "');".'" class="btn btn-danger"><i class="fas fa-user-times"></i></spen>';
            $data .= '</div>';
            $data .= '</div>';
            $num++;
        }
        if ($data == '') {
            $data = '<label>ไม่ทราบ</label>';
        }
        return $data;
    }
    if ($type == 2) {
        $sql = " SELECT count(*) as 'total' FROM book_Author_Translator where book_id ='$book_id' and bat_type = '$bat_type'";
        $stmt = sqlsrv_query($conn, $sql);
        if ($stmt === false) {
            die(print_r(sqlsrv_errors(), true));
        }
        $row = sqlsrv_fetch_array($stmt, SQLSRV_FETCH_ASSOC);
        return $row['total'];
    }
}


function getdataBook($conn)
{
    $sql = " SELECT top 100  * FROM book_data a left join data_book_call_classification_100 b on a.book_call_classification_100 = b.book_call_classification_100 order by a.book_id desc";
    $stmt = sqlsrv_query($conn, $sql);
    if ($stmt === false) {
        die(print_r(sqlsrv_errors(), true));
    }
    $num = 1;
    while ($row = sqlsrv_fetch_array($stmt, SQLSRV_FETCH_ASSOC)) {
        $data .= '<tr>';
        $data .= '<td align="center">' . $num . '</td>';
        $data .= '<td>' . $row['book_accession_no'] . '</td>';
        $data .= '<td>' . $row['book_name'] . '</td>';
        $data .= '<td></td>';  //<span class="label label-success">status in DB: book_status</span>
        $data .= '<td> ' . $row['book_call_meaning_x00'] . '</td>';
        $data .= '<td>';
        $data .= '<div class="btn-group">';
        $data .= '<a  href="detail_book.php?book_id=' . $row['book_id'] . '" class="btn btn-flat btn-sm btn-primary">ดูรายละเอียด</a>';
        $data .= '<a   href="edits_book.php?book_id=' . $row['book_id'] . '"   class="btn btn-flat btn-sm btn-default">แก้ไข</a>';
        $data .= '<button type="button" class="btn btn-flat btn-sm btn-danger">ลบ</button>';
        $data .= '</div>';
        $data .= '</td>';
        $data .= '</tr>';
        $num++;
    }
    return $data;
    $nun = 1;
    $data  = array();
    while ($row = sqlsrv_fetch_array($stmt, SQLSRV_FETCH_ASSOC)) {
        $data[] = '"' . $row['Author_name'] . '"';
    }
    $dataAuther  = implode(",", $data);
    return $dataAuther;
}

function getBooksearchReal($conn, $book_id)
{
    $sql = " SELECT * FROM cpw_library.dbo.data_languge ORDER BY book_lan_id asc ";
    $stmt = sqlsrv_query($conn, $sql);
    if ($stmt === false) {
        die(print_r(sqlsrv_errors(), true));
    }
    $nun = 1;
    while ($row = sqlsrv_fetch_array($stmt, SQLSRV_FETCH_ASSOC)) {
        $data .= '<label class=" col-lg-6"><input type="checkbox"  name="book_languge_id[]"  id="book_languge_id' . $num . '" class="minimal" value="' . $row['book_lan_id'] . '" > ' . $row['languge'] . '</label> <p>';

        $num++;
    }
    $data .= '<label class=" col-lg-12"><input type="checkbox"  name="book_languge_id[]"  id="book_languge_id0" class="minimal" value="0" > อื่น ๆ <br/> <input name="languge_other" type="text" class="form-control" id="languge_other" placeholder="ระบุ" required=""></label> <p>';

    return $data;
}
function getClassification100($conn)
{
    $sql = " SELECT * FROM cpw_library.dbo.data_book_call_classification_100 ORDER BY book_call_classification_100 asc ";
    $stmt = sqlsrv_query($conn, $sql);
    if ($stmt === false) {
        die(print_r(sqlsrv_errors(), true));
    }
    while ($row = sqlsrv_fetch_array($stmt, SQLSRV_FETCH_ASSOC)) {
        $data_book_call_classification_100 = $row['book_call_classification_100'];
        $book_call_meaning_x00 = $row['book_call_meaning_x00'];
        $data .= '<option value="' . $data_book_call_classification_100 . '">' . $book_call_meaning_x00 . '</option>';
    }
    return $data;
}
function getClassification100Name($conn, $code)
{
    if (($code != '')) {
        $sql = " SELECT * FROM cpw_library.dbo.data_book_call_classification_100 WHERE book_call_classification_100 ='$code' ";
        $stmt = sqlsrv_query($conn, $sql);
        if ($stmt === false) {
            die(print_r(sqlsrv_errors(), true));
        }
        $row = sqlsrv_fetch_array($stmt, SQLSRV_FETCH_ASSOC);
        return  $row['book_call_meaning_x00'];
    } else {
        return $code ;
    }
}


function getdataBookNew($conn)
{
    $sql = " SELECT top 12 * FROM cpw_library.dbo.book_data    where book_call_classification_100 is not null ORDER BY data_update desc ";
    $stmt = sqlsrv_query($conn, $sql);
    if ($stmt === false) {
        die(print_r(sqlsrv_errors(), true));
    }
    while ($row = sqlsrv_fetch_array($stmt, SQLSRV_FETCH_ASSOC)) {
        $url_files  = 'http://app.cpw.ac.th/library_content/images/book/' . $row['book_picture'];
        $handle = @fopen($url_files, 'r');
        if (!$handle) {
            $image  = '<img src="dist/img/cover.jpg"  alt="">';
            $data .= '<li class="book sample" onclick="gotoBookDtail(' . $row['book_id'] . ')" data-toggle="tooltip" data-placement="bottom" title="' . $row['book_name'] . '">';
            $data .= '<p class="text-center">' . $row['book_name']. '</p> '. $image;
            $data .= '</li>';
        } else {
            $image  = '<img src="http://app.cpw.ac.th/library_content/images/book/' . $row['book_picture'] . '"  alt="">';
            $data .= '<li class="book sample" onclick="gotoBookDtail(' . $row['book_id'] . ')" data-toggle="tooltip" data-placement="bottom" title="' . $row['book_name'] . '">';
            $data .=  $image;
            $data .= '</li>';
        }
    }
    return $data;
}

function getFirstLastBookID($conn, $q)
{
    $select_top_one =  " SELECT TOP 1 ";

    $stmt = sqlsrv_query($conn, $select_top_one .$q);
    if ($stmt === false) {
        die(print_r(sqlsrv_errors(), true));
    }
    $row = sqlsrv_fetch_array($stmt, SQLSRV_FETCH_ASSOC);
    return $row['book_id'];
}

function getBooklocationName($book_location)
{
    if ($book_location == 1) {
        //ห้องสมุดอาคาร 60 ปี<
        $data[] = '<spen class="badge bg-pink" data-toggle="tooltip" data-placement="top" title="ห้องสมุดอาคาร 60 ปี">60ปี</spen>';
        $data[]  = 'ห้องสมุดอาคาร 60ปี';
        $data[]  = '60ปี';
        $data[] = ' <div class="card"><div class="card-header bg-pink"><i class="fas fa-archway"></i> ห้องสมุดอาคาร 60ปี</div></div>';
    } elseif ($book_location == 2) {
        //ห้องสมุดอาคาร 40 ปี
        $data[] ='<spen class="badge badge-info" data-toggle="tooltip" data-placement="top" title="ห้องสมุดอาคาร 40 ปี">40ปี</spen>';
        $data[]  = 'ห้องสมุดอาคาร 40ปี';
        $data[]  = '40ปี';
        $data[] = ' <div class="card"><div class="card-header bg-info"><i class="fas fa-archway"></i> ห้องสมุดอาคาร 40ปี</div></div>';
    } elseif ($book_location == 3) {
        //ห้องสมุดอาคาร EP
        $data[] = '<spen class="badge bg-nevy" data-toggle="tooltip" data-placement="top" title="ห้องสมุดอาคาร EP">EP</spen>';
        $data[]  = 'ห้องสมุดอาคาร EP';
        $data[]  = 'EP';
        $data[] = ' <div class="card"><div class="card-header bg-nevy"><i class="fas fa-archway"></i> ห้องสมุดอาคาร EP</div></div>';
    } elseif ($book_location == 4) {
        //ห้องสมุดอาคาร EP
        $data[] = '<spen class="badge bg-danger" data-toggle="tooltip" data-placement="top" title="ห้องสมุดอาคาร X">EP</spen>';
        $data[]  = 'ห้องสมุดอาคาร X';
        $data[]  = 'X';
        $data[] = ' <div class="card"><div class="card-header bg-danger"><i class="fas fa-archway"></i> ห้องสมุดอาคาร X</div></div>';
    } else {
        //ไม่ทราบ
        $data[] = '<spen class="badge bg-black" data-toggle="tooltip" data-placement="top" title="ไม่ทราบข้อมูล">UN</spen>';
        $data[]  = 'ไม่ทราบข้อมูล';
        $data[]  = 'UN';
        $data[] = ' <div class="card"><div class="card-header bg-black"><i class="fas fa-archway"></i> ไม่ทราบข้อมูล</div></div>';
    }
    return $data;
}
function checkedBook($conn, $book_id)
{
    $sql = " SELECT book_id FROM book_data where book_id = '$book_id'  ";
    $stmt = sqlsrv_query($conn, $sql);
    if ($stmt === false) {
        die(print_r(sqlsrv_errors(), true));
    }
    $row = sqlsrv_fetch_array($stmt, SQLSRV_FETCH_ASSOC);

    if (isset($row)) {
        return true;
    } else {
        return false;
    }
}
