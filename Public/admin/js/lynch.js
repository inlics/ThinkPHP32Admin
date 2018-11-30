var storage = window.localStorage;

//获取url参数
function getQueryString(name) {
    var reg = new RegExp("(^|&)" + name + "=([^&]*)(&|$)", "i");
    var r = window.location.search.substr(1).match(reg);
    if (r != null) return unescape(r[2]);
    return null
}

//获取url编码参数
function getQueryStringEncodeURI(name) {
    var reg = new RegExp("(^|&)" + name + "=([^&]*)(&|$)", "i");
    var r = decodeURI(window.location.search).substr(1).match(reg);
    if (r != null) return unescape(r[2]);
    return null
}


//返回
function history_back() {
    history.back(-1)
}


//导航
function location_to(url) {
    location.href = url
}

//提示页面错误信息
function show_page_error(errType, errMsg, deleySecond, returnUrl) {
    var errStr = '<div class="alert-danger-mark">' + '<div class="alert alert-danger alert-dismissible" role="alert">' + '<button type="button" class="close" data-dismiss="alert" aria-label="Close"></button>' + '<strong>' + errType + '⇒</strong> ' + errMsg + '</div></div>';
    $("body").append(errStr);
    if (returnUrl) {
        setTimeout('$(".alert-danger-mark").remove();location.href="' + returnUrl + '"', deleySecond)
    } else {
        setTimeout('$(".alert-danger-mark").remove()', deleySecond)
    }
}


//提示页面成功信息
function show_page_success(errType, errMsg, deleySecond, returnUrl) {
    var errStr = '<div class="alert-danger-mark">' + '<div class="alert alert-success alert-dismissible" role="alert">' + '<button type="button" class="close" data-dismiss="alert" aria-label="Close"></button>' + '<strong>' + errType + '⇒</strong> ' + errMsg + '</div></div>';
    $("body").append(errStr);
    if (returnUrl) {
        setTimeout('$(".alert-danger-mark").remove();location.href="' + returnUrl + '"', deleySecond)
    } else {
        setTimeout('$(".alert-danger-mark").remove()', deleySecond)
    }
}


//匹配手机号
function is_mobile_phone(mPhone) {
    if (!(/^1[3|4|5|8][0-9]\d{8,8}$/.test(mPhone))) {
        return false
    } else {
        return true
    }
}

function is_email(eMail){
	if(!(/^[a-zA-Z0-9_-]+@[a-zA-Z0-9_-]+(\.[a-zA-Z0-9_-]+)+$/.test(eMail))){
		return false
  } else {
    return true
  }
}

//匹配空字符串
function is_empty_str(str) {
    if (str === '' || str === null || str === undefined) {
        return true
    } else {
        return false
    }
}
//匹配数字
function is_number(str){
	if(!(/^[1-9]\d*$/.test(str))){
		return false;
	}else{
		return true;
	}
}


//设置标题，关键字，描述
function seo(site_title) {
    if (!is_empty_str(site_title)) {
        $("title").text(site_title)
    }
}


//删除字符串中的数字。
function trimNumber(str){ 
	return str.replace(/\d+/g,''); 
}

