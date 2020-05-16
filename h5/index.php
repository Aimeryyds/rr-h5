<?php
$merchantId=isset($_SERVER['HTTP_X_MERCHANT_ID'])?$_SERVER['HTTP_X_MERCHANT_ID']:0;
echo '<script>var proxy_merchant_id='.$merchantId.';</script>';
header('Content-Type:text/html;charset=utf-8');
date_default_timezone_set('PRC'); //设置中国时区 
error_reporting(E_ALL^E_NOTICE^E_WARNING);	

define('ROOT',$_SERVER['DOCUMENT_ROOT']);

require_once("./common/config.php");
require_once("./common/common.php");
require_once("./common/route.php");
?>