var ajax_run_ul = '';
var ajax_run_fl = '';
// var ajax_run_ul;


function ul_pagination(page, next_on) {
    var showby = $("#showby").val();
    ajax_run =
        $.ajax({
            url: "dist/php/sp_process_pagination_ul.php",
            method: "POST",
            data: {
                showby: showby,
                next_on: next_on,
                actions: 2,
                page: page
                // ,totoal: totoal
            },
            success: function (data) {
                // alert(data);
                $('.pagination-d').html(data);
            }
        });
    $("#sear_overry").addClass("d-none");
    ajax_run = '';

}

function filter_Bookdata(search) {
    $("#sear_overry").removeClass("d-none");
    var actions = 3;
    $("#book").html('');
    var searchbybooking = $("#searchbybooking").val();
    var searchby = $("#searchby").val();
    var searchbymo = $("#searchbymo").val();
    var searchbyplace = $("#searchbyplace").val();
    var sortby = $("#sortby").val();
    var page = $("#page_data").val();
    var showby = $("#showby").val();
    ajax_run_fl =
        $.ajax({
            url: "dist/php/sp_process_SearchBook.php",
            method: "POST",
            data: {
                actions: actions,
                search: search,
                searchbymo: searchbymo,
                searchbyplace: searchbyplace,
                searchbybooking: searchbybooking,
                searchby: searchby,
                showby: showby,
                page: page,
                sortby: sortby,
            },
            success: function (data) {
                var splitda = data.split("####");
                if (splitda[0] == 'ERROR_NODATAFOUND') {
                    $("#book").html('<p class="text-center">= DATA NOT FOUND =</p>');
                    $("#sear_overry").addClass("d-none");



                }
                else {
                    $("#book").html(splitda[0]);
                    document.getElementById("next_on").value = splitda[1];
                    ul_pagination(page, splitda[1]);
                }

            }
        });
    ajax_run_fl = '';

}

function checkAccession_no(accession_no) {
    $.ajax({
        url: 'dist/php/sp_process_add_new_book.php',
        method: 'POST',
        data: {
            book_accession_no: accession_no,
            actions: 'checkBAccessionN'
        },
        async: false,
        success: function (data) {
            if (data == 0) {
                // $('#access_pass').val(); ///มีเลขซ้ำ
                document.getElementById("access_pass").value = 0;
                console.log('checkAccession_no if' + $('#access_pass').val());
            }
            else {
                document.getElementById("access_pass").value = 1;
                console.log('checkAccession_no else' + $('#access_pass').val());
            }
        }
    });

}
function deleteBookbyBookID_BookASN(book_id, book_acsn) {
    $.ajax({
        url: "dist/php/sp_process_edit_BookDetail.php",
        method: "POST",
        data: {
            actions: 'deleteThisBook',
            book_id: book_id,
            book_accession_no: book_acsn,
            code: 'e102'
        },
        async: false,
        success: function (data) {
            // if (data == 'COM101as') {
            console.log(data);
            // $.post("dist/php/sp_process_edit_BookDetail.php",
            //     {
            //         actions: 'deleteThisBook',
            //         book_id: book_id_this_page_exs,
            //         book_accession_no: book_acsn_this_page_exs,
            //         code: 'e102'
            //     }, function (data) {
            //     });
            // }

        }
    });
}

function getVotedetail() {
    // console.log('ddd');
    $('#overlayT').html(' <i class="fas fa-3x fa-sync-alt fa-spin"></i>');
    $('#overlayT').removeClass("d-none");

    $.ajax({
        url: "dist/php/sp_process_RatingResult.php",
        method: "POST",
        data: {
            book_id: book_id_this_page_exs,
            actions: 'getVotedetail'
        },
        success: function (data) {
            // console.log(data);
            if (data === 'NoV') {
                $('#overlayT').html('<i class="fas fa-3x fa-times"></i> <i class="fas fa-3x  fa-sad-tear"></i> <div class="text-bold pt-2">ไม่มีคะแนน</div>');

            } else {
                data_sp = data.split('_____');
                $('#getStarforPe').html(data_sp[0]);
                $('#getNumberPeople').html(data_sp[1]);
                $('#getDateTimeUp').html(data_sp[2]);
                // $('#getSatusBarforPe').html(data_sp[3]);
                $('#label_star_5').html(data_sp[3]);
                $('#bar_star_5').attr("style", data_sp[4]);
                $('#label_star_4').html(data_sp[5]);
                $('#bar_star_4').attr("style", data_sp[6]);
                $('#label_star_3').html(data_sp[7]);
                $('#bar_star_3').attr("style",data_sp[8]);
                $('#label_star_2').html(data_sp[9]);
                $('#bar_star_2').attr("style", data_sp[10]);
                $('#label_star_1').html(data_sp[11]);
                $('#bar_star_1').attr("style", data_sp[12]);


                $('#overlayT').addClass("d-none");
            }
        },
        complete: function () {
            setTimeout(getVotedetail, 20000); //After completion of request, time to redo it after a second
        }

    });
}

function getCommentdetail() {
    // console.log('ddd');
    $.ajax({
        url: "dist/php/sp_process_RatingResult.php",
        method: "POST",
        data: {
            book_id: book_id_this_page_exs,
            actions: 'getCommentdetail'
        },
        success: function (data) {
            // console.log(data);
            data_sp = data.split('_____');
            $('#getNumCountComm').html(data_sp[0]);
            $('#getCmment').html(data_sp[1]);


        },
        complete: function () {
            setTimeout(getCommentdetail, 20000); //After completion of request, time to redo it after a second
        }

    });
}

function deleteComment(text_id, book_id) {
    $.ajax({
        url: "dist/php/sp_process_RatingResult.php",
        method: "POST",
        data: {
            actions: 'deleteThisComment',
            text_id: text_id,
            book_id: book_id
        },
        async: false,
        success: function (data) {
            if (data == 'IS_WORK_DELETE_COM') {
                cuteHide('#text_' + text_id + '_id');
                getCommentdetail();
            }

        }
    });
}




