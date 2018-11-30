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
                            <h3>编辑用户
                                <a href="<?php echo U('rbac/user');?>" type="button" class="btn btn-default btn-sm">
                                    返回 <i class="fa fa-angle-right"></i>
                                </a>
                            </h3>
                        </div>
                        <div class="content">

                            <form id="editUser">
                                <div class="form-group">
                                    <label>用户名称：</label>
                                    <input type="text" name="name" placeholder="请输入用户名称" value="<?php echo ($userData["name"]); ?>"
                                           class="form-control" readonly>
                                </div>

                                <div class="form-group">
                                    <label>手机号：</label>
                                    <input type="number" name="phone" placeholder="请输入手机号"
                                           value="<?php echo ($userData["phone"]); ?>" class="form-control">
                                </div>

                                <div class="form-group">
                                    <label>邮箱：</label>
                                    <input type="email" name="email" placeholder="请输入邮箱"
                                           value="<?php echo ($userData["email"]); ?>" class="form-control">
                                </div>

                                <div class="form-group">
                                    <label>分配角色：</label>
                                    <?php if(is_array($roleData)): foreach($roleData as $key=>$role): ?><label style=" margin-right: 10px;">
                                            <input type="checkbox" name="role_id[]" value="<?php echo ($role["id"]); ?>"
                                                <?php if(in_array(($role["id"]), is_array($role_ids)?$role_ids:explode(',',$role_ids))): ?>checked<?php endif; ?> ><?php echo ($role["name"]); ?>
                                        </label><?php endforeach; endif; ?>
                                </div>

                                <div class="form-group">
                                    <label>用户状态（当前：<span id="st">默认开启</span>）：</label>
                                    <input class="switch" name="cstatus" type="checkbox" checked data-on-color="success"
                                           data-off-color="primary" onchange="chgST()">
                                    <input type="hidden" name="status" value="1">
                                </div>

                                <input type="hidden" name="id" value="<?php echo ($userData["id"]); ?>">
                            </form>
                            <button class="btn btn-primary eventSaveBtn">保存</button>
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
<script type="text/javascript" src="/TestProject/TP32Admin/Public/plugins/jquery/jquery.serializejson.js"></script>
<script>

    $(document).ready(function() {
        $('.switch').bootstrapSwitch();
    });

    $('.eventSaveBtn').click(function() {
        var postdata = $("form#editUser").serializeJSON();
        console.log(postdata);
        if(postdata.name == "") {
            layer.msg('用户名必填'); return;
        }
        if(postdata.phone == "" || !is_mobile_phone(postdata.phone)) {
            layer.msg('请填写正确的手机号'); return;
        }
        if(postdata.email == "" || !is_email(postdata.email)) {
            layer.msg('请填写正确的邮箱地址'); return;
        }
        $.ajax({
            url: '<?php echo U("editUser");?>',
            method: 'post',
            data: postdata,
            dataType: 'json',
            success: function(res) {
                if(res.err == 0) {
                    layer.msg(res.msg, {time: res.wait*1000});
                    setTimeout(function() {
                        top.location.reload();
                    }, res.wait*1000);
                } else {
                    layer.msg(res.msg);
                }
            },
            error: function(err) {
                layer.msg(err.msg);
            }
        })
    })

</script>
</body>
</html>