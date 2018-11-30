<?php if (!defined('THINK_PATH')) exit();?><!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <title>Title</title>
    <meta name="viewport" content="width=device-width,initial-scale=1">
    <script src="http://res.wx.qq.com/open/js/jweixin-1.0.0.js"></script>
</head>
<body>
Gen.G out

<p><?php echo ($signPackage["appId"]); ?></p>
<p><?php echo ($signPackage["timestamp"]); ?></p>
<p><?php echo ($signPackage["nonceStr"]); ?></p>
<p><?php echo ($signPackage["signature"]); ?></p>

<script src="/TestProject/TP32Admin/Public/admin/js/jquery.js"></script>

<script src="/TestProject/TP32Admin/Public/admin/js/lynch.js"></script>
<script>
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

</body>
</html>