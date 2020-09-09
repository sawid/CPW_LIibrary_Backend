<?php
include('connect_db.php');
$rev = $_GET['rev'];
if ($rev == 1)
{
    $temp = 1;
    $sql = " SELECT * FROM data_comment WHERE book_id = '1' ";
    $stmt = sqlsrv_query($conn, $sql);
    if ($stmt === false) {
        die(print_r(sqlsrv_errors(), true));
    }
    while ($row = sqlsrv_fetch_array($stmt, SQLSRV_FETCH_ASSOC)) {
        $delete_id = $row['text_id'];
        $user_id = $row['user_id'];
        if ($user_id == 0){
            $data .= '<li>';
        }
        elseif ($user_id == 1){
            $data .= '<li class="done">';
        }
        $data .= '<span>';
        $data .= '<i class="fas fa-ellipsis-v"></i>';
        $data .= '<i class="fas fa-ellipsis-v"></i>';
        $data .= '</span>';
        $data .= '<div class="icheck-primary d-inline ml-2">';
        if ($user_id == 0){
            $data .= '<input type="checkbox" value="" name="todo1" onchange="checkbox(this)" id="' .$row['text_id'] . '">';
        }
        elseif ($user_id == 1){
            $data .= '<input type="checkbox" value="" name="todo1" onchange="checkbox(this)" id="' .$row['text_id'] . '" checked>';
        }
        $data .= '<label for="' .$row['text_id'] . '"></label>';
        $data .= '</div>'; 
        if ($user_id == 0){
            $data .= '<span class="text text-break">';
        }
        elseif ($user_id == 1){
            $data .= '(ดำเนินการแล้ว) <span class="text text-break">';
        }       
        $data .= $row['texts'];        
        $data .= '</span>';
        $data .= '<small class="badge badge-danger"><i class="far fa-clock"></i>14.02.2563</small>';
        $data .= '<div class="tools">';
        $data .= '<button id="' .$row['text_id'] . '" onClick="deleteMemo(this.id)" class="btn btn-danger btn-xs"><i class="fas fa-trash"></i></button>';
        $data .= '</div>';
        $data .= '</li>';
    }



    echo $data;
}
