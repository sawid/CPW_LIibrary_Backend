var search = $('#search_box').val();

filter_Bookdata(search);

function searchSolid() {
    var data = '';

    data = location.pathname + '?search=' + $('#search_box').val();
    // alert(location.hostname);
    location.assign(data);

}

$('#search_box').keyup(function () {
    var search = $('#search_box').val();
    filter_Bookdata(search);
});
$(".selectpicker-new").on("change", function () {
    var search = $("#search_box").val();
    if (search != "") {
        filter_Bookdata(search);
    } else {
        filter_Bookdata();
    }
});
$(".selectpicker-redo").on("change", function () {
    var filter_data = $('#filter_data').val();
    document.getElementById("page_data").value = 1;
    load_book_page_data(filter_data);
});


$(document).on('click', '.page-link-c', function () {
    // var element = document.getElementsByClassName("page-item");
    $("#sear_overry").removeClass("d-none");
    $(".page-item").addClass("disabled");
    // element.classList.add("disabled");
    var page = $(this).data('page_number');
    document.getElementById("page_data").value = page;
    var filter_data = $('#filter_data').val();
    load_book_page_data(filter_data);
    $("#sear_overry").addClass("d-none");

});