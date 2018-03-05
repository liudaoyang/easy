/**
 * @param url
 * @param formId
 * @param param 格式为[{name:field,value:value}]
 * @param refreshUrl
 * @returns {boolean}
 */
function ajaxForm(url, formId, param, refreshUrl){
    param = param || [];
    var params = $.extend(param, $(formId).serializeArray());
    $.ajax({
        type:"POST",
        url:url,
        data:params,// 你的formid
        async: false,
        beforeSend:function(){
            layer.open({type: 2});
        },
        error: function(request) {
            layer.closeAll();
            layerMsg('网络错误!')
        },
        success: function(data) {
            //关闭加载层
            layer.closeAll();
            if(data.code == true){

                layerMsg(data.data, function(){
                    if (refreshUrl && refreshUrl != 'reload') {
                        location.href = refreshUrl;
                        return;
                    }
                    location.reload();
                });

            }else{
                layerMsg(data.data, function() {
                    location.reload();
                });
            }

        }
    });

    return false;
}

function showMoreLoading(selecter) {
	var html = '<div class="ui-loading-wrap loading-box">'+
				    '<p>加载中</p>'+
				    '<i class="ui-loading"></i>'+
				'</div>'
	$(selecter).html(html);
}

function showMoreClick(selecter) {
	var html = '<div id="showMore" class=" showMore ui-loading-wrap loading-box">'+
				    '<p>点击加载更多</p>'+
				    '<i class="ui-icon-unfold"></i>'+
				'</div>'
	$(selecter).html(html);
}

function showMoreComplete(selecter) {
	var html = '<div class="ui-loading-wrap loading-box">'+
				    '<p>没有更多数据</p>'+
				    '<i class="ui-icon-info"></i>'+
				'</div>'
	$(selecter).html(html);
}

function mdate(selecter) {
	$(selecter).mdater({
		minDate : new Date(2015, 12, 30)
	});
}

function isNull(data) {
	return (data == '' || data == undefined || data == null) ? '-' : data;
}

function tips(msg, type) {
	return $.tips({
        content:msg,
        stayTime:2000,
        type:type,
        mask:(function(){
//      	var w = $('body').with
//      	var h = $('body').
        })()
    })
}

function loading(msg, time) {
	var el = $.loading({
		content:msg,
	})
	setTimeout(function(){
		el.loading('hide');
	}, time);
	return el;
}

function config() {
	return {
		game_ids : window.game_ids
	}
}

/**
 * 设置默认时间
 * @param {Object} selector
 */
function setDefaultDate(selector_start, selector_end, day, isShowTime){
    	var D = new Date();
    	var nowTime = D.getTime();
    	var s = nowTime - 3600 * 24 * day * 1000;
    	var sD = new Date(s);
    	var sDm = sD.getMonth()+1 < 10 ?('0' + (sD.getMonth()+1)) : sD.getMonth()+1;
    	var sDd = sD.getDate() < 10 ? ('0' + (sD.getDate())) : sD.getDate();
    	var Dm = D.getMonth()+1 < 10 ? ('0' + (D.getMonth()+1)) : D.getMonth()+1;
    	var Dd = D.getDate() < 10 ? ('0' + (D.getDate())) : D.getDate();
		var defaultStartDate  = sD.getFullYear() + '-' + sDm + '-' + sDd;
		var defalutEndDate	  = D.getFullYear() + '-' + Dm + '-' + Dd;
		if (isShowTime) {
			defaultStartDate 	= defaultStartDate + ' 00:00:00';
			defalutEndDate 		= defalutEndDate + ' 23:59:59';
		}
		$(selector_start).val(defaultStartDate);
		$(selector_end).val(defalutEndDate);
}

/***
 * 获取每日时间
 * 参数2017-09-20 - 2017-09-25
 * return []
 */
function getArrDate(strDate) {
	var res = [];
	var start = strDate.substr(0, 10);
	var end = strDate.substr(-10,10);
	var sTimestamp = new Date(start).getTime();
	var eTimestamp = new Date(end).getTime();
	for (var i=1; sTimestamp <= eTimestamp; i++) {
		res.push(formatTimestamp(sTimestamp));
		sTimestamp += 24*3600*1000;
	}
	return res;
}

/**
 * 格式化时间戳
 */
function formatTimestamp(timestamp) {
	var D = new Date(timestamp);
	var m = D.getMonth()+1 < 10 ? ('0' + (D.getMonth()+1)) : D.getMonth()+1;
	var d = D.getDate() < 10 ? ('0' + (D.getDate())) : D.getDate();
	return D.getFullYear() +'-'+ m +'-'+ d;
}

var mdConfig =  {
    mode : 4, //时间选择器模式： 1 ：年月日，2 ：年月日时分（ 24 小时），3 ：年月日时分（ 12 小时），4 ：年月日时分秒。默认： 1
    format : 2, //时间格式化方式： 1 ：2015 年 06月 10 日 17 时 30分 46 秒，2 ： 2015-05-10  17:30:46。默认： 2
    years : [2017,2018,2019,2020,2021,2022,2023,2024,2025,2026,2027], // 年份数组
    nowbtn : true, //是否显示现在按钮
    onOk : null,  //点击确定时添加额外的执行函数 默认null
    onCancel : null, //点击取消时添加额外的执行函数 默认null
}

var mdaterConfig = {
    minDate : new Date(2017, 01, 01)
}

function layerMsg(msg, fn) {
    layer.open({
        content: msg
        ,btn: '确定'
		,yes:function (index) {
			if (fn) {
				fn();
			}
			layer.close(index);
        }
    });
}

function layerConfirm(msg, fn) {
    layer.open({
        content: msg
        ,btn: ['确认', '取消']
        ,yes: function(index){
			fn();
        }
    });
}