<!DOCTYPE html>
<html>
<head>
<title><?=$site_title;?></title>
<meta name="description" content="" />
<meta name="keywords"    content="" />
<?php require_once('_header.php');?>
<style>
	.header{
		padding: 15px;
	}
	
	.header .pic{
		width: 50px;
		height: 50px;
		border-radius: 25px;
		vertical-align: top;
	}
	.header .pic_click{
		width: 40px;
		height: 40px;
		float: right;
		margin-right: 25px;
	}
	
	.header .info{
		display: inline-block;
	}
	
	.header .info p{
		padding: 3px;
	}
	
	.header .info p.name{
		color: #FFFFFF;
		font-size: 16px;
	}
	
	.main{
        margin-top: 18px;
		background-color: #111111;
	}
	
	.main .btnDiv {
	    display: flex;
	    margin: 10px 5px;
        margin-top: 30px;
	    border-radius: 8px;
	}
	
	.main .btnDiv .op{
		flex: 1;
	}
	
	.main .btnDiv .op .pic{
		display: block;
		margin: 0px auto;
		width: 50px;
	}
	
	.main .btnDiv .op p{
		text-align: center;
		line-height: 30px;
	}
	
	.main .slipDiv{
		padding: 5px;
		background-color: #1d1d1d;
	}
	
	.main .slipDiv h1{
		padding-right: 10px;
		font-size: 14px;
		color: #FFFFFF;
		line-height: 30px;
		font-weight: normal;
	}
	
	.main .slipDiv h1 .pic{
		width: 20px;
		vertical-align: middle;
		margin-right: 5px;
	}
	
	.main .slipDiv h1 em{
		float: right;
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
	    line-height: 26px;
	}
	
	.main .opDiv{
		padding: 10px 15px 10px 5px;
		background-color: #1d1d1d;
	}
	
	.main .opDiv h1{
		font-size: 14px;
		color: #FFFFFF;
		line-height: 20px;
		font-weight: normal;
	}
	
	.main .opDiv h1 .pic{
		width: 20px;
		vertical-align: top;
		margin-right: 5px;
	}
	
	.main .opDiv h1 em{
		float: right;
	}
    ::-webkit-scrollbar{
        height: 1px;
    }
    .dialog_layer{
        width: 60%;
        margin: 0 20px 0 110px;
        background-color: #66194C;
        border-radius:8px;
        border-bottom-color:#fff;
        display: none;
    }
    .dialog_layer p{
        padding: 6px;
    }
    .dialog_triangle{
        width:0;
        height:0;
        border:10px solid transparent;
        border-top-color:#fff;
        position: relative;
    }

</style>
</head>
<body>

<div class="header">
	<img class="pic" id="head_portrait" src="static/img/avatar.png">
	<div class="info">
		<p class="name">-</p>
		<p class="remain">-</p>
	</div>
<!--	<img class="pic_click" id="click_portrait" src="static/img/about.png">-->
</div>
<div id="click_layer">
    <div class="dialog_layer">
        <p>点击“卍”按钮五次，进入“卍”模式，撸过不留痕！再也不担心小伙伴发现我撸过咯</p>
    </div>
    
<!--    <div class="dialog_triangle"></div>-->
</div>
<div class="main">
	
	<div class="btnDiv">
		<div class="op">
			<a href="?s=page/promote">
			<img class="pic" src="static/img/t1.png">
			<p>我的推广</p>
			</a>
		</div>
		<div class="op">
			<a href="?s=page/invite">
			<img class="pic" src="static/img/t2.png">
			<p>邀请好友</p>
			</a>
		</div>
		<div class="op">
			<a href="?s=page/setting">
			<img class="pic" src="static/img/t3.png">
			<p>设置</p>
			</a>
		</div>
        <div class="op">
            <a class="pic_click" id="click_portrait">
                <img class="pic" src="static/img/private.png">
                <p>模式</p>
            </a>
        </div>
	</div>

	<div class="slipDiv">
		<a href="?s=page/watchlist"><h1><img class="pic" src="static/img/lishi.png">观看历史<em class="icon iconfont">&#xe60e;</em></h1></a>
		<div class="slip container"></div>	
	</div>
	
	<div class="opDiv">
		<a href="?s=page/fav"><h1><img class="pic" src="static/img/fav.png">我的收藏<em class="icon iconfont">&#xe60e;</em></h1></a>
	</div>
	
	<div class="opDiv">
		<a href="javascript:download();"><h1><img class="pic" src="static/img/cache.png">离线缓存<em class="icon iconfont">&#xe60e;</em></h1></a>
	</div>

    <div class="opDiv">
        <a href="?s=page/about"><h1><img class="pic" src="static/img/about.png">关于我们<em class="icon iconfont">&#xe60e;</em></h1></a>
    </div>
	
</div>

