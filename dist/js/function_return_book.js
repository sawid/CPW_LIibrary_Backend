$(function() {
    $("#text_return_id").focus();
});

function returnCheck() {
    var stdCode = document.getElementById("text_return_id").value;
    $.post("dist/php/sp_process_return_book.php", {
        stdCode: stdCode,
        actions: 1
    }, function(data) {
        if (data == 'errorformattextbox') {
            document.getElementById("text_return_id").focus();
            $("#lock-status").html('<span class="badge bg-danger">กรุณาตรวจสอบเลขให้ถูกต้อง</span>');
            setTimeout(function() {
                $("#lock-status").html('<span class="badge bg-gray">แตะบัตรเพื่อทำรายการ</span>');
            }, 3000);
        } else if (data == 'invalidtextbox') {
            $("#lock-status").html('<span class="badge bg-danger">ไม่พบผู้ใช้ในระบบ</span> ');
            setTimeout(function() {
                $("#lock-status").html('<span class="badge bg-gray">แตะบัตรเพื่อทำรายการ</span>');
            }, 3000);
        } else if (data == 'validtextboxnoreturn') {
            $("#lock-status").html('<span class="badge bg-danger">ผู้ใช้นี้ไม่มีรายการยืมหนังสือ</span> ');
            setTimeout(function() {
                $("#lock-status").html('<span class="badge bg-gray">แตะบัตรเพื่อทำรายการ</span>');
            }, 3000);
        } else if (data == 'validtextboxreturn') {
            //$.ajax({ 
            //    url:"dist/php/sp_process_return_book.php",
            //    method: "POST",
            //    data:{ stdCode: stdCode,
            //    actions: 4 },
            //    success:function(data){
            //        
            //    }
            //}).responseText;
            Swal.fire({
                title: '<b>ผู้ใช้นี้มีหนังสือที่กำลังยืมอยู่</b>',
                text: 'กรุณารอสักครู่ระบบกำลังทำรายการ',
                icon: 'success',
                showConfirmButton: false,
                timerProgressBar: true,
                timer: 3500
              })
            $("#main_return_box").html('<input id="book_return_input_id" type="number" name="input_text_book" class="text-white hide-arrow form-control text-placewhite text-white" placeholder="รหัสของหนังสือ" onkeydown ="enterSubmitreturnBook(event,this.name)"><div class="input-group-append"><button type="button" class="btn"><i id="book_return_id_submit" class="fas fa-arrow-right text-white" onclick="returnCheckBook(this.id)"></i></button></div>');
            document.getElementById("book_return_id_submit").id = stdCode;
            $("#book_return_input_id").focus();
            document.getElementById("book_return_input_id").name = stdCode;
            setTimeout(function() {
                $("#lock-status").html('<span class="badge bg-gray">กรุณาสแกน QR Code หนังสือ</span>');
            }, 2000);
        }
    })
    document.getElementById("text_return_id").value = "";

}

