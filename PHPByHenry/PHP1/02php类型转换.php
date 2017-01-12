<?php 
	// 自动类型转换
	$var1 = 5;
	$var2 = "50e". 20;  // 查询
	$var3 = $var1 + $var2;
	echo $var3;
	echo "<hr>";

	// 类型判断
	echo gettype($var2);
	echo "<hr>";

	echo is_bool($var1);
	echo is_int($var1);
	echo is_string($var2);
	echo is_float($var3);
	echo is_array($var1);
	echo is_object($var1);
	echo is_null($var1);
	echo is_resource($var3);
	echo "<hr>";

	var_dump($var3);
	echo "<hr>";
	
	// 算术运算符
	$a1 = 11;
	$a2 = 3.3;  // 会将小数转换为整数
	echo $a1 % $a2;
	echo "<hr>";

	// 赋值运算符
	$b1 = 10;

	// 复合运算符
	$b1 %= 20;  // $b1 = $b1 + 20;
	echo $b1;
	echo "<hr>";

	// 字符串拼接
	$c1 = "hello";
	$c2 = "world";
	$c3 = $c1.$c2;
	echo $c3;
	echo "<hr>";


	// 自增自减
	$d1 = 10;
	++$d1;
	$d2 = $d1++;
	echo $d1+++$d2;
	echo "<hr>";

	$var1 = 10;
	//$var2 = &$var1;
	function func(&$num){
		$num = 123;
		return $num;
	}
	echo func($var1);

	echo $var1;

 ?>