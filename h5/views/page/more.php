<!DOCTYPE html>
<html>
<head>
<title><?=$site_title;?></title>
<meta name="description" content="" />
<meta name="keywords"    content="" />
<?php require_once('views/_header.php');?>
<style>
	.header{
		position: fixed;
		left: 0;
		right: 0;
		top: 0;
		z-index: 99;
		padding: 5px;
		text-align: center;
		background-color: #111111;
		color: #FFFFFF;
		font-size: 16px;
		line-height: 30px;
	}
	
	.header .top{
		position: relative;
		height: 33px;
	}
	
	.header .top span.title{
		color: #FFFFFF;
		font-size: 16px;
		line-height: 30px;
	}
	
	.header .top .back{
		color: #FFFFFF;
		margin: 0px 3px;
		position: absolute;
    	left: 10px;
	}
	
	.main{
		background-color: #111111;
		margin-top: 43px;
		margin-bottom: 0px;
	}
	
	.main .container{
		padding-top: 0px;
	}
	
	.main .row{
		display: flex;
		padding: 2px;
	}
	
	.main .row .op{
		flex: 1;
	    padding: 2px;
	    overflow: hidden;
	}
	
	.main .row .op .pic{
		position: relative;
	    width: 100%;
	    border-radius: 5px;
	    overflow: hidden;
	}
	
	.main .row .op .pic img{
		display: block;
		height: 150px;
	}
	
	.main .row .op .pic span{
		position: absolute;
	    bottom: 2px;
	    right: 5px;
	    color: #f97937;
	    font-weight: bold;
	}
	
	.main .row .op .title{
		cursor: pointer;
		line-height: 30px;
	}
	
</style>
</head>
<body>
<div class="header">
<div class="top">
	<a href="javascript:hBack();"><em class="icon iconfont back">&#xe600;</em></a>
	<span class="title"></span>
</div>
<!--
<div class="category"></div>
-->
</div>

<div class="main">
	<div class="container"></div>
</div>

<?php require_once('_pagefooter.php');?>
<script>
	var route=<?=json_encode($route)?>;
	var lock=false;
	var page=0;

	$(document).ready(function(){
	    bindEvent();
	    setLazyLoad();
	    init();
        if(localStorage.getItem('jjbSkin')=='4'){
            $('body,.header,.main').css('background-color','#FFFFFF');
            $('*').css('color','#333333');
            $('.main .row .op .pic span').css('right','18px');
        }
	});
	
	function onFinishInit(){
		console.log('finish init');
		var activeId=route[2];
		getSub(activeId);
	}
	
	function bindEvent() {
		var self=this;
		$(window).scroll(function(){
			var scrollTop = $(this).scrollTop();
            var scrollHeight = $(document).height();
            var windowHeight = window.innerHeight;
			if (scrollTop + windowHeight == scrollHeight) {
				self.getList();
				self.lock = true;	
			}
		});
	}
	
	function getSub(activeId){
		ajax_get('v1/home/recomment?p=0&ps=20&cate_id='+activeId,function(data){
			if(data.code==200){
				console.log(data);
				var arr=data.data.plate;
				var label='';
				for(var i=0;i<arr.length;i++){
					var obj=arr[i];
					if(obj.plate_id==route[3]){
						label=obj.plate_name;
						break;	
					}
				}
				$('.header span.title').html(label);
				getList();				
			}
		});
	}
	
	function getList(){
		var self=this;
		if(!self.lock){
			$('.main .container').append(getLoading('加载中..'));
			var url='v1/video/more?cate_id='+route[2]+'&p='+page+'&ps=15';
			if(route[3]!=null){url+='&plate_id='+route[3]}
			ajax_get(url,function(data){
				$('.main .container .loading').remove();
				if(data.code==200){
					console.log(data);
					if(data.data.length>0){
						var arr=getThreeArr(data.data);
						var html='';
						for(var i=0;i<arr.length;i++){
							var rowArr=arr[i];
							html+='<div class="row">';
							for(var j=0;j<rowArr.length;j++){
								var obj=rowArr[j];
								html+='<div class="op">';
								if(obj.video_id!=null){
									html+='<a href="?s=page/play/'+obj.video_id+'">';
									html+='<div class="pic">';
									html+='<img class="lazy" '+'title="'+obj.title+'" alt="'+obj.title+'" data-original="'+obj.image+'">';
									html+='<span>'+obj.score+'</span>';
									html+='</div>';
									html+='<div class="title" title="'+obj.title+'">';
									html+=getSubStr(obj.title,8);
									html+='</div>';
									html+='</a>';
								}
								html+='</div>';
							}
							html+='</div>';
						}				
						$('.main .container').append(html);
						if(localStorage.getItem('jjbSkin')=='4'){
				            $('.main .row .op .title').css('color','#666666');
				            $('.main .row .op .pic span').css('right','18px');
				        }
						setLazyLoad();
						self.lock = false;
						self.page++;
					}else{
						$('.main .container').append(getLoading('没有更多了'));
					}
				}
			});
		}
	}
</script>		
</body>
</html>