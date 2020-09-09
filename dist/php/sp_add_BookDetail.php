<?php

include("connect_db.php");
include("function_CheckTypeFile.php");

$imageLocation = '../../../library_content/images/book/';


$book_id                           = $_POST['book_id'];

$book_accession_no = $_POST['book_accession_no'];
$book_name = $_POST['book_name'];
$book_isbn = $_POST['book_isbn'];
$book_call_classification_id = $_POST['book_call_classification_id'];
$book_public_series = $_POST['book_public_series'];
$book_public_copy = $_POST['book_public_copy'];
$book_public_year = $_POST['book_public_year'];
$book_pages = $_POST['book_pages'];
$book_number_print = $_POST['book_number_print'];
$book_location = $_POST['book_location'];
$book_location_print = $_POST['book_location_print'];
$book_price = $_POST['book_price'];
$book_content_color = $_POST['book_content_color'];
$book_source = $_POST['book_source'];
$book_content_1 = $_POST['book_content_1'];
$book_content_2 = $_POST['book_content_2'];
$book_dep = $_POST['book_dep'];
$book_languge_id = $_POST['book_languge_id'];
$languge_other = trim($_POST['languge_other']);
$Author_name1 = $_POST['Author_name1'];
$Author_name2 = $_POST['Author_name2'];
$publisher_name = $_POST['publisher_name'];
$dateupdat = $_POST['dateupdat'];
$book_call_author_number  = $_POST['book_call_author_number'];
$book_token  = md5(date("YmdHis") . rand(100, 999));
$book_picture = $_FILES['book_picture']['name'];


$book_no                           = str_split($book_call_classification_id);        // แยกเลขหมู่หนังสือ
$book_call_classification_100      =  $book_no[0];
$book_call_classification_10       =  $book_no[1];
$book_call_classification_1        =  $book_no[2];


$sql = " SELECT * FROM data_publisher where publisher_name = '$publisher_name'";
$stmt = sqlsrv_query($conn, $sql);
if ($stmt === false) {
    die(print_r(sqlsrv_errors(), true));
}
$row = sqlsrv_fetch_array($stmt, SQLSRV_FETCH_ASSOC);
$publisher_id  = $row['publisher_id'];

if ($publisher_id == "") {
    $publisher_token  = 'PU' . md5(date("YmdHis") . rand(100, 999));

    $sql = "INSERT INTO [dbo].[data_publisher]([publisher_name],[publisher_token]) VALUES ('$publisher_name','$publisher_token') ";
    $stmt = sqlsrv_query($conn, $sql);
    if ($stmt === false) {
        die(print_r(sqlsrv_errors(), true));
    }


    $sql = " SELECT * FROM data_publisher where publisher_token = '$publisher_token'";
    $stmt = sqlsrv_query($conn, $sql);
    if ($stmt === false) {
        die(print_r(sqlsrv_errors(), true));
    }
    $row = sqlsrv_fetch_array($stmt, SQLSRV_FETCH_ASSOC);
    $publisher_id  = $row['publisher_id'];
}



//    if($book_id == ''){ // insert 

if ($book_picture != '') {

    $filesEx = explode(".", $book_picture);
    $filesEx = end($filesEx);
    if (checkTypeFile($filesEx, 1) == 1) {
        $FileNew    = 'conver_book_' . $book_accession_no . '-' . date("Y_m_d_H_i_s_") . rand(100, 999) . '.' . $filesEx;

        echo move_uploaded_file($_FILES['book_picture']['tmp_name'], $imageLocation . $FileNew);
    }
}
$sql = "INSERT INTO [dbo].[book_data]
                    ([book_accession_no]
                    ,[book_call_classification_100]
                    ,[book_call_classification_10]
                    ,[book_call_classification_1]
                    ,[book_call_classification_id]
                    ,[book_call_author_number]
                    ,[book_public_year]
                    ,[book_public_series]
                    ,[book_public_copy]
                    ,[book_isbn]
                    ,[book_name]
                    ,[book_content_1]
                    ,[book_content_2]
                    ,[book_pages]
                    ,[book_picture]
                    ,[book_price]
                    ,[boo_number]
                    ,[book_dep]
                    ,[book_number_print]
                    ,[book_location_print]
                    ,[publisher_id]
                    ,[book_location]
                    ,[book_source]
                    ,[book_rfid]
                    ,[book_content_color]
                    ,[book_token]
                    ,[book_date])
                    VALUES
                    ('$book_accession_no'
                    ,'$book_call_classification_100'
                    ,'$book_call_classification_10'
                    ,'$book_call_classification_1'
                    ,'$book_call_classification_id'
                    ,'$book_call_author_number'
                    ,'$book_public_year'
                    ,'$book_public_series'
                    ,'$book_public_copy'
                    ,'$book_isbn'
                    ,'$book_name'
                    ,'$book_dep'
                    ,'$book_content_1'
                    ,'$book_content_2'
                    ,'$book_pages'
                    ,'$FileNew'
                    ,'$book_price'
                    ,'$boo_number'
                    ,'$book_number_print'
                    ,'$book_location_print'
                    ,'$publisher_id'
                    ,'$book_location'
                    ,'$book_source'
                    ,'$book_rfid'
                    ,'$book_content_color'
                    ,'$book_token'
                    ,'$book_date'
                    )";
$stmt = sqlsrv_query($conn, $sql);
if ($stmt === false) {
    die(print_r(sqlsrv_errors(), true));
}



$sql = " SELECT * FROM book_data where book_token = '$book_token'";
$stmt = sqlsrv_query($conn, $sql);
if ($stmt === false) {
    die(print_r(sqlsrv_errors(), true));
}
$row = sqlsrv_fetch_array($stmt, SQLSRV_FETCH_ASSOC);
$book_id  = $row['book_id'];


