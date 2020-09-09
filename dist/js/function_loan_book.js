$(function() {
    $("#text_loan_id").focus();
});

function loanCheck() {
    var stdCode = document.getElementById("text_loan_id").value;
    $.post("dist/php/sp_process_loan_book.php", {
        stdCode: stdCode,
        actions: 1
    }, function(data) {
        if (data == 'errorformattextbox') {
            document.getElementById("text_loan_id").focus();
            $("#lock-status").html('<span class="badge bg-danger">กรุณาตรวจสอบเลขให้ถูกต้อง</span>');
            setTimeout(function() {
                $("#lock-status").html('<span class="badge bg-gray">แตะบัตรเพื่อทำรายการ</span>');
            }, 3000);
        } else if (data == 'invalidtextbox') {
            $("#lock-status").html('<span class="badge bg-danger">ไม่พบผู้ใช้ในระบบ</span> ');
            setTimeout(function() {
                $("#lock-status").html('<span class="badge bg-gray">แตะบัตรเพื่อทำรายการ</span>');
            }, 3000);
        } else if (data == 'validtextboxmaxloan') {
            $("#lock-status").html('<span class="badge bg-danger">คุณได้ยืมหนังสือเต็มที่กำหนดแล้ว</span> ');
            setTimeout(function() {
                $("#lock-status").html('<span class="badge bg-gray">แตะบัตรเพื่อทำรายการ</span>');
            }, 3000);
        } else if (data == 'validtextboxloan') {
            //$.ajax({ 
            //    url:"dist/php/sp_process_loan_book.php",
            //    method: "POST",
            //    data:{ stdCode: stdCode,
            //    actions: 4 },
            //    success:function(data){
            //        
            //    }
            //}).responseText;
            Swal.fire({
                title: '<b>ผู้ใช้นี้สามารถยืมได้</b>',
                text: 'กรุณารอสักครู่ระบบกำลังทำรายการ',
                icon: 'success',
                showConfirmButton: false,
                timerProgressBar: true,
                timer: 3500
              })
            $("#main_loan_box").html('<input id="book_loan_input_id" type="number" name="input_text_book" class="text-white hide-arrow form-control text-placewhite text-white" placeholder="รหัสของหนังสือ" onkeydown ="enterSubmitLoanBook(event,this.name)"><div class="input-group-append"><button type="button" class="btn"><i id="book_loan_id_submit" class="fas fa-arrow-right text-white" onclick="loanCheckBook(this.id)"></i></button></div>');
            document.getElementById("book_loan_id_submit").id = stdCode;
            $("#book_loan_input_id").focus();
            document.getElementById("book_loan_input_id").name = stdCode;
            setTimeout(function() {
                $("#lock-status").html('<span class="badge bg-gray">กรุณาสแกน QR Code หนังสือ</span>');
            }, 2000);
        }
    })
    document.getElementById("text_loan_id").value = "";

}

