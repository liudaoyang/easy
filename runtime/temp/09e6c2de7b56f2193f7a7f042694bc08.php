<?php if (!defined('THINK_PATH')) exit(); /*a:2:{s:69:"D:\wamp\www\mobadmin\public/../application/admin\view\role\index.html";i:1513677762;s:65:"D:\wamp\www\mobadmin\public/../application/admin\view\header.html";i:1513331422;}*/ ?>
<!DOCTYPE html>
<html>
<head>
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>角色列表</title>
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
            <h5>角色</h5>
        </div>
        <div class="ibox-content">
            <div class="form-group clearfix col-sm-1">
                <a href="<?php echo url('admin/role/roleAddEdit'); ?>"><button class="btn btn-outline btn-primary" type="button">添加角色</button></a>
            </div>
            <!--搜索框开始-->
            <form id='conditionForm' role="form" method="post" class="form-inline">
                <div class="content clearfix m-b">
                    <div class="form-group">
                        <label>角色名：</label>
                        <input type="text" class="form-control" id="name" name="name"  placeholder="角色名">
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
                        <th data-field="name">角色名</th>
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
<!-- 角色分配 -->
<div class="zTreeDemoBackground left" style="display: none" id="role">
    <input type="hidden" id="nodeid">
    <div class="form-group">
        <div class="col-sm-5 col-sm-offset-2">
            <ul id="treeType" class="ztree"></ul>
        </div>
    </div>
    <div class="form-group">
        <div class="col-sm-4 col-sm-offset-4" style="margin-bottom: 15px">
            <input type="button" value="确认分配" class="btn btn-primary" id="postform"/>
        </div>
    </div>
</div>
<script type="text/javascript">
    zNodes = '';
</script>
<link rel="stylesheet" href="__PLUGINS__/zTree/zTreeStyle.css" type="text/css">
<script type="text/javascript" src="__PLUGINS__/zTree/jquery.ztree.core-3.5.js"></script>
<script type="text/javascript" src="__PLUGINS__/zTree/jquery.ztree.excheck-3.5.js"></script>
<script type="text/javascript" src="__PLUGINS__/zTree/jquery.ztree.exedit-3.5.js"></script>
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
            url: "<?php echo url('admin/role/index'); ?>", //获取数据的地址
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
                    name:$('#name').val(),
                };
                return param;
            },
            responseHandler: function(res) {
                if (res.code) {
                    $.each(res.data.rows, function(k,v) {
                        if (v.id == 1) { //admin无操作选项
                            return true;
                        }
                        res.data.rows[k]['operate'] = '<div class="operate-text">'+
                            '<i class="fa fa-unlock i-success" onclick="giveAcess('+v.id+')"></i>'+
                            '<a href="<?php echo url('admin/role/roleAddEdit'); ?>?type=edit&id='+v.id+'"><i class="fa fa-edit i-success"></i></a>'+
                            '<i class="fa fa-trash i-danger i-delete" onclick="roleDel('+v.id+')"></i>'+
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

    function roleDel(id) {
        layer.confirm('是否要删除？', {
            btn: ['是','不要'] //按钮
        }, function(){
            $.ajax({
                type:'post',
                url:'<?php echo url("admin/role/roleDel"); ?>',
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

    var index = '';
    var index2 = '';
    //分配权限
    function giveAcess(id){
        $("#nodeid").val(id);
        //加载层
        index2 = layer.load(0, {shade: false}); //0代表加载的风格，支持0-2

        //获取权限信息
        $.getJSON('<?php echo url("admin/role/giveAccess"); ?>', {'type' : 'get', 'id' : id}, function(res){
            layer.close(index2);
            if(res.code){
                zNodes = res.data;  //将字符串转换成obj
                //页面层
                index = layer.open({
                    type: 1,
                    area:['350px', '600px'],
                    title:'权限分配',
                    skin: 'layui-layer-demo', //加上边框
                    content: $('#role')
                });
                //设置位置
                layer.style(index, {
                    top: '150px'
                });

                //设置zetree
                var setting = {
                    check:{
                        enable:true
                    },
                    data: {
                        simpleData: {
                            enable: true
                        }
                    }
                };

                $.fn.zTree.init($("#treeType"), setting, zNodes);
                var zTree = $.fn.zTree.getZTreeObj("treeType");
                zTree.expandAll(true);

            }else{
                layer.alert(res.data);
            }

        });
    }
    //确认分配权限
    $("#postform").click(function(){
        var zTree = $.fn.zTree.getZTreeObj("treeType");
        var nodes = zTree.getCheckedNodes(true);
        var NodeString = '';
        $.each(nodes, function (n, value) {
            if(n>0){
                NodeString += ',';
            }
            NodeString += value.id;
        });
        var id = $("#nodeid").val();
        //写入库
        $.post('<?php echo url("admin/role/giveAccess"); ?>', {'type' : 'give', 'id' : id, 'rule' : NodeString}, function(res){
            layer.close(index);
            if(res.code){
                layer.alert(res.data, function(){
                    initTable();
                });
            }else{
                layer.alert(res.data);
            }

        }, 'json')
    })


</script>
</body>
</html>
