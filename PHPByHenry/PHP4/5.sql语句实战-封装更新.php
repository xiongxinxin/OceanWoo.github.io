<?php 
 	function update($sql){
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
	$sql = "UPDATE user SET name = '小李',sex = '女' WHERE id = 9";
	// 调用方法
	update($sql);

 ?>