function enterSubmitLoan(event) {
    if (event.keyCode == "13") //13 คือ Enter
    {
        var stdCode = document.getElementById("text_loan_id").value;
        $.post("dist/php/sp_process_loan_book.php", {
            stdCode: stdCode,
            actions: 1
        }, function(data) {
            if (data == 'errorformattextbox') {
                document.getElementById("text_loan_id").focus();
                $("#lock-status").html('<span class="badge bg-danger">กรุณาตรวจสอบเลขให้ถูกต้อง</span>');
                setTimeout(function() {
                    $("#lock-status").html('<span class="badge bg-gray">แตะบัตรเพื่อทำรายการ</span>');
                }, 3000);
            } else if (data == 'invalidtextbox') {
                $("#lock-status").html('<span class="badge bg-danger">ไม่พบผู้ใช้ในระบบ</span> ');
                setTimeout(function() {
                    $("#lock-status").html('<span class="badge bg-gray">แตะบัตรเพื่อทำรายการ</span>');
                }, 3000);
            } else if (data == 'validtextboxmaxloan') {
                $("#lock-status").html('<span class="badge bg-danger">คุณได้ยืมหนังสือเต็มที่กำหนดแล้ว</span> ');
                setTimeout(function() {
                    $("#lock-status").html('<span class="badge bg-gray">แตะบัตรเพื่อทำรายการ</span>');
                }, 3000);
            } else if (data == 'validtextboxloan') {
                //$.ajax({ 
                //    url:"dist/php/sp_process_loan_book.php",
                //    method: "POST",
                //    data:{ stdCode: stdCode,
                //    actions: 4 },
                //    success:function(data){
                //        
                //    }
                //}).responseText;
                Swal.fire({
                    title: '<b>ผู้ใช้นี้สามารถยืมได้</b>',
                    text: 'กรุณารอสักครู่ระบบกำลังทำรายการ',
                    icon: 'success',
                    showConfirmButton: false,
                    timerProgressBar: true,
                    timer: 3500
                  })
                $("#main_loan_box").html('<input id="book_loan_input_id" type="number" name="input_text_book" class="text-white hide-arrow form-control text-placewhite text-white" placeholder="รหัสของหนังสือ" onkeydown ="enterSubmitLoanBook(event,this.name)"><div class="input-group-append"><button type="button" class="btn"><i id="book_loan_id_submit" class="fas fa-arrow-right text-white" onclick="loanCheckBook(this.id)"></i></button></div>');
                document.getElementById("book_loan_id_submit").id = stdCode;
                $("#book_loan_input_id").focus();
                document.getElementById("book_loan_input_id").name = stdCode;
                setTimeout(function() {
                    $("#lock-status").html('<span class="badge bg-gray">กรุณาสแกน QR Code หนังสือ</span>');
                }, 2000);
            }
        })
        document.getElementById("text_loan_id").value = "";
    }

}

