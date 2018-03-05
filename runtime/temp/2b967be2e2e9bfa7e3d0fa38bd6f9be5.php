<?php if (!defined('THINK_PATH')) exit(); /*a:3:{s:73:"D:\wamp\www\mobadmin\public/../application/admin\view\login\mb_index.html";i:1513154697;s:72:"D:\wamp\www\mobadmin\public/../application/admin\view\mobile_header.html";i:1513224446;s:72:"D:\wamp\www\mobadmin\public/../application/admin\view\mobile_footer.html";i:1513237526;}*/ ?>
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
<style type="text/css">
	.container{
		background: url('__FROZENUI_IMG__/login2.jpg') no-repeat -1200px,0px;
		height: 6.2rem;
	}
	
	#tab{
		margin-top:1.2rem ;
	}
	#tab .ui-form{
		margin:20px;
		padding: 10px;
		background: rgba(255,255,255,0.1);
		border-radius: 5px;
	}
	.ui-btn-wrap{
		margin: 20px;
		padding: 0px !important;
	}
	
	#login_btn{
		background: rgba(255,255,255,0.1);
		color: #fff;
		padding: 0 10px;
	}
	.ui-form-item input{
		color: #fff;
	}
	
</style>
    <body ontouchstart="">
        <header class="ui-header ui-header-positive ui-border-b">
            <h1>登陆</h1>
        </header>
        <section class="ui-container container">
            <section id="tab">
            <div class="ui-form ui-border-t">
                <form action="javascript:void(0);">
                    <div class="ui-form-item ui-form-item-pure ui-border-b">
                        <input id="username" type="text" placeholder="账号">
                    </div>
                    <div class="ui-form-item ui-form-item-pure ui-border-b">
                        <input id="password" type="password" placeholder="密码">
                    </div>
                    <div class="ui-form-item ui-form-item-r ui-border-b">
			            <input type="text" placeholder="请输入验证码" id="code" name="code">
			            <!-- 若按钮不可点击则添加 disabled 类 -->
			            <button type="button" class="ui-border-l">
			            	<img src="<?php echo url('admin/login/checkVerify'); ?>" onclick="javascript:this.src='<?php echo url('admin/login/checkVerify'); ?>?tm='+Math.random();" style="float:right;cursor: pointer"/>
			            </button>
			        </div>
                </form>
            </div>
            <div class="ui-btn-wrap">
		    	<button id="login_btn" class="ui-btn-lg">登录</button>
			</div>
        	</section>
        </section>
        <script src="__FROZENUI_LIB__/zepto.min.js"></script>
<script src="__FROZENUI_JS__/frozen.js"></script>
<script src="__MOBILE_JS__/mdater/zepto.mdater.js?v=1.1"></script>
<link rel="stylesheet" href="__MOBILE_JS__/mdater/zepto.mdater.css">
<script src="__MOBILE_JS__/layer_mobile/layer.js?v=1.1"></script>
<link rel="stylesheet" href="__MOBILE_JS__/layer_mobile/layer.css">
<script src="__JS__/plugins/highcharts-5.0.14/code/highcharts.js" type="text/javascript"></script>

<script src="__MOBILE_JS__/global.js?v=1.6"></script>

        <script>
		    document.onkeydown=function(event){
		        var e = event || window.event || arguments.callee.caller.arguments[0];
		        if(e && e.keyCode==13){ // enter 键
		            $('#login_btn').click();
		        }
		    };
		    var lock = false;
		    $(function () {
		        $('#login_btn').click(function(){
		            if(lock){
		                return;
		            }
		            lock = true;
		            $('#login_btn').removeClass('btn-success').addClass('disabled').val('登陆中...');
		            var username = $('#username').val();
		            var password = $('#password').val();
		            var code = $('#code').val();
                    $.post("<?php echo url('login/login'); ?>",{'name':username, 'password':password, 'code':code},function(data){
                        lock = false;
                        $('#login_btn').val('登录').removeClass('btn-danger').addClass('btn-success');
                        if(data.code!=1){
                            $('#err_msg').show().html("<span style='color:red'>"+data.data+"</span>");
                            return;
                        }else{
                            console.log(data.data);
                            window.location.href=data.data;

                        }
                    });
		        });
		    });
        </script>
    </body>
</html>