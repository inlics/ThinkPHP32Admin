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

<link rel="stylesheet" href="/TestProject/TP32Admin/Public/plugins/ztree_v3/css/zTreeStyle/zTreeStyle.css">
<style>
    .ztree li ul {
        padding-left: 40px;
    }
    .ztree li a.level0{
        font-weight: bold;
        color: #ff6400;
    }
    .ztree li a.level0 .node_name {
        margin-left: 6px;
    }
</style>
</head>

<body>

<div id="cl-wrapper" class="fixed-menu">

    <div class="container-fluid" id="pcont">
        <div class="" style="padding-top: 15px;">

            <div class="row">
                <div class="col-md-12">
                    <div class="block-flat">
                        <div class="header">
                            <h3 class="qq">角色权限配置
                                <button disabled class="btn btn-default btn-xs"><i class="fa fa-angle-right"></i></button>
                                <strong><?php echo ($name); ?></strong>
                                <a href="<?php echo U('rbac/role');?>" type="button" class="btn btn-default btn-sm">
                                    返回<i class="fa fa-angle-right"></i>
                                </a>
                            </h3>
                        </div>
                        <div class="content">

                            <ul id="permissontree" class="ztree"></ul>

                            <button class="btn btn-primary" onclick="saveNewAccess()">保存</button>

                            <!--<div class="table-responsive">
                                <form action="<?php echo U('rbac/saveNewAccess', array('rid'=>$rid));?>" method="post" target="_self">
                                    <?php if(is_array($nodeData)): foreach($nodeData as $key=>$app): ?><table class="table no-border hover app">
                                            <thead class="no-border">
                                            <tr>
                                                <th style="width:20%;">
                                                    <label>
                                                        <input type="checkbox" name="access[]" value="<?php echo ($app["id"]); ?>-1" level="1"
                                                        <?php if(in_array(($app["id"]), is_array($accessData)?$accessData:explode(',',$accessData))): ?>checked<?php endif; ?>  >
                                                        <?php echo ($app["title"]); ?>
                                                    </label>
                                                </th>
                                            </tr>
                                            </thead>
                                            <tbody class="no-border-y">
                                            <?php if(is_array($app["child"])): foreach($app["child"] as $key=>$controller): ?><tr>
                                                    <td style="padding-left: 2em;">
                                                        <label >
                                                            <input type="checkbox" name="access[]" value="<?php echo ($controller["id"]); ?>-2" level="2"
                                                            <?php if(in_array(($controller["id"]), is_array($accessData)?$accessData:explode(',',$accessData))): ?>checked<?php endif; ?>  >
                                                            <?php echo ($controller["title"]); ?>
                                                        </label>

                                                    </td>
                                                </tr>
                                                <tr class="method">
                                                    <td style="padding-left: 4em;">
                                                        <?php if(is_array($controller["child"])): foreach($controller["child"] as $key=>$method): ?><label style="display: inline-block; margin-right: 20px;">
                                                                <input type="checkbox" name="access[]" value="<?php echo ($method["id"]); ?>-1" level="3"
                                                                <?php if(in_array(($method["id"]), is_array($accessData)?$accessData:explode(',',$accessData))): ?>checked<?php endif; ?>  >
                                                                <?php echo ($method["title"]); ?>
                                                            </label><?php endforeach; endif; ?>
                                                    </td>
                                                </tr><?php endforeach; endif; ?>
                                            </tbody>
                                        </table><?php endforeach; endif; ?>
                                    <button class="btn btn-primary" type="submit">保存</button>
                                    <button class="btn btn-default" type="reset">清空</button>
                                </form>
                            </div>-->
                        </div>
                    </div>
                </div>
            </div>
            <?php if(is_array($nodeData)): foreach($nodeData as $key=>$m): echo ($m["name"]); endforeach; endif; ?>
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


<script type="text/javascript" src="/TestProject/TP32Admin/Public/plugins/ztree_v3/js/jquery.ztree.core.min.js"></script>
<script type="text/javascript" src="/TestProject/TP32Admin/Public/plugins/ztree_v3/js/jquery.ztree.excheck.min.js"></script>
<script>

    // ztree 树形属性与回调方法设置
    var setting = {
        check: {
            enable: true
        },
        data: {
            key: {
                icon: 'noicon',
                url: 'nourl',
                name: 'title'
            },
            simpleData: {
                enable: false
            },
            async: {
                enable: true
            }
        },
        callback: {
            onClick: onClickNode
        }
    };

    // 所有可选的权限节点
    var zNodes = JSON.parse('<?php echo ($nodeData); ?>');

    $(function() {
        $.fn.zTree.init($("#permissontree"), setting, zNodes);
    });

    // 点击节点时勾选或取消勾选该节点
    function onClickNode(event, treeId, treeNode) {
        var treeObj = $.fn.zTree.getZTreeObj("permissontree");
        if(treeNode.checked == true) {
            treeObj.checkNode(treeNode, false, true);
        } else {
            treeObj.checkNode(treeNode, true, true);
        }
    }

    // 为当前角色保存新的权限
    function saveNewAccess() {
        var tmp = [];
        var treeObj = $.fn.zTree.getZTreeObj("permissontree");
        var checkednodes = treeObj.getCheckedNodes(true);
        for(var i = 0; i < checkednodes.length; i++) {
            tmp.push(checkednodes[i].id);
        }
        var roleid = "<?php echo ($rid); ?>";
        console.log(tmp, roleid);
        $.ajax({
            url: '<?php echo U("saveNewAccess");?>',
            method: 'post',
            data: {
                access: tmp,
                rid: roleid
            },
            dataType: 'json',
            success: function(res) {
                if(res.err == 0) {
                    layer.msg(res.msg, {time: res.wait*1000});
                    console.log(res.url);
                    setTimeout(function() {
                        window.location.href = res.url;
                    }, res.wait*1000);
                } else {
                    layer.msg(res.msg);
                }
            },
            error: function(err) {
                layer.msg(JSON.stringify(err));
            }
        })
    }
</script>
</body>
</html>