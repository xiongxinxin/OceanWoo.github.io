<?php 
	// 导入文件
	// include("3.jiujiu.php");
	// include("3.jiujiu.php");
	// include("3.jiujiu.php");

	// include_once("3.jiujiu.php");
	// include_once("3.jiujiu.php");
	// include_once("3.jiujiu.php");

	// require("3.jiujiu.php");
	// require("3.jiujiu.php");
	// require("3.jiujiu.php");

	require_once("3.jiujiu.php");
	require_once("3.jiujiu.php");
	require_once("3.jiujiu.php");

	/*
		include: 文件导入的普通模式(全局对象冲突,不影响程序执行)

		require: 文件导入的严格模式(全局对象冲突,程序不能执行)
	 */


	/*
		php中的函数与js中函数的区别
		1.php中的函数名不区分大小写
		2.php的函数内部不能访问外部变量
		3.php中的函数参数可以传引用(地址)
	 */

	// // 无返回值 无参数
	// function sayHi(){
	// 	echo "hello world"."<hr>";
	// }
	// sayHi();

	// // 无返回值 有参数
	// function myprint($name){
	// 	echo "我的名字叫".$name."<hr>";
	// }
	// myprint("志超");

	// // 有返回值 无参数
	// function myvalue(){
	// 	return 20;   
	// }
	// $value = myvalue();
	// echo $value."<hr>";

	// // 有返回值 有参数
	// function sum($a,$b){
	// 	return $a + $b;
	// }
	// $result = sum(5,10);
	// echo $result."<hr>";


	// // 传引用
	// $x = 20;  // 0xffffffff
	// function foo(&$x){
	// 	echo $x; // 20
	// 	$x = 40;
	// }
	// foo($x);
	// echo $x;  // 40

	// // 全局变量
	// $y = 10;
	// function test(){
	// 	// 全局对象来修饰变量
	// 	global $y;
	// 	echo $y;

	// 	// echo $GLOBALS["y"]."<hr>";
	// 	// var_dump($GLOBALS);
	// }
	// test();

	// 静态变量
	function testStatic(){
		static $x = 100;
		echo $x++."<hr>";
	}

	for ($i=0; $i < 5; $i++) { 
		testStatic();
	}

	echo $x;

	/*
		静态变量(以上面的函数为例)

		作用域: 仅限于函数中,除了函数作用域就失效了

		生命周期: 创建且只创建一次,生命周期从定义开始到文件结束.

		代码执行流程: 调用函数-查看静态区是否有$x-如果没有那么创建-如果有,那么直接拿来使用.
	 */

	// 第一次: 100
	// 第二次: 101
	// 第三次: 102
	// 第四次: 103
	// 第五次: 104

	include("3.jiujiu.php");

 ?>