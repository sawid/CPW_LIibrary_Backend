var search = $('#search_box').val();

filter_Bookdata(search);
$('[data-toggle="tooltip"]').tooltip();

function searchSolid() {
    var data = '';

    data = location.pathname + '?search=' + $('#search_box').val() + '&page=' + $('#page_data').val() + '&sortby=' + $('#sortby').val();
    // searchbybooking = $("#searchbybooking").val();
    // var searchby = $("#searchby").val();
    // var searchbymo = $("#searchbymo").val();
    // var searchbyplace = $("#searchbyplace").val();
    // alert(location.hostname);
    location.assign(data);

}

$('#search_box').keyup(function () {
    if (ajax_run_ul != '') {
        ajax_run_ul.abort();
    }
    if (ajax_run_fl != '') {
        ajax_run_fl.abort();
    }
    // ajax_run_fl.abort();
    search = $("#search_box").val();
    document.getElementById("page_data").value = 1;

    filter_Bookdata(search);
});
$(".selectpicker-new").on("change", function () {
    if (ajax_run_ul != '') {
        ajax_run_ul.abort();
    }
    if (ajax_run_fl != '') {
        ajax_run_fl.abort();
    }
    // ajax_run_ul.abort();
    // ajax_run_fl.abort();
    search = $("#search_box").val();
    document.getElementById("page_data").value = 1;

    if (search != "") {
        filter_Bookdata(search);
    } else {
        filter_Bookdata();
    }
});

$(document).on('click', '.page-link-c', function () {
    search = $("#search_box").val();
    if (ajax_run_ul != '') {
        ajax_run_ul.abort();
    }
    if (ajax_run_fl != '') {
        ajax_run_fl.abort();
    }
    // ajax_run_ul.abort();
    // ajax_run_fl.abort();
    // var element = document.getElementsByClassName("page-item");
    // $("#sear_overry").removeClass("d-none");
    $(".page-item").addClass("disabled");
    // element.classList.add("disabled");
    var page = $(this).data('page_number');
    document.getElementById("page_data").value = page;
    filter_Bookdata(search);

});


var isbn;
// document.getElementById("step_across1").value = 0;
// document.getElementById("step_across2").value = 0;

