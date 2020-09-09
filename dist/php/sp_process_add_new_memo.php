<?php
include('connect_db.php');
$texts = $_POST['texts'];
$user_id_memo = 0;
$memo_status = 1;
if (strlen((string)$texts) == 0) {
   echo "emptytextbox";
}
else {
   $sql = " INSERT INTO [data_comment]
   ([texts],[user_id],[book_id]
    )
    VALUES(
    '$texts','$user_id_memo','$memo_status'
    ) ";

$stmt = sqlsrv_query($conn, $sql);
if ($stmt === false) {
die(print_r(sqlsrv_errors(), true));
}
echo 'textboxsuccess' ;
}