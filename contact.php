<!DOCTYPE html>
<html>

<head>

    <title>CPW.LAS: Contact</title>
    <?php
  include('dist/php/link_main_taghead.php');
  ?>

</head>



<body class="hold-transition sidebar-mini layout-fixed scrollbarB">
    <div class="wrapper">
        <?php
  include('dist/php/connect_db.php');
  include('dist/php/function_get_UserData.php');
  include('dist/php/function_get_statistic.php');
  include('dist/php/function_get_contact.php');
  include('dist/php/link_main_body.php');
  ?>

        <script>

        </script>




        <!-- Content Wrapper. Contains page content -->
        <div class="content-wrapper">
            <!-- Content Header (Page header) -->
            <div class="content-header">
                <div class="container-fluid">
                    <div class="row mb-2">
                        <div class="col-sm-6">
                            <h1 class="m-0 text-dark">Contact</h1>
                        </div><!-- /.col -->
                        <div class="col-sm-6">
                            <ol class="breadcrumb float-sm-right">
                                <li class="breadcrumb-item"><a href="index.php"><i class="fas fa-folder-open"></i>
                                        Home</a></li>
                                </li>
                                <li class="breadcrumb-item active">Contact</li>
                            </ol>
                        </div><!-- /.col -->
                    </div><!-- /.row -->
                </div><!-- /.container-fluid -->
            </div>
            <!-- /.content-header -->

            <!-- Main content -->
            <section class="content">
                <section class="content">

                    <!-- Default box -->
                    <div class="card card-solid">
                        <div class="card-body pb-0">
                            <div class="row d-flex align-items-stretch">

                                <?php echo contact_get($conn) ;?>

                            </div>
                        </div>
                        <!-- /.card-body -->

                        <!-- /.card-footer -->
                    </div>

                    <!-- /.card -->

                </section>
            </section>
            <!-- /.content -->
        </div>
        <!-- /.content-wrapper -->
        <?php include('dist/php/main_footer.php') ?>


    </div>
    <!-- ./wrapper -->
    <?php include('dist/php/link_main_function_js.php') ?>
    <!-- AdminLTE dashboard demo (This is only for demo purposes) -->
    <!-- <script src="dist/js/pages/dashboard.js"></script> -->
    <!-- AdminLTE for demo purposes -->
    <script src="dist/js/demo.js"></script>
    <script src="dist/js/function_contact.js"></script>
</body>

</html>