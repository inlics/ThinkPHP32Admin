<?php if (!defined('THINK_PATH')) exit();?>
<!-- saved from url=(0048)http://demo1.mycodes.net/daima/zidingyizhuanpan/ -->
<html style="background: rgb(255, 255, 245); font-size: 41.4px;" data-dpr="1"><head><meta http-equiv="Content-Type" content="text/html; charset=UTF-8">

    <meta name="viewport" content="initial-scale=1, maximum-scale=1, user-scalable=no, width=device-width">
    <meta content="yes" name="apple-mobile-web-app-capable">
    <meta content="yes" name="apple-touch-fullscreen">
    <meta content="telephone=no,email=no" name="format-detection">
    <meta content="maximum-dpr=2" name="flexible">
    <meta content="modeName=750-12" name="grid">
    <title>T_T</title>

    <!--<script type="text/javascript" async="" src="/TestProject/TP32Admin/Public/home/js/bottomSearchBar.js"></script>-->
    <script src="/TestProject/TP32Admin/Public/home/js/hm.js"></script>
    <script src="/TestProject/TP32Admin/Public/home/js/flexible_css.debug.js"></script>
    <style>@charset "utf-8";html{color:#000;background:#fff;overflow-y:scroll;-webkit-text-size-adjust:100%;-ms-text-size-adjust:100%}html *{outline:0;-webkit-text-size-adjust:none;-webkit-tap-highlight-color:rgba(0,0,0,0)}html,body{font-family:sans-serif}body,div,dl,dt,dd,ul,ol,li,h1,h2,h3,h4,h5,h6,pre,code,form,fieldset,legend,input,textarea,p,blockquote,th,td,hr,button,article,aside,details,figcaption,figure,footer,header,hgroup,menu,nav,section{margin:0;padding:0}input,select,textarea{font-size:100%}table{border-collapse:collapse;border-spacing:0}fieldset,img{border:0}abbr,acronym{border:0;font-variant:normal}del{text-decoration:line-through}address,caption,cite,code,dfn,em,th,var{font-style:normal;font-weight:500}ol,ul{list-style:none}caption,th{text-align:left}h1,h2,h3,h4,h5,h6{font-size:100%;font-weight:500}q:before,q:after{content:''}sub,sup{font-size:75%;line-height:0;position:relative;vertical-align:baseline}sup{top:-.5em}sub{bottom:-.25em}a:hover{text-decoration:underline}ins,a{text-decoration:none}</style>
    <!--<script src="/TestProject/TP32Admin/Public/home/js/flexible.debug.js"></script>-->
    <script src="/TestProject/TP32Admin/Public/home/js/makegrid.debug.js"></script>
    <style>.grid {box-sizing:content-box;padding-left: 0.32rem;padding-right: 0.32rem;margin-left: -0.24rem;}.grid:before,.grid:after{content: " ";display: table;}.grid:after {clear: both;}.grid [class^="col-"] {margin-left: 0.24rem;float: left;}.grid .col-1 {width: 0.56rem;}.grid .col-2 {width: 1.36rem;}.grid .col-3 {width: 2.16rem;}.grid .col-4 {width: 2.96rem;}.grid .col-5 {width: 3.7600000000000002rem;}.grid .col-6 {width: 4.5600000000000005rem;}.grid .col-7 {width: 5.36rem;}.grid .col-8 {width: 6.16rem;}.grid .col-9 {width: 6.960000000000001rem;}.grid .col-10 {width: 7.760000000000001rem;}.grid .col-11 {width: 8.56rem;}.grid .col-12 {width: 9.36rem;}</style>

    <link href="/TestProject/TP32Admin/Public/home/css/style.css" rel="stylesheet">

    <script src="/TestProject/TP32Admin/Public/home/js/jquery.min.js"></script>
    <script src="/TestProject/TP32Admin/Public/home/js/awardRotate.js"></script>

</head>
<body style="font-size: 12px;">

<div class="TurntablePage" style="padding-top: 50px;">
    <div class="TurntableBox" style="display: none;">
        <div class="title allTitle">送女友什么生日礼物？</div>
        <div class="turnplate">
            <canvas class="item" id="wheelcanvas" width="422px" height="422px"></canvas>
            <img class="pointer" src="/TestProject/TP32Admin/Public/home/images/start.png">
        </div>
    </div>
    <div class="editBox">
        <a href="javascript:;" class="editBtn">开始吧</a>
    </div>
    <div class="warning">
        选择困难症者的助选神器。<br>让选择变成娱乐。<br>本游戏仅供娱乐，对结果不承担任何责任
    </div>
    <div class="editContent">
        <h1>请输入主题</h1>
        <div class="title">
            <input type="text" id="title" value="">
            <a href="javascript:;" class="delete"></a>
        </div>
        <h1>请输入选项（最少2组）</h1>
        <div class="optionBox">
            <div class="options"><input type="text" placeholder="输入新选项(最多五个字符)"><a href="javascript:;" class="delete"></a> </div>
            <div class="options"><input type="text" placeholder="输入新选项(最多五个字符)"><a href="javascript:;" class="delete"></a> </div>
        </div>
        <div class="btns">
            <a href="javascript:;" class="addInput">新增</a>
            <a href="javascript:;" class="done">完成</a>
        </div>
    </div>
</div>
<script src="http://res.wx.qq.com/open/js/jweixin-1.0.0.js"></script>
<script type="text/javascript">
    //页面所有元素加载完毕后执行drawRouletteWheel()方法对转盘进行渲染
    var turnplate={
        restaraunts:[],				//大转盘奖品名称
        colors:[],					//大转盘奖品区块对应背景颜色
        outsideRadius:192,			//大转盘外圆的半径
        textRadius:150,				//大转盘奖品位置距离圆心的距离
        insideRadius:20,			//大转盘内圆的半径
        startAngle:0,				//开始角度
        bRotate:false				//false:停止;ture:旋转
    };
    //动态添加大转盘的奖品与奖品区域背景颜色
    turnplate.restaraunts = ["衣服", "首饰", "化妆品",'包包','鞋子','大餐','旅游']
    colorsArr = ["#FFF4D6", "#FFFFFF",'#fff0c8'];
    returnColor();
    function returnColor(){
        var a=turnplate.restaraunts.length;
        var color=turnplate.restaraunts.map(function(item,index,array){
            if(a%2){
                return (index+1)==a? colorsArr[2]:colorsArr[index%2]
            }else{
                return colorsArr[index%2];
            }
        });
        turnplate.colors=color;
    }
    $('.title').on('input','input',function(){
        $(this).val()==''? $(this).siblings('a').hide() : $(this).siblings('a').show();
    });
    $('.optionBox').on('input','.options input',function(e){
        $(this).val()==''? $(this).siblings('a').hide() : $(this).siblings('a').show();
        if($('.optionBox .options input').length>2){
            if($(this).val()==''){
                $(this).parent('.options').remove();
            }
        }
    });
    $('body').on('click','.delete',function(){
        $(this).siblings('input').val('');
        $(this).hide();
    });
    //form event.preventDefault();
    //		$('.optionBox').on('submit','.options input',function(){
    //			event.preventDefault();
    //			$('.optionBox').append('<div class="options"><input type="text" placeholder="输入新选项(最多五个字符)"  /></div>')
    //			return false;
    //			var flag=1;
    //			$('.optionBox .options').each(function(){
    //				var val=$(this).find('input').val();
    //				if($.trim(val)==''){
    //					flag=0;
    //				}
    //			});
    //			if(flag){
    //				$('.optionBox').append('<div class="options"><input type="text" placeholder="输入新选项(最多五个字符)"  /></div>')
    //			}
    //		});
    $('.addInput').click(function(){
        $('.optionBox').append('<div class="options"><input type="text" placeholder="输入新选项(最多五个字符)"  /><a href="javascript:;" class="delete"></a> </div>');
    });
    function buildDom(){
        var html='';
        turnplate.restaraunts.forEach(function(item,index,array){
            html+='<div class="options"><input type="text" value=""  /><a href="javascript:;" class="delete"></a> </div>';
        });
        $('.optionBox').html(html)
    }
    window.onload=function(){
        drawRouletteWheel();
    };
    //		$('#ccc').click(function(){
    //			turnplate.restaraunts = ["aaa", "bbb", "000"];
    //			returnColor();
    //			drawRouletteWheel();
    //		});
    $('.editBtn').click(function(){

        $(this).hide();
        $('.editContent').show();
        $('.done').show();
        //buildDom();
    });
    $('.done').click(function(){
        var flag=0;
        var newData=[];
        $('.optionBox .options').each(function(){
            var val=$(this).find('input').val();
            if($.trim(val)!=''){
                flag++;
                newData.push(val);
            }
        });
        if(flag>=2){
            turnplate.restaraunts = newData;
            returnColor();
            drawRouletteWheel();
            $(this).hide().siblings('.editBtn').show();
            $('.editContent').hide();
            $('.allTitle').text($('#title').val());
            $(this).hide();
            $('.editBtn').show();
            $('.TurntableBox').show();
        }
    });
    $('.pointer').click(function (){
        if(turnplate.bRotate)return;
        turnplate.bRotate = !turnplate.bRotate;
        //获取随机数(奖品个数范围内)
        var item = rnd(1,turnplate.restaraunts.length);
        //奖品数量等于10,指针落在对应奖品区域的中心角度[252, 216, 180, 144, 108, 72, 36, 360, 324, 288]
        rotateFn(item, turnplate.restaraunts[item-1]);
        console.log(item);
    });
    function rnd(n, m){
        var random = Math.floor(Math.random()*(m-n+1)+n);
        return random;
    }
    var rotateTimeOut = function (){
        $('#wheelcanvas').rotate({
            angle:0,
            animateTo:2160,
            duration:8000,
            callback:function (){
                alert('网络超时，请检查您的网络设置！');
            }
        });
    };
    //旋转转盘 item:奖品位置; txt：提示语;
    var rotateFn = function (item, txt){
        var angles = item * (360 / turnplate.restaraunts.length) - (360 / (turnplate.restaraunts.length*2));
        if(angles<270){
            angles = 270 - angles;
        }else{
            angles = 360 - angles + 270;
        }
        $('#wheelcanvas').stopRotate();
        $('#wheelcanvas').rotate({
            angle:0,
            animateTo:angles+1800,
            duration:8000,
            callback:function (){
                console.log(txt);
                turnplate.bRotate = !turnplate.bRotate;
            }
        });
    };
    function drawRouletteWheel() {
        var canvas = document.getElementById("wheelcanvas");
        if (canvas.getContext) {
            //根据奖品个数计算圆周角度
            var arc = Math.PI / (turnplate.restaraunts.length/2);
            var ctx = canvas.getContext("2d");
            //在给定矩形内清空一个矩形
            ctx.clearRect(0,0,422,422);
            //strokeStyle 属性设置或返回用于笔触的颜色、渐变或模式
            ctx.strokeStyle = "#FFBE04";
            //font 属性设置或返回画布上文本内容的当前字体属性
            ctx.font = '16px Microsoft YaHei';
            for(var i = 0; i < turnplate.restaraunts.length; i++) {
                var angle = turnplate.startAngle + i * arc;
                ctx.fillStyle = turnplate.colors[i];
                ctx.beginPath();
                //arc(x,y,r,起始角,结束角,绘制方向) 方法创建弧/曲线（用于创建圆或部分圆）
                ctx.arc(211, 211, turnplate.outsideRadius, angle, angle + arc, false);
                ctx.arc(211, 211, turnplate.insideRadius, angle + arc, angle, true);
                ctx.stroke();
                ctx.fill();
                //锁画布(为了保存之前的画布状态)
                ctx.save();
                //----绘制奖品开始----
                ctx.fillStyle = "#E5302F";
                var text = turnplate.restaraunts[i];
                var line_height = 17;
                //translate方法重新映射画布上的 (0,0) 位置
                ctx.translate(211 + Math.cos(angle + arc / 2) * turnplate.textRadius, 211 + Math.sin(angle + arc / 2) * turnplate.textRadius);
                //rotate方法旋转当前的绘图
                ctx.rotate(angle + arc / 2 + Math.PI / 2);
                /** 下面代码根据奖品类型、奖品名称长度渲染不同效果，如字体、颜色、图片效果。(具体根据实际情况改变) **/
                if(text.length>6){ //奖品名称长度超过一定范围
                    console.log('12');
                    text = text.substring(0,5)+"||"+text.substring(5);
                    var texts = text.split("||");
                    for(var j = 0; j<texts.length; j++){
                        ctx.fillText(texts[j], -ctx.measureText(texts[j]).width / 3, j * line_height);
                    }
                } else {
                    //在画布上绘制填色的文本。文本的默认颜色是黑色
                    //measureText()方法返回包含一个对象，该对象包含以像素计的指定字体宽度
                    ctx.fillText(text, -ctx.measureText(text).width / 2, 0);
                }
                ctx.restore();
                //----绘制奖品结束----
            }
        }
    }
    wx.config({
        debug: true,
        appId: '<?php echo ($signPackage["appId"]); ?>',
        timestamp: '<?php echo ($signPackage["timestamp"]); ?>',
        nonceStr: '<?php echo ($signPackage["nonceStr"]); ?>',
        signature: '<?php echo ($signPackage["signature"]); ?>',
        jsApiList: [
            // 所有要调用的 API 都要加到这个列表中
            'onMenuShareTimeline',
            'onMenuShareAppMessage'
        ]
    });

    wx.ready(function() {
        shareTest()
    });

    function shareTest() {
        wx.onMenuShareTimeline({
            title: 'title',
            link: 'http://www.baidu.com',
            desc: 'description',
            imgUrl: 'http://tknews.inlics.com/Public/admin/images/logo.png',
            success: function() {
                alertBox('提示','分享成功');
            },
            cancel: function() {
                alertBox('提示', '用户取消分享');
            },
            fail: function(res) {
                alertBox('提示', JSON.stringify(res));
            }
        });

        wx.onMenuShareAppMessage({
            title: '分享赢好礼',
            link: 'http://www.sina.com/',
            desc: 'S8为 LPL加油助威',
            imgUrl: 'http://tknews.inlics.com/Public/admin/images/logo.png',
            success: function() {
                alertBox('提示','分享成功');
            },
            cancel: function() {
                alertBox('提示', '用户取消分享');
            },
            fail: function(res) {
                alertBox('提示', JSON.stringify(res));
            }
        });
    }
    wx.error(function(res) {
        alert(JSON.stringify(res));
    })
</script>





</body></html>