/*
* 自定义确认框
*
* @method alertBox
* @param {String} title : 提示框标题
* @param {String} msg : 提示内容
* @param {Function} funConfirm : 点击确定时调用的事件
* @param {Function} funCancel : 点击取消时调用的事件
* */
function alertBox(title, msg, funConfirm, funCancel){
	var htmlstr = '';
    var btnstr = '';

    btnstr += '<span class="alt-cancel" style="flex: 1; text-align: center; border-top: 1px solid #efefef; border-right: 1px solid #efefef;">取消</span>';
    btnstr += '<span class="success alt-confirm" style="flex: 1; text-align: center; border-top: 1px solid #efefef; color: forestgreen;">确定</span>';
    /*if(funCancel)
        btnstr += '<span class="alt-cancel">取消</span>';
    else
        btnstr += '<span onclick="removeAlertBox()">取消</span>';

    if(funConfirm)
        btnstr += '<span class="alt-success">确定</span>';
    else
        btnstr += '<span class="success" onclick="removeAlertBox()">确定</span>';*/

	htmlstr = '<div class="alert-box" style="width: 100%; height: 100%; left: 0; top: 0; z-index: 9; position: fixed; background-color: rgba(0,0,0,0.2);">'+
		'<div style="width: 36%; height: auto; min-height: 120px; margin: 20% auto; background-color: #fff; border-radius: 10px;">'+
			'<p class="title" style="width: 90%; margin: 0 auto; text-align: center; line-height: 40px; height: 40px; font-size: 14px; color: #666; border-bottom: 1px solid #efefef;">'+ title +'</p>'+
			'<div class="msg" style="width: 90%; height: 100%; margin: 20px auto; font-size: 12px; color: #333; text-align: center;">'+
				'<span>'+ msg +'</span>'+
			'</div>'+
			'<div class="foot" style="width: 100%; height: 30px; bottom: 0; left: 0; position: relative; line-height: 30px; display: flex;">'+
                btnstr +
			'</div>'+
		'</div>'+
	'</div>';

    $('body').prepend(htmlstr);

    var bdw = $('body').width();
    if(bdw<750) {
        $('.alert-box>div').css('width','70%');
    }

    $('.alt-confirm').unbind('click').bind('click', function () {
        if (funConfirm != undefined && typeof(funConfirm) == 'function') {
            funConfirm();
            removeAlertBox();
        } else {
            removeAlertBox();
        }
    });

    $('.alt-cancel').unbind('click').bind('click', function () {
        if (funCancel != undefined && typeof(funCancel) == 'function') {
            funCancel();
            removeAlertBox();
        } else {
            removeAlertBox();
        }
    });
    // event.preventDefault();
}
/*
* 清除确认框
* @method removeAlertBox
* */
function removeAlertBox(){
    $('.alert-box').fadeOut(300);
    setTimeout(function(){
        $('.alert-box').remove()
    }, 300)
}

/*
 * 自动消失的提示框
 *
 * @method showToast
 * @param {String} msg : 提示内容
 * @param {Number} t : 显示时间（s）
 * */
function showToast(msg, t){
	var htmlstr = '';
	htmlstr = 	'<div class="toast-box">'+
		'<span>'+ msg +'</span>'+
		'</div>';
	$('body').append(htmlstr);

    var toastWidth = $(".toast-box").width(),
        pageWidth = $('body').width(),
        leftval = (pageWidth - toastWidth) / 2;
    $(".toast-box").css("left",leftval);

	if(!t){
		t = 2;
	}
	/*setTimeout(function(){
		$('.toast-box').remove();
	}, t*1000);*/

    setTimeout(function(){
        $('.toast-box').fadeOut(800);
        setTimeout(function(){
            $('.toast-box').remove();
        }, 800);
    }, t*1000);
}

/*
 * 为页面添加黑色半透明遮罩层
 * @method addMask
 * */
function addMask(){
    var htmlstr = '<div class="mask" style="width: 100%; height: 100%; top: 0; left: 0; position: fixed; z-index: 8; background-color: rgba(0,0,0,0.3);"></div>';
    $('body').append(htmlstr);
}

/*
 * 将页面中的遮罩层移除
 * @method addMask
 * */
function removeMask(){
    $('.mask').remove();
}


//单张/多张图片预览
//预览当前图片  use：<input type="file" onchange="previews(this)" accept="image/gif, image/jpeg, image/png" />
function previews(file) {
	//var prevDiv = document.getElementById('preview');
	var prevDiv = $("#preview");
	if(file.files && file.files[0]) {
		var reader = new FileReader();
		reader.onload = function(evt) {
			prevDiv.attr("src",evt.target.result);
			$("#logo").val(evt.target.result);
			console.log(evt.target.result);
			//prevDiv.innerHTML = '<img src="' + evt.target.result + '" />';
		}
		reader.readAsDataURL(file.files[0]);
	} else {
		prevDiv.attr("src",'../../img/no_pic.png');
		//prevDiv.innerHTML = '<div class="img" style="filter:progid:DXImageTransform.Microsoft.AlphaImageLoader(sizingMethod=scale,src=\'' + file.value + '\'"></div>';
	}
}

//字符串反转
function turn_down_str(str) {
    var str2 = "";
    for (var i = 0; i < str.length; i++) {
        str2 += str.charAt(str.length - i - 1)
    }
    return str2
}


