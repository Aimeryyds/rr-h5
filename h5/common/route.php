<?php
	$page='index';
	$route=[];
		
	if(isset($_GET['s'])){
		$route=explode('/',$_GET['s']);
	}
		
	if(count($route)==1){
		$page=$route[0];
	}else if(count($route)>=2){
		if($route[0]=='page'){
			$page=$route[0].'/'.$route[1];
		}else{
			$page=$route[0];
		}
	}else{
		
	}
		
	$file='./views/'.$page.'.php';
	
	if(file_exists($file)){
		require_once($file);
	}else{
		require_once('./views/404.php');
	}
?>