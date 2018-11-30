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
    .butstyle {
        padding: 10px;
        margin: 0 10px 0 0;
    }
    .butstyle:last-child {
        margin-right: 0;
    }
    .butstyle h3 {
        margin-top: 8px;
    }
    .stats_bar {
        width: 100%;
        padding: 0 15px;
        display: flex;
    }
    .stats_bar>div {
        flex: 1;
    }
</style>
</head>

<body>

<div id="cl-wrapper" class="fixed-menu">

    <div class="container-fluid" id="pcont">
        <div class="cl-mcont" style="padding-top: 15px;">

            <div class="stats_bar">
                <div class="butpro butstyle" data-step="2" data-intro="<strong>Beautiful Elements</strong> <br/> If you are looking for a different UI, this is for you!.">
                    <div class="sub"><h3>演示数据</h3><span id="total_clientes">170</span></div>
                </div>
                <div class="butpro butstyle">
                    <div class="sub"><h3>演示数据</h3><span>$951,611</span></div>
                </div>
                <div class="butpro butstyle">
                    <div class="sub"><h3>演示数据</h3><span>125</span></div>
                </div>
                <div class="butpro butstyle">
                    <div class="sub"><h3>演示数据</h3><span>18</span></div>
                </div>
                <div class="butpro butstyle">
                    <div class="sub"><h3>演示数据</h3><span>3%</span></div>
                </div>
                <div class="butpro butstyle">
                    <div class="sub"><h3>演示数据</h3><span>184</span></div>
                </div>

            </div>

            <div class="row dash-cols">

                <div class="col-sm-6 col-md-6">
                    <div class="block">
                        <div class="header no-border">
                            <h2>演示数据</h2>
                        </div>
                        <div class="content blue-chart"  data-step="3" data-intro="<strong>Unique Styled Plugins</strong> <br/> We put love in every detail to give a great user experience!.">
                            <div id="site_statistics" style="width: 100%; height:180px; font-size: 14px;"></div>
                        </div>
                        <div class="content">
                            <div class="stat-data">
                                <div class="stat-blue">
                                    <h2>1,254</h2>
                                    <span>Total Sales</span>
                                </div>
                            </div>
                            <div class="stat-data">
                                <div class="stat-number">
                                    <div><h2>83</h2></div>
                                    <div>Total hits<br /><span>(Daily)</span></div>
                                </div>
                                <div class="stat-number">
                                    <div><h2>57</h2></div>
                                    <div>Views<br /><span>(Daily)</span></div>
                                </div>
                            </div>
                            <div class="clear"></div>
                        </div>
                    </div>
                </div>

                <div class="col-sm-6 col-md-6">
                    <div class="block">
                        <div class="header no-border">
                            <h2>演示数据</h2>
                        </div>
                        <div class="content red-chart">
                            <div id="site_statistics2" style="width: 100%; height:180px; font-size: 14px;"></div>
                        </div>
                        <div class="content no-padding">
                            <table class="red">
                                <thead>
                                <tr>
                                    <th>Name</th>
                                    <th class="right"><span>25%</span>C.P.U</th>
                                    <th class="right"><span>29%</span>Memory</th>
                                    <th class="right"><span>16%</span>Disc</th>
                                </tr>
                                </thead>
                                <tbody class="no-border-x">
                                <tr>
                                    <td style="width:40%;"><i class="fa fa-sitemap"></i> Server load</td>
                                    <td class="text-right">0,2%</td>
                                    <td class="text-right">13,2 MB</td>
                                    <td class="text-right">0,1 MB/s</td>
                                </tr>
                                <tr>
                                    <td><i class="fa fa-tasks"></i> Apps</td>
                                    <td class="text-right">0,2%</td>
                                    <td class="text-right">13,2 MB</td>
                                    <td class="text-right">0,1 MB/s</td>
                                </tr>
                                <tr>
                                    <td><i class="fa fa-signal"></i> Process</td>
                                    <td class="text-right">0,2%</td>
                                    <td class="text-right">13,2 MB</td>
                                    <td class="text-right">0,1 MB/s</td>
                                </tr>
                                <tr>
                                    <td><i class="fa fa-bolt"></i> Wamp Server</td>
                                    <td class="text-right">0,2%</td>
                                    <td class="text-right">13,2 MB</td>
                                    <td class="text-right">0,1 MB/s</td>
                                </tr>
                                </tbody>
                            </table>
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



<script>
    $(document).ready(function() {
        var lineDataset = [{label: "line1",data: pageviews}];
        var barDataset = [{label: 'bar1', data: visitors}];

        $.plot($("#site_statistics"), lineDataset, lineOptions);
        $.plot($("#site_statistics2"), barDataset, barOptions);

        plotHover('#site_statistics');
        plotHover('#site_statistics2');
    })
</script>
</body>
</html>