function enterSubmitLoanBook(evtobj,name) {
    var stdCode_process_checkbook = document.getElementById("book_loan_input_id").value;
    if (evtobj.keyCode == 13) {
        $.post("dist/php/sp_process_loan_book.php", {
            stdCode_process_checkbook: stdCode_process_checkbook,
            name: name,
            actions: 2
        }, function(data) {
            if (data == 'errorformattextboxbookpart') {
                document.getElementById("book_loan_input_id").focus();
                $("#lock-status").html('<span class="badge bg-danger">กรุณาตรวจสอบข้อมูลให้ถูกต้อง</span>');
                setTimeout(function() {
                    $("#lock-status").html('<span class="badge bg-gray">กรุณาสแกน QR Code หนังสือ</span>');
                }, 3000);
            } else if (data == 'invalidtextboxbookpart') {
                $("#lock-status").html('<span class="badge bg-danger">ไม่พบหนังสือในระบบ</span> ');
                setTimeout(function() {
                    $("#lock-status").html('<span class="badge bg-gray">กรุณาสแกน QR Code หนังสือ</span>');
                }, 3000);
            } else if (data == 'validtextboxmaxloanbookpart') {
                $("#lock-status").html('<span class="badge bg-danger">หนังสือเล่มนี้ได้ถูกยืมไปแล้ว</span> ');
                setTimeout(function() {
                    $("#lock-status").html('<span class="badge bg-gray">กรุณาสแกน QR Code หนังสือ</span>');
                }, 3000);
            } else if (data == 'validtextboxbookingbookpart') {
                $("#lock-status").html('<span class="badge bg-danger">หนังสือเล่มนี้ได้ถูกจองไปแล้ว</span> ');
                setTimeout(function() {
                    $("#lock-status").html('<span class="badge bg-gray">กรุณาสแกน QR Code หนังสือ</span>');
                }, 3000);
            } else if (data == 'validtextboxloanbookpart') {
                $.ajax({ 
                    url:"dist/php/sp_process_loan_book.php",
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
                                $.post("dist/php/sp_process_loan_book.php", {
                                    stdCode_process_checkbook: stdCode_process_checkbook,
                                    name: name,
                                    actions: 5
                                }, function(data) {
                                    if (data == 'updatebookingsuccess'){
                                        Swal.fire({
                                            title: '<b>ทำรายการสำเร็จ!</b>',
                                            text: 'ระบบได้ทำการยืมหนังสือแล้ว 1',
                                            icon: 'success',
                                            showConfirmButton: false,
                                            timerProgressBar: true,
                                            timer: 3500
                                          }).then(() => {
                                            location.reload();
                                        })
                                    } else if(data == 'addbookingsuccess') {
                                        Swal.fire({
                                            title: '<b>ทำรายการสำเร็จ!</b>',
                                            text: 'ระบบได้ทำการยืมหนังสือแล้ว 2',
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
        document.getElementById("book_loan_input_id").value = "";
    }
}

function loanCheckBook(clicked_id) {
    var stdCode_process_checkbook = document.getElementById("book_loan_input_id").value;
    $.post("dist/php/sp_process_loan_book.php", {
        stdCode_process_checkbook: stdCode_process_checkbook,
        name: clicked_id,
        actions: 2
    }, function(data) {
        if (data == 'errorformattextboxbookpart') {
            document.getElementById("book_loan_input_id").focus();
            $("#lock-status").html('<span class="badge bg-danger">กรุณาตรวจสอบข้อมูลให้ถูกต้อง</span>');
            setTimeout(function() {
                $("#lock-status").html('<span class="badge bg-gray">กรุณาสแกน QR Code หนังสือ</span>');
            }, 3000);
        } else if (data == 'invalidtextboxbookpart') {
            $("#lock-status").html('<span class="badge bg-danger">ไม่พบหนังสือในระบบ</span> ');
            setTimeout(function() {
                $("#lock-status").html('<span class="badge bg-gray">กรุณาสแกน QR Code หนังสือ</span>');
            }, 3000);
        } else if (data == 'validtextboxmaxloanbookpart') {
            $("#lock-status").html('<span class="badge bg-danger">หนังสือเล่มนี้ได้ถูกยืมไปแล้ว</span> ');
            setTimeout(function() {
                $("#lock-status").html('<span class="badge bg-gray">กรุณาสแกน QR Code หนังสือ</span>');
            }, 3000);
        } else if (data == 'validtextboxbookingbookpart') {
            $("#lock-status").html('<span class="badge bg-danger">หนังสือเล่มนี้ได้ถูกจองไปแล้ว</span> ');
            setTimeout(function() {
                $("#lock-status").html('<span class="badge bg-gray">กรุณาสแกน QR Code หนังสือ</span>');
            }, 3000);
        } else if (data == 'validtextboxloanbookpart') {
            $.ajax({ 
                url:"dist/php/sp_process_loan_book.php",
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
                            $.post("dist/php/sp_process_loan_book.php", {
                                stdCode_process_checkbook: stdCode_process_checkbook,
                                name: clicked_id,
                                actions: 5
                            }, function(data) {
                                if (data == 'updatebookingsuccess'){
                                    Swal.fire({
                                        title: '<b>ทำรายการสำเร็จ!</b>',
                                        text: 'ระบบได้ทำการยืมหนังสือแล้ว 1',
                                        icon: 'success',
                                        showConfirmButton: false,
                                        timerProgressBar: true,
                                        timer: 3500
                                      }).then(() => {
                                        location.reload();
                                    })
                                } else if(data == 'addbookingsuccess') {
                                    Swal.fire({
                                        title: '<b>ทำรายการสำเร็จ!</b>',
                                        text: 'ระบบได้ทำการยืมหนังสือแล้ว 2',
                                        icon: 'success',
                                        showConfirmButton: false,
                                        timerProgressBar: true,
                                        timer: 3500
                                      }).then(() => {
                                        window.location.href = "index.php";
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
    document.getElementById("book_loan_input_id").value = "";
}

function testswal() {
    Swal.fire({
        title: '<b>ทำรายการสำเร็จ!</b>',
        text: 'ระบบได้ทำการยืมหนังสือแล้ว 2',
        icon: 'success',
        showConfirmButton: false,
        timerProgressBar: true,
        timer: 3500
      }).then(() => {
        location.reload();
    })
}

function testcall() {
    testswal(); 
}
