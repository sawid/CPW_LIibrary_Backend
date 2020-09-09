function readURL(input) {
    if (input.files && input.files[0]) {
        var reader = new FileReader();
        reader.onload = function (e) {
            $('#book_i').attr('src', e.target.result);
        };
        reader.readAsDataURL(input.files[0]);
    }
}

$("label[for=file]").click(function (event) {
    event.preventDefault();
    $("#file").click();
});

$('#cancelAction').click(function () {
    $('#divAF').addClass("d-none");
    $('#divAE').removeClass("d-none");
    window.location.reload();
});

$('#btnSentCommect').click(function () {
    var texts = document.getElementById("texts").value;
    var user_id = now_user_id_here;
    // var user_id = '<%= Session["user_id"] %>';
    // var userID='@Session["userID"]';
    $("#btnSentCommect").prop("disabled", true);
    if (texts == "") {
        $("#btnSentCommect").prop("disabled", false);
        return false;
    }
    $.post(
        "dist/php/sp_process_RatingResult.php",
        { book_id: book_id_this_page_exs, texts: texts, user_id: user_id, actions: "addCommentBook" },
        function (data) {
            console.log('He');
            if(data == 'OK_YES_IS_WORKING'){
                $("#texts").prop("value", "");
                $("#btnSentCommect").prop("disabled", false);
                getCommentdetail();
            }     
            
        }
    );
});

$("a[href='#ratingBooktab']").click(function () {
    getCommentdetail();
    getVotedetail() ;
    
});

$("a[href='#detailBooktab']").click(function () {
    $('#divAF').addClass("d-none");
    $('#divAE').removeClass("d-none");
    
});

$("a[href='#listBooktab']").click(function () {
  
});

$('#datalist_table').DataTable({
    "dom": '<"top"<l><f>><".card "<"#opo.card-body p-0 " t>><"bottom"ip><"clear"> '
    , "lengthMenu": [[10, 25, 50, -1], [10, 25, 50, "All"]]
    // , "processing": true
    // , "serverSide": true
    // , "ajax": {
    //     url: "dist/php/sp_process_RatingResult.php",
    //     type: "POST",  // you can use GET
    //     data: {
    //         "actions": "getTableForBooking",//send value to server as $_POST['name1']
    //         "book_id": book_id_this_page_exs
    //     }
    // }
    // , "columns": [
    //     { "data": "i" },
    //     { "data": "position" },
    //     { "data": "office" },
    //     { "data": "extn" },
    //     { "data": "start_date" },
    //     { "data": "salary" }
    // ]
    // ,scrollY: '50vh'
    // ,scrollCollapse: true
    // ,paging: false
});


$('#saveNewData').click(function () {
    $('.inputDis').attr("disabled", "disabled");
    $('.showBtn').addClass("d-none");
    $('#divAF').addClass("d-none");
    $('#divAE').removeClass("d-none");
    // $.ajax({
    //     url: "dist/php/sp_process_edit_BookDetail.php",
    //     method: "POST",
    //     data: {
    //         isbn: isbn,
    //         actions: 
    //     },
    //     success: function (data) {

    //     }
    // });
});

$('#deleteBuntton').click(function () {
    Swal.fire({
        icon: 'warning',
        confirmButtonColor: '#3085d6',
        cancelButtonColor: '#d33',
        title: 'หนังสือเลขทะเบียน ' + book_acsn_this_page_exs,
        confirmButtonText: 'ยืนยันการลบ',
        cancelButtonText: 'ยกเลิก',
        html: '<p>ยืนยันการลบหนังสือ <highlight><code>' + $('#book_name').val() +'</code></highlight></p><p>ระบบจะบันทึกการดำเนิการของคุณ</p>',
        inputPlaceholder: 'ตกลงดำเนินการลบหนังสือ',
        input: 'checkbox',
        inputValue: 0,
        // footer: 'ระบบจะบันทึกการดำเนิการของคุณ',
        inputValidator: (result) => {
            if (result == 0) {
                return 'กรุณายอมรับการดำเนินการนี้';
            } else {
                deleteBookbyBookID_BookASN(book_id_this_page_exs, book_acsn_this_page_exs);

            }
        },
        preConfirm: function () {
          
        }
        
    }).then(async (result) => {
        if (result.value) {
            const f = await Swal.fire({
                icon: 'success',
                showCloseButton: true,
                title: 'หนังสือได้ถูกลบเรียบร้อยแล้ว',
                html: 'กำลังนำทางกลับสู่หน้าหลัก',
                timer: 1500,
                timerProgressBar: true
            });
            location.replace('book.php');  
          }
    });
   
});


