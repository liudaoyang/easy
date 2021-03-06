<?php if (!defined('THINK_PATH')) exit(); /*a:3:{s:72:"D:\wamp\www\mobadmin\public/../application/admin\view\role\mb_index.html";i:1513242972;s:72:"D:\wamp\www\mobadmin\public/../application/admin\view\mobile_header.html";i:1513224446;s:72:"D:\wamp\www\mobadmin\public/../application/admin\view\mobile_footer.html";i:1513237526;}*/ ?>
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
    <i class="ui-icon-return" onclick="history.back()"></i><h1>角色列表</h1>
    <i class="ui-icon-add" style="position: absolute;top: 0px;right: 10px;" onclick="javascript:location.href=g.api.edit"></i>
</header>
<section class="ui-selector">
    <header class="ui-border-b">
        <h3>角色列表</h3>
    </header>
    <div class="ui-form-box ui-form ui-border-t">
        <form action="javascript:void(0);" id="selectForm">
            <!--<div class="ui-form-item ui-form-item-pure ui-border-b">-->
                <!--<input type="text" id="timegap-start" name="timegap_start" readonly="readonly" placeholder="起始时间">-->
            <!--</div>-->
            <!--<div class="ui-form-item ui-form-item-pure ui-border-b">-->
                <!--<input type="text" id="timegap-end" name="timegap_end" readonly="readonly" placeholder="结束时间">-->
            <!--</div>-->
            <div class="ui-form-item ui-form-item-show ui-border-b">
                <label for="#">角色名称：</label>
                <input type="text" id="name" name="username" placeholder="名称不限">
            </div>
            <div class="ui-btn-wrap">
                <button class="ui-btn-lg" id="selectFormButton">
                    查询
                </button>
            </div>
        </form>
    </div>
    <div class="ui-selector-content">
        <h3 class="ul-title"><span class="content">管理员列表</span></h3>
        <ul id="data-list" class="ui-list ui-list-text content_list"></ul>
        <div id="loadingMore"></div>
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

<script type="text/javascript">
    var g = {
        api:{
            list:"<?php echo url('admin/role/index'); ?>",
            edit:"<?php echo url('admin/role/roleAddEdit'); ?>",
            del:"<?php echo url('admin/role/roleDel'); ?>"
        },
        param:{ //查询参数
            pageNumber:1,
            pageSize:10,
        }
    }

    window.document.ready = (function() {
        //首次加载数据
        ajaxList(g.param);

        //时间控件
//        $('#timegap-start').mdater(mdaterConfig);
//        $('#timegap-end').mdater(mdaterConfig);

        //查询加载数据
        $('#selectFormButton').on('click',function() {
            g.param.pageNumber = 1;
            g.param.name = $('#name').val();
            ajaxList(g.param);
        })

        //点击加载更多
        $('#loadingMore').on('click', '#showMore', function () {
            g.param.pageNumber += 1;
            ajaxList(g.param);
        })

        //点击操作按钮
        $('#data-list').on('click', '.operate-btn', function () {
            var that = $(this);
            var typeOperate = that.data('operate');
            var type = {
                edit:operateEdit,
                del:operateDel
            }
            type[typeOperate](that);
        })

    })()

    function ajaxList(param, fn) {
        param = param || {};
        var params = $.extend(param, {});
        $.ajax({
            type:"get",
            url:g.api.list,
            async:true,
            data:params,
            success:function(res) {
                if (res.code) {
                    var html = getHhtml(res.data.rows);
                    $('#data-list').html(html);
                    if (res.data.rows.total > res.data.rows.length) {
                        showMoreClick('#loadingMore');
                    }else{
                        $('#loadingMore').html('');
                    }
                }else{
                    layerMsg(res.data);
                }
            }
        });
    }

    function getHhtml(data) {
        if (data.length == 0) return '<li class="ui-list-link-no" style="text-align: center;display:block;"><i class="ui-icon-info"></i>暂无数据</li>';
        var html = '';
        $.each(data, function(k,v) {
            html += '<li class="ui-border-t txt-font box-content">'+
                '<h4>'+
                '<ul class="txt-font">'+
                '<li><span class="field-text">ID：</span>'+v.id+'</li>'+
                '<li><span class="field-text">角色名：</span>'+v.name+'</li>'+
                '</ul>'+
                '<div style="display: flex; flex-direction: row; justify-content: space-between;margin-top: 0.2rem;">'+
                '<button data-id="'+v.id+'" data-operate="edit" class="ui-btn-s ui-btn-primary operate-btn">编辑</button>'+
                '<button data-id="'+v.id+'" data-operate="del" class="ui-btn-s ui-btn-danger operate-btn">删除</button>'+
                '</div>'+
                '</h4>'+
                '</li>'
        });
        return html;
    }

    function operateEdit(that) {
        var id = that.data('id');
        window.location.href = g.api.edit + '?type=edit&id=' + id;
    }

    function operateDel(that) {
        var id = that.data('id');
        layerConfirm('是否要删除', function () {
            $.ajax({
                type:"get",
                url:g.api.del,
                async:true,
                data:{'id':id},
                success:function(res) {
                    if (res.code) {
                        layerMsg(res.data, function () {
                            location.reload();
                        })
                    }else{
                        layerMsg(res.data);
                    }
                }
            });
        })
    }


</script>
</body>
</html>