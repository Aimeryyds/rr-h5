<!DOCTYPE html>
<html>
<head>
<title><?=$site_title;?></title>
<meta name="description" content="" />
<meta name="keywords"    content="" />
<?php require_once('_header.php');?>
<style>
	.header{
		position: fixed;
		top: 0;
		left: 0;
		right: 0;
		
		z-index: 9;
		padding: 7.5px 0px 7.5px 5px;
		color: #FFFFFF;
		background-color: #111111;
		
		-webkit-box-shadow: 0 0 1px rgba(0, 0, 0, .85);
    	box-shadow: 0 0 1px rgba(0, 0, 0, .85);
	}
	
	.header .panel{
		height: 24px;
		padding: 3px 0px;
	}
	
	.header .sch{
		padding-left: 15px;
		width: 80%;
		display: inline-block;
		background-color: #1D1D1D;
		border-radius: 12px;
	}
	
	.header .sch input.searchT{
		font-size: 14px;
		height: 22px;
		vertical-align: top;
		width: 80%;
		background-color: transparent;
		outline: none;
		border: none;
		color: #999999;
	}
	
	.header .sch a{
		text-decoration: none;
	}
	
	.header .panel em{
		font-size: 20px;
		line-height: 22px;
	}
	
	.header .panel em.right{
		float: right;
		margin-right: 20px;
	}
	
	.header .panel em.search{
		font-size: 22px;
		color: #ff09af;
		margin-right: 5px;
	}
	
	.main{
		margin-top: 45px;
	}
	
	.main .category{
		height: 40px;
	    line-height: 40px;
	    overflow-x: scroll;
	    overflow-y: hidden;
	    white-space: nowrap;
	    -webkit-overflow-scrolling: touch;
	    box-sizing: border-box;
	    background-color: #111111;
	    z-index: 2;
	}
	
	.main .category a {
	    display: inline-block;
	    text-align: center;
	    line-height: 30px;
	    text-decoration: none;
	    flex: 1;
	    color: #CCCCCC;
	    font-size: 14px;
	    padding: 0px 10px;
	}
	
	.main .category a.active{
		font-size: 16px;
		color: #ff09af;
	}
	
	.main .swiper-container {
        width: 100%;
        height: auto;
    }
    
    .main .swiper-slide {
        text-align: center;
        font-size: 18px;
        background: #fff;

        /* Center slide text vertically */
        display: -webkit-box;
        display: -ms-flexbox;
        display: -webkit-flex;
        display: flex;
        -webkit-box-pack: center;
        -ms-flex-pack: center;
        -webkit-justify-content: center;
        justify-content: center;
        -webkit-box-align: center;
        -ms-flex-align: center;
        -webkit-align-items: center;
        align-items: center;
    }
    
    .main .swiper-slide .pic{
    	width: 100%;
    }
    
    .main .secCate{
	    overflow-x: scroll;
	    overflow-y: hidden;
	    white-space: nowrap;
	    -webkit-overflow-scrolling: touch;
	    box-sizing: border-box;
	    background-color: #111111;
	}
	
	.main .secCate a {
	    display: inline-block;
	    text-align: center;
	    text-decoration: none;
	    flex: 1;
	    padding: 10px 15px 2px;
	}
	
	.main .secCate a img.pic{
		display: block;
		width: 40px;
		margin: 0px auto;
	}
	
	.main .secCate a p{
		color: #CCCCCC;
	    font-size: 13px;
	    padding: 0px;
	    line-height: 26px;
	}
	
	.main .slipDiv{
		padding: 5px;
		background-color: #111111;
	}
	
	.main .slipDiv h1{
		font-size: 14px;
		color: #FFFFFF;
		line-height: 32px;
		font-weight: normal;
	}
	
	.main .slipDiv h1 .like{
		width: 20px;
		vertical-align: middle;
		margin-right: 5px;
	}
	
	.main .slipDiv h1 .more{
		text-decoration: none;
	    color: #CCCCCC;
	    float: right;
	    margin-right: 6px;
	}
	
	.main .slipDiv .slip{
	    overflow-x: scroll;
	    overflow-y: hidden;
	    white-space: nowrap;
	    -webkit-overflow-scrolling: touch;
	    box-sizing: border-box;
	    background-color: #111111;
	}
	
	.main .slipDiv .slip a {
	    display: inline-block;
	    text-align: center;
	    text-decoration: none;
	    flex: 1;
	    padding: 8px 2px 0px;
	}
	
	.main .slipDiv .slip a .pic{
		margin: 0px auto;
		width: 150px;
    	height: 80px;
		overflow-y: hidden;
    	border-radius: 5px;
	}
	
	.main .slipDiv .slip a .pic img{
		display: block;
		width: 100%;
	}
	
	.main .slipDiv .slip a p{
		color: #CCCCCC;
	    font-size: 13px;
	    padding: 0px;
	    line-height: 30px;
	    max-width: 120px;
	    overflow-x: hidden;
	}
	
	.main .board{
		padding: 5px;
		background-color: #111111;
	}
	
	.main .board h1{
		font-size: 14px;
		color: #FFFFFF;
		line-height: 32px;
		font-weight: normal;
		padding-right: 3px;
	}
	
	.main .board h1 .pic{
		width: 20px;
		vertical-align: middle;
		margin-right: 5px;
	}
	
	.main .board h1 .more{
		text-decoration: none;
		color: #CCCCCC;
		float: right;
		margin-right: 6px;
	}
	
	.main .board .content{
		padding: 3px 0px;
	}
	
	.main .board .content .row{
		display: flex;
	}
	
	.main .board .content .row .op{
		flex: 1;
	    padding: 2px;
	    position: relative;
	    height: 180px;
	    overflow: hidden;
	}
	
	.main .board .content .row .op .pic{
		width: 100%;
		border-radius: 5px;
		overflow: hidden;
	}
	
	.main .board .content .row .op .pic img{
		display: block;
    	height: 150px;
    	margin-left: -40%;
	}
	
	.main .board .content .row .op p{
		color: #CCCCCC;
	    font-size: 13px;
	    padding: 0px;
	    line-height: 30px;
	    cursor: pointer;
	}
	
	.main .board .content .row .op span {
	    position: absolute;
	    bottom: 35px;
	    right: 5px;
	    color: #f97937;
	    font-weight: bold;
	}
