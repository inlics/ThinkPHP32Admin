<?php if (!defined('THINK_PATH')) exit();?><!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <meta name="description" content="">
    <meta name="author" content="Clean Zone,Lynch">

    <title>Statics.inlics.com</title>

    <!-- Bootstrap core CSS -->
    <link href="/TestProject/TP32Admin/Public/admin/js\bootstrap\dist\css\bootstrap.css" rel="stylesheet">
    <link rel="stylesheet" type="text/css" href="/TestProject/TP32Admin/Public/admin/js\jquery.gritter\css\jquery.gritter.css"/>
    <link rel="stylesheet" href="/TestProject/TP32Admin/Public/admin/fonts\font-awesome-4\css\font-awesome.min.css">

    <!-- HTML5 shim and Respond.js IE8 support of HTML5 elements and media queries -->
    <!--[if lt IE 9]>
    <!--<script src="http\foxythemes.net\assets\js\MS_6.js"></script>-->
    <!--<script src="http\foxythemes.net\assets\js\MS_7.js"></script>-->
    <![endif]-->
    <!-- Custom styles for this template -->
    <link href="/TestProject/TP32Admin/Public/admin/css/style.css" rel="stylesheet"/>

    <meta http-equiv="Content-Type" content="text/html; charset=iso-8859-1">

<style>
    .profile_menu .dropdown-toggle span {
        display: inline-block;
        width: 88px;
    }
</style>
</head>

<body>

<!-- Fixed navbar -->
<div id="head-nav" class="navbar navbar-default navbar-fixed-top">
    <div class="container-fluid">
        <div class="navbar-header">
            <!--<button type="button" class="navbar-toggle" data-toggle="collapse" data-target=".navbar-collapse">
                <span class="fa fa-gear"></span>
            </button>-->
            <a class="navbar-brand" href="#"><span>Statics.inlics.com</span></a>
        </div>

        <div class="navbar-collapse collapse">
            <ul class="nav navbar-nav navbar-right user-nav">
                <li class="dropdown profile_menu">
                    <a href="#" class="dropdown-toggle" data-toggle="dropdown">
                        <img alt="头像" src="/TestProject/TP32Admin/Public/admin/images/avatar2.jpg" />
                        <span><?php echo (session('username')); ?></span>
                        <b class="caret"></b>
                    </a>
                    <ul class="dropdown-menu">
                        <li><a href="#">管理员信息</a></li>
                        <li><a href="#">修改密码</a></li>
                        <li><a href="#">上传头像</a></li>
                        <li class="divider"></li>
                        <li><a href="<?php echo U('login/logout');?>" onclick="window.localStorage.clear();">退出</a></li>
                    </ul>
                </li>
            </ul>
        </div>
    </div>
</div>


<div id="cl-wrapper" class="fixed-menu">
    <div class="cl-sidebar">
        <div class="cl-toggle"><i class="fa fa-bars"></i></div>
<div class="cl-navblock">
    <div class="menu-space">
        <div class="content">

            <ul class="cl-vnavigation">
                <?php if(is_array($nodeData)): foreach($nodeData as $key=>$controller): ?><li>
                        <a href="#">
                            <i class="fa fa-smile-o"></i>
                            <span><?php echo ($controller["title"]); ?></span>
                        </a>
                        <ul class="sub-menu">
                            <?php if(is_array($controller["children"])): foreach($controller["children"] as $key=>$method): ?><li><a data-href="<?php echo ($controller["name"]); ?>/<?php echo ($method["name"]); ?>"><?php echo ($method["title"]); ?></a></li><?php endforeach; endif; ?>
                        </ul>
                    </li><?php endforeach; endif; ?>
                <!--<li>
                    <a href="#"><span>getQueryString()</span></a>
                </li>
                <li>
                    <a href="#"><span>lynch.js</span></a>
                </li>-->

            </ul>
        </div>
    </div>
    <div class="text-right collapse-button" style="padding:7px 9px;">
        <a href="#" class="back-to-top" style="display: inline;"><i class="fa fa-angle-up"></i></a>
        <input type="text" class="form-control search" placeholder="Search..." disabled/>
        <button id="sidebar-collapse" class="btn btn-default" style="" disabled>
            <i style="color:#fff;" class="fa fa-angle-left"></i>
        </button>
        <br>
        <!--<p>UI FROM : Clean Zone</p>
        <P>AUTHOR : Lynch</P>
        <p>闽ICP备15018840号</p>
        <p>2018 &copy; Statics.inlics.com</p>-->
    </div>
</div>
    </div>

    <iframe src="/TestProject/TP32Admin/index.php/Admin/index/welcome" frameborder="0" style="width: 100%; height: 100%; margin-top: -50px"></iframe>
    <?php if(is_array($shturl)): foreach($shturl as $key=>$v): echo ($v); endforeach; endif; ?>
</div>


<script src="/TestProject/TP32Admin/Public/admin/js/jquery.js"></script>
<script src="/TestProject/TP32Admin/Public/admin/js/bootstrap/dist/js/bootstrap.min.js"></script>
<script src="/TestProject/TP32Admin/Public/admin/js/jquery.nanoscroller/jquery.nanoscroller.js"></script>
<script src="/TestProject/TP32Admin/Public/admin/js/lynch.js"></script>

