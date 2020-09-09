<!DOCTYPE html>
<html>

<head>
    <title>CPW.LAS: Book Storage</title>
    <?php
  include('dist/php/link_main_taghead.php');
  ?>
    <link rel="stylesheet" href="plugins/bootstrap-select/dist/css/bootstrap-select.min.css">
</head>

<body class="hold-transition sidebar-mini layout-fixed scrollbarB">
    <div class="wrapper">
        <?php
include('dist/php/connect_db.php');
include('dist/php/function_get_UserData.php');
include('dist/php/function_get_BookData.php');
include('dist/php/link_main_body.php');
  ?>

        <!-- Content Wrapper. Contains page content -->
        <div class="content-wrapper">
            <!-- Content Header (Page header) -->
            <div class="content-header">
                <div class="container-fluid">
                    <div class="row mb-2">
                        <div class="col-sm-6">
                            <h1 class="m-0 text-dark">APPEND Management</h1>
                        </div><!-- /.col -->

                    </div><!-- /.row -->
                </div><!-- /.container-fluid -->
            </div>
            <!-- /.content-header -->

            <!-- Main content -->
            <section class="content">
                <div class="container-fluid">

                    <!-- Main row -->
                    <div class="row">
                        <div class="card col-12">
                            <div class="card-body" id="appx">
                                <?php

    $query = " SELECT * FROM cpw_library.dbo.book_data WHERE (NOT(book_call_classification_id  = '')) AND (book_id BETWEEN 2779 AND 2999) ORDER BY book_id DESC ";
    $stmt = sqlsrv_query($conn, $query);
    if ($stmt === false) {
        die(print_r(sqlsrv_errors(), true));
    }
    
    while ($row = sqlsrv_fetch_array($stmt, SQLSRV_FETCH_ASSOC)) {
        $r = floor($row['book_call_classification_id']);
        $a = (string)$r;
        $book_id = $row['book_id'];
        if (strlen($r) < 2) {
            echo '<p class="text-break">'.$row['book_id'].'> NO.'.$row['book_accession_no'].' > '.$rrow['book_call_classification_id'].' / '.$r.' / LEN NOT EG </p><br/>';
        } 
        else {
            $querys = " UPDATE cpw_library.dbo.book_data SET [book_call_classification_100] = '$a[0]',[book_call_classification_10] ='$a[1]'
      ,[book_call_classification_1] = '$a[2]', [data_update] = GETDATE() WHERE book_id = '$book_id'";
            $stmtw = sqlsrv_query($conn, $querys);
            if ($stmtw === false) {
                die(print_r(sqlsrv_errors(), true));
            }
            echo '<p class="text-break">'.$row['book_id'].'> NO.'.$row['book_accession_no'].' > '.$row['book_call_classification_id'].' / '.$r.' / ENG / '.$a[0].' / ' .$a[1]. ' / ' .$a[2].' >> <b class="text-red">COM!</b></p><br/>';

        }
    }
            echo '<p class="text-break text-green">SUCCESS</p><br/>';

 ?>

                            </div>
                        </div>


                    </div>
                </div>



            </section>
            <!-- /.content -->
        </div>
        <!-- /.content-wrapper -->
        <?php include('dist/php/main_footer.php') ?>

    </div>
    <!-- ./wrapper -->
    <?php include('dist/php/link_main_function_js.php') ;?>
    <!-- Latest compiled and minified JavaScript -->
    <script src="plugins/bootstrap-select/dist/js/bootstrap-select.min.js"></script>
    <!-- (Optional) Latest compiled and minified JavaScript translation files -->
    <script src="plugins/bootstrap-select/dist/js/i18n/defaults-*.min.js"></script>

</body>

</html>