$numLan   = count($book_languge_id);
 
for ($i = 0; $i < $numLan; $i++) {
    $languge_id    = $book_languge_id[$i];
    if ($languge_id == 0) {

        if ($languge_other != '') {

            $sql = "SELECT * FROM data_languge where languge = '$languge_other'";
            $stmt = sqlsrv_query($conn, $sql);
            if ($stmt === false) {
                die(print_r(sqlsrv_errors(), true));
            }
            $row = sqlsrv_fetch_array($stmt, SQLSRV_FETCH_ASSOC);

            $languge_id  = $row['book_lan_id'];
            if ($languge_id == "") {

                $languge_token = "la" . md5(date("YmdHis") . rand(100, 999));

                $sql = "INSERT INTO [dbo].[data_languge] ([languge],[languge_token]) VALUES('$languge_other','$languge_token')";
                $stmt = sqlsrv_query($conn, $sql);
                if ($stmt === false) {
           
                    die(print_r(sqlsrv_errors(), true));
                }

                $sql = "SELECT * FROM data_languge where languge_token = '$languge_token'";
                $stmt = sqlsrv_query($conn, $sql);
                if ($stmt === false) {
                    die(print_r(sqlsrv_errors(), true));
                }
                $row = sqlsrv_fetch_array($stmt, SQLSRV_FETCH_ASSOC);
                $languge_id  = $row['book_lan_id'];
            } 
        }

       
    }
    $sql = "INSERT INTO [dbo].[book_languge] ([book_id],[book_languge_id]) VALUES('$book_id','$languge_id')";
    $stmt = sqlsrv_query($conn, $sql);
    if ($stmt === false) {
        die(print_r(sqlsrv_errors(), true));
    }
}

$numAuthor1   = count($Author_name1);

for ($i = 0; $i <= $numAuthor1; $i++) {
    if ($Author_name1[$i] != "") {



        $sql = "SELECT * FROM cpw_library.dbo.data_Author WHERE Author_name = '$Author_name1[$i]'";
        $stmt = sqlsrv_query($conn, $sql);
        if ($stmt === false) {
            die(print_r(sqlsrv_errors(), true));
        }
        $row = sqlsrv_fetch_array($stmt, SQLSRV_FETCH_ASSOC);

        $Author_id =  $row['Author_id'];
        $bat_text =  $row['Author_name'];

        if ($Author_id == "") {
            $Author_token  = "A1" . md5(date("YmdHis") . rand(100, 999));
            $sql = "INSERT INTO [dbo].[data_Author]([Author_name],[Author_token]) VALUES ('$Author_name1[$i]','$Author_token') ";
            $stmt = sqlsrv_query($conn, $sql);
            if ($stmt === false) {
                die(print_r(sqlsrv_errors(), true));
            }


            $sql = "SELECT * FROM cpw_library.dbo.data_Author WHERE Author_token = '$Author_token'";
            $stmt = sqlsrv_query($conn, $sql);
            if ($stmt === false) {
                die(print_r(sqlsrv_errors(), true));
            }
            $row = sqlsrv_fetch_array($stmt, SQLSRV_FETCH_ASSOC);
            $Author_id =  $row['Author_id'];
            $bat_text =  $row['Author_name'];
        }

        $sql = "INSERT INTO [dbo].[book_Author_Translator] ([book_id],[bat_type],[Author_id],[bat_text])  VALUES('$book_id',1,'$Author_id','$bat_text')";
        $stmt = sqlsrv_query($conn, $sql);
        if ($stmt === false) {
            die(print_r(sqlsrv_errors(), true));
        }
    }
}



$numAuthor2   = count($Author_name2);

for ($i = 0; $i <= $numAuthor2; $i++) {
    if ($Author_name1[$i] != "") {
        $sql = "SELECT * FROM cpw_library.dbo.data_Author WHERE Author_name = '$Author_name2[$i]'";
        $stmt = sqlsrv_query($conn, $sql);
        if ($stmt === false) {
            die(print_r(sqlsrv_errors(), true));
        }
        $row = sqlsrv_fetch_array($stmt, SQLSRV_FETCH_ASSOC);

        $Author_id =  $row['Author_id'];
        $bat_text =  $row['Author_name'];

        if ($Author_id == "") {
            $Author_token  = "A2" . md5(date("YmdHis") . rand(100, 999));
            $sql = "INSERT INTO [dbo].[data_Author]([Author_name],[Author_token]) VALUES ('$Author_name2[$i]','$Author_token') ";
            $stmt = sqlsrv_query($conn, $sql);
            if ($stmt === false) {
                die(print_r(sqlsrv_errors(), true));
            }


            $sql = "SELECT * FROM cpw_library.dbo.data_Author WHERE Author_token = '$Author_token'";
            $stmt = sqlsrv_query($conn, $sql);
            if ($stmt === false) {
                die(print_r(sqlsrv_errors(), true));
            }
            $row = sqlsrv_fetch_array($stmt, SQLSRV_FETCH_ASSOC);
            $Author_id =  $row['Author_id'];
            $bat_text =  $row['Author_name'];
        }

        $sql = "INSERT INTO [dbo].[book_Author_Translator] ([book_id],[bat_type],[Author_id],[bat_text])  VALUES('$book_id',2,'$Author_id','$bat_text')";

        $stmt = sqlsrv_query($conn, $sql);
        if ($stmt === false) {
            die(print_r(sqlsrv_errors(), true));
        }
    }
}
            




