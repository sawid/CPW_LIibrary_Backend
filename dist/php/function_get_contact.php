<?php
include('connect_db.php');

function contact_get($conn){
    $sql = " SELECT * FROM data_contact ";
    $stmt = sqlsrv_query($conn, $sql);
    if ($stmt === false) {
        die(print_r(sqlsrv_errors(), true));
    }
    while ($row = sqlsrv_fetch_array($stmt, SQLSRV_FETCH_ASSOC)) {
        $firstname = $row['contact_firstname'];
        $lastname = $row['contact_lastname'];
        $status = $row['contact_status'];
        $facebook = $row['contact_facebook'];
        $instragram = $row['contact_instragram'];
        $twitter = $row['contact_twitter'];
        $call = $row['contact_call'];
        $workplace = $row['contact_workplace'];
        $working = $row['contact_work_position'];
        $picture = $row['contact_picture'];
        $education = $row['contact_descrip'];

        $data .= '<div class="col-12 col-sm-6 col-md-4 align-items-stretch">';
        $data .= '<div class="card bg-light">';
        $data .= '<div class="card-header text-muted border-bottom-0">';
        $data .= $row['contact_position'];
        $data .= '</div>';
        $data .= '<div class="card-body pt-0" style="height: 180px;">';
        $data .= '<div class="row">';
        $data .= '<div class="col-7">';
        $data .= '<h2 class="lead"><b>'. $firstname . '<br> ' . $lastname .'</b></h2>';
        $data .= '<p class="text-muted text-sm"><b>ข้อมูลโดยคร่าว: </b></p>';
        $data .= '<ul class="ml-4 mb-0 fa-ul text-muted">';
        $data .= '<li class="small"><span class="fa-li"><i class="fas fa-lg fa-briefcase"></i></span>';
        $data .= $working;
        $data .= '</li>';
        if($status == 1) {
            $data .= '<li class="small"><span class="fa-li"><i class="fas fa-book fa-lg"></i></span>';
            $data .= $education;
            $data .= '</li>';
        }
        $data .= '<li class="small"><span class="fa-li"><i class="fas fa-university fa-lg"></i></span>';
        $data .= $workplace;
        $data .= '</li>';
        $data .= '</ul>';
        $data .= '</div>';
        $data .= '<div class="col-5 text-center">';

        if($status == 1){
            $data .= '<img src="https://app.cpw.ac.th/cpw_api_content/images/student/'. $picture .'" alt="" class="profile-user-img img-fluid img-square">';
        }
        elseif($status == 2){
            $data .= '<img src="https://app.cpw.ac.th/cpw_api_content/images/teacher/'. $picture .'" alt="" class="profile-user-img img-fluid img-square">';
        }

        $data .= '</div>';
        $data .= '</div>';
        $data .= '</div>';
        $data .= '<div class="card-footer">';
        $data .= '<div class="text-right">';
        if (empty($facebook)) {
            $data .= '<a href="#" class="btn btn-sm bg-blue disabled">';
        }
        else {
            $data .= '<a href="'. $facebook .'" class="btn btn-sm bg-blue">';
        }
        $data .= '<i class="fab fa-facebook-f"></i>';
        $data .= '</a>';
        if (empty($instragram)) {
            $data .= '<a href="#" class="btn btn-sm bg-pink disabled">';
        }
        else {
            $data .= '<a href="'. $instragram .'" class="btn btn-sm bg-pink">';
        }
        $data .= '<i class="fab fa-instagram"></i>';
        $data .= '</a>';
        if (empty($twitter)) {
            $data .= '<a href="#" class="btn btn-sm bg-cyan disabled">';
        }
        else {
            $data .= '<a href="'. $twitter .'" class="btn btn-sm bg-cyan">';
        }
        $data .= '<i class="fab fa-twitter"></i>';
        $data .= '</a>';
        if (empty($call)) {
            $data .= '<a href="#" class="btn btn-sm btn-success disabled">';
        }
        else {
            $data .= '<a href="tel:'. $call .'" class="btn btn-sm btn-success">';
        }
        $data .= '<i class="fas fa-phone-alt"></i>';
        $data .= '</a>';
        $data .= '</div>';
        $data .= '</div>';
        $data .= '</div>';
        $data .= '</div>';


    }



    echo $data;
}

   