var _baseapi='https://vapi.sskk168.com/';
//var _api='https://prdapi.sskk168.com';
var _api=_baseapi;

var imgUploadUrl='https://img.sskk168.com/';
var appDownUrl='http://down.sskk168.com/';

var _device=3;
var _scrollBottom=120;

function init(){
	handleToken();
	getDomains();
}

function getDomains() {
	var domain=localStorage.getItem('domain');
	if(domain){
		_api=domain;
	}else{
		ajax_get('v1/url/index',function(data){
			$('.main .container .loading').remove();
			if(data.code==200){
				var userableDomain=testDomain(data.data);
				if (userableDomain){
					localStorage.setItem('domain',userableDomain+'/');
					_api=userableDomain+'/';
				}

			}
		});
	}
}

function testDomain(domains) {
	var userable=false;
	for (var i=0;i<domains.length;i++){
		$.ajax({
			type: "GET",
			url: domains[i]+'/v1/url/index',
			dataType: "json",
			async:false,
			headers: {
				authorization: getAccessToken()
			},
			success: function(data) {
				userable=true;
			},
			error: function(err) {
				console.log(err);
			}
		});
		if (userable){
			return domains[i];
		}
	}
	return  false;
}

function handleToken(){
	//localStorage.clear();
	var profile=JSON.parse(localStorage.getItem('profile'));
	if(profile==null){
		getToken();
	}else{
		var now=(new Date()).getTime();
		var dis=now-profile.time;
		if(dis>(60*60*1000)){
			getToken();
		}else{
			var merchant_id=getQueryString('merchant_id');
			if(merchant_id!=null){//强制重新绑设备
				getToken();
			}else{
				baseInit(profile);
				onFinishInit();
			}
		}
	}
}

function getToken(){
	var fingerprint = new Fingerprint().get();
	var param={
		imei:fingerprint,
		device:_device,
		merchant_id:getMerchantId(),
	};
	ajax_post('v1/login',param,function(data){
		if(data.code==200){
			console.log('get token');
			console.log(data);
			var profile=data.data;
				profile.time=(new Date()).getTime();
				localStorage.setItem('profile',JSON.stringify(profile));
				baseInit(profile);
				onFinishInit();
		}else{
			console.log('get token error');
			console.log(data);
		}
	},false);
}

function baseInit(profile) {
	var merchantConfig=JSON.parse(localStorage.getItem('merchantConfig'));
	if (merchantConfig==null){
		ajax_get('v1/merchant/config', function (data) {
			if (data.code == 200) {
				localStorage.setItem('merchantConfig', JSON.stringify(data.data));
				// eval(data.data[2]);
				$('body').append(data.data[2]);//代理商统计的代码片段
				console.log('eval');
				localStorage.setItem('jjbSkin',data.data[5]);
				if(data.data[5]==4){// 5:皮肤模板-2低调黑（H5）4（简洁白）6妖艳紫 8诱惑黄
                    $('body,.header,.header .sch,.category,.secCate,.board,.footer,.notfound_bg,.notfound_content').css('background-color','white');
                    $('body').css('color','black');
				}
			}
		});
	}else{
		// eval(merchantConfig[2]);
		$('body').append(merchantConfig[2]);//代理商统计的代码片段
	}
	document.title = profile.app_name;
	$('#headicon').attr('href',profile.app_logo);
}

//获取绑定设备时的merchant_id
function getMerchantId(){
	var merchant_id=11;
	var profile=JSON.parse(localStorage.getItem('profile'));
	var qMerchantId=getQueryString('merchant_id');
	if(profile!=null){merchant_id=profile.merchant_id;}
	if(qMerchantId!=null){merchant_id=qMerchantId;}
	return merchant_id;
}

function ajax_post(url, param, callback,async=true) {
	$.ajax({
		type: "POST",
		url: _api+url,
		data: param,
		dataType: "json",
		async: async,
		headers: {
        authorization:getAccessToken()
    	},
		success: function(data) {
			if (typeof callback === "function") {
				callback(data);
			}
		},
		error: function(err) {
			console.log(err);
			localStorage.removeItem('domain');
		}
	});
}

