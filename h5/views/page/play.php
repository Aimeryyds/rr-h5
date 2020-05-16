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
	left: 0px;
	right: 0px;
	top: 0px;
	min-height: 200px;
	z-index: 999;
}

.header #video{
	width: 100%;
	height: 200px;
}

.header em{
	position: absolute;
	left: 10px;
	top: 10px;
	font-size: 16px;
	color: #FFFFFF;
	display: none;
}

.header .video_as{
	width: 100%;
    height: 100%;
	position: absolute;
	top: 0px;
}

.header .video_as img{
	display: block;
	width: 100%;
    height: 100%;
}

.header .video_as .timeWrap{
	position: absolute;
	top: 10px;
	right: 10px;
	letter-spacing:1px;
	padding: 1px 3px;
	background: rgba(0,0,0,0.2);
}

.main{
	margin-top: 0px;
	margin-bottom: 0px;
	padding: 10px;
	background-color: #1D1D1D;
}

.main h1{
	color: #FFFFFF;
	font-size: 16px;
}

.main .desc{
	padding: 10px 0px;
}

.main .desc .sep{
	margin: 0px 3px;
}

.main .desc .point{
	color: #ff09af;
}

.main .desc .brief{
	float: right;
	cursor: pointer;
}

.main .panel{
	padding: 10px 0px 15px 0px;
	border-bottom: 0.5px solid #333333;
}

.main .panel em{
	font-size: 20px;
	line-height: 20px;
	cursor: pointer;
}

.main .panel em.left{
	margin: 0px 3px 0px 10px;
}

.main .panel em.right{
	float: right;
	margin: 0px 15px;
}

.main .panel em.fav{
	font-size: 24px;
	line-height: 18px;
    margin: 0px 15px;
}

.main .episode{
	width: 100%;
}

.main .episode .title{
	padding: 10px 0px;
	color: #FFFFFF;
	font-size: 16px;
	font-weight: bold;
}

.main .episode .title span{
	float: right;
	line-height: 16px;
	font-weight: normal;
}

.main .episode .title span em{
	font-size: 10px;
	margin: 0px 3px;
}

.main .episode .content{
	height: 30px;
	line-height: 30px;
	overflow-x: scroll;
	overflow-y: hidden;
	white-space: nowrap;
	-webkit-overflow-scrolling: touch;
	box-sizing: border-box;
}
	
.main .episode .content a {
	display: inline-block;
	text-align: center;
	line-height: 30px;
	text-decoration: none;
	flex: 1;
	color: #CCCCCC;
	font-size: 14px;
	padding: 0px 15px;
}
	
.main .episode .content a.active{
		font-size: 16px;
		font-weight: bold;
		color: #ff09af;
		background-color: #111111;
		border-radius: 5px;
}

.main .recommand h1{
    font-size: 14px;
    line-height: 20px;
    color: #FFFFFF;
    line-height: 20px;
    font-weight: normal;
    padding: 10px 0px;
}

.main .recommand h1 .like{
	width: 20px;
	vertical-align: middle;
	margin-right: 5px;
}

.main .recommand .list{
	width: 100%;
}

.main .recommand .list .row{
	display: flex;
	margin-bottom: 10px;
}

.main .recommand .list .row .pic{
	flex: 4;
	height: 80px;
	overflow-y: hidden;
	border-radius: 5px;
}

.main .recommand .list .row .pic img{
	display: block;
	width: 100%;
}

.main .recommand .list .row .content{
	flex: 6;
}

.main .recommand .list .row .content .title{
	font-size: 16px;
	padding: 0px 5px 5px;
}

.main .recommand .list .row .content .detail{
	padding: 5px;
}

.main .recommand .list .row .content .detail span{
	color: #ff09af;
	margin: 0px 2px;
}

.main .recommand .list .row .content .detail em{
	margin: 0px 3px;
}

.briefDiv{
	position: fixed;
	left: 0px;
	right: 0px;
	top: 600px;
	z-index: 1000;
	height: auto;
	padding: 10px;
	background-color: #1D1D1D;
	display: none;
}

.briefDiv h1{
	position: relative;
	font-size: 16px;
	line-height: 24px;
	color: #FFFFFF;
}

.briefDiv h1 #closeBrief{
	position: absolute;
	right: 5px;
	font-size: 16px;
	color: #FFFFFF;
	cursor: pointer;
}

.briefDiv p{
	line-height: 24px;
}

