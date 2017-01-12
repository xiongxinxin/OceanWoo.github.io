<?php 
	
	function insert($sql){
		$mysqli = new mysqli("localhost","root","","php0607");
		if ($mysqli->connect_errno) {
			die($mysqli->connect_error);
		}
		// 防止乱码,所以添加utf8编码
		$mysqli->query("set names utf8");

		// 执行sql语句
		$result = $mysqli->query($sql);

		// 关闭数据库
		$mysqli->close();
	}

	// 写一个sql语句
	$sql = "INSERT INTO user(name,sex,age,tel) VALUES('小冯','女',18,'13845786543')";
	// 调用方法
	insert($sql);


 ?>