$('#book_languge_id0').click(function () {
    if ($(this).is(':checked')) {
        $('#languge_other').removeAttr("disabled");
    }
    else {
        $('#languge_other').attr("disabled", "disabled");
    }
});

$('#editBookData').click(function () {
    $('#divAE').addClass("d-none");
    $('#divAF').removeClass("d-none");
    $('.showBtn').removeClass("d-none");
    $('.inputDis').removeAttr("disabled");
});
var myEl = document.getElementById('editBookData');
myEl.addEventListener('click', function () {
}, false);

function cuteHide(el) {
    //ref:  https://codepen.io/ihorvorotnov/pen/OMYbvm
    $(el).animate({ opacity: '0' }, 150, function () {
        $(el).animate({ height: '0px' }, 150, function () {
            $(el).remove();
        });
    });
}

$('#addTextBoxA').click(function () {
    var numAlist = document.getElementById("numAlist").value;
    var num = parseInt(numAlist) + parseInt(1);
    var data = '';
    data += '<div class="input-group mb-2 animate__animated animate__fadeInDown animate__faster" id="authBox' + num + '">';
    data += '<div class="input-group-prepend">';
    data += '<span class="input-group-text">' + '<i class="fas fa-user-tie"></i>' + '</span>';
    data += '<select name="title_n" disabled style=""';
    data += 'class="form-control title_n">';
    data += '<option value="">ยศ</option>';
    data += '</select>';
    data += '</div>';
    data += '<input name="authName[]" type="text"';
    data += 'id="Author_name' + num + '" placeholder="ใส่ชื่อ-สกุลผู้แต่ง" ';
    data += 'class="form-control text-uppercase-x inputDis" required ';
    data += 'value="">';
    data += '<div class="input-group-append showBtn ">';
    data += '<spen onclick="cuteHide(' + "'#authBox" + num + "'" +')" class="btn btn-danger"><i class="fas fa-user-times"></i></spen>';
    data += '</div>';
    data += '</div>';
    $("#numAlist").attr("value", num);
    $("#showBoxA").append(data);
    startAutoComplete(num, "#Author_name");

});

$('#addTextBoxT').click(function () {
    var numTlist = document.getElementById("numTlist").value;
    var num = parseInt(numTlist) + parseInt(1);
    var data = '';
    data += '<div class="input-group mb-2 animate__animated animate__fadeInDown animate__faster" id="tranBox' + num + '">';
    data += '<div class="input-group-prepend">';
    data += '<span class="input-group-text">' + '<i class="fas fa-user-tie"></i>' + '</span>';
    data += '<select name="title_n" disabled style=""';
    data += 'class="form-control title_n">';
    data += '<option value="">ยศ</option>';
    data += '</select>';
    data += '</div>';
    data += '<input name="tranName[]" type="text"';
    data += 'id="Tran_name' + num + '" placeholder="ใส่ชื่อ-สกุลผู้แต่ง" ';
    data += 'class="form-control text-uppercase-x inputDis" required ';
    data += 'value="">';
    data += '<div class="input-group-append showBtn ">';
    data += '<spen onclick="cuteHide(' + "'#tranBox" + num + "'" +')" class="btn btn-danger"><i class="fas fa-user-times"></i></spen>';
    data += '</div>';
    data += '</div>';
    $("#numTlist").attr("value", num);
    $("#showBoxT").append(data);
    startAutoComplete(num, "#Tran_name");

});
function getDeleteComment(text_id) {
    Swal.fire({
        icon: 'warning',
        showCancelButton: true,
        confirmButtonColor: '#3085d6',
        cancelButtonColor: '#d33',
        title: 'ลบความคิดเห็น',
        confirmButtonText: 'ยืนยันการลบ',
        cancelButtonText: 'ยกเลิก',
        html: '<p>ระบบจะบันทึกการดำเนิการของคุณ</p>',
        inputPlaceholder: 'ตกลงดำเนินการ',
        preConfirm: function () {
            deleteComment(text_id, book_id_this_page_exs);
        }

    }).then(async (result) => {
        if (result.value) {
            const f = await Swal.fire({
                icon: 'success',
                showConfirmButton: false,
                title: 'สำเร็จแล้ว!',
                html: 'ความคิดเห็นได้ถูกลบเรียบร้อยแล้ว',
                timer: 1000,
                timerProgressBar: true
            });
        } else {
            // const f = await Swal.fire({
            //     icon: 'error',
            //     showConfirmButton: false,
            //     title: 'แย่จัง!',
            //     html: 'ระบบมีปัญหานะ',
            //     timer: 1000,
            //     timerProgressBar: true
            // });

        }
    });
}