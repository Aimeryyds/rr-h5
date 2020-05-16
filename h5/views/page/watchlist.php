<!DOCTYPE html>
<html>
<head>
<title><?=$site_title;?></title>
<meta name="description" content="" />
<meta name="keywords"    content="" />
<?php require_once('views/_header.php');?>
<link href="static/css/record.css?v=<?=$version?>" rel="stylesheet"/>
</head>
<body>

<div class="header">
<a href="javascript:hBack();">
<em class="icon iconfont back">&#xe600;</em>
</a>
观看历史
<span id="headerBtn" data="edit">编辑</span>
</div>

<div class="main">
	<div class="container"></div>
	
	<div class="panel">
		<div class="op all" data="1">全选</div>
		<div class="op delete" data="0">删除</div>
	</div>
<div class="notfound_bg">
    <div class="notfound_content">
        <img  src="static/img/search_notFounf.png"/>
        <br>
        没有找到相关内容
    </div>
</div>	
</div>

<?php require_once('_pagefooter.php');?>
<script src="static/js/record.js?v=<?=$version?>"></script>
<script>
	$(document).ready(function(){
	    init();
        if(localStorage.getItem('jjbSkin')=='4'){
            $('body,.header,.main,.main .panel .op').css('background-color','#FFFFFF');
            $('*').css('color','#666666');
            $('.header span').css('color','#ff09af');
        }
	});
	
	function onFinishInit(){
		console.log('finish init');
		xuanWatchList();
	}
	
	function bindEvent() {
		bindClick();
		
		$('.main .panel .delete').click(function(){
			if($(this).attr('data')=='1'){
				if(confirm('确认删除?')){
					var arr=$('.main .btn em[data="pink"]');
					for(var i=0;i<arr.length;i++){
						var id=$('.main .btn em[data="pink"]:eq('+i+')').attr('id');
						deleteWatchList(id);
					}
					location.reload();
				}
			}
		});
	}
	
	function xuanWatchList(){
		var arr=JSON.parse(localStorage.getItem('watchList'));
		if(arr!=null){
			if(arr.length>0){
				var html='';
				for(var i=0;i<arr.length;i++){
				var obj=arr[i];
					console.log(obj);
					html+='<div class="row">';
					html+='<div class="btn"><em id='+obj.video_id+' class="icon iconfont pick" data="white">&#xe6ce;</em></div>';
					html+='<div class="pic">';
					html+='<a href="?s=page/play/'+obj.video_id+'/'+obj.address_id+'">';
					html+='<div class="imgwrap">';
					html+='<img class="lazy" data-original="'+obj.image+'" title="'+obj.details.title+'" alt="'+obj.details.title+'">';
					html+='</div>';
					html+='</a>';
					html+='</div>';
					html+='<div class="desc">';
					html+='<a href="?s=page/play/'+obj.video_id+'/'+obj.address_id+'">';
					html+='<h1 title="'+obj.details.title+'">'+getSubStr(obj.details.title,12)+'</h1>';
					html+='</a>';
					html+='<p>观看至'+getProgress(obj)+'%</p>';
					html+='</div>';
					html+='</div>';
				}
				$('.main .container').html(html);
				if(localStorage.getItem('')){
					$('.main .row .desc h1,.main .row .btn em').css('color','#666666');
					$('.main .row .desc p').css('color','#999999');
				}
				setLazyLoad();
				bindEvent();
			}else{
				$('.main .container').append(getLoading('暂无数据'));
				if(localStorage.getItem('jjbSkin')=='4'){
					$('.notfound_bg').css({'display':'block','overflow':'hidden','top':'50px'});
					 event.stopPropagation();
				}
	           
            $('body').css('overflow','hidden');
			}
		}
	}
	
	function getProgress(obj){
		var progress=0;
		if(obj.currentTime!=null && obj.totalTime!=null){
			progress=Math.floor((obj.currentTime/obj.totalTime)*100);
		}
		return progress;
	}
	
</script>		
</body>
</html>