<?php if (!defined('THINK_PATH')) exit(); /*a:1:{s:72:"D:\wamp\www\mobadmin\public/../application/admin\view\index\welcome.html";i:1514011643;}*/ ?>
<!DOCTYPE html>
<html>
<head>
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>后台首頁</title>
    <link rel="shortcut icon" href="favicon.ico"> 
	<link href="__CSS__/bootstrap.min.css?v=3.3.6" rel="stylesheet">
    <link href="__CSS__/font-awesome.min.css?v=4.4.0" rel="stylesheet">

    <link href="__CSS__/animate.min.css" rel="stylesheet">
    <link href="__CSS__/style.min.css?v=4.1.0" rel="stylesheet">
</head>

<style type="text/css">
	.box-height{
		min-height: 400px;
	}
	.font-style{
		font: 400 14px/33px "微软雅黑";
	}
	
</style>

<body class="gray-bg">
    <div class="wrapper wrapper-content animated fadeInRight" style="padding-bottom:0px;">
	    <!-- Panel Other -->
	    <div class="ibox float-e-margins">
	        <div class="ibox-title">
	            <h5>欢迎使用<?php echo config('site_theme') ?>后台管理系统！<span style="color: cornflowerblue;">推荐使用chrome，火狐浏览器</span></h5>
	        </div>
	    </div>
	</div>
	<!-- End Panel Other -->
	<div class="wrapper wrapper-content animated fadeInRight col-sm-6">
	    <!-- Panel Other -->
	    <div class="ibox float-e-margins">
	        <div class="ibox-title">
	            <h5>使用指导</h5>
	        </div>
	        <div class="ibox-content box-height">
	        	<div class="font-style">
					<?php if(is_array($notifi) || $notifi instanceof \think\Collection): $i = 0; $__LIST__ = $notifi;if( count($__LIST__)==0 ) : echo "" ;else: foreach($__LIST__ as $key=>$vo): $mod = ($i % 2 );++$i;?>
	        		<h5><?php echo $vo['name']; ?></h5>
		        	<ul>
						<?php if(is_array($vo['data']) || $vo['data'] instanceof \think\Collection): $i = 0; $__LIST__ = $vo['data'];if( count($__LIST__)==0 ) : echo "" ;else: foreach($__LIST__ as $key=>$v): $mod = ($i % 2 );++$i;?>
		        		<li><?php echo $v; ?></li>
						<?php endforeach; endif; else: echo "" ;endif; ?>
		        	</ul>
					<?php endforeach; endif; else: echo "" ;endif; ?>
	        	</div>
	        </div>
	    </div>
	<!-- End Panel Other -->
	</div>
	<div class="wrapper wrapper-content animated fadeInRight col-sm-6">
	    <!-- Panel Other -->
	    <div class="ibox float-e-margins">
	        <div class="ibox-title">
	            <h5>更新日志</h5>
	        </div>
	        <div class="ibox-content">
				<div class="font-style">
					<?php if(is_array($updateLog) || $updateLog instanceof \think\Collection): $i = 0; $__LIST__ = $updateLog;if( count($__LIST__)==0 ) : echo "" ;else: foreach($__LIST__ as $key=>$vo): $mod = ($i % 2 );++$i;?>
					<h5><?php echo $vo['name']; ?></h5>
					<ul>
						<?php if(is_array($vo['data']) || $vo['data'] instanceof \think\Collection): $i = 0; $__LIST__ = $vo['data'];if( count($__LIST__)==0 ) : echo "" ;else: foreach($__LIST__ as $key=>$v): $mod = ($i % 2 );++$i;?>
						<li><?php echo $v; ?></li>
						<?php endforeach; endif; else: echo "" ;endif; ?>
					</ul>
					<?php endforeach; endif; else: echo "" ;endif; ?>
				</div>
	        </div>
	    </div>
		<!-- End Panel Other -->
		<!-- Panel Other -->
		<div class="ibox float-e-margins">
			<div class="ibox-title">
				<h5>联系方式</h5>
			</div>
			<div class="ibox-content">
				<div class="font-style">
					<ul>
						<li>作者：chenxing</li>
						<li>QQ：1160576079</li>
						<li>交流群：157451741</li>
						<li>博客：<a target="_blank" href="http://www.qiusuoweb.com">www.qiusuoweb.com</a></li>
					</ul>
				</div>
			</div>
		</div>
		<!-- End Panel Other -->
		<!-- Panel Other -->
		<div class="ibox float-e-margins">
			<div class="ibox-title">
				<h5>移动端后台访问二维码</h5>
			</div>
			<div class="ibox-content">
				<div class="font-style">
					<ul>
						<li style="list-style: none"><img src="__IMG__/mobile_code.png" alt=""></li>
					</ul>
				</div>
			</div>
		</div>
		<!-- End Panel Other -->
	</div>

    <script src="__JS__/jquery.min.js?v=2.1.4"></script>
    <script src="__JS__/bootstrap.min.js?v=3.3.6"></script>
</body>
</html>
