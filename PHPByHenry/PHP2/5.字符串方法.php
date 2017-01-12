<?php 
	
	// 字符串方法
	$str = "123aBc";

	// 1.字符串长度
	$length = strlen($str);
	if ($length < 8) {
		echo "您的密码设置过短,需重新设置";
	}
	echo "<hr>";

	// 2.字符串小写
	echo strtolower($str);

	// 3.字符串大写
	echo strtoupper($str)."<hr>";

	// 4.字符串查找
	$find = strpos($str,"b",2);
	echo $find."<hr>"; 
	/*
		参数1: 目标字符串
		参数2: 需要查的值
		参数3: 从哪个下标开始找.

		注意: 区分大小写
	 */

	// 不区分大小写
	$find = stripos($str,"b");
	echo $find."<hr>";

	// 5.字符串替换
	$str1 = "testat163.com";
	$email = str_replace("at","@",$str1);
	echo $email;
	/*
	 	参数1: 目标字符串
	 	参数2: 替换字符串
	 	参数3: 原字符串

	 	注意: 字符串操作并非真正操作本身字符串,所以都会返回一个新的字符串.
	 */

	// 6.字符串子串
	$str2 = "hello world";
	$str3 = substr($str2,0,5);
	echo $str3."<hr>";
	/*
		参数1: 目标字符串
		参数2: 起始下标
		参数3: 长度(不包括自身)
	 */

	$str4 = strstr($str2,"l",false);
	echo $str4."<hr>";
	/*
		参数1: 目标字符串
		参数2: 查找字符
		参数3: bool(false是默认,往后获取字符.true是往前获取字符)
	 */

	// 字符串转数组
	$time = "2016-09-07";
	$arr = explode("-",$time);
	print_r($arr);
	echo "<hr>";

	// 数组转字符串
	$time2 = implode($arr,":");
	echo $time2."<hr>";
 ?>