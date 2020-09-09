<?php
// session_start();
include('function_Pagination.php');
include('connect_db.php');
include('function_get_BookData.php');
$actions = $_POST['actions'];

if ($actions == '1') {
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
        }
        elseif ($_POST["sortby"] == 3) {
            $sort_by = " ORDER BY book_id ASC ";
        }
        elseif ($_POST["sortby"] == 4) {
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
        $data .= '<td>';
        $data .= '<spen class="text-break">'.$fetch_final['book_name'] . '</spen>';
        $data .= '</td>';
        // $data .= '</tr>';
        // $data .= '<tr>';
        $data .= '<td>';
        $data .= getClassification100Name($conn,$fetch_final['book_call_classification_100']) .'['  .floor($fetch_final['book_call_classification_id']) . ']';
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
        $head = '<div class="table-responsive card-body p-0 ">';
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
        $end = '</tbody></table></div>';
        $data = $head . $data . $end;
    }
    echo $data;





} elseif ($actions == '3') {
    $search  = str_replace("'", " ", trim($_POST["search"]));
    $search = str_replace(' ', '%', $search);
    $query = " SELECT   * FROM cpw_library.dbo.book_data WHERE (";
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
        $searchbymo_filter = implode(",", $_POST["searchbymo"]);
        $query .= " AND ( book_call_classification_100 IN (" . $searchbymo_filter . ") ) ";
    }
    if (isset($_POST["searchbyplace"])) {
        $searchbyplace_filter = implode(",", $_POST["searchbyplace"]);
        $query .= " AND ( book_location IN (" . $searchbyplace_filter . ") ) ";
    }
    $stmt = sqlsrv_query($conn, $query);
    if ($stmt === false) {
        die(print_r(sqlsrv_errors(), true));
    }
    $searchbybooking = array();
    $num = 0;
    while ($row = sqlsrv_fetch_array($stmt, SQLSRV_FETCH_ASSOC)) {
        $num += 1;
        $searchbybooking[] = $row['book_id'];
    }
    $searchbybooking_filter = implode(",", $searchbybooking);
    $data = array();
    // print_r($searchbybooking);
    // echo json_encode($_POST["searchbybooking"]);
    // echo json_encode($_POST["searchbymo"]);
    // echo json_encode($_POST["searchbyplace"]);


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
                } elseif (checkSatusBook($conn, $book_id_each) == 2  && in_array('2', $_POST["searchbybooking"]) ) {
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
    } 
    else {

        $data = $searchbybooking;
    }
   
    echo json_encode($data);
} elseif ($actions == 4) {
}


if ($_POST["action"] == 'search_data') {
}
