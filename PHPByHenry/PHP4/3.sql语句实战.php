<?php 

	/* 
	 * 操作数据
	 * 1.连接数据库
	 * 2.执行sql语句
	 * 3.使用结果
	 * 4.断开连接
	 */

	// 连接数据库
	$mysqli = new mysqli("localhost","root","","php0607");
	// 判断数据库是否连接成功,只要不是0就代表连接失败.
	if ($mysqli->connect_errno) {
		// die是结束php的执行,同时输出错误信息
		die($mysqli->connect_error);
	}

	$sql = "INSERT INTO user(name,tel) VALUES('小张','18533504575')";

	$mysqli->query("set names utf8");

	// 执行sql语句 
	$result = $mysqli->query($sql);

	// 判断
	if ($result) {
		echo "插入成功";
	}else{
		echo "插入失败";
	}

	// 关闭数据库
	$mysqli->close();
 ?>