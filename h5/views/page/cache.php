<!DOCTYPE html>
<html>
<head>
<title><?=$site_title;?></title>
<meta name="description" content="" />
<meta name="keywords"    content="" />
<?php require_once('views/_header.php');?>
<link href="static/css/record.css?v=<?=$version?>" rel="stylesheet"/>
<style>
	.main .row .desc p{
		color: #0DC01E;
	}
</style>
</head>
<body>

<div class="header">
<a href="javascript:hBack();">
<em class="icon iconfont back">&#xe600;</em>
</a>
离线缓存
<span id="headerBtn" data="edit">编辑</span>
</div>

<div class="main">
	
	<div class="container">
		<div class="row">
			<div class="btn"><em class="icon iconfont pick" data="white">&#xe6ce;</em></div>
			<div class="pic">
				<img class="lazy" data-original="static/img/m1.jpg">
			</div>
			<div class="desc">
				<h1>明星颜值的学院派美女</h1>
				<p>已完成,点击播放  大小:170.02MB</p>
			</div>	
		</div>
	</div>
	
	<div class="panel">
		<div class="op all" data="1">全选</div>
		<div class="op delete" data="0">删除</div>
	</div>
	
</div>

<?php require_once('_pagefooter.php');?>
<script src="static/js/record.js?v=<?=$version?>"></script>
<script>
	$(document).ready(function(){
	    bindEvent();
	    setLazyLoad();
	    init();
	});
	
	function onFinishInit(){

	}
	
	function bindEvent() {
		bindClick();
	}
</script>		
</body>
</html>