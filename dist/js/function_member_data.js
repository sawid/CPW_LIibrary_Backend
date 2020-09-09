
function ul_pagination(page, ecdata) {
    var showby = $("#showby").val();
    $.ajax({
        url: "dist/php/sp_process_pagination_ul.php",
        method: "POST",
        data: {
            showby: showby,
            actions: 1,
            page: page,
            ref_id_final: ((ecdata.replace('[', "")).replace(']', ""))
        },
        success: function (data) {
            // alert(data);
            $('#pagination').html(data);
        }
    });
}

function load_member_page_data(ecdata) {
    var sortby = $("#sortby").val();
    var page = $("#page_data").val();
    var showby = $("#showby").val();
    var actions = 1;
    // $("#member").html(ecdata);
    $.ajax({
        url: "dist/php/sp_process_SearchUser.php",
        method: "POST",
        data: {
            showby: showby,
            page: page,
            actions: actions,
            sortby: sortby,
            ref_id_final: ((ecdata.replace('[', "")).replace(']', "")).split(",")
        },
        cache: false,
        success: function (data) {
            // $("#member-p").html(data);
            
            if (data == 'NoFound101'){
                $("#member").html(data);
            }
            else {
                $("#member").html(data);
                ul_pagination(page, ecdata);
            }
        }
    });
    //  $("#member").html(data);
}

function filter_Userdata(search) {
    var actions = 3;
    $('#pagination').html('');
    $("#member").html('');
    
    
    
    
    var searchby = $("#searchby").val();
    var searchbyty = $("#searchbyty").val();
    // alert(search);
    $.ajax({
        url: "dist/php/sp_process_SearchUser.php",
        method: "POST",
        data: {
            actions: actions,
            search: search,
            searchby: searchby,
            searchbyty: searchbyty
        },
        success: function (data) {
            $("#member-p").html(data);
            // alert(data);
            document.getElementById("filter_data").value = data;
            document.getElementById("page_data").value = 1;
            document.getElementById("page_start").value = 0;

            load_member_page_data(data);


        }
    });
}

function searchUser() {
    var user_class = document.getElementById("user_class").value;
    var user_code = document.getElementById("user_code").value;

    if (user_code.length == 5) {
        $.post("dist/php/sp_getdata_UserDetail.php", { user_class: user_class, user_code: user_code, code: 1 }, function (data) {
            var dataFuu = data.split("###");
            if (dataFuu[2] =='' ) {
                imagePro = 'dist/img/user.png';
                user_name = 'ไม่พบข้อมูล';
            }else {
                imagePro = dataFuu[0];
                user_name = dataFuu[1];

            }
            $("#imagePro").attr("src", imagePro);
            $("#user_name").attr("value", user_name);
            $("#ref_id").attr("value", dataFuu[2]);
            $("#user_card_id").attr("value", dataFuu[3]);
        });
    } else {
        $("#imagePro").attr("src", 'dist/img/user.png');
        $("#user_name").attr("value", '-');
        $("#ref_id").attr("value", '');
        $("#user_card_id").attr("value", '');
    }
}

function saveUser() {
    $("#member-a").empty();
    $("#member-a").append('<i class= "fa fa-spinner fa-pulse fa-fw" ></i > กำลังตรวจสอบข้อมูล...');
    // $("#member").html(data);
    var user_class = document.getElementById("user_class").value;
    var user_code = document.getElementById("user_code").value;
    var ref_id = document.getElementById("ref_id").value;
    var user_card_id = document.getElementById("user_card_id").value;

    $.post("dist/php/sp_add_UserDetail.php",
        {
            user_class: user_class,
            user_code: user_code,
            user_card_id: user_card_id,
            ref_id: ref_id,
            code: 1
        }, function (data) {
            if (data == 'CODEIDNOT000000') {
                document.getElementById("user_code").focus();
                $("#member-a").html('<i class="fa fa-times-circle-o"></i> กรุณาใส่เลขประจำตัวให้ถูกต้อง ');
            }
            else if (data == 'NOUSERHERE01') {
                document.getElementById("user_code").focus();
                $("#member-a").html('<i class="fa  fa-times"></i> ไม่พบข้อมูลที่ต้องการเพิ่ม ');
            }
            else if (data == 'HAVINGID01') {
                // $("#member-a").empty();
                document.getElementById("end").focus();
                $("#member-a").html('<i class="fa fa-user-times"></i> มีผู้ใช้ในระบบอยู่แล้ว ');
            }
            else if (data == 'ADDINGOK01') {
                // $("#member-a").empty();
                $("#member-a").html('<i class="fa fa-user-plus"></i> บันทึกและเพิ่มผู้ใช้แล้ว ');
                setTimeout(function () {
                    location.reload();
                }, 600);
            }
            else {
                alert(data);
            }
        });

}

