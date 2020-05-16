<!DOCTYPE html>
<html>
<head>
<title><?=$site_title;?></title>
<meta name="description" content="" />
<meta name="keywords"    content="" />
<?php require_once('views/_header.php');?>
<style>
.header{
	position: relative;
	padding: 10px;
	text-align: center;
	color: #FFFFFF;
	font-size: 16px;
	line-height: 20px;
}

.header em{
	position: absolute;
	left: 10px;
	color: #FFFFFF;
	font-size: 16px;
	line-height: 20px;
}

.main{
	background-color: #111111;
	padding: 0px 10px;
}

.main .row{
	padding: 10px 5px;
	font-size: 15px;
	line-height: 30px;
}

.main .row.avatar{
	line-height: 50px;
	border-radius: 8px;
	background-color: #1D1D1D;
}

.main .list{
	margin-top: 10px;
	background-color: #1D1D1D;
	border-radius: 8px;
}

.main .row .pic{
	float: right;
	width: 50px;
	height: 50px;
    border-radius: 25px;
    vertical-align: text-bottom;
}

.main .row span{
	float: right;
}
.icon{
    float: right;
    margin-left: 6px;
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
        width: 49%;
        padding: 20px 0;
        font-size: 14px;
    }
    .fixnicknamemain p input{
        width: 80%;
        height: 30px;
        background: #222222;
        border: 1px solid #2b2b2b;
        margin: 26px 0;
        padding: 0 4px;
    }
</style>
</head>
<body>

<div class="header">
<a href="javascript:hBack();">
<em class="icon iconfont back">&#xe600;</em>
</a>
设置
</div>

<div class="main">
    <input type="file" style="display: none" name="pic" id="pic" accept="image/gif, image/jpeg, image/png">
    <label for="pic" id="piclabel">
	<div class="row avatar">头像<em class="icon iconfont" >&#xe60e;</em><img class="pic" src="static/img/avatar.png"></div>
    </label>
	
	<div class="list">
	<div class="row" id="changenickname">昵称<em class="icon iconfont" >&#xe60e;</em><span id="nickname">-</span></div>
	<div class="row">邀请人<span>无</span></div>
	</div>
    <div class="fixnickname" style="display: none">
        <div class="fixnicknamemain">
            修改昵称
            <p><input type="text" name="nickname" placeholder="请输入您的昵称"></p>
            <div style="border-top: 1px solid #2b2b2b;">
                <button class="fbutton" id="ncancel" style="border-right: 1px solid #2b2b2b;color: #FFFFFF;">取消</button>
                <button class="fbutton" id="nsubmit" style="color: #FF11AD">确认</button>
            </div>

        </div>
    </div>
</div>
<div class="notfound_bg">
    <div class="notfound_content">
        <img  src="static/img/search_notFounf.png"/>
        <br>
        没有找到相关内容
    </div>
</div>
<?php require_once('_pagefooter.php');?>
<script>
	$(document).ready(function(){
	   
        if(localStorage.getItem('jjbSkin')=='4'){
            $('body,.main').css('background-color','#F5F5F5');
            $('.header,.main .row.avatar,.main .list,.fixnicknamemain,input,.notfound_bg,.notfound_content').css('background-color','#FFFFFF');
            $('.fixnickname').css('background','rgba(0,0,0,0.5)');  
            $('.main').css('margin-top','15px');
             $('.header,.fixnicknamemain').css('color','#333333');
             $('*').css('color','#666666');
             $('.fbutton:last-child').css('color','#ff09af');//确定按钮加红
        }
        if(localStorage.getItem('private_ys')==1){
            $('.notfound_bg').css({'display':'block','bottom':0,'top':$('.header').height()+10});
             event.stopPropagation();
             if(localStorage.getItem('jjbSkin')=='4'){//简洁白
                $('.header').css('color','#FFFFFF');
                $('.header em').css('color','#333333');
             }else{
                $('.header').css('color','#000000');
                $('.header em').css('color','#FFFFFF');
             }
        }else {
            $('.notfound_bg').hide();
        }
        bindEvent();
        init();
	});
	
	function onFinishInit(){
		var profile=JSON.parse(localStorage.getItem('profile'));
        if (profile.nickname){
            $('#nickname').html(profile.nickname);
        }
		if (profile.head_portrait){
            $('.pic').attr('src',profile.head_portrait);
        }
	}
	
	function bindEvent() {

	}

    $("#changenickname").click(function () {
        $('.fixnickname').show();
    });
    $('#ncancel').click(function () {
        $('.fixnickname').hide();
    });
    $('#nsubmit').click(function () {
        if ($(this).attr('disabled') == 'disabled') {
            return false;
        }
        var nickname = $('input[name=nickname]').val();
        if (!nickname) {
            alert('请输入您的昵称');
        } else if (nickname.length<2 || nickname.length>10){
            alert('昵称只允许2到10个字符');
        } else {
            $(this).attr('disabled', 'disabled');
            var param = {
                type: 1,
                face: nickname,
            };
            ajax_customize('v1/face', param, function (data) {
                if (data.code == 200) {
                    var profile = JSON.parse(localStorage.getItem('profile'));
                    profile.nickname = nickname;
                    localStorage.setItem('profile', JSON.stringify(profile));
                    $('.fixnickname').hide();
                    onFinishInit();
                    $('input[name=nickname]').val('');
                } else {
                    alert('网络错误，请稍后重试');
                }
                $('#nsubmit').removeAttr('disabled');
            }, 'PATCH');
        }
    });

    $(document).on('change', 'input[name=pic]', function () {
        if (!window.FileReader) {
            base.msg("您的浏览器不能上传图片");
            return false;
        }
        if (!this.files[0].type.match(/^(image\/gif|image\/jpeg|image\/png)$/i) && !checkFileExtendIsImage($(this).val())) {
            base.msg("只能上传 JPEG | PNG | GIF 格式的图片");
            return false;
        }
        if (this.files[0].size > 5242880) {
            base.msg("图片不能超过5MB");
            return false;
        }
        $('#piclabel').attr('for','picpic');
        var reader = new FileReader();
        reader.onload = function (e) {
            var param = {
                type: 1,
                val: this.result,
            };
            upload_pic(param, '', function (data) {
                if (data.status == 1) {
                    $('.pic').attr('src',data.result);

                    var faseparam={
                        type: 2,
                        face: data.result,
                    };
                    ajax_customize('v1/face', faseparam, function (data) {
                        if (data.code == 200) {
                            var profile = JSON.parse(localStorage.getItem('profile'));
                            profile.head_portrait = faseparam.face;
                            localStorage.setItem('profile', JSON.stringify(profile));
                            onFinishInit();
                        } else {
                            alert('网络错误，请稍后重试');
                        }
                        $('#piclabel').attr('for','pic');
                    }, 'PATCH');
                } else {
                    $('#piclabel').attr('for','pic');
                    alert('网络错误，请稍后重试');
                }
            });
        };
        reader.readAsDataURL(this.files[0]);
    });
</script>		
</body>
</html>