<?php

	echo $_GET["echostr"];
	// function checkWeixin(){
	// 	// 微信会发送四个参数 签名  时间戳 
	// 	$signature = $_GET["signature"];
	// 	$timestamp = $_GET["timestamp"];
	// 	$nonce = $_GET["nonce"];
	// 	$echostr = $_GET["echostr"];

	// 	$token = "wuhaiyang";

	// 	// 字典序排序
	// 	$tempArr = array($signature,$timestamp,$nonce);
	// 	sort($tempArr,SORT_STRING);

	// 	// 将数组合成一个长串
	// 	$str = implode($tempArr);
	// 	// 加密
	// 	$sign = sha1($str);

	// 	// 判断签名是否来自于微信
	// 	if ($sign == $signature) {
	// 		echo $echostr;
	// 	}
	// }

	// checkWeixin();

	// 服务器处理微信转发过来的数据
	// $_POST

	
?>