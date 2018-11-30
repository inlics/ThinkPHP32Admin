/**
 * Created by 10328 on 2018-09-29.
 */
/*Return to top*/
var offset = 220;
var duration = 500;
var button = $('<a href="#" class="back-to-top"><i class="fa fa-angle-up"></i></a>');
button.appendTo("body");

var siteConfig = {
    'debug': true
};

jQuery(window).scroll(function() {
    if (jQuery(this).scrollTop() > offset) {
        jQuery('.back-to-top').fadeIn(duration);
    } else {
        jQuery('.back-to-top').fadeOut(duration);
    }
});

jQuery('.back-to-top').click(function(event) {
    event.preventDefault();
    jQuery('html, body').animate({scrollTop: 0}, duration);
    return false;
});

/* form表单数据序列化为对象 */
$.fn.serializeObject = function() {
    var o = {};
    var a = this.serializeArray();
    $.each(a, function() {
        if (o[this.name]) {
            if (!o[this.name].push) {
                o[this.name] = [ o[this.name] ];
            }
            o[this.name].push(this.value || '');
        } else {
            o[this.name] = this.value || '';
        }
    });
    return o;
};

/*VERTICAL MENU*/
/* 后台首页侧边栏操作 */

$(".cl-vnavigation li ul").each(function(){
    $(this).parent().addClass("parent");
});

$(".cl-vnavigation li ul li.active").each(function(){
    $(this).parent().show().parent().addClass("open");
});

$(".cl-vnavigation").delegate(".parent > a","click",function(e){

    $(".cl-vnavigation .parent.open > ul").not($(this).parent().find("ul")).slideUp(300, 'swing',function(){
        $(this).parent().removeClass("open");
    });

    var ul = $(this).parent().find("ul");
    ul.slideToggle(300, 'swing', function () {
        var p = $(this).parent();

        if(p.hasClass("open")){
            p.removeClass("open");
        }else{
            p.addClass("open");
        }

        $("#cl-wrapper .nscroller").nanoScroller({ preventPageScrolling: true });

    });

    e.preventDefault();
});

/*Small devices toggle*/
$(".cl-toggle").click(function(e){
    var ul = $(".cl-vnavigation");
    ul.slideToggle(300, 'swing', function () {
    });

    e.preventDefault();
});

/*Collapse sidebar*/
$("#sidebar-collapse").click(function(){
    toggleSideBar();
});

function toggleSideBar(_this){
    var b = $("#sidebar-collapse")[0];
    var w = $("#cl-wrapper");
    var s = $(".cl-sidebar");

    if(w.hasClass("sb-collapsed")){

        $(".fa",b).addClass("fa-angle-left").removeClass("fa-angle-right");
        w.removeClass("sb-collapsed");

    }else{

        $(".fa",b).removeClass("fa-angle-left").addClass("fa-angle-right");
        w.addClass("sb-collapsed");

    }
}


if($("#cl-wrapper").hasClass("fixed-menu")){
    var scroll =  $("#cl-wrapper .menu-space");
    scroll.addClass("nano nscroller");

    function update_height(){
        var button = $("#cl-wrapper .collapse-button");
        var collapseH = button.outerHeight();
        var navH = $("#head-nav").height();
        var height = $(window).height() - ((button.is(":visible"))?collapseH:0) - navH;
        scroll.css("height",height);
        $("#cl-wrapper .nscroller").nanoScroller({ preventPageScrolling: true });
    }

    $(window).resize(function() {
        update_height();
    });

    update_height();
    $("#cl-wrapper .nscroller").nanoScroller({ preventPageScrolling: true });

}

var tool = $("<div id='sub-menu-nav' style='position:fixed;z-index:9999;'></div>");

