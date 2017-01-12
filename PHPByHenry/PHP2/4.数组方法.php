<?php 
	
	// // 1.索引数组(以下标作为标记的数组)
	// $arr = array("甘余志","沈益佳","顾青榕");
	// // echo $arr; 
	// print_r($arr);
	// echo $arr[1];
	// echo "<hr>";

	// // 2.关联数组(数组下标是一个字符串)
	// $arr1 = array("name"=>"天蒙","sex"=>"男","age"=>22);
	// print_r($arr1);
	// echo $arr1["age"];
	// echo "<hr>";

	// // 数组追加
	// $arr[] = 1;
	// $arr[] = 5;
	// $arr[] = 7;
	// $arr["apple"] = "iphone7";
	// $arr[] = 20;

	// print_r($arr);
	// echo "<hr>";

	// // 快速生成一个范围数组(参数1:起始值,参数2:结束值,参数3:步进值)
	// $array = range(10,20,3);
	// print_r($array);
	// echo "<hr>";

	// // 数组的增删改插查
	// $array[] = 998;
	// print_r($array);
	// echo "<hr>";

	// // 删除
	// array_splice($array, 4);
	// print_r($array);
	// echo "<hr>";

	// // 修改
	// array_splice($array,0,1,1000);
	// print_r($array);
	// echo "<hr>";

	// // 插入
	// array_splice($array,1,0,2000);
	// print_r($array);
	// echo "<hr>";

	// // 查询(遍历)

	// // 数组遍历-(下标原始版)
	// for ($i=0; $i < count($array); $i++) { 
	// 	echo $array[$i]."<br>";
	// }
	// echo "<hr>";
	
	// // 数组遍历-(下标增强版)
	// foreach ($array as $value) {
	// 	echo $value."<br>";
	// }
	// echo "<hr>";
	// // 数组遍历-(键值标准版)
	// foreach ($array as $key => $value) {
	// 	echo $key."=".$value."<br>";
	// }
	// echo "<hr>";

	// // 数组排序 - 值升序排序
	// sort($array);
	// print_r($array);
	// echo "<hr>";

	// // 数组排序 - 值反序排序
	// rsort($array);
	// print_r($array);
	// echo "<hr>";


	// $array = array("name"=>"haha","sex"=>"hehe","age"=>18);
	// // 数组排序 - 键升序排序
	// ksort($array);
	// print_r($array);
	// echo "<hr>";

	// // 数组排序 - 键反序排序
	// krsort($array);
	// print_r($array);
	// echo "<hr>";

	// 数组首尾的添加和删除方法
	$arr = range(10, 20);
	// 往数组末尾添加一个元素
	array_push($arr, "hello");
	print_r($arr); 
	echo "<hr>";

	// 从数组末尾删除一个元素
	array_pop($arr);
	print_r($arr); 
	echo "<hr>";

	// 往数组头部添加一个元素
	array_unshift($arr, "hello");
	print_r($arr); 
	echo "<hr>";

	// 从数组头部删除一个元素
	array_shift($arr);
	print_r($arr); 
	echo "<hr>";

 ?>