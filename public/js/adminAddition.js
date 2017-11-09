/**
 * Created by Pr0ph3t on 2017/10/26.
 */

$(function () {
    if ($("#quizId").val() == '')
        $("#quizForm").attr("action","http://localhost/dev/laravel/ProOJ/public/admin/createQuiz");
    else
        $("#quizForm").attr("action","http://localhost/dev/laravel/ProOJ/public/admin/changeQuiz/"+$("#quizId").val());
});

function uploadFile() {

    var formData = new FormData();
    var file = $("#quizFile");
    formData.append("file",file[0].files[0]);
    formData.append("name",file[0].files[0].name);
    formData.append("_token",$("#_token").val());
    $.ajax({
        url : 'http://localhost/dev/laravel/ProOJ/public/admin/uploadQuizFile/'+$("#quizId").val(),
        type : 'POST',
        data : formData,
        dataType : 'json',
        processData : false,
        contentType : false,
        beforeSend:function(){
            console.log("正在上传");
        },
        success : function(responseStr) {
            if(responseStr.code===1){
                var input = $("#addr");
                $("#uploadArea").prepend("<button class=\"btn btn-info\" id=\"removeBtn\" type=\"button\">remove</button>");
                input.val(responseStr.url);
                input.attr('readonly','readonly');
                $("#quizFile").remove();
                console.log(responseStr);
                console.log("成功");
            }else{
                alert('上传失败');
                console.log(responseStr);
            }
        },
        error : function(responseStr) {
            alert('error');
            console.log(responseStr);
        }
    });
}

$("#removeBtn").click(function () {
    $.ajax({
        url : 'http://localhost/dev/laravel/ProOJ/public/admin/removeQuizFile/'+$("#quizId").val(),
        type : 'GET',
        dataType : 'json',
        beforeSend : function () {
            console.log('正在删除');
        },
        success : function (reponseStr) {
            if (reponseStr.code===1){
                var input = $("#addr");
                $("#removeBtn").addClass('hidden');
                input.val("");
                input.removeAttr("readonly");
                $("#uploadArea").prepend("<input type=\"file\" name=\"file\" id=\"quizFile\" onchange=\"uploadFile()\">");
                console.log('成功');
            }else{
                alert("删除失败");
                console.log(reponseStr);
            }
        },
        error : function (responseStr) {
            alert('error');
            console.log(responseStr);
        }
    });
});