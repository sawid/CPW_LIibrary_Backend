<?php
include('connect_db.php');
$actions = $_POST['actions'];

if ($actions == 1) {
    // $searchby = $_POST["searchby"];
    if (isset($_POST['ref_id_final'])) {
        $ref_id_final = $_POST['ref_id_final'];
        $ref_id_final = explode(",", $ref_id_final);
        $totoal = count($ref_id_final);
    } else {
        $totoal = $_POST['totoal'];
    }
    $page = $_POST['page'];
    if (isset($_POST["showby"])) {
        if ($_POST["showby"] == 0) {
            $show_by = $totoal;
        } else {
            $show_by = $_POST["showby"];
        }
    }
    $total_data = $totoal;
    $limit = $show_by;
    $total_links = ceil($totoal/$limit);
    $previous_link = '';
    $next_link = '';
    $page_link = '';

    //echo $total_links;
    if ($total_links > 4) {
        if ($page < 5) {
            for ($count = 1; $count <= 5; $count++) {
                $page_array[] = $count;
            }
            $page_array[] = '...';
            $page_array[] = $total_links;
        } else {
            $end_limit = $total_links - 5;
            if ($page > $end_limit) {
                $page_array[] = 1;
                $page_array[] = '...';
                for ($count = $end_limit; $count <= $total_links; $count++) {
                    $page_array[] = $count;
                }
            } else {
                $page_array[] = 1;
                $page_array[] = '...';
                for ($count = $page - 1; $count <= $page + 1; $count++) {
                    $page_array[] = $count;
                }
                $page_array[] = '...';
                $page_array[] = $total_links;
            }
        }
    } else {
        for ($count = 1; $count <= $total_links; $count++) {
            $page_array[] = $count;
        }
    }

    for ($count = 0; $count < count($page_array); $count++) {
        if ($page == $page_array[$count]) {
            $page_link .= '
    <li class="page-item active">
      <a class="page-link" href="#">'.$page_array[$count].' <span class="sr-only">(current)</span></a>
    </li>
    ';

            $previous_id = $page_array[$count] - 1;
            if ($previous_id > 0) {
                $previous_link = '<li class="page-item"><a class="page-link page-link-c" href="javascript:void(0)" data-page_number="'.$previous_id.'">Previous</a></li>';
            } else {
                $previous_link = '
      <li class="page-item disabled">
        <a class="page-link " href="#">Previous</a>
      </li>
      ';
            }
            $next_id = $page_array[$count] + 1;
            if ($next_id > $total_links) {
                $next_link = '
      <li class="page-item disabled">
        <a class="page-link" href="#">Next</a>
      </li>
        ';
            } else {
                $next_link = '<li class="page-item"><a class="page-link page-link-c" href="javascript:void(0)" data-page_number="'.$next_id.'">Next</a></li>';
            }
        } else {
            if ($page_array[$count] == '...') {
                $page_link .= '
      <li class="page-item disabled">
          <a class="page-link " href="#">...</a>
      </li>
      ';
            } else {
                $page_link .= '
      <li class="page-item"><a class="page-link page-link-c" href="javascript:void(0)" data-page_number="'.$page_array[$count].'">'.$page_array[$count].'</a></li>
      ';
            }
        }
    }
    $tag_o = '<ul id="pagination_ul" name="pagination_ul" class="pagination justify-content-center">';
    $tag_end = '</ul>';
    $output = $tag_o .$previous_link . $page_link . $next_link . $tag_end;
  
    echo $output;
} elseif ($actions == 2) {
    // $searchby = $_POST["searchby"];
    $page = $_POST['page'];
    $next_on = $_POST['next_on'];
    $previous_link = '';
    $next_link = '';
    $page_link = '';
    $previous_id = $page - 1;
    $next_id = $page + 1;
    if ($page == 1) {
        $previous_link = '
      <li class="page-item disabled" disabled>
        <a class="page-link " href="#">Previous</a>
      </li>
      ';
    } else {
        $previous_link = '<li class="page-item"><a class="page-link page-link-c" href="javascript:void(0)" data-page_number="'.$previous_id.'">Previous</a></li>';
    }

    $page_link .= '
    <li class="page-item active">
      <a class="page-link" href="#">'.$page.' <span class="sr-only">(current)</span></a>
    </li>
    ';
    if ($next_on == 'N') {
        $next_link = '
      <li class="page-item disabled" disabled>
        <a class="page-link" href="#">Next</a>
      </li>
        ';
    } else {
        $next_link = '<li class="page-item"><a class="page-link page-link-c" href="javascript:void(0)" data-page_number="'.$next_id.'">Next</a></li>';
    }
   
    $tag_o = '<ul id="pagination_ul" name="pagination_ul" class="pagination justify-content-center">';
    $tag_end = '</ul>';
    $output = $tag_o .$previous_link . $page_link . $next_link . $tag_end;
  
    echo $output;
}
