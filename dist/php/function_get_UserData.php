<?php

function getdataStudent($conn, $ref_id)
{
    $sql = " SELECT  * FROM cpw.dbo.student_main where info_id = '$ref_id'";
    $stmt = sqlsrv_query($conn, $sql);
    if ($stmt === false) {
        die(print_r(sqlsrv_errors(), true));
    }
    $row = sqlsrv_fetch_array($stmt, SQLSRV_FETCH_ASSOC);
    return $row;
}


function getdataTeacher($conn, $ref_id)
{
    $sql = " SELECT  * FROM cpw.dbo.teacher_main where tec_id = '$ref_id'";
    $stmt = sqlsrv_query($conn, $sql);
    if ($stmt === false) {
        die(print_r(sqlsrv_errors(), true));
    }
    $row = sqlsrv_fetch_array($stmt, SQLSRV_FETCH_ASSOC);
    return $row;
}

function getdataClassroomStudent($conn , $st_number , $user_class){
    if ($user_class == 1) {
        $sql = " SELECT ro_key2  FROM cpw.dbo.student_main where info_number_std = '$st_number'";
        $stmt = sqlsrv_query($conn, $sql);
        if ($stmt === false) {
            die(print_r(sqlsrv_errors(), true));
        }
        $row = sqlsrv_fetch_array($stmt, SQLSRV_FETCH_ASSOC);
        if (isset($row['ro_key2'])) {
            $sql = " SELECT * FROM cpw.dbo.data_room where ro_key = '".$row['ro_key2']."'";
            $stmt = sqlsrv_query($conn, $sql);
            if ($stmt === false) {
                die(print_r(sqlsrv_errors(), true));
            }
            $row = sqlsrv_fetch_array($stmt, SQLSRV_FETCH_ASSOC);
            $result['ro_name'] = $row['ro_name'];
            $result['ro_name_short'] = $row['ro_name_short'];
            $result['ro_name_eng'] = $row['ro_name_eng'];
            $result['ro_name_eng_short'] = $row['ro_name_eng_short'];
            $result['de_id'] = $row['de_id'];
            $result['le_key'] = $row['le_key'];

            $sql = " SELECT * FROM cpw.dbo.z_new_student where st_number = '$st_number'";
            $stmt = sqlsrv_query($conn, $sql);
            if ($stmt === false) {
                die(print_r(sqlsrv_errors(), true));
            }
            $row = sqlsrv_fetch_array($stmt, SQLSRV_FETCH_ASSOC);
            if(isset($row['rew_id'])) {
               $result['de_level'] = $row['de_level'];
               $result['class'] = $row['le_key'];
               $result['room'] = $row['room'];
               $result['st_num'] = $row['st_num'];
               $sql = " SELECT * FROM cpw.dbo.data_depart where de_level = '".$result['de_level']."' AND  de_id = '".$result['de_id']."' ";
               $stmt = sqlsrv_query($conn, $sql);
               if ($stmt === false) {
                    die(print_r(sqlsrv_errors(), true));
               }
               $row = sqlsrv_fetch_array($stmt, SQLSRV_FETCH_ASSOC);
               $result['de_name'] = $row['de_name'];
               $result['de_name_en'] = $row['de_name_en'];

               $sql = " SELECT * FROM cpw.dbo.data_level where le_key = '".$result['le_key']."'";
               $stmt = sqlsrv_query($conn, $sql);
               if ($stmt === false) {
                  die(print_r(sqlsrv_errors(), true));
               }
               $row = sqlsrv_fetch_array($stmt, SQLSRV_FETCH_ASSOC);
               $result['le_name'] = $row['le_name'];
               $result['le_name_eng'] = $row['le_name_eng'];
               $result['le_name_shot'] = $row['le_name_shot'];
               $result['le_name_eng_shot'] = $row['le_name_eng_shot'];
               $result['outline'] = 'กำลังศึกษาอยู่ในโรงเรียน';
          
            }
        } else {
            $result['outline'] = 'สำเร็จออกจากโรงเรียนแล้ว';
        }
        return $result;
    }
    else {
        return false;
    }

}
function checkedUser($conn, $user_id)
{
     $sql = " SELECT user_id FROM data_user where user_id = '$user_id'  ";
    $stmt = sqlsrv_query($conn, $sql);
    if ($stmt === false) {
        die(print_r(sqlsrv_errors(), true));
    }
   $row = sqlsrv_fetch_array($stmt, SQLSRV_FETCH_ASSOC);

   if(isset($row)){
        return true;
   }
   else{
       return false;
   }
}

