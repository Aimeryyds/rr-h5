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
		float: left;
	}
	
	.header .top em.search {
	    font-size: 22px;
	    color: #ff09af;
	    position: absolute;
    	right: 15px;
	}
	
	.header .category{
		height: 32px;
	    line-height: 30px;
	    overflow-x: scroll;
	    overflow-y: hidden;
	    white-space: nowrap;
	    -webkit-overflow-scrolling: touch;
	    box-sizing: border-box;
	}
	
	.header .category a {
	    display: inline-block;
	    text-align: center;
	    line-height: 30px;
	    text-decoration: none;
	    flex: 1;
	    color: #FFFFFF;
	    font-size: 14px;
	    padding: 0px 10px;
	}
	
	.header .category a.active{
		font-size: 16px;
	    color: #ff09af;
	    border: 1px solid #ff09af;
	    border-radius: 15px;
	    padding: 0px 16px;
	}
	
	.main{
		background-color: #111111;
		margin-top: 75px;
		margin-bottom: 0px;
	}
	
	.main .container{
		padding-top: 5px;
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
    ::-webkit-scrollbar{
        height: 0px;
    }
	
</style>
</head>
<body>
<div class="header">
<div class="top">
	<a href="javascript:lastBack();"><em class="icon iconfont back">&#xe600;</em></a>
	<span class="title"></span>
	<a href="?s=page/search"><em class="icon iconfont search">&#xe60c;</em></a>
</div>
<div class="category"></div>
</div>

<div class="main">
	<div id="7-1" class="as"></div>
	<div class="container"></div>
</div>

<?php require_once('_pagefooter.php');?>
<script>
	var route=<?=json_encode($route)?>;
	var lock=false;
	var page=0;

	$(document).ready(function(){
	    bindEvent();
	    init();
        if(localStorage.getItem('jjbSkin')=='4'){
            $('body,.header,.main .container,.footer').css('background-color','white');
            $(' .header .top .back').css('color','#666666');
        }
	});
	
	function onFinishInit(){
		console.log('finish init');
		getCategory();
		getAs();
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
	
	function getAs(){
		ajax_get('v1/ad/list',function(data){
			if(data.code==200){
				console.log(data);
				xuanAs(data,'7-1');
			}
		});
	}

	function getCategory(){
		ajax_get('v1/category/list',function(data){
			if(data.code==200){
				console.log(data);
				var arr=data.data;
				var activeId=getActiveId(route[2],arr);
				var activeName=getActiveName(activeId,arr);
				$('.header span.title').html(activeName);
				getSub(activeId);
			}
		});
	}
	
	function getActiveName(activeId,arr){
		var activeName='';
		for(var i=0;i<arr.length;i++){
			var obj=arr[i];	
			if(activeId==obj.id){
				activeName=obj.cate_name;
				break;	
			}
		}
		return activeName;
	}
	
	function getSub(activeId){
		ajax_get('v1/home/recomment?p=0&ps=20&cate_id='+activeId,function(data){
			if(data.code==200){
				console.log(data);
				var arr=data.data.subcategory;
				var html='';
				html+='<a id="0" class="active" href="'+'?s=page/second/'+activeId+'">全部类型</a>';
				for(var i=0;i<arr.length;i++){
					var obj=arr[i];	
					html+='<a id="'+obj.cate_id+'" href="'+'?s=page/second/'+activeId+'/'+obj.cate_id+'">'+obj.name+'</a>';
				}
				$('.header .category').html(html);
				if(localStorage.getItem('jjbSkin')=='4'){
					$('.header .category a').css('color','#333333');
					// $('.header .category a.active').css('color','#ff09af'); 
				}
				var subId=route[3];
				if(subId!=null){
					var jqueryObj=$('.header .category a[id='+subId+']');
					if(jqueryObj.length>0){
						$('.header .category a').removeClass('active');
						jqueryObj.addClass('active');
					}
				}
				
				var left=$('.header .category a.active').offset().left;
				if(left>($(window).width()*0.7)){
					var finalLeft=left-50;
					$('.header .category').scrollLeft(finalLeft);
				}
				getList();
			}
		});
	}
	
	function getList(){
		var self=this;
		if(!self.lock){
			$('.main .container').append(getLoading('加载中..'));
			var url='v1/category/nav?cate_id='+route[2]+'&p='+page+'&ps=15';
			if(route[3]!=null){url+='&sub_id='+route[3]}
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
	
	function lastBack(){
		var url='?s=index';
		if(route[2]!=null){
			url+='/'+route[2];
		}
		location.href=url;
	}
</script>		
</body>
</html>