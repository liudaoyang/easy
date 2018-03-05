<?php if (!defined('THINK_PATH')) exit(); /*a:3:{s:73:"D:\wamp\www\mobadmin\public/../application/admin\view\index\mb_index.html";i:1513224291;s:72:"D:\wamp\www\mobadmin\public/../application/admin\view\mobile_header.html";i:1513224446;s:72:"D:\wamp\www\mobadmin\public/../application/admin\view\mobile_footer.html";i:1513237526;}*/ ?>
<!DOCTYPE html>
<html>
    <head>
        <meta charset="utf-8">
        <meta name="viewport" content="initial-scale=1, maximum-scale=1, user-scalable=no">
        <meta name="format-detection" content="telephone=no">
        <title><?php echo config('site_theme') ?>管理系统</title>
        <link rel="stylesheet" href="__FROZENUI_CSS__/frozen.css">
    </head>
   <style type="text/css">
       body{
           font-size: 14px;
       }
       .ui-list-link .ui-list-link-no::after {
           content: '';
       }
       .ui-form-box{
           padding-top: 15px;
       }
       .ui-form-box .ui-form-item,.ui-form-box .ui-btn-lg{
           font-size: 14px;
           height: 35px;
           line-height: 35px;
       }
       .txt-font{
           font-size:14px;
           line-height: 22px;
           font-family: "微软雅黑";
       }
       .box-content{
           border: 1px solid #eee !important;
           padding: 10px;
           margin: 10px 10px;
           border-radius: 5px;
       }
       .ul-title{
           margin-top:0.2rem;

       }
       .ul-title .content{
           width: 100px;
           height: 50px;
           display: block;
           margin: 0 auto;
           text-align: center;
           font:400 14px/50px '微软雅黑';
           position: relative;
           text-overflow: ellipsis;
           white-space:nowrap
       }
       .ul-title .content:before{
           content: '';
           display: block;
           width: 100px;
           border-bottom: 1px solid #eee;
           position: absolute;
           top: 25px;
           left: -1rem;
       }
       .ul-title .content:after{
           content: '';
           display: block;
           width: 100px;
           border-bottom: 1px solid #eee;
           position: absolute;
           top: 25px;
           right: -1rem;
       }

       .ui-selector-content{
           padding: 0 0 0.1rem 0;
       }

       .field-text{
           display: inline-block;
           width: 1.2rem;
           color: #5f5f5f;
       }

       .field-text-lg{
           display: inline-block;
           width: 1.4rem;
       }

       .select-box{
           border-top:1px solid #eee;
           padding: 10px;
           border-top-left-radius: 20px;
           border-top-right-radius: 20px;
       }

       .iconfont-color-blue{
           color: cornflowerblue;
       }
       .iconfont-color-black{
           color: black;
       }
	
</style>
<script type="text/javascript">
	window.game_ids = JSON.parse('<?php echo json_encode(config('game_ids')) ?>');
</script>
<body ontouchstart>
<header class="ui-header ui-header-positive ui-border-b">
	<h1>首页</h1>
</header>
<section class="ui-selector">
	<header class="ui-border-b">
		<h3>首页</h3>
	</header>
	<div id="">
		<ul class="ui-list ui-border-tb ui-list-text ui-list-link">
			<li class="ui-border-t" id="userInfo">
				<div class="ui-avatar-lg">
					<span style="background-image:url(/static/admin/images/profile_small.jpg)"></span>
				</div>
				<div class="ui-list-info">
					<h4 class="ui-nowrap"><?php echo \think\Session::get('admin_name'); ?></h4>
					<p class="ui-nowrap"><?php echo \think\Session::get('role_name'); ?></p>
				</div>
			</li>
	</div>
	<div class="ui-selector-content" >
		<ul>
			<?php if(!empty($menu)): if(is_array($menu) || $menu instanceof \think\Collection): if( count($menu)==0 ) : echo "" ;else: foreach($menu as $key=>$vo): ?>
			<li class="ui-selector-item nav-li">
				<h3 class="ui-border-b nav">
					<p><?php echo $vo['node_name']; ?></p>
				</h3>
				<ul class="ui-list ui-border-b child-nav">
					<?php if(!empty($vo['child'])): if(is_array($vo['child']) || $vo['child'] instanceof \think\Collection): if( count($vo['child'])==0 ) : echo "" ;else: foreach($vo['child'] as $key=>$v): ?>
					<li>
						<div class="ui-avatar-s" style="width:0.3rem;height:0.2rem;margin-left:0.2rem;border-radius:0px;background-image: url()">
							<!--<span style="background-image:url(../img/ava1.png)"></span>-->
						</div>
						<a class="ui-list-info ui-border-t" href="<?php echo $v['href']; ?>" style="display: block;"><h4><?php echo $v['node_name']; ?></h4></a>
					</li>
					<?php endforeach; endif; else: echo "" ;endif; endif; ?>
				</ul>
			</li>
		</ul>
		</li>
		<?php endforeach; endif; else: echo "" ;endif; endif; ?>
		</ul>
	</div>
</section>
<script src="__FROZENUI_LIB__/zepto.min.js"></script>
<script src="__FROZENUI_JS__/frozen.js"></script>
<script src="__MOBILE_JS__/mdater/zepto.mdater.js?v=1.1"></script>
<link rel="stylesheet" href="__MOBILE_JS__/mdater/zepto.mdater.css">
<script src="__MOBILE_JS__/layer_mobile/layer.js?v=1.1"></script>
<link rel="stylesheet" href="__MOBILE_JS__/layer_mobile/layer.css">
<script src="__JS__/plugins/highcharts-5.0.14/code/highcharts.js" type="text/javascript"></script>

<script src="__MOBILE_JS__/global.js?v=1.6"></script>

<div class="ui-actionsheet">
	<div class="ui-actionsheet-cnt">
		<h4>安全退出登录</h4>
		<button id="loginOut" class="ui-actionsheet-del">退出</button>
		<button id="loginCancel">取消</button>
	</div>
</div>
<style type="text/css">
</style>
<script type="text/javascript">
    $('#userInfo').on('click', function(){
        $('.ui-actionsheet').addClass('show');
    })
    $('#loginCancel').on('click', function(){
        $('.ui-actionsheet').removeClass('show');
    })
    $('#loginOut').on('click', function(){
        window.location.href = "<?php echo url('admin/login/loginOut'); ?>";
    })

    //菜单伸缩
    $('document').ready(function(){
        $('.nav').on('click',function(){
            var that = $(this);
            var navLi = that.parent();
            if (navLi.hasClass('active')) {
                navLi.removeClass('active');
            }else{
                navLi.addClass('active');
            }
        })
    })


</script>
</body>
</html>