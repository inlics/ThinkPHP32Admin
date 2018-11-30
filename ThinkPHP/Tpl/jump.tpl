<!DOCTYPE html>
<html lang="en">
<head>
	<meta charset="utf-8">
	<meta name="viewport" content="width=device-width, initial-scale=1.0">
	<meta name="description" content="">
	<meta name="author" content="Clean Zone,Lynch">
	<link rel="shortcut icon" href="__PUBLIC__/admin/images/favicon.ico">

	<title>
		<?php
            if(isset($message)) {
                echo '成功';
            } else {
                echo '错误';
            }
		?>
		- Statics.inlics.com
	</title>

	<!-- Bootstrap core CSS -->
	<link rel="stylesheet" href="__PUBLIC__/admin/js/bootstrap/dist/css/bootstrap.css">
	<link rel="stylesheet" href="__PUBLIC__/admin/js/jquery.gritter/css/jquery.gritter.css" type="text/css"/>
	<link rel="stylesheet" href="__PUBLIC__/admin/fonts/font-awesome-4/css/font-awesome.min.css">

	<!-- HTML5 shim and Respond.js IE8 support of HTML5 elements and media queries -->
	<!--[if lt IE 9]>
    <!--<script src="http/foxythemes.net/assets/js/MS_6.js"></script>-->
	<!--<script src="http/foxythemes.net/assets/js/MS_7.js"></script>-->
	<![endif]-->
	<!-- Custom styles for this template -->
	<link href="__PUBLIC__/admin/css/style.css" rel="stylesheet"/>

	<meta http-equiv="Content-Type" content="text/html; charset=iso-8859-1">
</head>

<body class="texture">

<!-- Fixed navbar -->
<div id="head-nav" class="navbar navbar-default navbar-fixed-top">
	<div class="container-fluid">
		<div class="navbar-header">
			<!--<button type="button" class="navbar-toggle" data-toggle="collapse" data-target=".navbar-collapse">
                <span class="fa fa-gear"></span>
            </button>-->
			<a class="navbar-brand" href="#"><span>Statics.inlics.com</span></a>
		</div>
	</div>
</div>

<!--padding-top: 50px;-->
<div style="" id="cl-wrapper">

	<div class="page-error text-center" style="color: #fff !important;">
		<h2 class="description">提示</h2>
		<!-- <h3 class=""><?php echo($message); ?></h3>-->
        <?php
            if(isset($message)) {
                echo '<h3>'.$message.'</h3>';
            } else {
                echo '<h3>'.$error.'</h3>';
            }
        ?>
        <p class="detail"></p>
        页面自动 <a id="href" href="<?php echo($jumpUrl); ?>">跳转</a> 等待时间： <b id="wait"><?php echo($waitSecond); ?></b> 秒
		<div class="install-bottom-btngroup" style="margin-top: 30px;">
            若未自动跳转，请点击此处：
			<a class="btn btn-primary" href="<?php echo($jumpUrl); ?>">跳转</a>
		</div>
	</div>

</div>
<script type="text/javascript">
    (function(){
        var wait = document.getElementById('wait'),href = document.getElementById('href').href;
        var interval = setInterval(function(){
            var time = --wait.innerHTML;
            if(time <= 0) {
                location.href = href;
                clearInterval(interval);
            };
        }, 1000);
    })();
</script>
</body>
</html>
