function checkDataBook() {
    // $("#btnSaveDataBook").attr("disabled", true);
    // var book_name = document.getElementById('book_name').value;
    // var book_accession_no = document.getElementById('book_accession_no').value;
    // var book_call_classification_id = document.getElementById('book_call_classification_id').value;
    // var book_isbn = document.getElementById('book_isbn').value;
    // var book_call_author_number = document.getElementById('book_call_author_number').value;
    // var book_picture = document.getElementById('file').value;
    // var book_public_copy = document.getElementById('book_public_copy').value;
    // var n = 0;

    // if (book_name == '') {
    //     alert("กรุณาใส่ชื่อ")
    //     $("#book_name").focus();
    //     $("#btnSaveDataBook").attr("disabled", false);
    //     return false;
    // }
    // if (book_accession_no == '') {
    //     alert("กรุณาใส่เลขทะเบียนหนังสือ")
    //     $("#book_accession_no").focus();
    //      $("#btnSaveDataBook").attr("disabled", false);
    //     return false;
    // }
    // if (book_call_classification_id == '') {
    //     alert("กรุณาใส่เลขหมู่หนังสือ")
    //     $("#book_call_classification_id").focus();
    //      $("#btnSaveDataBook").attr("disabled", false);
    //     return false;
    // }
    // if (book_isbn == '') {
    //     alert("กรุณาใส่เลขมาตรฐานสากล")
    //     $("#book_isbn").focus();
    //      $("#btnSaveDataBook").attr("disabled", false);
    //     return false;
    // }
    // if (book_call_author_number == '') {
    //     alert("กรุณาใส่เลขผู้แต่ง")
    //     $("#book_call_author_number").focus();
    //      $("#btnSaveDataBook").attr("disabled", false);
    //     return false;
    // }
    // if (book_picture == '') {
    //     alert("กรุณาใส่รูป")
    //     $("#book_picture").focus();
    //      $("#btnSaveDataBook").attr("disabled", false);
    //     return false;
    // }
    // if (book_public_copy == '') {
    //     alert("กรุณาใส่ฉบับของหนังสือ")
    //     $("#book_public_copy").focus();
    //      $("#btnSaveDataBook").attr("disabled", false);
    //     return false;
    // }
    $("#senddata").submit();
}



function getOneName() {
    var Author_name = document.getElementById("Author_name1").value;
    var book_name = document.getElementById("book_name").value;
    var AN = Author_name.slice(0, 1);
    var BN = book_name.slice(0, 1);
    $("#book_call_author_number").attr("value", AN + "-" + BN);
    $("#book_call_author_number1").attr("value", "-" + AN);

}

function addTextBoxAuther() {
    var numAuuther = document.getElementById("numAuuther").value;
    var num = parseInt(numAuuther) + parseInt(1);
    $("#numAuuther").attr("value", num);
    $("#ShowAutherTextbox").append('<div class="input-group col-lg-12" id="Au' + num + '"> <input name="Author_name1[]" type="text" class="form-control" id="Author_name' + num + '" placeholder="ใส่ชื่อ-สกุลผู้แต่ง"  onkeyup="getAutherId(' + num + ')"  required><span class="input-group-addon" onclick="deleteTextBoxAuther(' + num + ')" style="background-color: red !important; color:#FFF; cursor: pointer;"><i class="fa fa-minus-circle" aria-hidden="true"></i> ลบ </span></div>  <p> </p>');
    startAutoComplete(num);

}

function deleteTextBoxAuther(num) {
    $("#Au" + num).remove();

}


function addTextBoxTran() {
    var numTran = document.getElementById("numTran").value;
    var num = parseInt(numTran) + parseInt(1);
    $("#numTran").attr("value", num);
    $("#ShowTranTextbox").append('<div class="input-group col-lg-12" id="Tr' + num + '"> <input name="Author_name2[]" type="text" class="form-control" id="Tran_name' + num + '" placeholder="ใส่ชื่อ-สกุลผู้แต่ง"   required><span class="input-group-addon" onclick="deleteTextBoxTran(' + num + ')" style="background-color: red !important; color:#FFF; cursor: pointer;"><i class="fa fa-minus-circle" aria-hidden="true"></i> ลบ </span></div><p> </p>');
    startAutoComplete2(num);

}

function deleteTextBoxTran(num) {
    $("#Tr" + num).remove();

}

function goto(user_id) {
    window.location = "?user_id=" + user_id;
}