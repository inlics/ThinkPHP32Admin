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
                            <h3>添加用户
                                <a href="<?php echo U('rbac/user');?>" type="button" class="btn btn-default btn-sm">
                                    返回 <i class="fa fa-angle-right"></i>
                                </a>
                            </h3>
                        </div>
                        <div class="content">

                            <form id="addUser">
                                <div class="form-group">
                                    <label>用户名称：</label>
                                    <input type="text" name="name" placeholder="请输入用户名称" class="form-control"
                                        autocomplete="off">
                                </div>

                                <div class="form-group">
                                    <label>初始密码：</label>
                                    <input type="password" name="password" placeholder="请输入初始密码" class="form-control"
                                         autocomplete="off">
                                </div>

                                <div class="form-group">
                                    <label>确认密码：</label>
                                    <input type="password" name="password_2" placeholder="请确认密码" class="form-control"
                                           autocomplete="off">
                                </div>

                                <div class="form-group">
                                    <label>用户邮箱：</label>
                                    <input type="text" name="email" placeholder="请输入用户邮箱" class="form-control"
                                           autocomplete="off">
                                </div>

                                <div class="form-group">
                                    <label>用户手机号：</label>
                                    <input type="text" name="phone" placeholder="请输入用户手机号" class="form-control"
                                           autocomplete="off">
                                </div>

                                <div class="form-group">
                                    <label>分配角色：</label>
                                    <?php if(is_array($roleData)): foreach($roleData as $key=>$role): ?><label style=" margin-right: 10px;">
                                            <input type="checkbox" name="role_id[]" value="<?php echo ($role["id"]); ?>"><?php echo ($role["name"]); ?>
                                            <?php if(!empty($role["remark"])): ?><span style="font-weight: normal;">（<?php echo ($role["remark"]); ?>）</span><?php endif; ?>
                                        </label><?php endforeach; endif; ?>
                                    <!--<input type="password" name="password" placeholder="请输入角色描述" class="form-control">-->
                                </div>

                                <div class="form-group">
                                    <label>用户状态（当前：<span id="st">默认开启</span>）：</label>
                                    <input class="switch" name="cstatus" type="checkbox" checked data-on-color="success"
                                           data-off-color="primary" onchange="chgSwitch('st', 'status')">
                                    <input type="hidden" name="status" value="1">
                                </div>

                                <a class="btn btn-primary" onclick="saveNewUser();">保存</a>
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
<script type="text/javascript" src="/TestProject/TP32Admin/Public/plugins/jquery/jquery.serializejson.js"></script>
<script>

    $(document).ready(function() {
        $('.switch').bootstrapSwitch();
    });

    function saveNewUser() {
        var postdata = $("form#addUser").serializeJSON();
        var role_ids = $("input[name='role_id[]']:checked");
        console.log(postdata, role_ids);
        if(postdata.name == "") {
            layer.msg('用户名必填'); return;
        }
        if(postdata.password == "" || postdata.password.length < 6) {
            layer.msg('初始密码必填且长度必须大于等于6位'); return;
        }
        if(postdata.password_2 == "" || postdata.password.length < 6) {
            layer.msg('确认密码必填且长度必须大于等于6位'); return;
        }
        if(postdata.password_2 != postdata.password) {
            layer.msg('两次输入的密码不同'); return;
        }
        if(postdata.email == "" || !is_email(postdata.email)) {
            layer.msg('请填写正确的邮箱地址'); return;
        }
        if(postdata.phone == "" || is_mobile_phone(postdata.email)) {
            layer.msg('请填写正确的手机号'); return;
        }
        if(role_ids.length < 1) {
            layer.msg('请为用户选择一个角色'); return;
        }

        var temp = [];
        for(var i = 0; i < role_ids.length; i++) {
            temp.push(role_ids[i].value);
        }
        postdata.role_id = temp;
        $.ajax({
            url: '<?php echo U("addUser");?>',
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
    }

</script>
</body>
</html>