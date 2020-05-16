<!DOCTYPE html>
<html>
<head>
<title><?=$site_title;?></title>
<meta name="description" content="" />
<meta name="keywords"    content="" />
<?php require_once('views/_header.php');?>
<style>
	.header{
		padding: 5px 20px 5px 5px;
		text-align: left;
		background-color: #111111;
	}
	
	.header .back{
		color: #FFFFFF;
		margin: 0px 3px;
	}
	
	.header .searchWrap{
		display: inline-block;
		width: 76%;
		background-color: #1D1D1D;
		border-radius: 15px;
		text-align: center;
		padding: 1px 3px;
	}
	
	.header .searchWrap input{
		width: 92%;
		padding: 5px 2px;
		border: none;
		background: transparent;
		outline: none;
	}
	
	.header span{
		font-size: 14px;
		color: #ff09af;
		float: right;
		line-height: 28px;
		cursor: pointer;
	}
	
	.main{
		background-color: #111111;
		margin-bottom: 0px;
	}
	
	.main .as{
		display: none;
	}
	
	.main .record{
		padding: 10px 10px 5px 10px;
		display: none;
	}
	
	.main .record .title{
		padding: 10px;
		line-height: 15px;
	}
	
	.main .record .title em{
		float: right;
		font-size: 15px;
		cursor: pointer;
	}
	
	.main .record .content{
		padding: 10px;
	}
	
	.main .record .content span{
		display: inline-block;
		background-color: #1D1D1D;
		border-radius: 15px;
		padding: 5px 8px;
		text-align: center;
		margin: 0px 3px 10px 0px;
		cursor: pointer;
	}
	
	.main .container{
		width: 100%;
	}
	
	.main .container .row{
		display: flex;
		padding: 3px 5px;
	}
	
	.main .container .row .pic{
		flex: 1;
		position: relative;
		height: 120px;
		overflow-y: hidden;
		border-radius: 5px;
	}
	
	.main .container .row .pic img{
		display: block;
		width: 100%;
		height: 100%;
	}
	
	.main .container .row .pic span {
	    position: absolute;
	    bottom: 5px;
	    right: 5px;
	    color: #f97937;
	    font-weight: bold;
	}
	
	.main .container .row .desc{
		flex: 2;
		padding: 0px 10px;
		position: relative;
	}
	
	.main .container .row .desc p{
		line-height: 20px;
	}
	
	.main .container .row .desc p.title{
		font-size: 16px;
		color: #FFFFFF;
		line-height: 28px;
	}
	
	.main .container .row .desc button{
		position: absolute;
	    bottom: 5%;
	    left:10px;
	    font-size: 16px;
	    color: #FFFFFF;
	    padding: 8px 20px;
	    background-image: linear-gradient(to right , #990268, #cd068c);
	    border: none;
	    border-radius: 20px;
	    outline: none;
	    cursor: pointer;
	}
	
	.main .container .row .desc button em{
		margin-right: 8px;
	}
	
	@media screen and (min-width: 680px){
		.header{
		    width: 680px;
		    margin: 0px auto 5px;
		}
	}
</style>
</head>
<body>

<div class="header">
<a href="javascript:hBack();">
<em class="icon iconfont back">&#xe600;</em>
</a>
<div class="searchWrap">
	<input id="keyword" type="search" placeholder="" value="" maxlength="30">
</div>

<span id="searchBtn">搜索</span>
</div>

<div class="main">
	<div id="5-1" class="as"></div>
	<div id="4-1" class="as"></div>
	
	<div id="history" class="record">
		<div class="title">
			搜索历史
			<em id="remove" class="icon iconfont">&#xe60d;</em>
		</div>
		<div class="content"></div>
	</div>
	
	<div id="4-2" class="as"></div>
	
	<div id="hot" class="record">
		<div class="title">
			热门搜索
		</div>
		<div class="content"></div>
	</div>
	
	<div id="4-3" class="as"></div>
	
	<div class="container"></div>
	
</div>

<?php require_once('_pagefooter.php');?>
<script>
	var route=<?=json_encode($route)?>;
	var page=0;
    var lock=false;
    var kword=null;
	
	$(document).ready(function(){
	    init();
        if(localStorage.getItem('jjbSkin')=='4'){
            $('body,.header,.searchWrap,.main,.footer').css('background-color','white');
            $('*').css('color','#666666');
            $(' .header span').css('color','#ff09af');
        }
	});
	
	function onFinishInit(){
		console.log('finish init');

		var keyword=route[2];
		if(keyword!=null && keyword.length>0){
			kword=unescape(keyword);
			$('#keyword').val(kword);
			addHistory(kword);
			getList();
			showAs(1);
		}else{
			showHistory();
			$('.main #hot').css('display','block');
			showAs(0);
		}
		
		getHistoryKws();
		getHotKws();
		getAs();
	}
	
	function bindEvent() {
		var self=this;
		
		$('#remove').click(function(){
			if(confirm('确认删除记录?')){
				removeHistory();
				$('.main #history').css('display','none');
			}
		});
		$('#searchBtn').click(function(){
			goSearch();
		});
		//响应电脑enter键
    	$("#keyword").bind("search", function() {
            var keyword = $("#keyword").val();
			if(keyword.length>0){
            	goSearch();
           	}
        });
        
        //绑定输入字符变化
        $("#keyword").bind("input propertychange", function() {
			var keyword = $(this).val();
			if(keyword.length==0){
			 	showHistory();
    			$('#hot').css('display','block');
    			showAs(0);
			}else{
			 	$('#history').css('display','none');
    			$('#hot').css('display','none');
    			showAs(1);
			}
		});
		
		$('.main .record .content span').click(function(){
			var keyword=$(this).html();
			search(keyword);
		});
		
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
	
	function showAs(status){//0显示未有关键词搜索，1显示搜索结果页的广告
		if(status==0){
			$('#4-1').css('display','block');
			$('#4-2').css('display','block');
			$('#4-3').css('display','block');
			$('#5-1').css('display','none');	
		}else{
			$('#4-1').css('display','none');
			$('#4-2').css('display','none');
			$('#4-3').css('display','none');
			$('#5-1').css('display','block');
		}
	}
	
	function getAs(){
		ajax_get('v1/ad/list',function(data){
			if(data.code==200){
				console.log(data);
				xuanAs(data,'4-1');
				xuanAs(data,'4-2');
				xuanAs(data,'4-3');
				xuanAs(data,'5-1');
			}
		});
	}
	
	function goSearch(){
		var keyword = $("#keyword").val();
		if(keyword.length>0){
			search(keyword);
		}else{
			var placeholder=$('#keyword').attr('placeholder');
			if(placeholder.length>0){
				search(placeholder);
			}else{
				alert('请输入关键词');
			}
			
		}
	}
	
	function search(keyword){
		location.href = '?s=page/search/'+escape(keyword);
	}
	
	function getList(){
		var self=this;
		if(!self.lock){
			$('.main .container').append(getLoading('加载中..'));
			ajax_get('v1/search/result?p='+page+'&ps=15&kw='+kword,function(data){
				$('.main .container .loading').remove();
				if(data.code==200){
					console.log(data);
					if(data.data.length>0){
						var arr=data.data;
						var html='';
						for(var i=0;i<arr.length;i++){
							var obj=arr[i];
							
							html+='<div class="row">';
							html+='<div class="pic">';
							html+='<a href="?s=page/play/'+obj.video_id+'">';
							html+='<img class="lazy" src="'+obj.image+'" alt="'+obj.title+'" title="'+obj.title+'"/>';
							html+='</a>';
							html+='<span>'+obj.score+'</span>';
							html+='</div>';
							html+='<div class="desc">';
							html+='<a href="?s=page/play/'+obj.video_id+'">';
							html+='<p class="title" title="'+obj.title+'">'+getSubStr(obj.title,12)+'</p>';
							html+='</a>';
							html+='<p class="detail">'+obj.cate_id+'</p>';
							html+='<p class="detail">主演:'+obj.starring.substr(0,32)+'</p>';
							html+='<a href="?s=page/play/'+obj.video_id+'">';
							html+='<button><em class="icon iconfont">&#xe601;</em>立即播放</button>';
							html+='</a>';
							html+='</div>';
							html+='</div>';
						}
						$('.main .container').append(html);
						setLazyLoad();
						self.lock = false;
						self.page++;
						if(localStorage.getItem('jjbSkin')=='4'){
            				$('*').css('color','#666666');
            				$(' .header span').css('color','#ff09af');
            				$('.main .container .row .desc button em,.main .container .row .desc button').css('color','#FFFFFF');
            				
            				// $('.main .container .row .desc button').css('background-image','url(static/img/bofang_bg_w2.png)');         				
        				}

					}else{
						$('.main .container').append(getLoading('没有更多了'));
					}
				}
			});
		}
	}
	
	function getHistoryKws(){
		var arr=JSON.parse(localStorage.getItem('kws'));
		if(arr!=null){
			var html='';
			for(var i=0;i<arr.length;i++){
				html+='<span>'+getSubStr(arr[i],9)+'</span>';
			}
			$('.main #history .content').html(html);
            if(localStorage.getItem('jjbSkin')=='4'){//置换皮肤
                $('.content span').css('background-color','#CCCCCC');
                $('.content span').css('color','black');
            }
		}
	}
	
	function showHistory(){
		var arr=JSON.parse(localStorage.getItem('kws'));
		if(arr!=null && arr.length>0){
			$('#history').css('display','block');
		}
	}
	
	function getHotKws(){
		ajax_get('v1/search/kws',function(data){
			if(data.code==200){
				console.log(data);
				var arr=data.data;
				if(arr.length>0){
					$('#keyword').attr('placeholder',arr[0]);
					
					var html='';
						for(var i=0;i<arr.length;i++){
							html+='<span>'+arr[i]+'</span>';
						}
					$('.main #hot .content').html(html);
                    if(localStorage.getItem('jjbSkin')=='2'){//置换皮肤
                        $('.content span').css('background-color','#CCCCCC');
                        $('.content span').css('color','black');
                    }
					bindEvent();
				}
			}
		});
	}
</script>		
</body>
</html>