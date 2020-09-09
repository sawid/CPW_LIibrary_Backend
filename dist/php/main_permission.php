<?php 
session_start();
 $user_id =$_SESSION['user_id'];
 $user_type =$_SESSION['user_type'];
 if ($_SESSION['user_type'] == 'm'){
   session_destroy();
    echo '<script> location.replace("login.php"); </script>';
 }
 else if($user_id == '' ){
  echo '<script> location.replace("login.php"); </script>';
 }
 else {
   echo '<script> var now_user_id_here = '.$user_id .'</script>';
 }


?>