<script type="text/javascript" src="/TestProject/TP32Admin/Public/admin/js/jquery.easypiechart/jquery.easy-pie-chart.js"></script>
<script type="text/javascript" src="/TestProject/TP32Admin/Public/admin/js/jquery.flot/jquery.flot.js"></script>
<!--<script type="text/javascript" src="/TestProject/TP32Admin/Public/admin/js/jquery.flot/jquery.flot.pie.js"></script>
<script type="text/javascript" src="/TestProject/TP32Admin/Public/admin/js/jquery.flot/jquery.flot.resize.js"></script>
<script type="text/javascript" src="/TestProject/TP32Admin/Public/admin/js/jquery.flot/jquery.flot.labels.js"></script>-->
<script type="text/javascript" src="/TestProject/TP32Admin/Public/plugins/layer_2/layer.js"></script>

<script src="/TestProject/TP32Admin/Public/admin/js/behaviour/common.js"></script>



<script>
    /*VERTICAL MENU*/
    $(document).ready(function() {
        const SITE = 'SJ';
        window.localStorage.setItem('site', SITE);

        if(window.localStorage.getItem('only_one_of_zh_or_sj') == '1') {
            custom_close();
        }

        // 关闭页面
        function custom_close(){
            if (confirm("您确定要关闭本页吗？")){
                closeTab();
            } else {
                closeTab();
            }
        }

        /**
         * 关闭新建的标签页
         * ie6和ie7 通用脚本
         * @method closeTab
         * */
        function closeTab() {
            var userAgent = navigator.userAgent;
            if (userAgent.indexOf("Firefox") != -1 || userAgent.indexOf("Chrome") !=-1) {
                window.location.href="about:blank";
                window.close();
            } else {
                window.opener = null;
                window.open("", "_self");
                window.close();
            }
        }


        var iu = storage.getItem('iframeUrl'),
            lastActiveMenu = storage.getItem('lastActiveMenu'),
            iuarr = [],
            ilen = $('iframe').length;
        if(iu && iuarr.length != ilen) {
            var iurl = $('iframe').attr('src'),
                iuarr = iu.split(','),
                htmlstr = '';
            for(var i in iuarr) {
                var turl = '/TestProject/TP32Admin/index.php/Admin/'+iuarr[i];
                // console.log(iurl, turl);
                if(iurl != turl) {
                    htmlstr += '<iframe src="'+ turl +'" frameborder="0" style="width: 100%; height: 100%; margin-top: -50px; display: none"></iframe>';
                }
            }
            $('#cl-wrapper').append(htmlstr);
        }
        if(lastActiveMenu) {
            var tmp = lastActiveMenu.split(''),
                tmp2 = lastActiveMenu;
            var firstLetter = tmp[0].toUpperCase();
            // console.log(firstLetter);
            tmp[0] = firstLetter;
            lastActiveMenu = tmp.join('');
            console.log(lastActiveMenu);

            $('.cl-vnavigation li ul li a[data-href="'+ lastActiveMenu +'"]').parent().addClass('active').parents('.sub-menu').show().parent().addClass('open');
            $("iframe").hide();
            $("iframe[src='" + '/TestProject/TP32Admin/index.php/Admin/' + tmp2 + "']").show();
        }

    });
    /* 后台首页侧边栏操作 */
    $('.cl-vnavigation li ul li').click(function() {
        var urli = $(this).children('a').data('href');
        $(".cl-vnavigation li ul li.active").each(function(){
            $(this).removeClass("active");
        });
        $(this).addClass('active').siblings().removeClass('active');
        // var iframeUrl = '/TestProject/TP32Admin/index.php/Admin/'+urli;
        // $('iframe').attr('src', iframeUrl);
        chgIframe(urli);
    });

    function chgIframe(urlc) {
        urlc = urlc.toLowerCase();
        var iframeUrl = '/TestProject/TP32Admin/index.php/Admin/'+urlc;
        var iu = storage.getItem('iframeUrl');
        storage.setItem('lastActiveMenu', urlc);
        if (!iu) {
            var preiu = $("iframe").attr('src').replace('.html', '').toLowerCase();
            storage.setItem('iframeUrl', urlc);
            if(preiu != iframeUrl.toLowerCase()) {
                $("iframe").hide();
                var htmlstr = '<iframe src="'+ iframeUrl +'" frameborder="0" style="width: 100%; height: 100%; margin-top: -50px"></iframe>';
                $('#cl-wrapper').append(htmlstr);
            } else {
                // console.log('对应页面已经存在');
            }
        } else {
            var iuarr = iu.split(',');
            if(arrLinearSearch(iuarr, urlc)) {
                $("iframe").hide();
                $("iframe[src='"+ iframeUrl +"']").show();
            } else {
                // console.log('对应页面未存在');
                iuarr.push(urlc);
                storage.setItem('iframeUrl', iuarr.join(','));
                $("iframe").hide();
                var htmlstr = '<iframe src="'+ iframeUrl +'" frameborder="0" style="width: 100%; height: 100%; margin-top: -50px"></iframe>';
                $('#cl-wrapper').append(htmlstr);
            }
        }

    }
</script>


</body>
</html>