</style>
 <link rel="stylesheet" href="static/css/swiper.min.css">
</head>
<body>
	
<div class="header">
	<div class="panel">
		<div class="sch">
			<a href="?s=page/search">
				<em class="icon iconfont search">&#xe60c;</em>
				<input type="text" class="searchT" value="" readonly="readonly">
			</a>		
		</div>
		
		<a href="?s=page/watchlist"><em class="icon iconfont right history">&#xe629;</em></a>
		<!--<a href="?s=page/cache"><em class="icon iconfont right download">&#xe645;</em></a>-->
	</div>
</div>	
	
<div class="main">
	
	<div id="1-1" class="as"></div>
	
	<div class="category"></div>
	
	<div id="2-2" class="as"></div>
	
	<div class="swiper-container swiper-container-horizontal swiper-container-android">
	        <div id="banner" class="swiper-wrapper" style="transition-duration: 1000ms; transform: translate3d(0px, 0px, 0px);">
	            <!--
	            <div class="swiper-slide swiper-slide-active" style="width: 360px;"><img class="pic" src="static/img/a1.png"></div>
	            <div class="swiper-slide swiper-slide-next" style="width: 360px;"><img class="pic" src="static/img/a1.png"></div>
	            <div class="swiper-slide" style="width: 360px;"><img class="pic" src="static/img/a1.png"></div>
	            <div class="swiper-slide" style="width: 360px;"><img class="pic" src="static/img/a1.png"></div>
	            -->
	        </div>
	        <!-- Add Pagination -->
	        <div class="swiper-pagination swiper-pagination-clickable swiper-pagination-bullets"><span class="swiper-pagination-bullet swiper-pagination-bullet-active"></span><span class="swiper-pagination-bullet"></span><span class="swiper-pagination-bullet"></span><span class="swiper-pagination-bullet"></span><span class="swiper-pagination-bullet"></span><span class="swiper-pagination-bullet"></span><span class="swiper-pagination-bullet"></span><span class="swiper-pagination-bullet"></span><span class="swiper-pagination-bullet"></span><span class="swiper-pagination-bullet"></span></div>
	</div>
	
	<div id="2-3" class="as"></div>
	
	<div class="secCate"></div>
	
	<div id="2-4" class="as"></div>
