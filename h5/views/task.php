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
		position: relative;
	}
	
	.header strong{
		font-weight: normal;
	}
	
	.main{
		background-color: #1D1D1D;
	}
	
	.main .basic{
		margin-top: 10px;
		display: flex;
	}
	
	.main .basic .op{
		flex: 1;
	}
	
	.main .basic .op.remaining_num{
		display: none;
	}
	
	.main .basic .op.end_time{
		display: none;
	}
	
	.main .basic .op p{
		text-align: center;
		color: #CCCCCC;
	    font-size: 13px;
	    line-height: 26px;
	}
	
	.main .basic .op p.times{
		color: #ff09af;
		font-size: 20px;
		font-weight: bold;
	}
	
	.main .btnDiv{
		margin-top: 15px;
		text-align: center;
		margin-bottom: 10px;
	}
	
	.main .btnDiv button{
		margin: 0px 15px;
		background: transparent;
		border: 1px solid #ff09af;
		padding: 5px 15px;
		color: #ff09af;
		font-size: 16px;
		border-radius: 20px;
		font-weight: bold;
		outline: none;
	}
	
	.main .btnDiv button em{
		font-size: 20px;
		margin-right: 3px;
		vertical-align: top;
		color: #ff09af;
	}
	
	.main .tip{
		border-top: 10px solid #111111;
		display: none;
	}
	
	.main .tip h4{
		padding: 10px 20px;
		color: #ff09af;
		font-size: 16px;
	}
	
	.main .tip p{
		padding: 0px 20px 10px 20px;
	}
	
</style>
</head>
<body>
	
<div class="header">
<strong>任务中心</strong>
</div>

<div class="main">
	
	<div class="basic">
		<div class="op">
			<p>已邀请</p>
			<p id="invent_num" class="times">-</p>
		</div>
		<div class="op">
			<p>今日可观影次数</p>
			<p id="total_num" class="times">-</p>
		</div>
		<div class="remaining_num op">
			<p>剩余观影次数</p>
			<p id="remaining_num" class="times">-</p>
		</div>
		<div class="end_time op">
			<p>无线观影时间</p>
			<p id="end_time" class="times">-</p>
		</div>
	</div>
	
	<div class="btnDiv">
		<a href="?s=page/promote"><button><em class="icon iconfont">&#xe678;</em>我的推广</button></a>
		<a href="?s=page/invite"><button><em class="icon iconfont">&#xe8ca;</em>邀请好友</button></a>
	</div>

    <div id="welfare" class="tip">
        <h4>我的福利</h4>
        <p id="welfare_mark">-</p>
    </div>
	
	<div id="day_task" class="tip">
		<h4>每日任务</h4>
		<p id="day_task_mark">-</p>
	</div>
	
	<div id="details" class="tip">
		<h4>推广任务</h4>
		<p id="summary">-</p>
	</div>
	
</div>
<div class="notfound_bg">
    <div class="notfound_content">
        <img  src="static/img/search_notFounf.png"/>
        <br>
        没有找到相关内容
    </div>
</div>

<?php require_once('_footer.php');?>
<script>
	$(document).ready(function(){
	    bindEvent();
	    xuanNav("task");
	    init();
        if(localStorage.getItem('jjbSkin')=='4'){
            $('body').css('background-color','#F5F5F5');//bg
			$('.header,.footer,.main,.notfound_bg,.notfound_content').css('background-color','#FFFFFF');
            $('.header strong,.footer .item .word').css('color','#333333');
            $('.main .basic .op p,.main .tip p').css('color','#666666');
            $('.main .basic .op p.times').css('color','#ff09af');//红色
            $('.tip').css('border-top-color','#e6e2e2');
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
		getData();
        onFootInit();
	}
	
	function getData(){
		ajax_get('v1/task/home',function(data){
			if(data.code==200){
				console.log(data);
				var obj=data.data;
				
				$('#invent_num').html(obj.invent_num);
				$('#total_num').html(obj.total_num);
				if(obj.end_time==0){
					$('#remaining_num').html(obj.remaining_num);
					$('.remaining_num').css('display','block');
				}else{
					setEndTime(obj.end_time);
				}
				
				if(obj.day_task_mark!=null){
					$('#day_task_mark').html(obj.day_task_mark);
					$('#day_task').css('display','block');
				}
                if (obj.task_welfare){
                    var welfare=obj.task_welfare.replace(/\n/g,'<br>');
                    $('#welfare_mark').html(welfare);
                    $('#welfare').css('display','block');
                }

				if(obj.task_info!=null){
					var summary=obj.task_info.summary.replace(/\n/g,'<br>');
					$('#summary').html(summary);
					
					var details=obj.task_info.details;
					var html='';
					for(var i=0;i<details.length;i++){
						html+='<p>'+details[i]+'</p>';	
					}
					$('#details').append(html);
					$('#details').css('display','block');
					if(localStorage.getItem('jjbSkin')=='4'){
			            $('.main .tip p').css('color','#666666');
        			}
				}
			}
		});
	}
	
	function bindEvent() {
		bindNav();
	}
	
	function setEndTime(time){
		showEndTime(time);
		$('.end_time').css('display','block');
		
		setInterval(function(){
			time=time-1;
			showEndTime(time);
		},1000);
	}
	
	function showEndTime(time){
		var hours=Math.floor(time/3600);
		var minutes=Math.floor((time-hours*3600)/60);
		var seconds=time-hours*3600-minutes*60;
		var label=hours+':'+format2(minutes)+':'+format2(seconds);
		$('#end_time').html(label);
	}
	
	function format2(num){
		var newNum=num;
		if(num<10){newNum='0'+num;}
		return newNum;
	}
</script>		
</body>
</html>