function enterSubmit(event)
{
	if(event.keyCode=="13")//13 คือ Enter
	{
        var texts = document.getElementById("texts").value;
    $.post("dist/php/sp_process_add_new_memo.php",
        {
            texts: texts
        }, function (data) {
            if (data == 'emptytextbox') {
                document.getElementById("texts").focus();
                $("#memo-text").html('<i class="fas fa-exclamation-circle"></i> กรุณาใส่ข้อความที่ต้องการบันทึก ');
                setTimeout(function () {
                    $("#memo-text").html('');
                }, 1000);
            }
            else if (data == 'textboxsuccess') {
                // $("#member-a").empty();
                $("#memo-text").html('<i class="fas fa-comment-medical"></i> เพิ่มข้อความแล้ว ');
                setTimeout(function () {
                    $("#memo-text").html('');
                }, 1000);
            }
        }
    )
    var texts = document.getElementById("texts").value="";
	}

}

function addNewMemo($conn,$user_id) {
    var texts = document.getElementById("texts").value;
    $.post("dist/php/sp_process_add_new_memo.php",
        {
            texts: texts
        }, function (data) {
            if (data == 'emptytextbox') {
                document.getElementById("texts").focus();
                $("#memo-text").html('<i class="fas fa-exclamation-circle"></i> กรุณาใส่ข้อความที่ต้องการบันทึก ');
                setTimeout(function () {
                    $("#memo-text").html('');
                }, 1000);
            }
            else if (data == 'textboxsuccess') {
                // $("#member-a").empty();
                $("#memo-text").html('<i class="fas fa-comment-medical"></i> เพิ่มข้อความแล้ว ');
                setTimeout(function () {
                    $("#memo-text").html('');
                }, 1000);
            }
        }
    )
    var texts = document.getElementById("texts").value="";
}

function testalert() {
    alert("Success Congratulation!");
}

function deleteMemo(clicked_id) {

    $.post("dist/php/sp_process_delete_memo.php",
    {
        clicked_id: clicked_id
    }, function (data) {
        if (data == 'textboxdeletesuccess') {
            document.getElementById("texts").focus();
            $("#memo-text").html('<i class="fas fa-exclamation-circle"></i> ลบบันทึกเรียบร้อย ');
            setTimeout(function () {
                $("#memo-text").html('');
            }, 1000);
        }
    })
    
    
}

function checkbox(elem) {
    var check_id = $(elem).attr("id");
    $.post("dist/php/sp_process_checkbox_memo.php",
    {
        check_id: check_id
    })
    
}

$(function(){
    setInterval(function(){ 
        $.ajax({ 
                url:"dist/php/sp_process_show_memo.php",
                data:"rev=1",
                async:false,
                success:function(data){
                    $("#showMemo").html(data); 
                }
        }).responseText;
    },3000);    
});