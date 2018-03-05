<?php if (!defined('THINK_PATH')) exit(); /*a:3:{s:80:"D:\wamp\www\mobadmin\public/../application/admin\view\admin\mb_adminaddedit.html";i:1513239480;s:72:"D:\wamp\www\mobadmin\public/../application/admin\view\mobile_header.html";i:1513224446;s:72:"D:\wamp\www\mobadmin\public/../application/admin\view\mobile_footer.html";i:1513237526;}*/ ?>
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
    <body ontouchstart="">
        <header class="ui-header ui-header-positive ui-border-b">
             <i class="ui-icon-return" onclick="history.back()"></i><h1>添加管理员</h1>
        </header>
        <section class="ui-container">
            <section id="tab">
            	<div class="ui-form ui-border-t">
                <form action="javascript:void(0);" id="commentForm">
                    <div class="ui-form-item ui-border-b">
			            <label for="#">用户名</label>
			            <input id="name" type="text" class="form-control" name="name" placeholder="*必填">
			        </div>
			        <div class="ui-form-item ui-border-b">
			            <label for="#">所属角色</label>
			            <div class="ui-select">
				            <select class="form-control" name="role_id" id="role_id">

	                        </select>
                        </div>
			        </div>
			        <div class="ui-form-item  ui-border-b">
			        	<label for="#">登录密码</label>
			            <input id="password" type="password" class="form-control" name="password" placeholder="*含数字,字母大小写或者特殊字符">
			        </div>
			       <div class="ui-form-item ui-border-b">
			            <label for="#">确认密码</label>
			            <input id="password2" type="password" class="form-control" name="password2" placeholder="*必填">
			        </div>
			        <div class="ui-form-item ui-form-item-radio ui-border-b">
			            <label class="ui-radio" for="radio">
			                <input id="live-status" type="radio" name="status" value="live" checked="checked">
			            </label>
			            <p style="padding-right:1rem ;">启用</p>
			            <label class="ui-radio" for="radio">
			                <input id="disabled-status" type="radio" name="status" value="disabled">
			            </label>
			            <p>禁用</p>
			        </div>
                    <div class="ui-btn-wrap">
				    	<button id="submit_form" class="ui-btn-lg">确定</button>
					</div>
					<input type="hidden" name="id" value="<?php echo input('id') ?>">
					<input type="hidden" name="type" value="<?php echo input('type') ?>">
					<input type="hidden" name="__token__" value="<?php echo \think\Request::instance()->token(); ?>" />
                </form>
            </div>
        	</section>
        	<div class="ui-loading-block">
			    <div class="ui-loading-cnt">
			        <i class="ui-loading-bright"></i>
			        <p>正在提交中...</p>
			    </div>
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

        <script>
            var g = {
                type    : "<?php echo input('type') ?>",
                id      : "<?php echo input('id')?:'' ?>",
                fieldInfo : {},
            }
            $(document).ready(function(){
                //获取编辑信息
                if (g.type == 'edit') {
                    getFieldInfo();
                }
                getRoleInfo();
                //提交
				$('#submit_form').on('click', function () {
                    validateSubmit();
                })
            })

            function getFieldInfo(param) {
                param = param || {};
                var params = $.extend(param, {
                    'id' : g.id
                });
                var fields = $('#commentForm').serializeArray();
                $.ajax({
                    'type':'post',
                    'url':'<?php echo url("admin/admin/getAdminInfo"); ?>',
                    'data':params,
                    'success' :function (res) {
                        if (res.code) {
                            g.fieldInfo = res.data;
                            $.each(fields, function (k,v) {
                                if (v.name == 'role_id' || v.name =='__token__' || v.name == 'password' || v.name == 'password2'|| v.name=='type') {
                                    return true;
                                }
                                if (v.name == 'status') {
                                    res.data.status == 'live' && $('#live-status').attr('checked',true);
                                    res.data.status == 'disabled' && $('#disabled-status').attr('checked',true);
                                    return true;
                                }
                                $('input[name="'+v.name+'"]').val(res.data[v.name]);
                            })
                        }
                    }
                })
            }

            function getRoleInfo(param) {
                param = param || {};
                var params = $.extend(param, {});
                $.ajax({
                    'type':'post',
                    'url':'<?php echo url("admin/role/getRoles"); ?>',
                    'data':params,
                    'success' :function (res) {
                        if (res.code) {
                            var html = '<option value="">请选择</option>';
                            $.each(res.data, function (k,v) {
                                html += '<option value="'+v.id+'" '+(v.id == g.fieldInfo.role_id?'selected':'')+'>'+v.name+'</option>'
                            })
                            $('#role_id').html(html);
                        }
                    }
                })
            }
            
			function validateSubmit() {
				if ($('#name').val() == '') {
					layerMsg('用户名不能为空');return;
				}
				if ($('#role_id').val() == '') {
					layerMsg('角色名不能为空');return;
				}
				if ($('#password').val() == '') {
				    layerMsg('密码不能空');return;
				}
				if ($('#password').val() !== $('#password2').val()) {
				    layerMsg('两次密码不一致');return;
				}
                ajaxForm('<?php echo url("admin/admin/adminaddedit"); ?>', '#commentForm');
            }            
            
        </script>
    </body>
</html>