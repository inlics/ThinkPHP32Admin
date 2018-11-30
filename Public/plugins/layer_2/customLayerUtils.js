/**
 * Created by Lote on 2016/10/31.
 */
function  showMsg(obj,type,message,reload){
    var to_top = getTop(obj);
    var iconType = type ? 1:2;
    layer.msg(message,{
        icon: iconType,
        time: 2500, //2秒关闭（如果不配置，默认是3秒）
        offset:to_top
    }, function(){
        if(reload){
            window.location.reload();
        }
    });
}
function getTop(obj){
    if(obj==""||obj==null){
        return "";
    }else {
        var to_top = $(obj).offset().top;
        if(to_top==0){
            to_top = $(obj).parent().offset().top;
        }
        to_top = to_top -$(document).scrollTop();
        if(to_top-window.innerHeight>0){
            to_top=to_top-window.innerHeight
        }
        return to_top;
    }
}