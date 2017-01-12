<?php 
	// 设置xml数据格式
	header("Content-Type:text/xml");

	echo 
	"<?xml version='1.0' encoding='UTF-8'?>";

	echo "<response>";
		// 接收前台请求的数据
		$food = $_GET["food"];

		// 后台的数据
		$foodArray = array("tuna","bacon","宫保鸡丁","酱板鸭");

		// 匹配前后台数据
		if (in_array($food, $foodArray)) 
			echo "We do have ".$food;
		elseif ($food == "") 
			echo "大哥大姐,输入你要吃的菜~!";
		else
			echo "Sorry,We don't have ".$food;
	echo "</response>";
 ?>