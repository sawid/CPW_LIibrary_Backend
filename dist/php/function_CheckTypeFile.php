<?php


function checkTypeFile($filesEx,$typeFile){
    if($typeFile == 1){ // images
        if($filesEx == 'jpg' || $filesEx == 'png' || $filesEx == 'gif' || $filesEx == 'jpge' || $filesEx == 'JPG' || $filesEx == 'PNG' || $filesEx == 'GIF' || $filesEx == 'JPGE'){
            return 1;
        }else{
            return 0;
        }
    }elseif($typeFile == 2){
        if($filesEx == 'pdf' || $filesEx == 'doc' || $filesEx == 'docx' || $filesEx == 'xls' || $filesEx == 'xlsx'){
            return 1;
        }else{
            return 0;
        }  
    }
}

?>

