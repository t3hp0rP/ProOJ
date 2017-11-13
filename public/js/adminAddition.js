/**
 * Created by Pr0ph3t on 2017/10/26.
 */

var url = 'http://localhost/dev/laravel/ProOJ/public';

$(function () {
    var quizVal = $("#quizId").val();
    if (quizVal == '')
        $("#quizForm").attr("action",url + "/admin/createQuiz");
    else
        $("#quizForm").attr("action",url + "/admin/changeQuiz/"+quizVal);
});

function uploadFile() {

    var formData = new FormData();
    var file = $("#quizFile");
    var quizId = $("#quizId").val();
    quizId = quizId != '' ? '/' + quizId : '';
    formData.append("file",file[0].files[0]);
    formData.append("name",file[0].files[0].name);
    formData.append("_token",$("#_token").val());
    $.ajax({
        url : url + '/admin/uploadQuizFile' + quizId,
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
    var quizId = $("#quizId").val();
    quizId = quizId != '' ? '/' + quizId : '';
    $.ajax({
        url : url + '/admin/removeQuizFile' + quizId,
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