function showMenu(_this, e){
    if(($("#cl-wrapper").hasClass("sb-collapsed") || ($(window).width() > 755 && $(window).width() < 963)) && $("ul",_this).length > 0){
        $(_this).removeClass("ocult");
        var menu = $("ul",_this);
        if(!$(".dropdown-header",_this).length){
            var head = '<li class="dropdown-header">' +  $(_this).children().html()  + "</li>" ;
            menu.prepend(head);
        }

        tool.appendTo("body");
        var top = ($(_this).offset().top + 8) - $(window).scrollTop();
        var left = $(_this).width();

        tool.css({
            'top': top,
            'left': left + 8
        });
        tool.html('<ul class="sub-menu">' + menu.html() + '</ul>');
        tool.show();

        menu.css('top', top);
    }else{
        tool.hide();
    }
}

$(".cl-vnavigation li").hover(function(e){
    showMenu(this, e);
},function(e){

    tool.removeClass("over");
    setTimeout(function(){
        if(!tool.hasClass("over") && !$(".cl-vnavigation li:hover").length > 0){
            tool.hide();
        }
    },500);
});

tool.hover(function(e){
    $(this).addClass("over");
},function(){
    $(this).removeClass("over");
    setTimeout(function(){
        if(!tool.hasClass("over") && !$(".cl-vnavigation li:hover").length > 0){
            tool.fadeOut("fast");
        }
    },500);
});


$(document).click(function(){
    tool.hide();
});
$(document).on('touchstart click', function(e){
    tool.fadeOut("fast");
});

tool.click(function(e){
    e.stopPropagation();
});

$(".cl-vnavigation li").click(function(e){
    if((($("#cl-wrapper").hasClass("sb-collapsed") || ($(window).width() > 755 && $(window).width() < 963)) && $("ul",this).length > 0) && !($(window).width() < 755)){
        showMenu(this, e);
        e.stopPropagation();
    }
});

/**
 * 修改角色状态时，改变隐藏域的值
 * @method chgST
 * */
/*function chgST() {
    var st = $('input[name="cstatus"]:checked').val();
    if(st == 'on') {
        $('#st').text('开启');
        $('input[name="status"]').val('1');
    } else {
        $('#st').text('关闭');
        $('input[name="status"]').val('0');
    }
}*/

/**
 * 修改
 * @method chgSwitch
 * @param {String} celm 显示开关的name属性
 * @param {String} elm 隐藏域的name
 * */
function chgSwitch(celm, elm) {
    var st = $('input[name="'+ celm +'"]:checked').val();
    if(st == 'on') {
        $('#'+celm).text('开启');
        $('input[name="'+ elm +'"]').val('1');
    } else {
        $('#'+celm).text('关闭');
        $('input[name="'+ elm +'"]').val('0');
    }
}

/**
 * 提示信息
 * @method showTooltip
 * @param {String} x 横坐标
 * @param {String} y 纵坐标
 * @param {String} contents 提示的内容
 * */
function showTooltip(x, y, contents) {
    $("<div id='tooltip'>" + contents + "</div>").css({
        position: "absolute",
        display: "none",
        top: y + 5,
        left: x + 5,
        border: "1px solid #000",
        padding: "5px",
        'color':'#fff',
        'border-radius':'2px',
        'font-size':'11px',
        "background-color": "#000",
        opacity: 0.80
    }).appendTo("body").fadeIn(200);
}
/**
 * 返回随机数
 * @method randValue
 * */
function randValue() {
    return (Math.floor(Math.random() * (1 + 50 - 20))) + 10;
}

