var search = $('#search_box').val();

filter_Userdata(search);

function searchSolid() {
    var data = '';

    data = location.pathname + '?search=' + $('#search_box').val();
    // alert(location.hostname);
    location.assign(data);

}

$('#search_box').keyup(function () {
    var search = $('#search_box').val();
    filter_Userdata(search);
});
$(".selectpicker-new").on("change", function () {
    var search = $("#search_box").val();
    if (search != "") {
        filter_Userdata(search);
    } else {
        filter_Userdata();
    }
});
$(".selectpicker-redo").on("change", function () {
    var filter_data = $('#filter_data').val();
    document.getElementById("page_data").value = 1;
    load_member_page_data(filter_data);
});

$(document).on('click', '.page-link-c', function () {
    var page = $(this).data('page_number');
    document.getElementById("page_data").value = page;
    var filter_data = $('#filter_data').val();
    load_member_page_data(filter_data);
});