function ajax_get(url,callback) {
	$.ajax({
		type: "GET",
        url: _api+url,
		dataType: "json",
		headers: {
        authorization: getAccessToken()
    	},
		success: function(data) {
			if (typeof callback === "function") {
				callback(data);
			}
		},
		error: function(err) {
			console.log(err);
			localStorage.removeItem('domain');
		}
	});
}

function ajax_get_rap(url,callback) {
	$.ajax({
		type: "GET",
		url: url,
		dataType: "json",
		headers: {
			authorization: getAccessToken()
		},
		success: function(data) {
			if (typeof callback === "function") {
				callback(data);
			}
		},
		error: function(err) {
			console.log(err);
		}
	});
}

function ajax_customize(url, param, callback, atype) {
	$.ajax({
		type: atype,
		url: _api + url,
		data: param,
		dataType: "json",
		headers: {
			authorization: getAccessToken()
		},
		success: function (data) {
			if (typeof callback === "function") {
				callback(data);
			}
		},
		error: function (err) {
			console.log(err);
			localStorage.removeItem('domain');
		}
	});
}

function getAccessToken(){
	var accessToken=0;
	var profile=localStorage.getItem('profile');
	if(profile!=null){
		accessToken=JSON.parse(profile).access_token;
	}
	return accessToken;
}

function resetNav() {
	$(".footer .item .icon span").css("background-position-y", "0px");
	$(".footer .item .word").css("color", "#bbb8af")
}

function xuanNav(navLabel) {
	resetNav();
	var className = "." + navLabel;
	$(className).css("background-position-y", "-20px");
	$(className).parent().parent().find(".word").css("color", "#fd13a2");
}

function bindNav(){
	$(".footer .item").click(function() {
		var navLabel = $(this).find("span").attr("class");
		location.href='?s='+navLabel;
	})
}

function hBack(){
	history.go(-1);
}

function getSubStr(str,num){
	var newStr=str;
	if(str.length>num){
		newStr=str.substr(0,num)+'..';
	}
	return newStr;
}

function getActiveId(routeNum, arr) {
	var activeId = arr[0].id;
	if (route.length >= 2) {
		for (var i = 0; i < arr.length; i++) {
			var obj = arr[i];
			if (routeNum == obj.id) {
				activeId = routeNum;
				break;
			}
		}
	}
	return activeId;
}

function getThreeArr(paraList) {
	var list = paraList.concat();
	var rowNum = 3;
	var arr = [];
	if (list.length % rowNum != 0) {
		var bushu = rowNum - list.length % rowNum;
		for (var i = 0; i < bushu; i++) {
			list.push({});
		}
	}
	var times = list.length / rowNum;
	for (var j = 0; j < times; j++) {
		var tempArr = list.splice(0, rowNum);
		arr.push(tempArr);
	}
	return arr;
}

function getTwoArr(paraList) {
	var list = paraList.concat();
	var rowNum = 2;
	var arr = [];
	if (list.length % rowNum != 0) {
		var bushu = rowNum - list.length % rowNum;
		for (var i = 0; i < bushu; i++) {
			list.push({});
		}
	}
	var times = list.length / rowNum;
	for (var j = 0; j < times; j++) {
		var tempArr = list.splice(0, rowNum);
		arr.push(tempArr);
	}
	return arr;
}

function getLoading(str){
	var html='';
		html+='<div class="loading">'	
		html+=str;
		html+='</div>';
	return html;
}

//////////////////////////

function addHistory(kws){
	clearRepeatKws(kws);
	var arr=JSON.parse(localStorage.getItem('kws'));
	arr.unshift(kws);
	localStorage.setItem('kws',JSON.stringify(arr));
}

function clearRepeatKws(kws){
	var newArr=[];
	var arr=JSON.parse(localStorage.getItem('kws'));
	if(arr!=null){
		for(var i=0;i<arr.length;i++){
			if(arr[i]!=kws){
				newArr.push(arr[i]);
			}
		}
	}
	localStorage.setItem('kws',JSON.stringify(newArr));
}

function removeHistory(){
	localStorage.removeItem('kws');
}

