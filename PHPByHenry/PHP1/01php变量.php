<?php 
	// 向世界挥挥手
	echo "Hello world";

	// 变量
	$name = "小娟娟";  // 字符串类型
	$age = 18; 		// 整形
	$sex = "女";
	$height = 1.66; // 浮点型
	$isGirl = true; // 布尔类型 

	// 输出语句
	echo $name,$age,$sex,$height,$isGirl; 
	/* echo输出语句
	 * 1.最常用的输出语句
	 * 2.输出一个或多个字符串/变量
	 * 3.不自动换行且没有返回值
	 */
	echo "<hr>";

	// 输出单个字符串
	print("$name,$age");
	echo "<hr>";

	// 格式化输出
	printf("我叫%s,年龄是%09d,身高是%.2f,性别是%s",$name,$age,$height,$sex);
	echo "<hr>";

	// 特殊功能-打印数组
	print_r($name);
	echo "<hr>";

	// 用于调试
	var_dump($name,$isGirl);
	echo "<hr>";

	// 变量传引用
	$var1 = "hello";
	$var2 = &$var1;
	echo $var1,$var2;

	$var2 = "world";
	echo "<hr>";
	echo $var1,$var2;
	echo "<hr>";

	// 变量的变量
	$var3 = "hello";
	$$var3 = "1234";
	echo $hello;
	echo ${$var3};
	echo "<hr>";

	// {}还有""的使用
	$name1 = "liping";
	$pass1 = "123456";
	// $str = "name=".$name1."&pass=".$pass1;
	$str = "name='{$name1}'&pass='{$pass1}'";
	echo $str."<hr>";

	// 常量
	define("PI", 3.1415926 + 5,true);
	echo PI * 2;
	echo "<hr>";
	$PI = PI;
	echo "abc{$PI}def";
	echo "<hr>";

	// 系统方法调用信息
	// echo phpinfo();
	echo PHP_OS;
	echo PHP_VERSION;
	echo "<hr>";

	// 魔术常量
	echo __LINE__;
	echo __FILE__;
	echo "<hr>";

	// 定界符
	$str = <<<AAA
	一大堆的内容,但是后面的结束定界符,必须贴在最左边.
AAA;
	echo $str;



 ?>
