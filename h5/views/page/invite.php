<!DOCTYPE html>
<html>
<head>
<title><?=$site_title;?></title>
<meta name="description" content="" />
<meta name="keywords"    content="" />
<?php require_once('views/_header.php');?>
<style>
html {
  background: url(static/img/qrbg.png) no-repeat center center fixed;
  -webkit-background-size: cover;
  -moz-background-size: cover;
  -o-background-size: cover;
  background-size: cover;
}

body{
	background: transparent;
	height: 100%;
}

.header{
	position: relative;
	padding: 10px;
	text-align: center;
	color: #FFFFFF;
	font-size: 16px;
	line-height: 20px;
	height: 25px;
}

.header em{
	position: absolute;
	left: 10px;
	color: #FFFFFF;
	font-size: 16px;
	line-height: 20px;
}

.main{
	background:transparent;
	padding: 0px 10px;
}

.main .qrdiv{
	width: 60%;
	margin: 0px auto 10px;
	background-color: #FFFFFF;
	border-radius: 10px;
	padding: 10px;
}

.main .qrdiv img{
	display: block;
	width: 100%;
	min-height: 200px;
}

.main .qrdiv p{
	padding:10px 5px 5px;
	color: #333333;
	font-size: 16px;
	font-weight: bold;
}

.main .qrdiv p span{
	color: #333333;
	font-size: 16px;
	font-weight: bold;
}

.main .row{
	padding: 10px;
	text-align: center;
}

.main .row .btn {
    font-size: 16px;
    color: #FFFFFF;
    padding: 8px 20px;
    background-image: linear-gradient(to right , #e8029d, #ff09af);
    border: none;
    border-radius: 20px;
    outline: none;
    cursor: pointer;
    width: 50%;
}

</style>
</head>
<body>

<div class="header">
<a href="javascript:hBack();">
<em class="icon iconfont back">&#xe600;</em>
</a>
</div>

<div class="main">
	
	<div class="qrdiv">
		<img id="qr_pic"/>
		<p>我的推广码：<span id="invite_code">-</span></p>
	</div>
	
	<div class="row">
		浏览器扫描二维码,下载APP
	</div>
	
	<div class="row">
		<button id="saveImage" class="btn">保存图片分享</button>
	</div>
	
	<div class="row">
		<button id="copy" class="btn">链接分享</button>
	</div>

</div>
<div class="notfound_bg">
    <div class="notfound_content">
        <img  src="static/img/search_notFounf.png"/>
        <br>
        没有找到相关内容
    </div>
</div>
<?php require_once('_pagefooter.php');?>
<script src="static/js/jquery.copy.js" charset="UTF-8"></script>
<script>
	$(document).ready(function(){
	    
        if(localStorage.getItem('jjbSkin')=='4'){
        	if(localStorage.getItem('private_ys')==1){//隐私模式
			$('body,.header,.footer,.notfound_bg,.notfound_content,.qrdiv').css('background-color','#FFFFFF');
            $('body,em').css('color','#333333');
            $('body').css('overflow','hidden');
        	}
        }
        
        if(localStorage.getItem('private_ys')==1){//隐私模式
        	 $('.notfound_bg').css({'display':'block','bottom':0,'top':$('.header').height()+10});
          	if(localStorage.getItem('jjbSkin')=='4'){//简洁白
             	$('.header').css('color','#FFFFFF');
             	$('.header em').css('color','#333333');
             }else{
             	$('.header').css('color','#000000');
             	$('.header em').css('color','#FFFFFF');
             }
        }else {
            $('.notfound_bg').hide();
        }
        bindEvent();
	    init();
	});
	
	function onFinishInit(){
			console.log('finish init');
			getData();
	}
	
	function bindEvent() {
			$('#saveImage').click(function(){
				alert('长按二维码,在弹框里选择保存即可将图片保存到相册');
			});
	}
	
	function getData(){
		ajax_get('v1/share/link',function(data){
			if(data.code==200){
				console.log(data);
				var obj=data.data;
				$('#invite_code').html(obj.invite_code);
				
				var url='https://api.qrserver.com/v1/create-qr-code/?size=300x300&data='+obj.invite_url;
				$('.qrdiv img').attr('src',url);

				$.copy({
					text: "链接已复制,去分享吧", //分享提示文案
					copyUrl: obj.invite_url, //自定义复制链接地址
					tipTime: 2000, //分享提示消失时间
					copyId: "#copy" //复制按钮id
				});
			}
		});
	}
</script>	
</body>
</html>