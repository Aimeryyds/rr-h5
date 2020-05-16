<!DOCTYPE html>
<html>
<head>
<title><?=$site_title;?></title>
<meta name="description" content="" />
<meta name="keywords"    content="" />
<?php require_once('_header.php');?>
<style>
	.header{
		color: #FFFEFF;
	    text-align: center;
	    padding: 10px;
	    font-size: 16px;
	    line-height: 22px;
	    height: 25px;
	    position: fixed;
	    left: 0;
	    right: 0;
	    top: 0;
	    background-color: #111111;
	}
	
	.header strong{
		font-size: 16px;
	    color: #FFFFFF;
	    font-weight: normal;
	}
	
	.header em{
		position: absolute;
		right: 10px;
		font-size: 22px;
    	color: #ff09af;
	}
	
	.main{
		padding: 0px 5px;
		background-color: #111111;
		margin-top: 45px;
		margin-bottom: 50px;
	}
	
	.main .swiper-container {
        width: 100%;
        height: 105px;
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
        height: 105px;
    }
	
	.main .container{
		margin-top: 10px;
		width: 100%;
	}
	
	.main .container .op{
		width: 100%;
	}
	
	.main .container .op .pic{
		width: 100%;
		height: 160px;
		border-radius: 5px;
		overflow: hidden;
	}
	
	.main .container .op .pic img{
		display: block;
		width: 100%;
		margin-top: -10%;
	}
	
	.main .container .op p{
		color: #CCCCCC;
	    font-size: 13px;
	    padding: 0px;
	    line-height: 46px;
	}
	
	.main .container .op p span{
		float: right;
	}
	
	.main .container .op p span em{
		color: #ff09af;
		font-style: normal;
		margin-right: 3px;
	}
	
	.main .container .op p span strong{
		margin: 0px 3px;
	}
    .swiper-wrapper{
        height: auto!important;
    }
</style>
<link rel="stylesheet" href="static/css/swiper.min.css">
</head>
<body>

<div class="header">
<strong>热点</strong>
<a href="?s=page/search">
<em class="icon iconfont search">&#xe60c;</em>
</a>
</div>

<div class="main">
    <div class="swiper-container" style="display: none">
        <div id="banner" class="swiper-wrapper">
        </div>
        <!-- Add Pagination -->
        <div class="swiper-pagination swiper-pagination-clickable swiper-pagination-bullets"></div>
    </div>
	<div class="container"></div>
</div>
<div class="notfound_bg">
    <div class="notfound_content">
        <img  src="static/img/search_notFounf.png"/>
        <br>
        没有找到相关内容
    </div>
</div>
<?php require_once('_footer.php');?>
<script src="static/js/swiper.min.js"></script>
<script>
	var lock=false;
	var page=0;

	$(document).ready(function(){
	    bindEvent();
	    setLazyLoad();
	    xuanNav("hot");
	    init();
        if(localStorage.getItem('jjbSkin')=='4'){
            $('body,.header,.main,.footer,.notfound_bg,.notfound_content').css('background-color','#FFFFFF');
            $('.header strong').css('color','#333333');
           	$('.footer .item .word').css('color','#333333');
        }
        if(localStorage.getItem('private_ys')==1){
            $('.notfound_bg').show();
            event.stopPropagation();
            $('body').css('overflow','hidden');
        }else {
            $('.notfound_bg').hide();
        }
	});
	
	function onFinishInit(){
		console.log('finish init');
		getList();
		getBannerAd();
        onFootInit();
	}
	
	function bindEvent() {
		bindNav();		
		var self=this;
		$(window).scroll(function(){
			var scrollTop = $(this).scrollTop();
            var scrollHeight = $(document).height();
            var windowHeight = window.innerHeight;
			if (scrollTop + windowHeight >= scrollHeight) {
				self.getList();
				self.lock = true;	
			}
		});
	}
	
	function getBannerAd(){
		ajax_get('v1/ad/list',function(data){
			if(data.code==200){
				console.log(data);
				var arr=data.data['8-1'];
				if(arr!=null){
					var html='';
					for(var i=0;i<arr.length;i++){
						var obj=arr[i];
						html+='<div class="swiper-slide">';
						html+='<a href="javascript:handleAs(\''+obj.url+'\',\''+obj.id+'\');">';
						html+='<img  style="max-width:100%"  class="pic" src="'+obj.image+'">';
						html+='</a>';
						html+='</div>';
					}
					$('#banner').html(html);
					$('#banner .swiper-slide:first-child').addClass('swiper-slide-active');
					startSwiper();
					$('.main .swiper-slide .pic').css({'position':'absolute','top':'0','left':'0'});
					$('.swiper-container').show();
				}
			}
		});
	}
	
	function getList(){
		var self=this;
		if(!self.lock){
			$('.main .container').append(getLoading('加载中..'));
			var url='v1/video/hot?p='+page+'&ps=15';
			ajax_get(url,function(data){
				$('.main .container .loading').remove();
				if(data.code==200){
					console.log(data);
					if(data.data.length>0){
						var arr=data.data;
						var html='';				
						for(var i=0;i<arr.length;i++){
							var obj=arr[i];
							html+='<div class="op">';
							html+='<a href="?s=page/play/'+obj.id+'">';
							html+='<div class="pic">';
							html+='<img src="'+obj.url+'" title="'+obj.title+'" alt="'+obj.title+'">';
							html+='</div>';
							html+='<p title="'+obj.title+'">';
							html+=getSubStr(obj.title,16);
							html+='<span>';
							html+='<em>'+obj.score+'</em>分<strong>·</strong><em>'+obj.plays+'</em>播放量';
							html+='</span>';
							html+='</p>';
							html+='</a>';
							html+='</div>';
						}			
						$('.main .container').append(html);
						 if(localStorage.getItem('jjbSkin')=='4'){
				            $('.main .container .op p').css('color','#666666');
				            $('.main .container .op p span').css('color','#999999');
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

    function startSwiper() {
        var swiper = new Swiper('.swiper-container', {
            loop: true,
            pagination: '.swiper-pagination',
            paginationClickable: true,
            autoplay: 2000,
            speed: 2000
        });
    }
</script>		
</body>
</html>