<?php
// $serverName = "103.13.228.176"; //serverName\instanceName

date_default_timezone_set("Asia/Bangkok");

$serverName = "10.101.247.1"; //serverName\instanceName
$connectionInfo = array( "Database"=>"cpw_library" , "UID"=>"sa_library" , "PWD"=>"Cpwsql@2019","CharacterSet"  => 'UTF-8',"LoginTimeout" => 3);
$conn = sqlsrv_connect( $serverName, $connectionInfo);
if(!$conn ) {
     echo '    
     <div class="row d-flex justify-content-center align-items-center w-100" style="height: -webkit-fill-available;" >
  <div class=" spinner-grow text-secondary align-items-center" style="height:60px; width:60px" role="status">
  <span class="sr-only">Loading...</span>
 </div>
<div class=" text-secondary align-items-center" role="status">
  <span class=""> Connection could not be established.
 (<span id="counter">5</span>s)</span>
<script type="text/javascript">
function countdown() {
    var i = document.getElementById("counter");
if (parseInt(i.innerHTML)!=0) {
    i.innerHTML = parseInt(i.innerHTML)-1;
}
}
setInterval(function(){ countdown(); },1000);
</script>
 
</div>
</div>
     <meta http-equiv="refresh" content="5" > 
     
     ';
     die();
     // die( print_r( sqlsrv_errors(), true));

}
?>