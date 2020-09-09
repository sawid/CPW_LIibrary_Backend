
function ul_pagination(page, ecdata) {
    $("#sear_overry").removeClass("d-none");
    var showby = $("#showby").val();
    $.ajax({
        url: "dist/php/sp_process_pagination_ul.php",
        method: "POST",
        data: {
            showby: showby,
            actions: 2,
            page: page,
            ref_id_final: ((ecdata.replace('[', "")).replace(']', ""))
        },
        success: function (data) {
            // alert(data);
            $('.pagination-d').html(data);
        }
    });
    $("#sear_overry").addClass("d-none");
}

function load_book_page_data(ecdata) {
    $("#book").html('');
    $("#sear_overry").removeClass("d-none");
    $("#sear_overry").addClass("d-none");
    // $("#sear_overry").removeClass("overlay dark");
    // $("#sear_overry").addClass("overlay dark");
    // $('#sear_overry').html('<i class="fas fa-5x fa-sync-alt fa-spin"></i>');
    if (ecdata != 'ERROR_NODATAFOUND') {
        $("#book").html('');
        var sortby = $("#sortby").val();
        var page = $("#page_data").val();
        var showby = $("#showby").val();
        var actions = 1;
        $.ajax({
            url: "dist/php/sp_process_SearchBook.php",
            method: "POST",
            data: {
                showby: showby,
                page: page,
                actions: actions,
                sortby: sortby,
                ref_id_final: ((ecdata.replace('[', "")).replace(']', ""))
            },
            cache: false,
            success: function (data) {
                // $("#member-p").html(data);

                if (data == 'NoFound101') {

                }
                else {
                    $("#book").html(data);
                    // $("#sear_overry").removeClass("overlay dark");
                    // $('#sear_overry').html('');
                }
                ul_pagination(page, ecdata);
                // $("#sear_overry").addClass("d-none");

            }

        });

    } else {
        $("#book").html('Data Not FOUND');
        // $("#sear_overry").addClass("d-none");
        // $("#sear_overry").removeClass("overlay dark");
        // $('#sear_overry').html('');
    }
    $("#sear_overry").addClass("d-none");
    //  $("#member").html(data);
}

function filter_Bookdata(search) {
    $("#sear_overry").removeClass("d-none");
    var actions = 3;
    $('.pagination-d').html('');
    $("#book").html('');
    var searchbybooking = $("#searchbybooking").val();
    var searchby = $("#searchby").val();
    var searchbymo = $("#searchbymo").val();
    var searchbyplace = $("#searchbyplace").val();
    $.ajax({
        url: "dist/php/sp_process_SearchBook.php",
        method: "POST",
        data: {
            actions: actions,
            search: search,
            searchbymo: searchbymo,
            searchbyplace: searchbyplace,
            searchbybooking: searchbybooking,
            searchby: searchby
        },
        success: function (data) {
            var data_r = data;
            if (data_r == '[]') {
                data_r = 'ERROR_NODATAFOUND';
            }
            else if (data_r == '') {
                data_r = 'ไม่มีไม่ว่างนะ';
            }
            // $("#book-p").html(data_r);
            document.getElementById("filter_data").value = data;
            document.getElementById("page_data").value = 1;
            document.getElementById("page_start").value = 0;
            load_book_page_data(data_r);
        }
    });
}

