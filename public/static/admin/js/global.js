/**
 *
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
            layer.load(0, {shade: false}); //0代表加载的风格，支持0-2
        },
        error: function(request) {
            layer.closeAll();
            layer.alert('网络错误!')
        },
        success: function(data) {
            //关闭加载层
            layer.closeAll();
            if(data.code == true){

                layer.alert(data.data, function(){
					if (refreshUrl && refreshUrl != 'reload') {
						location.href = refreshUrl;
						return;
					}
                    location.reload();
                });
                
            }else{
                layer.alert(data.data, function() {
				 	location.reload();
				});
            }

        }
    });

    return false;
}

function formValid() {
    //表单验证
    $.validator.setDefaults({
        highlight: function(e) {
            $(e).closest(".form-group").removeClass("has-success").addClass("has-error")
        },
        success: function(e) {
            e.closest(".form-group").removeClass("has-error").addClass("has-success")
        },
        errorElement: "span",
        errorPlacement: function(e, r) {
            e.appendTo(r.is(":radio") || r.is(":checkbox") ? r.parent().parent().parent() : r.parent())
        },
        errorClass: "help-block m-b-none",
        validClass: "help-block m-b-none"
    });
}

/**
 * 获取时间插件
 */
function getDaterangepicker(label,isShowTime){
	var D = new Date();
	var defaultStartDate  = D.getFullYear() + '-' + (D.getMonth()+1) + '-' +D.getDate();
	var defalutEndDate	  = D.getFullYear() + '-' + (D.getMonth()+1) + '-' +D.getDate();
	var today = defaultStartDate;
	var pickerParam = {
		format:'YYYY-MM-DD',
		timePicker: false,
		today:defaultStartDate,
		ranges:{
           '今天': [moment(), moment()],
           '昨天': [moment().subtract('days', 1), moment().subtract('days', 1)],
           '最近7天': [moment().subtract('days', 6), moment()],
           '最近30天': [moment().subtract('days', 29), moment()],
		}
	}
	if (isShowTime) {
		pickerParam.format 	= 'YYYY-MM-DD HH:mm:ss';
		pickerParam.timePicker 	=  true;
		pickerParam.today 	=  defaultStartDate + '23:59:59';
		pickerParam.ranges = null;
	}
	$(label).daterangepicker({
		format:pickerParam.format,
		singleDatePicker: false,
		showDropdowns: true,
		minDate:'2016-01-01',
		maxDate:pickerParam.today,
		startDate:'2017-01-01',
        showWeekNumbers: true,
        timePicker: pickerParam.timePicker,
        timePickerIncrement: 1,
        timePicker12Hour: true,
        ranges: pickerParam.ranges,
        opens: 'right',
        buttonClasses: ['btn btn-default'],
        applyClass: 'btn-small btn-primary',
        cancelClass: 'btn-small',
	    locale : {
            applyLabel : '确定',
            cancelLabel : '取消',
            fromLabel : '起始时间',
            toLabel : '结束时间',
            customRangeLabel : '自定义',
            daysOfWeek : [ '日', '一', '二', '三', '四', '五', '六' ],
            monthNames : [ '一月', '二月', '三月', '四月', '五月', '六月','七月', '八月', '九月', '十月', '十一月', '十二月' ],
            firstDay : 1
        }
	});
	
}

/**
 * 设置默认时间
 * @param {Object} selector
 */
function setDefaultTime(selector, rangeDate){
		var r = rangeDate ? rangeDate : 30;
    	var D = new Date();
    	var nowTime = D.getTime();
    	var s = nowTime - 3600 * 24 * r * 1000;
    	var sD = new Date(s);
    	var sDm = sD.getMonth()+1 < 10 ?('0' + (sD.getMonth()+1)) : sD.getMonth()+1;
    	var sDd = sD.getDate() < 10 ? ('0' + (sD.getDate())) : sD.getDate();
    	var Dm = D.getMonth()+1 < 10 ? ('0' + (D.getMonth()+1)) : D.getMonth()+1;
    	var Dd = D.getDate() < 10 ? ('0' + (D.getDate())) : D.getDate();
		var defaultStartDate  = sD.getFullYear() + '-' + sDm + '-' + sDd;
		var defalutEndDate	  = D.getFullYear() + '-' + Dm + '-' + Dd;
		$(selector).val(defaultStartDate +' - '+defalutEndDate);
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



