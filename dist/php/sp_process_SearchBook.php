<?php
// session_start();
include('function_Pagination.php');
include('connect_db.php');
include('function_get_BookData.php');

$actions = $_POST['actions'];

if ($actions == '1911') {
    $ref_id_final = $_POST['ref_id_final'];
    if ($ref_id_final == '') {
    } else {
        $ref_id_final = explode(",", $ref_id_final);
    }
 
    $ref_id_final_filter = implode(",", $ref_id_final);


    if (isset($_POST["showby"])) {
        if ($_POST["showby"] == 0) {
            $show_by = count($ref_id_final) ;
        } else {
            $show_by = $_POST["showby"];
        }
        $limit = $show_by;
        $page = 1;
        if ($_POST['page'] > 1) {
            $start = (($_POST['page'] - 1) * $limit);
            $page = $_POST['page'];
        } else {
            $start = 0;
        }
    }
    
    if (isset($_POST["sortby"])) {
        if ($_POST["sortby"] == 1) {
            $sort_by = " ORDER BY book_accession_no_int DESC ";
        } elseif ($_POST["sortby"] == 2) {
            $sort_by = " ORDER BY book_accession_no_int ASC ";
        } elseif ($_POST["sortby"] == 3) {
            $sort_by = " ORDER BY book_id ASC ";
        } elseif ($_POST["sortby"] == 4) {
            $sort_by = " ORDER BY book_id DESC ";
        }
    }
    // $sql_final = " SELECT * FROM data_user where ref_id IN ('".$ref_id_final_filter."') ".$sort_by." OFFSET ".$start." ROWS FETCH NEXT ".$limit." ROWS ONLY ";
    $sql_final = " SELECT * , CONVERT(int, book_accession_no) AS book_accession_no_int FROM book_data where  book_id IN (".$ref_id_final_filter.")  ".$sort_by." OFFSET ".$start." ROWS FETCH NEXT ".$limit." ROWS ONLY  ";
    $stmt_final = sqlsrv_query($conn, $sql_final);
    if ($stmt_final === false) {
        die(print_r(sqlsrv_errors(), true));
        // $data .= '<input type="hidden" name="count_data" id="count_data" class="form-control" value="'.count($ref_id_final).'">';
    }
    while ($fetch_final = sqlsrv_fetch_array($stmt_final, SQLSRV_FETCH_ASSOC)) {
        $nuber = floor($fetch_final['book_call_classification_id']);
        $c100 = $fetch_final['book_call_classification_100'];
        if (strlen($nuber) < 3) {
            $nuber = 'NULL';
            $c100 = '';
        }
        $data .= '<tr>';
        $data .= '<td>';
        $data .= $fetch_final['book_accession_no'];
        $data .= '</td>';
        // $data .= '</tr>';
        // $data .= '<tr>';
        $data .= '<td>';
        $data .= getSatusBook($conn, $fetch_final['book_id']);
        $data .= '</td>';
        // $data .= '</tr>';
        // $data .= '<tr>';
        $data .= '<td class="text-break text-truncate" style="max-width: 300px!important">';
        $data .= '<spen  >'.$fetch_final['book_name'] . '</spen>';
        $data .= '</td>';
        // $data .= '</tr>';
        // $data .= '<tr>';
        $data .= '<td>';
        $data .= getClassification100Name($conn, $c100) .'['  .$nuber . ']';
        $data .= '</td>';
        // $data .= '</tr>';
        // $data .= '<tr>';
        $data .= '<td>';
        $data .= '<spen class="text-break">'.$fetch_final['book_location'] . '</spen>';
        $data .= '</td>';
        $data .= '</tr>';
    }

    if ($data == '') {
        // $data = '<div id="loading-w" class="text-center">';
        // $data .= '<div class="card card-danger">';
        // $data .= '<div class="card-header">';
        // $data .= '<h3 class="card-title" style="text-align: center !important;float: none;">: ไม่พบข้อมูล :</h3>';
        // $data .= '</div>';
        // $data .= '<div class="card-body">';
        // $data .= '.: กรุณาลองใหม่อีกครั้ง :.';
        // $data .= '</div>';
        // $data .= '<!-- /.card-body -->';
        // $data .= '</div>';
        // $data .= '<!-- /.card -->';
        // $data .= '  </div>';
        $data  = 'NoFound101';
    } else {
        $head = '<div class="card">';
        $head .= '<div class="table-responsive card-body p-0 ">';
        $head .= '<table class="table table-hover text-nowrap m-0 ">';
        $head .= '<thead class="text-center ">';
        $head .= '<tr>';
        $head .= '<th class="">ทะเบียน</th>';
        $head .= '<th class="">สถานะ</th>';
        $head .= '<th class="">หนังสือ</th>';
        $head .= '<th class="">หมวดหนังสือ</th>';
        $head .= '<th class="">แก้ไข</th>';
        $head .= '</tr>';
        $head .= '</thead>';
        $head .= '<tbody>';
        $end = '</tbody></table></div></div> ';
        $ul = '<ul id="pagination" name="pagination"class="pagination pagination-d justify-content-center">';
        $ul .='</ul>';
        $hidden = '<input type="hidden" hidden name="page_start" id="page_start" class="form-control" value="">';
        $data = $ul .$head . $data . $end.$ul . $hidden;
    }
    // echo $data;
} elseif ($actions == '3') {
    $search  = str_replace("'", " ", trim($_POST["search"]));
    $search = str_replace(' ', '%', $search);
    $select_all = " SELECT " ;
    $query = " *, CONVERT(int, book_accession_no) AS book_accession_no_int FROM cpw_library.dbo.book_data WHERE (";
    if ($search != '') {
        if (isset($_POST["searchby"])) {
            if (in_array("1", $_POST["searchby"])) {
                //  echo "<script>alert('Hi 1') </script>";
                $query .= " book_name LIKE '%" . $search . "%'";
            }
            if (in_array("3", $_POST["searchby"])) {
                if (in_array("1", $_POST["searchby"])) {
                    $query .= " OR";
                }
                $query .= " book_isbn LIKE '%" . $search . "%'";
            }
            if (in_array("4", $_POST["searchby"])) {
                if (in_array("3", $_POST["searchby"]) || in_array("1", $_POST["searchby"])) {
                    $query .= " OR";
                }
                $query .= " book_accession_no LIKE '%" . $search . "%'";
            }
            if (in_array("5", $_POST["searchby"])) {
                if (in_array("4", $_POST["searchby"]) || in_array("3", $_POST["searchby"]) || in_array("1", $_POST["searchby"])) {
                    $query .= " OR";
                }
                $query .= " book_dep LIKE '%" . $search . "%' OR book_content_1 LIKE '%" . $search . "%' OR book_content_2 LIKE '%" . $search . "%' ";
            }
        } else {
            $query .= " book_accession_no LIKE '%" . $search . "%' 
            OR book_name LIKE '%" . $search . "%'
            OR book_content_1 LIKE '%" . $search . "%'
            OR book_content_2 LIKE '%" . $search . "%' ";
        }
    } else {
        $query .= " book_accession_no LIKE '%" . $search . "%' 
            OR book_name LIKE '%" . $search . "%'
            OR book_content_1 LIKE '%" . $search . "%'
            OR book_content_2 LIKE '%" . $search . "%' ";
    }
    $query .= ' ) ';
    if (isset($_POST["searchbymo"])) {
        $searchbymo_filter = implode("','", $_POST["searchbymo"]);
        $query .= " AND ( book_call_classification_100 IN ('" . $searchbymo_filter . "') ) ";
        // echo $query;
    }
    if (isset($_POST["searchbyplace"])) {
        $searchbyplace_filter = implode(",", $_POST["searchbyplace"]);
        $query .= " AND ( book_location IN (" . $searchbyplace_filter . ") ) ";
    }
    if (isset($_POST["sortby"])) {
        if ($_POST["sortby"] == 1) {
            $sort_by = " ORDER BY book_accession_no_int ";
            $query_f = " " . $query . " " . $sort_by . " DESC " ;
            $query_l = " " . $query . " " . $sort_by . " ASC " ;
            $f = getFirstLastBookID($conn, $query_f);
            $l = getFirstLastBookID($conn, $query_l);
            $sort_by .= ' DESC ';
            $sort = ' ORDER BY book_accession_no_int DESC ';
        } elseif ($_POST["sortby"] == 2) {
            $sort_by = " ORDER BY book_accession_no_int ";
            $query_f = " " . $query . " " . $sort_by . " ASC " ;
            $query_l = " " . $query . " " . $sort_by . " DESC " ;
            $f = getFirstLastBookID($conn, $query_f);
            $l = getFirstLastBookID($conn, $query_l);
            $sort_by .= ' ASC ';
            $sort = ' ORDER BY book_accession_no_int  ASC ';
        } elseif ($_POST["sortby"] == 3) {
            $sort_by = " ORDER BY book_id ";
            $query_f = " " . $query . " " . $sort_by . " ASC " ;
            $query_l = " " . $query . " " . $sort_by . " DESC " ;
            $f = getFirstLastBookID($conn, $query_f);
            $l = getFirstLastBookID($conn, $query_l);
            $sort_by .= ' ASC ';
            $sort = ' ORDER BY a.book_id ASC ';
        } elseif ($_POST["sortby"] == 4) {
            $sort_by = " ORDER BY book_id  ";
            $query_f = " " . $query . " " . $sort_by . " DESC " ;
            $query_l = " " . $query . " " . $sort_by . " ASC " ;
            $f = getFirstLastBookID($conn, $query_f);
            $l = getFirstLastBookID($conn, $query_l);
            $sort_by .= ' DESC ';
            $sort = ' ORDER BY a.book_id DESC ';
        }
        $query .= " " . $sort_by . " " ;
    }

    if (isset($_POST["showby"])) {
        if ($_POST["showby"] == 0) {
            // $show_by = count($ref_id_final) ;
            $q_run = '' ;
        } else {
            $show_by = $_POST["showby"];
            $limit = $show_by;
            $page = 1;
            if (isset($_POST['page'])) {
                $page_is = $_POST['page'];
            } else {
                $page_is = 1 ;
            }
            
            if ($page_is > 1) {
                $start = (($page_is - 1) * $limit);
                $page = $page_is;
            } else {
                $start = 0;
            }

            $q_run = " OFFSET ".$start." ROWS FETCH NEXT ".$limit." ROWS ONLY  ";
        }
        $query .= " " . $q_run . " " ;
    }
    $stmt = sqlsrv_query($conn, $select_all.$query);
    if ($stmt === false) {
        die(print_r(sqlsrv_errors(), true));
    }
    $next_on = 'Y' ;
    $searchbybooking = array();
    $num = 0;
    while ($row = sqlsrv_fetch_array($stmt, SQLSRV_FETCH_ASSOC)) {
        $num += 1;
        $searchbybooking[] = $row['book_id'];
        if ($row['book_id'] == $l) {
            $next_on = 'N' ;
        }
    }
    if ($num != 0) {
        $searchbybooking_filter = implode(",", $searchbybooking);
        $data = array();
    
        if (isset($_POST["searchbybooking"])) {
            if (in_array('1', $_POST["searchbybooking"]) && in_array('2', $_POST["searchbybooking"]) && in_array('0', $_POST["searchbybooking"])) {
                $data = $searchbybooking;
            } elseif (in_array('1', $_POST["searchbybooking"]) || in_array('2', $_POST["searchbybooking"]) || in_array('0', $_POST["searchbybooking"])) {
                foreach ($searchbybooking as $book_id_each) {
                    if (checkSatusBook($conn, $book_id_each) == 1  && in_array('1', $_POST["searchbybooking"])) {
                        //จอง
                        // echo  'จอง<br/>';
                        $data[] = $book_id_each;
                    // echo json_encode($data);
                    } elseif (checkSatusBook($conn, $book_id_each) == 2  && in_array('2', $_POST["searchbybooking"])) {
                        //ยืม
                        // echo  'ยืม<br/>';
                        $data[] = $book_id_each;
                    // echo json_encode($data);
                    } elseif (checkSatusBook($conn, $book_id_each) == 0 && in_array('0', $_POST["searchbybooking"])) {
                        //ว่าง
                        // echo  'ว่าง<br/>';
                        $data[] = $book_id_each;
                        // echo json_encode($data);
                    }
                }
            }
        } else {
            $data = $searchbybooking;
        }
        
        if (isset($data) && $data[0] != '') {
            // echo json_encode($data) ;
            $ref_id_final_filter = implode(",", $data);
            $sql_final = " SELECT *, CONVERT(int, a.book_accession_no) AS book_accession_no_int   FROM book_data  a left join data_book_call_classification_100 b on a.book_call_classification_100 = b.book_call_classification_100 where  a.book_id IN (".$ref_id_final_filter.") ".$sort." ";
            $stmt_final = sqlsrv_query($conn, $sql_final);
            if ($stmt_final === false) {
                die(print_r(sqlsrv_errors(), true));
                // $data .= '<input type="hidden" name="count_data" id="count_data" class="form-control" value="'.count($ref_id_final).'">';
            }
            while ($fetch_final = sqlsrv_fetch_array($stmt_final, SQLSRV_FETCH_ASSOC)) {
                $nuber = floor($fetch_final['book_call_classification_id']);
                // echo $fetch_final['book_call_classification_id'].'<br/>';
                $c100 = $fetch_final['book_call_classification_100'];
                if (strlen($nuber) < 3) {
                    $nuber = ' ไม่ระบุ';
                    $c100 = '';
                } else {
                    $nuber = ' [' . $nuber . '] ';
                }
                $data .= '<tr class="overT">';
                
                $data .= '<td class="text-break text-truncate d-sm-none d-none  d-md-table-cell" style="max-width: 20px!important;">';
                $data .= '<spen>#'. $fetch_final['book_accession_no'] . '</spen>';
                $data .= '</td>';
                // $data .= '</tr>';
                // $data .= '<tr>';
                $data .= '<td class="d-none d-sm-table-cell">';
                $data .= getSatusBook($conn, $fetch_final['book_id'])[0] . getSatusBook($conn, $fetch_final['book_id'])[1];
                $data .= '</td>';
                // $data .= '</tr>';
                // $data .= '<tr>';
                $data .= '<td class="text-break text-truncate d-table-cell" style="max-width: 330px!important">';
                $data .='<span class="d-inline-block d-sm-none"> <a href="book_detail.php?ref='.$fetch_final['book_id'].'"  class="btn btn-xs btn-flat btn-outline-secondary"><i class="fas fa-search"></i> </a> </span>';
                $data .= ' <span class="d-inline-block d-sm-none">' .  getSatusBook($conn, $fetch_final['book_id'])[0] . ' </span>';
                $data .= '<span class="d-none d-sm-inline-block"> ' .  getBooklocationName($fetch_final['book_location']). ' </span>';
                $data .= '<spen> '.$fetch_final['book_name'] . '</spen>';
                $data .= '</td>';
                // $data .= '</tr>';
                // $data .= '<tr>';
                $data .= '<td class="d-none d-sm-none d-md-table-cell">';
                $data .= getClassification100Name($conn, $c100) .$nuber;
                $data .= '</td>';
                // $data .= '</tr>';
                // $data .= '<tr>';
                $data .= '<td class="text-right d-none  d-sm-table-cell"  style="">';
                // $data .='  <span>';
                $data .='<a href="book_detail.php?ref='.$fetch_final['book_id'].'" class="btn btn-xs btn-flat btn-outline-secondary"><i class="fas fa-search"></i></a>';
                // $data .='<div class="tools">';
                // $data .='<a href="#"><i class="fas fa-edit"></i></a>';
                // $data .='<i class="fas fa-trash"><i class="far fa-plus-square"></i></i>';
                // $data .='  </div>';
                // $data .='  </span>';
                $data .= '</td >';
                $data .= '</tr>';
            }
            $head = '<div class="card">';
            $head .= '<div class="table-responsive card-body p-0 ">';
            $head .= '<table class="table table-hover text-nowrap m-0 ">';
            $head .= '<thead class="text-center">';
            $head .= '<tr>';
            $head .= '<th class="d-none d-sm-none d-md-table-cell">ทะเบียน</th>';
            $head .= '<th class="d-none d-sm-table-cell">สถานะ</th>';
            $head .= '<th class="d-table-cell">หนังสือ</th>';
            $head .= '<th class="d-none d-sm-none d-md-table-cell">หมวดหนังสือ</th>';
            $head .= '<th class=" d-none  d-sm-table-cell">แก้ไข</th>';
            // $head .= '<th class=""></th>';
            $head .= '</tr>';
            $head .= '</thead>';
            $head .= '<tbody>';
            $head_e =  '<div class="card"><div class="table-responsive card-body p-0 "><table class="table table-hover text-nowrap m-0 ">
            <thead class="text-cente"><tr><th class="">ทะเบียน</th><th class="">สถานะ</th><th class="">หนังสือ</th>
            <th class="">หมวดหนังสือ</th><th class="">แก้ไข</th></tr></thead><tbody>';
            $end = '</tbody></table></div></div> ';
            $ul = '<ul id="pagination" name="pagination"class="pagination pagination-d justify-content-center">';
            $ul .='</ul>';
            $hidden = '<input type="hidden" hidden name="count_all" id="count_all" class="form-control" value="'.count($data).'">';
            // $hidden .= '<input type="hidden" hidden name="filter_data" id="filter_data" class="form-control" value="">';
            // $hidden .=  '<input type="hidden" hidden name="page_data" id="page_data" class="form-control" value="">';
            // $hidden .=  '<input type="hidden" hidden name="page_is" id="page_is" class="form-control" value="'..'">';
            $data =  $ul. str_replace("Array", " ", $head) . $data . $end .$ul.  $hidden;
        } else {
            // $data = '<div id="loading-w" class="text-center">';
            // $data .= '<div class="card card-danger">';
            // $data .= '<div class="card-header">';
            // $data .= '<h3 class="card-title" style="text-align: center !important;float: none;">: ไม่พบข้อมูล :</h3>';
            // $data .= '</div>';
            // $data .= '<div class="card-body">';
            // $data .= '.: กรุณาลองใหม่อีกครั้ง :.';
            // $data .= '</div>';
            // $data .= '<!-- /.card-body -->';
            // $data .= '</div>';
            // $data .= '<!-- /.echocard -->';
            // $data .= '  </div>';
            $data  = 'ERROR_NODATAFOUND';
            $next_on = 'N';
        }
    } else {
        $data  = 'ERROR_NODATAFOUND';
        $next_on = 'N';
    }

    echo str_replace("Array", "", $data) . "####" . $next_on;
// echo ($data). $var;
} elseif ($actions == 4) {
}


if ($_POST["action"] == 'search_data') {
}
