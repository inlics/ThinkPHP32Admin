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

</head>

<body>

<div id="cl-wrapper" class="fixed-menu">

    <div class="container-fluid" id="pcont">
        <div class="" style="padding-top: 15px;">

            <div class="row">
                <div class="col-md-12">
                    <div class="block-flat">
                        <div class="header">
                            <h3 class="qq">权限节点表
                                <a href="<?php echo U('rbac/addNode');?>" type="button" class="btn btn-info btn-xs">
                                    <i class="fa fa-plus"></i> 添加应用模块
                                </a>
                            </h3>
                        </div>
                        <div class="content">
                            <div class="table-responsive">
                                <?php if(is_array($nodeData)): foreach($nodeData as $key=>$app): ?><table class="table no-border hover">
                                        <thead class="no-border">
                                        <tr>
                                            <th style="width:20%;">
                                                <strong><?php echo ($app["title"]); ?> </strong>
                                                <a href="<?php echo U('rbac/addNode', array('pid'=>$app['id'], 'level'=>'2'));?>">
                                                    [添加控制器]
                                                </a>
                                                <a href="<?php echo U('rbac/editNode', array('id'=>$app['id']));?>">
                                                    [修改]
                                                </a>
                                            </th>
                                        </tr>
                                        </thead>
                                        <tbody class="no-border-y">
                                        <?php if(is_array($app["children"])): foreach($app["children"] as $key=>$controller): ?><tr>
                                                <td style="padding-left: 2em;">
                                                    <span><?php echo ($controller["title"]); ?> </span>
                                                    <a href="<?php echo U('rbac/addNode', array('pid'=>$controller['id'], 'level'=>'3'));?>">
                                                        <strong>[添加方法]</strong>
                                                    </a>
                                                    <a href="<?php echo U('rbac/editNode', array('id'=>$controller['id']));?>">
                                                        <strong>[修改]</strong>
                                                    </a>
                                                </td>
                                            </tr>
                                            <tr>
                                                <td style="padding-left: 4em;">
                                                    <?php if(is_array($controller["children"])): foreach($controller["children"] as $key=>$method): ?><span style="display: inline-block; margin-right: 20px;">
                                                            <?php echo ($method["title"]); ?>
                                                            <a href="<?php echo U('rbac/editNode', array('id'=>$method['id']));?>">
                                                                [修改]
                                                            </a>
                                                        </span><?php endforeach; endif; ?>
                                                </td>
                                            </tr><?php endforeach; endif; ?>
                                        </tbody>
                                    </table><?php endforeach; endif; ?>
                            </div>
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


</body>
</html>