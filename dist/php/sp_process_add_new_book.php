<?php
include('function_CheckTypeFile.php');
include('connect_db.php');
$actions = $_POST['actions'];
$isbn = $_POST['isbn'];
$book_accession_no = trim($_POST['book_accession_no']);
$seclected = $_POST['seclected'];
$book_call_classification_100 = '';
$book_call_classification_10= '';
$book_call_classification_1 = '';
$book_call_classification_id = '';
$book_call_author_number = '';
$book_public_year= '';
$book_isbn= '';
$book_name= '';
$book_content_1= '';
$book_content_2= '';
$book_pages= '';
$book_picture= '';
$book_price= '';
$publisher_id= '';
$book_location_print= '';
$book_publisher= '';
$book_content_color= '';
$book_dep= '';
$book_date= '';
$authors;
$book_id = '';
    $imageLocation = '../../../library_content/images/book/';
    // $imageLocation = 'https://app.cpw.ac.th/library_content/images/book/';
//str_replace("'","''",)

if ($actions == 'INSERT_New_BOOK') {
    $book_token  = 'BK' . md5(date("YmdHis") . rand(100, 999));

    $sql = "INSERT INTO [dbo].[book_data]([book_token],[book_date],[book_accession_no])
                    VALUES('$book_token',GETDATE(),'".$book_accession_no."')";
    $stmt = sqlsrv_query($conn, $sql);
    if ($stmt === false) {
        die(print_r(sqlsrv_errors(), true));
    }
    $sql = "SELECT TOP(1) book_id FROM cpw_library.dbo.book_data ORDER BY book_id desc";
    $stmt = sqlsrv_query($conn, $sql);
    if ($stmt === false) {
        die(print_r(sqlsrv_errors(), true));
    }
    $row = sqlsrv_fetch_array($stmt, SQLSRV_FETCH_ASSOC);
    $book_id = $row['book_id'];
    if ($seclected == '1') {
        //https://www.phpclasses.org/package/9938-PHP-Search-for-books-using-Google-Books-API.html
        //https://itqna.net/questions/5973/search-details-book-google-books-api-php
        $var1 = "https://www.googleapis.com/books/v1/volumes?q=isbn:";
        // $var2 = urlencode($_POST['search']);
        $page = $var1.$isbn;
        $page = file_get_contents($page);
        $data = json_decode($page, true);
        if (!is_null($data['items'][0]['volumeInfo']['title'])) {
            $book_name= str_replace("'", "''", $data['items'][0]['volumeInfo']['title']);
        }
        if (!is_null($data['items'][0]['volumeInfo']['authors'])) {
            $authors= $data['items'][0]['volumeInfo']['authors'];
        }
 
        if (!is_null($data['items'][0]['volumeInfo']['publisher'])) {
            $book_publisher= str_replace("'", "''", $data['items'][0]['volumeInfo']['publisher']);
        }
        if (!is_null($data['items'][0]['volumeInfo']['publishedDate'])) {
            $book_public_year= $data['items'][0]['volumeInfo']['publishedDate'];
            $book_public_year=  trim($book_public_year);
            $book_public_year_a = str_split($book_public_year, 4);
            $book_public_year= ((int) $book_public_year_a[0])+543;
            // $book_public_year= ((string) $book_public_year);

        }
        if (!is_null($data['items'][0]['id'])) {
            $idG= str_replace("'", "''", $data['items'][0]['id']);
        }
        if (!is_null($data['items'][0]['volumeInfo']['description'])) {
            $book_dep= str_replace("'", "''", $data['items'][0]['volumeInfo']['description']);
        }
        if (!is_null($data['items'][0]['volumeInfo']['pageCount'])) {
            $book_pages= str_replace("'", "''", $data['items'][0]['volumeInfo']['pageCount']);
        }
        if (!is_null($data['items'][0]['saleInfo']['listPrice']['amount'])) {
            $book_price= str_replace("'", "''", $data['items'][0]['saleInfo']['listPrice']['amount']);
        }
        if (!is_null($data['items'][0]['volumeInfo']['categories'][0])) {
            $book_content_1= str_replace("'", "''", $data['items'][0]['volumeInfo']['categories'][0]);
        }
        // if (!is_null($data['items'][0]['volumeInfo']['industryIdentifiers'])) {
        //     for($i=0 ; $i < 2 ; $i++){
        //         if($data['items'][0]['volumeInfo']['industryIdentifiers'][$i]['type'] == 'ISBN_13'){
        //          $book_isbn =  $data['items'][0]['volumeInfo']['industryIdentifiers'][$i]['identifier'];
        //         }
        //     }
        // }
        // echo $book_public_year;


        if (!is_null($data['items'][0]['volumeInfo']['imageLinks'])) {
            // $book_picture= $data['items'][0]['volumeInfo']['imageLinks'];
            $book_picture= 'w';
        }
        $sql = " SELECT * FROM data_publisher where publisher_name = '$book_publisher'";
        $stmt = sqlsrv_query($conn, $sql);
        if ($stmt === false) {
            die(print_r(sqlsrv_errors(), true));
        }
        $row = sqlsrv_fetch_array($stmt, SQLSRV_FETCH_ASSOC);
        $publisher_id  = $row['publisher_id'];

        if ($publisher_id == "") {
            $publisher_token  = 'PU' . md5(date("YmdHis") . rand(100, 999));
            $sql = "INSERT INTO [dbo].[data_publisher]([publisher_name],[publisher_token]) VALUES ('$book_publisher','$publisher_token') ";
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
        // if ($book_picture != '') {
        //     $FileNew    = 'conver_book_' .$book_id . '-' . date("Y_m_d_H_i_s_") . rand(100, 999) . '.jpg';
        //     $dataF = file_get_contents('https://books.google.com/books/content?id='.$idG.'&printsec=frontcover&img=1&zoom=6');
        //     $new =  $imageLocation . $FileNew ;
        //     file_put_contents($new, $dataF);
        // }
        if ($authors != '') {
            for ($i = 0; $i < count($authors) ; $i++) {
                if (trim($authors[$i]) != "") {
                    $sql = "SELECT * FROM cpw_library.dbo.data_Author WHERE Author_name = '$authors[$i]'";
                    $stmt = sqlsrv_query($conn, $sql);
                    if ($stmt === false) {
                        die(print_r(sqlsrv_errors(), true));
                    }
                    $row = sqlsrv_fetch_array($stmt, SQLSRV_FETCH_ASSOC);
                    $Author_id =  $row['Author_id'];
                    $bat_text =  $row['Author_name'];
                    if ($Author_id == "") {
                        $Author_token  = "A1" . md5(date("YmdHis") . rand(100, 999));
                        $sql = "INSERT INTO [dbo].[data_Author]([Author_name],[Author_token]) VALUES ('$authors[$i]','$Author_token') ";
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
        }
        // ,book_picture='$FileNew'
    
        $sql = "UPDATE book_data SET 
                    book_public_year =$book_public_year
                    ,book_isbn ='$isbn'
                    ,book_name='$book_name'
                    ,book_dep='$book_dep'
                    ,book_content_1='$book_content_1'
                    ,book_pages='$book_pages'
                    ,book_price='$book_price'
                    ,publisher_id='$publisher_id'
                  WHERE book_id = '$book_id'";
        $stmt = sqlsrv_query($conn, $sql);
        if ($stmt === false) {
            die(print_r(sqlsrv_errors(), true));
        }
    } elseif ($seclected == '2') {
        $where = " where a.book_isbn like '%".trim($isbn)."%'";
        $sql = " SELECT TOP (1) * FROM book_data a ".$where."";
        $stmt = sqlsrv_query($conn, $sql);
        if ($stmt === false) {
            die(print_r(sqlsrv_errors(), true));
        }
        $row = sqlsrv_fetch_array($stmt, SQLSRV_FETCH_ASSOC);
        if (!is_null($row['book_call_classification_100'])) {
            $book_call_classification_100 = trim($row['book_call_classification_100']);
        }
        if (!is_null($row['book_call_classification_10'])) {
            $book_call_classification_10=  trim($row['book_call_classification_10']);
        }
        if (!is_null($row['book_call_classification_1'])) {
            $book_call_classification_1 =  trim($row['book_call_classification_1']);
        }
        if (!is_null($row['book_call_classification_id'])) {
            $book_call_classification_id =  trim($row['book_call_classification_id']);
        }
        if (!is_null($row['book_call_author_number'])) {
            $book_call_author_number =  trim($row['book_call_author_number']);
        }
        if (!is_null($row['book_public_year'])) {
            $book_public_year=  trim($row['book_public_year']);
        }
        if (!is_null($row['book_isbn'])) {
            $book_isbn=  trim($row['book_isbn']);
        }
        if (!is_null($row['book_name'])) {
            $book_name=  str_replace("'", "''", trim($row['book_name']));
        }
        if (!is_null($row['book_content_1'])) {
            $book_content_1= str_replace("'", "''", trim($row['book_content_1']));
        }
        if (!is_null($row['book_content_2'])) {
            $book_content_2= str_replace("'", "''", trim($row['book_content_2']));
        }
        if (!is_null($row['book_pages'])) {
            $book_pages= trim($row['book_pages']);
        }
        if (!empty($row['book_picture'])) {
            $book_picture= trim($row['book_picture']);
        }
        if (!is_null($row['book_price'])) {
            $book_price= trim($row['book_price']);
        }
        if (!is_null($row['publisher_id'])) {
            $publisher_id= trim($row['publisher_id']);
        }
        if (!is_null($row['book_location_print'])) {
            $book_location_print= str_replace("'", "''", trim($row['book_location_print']));
        }
        if (!is_null($row['book_publisher'])) {
            $book_publisher =trim($row['book_publisher']);
        }
        if (!is_null($row['book_content_color'])) {
            $book_content_color= trim($row['book_content_color']);
        }
        if (!is_null($row['book_dep'])) {
            $book_dep= str_replace("'", "''", trim($row['book_dep']));
        }
        if (!is_null($row['book_id'])) {
            $book_id_clone = $row['book_id'];
        }


        $sql = "SELECT * FROM book_languge where book_id = '$book_id_clone'";
        $stmt = sqlsrv_query($conn, $sql);
        if ($stmt === false) {
            die(print_r(sqlsrv_errors(), true));
        }
        while ($languageC = sqlsrv_fetch_array($stmt, SQLSRV_FETCH_ASSOC)) {
            $book_languge_id = $languageC['book_languge_id'] ;
            $sql = "INSERT INTO [dbo].[book_languge] ([book_id],[book_languge_id]) VALUES('$book_id','$book_languge_id')";
            $stmt = sqlsrv_query($conn, $sql);
            if ($stmt === false) {
                die(print_r(sqlsrv_errors(), true));
            }
        }
        $sql = "SELECT * FROM [cpw_library].[dbo].[book_Author_Translator] where book_id = '$book_id_clone'";
        $stmt = sqlsrv_query($conn, $sql);
        if ($stmt === false) {
            die(print_r(sqlsrv_errors(), true));
        }
        while ($authorC = sqlsrv_fetch_array($stmt, SQLSRV_FETCH_ASSOC)) {
            $bat_text= trim($authorC['bat_text']);
            $Author_id=  $authorC['Author_id'];
            $bat_type= $authorC['bat_type'];
            if (trim($authorC['bat_text'])!= '') {
                $sql = "INSERT INTO [cpw_library].[dbo].[book_Author_Translator]([book_id],[bat_type],[Author_id],[bat_text])  VALUES('$book_id','$bat_type','$Author_id','$bat_text')";
                $stmt = sqlsrv_query($conn, $sql);
                if ($stmt === false) {
                    die(print_r(sqlsrv_errors(), true));
                }
            }
        }
        $sql = "UPDATE book_data SET book_call_classification_100 ='$book_call_classification_100'
                    ,book_call_classification_10 ='$book_call_classification_10'
                    ,book_call_classification_1='$book_call_classification_1'
                    ,book_call_classification_id='$book_call_classification_id'
                    ,book_call_author_number='$book_call_author_number'
                    ,book_content_2='$book_content_2'
                    ,book_publisher='$book_publisher'
                    ,book_location_print='$book_location_print'
                    ,book_public_year ='$book_public_year'
                    ,book_isbn ='$book_isbn'
                    ,book_name='$book_name'
                    ,book_dep='$book_dep'
                    ,book_content_1='$book_content_1'
                    ,book_pages='$book_pages'
                    ,book_picture='$book_picture'
                    ,book_price='$book_price'
                    ,publisher_id='$publisher_id'
                    ,book_content_color='$book_content_color'
                  WHERE book_id = '$book_id'";
        $stmt = sqlsrv_query($conn, $sql);
        if ($stmt === false) {
            die(print_r(sqlsrv_errors(), true));
        }
    }
    echo $book_id;
} elseif ($actions == 'getCPWLAS') {
    $where = " where book_isbn like '%".trim($isbn)."%'";
    $sql = " SELECT TOP (1) book_id FROM book_data  ".$where."";
    $stmt = sqlsrv_query($conn, $sql);
    if ($stmt === false) {
        die(print_r(sqlsrv_errors(), true));
    }
    $row = sqlsrv_fetch_array($stmt, SQLSRV_FETCH_ASSOC);
    if (is_null($row['book_id'])) {
        echo json_encode(0);
    } else {
        echo json_encode(1);
    }
} elseif ($actions == 'checkBAccessionN') {
    $where = " where book_accession_no = '".trim($book_accession_no)."'";
    $sql = " SELECT TOP (1) book_id FROM book_data  ".$where."";
    $stmt = sqlsrv_query($conn, $sql);
    if ($stmt === false) {
        die(print_r(sqlsrv_errors(), true));
    }
    $row = sqlsrv_fetch_array($stmt, SQLSRV_FETCH_ASSOC);
    if (is_null($row['book_id'])) {
        echo json_encode(1);
    } else {
        echo json_encode(0);
    }
}