/* 模拟数据 */
var pageviews = [
    [1, 30 + randValue()],
    [2, 30 + randValue()],
    [3, 2 + randValue()],
    [4, 3 + randValue()],
    [5, 5 + randValue()],
    [6, 10 + randValue()],
    [7, 15 + randValue()],
    [8, 20 + randValue()],
    [9, 25 + randValue()],
    [10, 30 + randValue()],
    [11, 35 + randValue()],
    [12, 25 + randValue()],
    [13, 15 + randValue()],
    [14, 20 + randValue()],
    [15, 45 + randValue()],
    [16, 50 + randValue()],
    [17, 65 + randValue()],
    [18, 70 + randValue()],
    [19, 85 + randValue()],
    [20, 80 + randValue()],
    [21, 75 + randValue()],
    [22, 80 + randValue()],
    [23, 75 + randValue()]
];
/* 模拟数据 */
var visitors = [
    [1, randValue() - 5],
    [2, randValue() - 5],
    [3, randValue() - 5],
    [4, 6 + randValue()],
    [5, 5 + randValue()],
    [6, 20 + randValue()],
    [7, 25 + randValue()],
    [8, 36 + randValue()],
    [9, 26 + randValue()],
    [10, 38 + randValue()],
    [11, 39 + randValue()],
    [12, 50 + randValue()],
    [13, 51 + randValue()],
    [14, 12 + randValue()],
    [15, 13 + randValue()],
    [16, 14 + randValue()],
    [17, 15 + randValue()],
    [18, 15 + randValue()],
    [19, 16 + randValue()],
    [20, 17 + randValue()],
    [21, 18 + randValue()],
    [22, 19 + randValue()],
    [23, 20 + randValue()],
    [24, 21 + randValue()],
    [25, 14 + randValue()],
    [26, 24 + randValue()],
    [27, 25 + randValue()],
    [28, 26 + randValue()],
    [29, 27 + randValue()],
    [30, 31 + randValue()]
];

/* 折线图属性设置 */
var lineOptions = {
    series: {
        lines: {
            show: true,
            lineWidth: 2,
            fill: true,
            fillColor: {
                colors: [{
                    opacity: 0.2
                }, {
                    opacity: 0.01
                }
                ]
            }
        },
        points: {
            show: true
        },
        shadowSize: 2
    },
    legend:{
        show: false
    },
    grid: {
        labelMargin: 10,
        axisMargin: 500,
        hoverable: true,
        clickable: true,
        tickColor: "rgba(255,255,255,0.22)",
        borderWidth: 0
    },
    colors: ["#FFFFFF", "#4A8CF7", "#52e136"],
    font:{
        fontSize: '14px'
    },
    xaxis: {
        ticks: 11,
        tickDecimals: 0
    },
    yaxis: {
        ticks: 5,
        tickDecimals: 0
    }
};

/* 柱状图属性设置 */
var barOptions = {
    series: {
        bars: {
            show: true,
            barWidth: 0.7,
            lineWidth: 1,
            fill: true,
            hoverable: true,
            fillColor: {
                colors: [{
                    opacity: 0.85
                }, {
                    opacity: 0.85
                }
                ]
            }
        },
        shadowSize: 2
    },
    legend:{
        show: false
    },
    grid: {
        labelMargin: 10,
        axisMargin: 500,
        hoverable: true,
        clickable: true,
        tickColor: "rgba(255,255,255,0.22)",
        borderWidth: 0
    },
    colors: ["#FFFFFF", "#e67653", "#52e136"],
    xaxis: {
        ticks: 11,
        tickDecimals: 0
    },
    yaxis: {
        ticks: 6,
        tickDecimals: 0
    }
};

/**
 * 鼠标移动到图标上时
 * @method plotHover
 * @param {String} elm 需要绑定plothover事件的元素
 * */
function plotHover(elm) {
    var previousPoint = null;
    $(elm).bind("plothover", function (event, pos, item) {

        var str = "(" + pos.x.toFixed(2) + ", " + pos.y.toFixed(2) + ")";

        if (item) {
            if (previousPoint != item.dataIndex) {
                previousPoint = item.dataIndex;
                $("#tooltip").remove();
                var x = item.datapoint[0].toFixed(2),
                    y = item.datapoint[1].toFixed(2);
                showTooltip(item.pageX, item.pageY,
                    item.series.label + " of " + x + " = " + y);
            }
        } else {
            $("#tooltip").remove();
            previousPoint = null;
        }
    });
}

if(siteConfig.debug == false) {
    document.oncontextmenu = function() {
        return false;
    }
}

/**
 * 首字母
 * */
function upCaseFirst() {

}