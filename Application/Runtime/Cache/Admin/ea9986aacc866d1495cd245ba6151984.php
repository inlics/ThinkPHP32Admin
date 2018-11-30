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
                            <h3>用户列表
                                <a href="<?php echo U('rbac/addUser');?>" type="button" class="btn btn-info btn-sm">
                                    <i class="fa fa-plus"></i> 添加用户
                                </a>
                            </h3>
                        </div>
                        <div class="content">
                            <div class="table-responsive">
                                <table class="table no-border hover">
                                    <thead class="no-border">
                                    <tr>
                                        <th style="width:4%;">序号</th>
                                        <th style="width:20%;"><strong>用户名称</strong></th>
                                        <th style="width:30%;"><strong>用户角色</strong></th>
                                        <th style="width:15%;"><strong>用户状态</strong></th>
                                        <th style="width:15%;" class="text-center"><strong>操作</strong></th>
                                    </tr>
                                    </thead>
                                    <tbody class="no-border-y">
                                    <?php if(is_array($userData)): foreach($userData as $key=>$v): ?><tr>
                                            <td><?php echo ($v["id"]); ?></td>
                                            <td><?php echo ($v["name"]); ?></td>
                                            <td>
                                                <?php if($v["name"] == C('RBAC_SUPERADMIN')): ?>超级管理员
                                                <?php else: ?>
                                                    <?php if(is_array($v["role"])): foreach($v["role"] as $key=>$r): ?><span style="display: inline-block; margin-right: 10px;"><?php echo ($r["name"]); ?></span><?php endforeach; endif; endif; ?>

                                            </td>
                                            <td><?php if($v["status"] == 1): ?>正常 <?php else: ?> 被禁用<?php endif; ?></td>
                                            <td class="text-center">
                                                <?php if($v["name"] == C('RBAC_SUPERADMIN')): ?><span style="color: #999; cursor: not-allowed;">不允许修改超级管理员信息</span>
                                                <?php else: ?>
                                                    <a class="label label-default" href="<?php echo U('rbac/editUser', array('id'=>$v['id']));?>">
                                                        <i class="fa fa-edit"></i> 修改
                                                    </a>
                                                    <!--<a class="label label-danger" href="<?php echo U('rbac/disableUser', array('id'=>$v['id']));?>">
                                                        <i class="fa fa-times"></i> 禁用
                                                    </a>--><?php endif; ?>

                                            </td>
                                        </tr><?php endforeach; endif; ?>
                                    </tbody>
                                </table>
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