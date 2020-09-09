<?php
$stdCode = $_POST['stdCode'];
$data ='
<input id="text_loan_id_book" type="number" class="text-white hide-arrow form-control text-placewhite text-white" placeholder="รหัสของหนังสือ" onkeydown ="enterSubmitLoanBook(event)">

<div class="input-group-append"><button type="button" class="btn"><i class="fas fa-arrow-right text-white" onclick="loanCheckBook()"></i></button></div>';
return $data;