<?php 

	// 准备
	$arr = ["admin","root","localhost"];

	$username = $_GET["name"];

	if(in_array($username, $arr)){
		echo "用户名已被注册";
	}else{
		echo "恭喜您,用户名可用";
	}


 ?>