.authDiv{
	position: fixed;
	left: 0;
	right: 0;
	top: 0;
	bottom: 0;
	background-color: rgba(0,0,0,0.5);
	z-index: 1001;
	display: none;
}

.authDiv .wrap{
	width: 76%;
	height: auto;
	background-color: #190030;
	border-radius: 8px;
	margin: 30% auto 0px;
	padding: 30px 20px;
}

.authDiv .wrap h1{
	padding: 0px 25px;
	font-size: 16px;
	color: #FFFFFF;
	text-align: center;
	line-height: 24px;
}

.authDiv .wrap .btnWrap{
	text-align: center;
	margin-top: 30px;
}

.authDiv .wrap .btnWrap button{
    font-size: 16px;
    color: #FFFFFF;
    padding: 8px 16px;
    border: none;
    border-radius: 20px;
    outline: none;
    cursor: pointer;
}

.authDiv .wrap .btnWrap button.goShare{
	 background-image: linear-gradient(to right , #5f01ac, #5e03a8);
	 margin-right: 12px;
}

.authDiv .wrap .btnWrap button.goInvite{
	 background-image: linear-gradient(to right , #cd068c, #ff09af);
}

.authDiv .closeWrap{
	margin-top: 30px;
	text-align: center;
}

.authDiv .closeWrap em{
	font-size: 28px;
	color: #FFFFFF;
	font-weight: normal;
	cursor: pointer;
}

@media screen and (min-width:680px){
	.briefDiv{
		width: 680px;
		margin: 0px auto 50px;
	}
	
	.authDiv{
		width: 680px;
		margin: 0px auto 50px;
	}
}
.fixnickname{
    position: absolute;
    text-align: center;
    top: 0;
    left: 0;
    right: 0;
    bottom: 0;
}
.fixnicknamemain{
    width: 80%;
    background: #222;
    margin: 16rem auto 0;
    padding-top: 24px;
    font-size: 16px;
    color: #FFFFFF;
}
.fbutton{
    background: none;
    border: 0;
    width: 100%;
    padding: 20px 0;
    font-size: 14px;
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
</style>
    <link rel="stylesheet" href="static/css/swiper.min.css">
    <script src="static/js/ckplayer.js" charset="UTF-8"></script>

</head>
<body>

<div class="header">
	<div id="video"></div>
	<a href="javascript:hBack();">
	<em class="icon iconfont">&#xe600;</em>
	</a>
	<div class="swiper-container video_as" style="display: none">
        <div id="3-1" class="swiper-wrapper"></div>
        <!-- Add Pagination -->
        <div class="swiper-pagination swiper-pagination-clickable swiper-pagination-bullets"></div>
    </div>
</div>
<div class="main">
	<h1 id="title">-</h1>
	<div id="3-2" class="as"></div>
	<div class="desc">
		<span id="score" class="point">-</span>分<span class="sep">·</span><span id="playback" class="point">-</span>次播放
		<span id="brief" class="brief">简介<em class="icon iconfont">&#xe60e;</em></span>	
	</div>
	<div class="panel">
		<em id="like" class="icon iconfont left">&#xe66e;</em>
		<span id="likes">-</span>
		<em id="copy" class="icon iconfont right">&#xe665;</em>
		<a href="javascript:download();"><em class="icon iconfont right">&#xe645;</em></a>
		<em id="fav" class="icon iconfont right fav">&#xe628;</em>
	</div>
	
	<div id="3-3" class="as"></div>
	<div class="episode">
		<div class="title">
			选集
			<span><label>-</label><em class="icon iconfont">&#xe60e;</em></span>
		</div>	
		<div class="content"></div>
	</div>

    <div class="swiper-container">
        <div id="banner" class="swiper-wrapper">
        </div>
        <!-- Add Pagination -->
        <div class="swiper-pagination swiper-pagination-clickable swiper-pagination-bullets"></div>
    </div>

	
	<div class="recommand">
		<h1><img class="like" src="../static/img/like.png">猜你喜欢</h1>
		<div class="list"></div>
	</div>

    <div class="fixnickname" style="display: none">
        <div class="fixnicknamemain">
            影片链接复制成功，快去分享吧！
            <div style="border-top: 1px solid #2b2b2b;margin-top: 20px;">
                <button class="fbutton" id="nsubmit" style="color: #FF11AD">确定</button>
            </div>

        </div>
    </div>
</div>

<div class="briefDiv"></div>
<div class="authDiv">
	<div class="wrap">
	<h1>成功推广1人,送24小时无限观看,可无限叠加~</h1>
	<div class="btnWrap">
		<button class="goShare">去分享视频</button>
		<button class="goInvite">去邀请好友</button>
	</div>
	</div>
	<div class="closeWrap">
		<em id="closeAuth" class="icon iconfont">&#xe631;</em>
	</div>
</div>

<?php require_once('_pagefooter.php');?>
<script src="static/js/swiper.min.js"></script>
<script src="static/js/jquery.copy.js" charset="UTF-8"></script>
<script>
	var route=<?=json_encode($route)?>;
	var _appDownload=null;
	var player=null;
	var movieObj=null;
	
	$(document).ready(function(){
	    var height=($('.header').height()+16)+'px';
	    $('.main').css('margin-top',height);
	    
	    init();
        if(localStorage.getItem('jjbSkin')=='4'){
            $('body,.header,.main,.footer,.authDiv .wrap,.fixnicknamemain').css('background-color','#FFFFFF');

            $('*').css('color','#666666');
             $(' .header em').css('color','#FFFFFF');
           
            $('.goShare,.goInvite,.authDiv .closeWrap em').css('color','#FFFFFF');
           	$('.fixnickname').css({'position':'fixed','z-index':'10'});
            $('#fav').replaceWith('<em id="fav" class="icon iconfont right fav">&#xe628;</em>');
            // $('.main .episode .content a').css('color','#666666');
           	$('.main .episode .content a.active,.fbutton').css('color','#ff09af');
           	$('.main .episode .content a.active').css('background-color','#EEEEEE');
        }
	});
	
	function onFinishInit(){
		console.log('finish init');
		getAppDownLoad();
		getData();
		getAs();
	}
	
	function bindEvent(video_id,obj) {
		$('#like').click(function(){
			ajax_get('v1/like/video?video_id='+video_id,function(data){
				if(data.code==200){
					console.log(data);
					var vObj=data.data;
					$('#likes').html(vObj.likes);
					changeLike(vObj.has_like);		
				}	
			});
		});
		
		$('#fav').click(function(){
			var bool=inFavList(obj);
			if(bool){
				deleteFavList(obj.video_id);
				$(this).css('color','#CCCCCC');
			}else{
				addFavList(obj);
				$(this).css('color','#ff09af');
			}
		});
		
		$('#brief').click(function(){
			var header_height=parseInt($('.header').css('height').split('px')[0]);
			$('.briefDiv').animate({'top':header_height+'px'});
			$('.briefDiv').css('display','block');
			$('.main').hide();
		});
		
		$('.briefDiv #closeBrief').click(function(){
			$('.briefDiv').css('top','600px');
			$('.briefDiv').css('display','none');
			$('.main').show();
		});
		
		$('.authDiv .goInvite').on('touchstart click',function(e){
			location.href='?s=page/invite';
		});
		
		$('.authDiv #closeAuth').on('touchstart click',function(e){
			$('.authDiv').css('display','none');
		});
		
		$('.authDiv').on('touchstart click',function(e){
			e.preventDefault();
		});
        var profile=JSON.parse(localStorage.getItem('profile'));
        if(location.href.indexOf("merchant_id") >= 0 ) {
            var copy_content='好友分享给你一段视频,快来看看吧!全网最强看片神器,百万影片每日更新。影片链接：'+location.href;
        }else {
            var copy_content='好友分享给你一段视频,快来看看吧!全网最强看片神器,百万影片每日更新。影片链接：'+location.href+'&merchant_id='+profile.merchant_id;
        }

		
		$.copy({
			text: "已复制", //分享提示文案
			copyUrl: copy_content, //自定义复制链接地址
			tipTime: 1, //分享提示消失时间
			copyId: "#copy" //复制按钮id
		});
		$('#copy').click(function () {
            $('.fixnickname').show();
        });
		
		$('.authDiv .goShare').on('touchstart',function(e){
			$('.authDiv').css('display','none');
			$('#copy').click();
		});
		
	}
	
	function getAs(){
		ajax_get('v1/ad/list',function(data){
			if(data.code==200){
				// xuanAs(data,'3-1');
				xuanAs(data,'3-2');
				xuanAs(data,'3-3');
				xuanBanner(data);
			
				var arr = data.data['3-1'];
				if(arr!=null){
					var html = '';
		            for (var i = 0; i < arr.length; i++) {
		                var obj = arr[i];
		                html += '<div class="swiper-slide" style="width: 100%;">';
		                html += '<a href="javascript:handleAs(\'' + obj.url + '\',\'' + obj.id + '\');">';
		                html += '<img class="pic" src="' + obj.image + '">';
		                html += '</a>';
		                html += '</div>';
		            }
		            $('.video_as').css('display','block');
		            $('#3-1').html(html);
		            $('#3-1 .swiper-slide:first-child').addClass('swiper-slide-active');
		             startSwiper1();
		             if(localStorage.getItem('jjbSkin')=='4'){
			         	$('.header .video_as .timeWrap').css({'color':'#FFFFFF','font-size':'15px'});
			        }
					$('.video_as').append('<span class="timeWrap"></span>');
					$('.timeWrap').css({'position':'fixed','z-index':'10'});
					var sec=6;
					var staticInfo='s';//秒后开始播放
					$('.timeWrap').html(sec+staticInfo);
					
			       
					var interId=setInterval(function(){
							sec--;
							$('.timeWrap').html(sec+staticInfo);
							if(sec<=0){
								clearInterval(interId);
								$('.video_as').css('display','none');
							}
						},1000);
					
				}
			}
		});
	}

    function xuanBanner(data) {
        var arr = data.data['3-4'];
        if (arr != null) {
            var html = '';
            for (var i = 0; i < arr.length; i++) {
                var obj = arr[i];
                html += '<div class="swiper-slide" style="width: 100%;">';
                html += '<a href="javascript:handleAs(\'' + obj.url + '\',\'' + obj.id + '\');">';
                html += '<img class="pic" src="' + obj.image + '">';
                html += '</a>';
                html += '</div>';
            }
            $('#banner').html(html);
            $('#banner .swiper-slide:first-child').addClass('swiper-slide-active');
            startSwiper();
        }
    }
	function changeLike(has_like){
		if(has_like==1){
			$('#like').css('color','#ff09af');
			$('#likes').css('color','#ff09af');
		}else{
			$('#like').css('color','#CCCCCC');
			$('#likes').css('color','#CCCCCC');
		}
	}
	
	function getData(){
		var self=this;
		var video_id=route[2];
		ajax_get('v1/video/details?video_id='+video_id,function(data){
			if(data.code==200){
				console.log(data);
				self.movieObj=data.data;
				var obj=self.movieObj;
				
				$('#title').html(obj.details.title);
				$('#score').html(obj.details.score);
				$('#playback').html(obj.playback);
				$('#likes').html(obj.likes);
				
				setVideo(obj.url);
				setBackLabel();
				setBrief(obj);
				changeLike(obj.has_like);
				
				if(inFavList(obj)){$('#fav').css('color','#ff09af');}
				if(!obj.has_auth){$('.authDiv').css('display','block');}
				xuanEpiSode(obj);
				bindEvent(video_id,obj);
				getLikeList(video_id);
			}
		});
	}
	
	function setBrief(obj){
		var html='';
			html+='<h1 title="'+obj.details.title+'">'+getSubStr(obj.details.title,20)+'<strong id="closeBrief">X</strong></h1>';
			html+='<p>评分:'+obj.details.score+'</p>';
			html+='<p>'+obj.details.cate_id+'</p>';
			html+='<p>主演:'+obj.details.starring+'</p>';
			html+='<h1>简介</h1>';
			html+='<p>'+obj.details.summary+'</p>';
		$('.briefDiv').html(html);
		if(localStorage.getItem('jjbSkin')=='4'){
            $('.briefDiv').css('background-color','#FFFFFF');
           	$('.briefDiv h1,.briefDiv h1 #closeBrief').css('color','#333333');
           	$('.briefDiv p').css('color','#666666');
        }
	}
	
	function setBackLabel(){
		var os=getOs();
		if(os=='android'){
			$('.header em').css('display','block');
		}
	}
	
	function setVideo(url){
        var videoObject = {
            container: '#video',//“#”代表容器的ID，“.”或“”代表容器的class
            variable: 'player',//该属性必需设置，值等于下面的new chplayer()的对象
            autoplay:false,
            html5m3u8:true,
            video:url,
            loaded:'loadedHandler',
            //seek:300,
            hlsjsConfig: {// hlsjs和CDNBye的配置参数
                debug: false,
                // Other hlsjsConfig options provided by hls.js
                p2pConfig: {
                    logLevel: true,
                    live: false, // 如果是直播设为true
                    // Other p2pConfig options provided by CDNBye
                    // https://github.com/cdnbye/hlsjs-p2p-engine/blob/master/docs/%E4%B8%AD%E6%96%87/API.md
                }
            }
        };
        player = new ckplayer(videoObject);
	}
	
	function loadedHandler(){//播放器加载后会调用该函数
		console.log('loadedHandler');
		//console.log(player);
		player.addListener('time', timeHandler); //监听播放时间,addListener是监听函数，需要传递二个参数，'time'是监听属性，这里是监听时间，timeHandler是监听接受的函数
		player.addListener('duration', durationHandler); //监听播放总时间
		player.addListener('play', playHandler); //监听播放事件
		player.addListener('paused', pausedHandler);
		player.addListener('buffer', bufferHandler);
	}
	
	function timeHandler(t){
		var currentTime=Math.floor(t);
		if(currentTime>=10){
			//console.log('a:'+currentTime);
			if(movieObj.currentTime!=currentTime){
				movieObj.currentTime=currentTime;
				console.log('b:'+movieObj.currentTime);
				updateWatchListCurrentTime(movieObj);
			}
		}
		
		//console.log('当前播放的时间：'+currentTime);
		//console.log(player);
		/*if(t>3){player.videoPause();}*/
		//player.videoPlay();
	}
	
	function durationHandler(duration) {
		console.log('视频总时长：'+duration);
		var currentTime=getWatchListCurrentTime(movieObj.video_id);
		console.log(currentTime);
		if(currentTime>10){
			player.videoSeek(currentTime);
		}
		
		movieObj.totalTime=Math.floor(duration);
		movieObj.currentTime=0;
		addWatchList(movieObj);
	}

	function playHandler(status) {
		console.log(status);
	}

	function pausedHandler(status){
		console.log(status);
	}
	
	function bufferHandler(buffer){
		//console.log('buffer progress:'+buffer);
	}
	
	function xuanEpiSode(obj){
		$('.episode label').html(obj.episode.length+'集全');
		if(obj.episode.length==1){
			// $('.episode label').html('1集全');
			$('.episode .content').html('<a class="active" href="?s=page/play/'+obj.video_id+'">1</a>');
		}else{
			// $('.episode label').html('更新至'+obj.episode.length+'集');
			var html='';
			for(var i=0;i<obj.episode.length;i++){
				var url='?s=page/play/'+obj.video_id+'/'+obj.address_id;
				html+='<a id='+obj.episode[i].id;
				if(obj.episode[i].id==obj.address_id){
					html+=' class="active"';
				}
				html+=' href="'+url+'">'+obj.episode[i].title+'</a>';
			}
			$('.episode .content').html(html);			
		}
		if(localStorage.getItem('jjbSkin')=='4'){
           	$('.main .episode .content a').css('color','#666666');
           	$('.main .episode .content a.active').css('color','#ff09af');
           	$('.main .episode .content a.active').css('background-color','#EEEEEE');
        }
	}
	
	function getLikeList(video_id){
		ajax_get('v1/video/like?video_id='+video_id,function(data){
			if(data.code==200){
				console.log(data);
				var arr=data.data;
				var html='';
				for(var i=0;i<arr.length;i++){
					var obj=arr[i];
					html+='<div class="row">';
					
					html+='<div class="pic">';
					html+='<a href="?s=page/play/'+obj.video_id+'">';
					html+='<img src="'+obj.image+'" '+'alt="'+obj.title+'" title="'+obj.title+'">';
					html+='</a>';
					html+='</div>';
					html+='<div class="content">';
					html+='<a href="?s=page/play/'+obj.video_id+'">';
					html+='<p class="title" title="'+obj.title+'">'+getSubStr(obj.title,24)+'</p>';
					html+='<p class="detail"><span>'+obj.score+'</span>分<em>·</em><span>'+obj.plays+'</span>次播放</p>';
					html+='</a>';
					html+='</div>';
					html+='</div>';
				}
				$('.recommand .list').html(html);
				if(localStorage.getItem('jjbSkin')=='4'){
           			 $('.main .recommand .list .row .content .title').css('color','#666666');
           			 
           			 $('.main .recommand .list .row .content .detail').css('color','#999999');
        		}
			}
		});
	}
	$('#nsubmit').on('touchstart click',function () {
       $('.fixnickname').hide();
    });
    function startSwiper(){
        var swiper = new Swiper('.swiper-container', {
            loop: true,
            pagination: '.swiper-pagination',
            paginationClickable: true,
            autoplay: 5000,
            speed: 2000
        });
    }
    function startSwiper1(){
        var swiper = new Swiper('.swiper-container', {
            loop: true,
            pagination: '.swiper-pagination',
            paginationClickable: true,
            autoplay: 3000,
            speed: 3000
        });
    }
</script>		
</body>
</html>