function wait(ms) {
    var start = new Date().getTime();
    var end = start;
    while (end < start + ms) {
        end = new Date().getTime();
    }
}
$('#addNBook').click(async function () {
    //ref : https://jsfiddle.net/ad3quksn/252/
    const steps = ['I', 'II', 'III', 'IV', 'V'];
    const values = [];
    var html1;
    var accession_no;
    var currentStep = 0;
    var check = 0;
    const standardD = Swal.mixin({
        progressSteps: steps
    });
    // var across1 = $('#step_across1').val();
    // var across2 = $('#step_across2').val();

    for (currentStep = 0; currentStep < 5; currentStep += 0) {
        console.log('che FOR' + $('#access_pass').val());
        if (currentStep == 0) {
            const result = await standardD.fire({
                title: 'เริ่มต้นการเพิ่มหนังสือใหม่',
                confirmButtonText: 'ดำเนินการต่อ',
                text: 'กรุณายืนยันดำเนินการ',
                inputPlaceholder: 'ตกลงดำเนินการเพิ่มหนังสือ',
                input: 'checkbox',
                inputValue: 1,
                showCancelButton: currentStep > 0,
                inputValidator: (result) => {
                    return !result && 'กรุณายอมรับการดำเนินการนี้';
                }
                , currentProgressStep: 0
            });
            if (result.dismiss === Swal.DismissReason.backdrop) {
                break;
            }

        } else if (currentStep == 1) {
            //ref: https://stackoverflow.com/questions/54577739/sweetalert2-validation-required-for-one-of-the-fields 
            //ref: https://stackoverflow.com/questions/41474072/error-when-use-jquery-sweetalert2
            //ref: https://www.codingcage.com/2016/12/sweetalert2-ajax-delete-rows-example.html
            document.getElementById("access_pass").value = 1;
            const result = await standardD.fire({
                title: 'ขั้นตอนที่ 1',
                confirmButtonText: 'ดำเนินการต่อ',
                text: 'กรุณากรอกเลขทะเบียนหนังสือใหม่ (บังคับ)',
                inputPlaceholder: 'เลขทะเบียนหนังสือใหม่ เฉพาะตัวเลข',
                footer: '<span>การเลขทะเบียนหนังสืออัตโมมัติยังไม่มีบริการ</span>',
                cancelButtonText: 'ย้อนกลับ',
                input: 'text',
                inputValidator: (result_ib) => {
                    var numbers = /^[0-9]+$/;
                    accession_no = result_ib;
                    if (result_ib.length == 0) {
                        return 'กรุณากรอกเลขทะเบียนหนังสือใหม่';
                    } else if (!result_ib.match(numbers)) {
                        return 'กรุณากรอกเฉพาะตัวเลขเท่าน้น';
                    } else {
            checkAccession_no(accession_no);

                    }

                }, showLoaderOnConfirm: true,
                preConfirm: function () {
                    if ($('#access_pass').val() == 0) {
                        console.log('preC ปัญหา' + $('#access_pass').val());
                        Swal.showValidationMessage('เลขทะเบียนนี้มีการลงทะเบียนแล้ว กรุณาใส่ใหม่')
                    } else {
                        console.log('preC ไม่ปัญหา' + $('#access_pass').val());

                    }

                },
                allowOutsideClick: () => !Swal.isLoading(),
                inputValue: accession_no,
                showCancelButton: currentStep > 0,
                currentProgressStep: currentStep
            });
            if (result.dismiss === Swal.DismissReason.cancel) {
                currentStep -= 2;
            } else if (result.dismiss === Swal.DismissReason.backdrop) {
                break;
            } else {

            }
        }
        
        else if (currentStep == 2) {

            // document.getElementById("step_across1").value = '0';
            // document.getElementById("step_across2").value = '0';

            const result = await standardD.fire({
                title: 'ขั้นตอนที่ 1',
                confirmButtonText: 'ดำเนินการต่อ',
                text: 'กรุณากรอกเลขมาตราฐานสากล(ISBN)',
                inputPlaceholder: 'เลขมาตราฐานสากล 10 หรือ 13 หลัก เฉพาะตัวเลข',
                footer: '<span>ถ้าไม่มีกรุณาเว้นว่าง</span>',
                cancelButtonText: 'ย้อนกลับ',
                input: 'text',
                inputValidator: (result_ib) => {
                    var numbers = /^[0-9]+$/;
                    isbn = result_ib;
                    return !(((result_ib.length == 13 || result_ib.length == 10) &&
                        result_ib.match(
                            numbers)) || result_ib.length == 0) &&
                        'กรุณากรอกเลขมาตราฐานสากลให้ถูกต้อง';
                },
                inputValue: isbn,
                showCancelButton: currentStep > 0,
                currentProgressStep: currentStep
            });
            if (result.dismiss === Swal.DismissReason.cancel) {
                currentStep -= 2;
            } else if (result.dismiss === Swal.DismissReason.backdrop) {
                break;
            } else {

            }
        } else if ((currentStep == 3) && ((isbn != ''))) {
            html1 = '<p>ท่านสามารถนำเข้าข้อมูลบางส่วนจากแหล่งดังต่อไปนี้</p>';
            html1 += '<div class="row justify-content-center">';
            html1 += '<div class="col-10 form-group text-left" required> <form id="myForm">';
            html1 += '<div id="get_rad"></div>';
            html1 += '<div class="icheck-danger d-block mb-3">';
            html1 += '<input type="radio" name="check_input" value="3" checked id="outlion">';
            html1 += '<label for="outlion">';
            html1 += 'ไม่ ฉันต้องการเพิ่มข้อมูลด้วยตนเอง';
            html1 += '</label>';
            html1 += '</div>';
            html1 += '</form></div>';
            html1 += '</div>';
            check_CLc(isbn);
            check_GBc(isbn);
            // if (((across1 == '1') && (across2 == '1'))){

            // }else{
            const result = await standardD.fire({
                title: 'ขั้นตอนที่ 2',
                confirmButtonText: 'ดำเนินการต่อ',
                text: 'กรุณาเลือกดึงข้อมูลจากแหล่งข้อมูล',
                cancelButtonText: 'ย้อนกลับ',
                showCancelButton: currentStep > 0,
                currentProgressStep: currentStep,
                html: html1
            });
            if (result.dismiss === Swal.DismissReason.cancel) {
                currentStep -= 2;
            } else if (result.dismiss === Swal.DismissReason.backdrop) {
                break;
            }
            // }


        } else if (currentStep == 4) {
            var slected_d = $('input[name=check_input]:checked', '#myForm').val();
            // if (isbn != ''){
            $.ajax({
                url: "dist/php/sp_process_add_new_book.php",
                method: "POST",
                async: false,
                data: {
                    isbn: isbn,
                    book_accession_no: accession_no,
                    actions: 'INSERT_New_BOOK',
                    seclected: slected_d
                },
                success: function (data) {

                    standardD.fire({
                        title: 'สำเร็จ!',
                        icon: 'success',
                        text: 'ระบบจะนำทางในอีกไม่ช้า กรุณาอย่าปิดหน้านี้',
                        showConfirmButton: false,
                        showCancelButton: false,
                        currentProgressStep: currentStep,
                        timer: 2000,
                        allowOutsideClick: false,
                        allowEscapeKey: false,
                        allowEnterKey: false,
                        // html:'<p>'+ data+'</p>',
                        timerProgressBar: true,
                        footer: '<a href>ข้อมูลเฉพาะ (book id): ' + data + '</a>'
                    });
                    location.assign("book_detail.php?ref=" + data);
                    // window.location.reload();

                }
            });
            // }




            // across1 = $('#step_across1').val();
            // across2 = $('#step_across2').val();

        }

     
        currentStep++;

    }


});