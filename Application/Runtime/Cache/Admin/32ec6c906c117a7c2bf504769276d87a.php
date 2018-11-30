<?php if (!defined('THINK_PATH')) exit();?><!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <meta name="description" content="">
    <meta name="author" content="Clean Zone,Lynch">
    <link rel="shortcut icon" href="/TestProject/TP32Admin/Public/admin/images/favicon.ico">

    <title>登录 - Statics.inlics.com</title>

    <!-- Bootstrap core CSS -->
    <link rel="stylesheet" href="/TestProject/TP32Admin/Public/admin/js/bootstrap/dist/css/bootstrap.css">
    <link rel="stylesheet" href="/TestProject/TP32Admin/Public/admin/js/jquery.gritter/css/jquery.gritter.css" type="text/css"/>
    <link rel="stylesheet" href="/TestProject/TP32Admin/Public/admin/fonts/font-awesome-4/css/font-awesome.min.css">

    <!-- HTML5 shim and Respond.js IE8 support of HTML5 elements and media queries -->
    <!--[if lt IE 9]>
    <!--<script src="http/foxythemes.net/assets/js/MS_6.js"></script>-->
    <!--<script src="http/foxythemes.net/assets/js/MS_7.js"></script>-->
    <![endif]-->
    <!-- Custom styles for this template -->
    <link href="/TestProject/TP32Admin/Public/admin/css/style.css" rel="stylesheet"/>

    <meta http-equiv="Content-Type" content="text/html; charset=iso-8859-1">
</head>

<body class="texture">

<!--padding-top: 50px;-->
<div id="cl-wrapper" class="login-container">

    <div class="middle-login">
        <!--<h2 class="text-center">123</h2>-->
        <div class="block-flat">
            <div class="header">
                <h3 class="text-center">登录</h3>
            </div>
            <div>
                <form style="margin-bottom: 0px !important;" class="form-horizontal" action=""
                    method="post" target="_self">
                    <div class="content">
                        <div class="form-group">
                            <div class="col-sm-12">
                                <div class="input-group">
                                    <span class="input-group-addon"><i class="fa fa-user"></i></span>
                                    <input type="text" placeholder="账号" name="name" class="form-control">
                                </div>
                            </div>
                        </div>
                        <div class="form-group">
                            <div class="col-sm-12">
                                <div class="input-group">
                                    <span class="input-group-addon"><i class="fa fa-lock"></i></span>
                                    <input type="password" placeholder="密码" name="password" class="form-control">
                                </div>
                            </div>
                        </div>
                        <div class="form-group">
                            <div class="col-sm-7 col-xs-7">
                                <div class="input-group">
                                    <span class="input-group-addon"><i class="fa fa-hand-o-right"></i></span>
                                    <input type="text" placeholder="验证码" name="vcode" class="form-control">
                                </div>
                            </div>
                            <div class="col-sm-5 col-xs-5">
                                <img id="check" src="/TestProject/TP32Admin/index.php/Admin/Login/verifyCode" style="width: 100%"
                                     onclick="this.src='/TestProject/TP32Admin/index.php/Admin/Login/verifyCode/'+Math.random();"/>
                                <a href="javascript:change();">换一张</a>
                            </div>
                        </div>

                    </div>
                    <div class="foot">

                        <button class="btn btn-primary" data-dismiss="modal" type="submit">登录</button>
                    </div>
                </form>
            </div>
        </div>
        <div class="text-center out-links"><a href="#">&copy; 2013 Statics.inlics.com</a></div>
    </div>

</div>
<script>

    /*if (window != top)
        top.location.href = location.href;*/
    if (window.top != window.self) {
        window.top.location.href = window.self.location.href;
    }

    function change() {
        document.getElementById('check').src="/TestProject/TP32Admin/index.php/Admin/Login/verifyCode/"+Math.random();
    }
</script>
</body>
</html>