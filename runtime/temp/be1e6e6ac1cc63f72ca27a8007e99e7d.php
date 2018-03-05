<?php if (!defined('THINK_PATH')) exit(); /*a:2:{s:70:"D:\wamp\www\mobadmin\public/../application/admin\view\admin\index.html";i:1513066300;s:65:"D:\wamp\www\mobadmin\public/../application/admin\view\header.html";i:1513331422;}*/ ?>
<!DOCTYPE html>
<html>
<head>
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>用户列表</title>
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
    <!-- Panel Other -->
    <div class="ibox float-e-margins">
        <div class="ibox-title">
            <h5>用户名</h5>
        </div>
        <div class="ibox-content">
            <div class="form-group clearfix col-sm-1">
                <a href="<?php echo url('admin/admin/adminAddEdit'); ?>"><button class="btn btn-outline btn-primary" type="button">添加用户</button></a>
            </div>
            <!--搜索框开始-->
            <form id='conditionForm' role="form" method="post" class="form-inline">
                <div class="content clearfix m-b">
                    <div class="form-group">
                        <label>登录时间：</label>
                        <input type="text" class="form-control" name="timegap" value="" id="timegap" placeholder="时间不限">
                    </div>
                    <div class="form-group">
                        <label>用户名：</label>
                        <input type="text" class="form-control" id="name" name="name"  placeholder="用户名">
                    </div>
                    <div class="form-group">
                        <label>状态：</label>
                        <select class="form-control" id="status" name="status"  placeholder="状态不限">
                        	<option value="">不限</option>
                        	<option value="live">正常</option>
                        	<option value="disabled">禁用</option>
                        </select>
                    </div>
                    <div class="form-group">
                        <button class="btn btn-primary" type="button" style="margin-top:5px" id="search"><strong>查 询</strong>
                        </button>
                    </div>
                </div>
            </form>
            <!--搜索框结束-->
            <div class="hr-line-dashed"></div>

            <div class="example-wrap">
                <div class="example">
                    <table id="cusTable" data-height="700" >
                        <thead style="display: none;">
                        <th data-field="id">ID</th>
                        <th data-field="name">用户名</th>
                        <th data-field="role_name">所属角色</th>
                        <th data-field="login_ip">最后登录IP</th>
                        <th data-field="login_time">最后登录时间</th>
                        <th data-field="status">状态</th>
                        <th data-field="operate">操作</th>
                        </thead>
                    </table>
                </div>
            </div>
            <!-- End Example Pagination -->
        </div>
    </div>
</div>
<!-- End Panel Other -->
</div>

<script type="text/javascript">
    $(document).ready(function () {
        initTable();

        $("#search").bind("click", initTable);

        getDaterangepicker('#timegap');
    });

    function initTable() {
        $('#cusTable').bootstrapTable('destroy');
        $("#cusTable").bootstrapTable({
            method: "get",  //使用get请求到服务器获取数据
            url: "<?php echo url('admin/admin/index'); ?>", //获取数据的地址
            striped: true,  //表格显示条纹
            pagination: true, //启动分页
            pageSize: 20,  //每页显示的记录数
            pageNumber:1, //当前第几页
            pageList: [5, 10, 15, 20, 25],  //记录数可选列表
            sidePagination: "server", //表示服务端请求
            queryParamsType : "undefined",
            queryParams: function queryParams(params) {   //设置查询参数
                var param = {
                    pageNumber: params.pageNumber,
                    pageSize: params.pageSize,
                    timegap:$('#timegap').val(),
                    name:$('#name').val(),
                    status:$('#status').val()
                };
                return param;
            },
            responseHandler: function(res) {
                if (res.code) {
                    $.each(res.data.rows, function(k,v) {
                        res.data.rows[k]['operate'] = '<div class="operate-text">'+
                            '<a href="<?php echo url('admin/admin/adminAddEdit'); ?>?type=edit&id='+v.id+'"><i class="fa fa-edit i-success"></i></a>'+
                            '<i class="fa fa-trash i-danger i-delete" onclick="adminDel('+v.id+')"></i>'+
                            '</div>'
                    });
                    return {
                        rows:res.data.rows,
                        total:res.data.total
                    };
                }else{
                    layer.msg(data.data);
                }
            },
            onLoadSuccess: function(){  //加载成功时执行
                layer.msg("加载成功", {time : 1000});
            },
            onLoadError: function(){  //加载失败时执行
                layer.msg("加载数据失败");
            }
        });
    }

    function adminDel(id) {
        layer.confirm('是否要删除？', {
            btn: ['是','不要'] //按钮
        }, function(){
            $.ajax({
                type:'post',
                url:'<?php echo url("admin/admin/adminDel"); ?>',
                data:{'id':id},
                success:function (res) {
                    if (res.code) {
                        layer.alert(res.data, function () {
                            location.reload();
                        })
                    }else{
                        layer.alert(res.data);
                    }
                }
            })
        }, function(){

        });

    }


</script>
</body>
</html>
