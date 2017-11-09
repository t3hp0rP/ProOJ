/**
 * Created by Pr0ph3t on 2017/7/14.
 */

var submitFlag = function (obj) {
    temp = obj;
    if(obj.closest("[tabindex=-1]").find("[name='flag']").val() == '') {
        obj.closest("[tabindex=-1]").find(".form-group").addClass('has-error');
        obj.closest("[tabindex=-1]").find("#message").text("Please Input Your Flag");
        obj.closest("[tabindex=-1]").find("#message").addClass("alert-danger");
        obj.closest("[tabindex=-1]").find("#message").fadeIn();
        setTimeout(
            "temp.closest('[tabindex=-1]').find('#message').fadeOut();" +
            "temp.closest('[tabindex=-1]').find('#message').removeClass('alert-danger');"
            ,2000);
        return -1;
    }
    obj.attr("disabled",true);
    setTimeout("temp.removeAttr('disabled')", 3000);  //禁止button3秒，防止前端重复提交
    obj = obj.closest("[tabindex=-1]");

    $.ajax({
        type :'POST',
        url : '../flag',
        data : {
            'type' : obj.attr("aria-labelledby"),
            'name' : obj.find("[name='quizName']").val(),
            'flag' : obj.find("[name='flag']").val(),
            '_token' : obj.find("[name='_token']").val()
        },
        dataType : 'JSON',
        success: function (data) {
            if(data.statusCode == '200'){
                obj.find(".form-group").removeClass('has-error');
                if(data.message == '1'){
                   obj.find("[name='flag']").val('');
                   obj.prev().addClass('panel-info');
                   obj.find(".form-group").addClass('has-success');
                   obj.prev().addClass('btn-primary');
                   obj.find("#message").text('Correct Answer！');
                   obj.find("#message").addClass("alert-success");
                   obj.find("#message").fadeIn();
                   setTimeout(
                       "temp.closest('[tabindex=-1]').find('#message').fadeOut();" +
                       "temp.closest('[tabindex=-1]').find('#message').removeClass('alert-success');"
                       ,2000);
               }
                else{
                   obj.find(".form-group").addClass('has-error');
                   obj.find("#message").text('Wrong Answer！');
                   obj.find("#message").addClass("alert-danger");
                   obj.find("#message").fadeIn();
                   setTimeout(
                       "temp.closest('[tabindex=-1]').find('#message').fadeOut();" +
                       "temp.closest('[tabindex=-1]').find('#message').removeClass('alert-danger');"
                       ,2000);
               }
            }
            else
            {
                obj.find("#message").text('System failure happen, please contact Admin！');
                obj.find("#message").addClass("alert-danger");
                obj.find("#message").fadeIn();
                setTimeout(
                    "temp.closest('[tabindex=-1]').find('#message').fadeOut();" +
                    "temp.closest('[tabindex=-1]').find('#message').removeClass('alert-danger');"
                    ,2000);
            }
        },
        error : function () {
            obj.find("#message").text('Network unavailable, please check！');
            obj.find("#message").addClass("alert-danger");
            obj.find("#message").fadeIn();
            setTimeout(
                "temp.closest('[tabindex=-1]').find('#message').fadeOut();" +
                "temp.closest('[tabindex=-1]').find('#message').removeClass('alert-danger');"
                ,2000);
        }
    })
};

var refreshCaptcha = function () {
    var obj = document.getElementById('captcha');
    obj.src = obj.src.replace(/(captcha\/)(\d*$)/,"$1"+Math.floor(Math.random()*100000000));
};