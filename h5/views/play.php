<!DOCTYPE html>
<html>
<head>
    <title><?= $site_title; ?></title>
    <meta name="description" content=""/>
    <meta name="keywords" content=""/>
    <?php require_once('_header.php'); ?>
    <style>
        .header {
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

        .header strong {
            font-size: 16px;
            color: #FFFFFF;
            font-weight: normal;
        }

        .header em {
            position: absolute;
            right: 10px;
            font-size: 22px;
            color: #ff09af;
        }

        .main {
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

        .swiper-wrapper a{
            background: black;
        }

        .main .swiper-slide .pic {
            width: 100%;
            height: 105px;
            border-radius: 6px;
        }

        .main .content{
            padding: 3px 0px;
        }

        .main .content .row{
            display: flex;
        }

        .main .content .row .op{
            flex: 1;
            padding: 4px;
            position: relative;
            height: 200px;
            overflow: hidden;
        }

        .main .content .row .op .pic{
            width: 100%;
            border-radius: 5px;
            overflow: hidden;
        }

        .main .content .row .op .pic img{
            display: block;
            height: 160px;
            /*margin-left: -40%;*/
            width: 100%;
            object-fit: cover;
        }

        .main .content .row .op .pic3 img{
            display: block;
            height: 150px;
        }

        .main .content .row .op p{
            color: #CCCCCC;
            font-size: 13px;
            padding: 2px 0 0 0;
            cursor: pointer;
        }

        .main .content .row .op span {
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
    <strong>娱乐</strong>
</div>

<div class="main">
    <div class="swiper-container" style="display: none">
        <div id="banner" class="swiper-wrapper">
        </div>
        <!-- Add Pagination -->
        <div class="swiper-pagination swiper-pagination-clickable swiper-pagination-bullets"></div>
    </div>
</div>
<div class="notfound_bg">
    <div class="notfound_content">
        <img  src="static/img/search_notFounf.png"/>
        <br>
        没有找到相关内容
    </div>
</div>
<?php require_once('_footer.php'); ?>
<script src="static/js/swiper.min.js"></script>
<script>
    var lock = false;
    var page = 0;

    $(document).ready(function () {
        bindEvent();
        setLazyLoad();
        xuanNav("play");
        init();
        if(localStorage.getItem('jjbSkin')=='4'){
            $('body,.header,.main,.footer,.notfound_bg,.notfound_content').css('background-color','white');
            $('.header strong,.footer .item .word').css('color','#333333');
        }
        if(localStorage.getItem('private_ys')==1){
            $('.notfound_bg').show();
            event.stopPropagation();
            $('body').css('overflow','hidden');
        }else {
            $('.notfound_bg').hide();
        }
    });

    function onFinishInit() {
        console.log('finish init');
        getBannerAd();
        onFootInit();
    }

    function bindEvent() {
        bindNav();
        var self = this;
        $(window).scroll(function () {
            var scrollTop = $(this).scrollTop();
            var scrollHeight = $(document).height();
            var windowHeight = window.innerHeight;
            if (scrollTop + windowHeight == scrollHeight) {
                self.lock = true;
            }
        });
    }

    function getBannerAd() {
        ajax_get('v1/ad/list', function (data) {
            if (data.code == 200) {
                var arr = data.data['9-1'];
                if (arr != null) {//娱乐banner
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
                    $('.swiper-container').show();
                }

                var arr2 = data.data['9-2'];
                if (arr2 != null) {//娱乐九宫格
                    var html='';

                    var arr=getThreeArr(arr2);
                    html+='<div class="content">';
                    for(var i=0;i<arr.length;i++){
                        html+='<div class="row">';
                        var	subArr=arr[i];
                        for(var j=0;j<subArr.length;j++){
                            html+='<div class="op">';
                            if(subArr[j].title!=null){
                                html+='<a href="'+subArr[j].url+'">';
                                html+='<div class="pic">';
                                html+='<img src="'+subArr[j].image+'" title="'+subArr[j].title+'" '+'alt="'+subArr[j].title+'">';
                                html+='</div>';
                                html+='<p title="'+subArr[j].title+'">'+getSubStr(subArr[j].title, 24)+'</p>';
                                html+='</a>';
                            }
                            html+='</div>';
                        }
                        html+='</div>';
                    }

                    html+='</div>';
                    $('.main').append(html);
                    if(localStorage.getItem('jjbSkin')=='4'){
                            $('.main .content .row .op p').css('color','#666666');
                            $('.main .container .op p span').css('color','#999999');
                    }
                }
            }
        });
    }

    function startSwiper() {
        var swiper = new Swiper('.swiper-container', {
            loop: true,
            pagination: '.swiper-pagination',
            paginationClickable: true,
            autoplay: 5000,
            speed: 2000
        });
    }
</script>
</body>
</html>