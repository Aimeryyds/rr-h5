<!DOCTYPE html>
<html>
<head>
<title><?=$site_title;?></title>
<meta name="description" content="" />
<meta name="keywords"    content="" />
<?php require_once('views/_header.php');?>
<style>
.header{
	position: relative;
	padding: 10px;
	text-align: center;
	color: #FFFFFF;
	font-size: 16px;
	line-height: 20px;
}

.header em{
	position: absolute;
	left: 10px;
	color: #FFFFFF;
	font-size: 16px;
	line-height: 20px;
}

.main{
	background-color: #111111;
	padding: 0px 10px;
}

.main .row{
	position: relative;
	background-color: #1D1D1D;
}

.main .row .content{
	display: inline-block;
}

.main .row .content p{
	padding: 5px;
	font-size: 15px;
}

.main .row .content p strong{
	font-size: 32px;
	color: #FFFFFF;
}

.main .row .btn{
	position: absolute;
	top: 30%;
	right: 15px;
	font-size: 16px;
	color: #FFFFFF;
	padding: 8px 20px;
	background-image: linear-gradient(to right , #e8029d, #ff09af);
	border: none;
	border-radius: 20px;
	outline: none;
	cursor: pointer;
}

</style>
</head>
<body>

<div class="header">
<a href="javascript:hBack();">
<em class="icon iconfont back">&#xe600;</em>
</a>
我的推广
</div>

<div class="main">
	<div class="row">
		<div class="content">
			<p>已邀请</p>
			<p><strong id="invent_num">-</strong>人</p>
		</div>
		
		<a href="?s=page/invite">
		<button class="btn">邀请好友</button>
		</a>
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
<script>
	$(document).ready(function(){
		 if(localStorage.getItem('jjbSkin')=='4'){
            $('body,.header,.main,.main .row,.footer,.notfound_bg,.notfound_content').css('background-color','#FFFFFF');
            $('*').css('color','black');
        }
        if(localStorage.getItem('private_ys')==1){
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

	}
	
	function getData(){
		ajax_get('v1/my/invent',function(data){
			if(data.code==200){
				console.log(data);
				var obj=data.data;
				$('#invent_num').html(obj.invent_num);
			}
		});
	}
</script>		
</body>
</html>