<!DOCTYPE html>
<html>
<head>
    <title><?= $site_title; ?></title>
    <meta name="description" content=""/>
    <meta name="keywords" content=""/>
    <?php require_once('_header.php'); ?>
    <style>

        .nav_header{
            top: 0;
            left: 0;
            width: 100%;
            z-index: 10;
            position: fixed;
            background-color: #111111;
        }
        .searchTop{
            max-height: 180px;
            overflow: hidden;
        }

        .header {
            padding: 7.5px 0px 7.5px 5px;
            color: #FFFFFF;
            background-color: #111111; -webkit-box-shadow: 0 0 1px rgba(0, 0, 0, .85);
            box-shadow: 0 0 1px rgba(0, 0, 0, .85);
        }

        .header .panel {
            height: 24px;
            padding: 3px 0px;
        }

        .header .sch {
            padding-left: 15px;
            width: 80%;
            display: inline-block;
            background-color: #1D1D1D;
            border-radius: 12px;
        }

        .header .sch input.searchT {
            font-size: 14px;
            height: 22px;
            vertical-align: top;
            width: 80%;
            background-color: transparent;
            outline: none;
            border: none;
            color: #999999;
        }

        .header .sch a {
            text-decoration: none;
        }

        .header .panel em {
            font-size: 20px;
            line-height: 22px;
        }

        .header .panel em.right {
            float: right;
            margin-right: 20px;
        }

        .header .panel em.search {
            font-size: 22px;
            color: #ff09af;
            margin-right: 5px;
        }

        .main {
            margin-top: 45px;
        }

        .main .category {
            height: 40px;
            line-height: 40px;
            overflow-x: scroll;
            /*overflow-x: hidden;*/
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

        .main .category a.active {
            font-size: 16px;
            color: #ff09af;
        }

        .main .swiper-container {
            width: 100%;
            height: 184px;
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

        .main .swiper-slide a {
            min-width: 100%;
            height: 184px;
        }

        .main .swiper-slide .pic {
            min-width: 100%;
            height: 184px;
        }

        .main .secCate {
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

        .main .secCate a img.pic {
            display: block;
            width: 40px;
            margin: 0px auto;
        }

        .main .secCate a p {
            color: #CCCCCC;
            font-size: 13px;
            padding: 0px;
            line-height: 26px;
        }

        .main .slipDiv {
            padding: 5px;
            background-color: #111111;
        }

        .main .slipDiv h1 {
            font-size: 14px;
            color: #FFFFFF;
            line-height: 32px;
            font-weight: normal;
        }

        .main .slipDiv h1 .like {
            width: 20px;
            vertical-align: middle;
            margin-right: 5px;
        }

        .main .slipDiv h1 .more {
            text-decoration: none;
            color: #CCCCCC;
            float: right;
            margin-right: 6px;
        }

        .main .slipDiv .slip {
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

        .main .slipDiv .slip a .pic {
            margin: 0px auto;
            width: 150px;
            height: 80px;
            overflow-y: hidden;
            border-radius: 5px;
        }

        .main .slipDiv .slip a .pic2 {
            margin: 0px auto;
            width: 340px;
            height: 182px;
            overflow-y: hidden;
            border-radius: 5px;
        }

        .main .slipDiv .slip a .pic img {
            display: block;
            min-width: 100%;
            height: 100%;
        }

        .main .slipDiv .slip a p {
            color: #CCCCCC;
            font-size: 13px;
            padding: 0px;
            line-height: 30px;
            max-width: 120px;
            overflow-x: hidden;
        }

        .main .slipDiv2 {
            overflow: hidden;
            padding: 5px;
            background-color: #111111;
        }

        .main .slipDiv2 .slip2 a {
            display: inline-block;
            text-align: center;
            text-decoration: none;
            flex: 1;
            padding: 8px 6px 0px;
            background: #111111;
        }

        .main .slipDiv2 .slip2 a .pic2 {
            margin: 0px auto;
            overflow-y: hidden;
            border-radius: 5px;
            width: 300px;
            height: 160px;
        }

        .main .slipDiv2 .slip2 a .pic2 img {
            min-width: 100%;
            height: 100%;
        }

        .main .slipDiv2 .slip2 a p {
            color: white;
            font-size: 13px;
            padding: 0px;
            line-height: 30px;
            overflow-x: hidden;
            position: absolute;
            bottom: 5px;
        }

        .main .slipDiv2 .slip2 a span {
            color: white;
            position: absolute;
            bottom: 12px;
            right: 10px;
        }

        .main .slipDiv2 h1 .more {
            text-decoration: none;
            color: #CCCCCC;
            float: right;
            margin-right: 6px;
            font-weight: normal;
        }

        .main .board {
            padding: 5px;
            background-color: #111111;
        }

        .main .board h1 {
            font-size: 14px;
            color: #FFFFFF;
            line-height: 32px;
            font-weight: normal;
            padding-right: 3px;
        }

        .main .board h1 .pic {
            width: 20px;
            vertical-align: middle;
            margin-right: 5px;
        }

        .main .board h1 .more {
            text-decoration: none;
            color: #CCCCCC;
            float: right;
            margin-right: 6px;
        }

        .main .board .content {
            padding: 3px 0px;
        }

        .main .board .content .row {
            display: flex;
        }

        .main .board .content .row .op {
            flex: 1;
            padding: 2px;
            position: relative;
            height: 180px;
            overflow: hidden;
        }

        .main .board .content .row .op .pic {
            min-width: 100%;
            border-radius: 5px;
            overflow: hidden;
        }

        .main .board .content .row .op .pic img {
            display: block;
            height: 150px;
            /*margin-left: -40%;*/
            min-width: 100%;
        }

        .main .board .content .row .op .pic3 img {
            display: block;
            height: 150px;
            min-width: 100%;
        }

        .main .board .content .row .op p {
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

        .main .container .op {
            position: relative;
            margin-bottom: 1rem;
        }

        .main .container .op .pic {
            min-width: 100%;
            height: 160px;
            border-radius: 5px;
            overflow: hidden;
        }

        .main .container .op .pic img {
            display: block;
            min-width: 100%;
            margin-top: -10%;
        }

        .main .container .op p {
            position: absolute;
        }

        .main .container .op span {
            position: absolute;
            bottom: .6rem;
            right: 5px;
            color: #f97937;
            font-weight: bold;
        }
        .slip2 .swiper-slide-prev .plant2Zhezhao{
            position: absolute;
            width: 100%;
            height: 100%;
            left: 0px;
            top: 0px;
            background: #000000;
            opacity: 0.5;
            z-index: 5;
        }

        .slip2 .swiper-slide-next .plant2Zhezhao{
            position: absolute;
            width: 100%;
            height: 100%;
            left: 0px;
            top: 0px;
            background: #000000;
            opacity: 0.5;
            z-index: 5;
        }
        ::-webkit-scrollbar{
            height: 15px;
        }
        .swiper-wrapper{
            height: auto!important;
        }
        .navTop{

            max-height: 180px;
            overflow: hidden;
        }
        .yindao_nav{
            position: fixed;
            bottom: 50px;
            left: 0;
            right: 0;
            z-index: 10;
        }
        .yindao{
            height: 40px;
            background: #FE08A2;
            background-image: linear-gradient(to right, #FA6A9D , #FE08A2);
        }
        .ydimg{
            width: 26px;
            height: 26px;
            margin: 8px 0 0 20px;
            float: left;
        }
        .yindao span{
            float: left;
            line-height: 40px;
            color: #fff;
            margin-left: 10px;
        }
        .ydimgx{
            width: 30px;
            height: 30px;
            float: right;
        }
        @media screen and (min-width: 680px){
            .yindao_nav {
                margin: auto !important;
                left: 0 !important;
                right: 0 !important;
                width: 680px !important;
            }
        }
        @media screen and (min-width: 680px){
            .nav_header {
                margin: auto !important;
                left: 0 !important;
                right: 0 !important;
                width: 680px !important;
            }
        }
    </style>
    <link rel="stylesheet" href="static/css/swiper.min.css">
</head>
<body>
<div class='nav_header'>
    <div id="2-5" class="as searchTop"></div>
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
</div>


<div class="main">

    <div id="1-1" class="as"></div>

    <div class="category"></div>

    <div id="2-2" class="as"></div>

    <div class="swiper-container" style="display: none">
        <div id="banner" class="swiper-wrapper">
        </div>
        <!-- Add Pagination -->
        <div class="swiper-pagination swiper-pagination-clickable swiper-pagination-bullets"></div>
    </div>

    <div id="2-3" class="as"></div>

    <div class="secCate"></div>

    <div id="2-4" class="as"></div>
    <div id="2-7" class="as"></div>
</div>
<div class='yindao_nav'>
    <div id="2-6" class="as navTop"></div>
    <div class="yindao" style="display: none">
        <a href="" target="_blank">
            <img src="../static/img/logo.png" alt="" class="ydimg">
            <span>看片就来《樱桃视频》，体验性福人生！</span>
        </a>
        <img src="../static/img/yindaox.png" alt="" class="ydimgx">
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
    var route =<?=json_encode($route)?>;

    $(document).ready(function () {
        bindEvent();
        xuanNav("index");
        init();
        if(localStorage.getItem('jjbSkin')=='4'){
            $('body,.nav_header,.header,.header .sch,.category,.secCate,.board,.footer,.notfound_bg,.notfound_content').css('background-color','#FFFFFF');
             $('*').css('color','#666666');
               $('.footer .item .word').css('color','#333333');
             $('.header .panel em.search').css('color','#ff09af');//search-red
        }
        if(localStorage.getItem('private_ys')==1){
            $('.notfound_bg').css('display','block');
            event.stopPropagation();
            $('body').css('overflow','hidden');
        }else {
            $('.notfound_bg').hide();
        }
        // $(".header").css('top',$(".searchTop").height());
        // $('.yindao').css('bottom',$('.navTop').height()+$('.footer').height());
    });

    function onFinishInit() {
        getHotKws();
        getCategory();
        getAs();
        showyd();
        /*同步ajax请求
        $.ajaxSettings.async = false;
        getCategory();
        $.ajaxSettings.async = true;
        */
        // $.ajaxSettings.async = false;
        getserchTopAs();
        // getListTopAs();
        getnavTopAs();
        onFootInit();
    }

    function bindEvent() {
        bindNav();
        $(window).scroll(function () {
            var disTop = $('#1-1').height() + $('.header').height() + 10 - $('.category').height();
            if ($(this).scrollTop() > disTop) {
                $('.category').css('position', 'fixed');
                $('.category').css('top', $('.nav_header').height());
                $('.category').css('width', '100%');
                /*                $('.category').css('left', '0px');
                                $('.category').css('right', '0px');*/
            } else {
                $('.category').css('position', 'relative');
                $('.category').css('top', '0px');
                /*                $('.category').css('left', '0px');
                                $('.category').css('right', '0px');*/
            }
            $('.main').css('margin-top',$('.nav_header').height());
            $('.main').css('margin-bottom',$('.yindao_nav').height()+$('.footer').height());//列表广告随下方上滑展示
        });
    }

    function getAs() {
        ajax_get('v1/ad/list', function (data) {
            if (data.code == 200) {
                xuanAs(data, '1-1');
                console.log(data)
            }
        });
    }
    function getserchTopAs() {
        ajax_get('v1/ad/list', function (data) {
            if (data.code == 200) {
                xuanAs(data, '2-5');
            }
        });
    }
    function getListTopAs(varHtml) {
        ajax_get('v1/ad/list', function (data) {
            if (data.code == 200) {
                // xuanAs(data, '2-7');
                var totalArray = data.data['2-7']
                var randomIndex=Math.floor(Math.random()* totalArray.length);
                console.log(data.data['2-7']);
                console.log(totalArray[randomIndex]);//随机展示一条
                    var html='';
                    var obj=totalArray[randomIndex];
                    html+='<a href="javascript:handleAs(\''+obj.url+'\',\''+obj.id+'\');">';
                    html+='<img  style="max-width:100%" src="'+obj.image+'">';
                    html+='</a>';
                // $('#2-7').html(html);
                $(varHtml).after(html);
            }
        });
    }
    function getnavTopAs() {
        ajax_get('v1/ad/list', function (data) {
            if (data.code == 200) {
                xuanAs(data, '2-6');
            }
        });
    }
    function getHotKws() {
        ajax_get('v1/search/kws', function (data) {
            if (data.code == 200) {
                var arr = data.data;
                if (arr.length > 0) {
                    $('.searchT').val(arr[0]);
                }
            }
        });
    }

    var activeId = 0;

    function getCategory() {
        ajax_get('v1/category/list', function (data) {
            if (data.code == 200) {
                var arr = data.data;
                var html = '';
                activeId = getActiveId(route[1], arr);
                for (var i = 0; i < arr.length; i++) {
                    var obj = arr[i];
                    html += '<a id=' + obj.id;
                    if (obj.id == activeId) {
                        html += ' class="active"';
                    }
                    html += ' href="?s=index/' + obj.id + '">' + obj.cate_name + '</a>';
                }
                $('.category').html(html);
                getSub(activeId);
                getBannerAd(activeId);
                if(localStorage.getItem('jjbSkin')=='4'){
                    $('.main .category a').css('color','#333333');//一级
                    $('.main .category a.active').css('color','#ff09af');                  
                }
            }
        });
    }

    var plantPage = 0;
    var scrowType = 0;

    function getSub(activeId) {
        ajax_get('v1/home/recomment?p=' + plantPage + '&ps=20&cate_id=' + activeId, function (data) {
            if (data.code == 200) {
                if (plantPage == 0 && data.data.subcategory) {
                    xuanSub(data.data.subcategory);
                }
                if (data.data.plate){
                    xuanPlate(data.data.plate);
                    // console.log(data.data.plate);
                }
            }
        });

        function xuanSub(arr) {
            var html = '';
            for (var i = 0; i < arr.length; i++) {
                var obj = arr[i];
                var url = obj.url;
                if (url.length == 0) {
                    url = 'http://img.sskk168.com/o/06/33/20200115/084855734239_original';
                }

                html += '<a id=' + obj.cate_id;
                html += ' href="?s=page/second/' + activeId + '/' + obj.cate_id + '">';
                html += '<img class="pic" src="' + url + '">';
                html += '<p>' + obj.name + '</p>';
                html += '</a>';
            }
            $('.secCate').html(html);
            if(localStorage.getItem('jjbSkin')=='4') {
                $('.main .secCate a p').css('color','#666666');//二级
            }
            // ss
        }

        function xuanPlate(arr) {
            for (var i = 0; i < arr.length; i++) {
                switch (arr[i].plate_style) {
                    case 1:
                        plusSlip(arr[i]);
                        break;
                    case 2:
                        plusSlip2(arr[i]);
                        break;
                    case 3:
                        plusBoard(arr[i]);
                        break;
                    case 4:
                        plusBoard2(arr[i]);
                        break;
                    case 5:
                        plusBoard5(arr[i]);
                        break;
                }
                if (i == (arr.length - 1) && arr[i].page_status == true) {
                    scrowType = 1;
                } else if (i == (arr.length - 1) && arr[i].page_status == false){
                    plantPage++;
                    // getListTopAs('.main .board .container .op:last-child');
                }
            }
             $('.main .slipDiv2 .pic').css('margin-right','4px');
            if(localStorage.getItem('jjbSkin')=='4'){
                $('.board,.slipDiv,.slipDiv2').css({'background-color':'#FFFFFF','line-height':'32px'});                
                $('h1').css({'color':'#666666','font-size':'13px','font-weight':'bold'});
                $('p').css('color','#666666');
                 $('.more,.main .slipDiv2 h1 .more').css({'color':'#999999','font-weight':'bold'});               
            }
            getListTopAs('.main .board .container .op:nth-child(18)');
        }

        function plusSlip(obj) {
            var html = '';
            html += '<div class="slipDiv">';
            html += '<h1>';
            if (obj.icon){
                html+='<img class="like" src="' + obj.icon + '">';
            }else{
                html += '<img class="pic" src="static/img/serie_little.png">';
            }
            html+= obj.plate_name;
            if (obj.hasMore) {
                html += '<a class="more" href="?s=page/more/' + activeId + '/' + obj.plate_id + '">更多</a>';
            }
            html += '</h1>';
            html += '<div class="slip">';
            for (var i = 0; i < obj.list.length; i++) {
                var listObj = obj.list[i];
                html += '<a href="?s=page/play/' + listObj.video_id + '">';
                html += '<div class="pic">';
                html += '<img src="' + listObj.url + '" title="' + listObj.title + '" ' + 'alt="' + listObj.title + '">';
                html += '</div>';
                html += '<p title="' + listObj.title + '">' + getSubStr(listObj.title, 8) + '</p>';
                html += '</a>';
            }
            html += '</div>';
            html += '</div>';
            $('.main').append(html);
        }

        //板块样式二渲染
        function plusSlip2(obj) {
            var html = '';
            html += '<div class="slipDiv2 slipswiper">';
            html += '<h1>';
            if (obj.icon){
                html+='<img class="like" src="' + obj.icon + '">';
            }else{
                html += '<img class="pic" src="static/img/like_little.png">';
            }
            html+= obj.plate_name;
            if (obj.hasMore) {
                html += '<a class="more" href="?s=page/more/' + activeId + '/' + obj.plate_id + '">更多</a>';
            }
            html += '</h1>';
            html += '<div class="slip2 swiper-wrapper">';
            for (var i = 0; i < obj.list.length; i++) {
                var listObj = obj.list[i];
                html += '<a class="swiper-slide" href="?s=page/play/' + listObj.video_id + '">';
                html += '<div class="plant2Zhezhao"></div>';
                html += '<div class="pic2">';
                html += '<img src="' + listObj.url + '" title="' + listObj.title + '" ' + 'alt="' + listObj.title + '">';
                html += '</div>';
                html += '<p title="' + listObj.title + '" style="text-align: left;padding-left: 1rem;">' + getSubStr(listObj.title, 20) + '</p>';
                html += '<span>';
                if (listObj.episode.length > 0) {
                    html += listObj.episode;
                } else {
                    html += listObj.score;
                }
                html += '</span>';
                html += '</a>';


            }
            html += '</div>';
            html += '</div>';
            $('.main').append(html);
            slidePlant2();
            $('.main .slipDiv2 .slip2 a').css('height',$('.main .slipDiv2 .slip2 a .pic2').height());//解决样式2下部分阴影的bug
        }

        function slidePlant2() {
            var swiper2 = new Swiper('.slipswiper', {
                direction: 'horizontal',
                loop: true,
                slidesPerView: "auto",
                centeredSlides: true,
                autoplay: 2500,
                speed: 1000
            });
        }

        function plusBoard(obj) {
            var html = '';
            html += '<div class="board"  data-plant="3" data-plant-id="' + obj.plate_id + '">';
            html += '<h1>';
            if (obj.icon){
                html += '<img class="pic" src="' + obj.icon + '">';
            }else{
                html += '<img class="pic" src="static/img/serie.png">';
            }
            html += obj.plate_name;
            if (obj.hasMore) {
                html += '<a class="more" href="?s=page/more/' + activeId + '/' + obj.plate_id + '">更多</a>';
            }
            html += '</h1>';

            var arr = getThreeArr(obj.list);

            html += '<div class="content">';

            for (var i = 0; i < arr.length; i++) {
                html += '<div class="row">';
                var subArr = arr[i];
                for (var j = 0; j < subArr.length; j++) {
                    html += '<div class="op">';
                    if (subArr[j].video_id != null) {
                        html += '<a href="?s=page/play/' + subArr[j].video_id + '">';
                        html += '<div class="pic">';
                        html += '<img src="' + subArr[j].url + '" title="' + subArr[j].title + '" ' + 'alt="' + subArr[j].title + '">';
                        html += '</div>';
                        html += '<p title="' + subArr[j].title + '">' + getSubStr(subArr[j].title, 8) + '</p>';
                        html += '</a>';
                        html += '<span>';
                        if (subArr[j].episode.length > 0) {
                            html += subArr[j].episode;
                        } else {
                            html += subArr[j].score;
                        }
                        html += '</span>';
                    }
                    html += '</div>';
                }
                html += '</div>';
            }

            html += '</div>';
            html += '</div>';
            $('.main').append(html);
        }

        function plusBoard2(obj) {
            var html = '';
            html += '<div class="board"  data-plant="4" data-plant-id="' + obj.plate_id + '">';
            html += '<h1>';
            if (obj.icon){
                html += '<img class="pic" src="' + obj.icon + '">';
            }else{
                html += '<img class="pic" src="static/img/serie.png">';
            }
            html += obj.plate_name;
            if (obj.hasMore) {
                html += '<a class="more" href="?s=page/more/' + activeId + '/' + obj.plate_id + '">更多</a>';
            }
            html += '</h1>';

            var arr = getTwoArr(obj.list);

            html += '<div class="content">';

            for (var i = 0; i < arr.length; i++) {
                html += '<div class="row">';
                var subArr = arr[i];
                for (var j = 0; j < subArr.length; j++) {
                    html += '<div class="op">';
                    if (subArr[j].video_id != null) {
                        html += '<a href="?s=page/play/' + subArr[j].video_id + '">';
                        html += '<div class="pic3">';
                        html += '<img src="' + subArr[j].url + '" title="' + subArr[j].title + '" ' + 'alt="' + subArr[j].title + '">';
                        html += '</div>';
                        html += '<p title="' + subArr[j].title + '">' + getSubStr(subArr[j].title, 14) + '</p>';
                        html += '</a>';
                        html += '<span>';
                        if (subArr[j].episode.length > 0) {
                            html += subArr[j].episode;
                        } else {
                            html += subArr[j].score;
                        }
                        html += '</span>';
                    }
                    html += '</div>';
                }
                html += '</div>';
            }

            html += '</div>';
            html += '</div>';
            $('.main').append(html);
        }

        function plusBoard5(obj) {
            var html = '';
            html += '<div class="board" data-plant="5" data-plant-id="' + obj.plate_id + '">';
            html += '<h1>';
            if (obj.icon){
                html += '<img class="pic" src="' + obj.icon + '">';
            }else{
                html += '<img class="pic" src="static/img/serie.png">';
            }
            html += obj.plate_name;
            if (obj.hasMore) {
                html += '<a class="more" href="?s=page/more/' + activeId + '/' + obj.plate_id + '">更多</a>';
            }
            html += '</h1>';

            var arr = obj.list;
            html += '<div class="container">';
            for (var i = 0; i < arr.length; i++) {
                var obj = arr[i];
                html += '<div class="op">';
                html += '<a href="?s=page/play/' + obj.id + '">';
                html += '<div class="pic">';
                html += '<img src="' + obj.url + '" title="' + obj.title + '" alt="' + obj.title + '">';
                html += '</div>';

                html += '</a>';
                html += '<p title="' + obj.title + '" style="margin: -2rem 0 1.6rem 1rem;color: white;">';
                html += getSubStr(obj.title, 16);
                html += '</p>';
                html += '<span>' + obj.score + '</span>';

                html += '</div>';
            }

            html += '</div>';
            html += '</div>';
            $('.main').append(html);
        }
    }

    function getBannerAd(activeId) {
        ajax_get('v1/ad/list?cate_id=' + activeId, function (data) {
            xuanAs(data, '2-2');
            xuanAs(data, '2-3');
            xuanAs(data, '2-4');
            // xuanAs(data, '2-6');
            var arr = data.data['2-1'];
            if (arr != null) {
                var html = '';
                for (var i = 0; i < arr.length; i++) {
                    var obj = arr[i];
                    html += '<div class="swiper-slide">';
                    html += '<a href="javascript:handleAs(\'' + obj.url + '\',\'' + obj.id + '\');">';
                    html += '<img class="pic" src="' + obj.image + '">';
                    html += '</a>';
                    html += '</div>';
                }
                $('#banner').html(html);
                $('#banner .swiper-slide:first-child').addClass('swiper-slide-active');
                if(arr.length>=2){
                    startSwiper();
                }
                $('.swiper-container').show();
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

    var chiledPlantPage = 1;
    $(window).scroll(
        function () {
            var scrollTop = $(this).scrollTop();
            var scrollHeight = $(document).height();//整个文档的高度
            var windowHeight = window.innerHeight;//窗口的文档显示区的高度
            // $(".header").css('top',$(".searchTop").height());
            // $('.yindao').css('bottom',$('.navTop').height()+$('.footer').height());
            // console.log('滚动高度：'+scrollTop+'窗口文档显示高度：'+windowHeight+'文档高度：'+scrollHeight)
            if ((scrollTop + windowHeight+1) == scrollHeight) {
               
                if (scrowType == 0) {
                    getSub(activeId);
                } else if (scrowType == 1) {
                     // alert(scrowType+'-'+chiledPlantPage);
                    var plantId = $('.board:last').attr('data-plant-id');
                    var url = 'v1/home/plate?p=' + chiledPlantPage + '&plate_id=' + plantId;
                    ajax_get(url, function (data) {
                        if (data.code == 200) {
                            if (data.data.length > 0) {
                                var plant = $('.board:last').attr('data-plant');
                                switch (plant) {
                                    case '3':
                                        var arr = getThreeArr(data.data);
                                        var html = '';
                                        for (var i = 0; i < arr.length; i++) {
                                            html += '<div class="row">';
                                            var subArr = arr[i];
                                            for (var j = 0; j < subArr.length; j++) {
                                                html += '<div class="op"+plantId>';
                                                if (subArr[j].video_id != null) {
                                                    html += '<a href="?s=page/play/' + subArr[j].video_id + '">';
                                                    html += '<div class="pic">';
                                                    html += '<img src="' + subArr[j].url + '" title="' + subArr[j].title + '" ' + 'alt="' + subArr[j].title + '">';
                                                    html += '</div>';
                                                    html += '<p title="' + subArr[j].title + '">' + getSubStr(subArr[j].title, 8) + '</p>';
                                                    html += '</a>';
                                                    html += '<span>';
                                                    if (subArr[j].episode.length > 0) {
                                                        html += subArr[j].episode;
                                                    } else {
                                                        html += subArr[j].score;
                                                    }
                                                    html += '</span>';
                                                }
                                                html += '</div>';
                                            }
                                            html += '</div>';
                                        }

                                        $('.board:last>.content').append(html);
                                        // $('.main .container').children("div:last-child").after('完成3');
//                                        getListTopAs('.main .container .op:last-child');
                                        break;
                                    case '4':
                                        var arr = getTwoArr(data.data);
                                        var html = '';
                                        for (var i = 0; i < arr.length; i++) {
                                            html += '<div class="row">';
                                            var subArr = arr[i];
                                            for (var j = 0; j < subArr.length; j++) {
                                                html += '<div class="op">';
                                                if (subArr[j].video_id != null) {
                                                    html += '<a href="?s=page/play/' + subArr[j].video_id + '">';
                                                    html += '<div class="pic3">';
                                                    html += '<img src="' + subArr[j].url + '" title="' + subArr[j].title + '" ' + 'alt="' + subArr[j].title + '">';
                                                    html += '</div>';
                                                    html += '<p title="' + subArr[j].title + '">' + getSubStr(subArr[j].title, 14) + '</p>';
                                                    html += '</a>';
                                                    html += '<span>';
                                                    if (subArr[j].episode.length > 0) {
                                                        html += subArr[j].episode;
                                                    } else {
                                                        html += subArr[j].score;
                                                    }
                                                    html += '</span>';
                                                }
                                                html += '</div>';
                                            }
                                            html += '</div>';
                                        }
                                        $('.board:last>.content').append(html);
                                        // $('.main .container').children("div:last-child").after('完成4');
//                                        getListTopAs('.main .container .op:last-child');

                                        break;
                                    case '5':
                                        var arr = data.data;
                                        var html = '';
                                        for (var i = 0; i < arr.length; i++) {
                                            var obj = arr[i];
                                            html += '<div class="op">';
                                            html += '<a href="?s=page/play/' + obj.id + '">';
                                            html += '<div class="pic">';
                                            html += '<img src="' + obj.url + '" title="' + obj.title + '" alt="' + obj.title + '">';
                                            html += '</div>';

                                            html += '</a>';
                                            html += '<p title="' + obj.title + '" style="margin: -2rem 0 1.6rem 1rem;color: white;">';
                                            html += getSubStr(obj.title, 16);
                                            html += '</p>';
                                            html += '<span>' + obj.score + '</span>';
                                            html += '</div>';
                                        }
                                       $('.board:last>.container').append(html);
                                       // getListTopAs('.main .board .container .op:last-child');
                                        ajax_get('v1/ad/list', function (data) {
                                            if (data.code == 200) {
                                                var totalArray = data.data['2-7']
                                                var randomIndex=Math.floor(Math.random()* totalArray.length);
                                                console.log(data.data['2-7']);
                                                console.log(totalArray[randomIndex]);//随机展示一条
                                                var html='';
                                                var obj=totalArray[randomIndex];
                                                html+='<a href="javascript:handleAs(\''+obj.url+'\',\''+obj.id+'\');">';
                                                html+='<img  style="max-width:100%" src="'+obj.image+'">';
                                                html+='</a>';
                                                $('.board:last>.container').append(html);
                                                // $('.main .board .container :last-child').append(html);
                                            }
                                        });
                                        break;
                                    default:
                                        break;
                                }
                                self.chiledPlantPage++;
                            }
                        }
                    });
                 }
            }
        }
    );
    $('.ydimgx').click(function () {
        $('.yindao').hide(200);
    });
    function showyd(){
        var profile=JSON.parse(localStorage.getItem('profile'));
        var merchantConfig=JSON.parse(localStorage.getItem('merchantConfig'));
        $('.ydimg').attr('src',profile.app_logo);
        if (merchantConfig){
            $('.yindao a').attr('href',merchantConfig[4]);
            $('.yindao a span').html(merchantConfig[3]);
            $('.yindao').show();
        }else{
            ajax_get('v1/merchant/config', function (data) {
                if (data.code == 200) {
                    localStorage.setItem('merchantConfig', JSON.stringify(data.data));
                    $('.yindao a').attr('href',data.data[4]);
                    $('.yindao a span').html(data.data[3]);
                    $('.yindao').show();
                }
            });
        }
    }
</script>
</body>
</html>