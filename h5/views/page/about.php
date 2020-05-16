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
        top: 0;
        left: 0;
        right:0;
        padding: 0px 20px 0px 5px;
        text-align: center;
        background-color: #111111;
        color: #FFFFFF;
        font-size: 16px;
        line-height: 45px;
        height: 45px;
	}

    .header .back{
        color: #FFFFFF;
        margin: 0px 3px;
        float: left;
    }
	
	.header .pic{
		width: 50px;
		border-radius: 25px;
		vertical-align: top;
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
		background-color: #111111;
	}
	
	.main .btnDiv {
	    display: flex;
	    margin: 10px 5px;
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
		padding: 10px 15px 10px 15px;
		background-color: #1d1d1d;
	}
	
	.main .opDiv h1{
		font-size: 14px;
		color: #CCCCCC;
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
    .main .logo{
        text-align: center;
        margin-top: 8rem;
    }
    .main .logo img{
        width: 60px;
        height: 60px;
        margin-bottom: 10px;
    }
    .main .logo p{
        font-size: 1.6rem;
        color: #EB31A2;
    }
    .main .version{
        text-align: center;
        bottom: 2rem;
        position: absolute;
        width: 100%;
        color: #999999;
    }
</style>
</head>
<body>

<div class="header">
    <a href="javascript:hBack();">
        <em class="icon iconfont back">&#xe600;</em>
    </a>
    关于我们
</div>

<div class="main">
	
    <div class="logo">
        <img src="" alt="" style="display: none">
        <p id="app-name"></p>
    </div>

    <div class="contact" style="margin: 2rem 1rem;"></div>

<!--    <div class="version">
        版本号V1.1.0
    </div>-->
	
</div>

<?php require_once('_pagefooter.php');?>
<script>
	var _appDownload=null;
	
	$(document).ready(function(){
	    init();
        if(localStorage.getItem('jjbSkin')=='4'){
            $('body,.header,.main').css('background-color','white');
            $('*').css('color','black');
        }
	});
	
	function onFinishInit(){
		console.log('finish init');
		getData();
        var profile=JSON.parse(localStorage.getItem('profile'));
        if (profile.app_name){
            $("#app-name").html(profile.app_name);
        }
        if (profile.app_logo){
            $(".logo>img").attr('src',profile.app_logo);
            $(".logo>img").show();
        }
	}

	function getData(){
		ajax_get('v1/about/index',function(data){
			if(data.code==200){
				console.log(data);
				var arr=data.data;
                var html='';
                for(var i=0;i<arr.length;i++){
                    var obj=arr[i];
                    html+='<div class="opDiv">';
                    html+='<h1>'+obj.name+'<em class="icon iconfont">'+obj.number+' &#xe60e;</em></h1>';
                    html+='</div>';
                }
                $('.contact').html(html);
                if(localStorage.getItem('jjbSkin')=='2'){
                    $('.opDiv').css('background-color','white');
                    // rgba(0,0,0,0.5)
                    $('*').css('color','black');
                }

			}
		});
	}

</script>		
</body>
</html>