function addWatchList(obj){
	clearRepeatWatchList(obj);
	var arr=JSON.parse(localStorage.getItem('watchList'));
	arr.unshift(obj);
	if(arr.length>100){//大于100将删除最后一个元素
		arr.pop();
	}
	localStorage.setItem('watchList',JSON.stringify(arr));
}

function clearRepeatWatchList(obj){
	var newArr=[];
	var arr=JSON.parse(localStorage.getItem('watchList'));
	if(arr!=null){
		for(var i=0;i<arr.length;i++){
			if(arr[i].video_id!=obj.video_id){
				newArr.push(arr[i]);
			}
		}
	}
	localStorage.setItem('watchList',JSON.stringify(newArr));
}

function deleteWatchList(id){
	var arr=JSON.parse(localStorage.getItem('watchList'));
	if(arr!=null){
		var index=-1;
		for(var i=0;i<arr.length;i++){
			var obj=arr[i];
			if(obj.video_id==id){
				index=i;
				break;
			}
		}
		if(index>-1){
			arr.splice(index,1);
		}
	}
	localStorage.setItem('watchList',JSON.stringify(arr));
}

function removeWatchList(){
	localStorage.removeItem('watchList');
}

function updateWatchListCurrentTime(paraObj){
	var index=-1;
	var arr=JSON.parse(localStorage.getItem('watchList'));
	if(arr!=null){
		for(var i=0;i<arr.length;i++){
			var obj=arr[i];
			if(obj.video_id==paraObj.video_id){
				index=i;
				break;
			}
		}
	}
	if(index>=0){
		arr[index]=paraObj;
		localStorage.setItem('watchList',JSON.stringify(arr));
	}
}

function getWatchListCurrentTime(id){
	var currentTime=0;
	var arr=JSON.parse(localStorage.getItem('watchList'));
	if(arr!=null){
		for(var i=0;i<arr.length;i++){
			var obj=arr[i];
			if(obj.video_id==id && obj.currentTime!=null){
				currentTime=obj.currentTime;
				break;
			}
		}
	}
	return currentTime;
}

////////////////////

function inFavList(obj){
	var bool=false;
	var arr=JSON.parse(localStorage.getItem('favList'));
	if(arr!=null){
		for(var i=0;i<arr.length;i++){
			if(arr[i].video_id==obj.video_id){
				bool=true;
				break;
			}
		}
	}
	return bool;
}

function addFavList(obj){
	var arr=JSON.parse(localStorage.getItem('favList'));
	if(arr==null){arr=[];}
	arr.unshift(obj);
	localStorage.setItem('favList',JSON.stringify(arr));
}

function deleteFavList(id){
	var arr=JSON.parse(localStorage.getItem('favList'));
	if(arr!=null){
		var index=-1;
		for(var i=0;i<arr.length;i++){
			var obj=arr[i];
			if(obj.video_id==id){
				index=i;
				break;
			}
		}
		if(index>-1){
			arr.splice(index,1);
		}
	}
	localStorage.setItem('favList',JSON.stringify(arr));
}


function setLazyLoad() {
	$("img.lazy").lazyload({
		placeholder: "static/img/grey.gif", //用图片提前占位
		// placeholder,值为某一图片路径.此图片用来占据将要加载的图片的位置,待图片加载时,占位图则会隐藏
		effect: "fadeIn", // 载入使用何种效果
		// effect(特效),值有show(直接显示),fadeIn(淡入),slideDown(下拉)等,常用fadeIn
		threshold: 200, // 提前开始加载
		// threshold,值为数字,代表页面高度.如设置为200,表示滚动条在离目标位置还有200的高度时就开始加载图片,可以做到不让用户察觉
		event: 'click', // 事件触发时才加载
		// event,值有click(点击),mouseover(鼠标划过),sporty(运动的),foobar(…).可以实现鼠标莫过或点击图片才开始加载,后两个值未测试…
		container: $(".container"), // 对某容器中的图片实现效果
		// container,值为某容器.lazyload默认在拉动浏览器滚动条时生效,这个参数可以让你在拉动某DIV的滚动条时依次加载其中的图片
		failurelimit: 10 // 图片排序混乱时
			// failurelimit,值为数字.lazyload默认在找到第一张不在可见区域里的图片时则不再继续加载,但当HTML容器混乱的时候可能出现可见区域内图片并没加载出来的情况,failurelimit意在加载N张可见区域外的图片,以避免出现这个问题.
	});
}