function getdataUser($conn)
{
    $sql = " SELECT top 100  * FROM data_user  ";
    $stmt = sqlsrv_query($conn, $sql);
    if ($stmt === false) {
        die(print_r(sqlsrv_errors(), true));
    }
    while ($row = sqlsrv_fetch_array($stmt, SQLSRV_FETCH_ASSOC)) {

        $ref_id  = $row['ref_id'];
        if ($row['user_class'] == 1) { 
            $DataPeople  = getdataStudent($conn, $ref_id);
            $image   = 'https://app.cpw.ac.th/cpw_api_content/images/student/' . $DataPeople['image_pro'];
            $name    = $DataPeople['info_title']. $DataPeople['info_name_th'].' '. $DataPeople['info_lname_th'];
            $userCode  = $DataPeople['info_number_std'];
        }elseif ($row['user_class'] == 2) { 
            $DataPeople  = getdataTeacher($conn, $ref_id);
            $image   = 'https://app.cpw.ac.th/cpw_api_content/images/teacher/' . $DataPeople['tec_image'];
            $name    = $DataPeople['tec_title']. $DataPeople['tec_name'].' '. $DataPeople['tec_lname'];
            $userCode  = $DataPeople['tec_number'];
        }
        if($row['user_stats'] == 1){
            $status   = '<span class="label label-success">ใช้งานได้</span>';
        }else{
            $status   = '<span class="label label-danger">ไม่ให้ใช้งาน</span>';
        }
        $data .= ' <div class="col-lg-4 col-md-6 col-sm-12 col-xs-12"   >';
        $data .= ' <div class="info-box box-hover-shadow" style="">';
        $data .= ' <span class="info-box-icon0 info-box-icon" style="overflow: hidden;"><img src="'.$image.'"  style="top:-50; position: relative;"  class=" image-responsive"   alt="" ></span>';
        $data .= ' <div class="info-box-content">';
        $data .= ' <span class="info-box-text">'.$name.'</span>';
        $data .= ' <span class="info-box-text">รหัสประจำตัว : '.$userCode.'</span>';
        $data .= ' <span class="info-box-text">สถานะ : '.$status.' </span></a>';
        $data .= ' <span class="info-box-text pull-right">';
        $data .= ' <div class="btn-group">';
        $data .= ' <a  href="detail_student.php?user_id='.$row['user_id'].'" class="btn btn-primary btn-sm">ดูรายละเอียด</a>';
        $data .= ' </div>';        
        $data .= ' </span>';
        $data .= ' </div>';
        $data .= ' </div>';
        $data .= ' </div> ';
    }
    return $data ;
}
function getdataDetailUser($conn,$user_id)
{

    $sql = " SELECT * FROM data_user where user_id = '$user_id'  ";
    $stmt = sqlsrv_query($conn, $sql);
    if ($stmt === false) {
        die(print_r(sqlsrv_errors(), true));
    }
   $row = sqlsrv_fetch_array($stmt, SQLSRV_FETCH_ASSOC);

        $ref_id  = $row['ref_id'];
         $data['ref_id'] = $row['ref_id'];
        $data['user_class']  = $row['user_class'];
        if ($row['user_class'] == 1) { 
            $DataPeople  = getdataStudent($conn, $ref_id);
            $data['image']   = 'https://app.cpw.ac.th/cpw_api_content/images/student/' . $DataPeople['image_pro'];
             if($DataPeople['info_name_th'] == ''){
                 $data['name']  = '-';
            }else{
                 $data['name']  = $DataPeople['info_name_th'];//. $DataPeople['info_lname_th'];

            }
            if($DataPeople['info_lname_th'] == ''){
                 $data['lname']  = '-';
            }else{
                 $data['lname']  = $DataPeople['info_lname_th'];
            }
             if($DataPeople['info_title'] == ''){
                 $data['title']  = '-';
            }else{
                 $data['title']  = $DataPeople['info_title'];
            }
            if($DataPeople['info_name_en'] == ''){
                 $data['name_en']  = '-';
            }else{
                 $data['name_en']  = $DataPeople['info_name_en'];
            }
            if($DataPeople['info_lname_en'] == ''){
                 $data['lname_en']  = '-';
            }else{
                 $data['lname_en']  = $DataPeople['info_lname_en'];
            }
            if($DataPeople['info_identification'] == ''){
                 $data['identification']  = '-';
            }else{
                 $data['identification']  = $DataPeople['info_identification'];
            }
            if($DataPeople['gender_key'] == 1){
                 $data['gender'] = 'ชาย (Male)';
            }else if($DataPeople['gender_key'] == 2)  {
                $data['gender'] = 'หญิง (Female)';
            }else {
                 $data['gender'] = '-';
            }
            if($DataPeople['info_race'] == ''){
                 $data['race']  = '-';
            }else{
                 $data['race']  = $DataPeople['info_race'];
            }
            if($DataPeople['info_nationality'] == ''){
                 $data['nationality']  = '-';
            }else{
                 $data['nationality']  = $DataPeople['info_nationality'];
            }
            if($DataPeople['info_religion'] == ''){
                 $data['religion']  = '-';
            }else{
                 $data['religion']  = $DataPeople['info_religion'];
            }
            if($DataPeople['info_number_std'] == ''){
                 $data['userCode']  = '-';
            }else{
                 $data['userCode']  = $DataPeople['info_number_std'];
            }
            if($DataPeople['info_email'] == ''){
                 $data['email']  = '-';
            }else{
                 $data['email']  = $DataPeople['info_email'];
            }
            if($DataPeople['info_number_phone'] == ''){
                 $data['phone']  = '-';
            }else{
                 $data['phone']  = $DataPeople['info_number_phone'];
            }
            //  SPECIAL OPTION DATA
            if($DataPeople['info_nicnaame'] == ''){
                 $data['nicnaame']  = '-';
            }else{
                 $data['nicnaame']  = $DataPeople['info_nicnaame'];
            }
            if($DataPeople['info_birthday'] == ''){
                 $data['birthday']  = '-';
            }else{
                 $data['birthday']  = date_format($DataPeople['info_birthday'],"d/m/Y"); 
            }
            if($DataPeople['info_birthday_bk'] == ''){
                 $data['birthday_bk']  = '-';
            }else{
                 $data['birthday_bk']  = $DataPeople['info_birthday_bk'];
            }
             if($DataPeople['ro_key2'] == ''){
                 $data['classroom']  = '-';
            }else{
                 $data['classroom']  = $DataPeople['ro_key2'];
            }


        }elseif ($row['user_class'] == 2) { 
            $DataPeople  = getdataTeacher($conn, $ref_id);
            $data['image']   = 'https://app.cpw.ac.th/cpw_api_content/images/teacher/' . $DataPeople['tec_image'];
            if($DataPeople['tec_name'] == ''){
                 $data['name']  = '-';
            }else{
                 $data['name']  = $DataPeople['tec_name'];//. $DataPeople['info_lname_th'];
            }
            if($DataPeople['tec_lname'] == ''){
                 $data['lname']  = '-';
            }else{
                 $data['lname']  = $DataPeople['tec_lname'];
            }
             if($DataPeople['tec_title'] == ''){
                 $data['title']  = '-';
            }else{
                 $data['title']  = $DataPeople['tec_title'];
            }
            if($DataPeople['tec_name_en'] == ''){
                 $data['name_en']  = '-';
            }else{
                 $data['name_en']  = $DataPeople['tec_name_en'];
            }
            if($DataPeople['tec_lname_en'] == ''){
                 $data['lname_en']  = '-';
            }else{
                 $data['lname_en']  = $DataPeople['tec_lname_en'];
            }
            if($DataPeople['gender_id'] == 1){
                 $data['gender'] = 'ชาย (Male)';
            }else if($DataPeople['gender_id'] == 2)  {
                $data['gender'] = 'หญิง (Female)';
            }else {
                 $data['gender'] = '-';
            }
            if($DataPeople['tec_iden'] == ''){
                 $data['identification']  = '-';
            }else{
                 $data['identification']  = $DataPeople['tec_iden'];
            }
            if($DataPeople['tec_race'] == ''){
                 $data['race']  = '-';
            }else{
                 $data['race']  = $DataPeople['tec_race'];
            }
            if($DataPeople['tec_nationality'] == ''){
                 $data['nationality']  = '-';
            }else{
                 $data['nationality']  = $DataPeople['tec_nationality'];
            }
            if($DataPeople['tec_religion'] == ''){
                 $data['religion']  = '-';
            }else{
                 $data['religion']  = $DataPeople['tec_religion'];
            }
            if($DataPeople['tec_email'] == ''){
                 $data['email']  = '-';
            }else{
                 $data['email']  = $DataPeople['tec_email'];
            }
            if($DataPeople['tec_phone'] == ''){
                 $data['phone']  = '-';
            }else{
                 $data['phone']  = $DataPeople['tec_phone'];
            }
             if($DataPeople['tec_number'] == ''){
                 $data['userCode']  = '-';
            }else{
                 $data['userCode']  = $DataPeople['tec_number'];
            }
        }

        if($row['user_stats'] == 1){
            $data['status']   = '<span class="badge badge-pill badge-success">ใช้งานได้</span>';
        }else{
            $data['status']   = '<span class="badge badge-pill badge-danger">ไม่ให้ใช้งาน</span>';
        }
        $data['user_id'] = $row['user_id'];
         $data['link'] = 'profile.php?ref='.$row['user_id'].'';
        if(!isset($row)) {
            $data['image'] =  'dist/img/user.png';
            $data['name']    = '-';
            $data['lname']    =  '-';
            $data['title']  = '-';
            $data['lname_en']  = '-';
            $data['name_en']  = '-';
            $data['info_title'] = '';
            $data['userCode'] = '';
            $data['email']  = '-';
            $data['phone']  = '-';
            $data['religion']  = '-';
            $data['nationality']  = '-';
            $data['identification']  = '-';
            $data['race']  = '-';
            $data['gender'] = '-';
         $data['link'] = '#';
        }
 
    return $data;
}