</div>
<?php require_once('_footer.php');?>
<script src="static/js/swiper.min.js"></script>
<script>
	var route=<?=json_encode($route)?>;
	
	$(document).ready(function(){
	    bindEvent();
	    xuanNav("index");
	    init();
	});
	
	function onFinishInit(){
		console.log('finish init');
		getHotKws();
		getCategory();
		getAs();
		/*同步ajax请求
		$.ajaxSettings.async = false;
		getCategory();
		$.ajaxSettings.async = true;
		*/
        onFootInit();
	}
	
	function bindEvent() {
		bindNav();
		
		$(window).scroll(function(){
			var disTop=$('#1-1').height()+$('.header').height()+10-$('.category').height();		
			if($(this).scrollTop()>disTop){
				$('.category').css('position','fixed');
				$('.category').css('top','45px');
				$('.category').css('left','0px');
				$('.category').css('right','0px');
			}else{
				$('.category').css('position','relative');
				$('.category').css('top','0px');
				$('.category').css('left','0px');
				$('.category').css('right','0px');
			}
		});
	}
	
	function getAs(){
		ajax_get('v1/ad/list',function(data){
			if(data.code==200){
				console.log(data);
				xuanAs(data,'1-1');
			}
		});
	}
	
	function getHotKws(){
		ajax_get('v1/search/kws',function(data){
			if(data.code==200){
				console.log(data);
				var arr=data.data;
				if(arr.length>0){
					$('.searchT').val(arr[0]);
				}
			}
		});
	}
	
	function getCategory(){
		ajax_get('v1/category/list',function(data){
			if(data.code==200){
				var arr=data.data;
				var html='';
				var activeId=getActiveId(route[1],arr);
				for(var i=0;i<arr.length;i++){
					var obj=arr[i];
					html+='<a id='+obj.id;
					if(obj.id==activeId){
						html+=' class="active"';	
					}
					html+=' href="?s=index/'+obj.id+'">'+obj.cate_name+'</a>';
				}
				$('.category').html(html);
				getSub(activeId);
				getBannerAd(activeId);
			}
		});
	}
	
	function getSub(activeId){
		ajax_get('v1/home/recomment?p=0&ps=20&cate_id='+activeId,function(data){
			if(data.code==200){
				console.log(data);
				xuanSub(data.data.subcategory);
				xuanPlate(data.data.plate);
			}
		});
		
		function xuanSub(arr){
			var html='';
			for(var i=0;i<arr.length;i++){
				var obj=arr[i];
				var url=obj.url;
				if(url.length==0){url='http://img.sskk168.com/o/06/33/20200115/084855734239_original';}
				
				html+='<a id='+obj.cate_id;
				html+=' href="?s=page/second/'+activeId+'/'+obj.cate_id+'">';
				html+='<img class="pic" src="'+url+'">';
				html+='<p>'+obj.name+'</p>';
				html+='</a>';
			}
			$('.secCate').html(html);
		}
		
		function xuanPlate(arr){
			for(var i=0;i<arr.length;i++){
				if(arr[i].plate_style==1){
					plusSlip(arr[i]);
				}else if(arr[i].plate_style==2){
					plusBoard(arr[i]);
				}else{
					
				}
			}
		}
		
		function plusSlip(obj){
			var html='';
			html+='<div class="slipDiv">';
			html+='<h1><img class="like" src="'+obj.icon+'">'+obj.plate_name;
			if(obj.hasMore){
				html+='<a class="more" href="?s=page/more/'+activeId+'/'+obj.plate_id+'">更多</a>';
			}
			html+='</h1>';
			html+='<div class="slip">';	
			for(var i=0;i<obj.list.length;i++){
				var listObj=obj.list[i];
				html+='<a href="?s=page/play/'+listObj.video_id+'">';
				html+='<div class="pic">';
				html+='<img src="'+listObj.url+'" title="'+listObj.title+'" '+'alt="'+listObj.title+'">';
				html+='</div>';
				html+='<p title="'+listObj.title+'">'+getSubStr(listObj.title,8)+'</p>';
				html+='</a>';
			}
			html+='</div>';
			html+='</div>';
			$('.main').append(html);
		}
		
		function plusBoard(obj){
			var html='';
			html+='<div class="board">';
			html+='<h1>';
			html+='<img class="pic" src="'+obj.icon+'">';
			html+=obj.plate_name;
			if(obj.hasMore){
				html+='<a class="more" href="?s=page/more/'+activeId+'/'+obj.plate_id+'">更多</a>';
			}
			html+='</h1>';
			
			var arr=getThreeArr(obj.list);
			
			html+='<div class="content">';	
			
			for(var i=0;i<arr.length;i++){
				html+='<div class="row">';
				var	subArr=arr[i]; 	
				for(var j=0;j<subArr.length;j++){	
					html+='<div class="op">';
					if(subArr[j].video_id!=null){
						html+='<a href="?s=page/play/'+subArr[j].video_id+'">';
						html+='<div class="pic">';
						html+='<img src="'+subArr[j].url+'" title="'+subArr[j].title+'" '+'alt="'+subArr[j].title+'">';
						html+='</div>';
						html+='<p title="'+subArr[j].title+'">'+getSubStr(subArr[j].title,8)+'</p>';
						html+='</a>';
						html+='<span>';
						if(subArr[j].episode.length>0){
							html+=subArr[j].episode;
						}else{
							html+=subArr[j].score;
						}
						html+='</span>';
					}
					html+='</div>';
				}
				html+='</div>';
			}
				
			html+='</div>';
			html+='</div>';
			$('.main').append(html);
		}
		
	}
	
	function getBannerAd(activeId){
		ajax_get('v1/ad/list?cate_id='+activeId,function(data){
			console.log('getBannerAd');
			console.log(data);
			xuanAs(data,'2-2');
			xuanAs(data,'2-3');
			xuanAs(data,'2-4');
			
			var arr=data.data['2-1'];
			if(arr!=null){
				var html='';
				for(var i=0;i<arr.length;i++){
					var obj=arr[i];
					html+='<div class="swiper-slide" style="width: 100%;">';
					html+='<a href="javascript:handleAs(\''+obj.url+'\',\''+obj.id+'\');">';
					html+='<img class="pic" src="'+obj.image+'">';
					html+='</a>';
					html+='</div>';
				}
				$('#banner').html(html);
				$('#banner .swiper-slide:first-child').addClass('swiper-slide-active');
				startSwiper();
			}
		});
	}
	
	function startSwiper(){
		var swiper = new Swiper('.swiper-container', {
	        pagination: '.swiper-pagination',
	        paginationClickable: true,
	        autoplay: {
				    delay: 3000,
				    stopOnLastSlide: true,
				    disableOnInteraction: false,
			  },
			speed: 4000
	    });
	}
</script>		
</body>
</html>