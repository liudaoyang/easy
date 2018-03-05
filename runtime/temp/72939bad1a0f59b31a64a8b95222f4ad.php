<?php if (!defined('THINK_PATH')) exit(); /*a:2:{s:75:"D:\wamp\www\mobadmin\public/../application/admin\view\role\roleaddedit.html";i:1513130544;s:65:"D:\wamp\www\mobadmin\public/../application/admin\view\header.html";i:1513331422;}*/ ?>
<!DOCTYPE html>
<html>
<head>
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>添加角色</title>
    <link rel="shortcut icon" href="favicon.ico">
    <link href="__CSS__/bootstrap.min.css?v=3.3.6" rel="stylesheet">
    <link href="__CSS__/font-awesome.min.css?v=4.4.0" rel="stylesheet">
    <link href="__PLUGINS__/bootstrap-table/bootstrap-table.min.css" rel="stylesheet">
	<link href="__CSS__/animate.min.css" rel="stylesheet">
    <link href="__CSS__/style.min.css?v=4.1.0" rel="stylesheet">
    <link href="__PLUGINS__/daterangepicker/daterangepicker-bs3.css" rel="stylesheet">
    
    <script src="__JS__/jquery.min.js?v=2.1.4"></script>
	<script src="__JS__/bootstrap.min.js?v=3.3.6"></script>
	<script src="__JS__/content.min.js?v=1.0.0"></script>
	<script src="__PLUGINS__/bootstrap-table/bootstrap-table.min.js"></script>
	<script src="__PLUGINS__/bootstrap-table/bootstrap-table-mobile.min.js"></script>
	<script src="__PLUGINS__/bootstrap-table/locale/bootstrap-table-zh-CN.min.js"></script>
	<script src="__PLUGINS__/layer/laydate/laydate.js"></script>
	<script src="__PLUGINS__/layer/layer.min.js"></script>
	<script src="__PLUGINS__/validate/jquery.validate.min.js"></script>
	<script src="__PLUGINS__/validate/messages_zh.min.js"></script>
	<script src="__PLUGINS__/daterangepicker/moment.min.js" type="text/javascript"></script>
	<script src="__PLUGINS__/daterangepicker/daterangepicker.js" type="text/javascript"></script>
	<script src="__PLUGINS__/highcharts-5.0.14/code/highcharts.js" type="text/javascript"></script>
	<script src="__JS__/global.js?v=1.4" type="text/javascript" charset="utf-8"></script>
</head>
<style type="text/css">
	.operate-text{
		text-align: center;
	}
	.operate-text i{
		font-weight: 400;
		font-size: 18px;
		cursor: pointer;
		margin-right:20px ;
	}
	.i-success{
		color: darkgreen;
	}
	.i-danger{
		color: #D84C29;
	}
</style>
<body class="gray-bg">
<div class="wrapper wrapper-content animated fadeInRight">
    <div class="row">
        <div class="col-sm-8">
            <div class="ibox float-e-margins">
                <div class="ibox-title">
                    <h5><?php if(input('id')): ?>编辑角色<?php else: ?>添加角色<?php endif; ?></h5>
                    <div class="ibox-tools">
                        <a class="collapse-link" href="javascript:window.history.go(-1);">
                            <i class="fa fa-reply"></i>
                        </a>
                    </div>
                </div>
                <div class="ibox-content">
                    <form class="form-horizontal m-t" id="commentForm" method="post" action="javascript:void(0);" >

                        <div class="form-group">
                            <label class="col-sm-3 control-label">角色名：</label>
                            <div class="input-group col-sm-4">
                                <input id="name" type="text" class="form-control" name="name" value="">
                            </div>
                        </div>
                        <div class="form-group">
                            <div class="col-sm-4 col-sm-offset-3">
                            	<input type="hidden" name="id" value="<?php echo input('id') ?>">
                                <input type="hidden" name="type" value="<?php echo input('type') ?>">
                                <input type="hidden" name="__token__" value="<?php echo \think\Request::instance()->token(); ?>" />
                                <button class="btn btn-primary" type="submit">提交</button>
                            </div>
                        </div>
                    </form>
                </div>
            </div>
        </div>
    </div>
</div>
<div id="setRole2"></div>
<script type="text/javascript">
	var g = {
		type    : "<?php echo input('type') ?>",
		id      : "<?php echo input('id')?:'' ?>",
	}
	$(document).ready(function(){
        formValid();
        //获取编辑信息
        if (g.type == 'edit') {
            getFieldInfo();
        }
	})

    $("#commentForm").validate({
        rules: {
            name: {
                required:true,
            },
        },
        messages: {
            name: {
                required: '请输入账号',
            },
        },
        submitHandler:function(form) {
            ajaxForm('<?php echo url("admin/role/roleAddEdit"); ?>', '#commentForm');
        }
    });

	function getFieldInfo(param) {
	    param = param || {};
	    var params = $.extend(param, {
	        'id' : g.id
        });
        var fields = $('#commentForm').serializeArray();
        $.ajax({
            'type':'post',
            'url':'<?php echo url("admin/role/getRoleInfo"); ?>',
            'data':params,
            'success' :function (res) {
                if (res.code) {
                    $.each(fields, function (k,v) {
                        if (v.name =='__token__' || v.name=='type') {
                            return true;
                        }
                        $('input[name="'+v.name+'"]').val(res.data[v.name]);
                    })
                }
            }
        })
    }


</script>
</body>
</html>