function getdataDetailSpecial($conn,$ref_id,$user_class) {
     if($user_class == 1) {


     }
        $ref_id  = $row['ref_id'];
        $data['user_class']  = $row['user_class'];
        if ($row['user_class'] == 1) { 
            
            if($DataPeople['info_nicnaame'] == ''){
                 $data['nicnaame']  = '-';
            }else{
                 $data['nicnaame']  = $DataPeople['info_nicnaame'];
            }
            if($DataPeople['info_birthday'] == ''){
                 $data['birthday']  = '-';
            }else{
                 $data['birthday']  = date_format($DataPeople['info_birthday'],"d/m/Y"); 
            }
            if($DataPeople['info_birthday_bk'] == ''){
                 $data['birthday_bk']  = '-';
            }else{
                 $data['birthday_bk']  = $DataPeople['info_birthday_bk'];
            }
        }elseif ($row['user_class'] == 2) { 
            $DataPeople  = getdataTeacher($conn, $ref_id);
            $data['image']   = 'https://app.cpw.ac.th/cpw_api_content/images/teacher/' . $DataPeople['tec_image'];
             if($DataPeople['tec_name'] == ''){
                 $data['name']  = '-';
            }else{
                 $data['name']  = $DataPeople['tec_name'];//. $DataPeople['info_lname_th'];

            }
            if($DataPeople['tec_lname'] == ''){
                 $data['lname']  = '-';
            }else{
                 $data['lname']  = $DataPeople['tec_lname'];
            }
             if($DataPeople['tec_title'] == ''){
                 $data['title']  = '-';
            }else{
                 $data['title']  = $DataPeople['tec_title'];
            }
            if($DataPeople['tec_name_en'] == ''){
                 $data['name_en']  = '-';
            }else{
                 $data['name_en']  = $DataPeople['tec_name_en'];
            }
            if($DataPeople['tec_lname_en'] == ''){
                 $data['lname_en']  = '-';
            }else{
                 $data['lname_en']  = $DataPeople['tec_lname_en'];
            }

            $data['nicnaame']  = '-';


            if($DataPeople['gender_id'] == 1){
                 $data['gender'] = 'ชาย (Male)';
            }else if($DataPeople['gender_id'] == 2)  {
                $data['gender'] = 'หญิง (Female)';
            }else {
                 $data['gender'] = '-';
            }
            if($DataPeople['tec_iden'] == ''){
                 $data['identification']  = '-';
            }else{
                 $data['identification']  = $DataPeople['tec_iden'];
            }
                 $data['birthday']  = '-';
                 $data['birthday_bk']  = '-';

            if($DataPeople['tec_race'] == ''){
                 $data['race']  = '-';
            }else{
                 $data['race']  = $DataPeople['tec_race'];
            }
            if($DataPeople['tec_nationality'] == ''){
                 $data['nationality']  = '-';
            }else{
                 $data['nationality']  = $DataPeople['tec_nationality'];
            }
            if($DataPeople['tec_religion'] == ''){
                 $data['religion']  = '-';
            }else{
                 $data['religion']  = $DataPeople['tec_religion'];
            }
            if($DataPeople['tec_email'] == ''){
                 $data['email']  = '-';
            }else{
                 $data['email']  = $DataPeople['tec_email'];
            }
            if($DataPeople['tec_phone'] == ''){
                 $data['phone']  = '-';
            }else{
                 $data['phone']  = $DataPeople['tec_phone'];
            }

             if($DataPeople['tec_number'] == ''){
                 $data['userCode']  = '-';
            }else{
                 $data['userCode']  = $DataPeople['tec_number'];
            }
        }

        if($row['user_stats'] == 1){
            $data['status']   = '<span class="badge badge-pill badge-success">ใช้งานได้</span>';
        }else{
            $data['status']   = '<span class="badge badge-pill badge-danger">ไม่ให้ใช้งาน</span>';
        }
        $data['user_id'] = $row['user_id'];

        if(!isset($row)) {
            $data['image'] =  'dist/img/user.png';
            $data['name']    = 'Name';
            $data['lname']    =  'Lastname';
            $data['info_title'] = '';
            $data['userCode'] = '';
            $data['email']  = '-';
            $data['phone']  = '-';
            $data['religion']  = '-';
            $data['nationality']  = '-';
            $data['identification']  = '-';
            $data['race']  = '-';
            $data['gender'] = '-';
        }
 
    return $data;
}