function enterSubmitreturn(event) {
    if (event.keyCode == "13") //13 คือ Enter
    {
        var stdCode = document.getElementById("text_return_id").value;
        $.post("dist/php/sp_process_return_book.php", {
            stdCode: stdCode,
            actions: 1
        }, function(data) {
            if (data == 'errorformattextbox') {
                document.getElementById("text_return_id").focus();
                $("#lock-status").html('<span class="badge bg-danger">กรุณาตรวจสอบเลขให้ถูกต้อง</span>');
                setTimeout(function() {
                    $("#lock-status").html('<span class="badge bg-gray">แตะบัตรเพื่อทำรายการ</span>');
                }, 3000);
            } else if (data == 'invalidtextbox') {
                $("#lock-status").html('<span class="badge bg-danger">ไม่พบผู้ใช้ในระบบ</span> ');
                setTimeout(function() {
                    $("#lock-status").html('<span class="badge bg-gray">แตะบัตรเพื่อทำรายการ</span>');
                }, 3000);
            } else if (data == 'validtextboxnoreturn') {
                $("#lock-status").html('<span class="badge bg-danger">ผู้ใช้นี้ไม่มีรายการยืมหนังสือ</span> ');
                setTimeout(function() {
                    $("#lock-status").html('<span class="badge bg-gray">แตะบัตรเพื่อทำรายการ</span>');
                }, 3000);
            } else if (data == 'validtextboxreturn') {
                //$.ajax({ 
                //    url:"dist/php/sp_process_return_book.php",
                //    method: "POST",
                //    data:{ stdCode: stdCode,
                //    actions: 4 },
                //    success:function(data){
                //        
                //    }
                //}).responseText;
                Swal.fire({
                    title: '<b>ผู้ใช้นี้มีหนังสือที่กำลังยืมอยู่</b>',
                    text: 'กรุณารอสักครู่ระบบกำลังทำรายการ',
                    icon: 'success',
                    showConfirmButton: false,
                    timerProgressBar: true,
                    timer: 3500
                  })
                $("#main_return_box").html('<input id="book_return_input_id" type="number" name="input_text_book" class="text-white hide-arrow form-control text-placewhite text-white" placeholder="รหัสของหนังสือ" onkeydown ="enterSubmitreturnBook(event,this.name)"><div class="input-group-append"><button type="button" class="btn"><i id="book_return_id_submit" class="fas fa-arrow-right text-white" onclick="returnCheckBook(this.id)"></i></button></div>');
                document.getElementById("book_return_id_submit").id = stdCode;
                $("#book_return_input_id").focus();
                document.getElementById("book_return_input_id").name = stdCode;
                setTimeout(function() {
                    $("#lock-status").html('<span class="badge bg-gray">กรุณาสแกน QR Code หนังสือ</span>');
                }, 2000);
            }
        })
        document.getElementById("text_return_id").value = "";
    }

}

function returnCheckBook(clicked_id) {
    var stdCode_process_checkbook = document.getElementById("book_return_input_id").value;
    $.post("dist/php/sp_process_return_book.php", {
        stdCode_process_checkbook: stdCode_process_checkbook,
        name: clicked_id,
        actions: 2
    }, function(data) {
        if (data == 'errorformattextboxbookpart') {
            document.getElementById("book_return_input_id").focus();
            $("#lock-status").html('<span class="badge bg-danger">กรุณาตรวจสอบข้อมูลให้ถูกต้อง</span>');
            setTimeout(function() {
                $("#lock-status").html('<span class="badge bg-gray">กรุณาสแกน QR Code หนังสือ</span>');
            }, 3000);
        } else if (data == 'invalidtextboxbookpart') {
            $("#lock-status").html('<span class="badge bg-danger">ไม่พบหนังสือในระบบ</span> ');
            setTimeout(function() {
                $("#lock-status").html('<span class="badge bg-gray">กรุณาสแกน QR Code หนังสือ</span>');
            }, 3000);
        } else if (data == 'validtextboxmaxreturnbookpart') {
            $("#lock-status").html('<span class="badge bg-danger">หนังสือเล่มนี้ไม่มีรายการถูกยืม</span> ');
            setTimeout(function() {
                $("#lock-status").html('<span class="badge bg-gray">กรุณาสแกน QR Code หนังสือ</span>');
            }, 3000);
        } else if (data == 'validtextboxreturnbookpart') {
            $.ajax({ 
                url:"dist/php/sp_process_return_book.php",
                method: "POST",
                data:{ stdCode_process_checkbook: stdCode_process_checkbook,
                    name: clicked_id,
                actions: 3 },
                success:function(data){
                    Swal.fire({
                        title: 'ยืนยันทำรายการ',
                        text: data,
                        icon: 'warning',
                        showCancelButton: true,
                        focusConfirm: false,
                        confirmButtonText: 'ตกลง',
                        cancelButtonText: 'ยกเลิก'
                      }).then((result) => {
                        if (result.value) {
                            $.post("dist/php/sp_process_return_book.php", {
                                stdCode_process_checkbook: stdCode_process_checkbook,
                                name: clicked_id,
                                actions: 5
                            }, function(data) {
                                if (data == 'updatebookingsuccess'){
                                    Swal.fire({
                                        title: '<b>ทำรายการสำเร็จ!</b>',
                                        text: 'ระบบได้ทำการคืนหนังสือแล้ว',
                                        icon: 'success',
                                        showConfirmButton: false,
                                        timerProgressBar: true,
                                        timer: 3500
                                      }).then(() => {
                                        location.reload();
                                    })
                                }
                            })
                        }
                        else {
                            location.reload();
                  ป      }
                      })
                }
            }).responseText;
            
            setTimeout(function() {
                $("#lock-status").html('<span class="badge bg-gray">กรุณาสแกน QR Code หนังสือ</span>');
            }, 5000);
        }
    })
    document.getElementById("book_return_input_id").value = "";
}