// 过滤特殊字符
function inTrim(s){   
	//.replace( /\s/g,"") -> 空格
	//.replace(/\{/g,"") -> 左大括号
	//.replace(/\}/g,"") -> 右大括号
    return s.replace(/\"/g,"").replace(/\{/g,"").replace(/\}/g,"").replace(/\[/g,"").replace(/\]/g,"").replace(/\'/g,"");   
}

// 过滤标点符号
function trimPunctuation(){

}
 
/*****************************补充  ********************************************/
//删除cookies 
 function delCookie(name) 
 { 
     var exp = new Date(); 
     exp.setTime(exp.getTime() - 1); 
     var cval=getCookie(name); 
     if(cval!=null) 
         document.cookie= name + "="+cval+";expires="+exp.toGMTString(); 
 }
 
// ajax封装 
function ajax(url, data, success, cache, alone, async, type, dataType, error) { 
	var type = type || 'post';//请求类型
	var dataType = dataType || 'json';//接收数据类型 
	var async = async || true;//异步请求
	var alone = alone || false;//独立提交（一次有效的提交） 
	var cache = cache || false;//浏览器历史缓存 
	var success = success || function (data) { 
		/*console.log('请求成功');*/ 
		setTimeout(function () { 
			console.log(data);
			//layer.msg(data.msg);//通过layer插件来进行提示信息 
		},500); 
		if(data.status){
			//服务器处理成功 
			setTimeout(function () { 
				if(data.url){ 
					location.replace(data.url); 
				}else{ 
					location.reload(true); 
				} 
			},1500); 
		}else{
			//服务器处理失败 
			if(alone){
				//改变ajax提交状态 
				ajaxStatus = true; 
			} 
		} 
	}; 
	var error = error || function (data) { 
		console.log(data);
		
		/*console.error('请求成功失败');*/ 
		/*data.status;//错误状态吗*/ 
		//layer.closeAll('loading'); 
		/*setTimeout(function () { 
			if(data.status == 404){ 
				alert('请求失败，请求未找到'); 
			}else if(data.status == 503){ 
				alert('请求失败，服务器内部错误'); 
			}else { 
				alert('请求失败,网络连接超时'); 
			} 
			ajaxStatus = true;
		},500); */
	}; 
	/*判断是否可以发送请求*/ 
	if(!ajaxStatus){ 
		return false; 
	} 
	ajaxStatus = false;
	//禁用ajax请求 
	/*正常情况下1秒后可以再次多个异步请求，为true时只可以有一次有效请求（例如添加数据）*/ 
	if(!alone){ 
		setTimeout(function () { 
			ajaxStatus = true; 
		},1000); 
	} 
	//console.log(data);
	$.ajax({ 
		'url': url, 
		'data': data, 
		'type': type, 
		'dataType': dataType, 
		'async': async, 
		'success': success, 
		'error': error, 
		'jsonpCallback': 'jsonp' + (new Date()).valueOf().toString().substr(-4), 
		/*'beforeSend': function () { 
			layer.msg('加载中', {通过layer插件来进行提示正在加载 icon: 16, shade: 0.01 }); 
		}, */
	}); 
} 
// submitAjax(post方式提交) 
function submitAjax(form, success, cache, alone) { 
	cache = cache || true; 
	var form = $(form); 
	var url = form.attr('action'); 
	var data = form.serialize(); 
	ajax(url, data, success, cache, alone, false, 'post','json'); 
}

/*//调用实例 
$(function () { 
	$('#form-login').submit(function () { 
		submitAjax('#form-login'); 
		return false; 
	}); 
});*/ 
// ajax提交(post方式提交) 
function post(url, data, success, cache, alone) { 
	ajax(url, data, success, cache, alone, false, 'post','json'); 
} // ajax提交(get方式提交) 
function get(url, success, cache, alone) { 
	ajax(url, {}, success, alone, false, 'get','json'); 
} // jsonp跨域请求(get方式提交) 
function jsonp(url, success, cache, alone) { 
	ajax(url, {}, success, cache, alone, true, 'get','jsonp'); 
}
function jsonppost(url, data, success, cache, alone) { 
	ajax(url, data, success, cache, alone, true, 'post','jsonp'); 
}
function form_ajax(elm){
	$('#'+elm).submit(function () { 
		submitAjax('#'+elm); 
		return false; 
	}); 
}
/*********** js数组 *****************/
//数组去重/唯一化
function arrUnique(arr){
	var r = []; 
	for(var i =
		0, l = arr.length; i < l; i++) {
	 	for(var j = i + 1; j < l; j++) {
	 		if (arr[i] === arr[j]) {
	  			j = ++i;
	  		}
	 	}
	 	r.push(arr[i]); 
	} 
	return r; 
}
//数组中是否存在X元素
function arrLinearSearch(arr, x){
	for (var i=0; i<arr.length; i++) {
		if( arr[i] == x){
			//return 'index: '+i; //index
			return true;
		}
	}
	//return 'no matched';
	return false;
}
// 根据INDEX删除某元素
function arrDel1ByIndex (arr, idx) {
	var temp = [];
	for (var i=0; i<arr.length; i++) {
		if(i !== idx){
			temp.push(arr[i])
		}
	}
	return temp;
}
// 对Date的扩展，将 Date 转化为指定格式的String
// 月(M)、日(d)、小时(h)、分(m)、秒(s)、季度(q) 可以用 1-2 个占位符， 
// 年(y)可以用 1-4 个占位符，毫秒(S)只能用 1 个占位符(是 1-3 位的数字) 
// 例子： 
// (new Date()).Format("yyyy-MM-dd hh:mm:ss.S") ==> 2006-07-02 08:09:04.423 
// (new Date()).Format("yyyy-M-d h:m:s.S")      ==> 2006-7-2 8:9:4.18 
Date.prototype.Format = function (fmt) { //author: meizz 
    var o = {
        "M+": this.getMonth() + 1, //月份 
        "d+": this.getDate(), //日 
        "h+": this.getHours(), //小时 
        "m+": this.getMinutes(), //分 
        "s+": this.getSeconds(), //秒 
        "q+": Math.floor((this.getMonth() + 3) / 3), //季度 
        "S": this.getMilliseconds() //毫秒 
    };
    if (/(y+)/.test(fmt)) fmt = fmt.replace(RegExp.$1, (this.getFullYear() + "").substr(4 - RegExp.$1.length));
    for (var k in o)
    if (new RegExp("(" + k + ")").test(fmt)) fmt = fmt.replace(RegExp.$1, (RegExp.$1.length == 1) ? (o[k]) : (("00" + o[k]).substr(("" + o[k]).length)));
    return fmt;
}

//代码如下所示：
function convertCurrency(money) {
  //汉字的数字
  var cnNums = new Array('零', '壹', '贰', '叁', '肆', '伍', '陆', '柒', '捌', '玖');
  //基本单位
  var cnIntRadice = new Array('', '拾', '佰', '仟');
  //对应整数部分扩展单位
  var cnIntUnits = new Array('', '万', '亿', '兆');
  //对应小数部分单位
  var cnDecUnits = new Array('角', '分', '毫', '厘');
  //整数金额时后面跟的字符
  var cnInteger = '整';
  //整型完以后的单位
  var cnIntLast = '元';
  //最大处理的数字
  var maxNum = 999999999999999.9999;
  //金额整数部分
  var integerNum;
  //金额小数部分
  var decimalNum;
  //输出的中文金额字符串
  var chineseStr = '';
  //分离金额后用的数组，预定义
  var parts;
  if (money == '') { return ''; }
  money = parseFloat(money);
  if (money >= maxNum) {
    //超出最大处理数字
    return '';
  }
  if (money == 0) {
    chineseStr = cnNums[0] + cnIntLast + cnInteger;
    return chineseStr;
  }
  //转换为字符串
  money = money.toString();
  if (money.indexOf('.') == -1) {
    integerNum = money;
    decimalNum = '';
  } else {
    parts = money.split('.');
    integerNum = parts[0];
    decimalNum = parts[1].substr(0, 4);
  }
  //获取整型部分转换
  if (parseInt(integerNum, 10) > 0) {
    var zeroCount = 0;
    var IntLen = integerNum.length;
    for (var i = 0; i < IntLen; i++) {
      var n = integerNum.substr(i, 1);
      var p = IntLen - i - 1;
      var q = p / 4;
      var m = p % 4;
      if (n == '0') {
        zeroCount++;
      } else {
        if (zeroCount > 0) {
          chineseStr += cnNums[0];
        }
        //归零
        zeroCount = 0;
        chineseStr += cnNums[parseInt(n)] + cnIntRadice[m];
      }
      if (m == 0 && zeroCount < 4) {
        chineseStr += cnIntUnits[q];
      }
    }
    chineseStr += cnIntLast;
  }
  //小数部分
  if (decimalNum != '') {
    var decLen = decimalNum.length;
    for (var i = 0; i < decLen; i++) {
      var n = decimalNum.substr(i, 1);
      if (n != '0') {
        chineseStr += cnNums[Number(n)] + cnDecUnits[i];
      }
    }
  }
  if (chineseStr == '') {
    chineseStr += cnNums[0] + cnIntLast + cnInteger;
  } else if (decimalNum == '') {
    chineseStr += cnInteger;
  }
  return chineseStr;
}


/*
function returnWords(w){
	var rstr = '';
	switch (w){
		case 'NOTHING':
			rstr = "暂无";
			break;
		case 'VIEW':
			rstr = "查看";
			break;
		default:
			break;
	}
	
	return rstr;
}
*/


function hide4_7ForPhone(sPhone){
	return sPhone.replace(/(\d{3})\d{4}(\d{4})/, '$1****$2');
}

function hide5_15ForPhone(sPhone){
	return sPhone.replace(/(\d{4})\d{11}(\d{4})/, '$1***********$2');
}

function space_e4BankcardNumber(elem){
	$(elem).val($(elem).val().replace(/[\s]/g, '').replace(/(\d{4})(?=\d)/g, "$1 "));
	CheckBankNo($(elem).val().replace(/\s/g, ''));
}

function CheckBankNo(t_bankno) {　　
	var bankno = $.trim(t_bankno);　　
	if(bankno == "") {　　
		$("#bankcardNumberErrInfo").css('color','red');
		$("#bankcardNumberErrInfo").text("请填写银行卡号");
		$("#bankcardNumberErrInfo").show();
		$("#errArrow").show();
		return false;
	}
	if(bankno.length < 16 || bankno.length > 19) {
		$("#bankcardNumberErrInfo").css('color','red');
		$("#bankcardNumberErrInfo").text("银行卡号长度必须在16到19之间");
		$("#bankcardNumberErrInfo").show();
		$("#errArrow").show();
		return false;
	}
	var num = /^\d*$/; //全数字
	if(!num.exec(bankno)) {
		$("#bankcardNumberErrInfo").css('color','red');
		$("#bankcardNumberErrInfo").text("银行卡号必须全为数字");
		$("#bankcardNumberErrInfo").show();
		$("#errArrow").show();
		return false;
	}
	//开头6位
	var strBin = "10,18,30,35,37,40,41,42,43,44,45,46,47,48,49,50,51,52,53,54,55,56,58,60,62,65,68,69,84,87,88,94,95,98,99";
	if(strBin.indexOf(bankno.substring(0, 2)) == -1) {
		$("#bankcardNumberErrInfo").css('color','red');
		$("#bankcardNumberErrInfo").text("银行卡号开头6位不符合规范");
		$("#bankcardNumberErrInfo").show();
		$("#errArrow").show();
		return false;
	}
	$("#bankcardNumberErrInfo").show();
	$("#errArrow").show();
	$("#bankcardNumberErrInfo").text("验证通过!");
	$("#bankcardNumberErrInfo").css('color','green');
	setTimeout(function(){
		$("#bankcardNumberErrInfo").hide();
	  $("#errArrow").hide();
	}, 600);
	return true;
}

/* aes cbc/ecb 128 */
function encrypt(str, key, iv) {
    // var testaesbeforeencrypt = $(this).val();
    var key = CryptoJS.enc.Utf8.parse(key);
    var options = {
        iv: CryptoJS.enc.Utf8.parse(iv),
        mode: CryptoJS.mode.CBC,
        padding: CryptoJS.pad.Pkcs7
    };
    // 加密
    var encryptedData = CryptoJS.AES.encrypt(str, key, options);
    var encryptedBase64Str = encryptedData.toString();

    return encryptedBase64Str;
}