<?php require_once('_footer.php');?>
<script>
	var _appDownload=null;
	
	$(document).ready(function(){
	    bindEvent();
	    xuanNav("mine");
	    init();
        if(localStorage.getItem('jjbSkin')=='4'){
            $('body,.header,.main,.slipDiv,.opDiv,.footer').css('background-color','#FFFFFF');
             $('.dialog_layer').css('background-color','#FFE9F6');
            $('*').css('color','#666666');
             $('.footer .item .word').css('color','#333333');
             $('.slip').css('display','none');
        }
   
        if(localStorage.getItem('private_ys')==1){
            $('.main .slipDiv,.opDiv').hide();
            $('#click_portrait img').attr('src','static/img/private_ys.png')
        }else {
            $('.main .slipDiv,.opDiv').show();
            $('#click_portrait img').attr('src','static/img/private.png')
        }

        if(localStorage.getItem('first_item')){//第二次进入
   			var firstItem=new Date().getTime();
   			if(firstItem!=localStorage.getItem('first_item')){
   				if(localStorage.getItem('first_five')){//能取到，未点击
					$('.dialog_layer').css('display','none');
   				}else{
					$('.dialog_layer').css('display','block');
   				}
   			}
   		}else{//首次登录并点击
			localStorage.setItem('first_item',new Date().getTime());
			$('.dialog_layer').css('display','block');
   		}
	});
	
	function onFinishInit(){
        var profile=JSON.parse(localStorage.getItem('profile'));
        if (profile.head_portrait){
            $('#head_portrait').attr('src',profile.head_portrait);
        }
		xuanWatchList();
		getAppDownLoad();
		getData();
        onFootInit();
	}
	function bindEvent() {
		bindNav();
		var clickTimer=0;
        var clickFiveTimer=0;
		$('#click_portrait').click(function (){
            clickTimer++;
            var starTime=new Date().getSeconds();
            var nowSeconds=Math.round(new Date().getTime()/1000);//时间戳绝对值到秒

            $('#click_portrait').attr('clickb'+clickTimer,nowSeconds);//此时
           var  nowAtrr=$('#click_portrait').attr('clickb'+clickTimer);//现在
            var  nowFiveAtrr=$('#click_portrait').attr('clickb'+(clickTimer-4));//倒数第五次

            if(nowFiveAtrr!=undefined){//至少点5次触发
                var timeZq=nowAtrr-nowFiveAtrr;//时间周期
                var imgSrc=$('#click_portrait img').attr('src');
     
                if(timeZq<=5){//5秒内
                    clickFiveTimer++;
                    $('#click_portrait').addClass('clickCb'+clickFiveTimer);
                    var clickCbAE=$(this).context.classList.length;
                    if(clickFiveTimer==1){//开始点击

 					  setPrivateModal();//纯净模式与正常模式切换
 					  
 					  if(imgSrc=="static/img/private.png"){//正常模式图标 红色为正常，黄色为隐私
						$('#click_portrait img').attr('src','static/img/private_ys.png')
 					  }else{
						$('#click_portrait img').attr('src','static/img/private.png')
 					  }

 					  localStorage.setItem('first_five','first_five');
                      		$('.dialog_layer p').text('我要修仙，我要撸管！连续点击“卍”按钮五次开启撸管之旅！');
                      		// $('.dialog_layer').css('display','none');
							$('#click_portrait').removeClass();
                    		$('#click_layer').attr('fisrt_login',1);

                    }
                    console.log(clickCbAE);
                    if(clickCbAE == 5){
                    	if($('.slipDiv').css('display')=='none'){
                    	$('.dialog_layer').remove();
                    }
                        setPrivateModal();//纯净模式与正常模式切换
                        $('#click_portrait').removeClass();

 					  	if(imgSrc=="static/img/private.png"){//正常模式图标
							$('#click_portrait img').attr('src','static/img/private_ys.png')
 					  	}else{
							$('#click_portrait img').attr('src','static/img/private.png')

 					  	}

                    }

                    // if(clickFiveTimer%5===0){//连续点击5次
                    //     setPrivateModal();//纯净模式与正常模式切换
                    //     // rmClassCb();
                    //     $('#click_portrait').removeClass();
                    // }else {
                    //
                    // }
                    if($('.slipDiv').css('display')=='none'){
                    	localStorage.setItem('private_ys',1);
                    	$('.dialog_layer2').css('display','none');
                    }else{
                    	localStorage.removeItem('private_ys');
                    }
                }else {
                    clickFiveTimer=0;
                }
            }
		});
	}
	function setPrivateModal() {
        $('.main .slipDiv,.opDiv').toggle();
    }

	function getData(){
		ajax_get('v1/my/profile',function(data){
			if(data.code==200){
				console.log(data);
				var obj=data.data;
				$('.header .info .name').html(obj.nickname);
				$('.header .info .remain').html(obj.remaining_num);
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
					html+='<a href="?s=page/play/'+obj.video_id+'/'+obj.address_id+'">';
					html+='<div class="pic">';
					html+='<img src="'+obj.image+'" title="'+obj.details.title+'" alt="'+obj.details.title+'">';
					html+='</div>';
					html+='<p title="'+obj.details.title+'">'+getSubStr(obj.details.title,8)+'</p>';
					html+='</a>';
				}
				$('.main .container').html(html);
			}
		}
	}
</script>		
</body>
</html>