function getOs(){
	var obj_os='';
	var u = navigator.userAgent;
	var isAndroid = u.indexOf('Android') > -1 || u.indexOf('Adr') > -1; //android终端
	var isiOS = !!u.match(/\(i[^;]+;( U;)? CPU.+Mac OS X/); //ios终端
				
	if(!(navigator.userAgent.match(/(phone|pad|pod|iPhone|iPod|ios|iPad|Android|Mobile|BlackBerry|IEMobile|MQQBrowser|JUC|Fennec|wOSBrowser|BrowserNG|WebOS|Symbian|Windows Phone)/i))) {
		obj_os='pc';
	}else if(isAndroid){
		obj_os='android';
	}else if(isiOS){
		obj_os='ios';
	}else{
	}
	return obj_os;
}

function download(){
	if(confirm('APP可将电影下载到手机上,是否前往APP下载页?')){
		if(_appDownload!=null){
			window.open(_appDownload,'_blank');
		}
	}
}

function getAppDownLoad(){
	ajax_get('v1/share/link',function(data){
		if(data.code==200){
			console.log(data);
			var obj=data.data;
			_appDownload=obj.invite_url;			
		}
	});
}

function getQueryString(name) {
	var reg = new RegExp("(^|&)" + name + "=([^&]*)(&|$)", "i");
	var r = window.location.search.substr(1).match(reg);
	if (name=='merchant_id' && r==null && proxy_merchant_id){
		return proxy_merchant_id;
	}
	if (r != null) return unescape(r[2]);
	return null;
}

/*
function replaceFunc(str){
	return str.replace(/img.sskk168.com/g,'img.reremoban.com');
}*/
function html_decode(str) 
    { 
        var s = ""; 
        if (str.length == 0) return ""; 
        s = str.replace(/&amp;/g, "&"); 
        s = s.replace(/&lt;/g, "<"); 
        s = s.replace(/&gt;/g, ">"); 
        s = s.replace(/&nbsp;/g, " "); 
        s = s.replace(/&#39;/g, "\'"); 
        s = s.replace(/&quot;/g, "\""); 
        s = s.replace(/<br\/>/g, "\n"); 
        return s; 
    } 

function getAsHtml(arr){
	var html='';
	if(arr!=null){
		for(var i=0;i<arr.length;i++){
			var obj=arr[i];
			var str=obj.image;
				str=html_decode(str);
			if(str.indexOf('script')!=-1){
				str=str.slice(8);
				str=str.split('<');
				console.log(str[0]);
				eval(str[0]);
			}else if(str.indexOf('<img')!=-1){
				console.log(str);
				html+='<a href="javascript:handleAs(\''+obj.url+'\',\''+obj.id+'\');">';
				html+=str;
				html+='</a>';
			}else{
				html+='<a href="javascript:handleAs(\''+obj.url+'\',\''+obj.id+'\');">';
				html+='<img  style="max-width:100%" src="'+obj.image+'">';
				html+='</a>';
			}	
		}
	}
	return html;
}

function handleAs(url,id){
	var param={
		id:id
	}
	
	ajax_post('v1/ad/tracker',param,function(data){
		if(data.code==200){
			console.log(data);	
		}
	});
	
	if(url.length>0){
		var arr=url.split('http');
		if(arr.length<2){//电影地址
			var movie_id=url.split('id=')[1];
			location.href='?s=page/play/'+movie_id;
		}else{
			url='http'+arr[1];
			window.open(url,'_blank');
		}
	}
}

function xuanAs(data,label){
	var obj=data.data;
	var arr=obj[label];
	$('#'+label).html(getAsHtml(arr));
}

function upload_pic(param,dom,callback) {
	$.ajax({
		type:"POST",
		url:imgUploadUrl,
		data:param,
		dataType:"json",
		success:function(data){
			if (typeof callback === "function"){
				callback(data);
			}
		},
		error:function(err){
			console.log(err);
		}
	});
}
