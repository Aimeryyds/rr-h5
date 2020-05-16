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
我的收藏
<span id="headerBtn" data="edit">编辑</span>
</div>

<div class="main">
	<div class="container"></div>
	
	<div class="panel">
		<div class="op all" data="1">全选</div>
		<div class="op delete" data="0">删除</div>
	</div>
	
</div>

<?php require_once('_pagefooter.php');?>
<script src="static/js/record.js?v=<?=$version?>"></script>
<script>
	$(document).ready(function(){
	    init();
        if(localStorage.getItem('jjbSkin')=='4'){
            $('body,.header,.main').css('background-color','white');
            $('*').css('color','black');
        }
	});
	
	function onFinishInit(){
		console.log('finish init');
		xuanFavList();
	}
	
	function bindEvent() {
		bindClick();
		
		$('.main .panel .delete').click(function(){
			if($(this).attr('data')=='1'){
				if(confirm('确认删除?')){
					var arr=$('.main .btn em[data="pink"]');
					for(var i=0;i<arr.length;i++){
						var id=$('.main .btn em[data="pink"]:eq('+i+')').attr('id');
						deleteFavList(id);
					}
					location.reload();
				}
			}
		});
	}
	
	function xuanFavList(){
		var arr=JSON.parse(localStorage.getItem('favList'));
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
					html+='<p>'+obj.details.cate_id+'</p>';
					html+='</div>';
					html+='</div>';
				}
				$('.main .container').html(html);
				setLazyLoad();
				bindEvent();
			}else{
				$('.main .container').append(getLoading('暂无数据'));
			}
		}
	}
</script>		
</body>
</html>