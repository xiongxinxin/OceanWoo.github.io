<?php 
	class Person{
		const AAA = 1000;

		static public $bb;

		// 静态方法
		static public function staticMethod(){
			echo "This is static method,you can use className to get it"."<hr>";
		}
	}

	// 创建一个对象
	$p1 = new Person();

	// ::范围解析符 有三种使用场景

	// 第一种: 访问类中的常量
	echo Person::AAA."<hr>";

	// 用一个代表类名的字符串访问常量
	$str = "Person";
	echo $str::AAA."<hr>";

	// 使用对象访问常量
	echo $p1::AAA."<hr>";

	// 第二种: 访问类中的静态变量
	Person::$bb = "baolong";
	echo Person::$bb."<hr>";

	$str1 = "Person";
	$str1::$bb = "jianwei";
	// echo $str1::$bb."<hr>";

	// 案例 --- 解析案例(此bb 非彼$bb bb是对象的一个自定义属性)
	$p1->bb = "丽萍";
	echo $p1->bb."<hr>";
	echo $str1::$bb."<hr>";

	$p1::$bb = "满良";
	echo $p1::$bb."<hr>";

	$p1->staticMethod();

	Person::staticMethod();
 ?>