function enterSubmitreturnBook(evtobj,name) {
    var stdCode_process_checkbook = document.getElementById("book_return_input_id").value;
    if (evtobj.keyCode == 13) {
        $.post("dist/php/sp_process_return_book.php", {
            stdCode_process_checkbook: stdCode_process_checkbook,
            name: name,
            actions: 2
        }, function(data) {
            if (data == 'errorformattextboxbookpart') {
                document.getElementById("book_return_input_id").focus();
                $("#lock-status").html('<span class="badge bg-danger">กรุณาตรวจสอบข้อมูลให้ถูกต้อง</span>');
                setTimeout(function() {
                    $("#lock-status").html('<span class="badge bg-gray">กรุณาสแกน QR Code หนังสือ</span>');
                }, 3000);
            } else if (data == 'invalidtextboxbookpart') {
                $("#lock-status").html('<span class="badge bg-danger">ไม่พบหนังสือในระบบ</span> ');
                setTimeout(function() {
                    $("#lock-status").html('<span class="badge bg-gray">กรุณาสแกน QR Code หนังสือ</span>');
                }, 3000);
            } else if (data == 'validtextboxbookingbookpart') {
                $("#lock-status").html('<span class="badge bg-danger">หนังสือเล่มนี้ไม่มีรายการถูกยืม</span> ');
                setTimeout(function() {
                    $("#lock-status").html('<span class="badge bg-gray">กรุณาสแกน QR Code หนังสือ</span>');
                }, 3000);
            } else if (data == 'validtextboxreturnbookpart') {
                $.ajax({ 
                    url:"dist/php/sp_process_return_book.php",
                    method: "POST",
                    data:{ stdCode_process_checkbook: stdCode_process_checkbook,
                    name: name,
                    actions: 3 },
                    success:function(data){
                        Swal.fire({
                            title: 'ยืนยันทำรายการ',
                            text: data,
                            icon: 'warning',
                            showCancelButton: true,
                            focusConfirm: false,
                            confirmButtonText: 'ตกลง',
                            cancelButtonText: 'ยกเลิก'
                          }).then((result) => {
                            if (result.value) {
                                $.post("dist/php/sp_process_return_book.php", {
                                    stdCode_process_checkbook: stdCode_process_checkbook,
                                    name: name,
                                    actions: 5
                                }, function(data) {
                                    if (data == 'updatebookingsuccess'){
                                        Swal.fire({
                                            title: '<b>ทำรายการสำเร็จ!</b>',
                                            text: 'ระบบได้ทำการคืนหนังสือแล้ว',
                                            icon: 'success',
                                            showConfirmButton: false,
                                            timerProgressBar: true,
                                            timer: 3500
                                          }).then(() => {
                                            location.reload();
                                        })
                                    }
                                })
                            }
                            else {
                                location.reload();
                            }
                          })
                    }
                }).responseText;
                
                setTimeout(function() {
                    $("#lock-status").html('<span class="badge bg-gray">กรุณาสแกน QR Code หนังสือ</span>');
                }, 5000);
            }
        })
        document.getElementById("book_return_input_id").value = "";
    }
}