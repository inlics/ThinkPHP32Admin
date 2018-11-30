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

<link rel="stylesheet" type="text/css" href="/TestProject/TP32Admin/Public/admin/js/bootstrap.switch/bootstrap-switch.min.css" />
</head>

<body>

<div id="cl-wrapper" class="fixed-menu">

    <div class="container-fluid" id="pcont">
        <div class="" style="padding-top: 15px;">

            <div class="row">
                <div class="col-md-12">
                    <div class="block-flat">
                        <div class="header">
                            <h3>编辑节点
                                <a href="<?php echo U('rbac/node');?>" type="button" class="btn btn-default btn-sm">
                                    返回 <i class="fa fa-angle-right"></i>
                                </a>
                            </h3>
                        </div>
                        <div class="content">

                            <form role="form" action="<?php echo U('rbac/addNode');?>" method="post" target="_self">
                                <div class="form-group">
                                    <label>节点名称：</label>
                                    <input type="text" name="name" placeholder="请输入节点名称"
                                           value="<?php echo ($node["name"]); ?>" class="form-control">
                                </div>

                                <div class="form-group">
                                    <label>节点描述：</label>
                                    <input type="text" name="title" placeholder="请输入节点描述"
                                           value="<?php echo ($node["title"]); ?>" class="form-control">
                                </div>

                                <div class="form-group">
                                    <label>节点状态（当前：<span id="cstatus">默认开启</span>）：</label>
                                    <input class="switch" name="cstatus" type="checkbox" data-on-color="success"
                                           data-off-color="primary" onchange="chgSwitch('cstatus', 'status')"
                                        <?php if($node["status"] == 1): ?>checked<?php endif; ?> >
                                    <input type="hidden" name="status" value="1">
                                </div>

                                <div class="form-group">
                                    <label>是否在菜单中显示：（当前：<span id="cisMenu">默认开启</span>）：</label>
                                    <input class="switch" name="cisMenu" type="checkbox" data-on-color="success"
                                           data-off-color="primary" onchange="chgSwitch('cisMenu','isMenu')"
                                        <?php if($node["ismenu"] == 1): ?>checked<?php endif; ?> >
                                    <input type="hidden" name="isMenu" value="1">
                                </div>

                                <input type="hidden" name="id" value="<?php echo ($node["id"]); ?>">
                                <input type="hidden" name="pid" value="<?php echo ($node["pid"]); ?>">
                                <input type="hidden" name="level" value="<?php echo ($node["level"]); ?>">

                                <button class="btn btn-primary" type="submit">保存</button>
                                <button class="btn btn-default" type="reset">清空</button>
                            </form>

                        </div>
                    </div>
                </div>
            </div>

        </div>
    </div>

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


<script type="text/javascript" src="/TestProject/TP32Admin/Public/admin/js/bootstrap.switch/bootstrap-switch.js"></script>
<script>

    $(document).ready(function() {
        $('.switch').bootstrapSwitch();

    });

</script>
</body>
</html>